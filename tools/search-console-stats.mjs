import crypto from "node:crypto";
import fs from "node:fs/promises";
import http from "node:http";
import os from "node:os";
import path from "node:path";
import { spawn } from "node:child_process";

const READONLY_SCOPE = "https://www.googleapis.com/auth/webmasters.readonly";
const AUTH_ENDPOINT = "https://accounts.google.com/o/oauth2/v2/auth";
const TOKEN_ENDPOINT = "https://oauth2.googleapis.com/token";
const API_ROOT = "https://www.googleapis.com/webmasters/v3";
const DEFAULT_DAYS = 28;
const DATA_DELAY_DAYS = 3;
const ROW_LIMIT = 25_000;

const projectRoot = path.resolve(import.meta.dirname, "..");
const privateDir = path.join(
  process.env.LOCALAPPDATA || path.join(os.homedir(), "AppData", "Local"),
  "SubcultureGamerStats",
);
const clientPath = path.join(privateDir, "client_secret.json");
const tokenPath = path.join(privateDir, "google-token.json");
const outputDir = path.join(projectRoot, "planning", "traffic");
const dataDir = path.join(outputDir, "data");

function parseArgs(argv) {
  const args = { authOnly: false, days: DEFAULT_DAYS, site: null };
  for (let index = 0; index < argv.length; index += 1) {
    const value = argv[index];
    if (value === "--auth-only") args.authOnly = true;
    else if (value === "--days") args.days = Number(argv[++index]);
    else if (value === "--site") args.site = argv[++index];
    else if (value === "--help") args.help = true;
    else throw new Error(`알 수 없는 옵션: ${value}`);
  }
  if (!Number.isInteger(args.days) || args.days < 1 || args.days > 365) {
    throw new Error("--days는 1~365 사이의 정수여야 합니다.");
  }
  return args;
}

function formatDate(date) {
  return date.toISOString().slice(0, 10);
}

function dateRange(days, offsetDays = DATA_DELAY_DAYS) {
  const end = new Date();
  end.setUTCHours(0, 0, 0, 0);
  end.setUTCDate(end.getUTCDate() - offsetDays);
  const start = new Date(end);
  start.setUTCDate(start.getUTCDate() - days + 1);
  return { startDate: formatDate(start), endDate: formatDate(end) };
}

function previousRange(current, days) {
  const end = new Date(`${current.startDate}T00:00:00Z`);
  end.setUTCDate(end.getUTCDate() - 1);
  const start = new Date(end);
  start.setUTCDate(start.getUTCDate() - days + 1);
  return { startDate: formatDate(start), endDate: formatDate(end) };
}

function base64Url(buffer) {
  return buffer
    .toString("base64")
    .replace(/=/g, "")
    .replace(/\+/g, "-")
    .replace(/\//g, "_");
}

async function loadClient() {
  let parsed;
  try {
    parsed = JSON.parse(await fs.readFile(clientPath, "utf8"));
  } catch (error) {
    throw new Error(`OAuth 설정 파일을 읽을 수 없습니다: ${clientPath}\n${error.message}`);
  }
  if (!parsed.installed?.client_id || !parsed.installed?.client_secret) {
    throw new Error("데스크톱 앱용(installed) OAuth 설정 파일이 아닙니다.");
  }
  return parsed.installed;
}

async function saveToken(token) {
  await fs.mkdir(privateDir, { recursive: true });
  await fs.writeFile(tokenPath, `${JSON.stringify(token, null, 2)}\n`, { mode: 0o600 });
}

async function loadToken() {
  try {
    return JSON.parse(await fs.readFile(tokenPath, "utf8"));
  } catch (error) {
    if (error.code === "ENOENT") return null;
    throw error;
  }
}

async function tokenRequest(params) {
  const response = await fetch(TOKEN_ENDPOINT, {
    method: "POST",
    headers: { "content-type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams(params),
  });
  const payload = await response.json();
  if (!response.ok) {
    throw new Error(`Google 토큰 요청 실패 (${response.status}): ${payload.error_description || payload.error}`);
  }
  return payload;
}

function tryOpenBrowser(url) {
  const child = spawn(
    "powershell.exe",
    ["-NoProfile", "-Command", "Start-Process", url],
    { detached: true, stdio: "ignore", windowsHide: true },
  );
  child.unref();
}

async function authorize(client) {
  const verifier = base64Url(crypto.randomBytes(48));
  const challenge = base64Url(crypto.createHash("sha256").update(verifier).digest());
  const state = base64Url(crypto.randomBytes(24));

  const server = http.createServer();
  await new Promise((resolve, reject) => {
    server.once("error", reject);
    server.listen(0, "127.0.0.1", resolve);
  });
  const address = server.address();
  const redirectUri = `http://127.0.0.1:${address.port}`;
  const authUrl = new URL(AUTH_ENDPOINT);
  authUrl.search = new URLSearchParams({
    client_id: client.client_id,
    redirect_uri: redirectUri,
    response_type: "code",
    scope: READONLY_SCOPE,
    access_type: "offline",
    prompt: "consent",
    state,
    code_challenge: challenge,
    code_challenge_method: "S256",
  }).toString();

  console.log("Google 로그인 창을 엽니다. 읽기 권한을 승인해 주세요.");
  console.log(`창이 열리지 않으면 다음 주소를 기본 브라우저에 붙여 넣으세요:\n${authUrl}`);
  tryOpenBrowser(authUrl.toString());

  const code = await new Promise((resolve, reject) => {
    const timeout = setTimeout(() => {
      server.close();
      reject(new Error("로그인 대기 시간이 5분을 초과했습니다."));
    }, 5 * 60 * 1000);

    server.on("request", (request, response) => {
      const callback = new URL(request.url, redirectUri);
      if (callback.searchParams.get("state") !== state) {
        response.writeHead(400, { "content-type": "text/plain; charset=utf-8" });
        response.end("잘못된 OAuth 상태입니다.");
        return;
      }
      const error = callback.searchParams.get("error");
      const authCode = callback.searchParams.get("code");
      if (error || !authCode) {
        clearTimeout(timeout);
        response.writeHead(400, { "content-type": "text/plain; charset=utf-8" });
        response.end("Google 권한 승인이 완료되지 않았습니다.");
        server.close();
        reject(new Error(`Google 권한 승인 실패: ${error || "authorization code 없음"}`));
        return;
      }
      clearTimeout(timeout);
      response.writeHead(200, { "content-type": "text/html; charset=utf-8" });
      response.end("<meta charset='utf-8'><title>연결 완료</title><h1>연결이 완료되었습니다.</h1><p>이 창을 닫아도 됩니다.</p>");
      server.close();
      resolve(authCode);
    });
  });

  const token = await tokenRequest({
    client_id: client.client_id,
    client_secret: client.client_secret,
    code,
    code_verifier: verifier,
    grant_type: "authorization_code",
    redirect_uri: redirectUri,
  });
  token.expires_at = Date.now() + token.expires_in * 1000;
  await saveToken(token);
  return token;
}

async function accessToken(client) {
  let token = await loadToken();
  if (!token) return (await authorize(client)).access_token;
  if (token.access_token && token.expires_at > Date.now() + 60_000) return token.access_token;
  if (!token.refresh_token) return (await authorize(client)).access_token;

  const refreshed = await tokenRequest({
    client_id: client.client_id,
    client_secret: client.client_secret,
    refresh_token: token.refresh_token,
    grant_type: "refresh_token",
  });
  token = {
    ...token,
    ...refreshed,
    refresh_token: refreshed.refresh_token || token.refresh_token,
    expires_at: Date.now() + refreshed.expires_in * 1000,
  };
  await saveToken(token);
  return token.access_token;
}

async function googleJson(url, accessTokenValue, options = {}) {
  const response = await fetch(url, {
    ...options,
    headers: {
      authorization: `Bearer ${accessTokenValue}`,
      ...(options.body ? { "content-type": "application/json" } : {}),
      ...options.headers,
    },
  });
  const payload = await response.json();
  if (!response.ok) {
    throw new Error(`Google API 요청 실패 (${response.status}): ${payload.error?.message || response.statusText}`);
  }
  return payload;
}

async function listSites(token) {
  const payload = await googleJson(`${API_ROOT}/sites`, token);
  return payload.siteEntry || [];
}

function selectSite(sites, requested) {
  if (requested) {
    const match = sites.find((site) => site.siteUrl === requested);
    if (!match) throw new Error(`접근 가능한 Search Console 속성에서 찾지 못했습니다: ${requested}`);
    return match.siteUrl;
  }
  const preferred = sites.find((site) => site.siteUrl === "sc-domain:subculturegamer.com")
    || sites.find((site) => site.siteUrl.includes("subculturegamer.com"));
  if (preferred) return preferred.siteUrl;
  if (sites.length === 1) return sites[0].siteUrl;
  throw new Error(`속성을 자동 선택할 수 없습니다. --site 옵션을 사용하세요.\n${sites.map((site) => site.siteUrl).join("\n")}`);
}

async function queryAll(token, site, body) {
  const rows = [];
  for (let startRow = 0; ; startRow += ROW_LIMIT) {
    const payload = await googleJson(
      `${API_ROOT}/sites/${encodeURIComponent(site)}/searchAnalytics/query`,
      token,
      { method: "POST", body: JSON.stringify({ ...body, rowLimit: ROW_LIMIT, startRow }) },
    );
    const batch = payload.rows || [];
    rows.push(...batch);
    if (batch.length < ROW_LIMIT) break;
  }
  return rows;
}

function normalizeUrl(value) {
  try {
    const url = new URL(value);
    url.hash = "";
    url.search = "";
    url.pathname = url.pathname === "/" ? "/" : `${url.pathname.replace(/\/+$/, "")}/`;
    return url.toString();
  } catch {
    return value;
  }
}

async function loadPublishedPostIndex() {
  const postsDir = path.join(projectRoot, "posts", "published");
  const index = new Map();
  for (const entry of await fs.readdir(postsDir, { withFileTypes: true })) {
    if (!entry.isFile() || !entry.name.endsWith(".md")) continue;
    const content = await fs.readFile(path.join(postsDir, entry.name), "utf8");
    const match = content.match(/^url:\s*["']?(.+?)["']?\s*$/m);
    if (match?.[1]) index.set(normalizeUrl(match[1]), entry.name);
  }
  return index;
}

function attachPostFiles(rows, postIndex) {
  return rows.map((row) => ({
    ...row,
    postFile: postIndex.get(normalizeUrl(row.keys[0])) || "",
  }));
}

function csvCell(value) {
  const text = String(value ?? "");
  return /[",\r\n]/.test(text) ? `"${text.replace(/"/g, '""')}"` : text;
}

function toCsv(headers, rows) {
  return [headers, ...rows]
    .map((row) => row.map(csvCell).join(","))
    .join("\n") + "\n";
}

function pageMap(rows) {
  return new Map(rows.map((row) => [row.keys[0], row]));
}

function percent(value) {
  return `${(value * 100).toFixed(2)}%`;
}

function number(value) {
  return new Intl.NumberFormat("ko-KR", { maximumFractionDigits: 2 }).format(value || 0);
}

function delta(current, previous) {
  if (!previous) return null;
  return ((current - previous) / previous) * 100;
}

function reportMarkdown({ site, current, previous, pages, previousPages, queries, generated }) {
  const previousByPage = pageMap(previousPages);
  const withPrevious = pages.map((row) => ({
    ...row,
    previous: previousByPage.get(row.keys[0]),
  }));
  const top = [...withPrevious].sort((a, b) => b.clicks - a.clicks).slice(0, 15);
  const ctrOpportunities = withPrevious
    .filter((row) => row.impressions >= 100 && row.ctr < 0.03)
    .sort((a, b) => b.impressions - a.impressions)
    .slice(0, 15);
  const declining = withPrevious
    .filter((row) => row.previous?.clicks >= 5 && row.clicks < row.previous.clicks)
    .sort((a, b) => (delta(a.clicks, a.previous.clicks) ?? 0) - (delta(b.clicks, b.previous.clicks) ?? 0))
    .slice(0, 15);
  const risingQueries = [...queries]
    .filter((row) => row.impressions >= 20)
    .sort((a, b) => b.clicks - a.clicks || b.impressions - a.impressions)
    .slice(0, 30);

  const pageTable = (items) => items.length
    ? items.map((row) => {
      const change = row.previous?.clicks
        ? `${delta(row.clicks, row.previous.clicks).toFixed(1)}%`
        : "-";
      return `| ${row.keys[0]} | ${row.postFile || "-"} | ${number(row.clicks)} | ${number(row.impressions)} | ${percent(row.ctr)} | ${number(row.position)} | ${change} |`;
    }).join("\n")
    : "해당 항목 없음";

  return `# Google Search Console 통계 보고서

> 생성: ${generated}
> 속성: \`${site}\`
> 현재 기간: ${current.startDate} ~ ${current.endDate}
> 비교 기간: ${previous.startDate} ~ ${previous.endDate}

## 클릭 상위 페이지

| 페이지 | 저장소 글 | 클릭 | 노출 | CTR | 평균 순위 | 클릭 증감 |
|---|---|---:|---:|---:|---:|---:|
${pageTable(top)}

## CTR 개선 후보

노출 100회 이상, CTR 3% 미만인 페이지다. 검색 의도와 제목이 맞는지 먼저 확인한다.

| 페이지 | 저장소 글 | 클릭 | 노출 | CTR | 평균 순위 | 클릭 증감 |
|---|---|---:|---:|---:|---:|---:|
${pageTable(ctrOpportunities)}

## 클릭 하락 페이지

직전 동일 기간에 클릭이 5회 이상이었고 현재 클릭이 감소한 페이지다.

| 페이지 | 저장소 글 | 클릭 | 노출 | CTR | 평균 순위 | 클릭 증감 |
|---|---|---:|---:|---:|---:|---:|
${pageTable(declining)}

## 주요 검색어

| 검색어 | 페이지 | 저장소 글 | 클릭 | 노출 | CTR | 평균 순위 |
|---|---|---|---:|---:|---:|---:|
${risingQueries.length ? risingQueries.map((row) => `| ${row.keys[1]} | ${row.keys[0]} | ${row.postFile || "-"} | ${number(row.clicks)} | ${number(row.impressions)} | ${percent(row.ctr)} | ${number(row.position)} |`).join("\n") : "해당 항목 없음"}

## 해석 주의

- Search Console API는 모든 검색어 행을 보장하지 않고 주요 행을 반환할 수 있다.
- 평균 순위와 CTR은 노출 구성에 따라 변하므로 한 지표만으로 글의 품질을 단정하지 않는다.
- 새 글 추천은 이 보고서와 wiki 연결 공백, 기존 연재 흐름을 함께 본다.
`;
}

async function main() {
  const args = parseArgs(process.argv.slice(2));
  if (args.help) {
    console.log("사용법: node tools/search-console-stats.mjs [--auth-only] [--days 28] [--site sc-domain:example.com]");
    return;
  }
  const client = await loadClient();
  const token = await accessToken(client);
  const sites = await listSites(token);
  if (!sites.length) throw new Error("이 Google 계정에서 접근할 수 있는 Search Console 속성이 없습니다.");

  console.log("접근 가능한 Search Console 속성:");
  for (const site of sites) console.log(`- ${site.siteUrl} (${site.permissionLevel})`);
  if (args.authOnly) {
    console.log(`인증 토큰 저장 위치: ${tokenPath}`);
    return;
  }

  const site = selectSite(sites, args.site);
  const current = dateRange(args.days);
  const previous = previousRange(current, args.days);
  console.log(`통계 조회: ${site} / ${current.startDate} ~ ${current.endDate}`);

  const [rawPages, rawPreviousPages, rawQueries, postIndex] = await Promise.all([
    queryAll(token, site, { ...current, dimensions: ["page"] }),
    queryAll(token, site, { ...previous, dimensions: ["page"] }),
    queryAll(token, site, { ...current, dimensions: ["page", "query"] }),
    loadPublishedPostIndex(),
  ]);
  const pages = attachPostFiles(rawPages, postIndex);
  const previousPages = attachPostFiles(rawPreviousPages, postIndex);
  const queries = attachPostFiles(rawQueries, postIndex);

  await fs.mkdir(dataDir, { recursive: true });
  const stamp = formatDate(new Date());
  await fs.writeFile(
    path.join(dataDir, `${stamp}-google-pages.csv`),
    toCsv(
      ["page", "post_file", "clicks", "impressions", "ctr", "position"],
      pages.map((row) => [row.keys[0], row.postFile, row.clicks, row.impressions, row.ctr, row.position]),
    ),
  );
  await fs.writeFile(
    path.join(dataDir, `${stamp}-google-page-queries.csv`),
    toCsv(
      ["page", "post_file", "query", "clicks", "impressions", "ctr", "position"],
      queries.map((row) => [row.keys[0], row.postFile, row.keys[1], row.clicks, row.impressions, row.ctr, row.position]),
    ),
  );
  const report = reportMarkdown({
    site,
    current,
    previous,
    pages,
    previousPages,
    queries,
    generated: new Date().toISOString(),
  });
  const reportPath = path.join(outputDir, `${stamp}-report.md`);
  await fs.writeFile(reportPath, report);
  await fs.writeFile(path.join(outputDir, "latest-summary.md"), report);
  console.log(`완료: ${reportPath}`);
}

main().catch((error) => {
  console.error(error.message);
  process.exitCode = 1;
});
