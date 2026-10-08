import fs from "node:fs/promises";
import os from "node:os";
import path from "node:path";

const API_ROOT = "https://www.bing.com/webmaster/api.svc/json";
const DEFAULT_DAYS = 28;
const projectRoot = path.resolve(import.meta.dirname, "..");
const privateDir = path.join(
  process.env.LOCALAPPDATA || path.join(os.homedir(), "AppData", "Local"),
  "SubcultureGamerStats",
);
const keyPath = path.join(privateDir, "bing-api-key.txt");
const outputDir = path.join(projectRoot, "planning", "traffic");
const dataDir = path.join(outputDir, "data");

function parseArgs(argv) {
  const args = { days: DEFAULT_DAYS, site: null, listSites: false };
  for (let index = 0; index < argv.length; index += 1) {
    const value = argv[index];
    if (value === "--days") args.days = Number(argv[++index]);
    else if (value === "--site") args.site = argv[++index];
    else if (value === "--list-sites") args.listSites = true;
    else if (value === "--help") args.help = true;
    else throw new Error(`알 수 없는 옵션: ${value}`);
  }
  if (!Number.isInteger(args.days) || args.days < 1 || args.days > 180) {
    throw new Error("--days는 1~180 사이의 정수여야 합니다.");
  }
  return args;
}

function formatDate(date) {
  return date.toISOString().slice(0, 10);
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

async function loadApiKey() {
  const key = (await fs.readFile(keyPath, "utf8")).trim();
  if (!/^[A-Za-z0-9._~-]{16,512}$/.test(key)) {
    throw new Error(`Bing API 키 형식을 확인해 주세요: ${keyPath}`);
  }
  return key;
}

async function bingRequest(method, apiKey, params = {}) {
  const url = new URL(`${API_ROOT}/${method}`);
  for (const [name, value] of Object.entries(params)) url.searchParams.set(name, value);
  url.searchParams.set("apikey", apiKey);
  const response = await fetch(url, { headers: { accept: "application/json" } });
  const text = await response.text();
  let payload;
  try {
    payload = JSON.parse(text);
  } catch {
    throw new Error(`Bing API가 JSON이 아닌 응답을 반환했습니다 (${response.status}).`);
  }
  if (!response.ok || payload?.ErrorCode || payload?.d?.ErrorCode) {
    const error = payload?.Message || payload?.d?.Message || response.statusText;
    throw new Error(`Bing API ${method} 실패 (${response.status}): ${error}`);
  }
  return payload?.d ?? payload;
}

function selectSite(sites, requested) {
  const verified = sites.filter((site) => site.IsVerified);
  if (requested) {
    const match = verified.find((site) => normalizeUrl(site.Url) === normalizeUrl(requested));
    if (!match) throw new Error(`검증된 Bing 사이트에서 찾지 못했습니다: ${requested}`);
    return match.Url;
  }
  const preferred = verified.find((site) => site.Url.includes("subculturegamer.com"));
  if (preferred) return preferred.Url;
  if (verified.length === 1) return verified[0].Url;
  throw new Error(`사이트를 자동 선택할 수 없습니다. --site 옵션을 사용하세요.\n${verified.map((site) => site.Url).join("\n")}`);
}

function parseBingDate(value) {
  if (!value) return null;
  const match = String(value).match(/\/Date\((\d+)(?:[+-]\d+)?\)\//);
  if (match) return new Date(Number(match[1]));
  const date = new Date(value);
  return Number.isNaN(date.valueOf()) ? null : date;
}

function cutoffDate(days) {
  const cutoff = new Date();
  cutoff.setUTCHours(0, 0, 0, 0);
  cutoff.setUTCDate(cutoff.getUTCDate() - days + 1);
  return cutoff;
}

function aggregateStats(rows, days) {
  const cutoff = cutoffDate(days);
  const groups = new Map();
  for (const row of rows) {
    const date = parseBingDate(row.Date);
    if (date && date < cutoff) continue;
    const key = row.Query || "";
    if (!key) continue;
    const current = groups.get(key) || {
      key,
      clicks: 0,
      impressions: 0,
      clickPositionTotal: 0,
      impressionPositionTotal: 0,
      clickPositionWeight: 0,
      impressionPositionWeight: 0,
    };
    const clicks = Number(row.Clicks || 0);
    const impressions = Number(row.Impressions || 0);
    current.clicks += clicks;
    current.impressions += impressions;
    if (Number.isFinite(Number(row.AvgClickPosition)) && clicks > 0) {
      current.clickPositionTotal += Number(row.AvgClickPosition) * clicks;
      current.clickPositionWeight += clicks;
    }
    if (Number.isFinite(Number(row.AvgImpressionPosition)) && impressions > 0) {
      current.impressionPositionTotal += Number(row.AvgImpressionPosition) * impressions;
      current.impressionPositionWeight += impressions;
    }
    groups.set(key, current);
  }
  return [...groups.values()].map((row) => ({
    key: row.key,
    clicks: row.clicks,
    impressions: row.impressions,
    ctr: row.impressions ? row.clicks / row.impressions : 0,
    averageClickPosition: row.clickPositionWeight ? row.clickPositionTotal / row.clickPositionWeight : null,
    averageImpressionPosition: row.impressionPositionWeight
      ? row.impressionPositionTotal / row.impressionPositionWeight
      : null,
  }));
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

function csvCell(value) {
  const text = String(value ?? "");
  return /[",\r\n]/.test(text) ? `"${text.replace(/"/g, '""')}"` : text;
}

function toCsv(headers, rows) {
  return [headers, ...rows].map((row) => row.map(csvCell).join(",")).join("\n") + "\n";
}

function number(value) {
  return new Intl.NumberFormat("ko-KR", { maximumFractionDigits: 2 }).format(value || 0);
}

function percent(value) {
  return `${(value * 100).toFixed(2)}%`;
}

function reportMarkdown({ site, days, pages, queries, generated }) {
  const topPages = [...pages].sort((a, b) => b.clicks - a.clicks || b.impressions - a.impressions).slice(0, 20);
  const opportunities = [...pages]
    .filter((row) => row.impressions >= 20 && row.ctr < 0.03)
    .sort((a, b) => b.impressions - a.impressions)
    .slice(0, 20);
  const topQueries = [...queries].sort((a, b) => b.clicks - a.clicks || b.impressions - a.impressions).slice(0, 30);
  const pageRows = (items) => items.length
    ? items.map((row) => `| ${row.key} | ${row.postFile || "-"} | ${number(row.clicks)} | ${number(row.impressions)} | ${percent(row.ctr)} | ${number(row.averageImpressionPosition)} |`).join("\n")
    : "해당 항목 없음";

  return `# Bing Webmaster Tools 통계 보고서

> 생성: ${generated}
> 사이트: \`${site}\`
> 집계 범위: API가 반환한 데이터 중 최근 ${days}일

## 클릭 상위 페이지

| 페이지 | 저장소 글 | 클릭 | 노출 | CTR | 평균 노출 순위 |
|---|---|---:|---:|---:|---:|
${pageRows(topPages)}

## CTR 개선 후보

노출 20회 이상, CTR 3% 미만인 페이지다. Bing 데이터 규모가 작을 수 있으므로 Google 통계와 함께 해석한다.

| 페이지 | 저장소 글 | 클릭 | 노출 | CTR | 평균 노출 순위 |
|---|---|---:|---:|---:|---:|
${pageRows(opportunities)}

## 주요 검색어

| 검색어 | 클릭 | 노출 | CTR | 평균 노출 순위 |
|---|---:|---:|---:|---:|
${topQueries.length ? topQueries.map((row) => `| ${row.key} | ${number(row.clicks)} | ${number(row.impressions)} | ${percent(row.ctr)} | ${number(row.averageImpressionPosition)} |`).join("\n") : "해당 항목 없음"}

## 해석 주의

- Bing의 페이지·검색어 상세 통계는 주 단위로 갱신될 수 있다.
- Bing Search Performance와 Google Search Console은 집계 대상과 갱신 주기가 다르므로 수치를 직접 합산하지 않는다.
- 새 글 추천은 두 검색엔진의 방향성과 wiki 연결 공백을 함께 본다.
`;
}

async function main() {
  const args = parseArgs(process.argv.slice(2));
  if (args.help) {
    console.log("사용법: node tools/bing-webmaster-stats.mjs [--list-sites] [--days 28] [--site https://example.com/]");
    return;
  }
  const apiKey = await loadApiKey();
  const sites = await bingRequest("GetUserSites", apiKey);
  if (!Array.isArray(sites)) throw new Error("Bing 사이트 목록 응답 형식을 인식할 수 없습니다.");
  console.log("접근 가능한 Bing Webmaster 사이트:");
  for (const site of sites) console.log(`- ${site.Url} (${site.IsVerified ? "verified" : "unverified"})`);
  if (args.listSites) return;

  const site = selectSite(sites, args.site);
  const [pageRows, queryRows, postIndex] = await Promise.all([
    bingRequest("GetPageStats", apiKey, { siteUrl: site }),
    bingRequest("GetQueryStats", apiKey, { siteUrl: site }),
    loadPublishedPostIndex(),
  ]);
  if (!Array.isArray(pageRows) || !Array.isArray(queryRows)) {
    throw new Error("Bing 통계 응답 형식을 인식할 수 없습니다.");
  }
  const pages = aggregateStats(pageRows, args.days).map((row) => ({
    ...row,
    postFile: postIndex.get(normalizeUrl(row.key)) || "",
  }));
  const queries = aggregateStats(queryRows, args.days);

  await fs.mkdir(dataDir, { recursive: true });
  const stamp = formatDate(new Date());
  await fs.writeFile(
    path.join(dataDir, `${stamp}-bing-pages.csv`),
    toCsv(
      ["page", "post_file", "clicks", "impressions", "ctr", "average_impression_position", "average_click_position"],
      pages.map((row) => [row.key, row.postFile, row.clicks, row.impressions, row.ctr, row.averageImpressionPosition, row.averageClickPosition]),
    ),
  );
  await fs.writeFile(
    path.join(dataDir, `${stamp}-bing-queries.csv`),
    toCsv(
      ["query", "clicks", "impressions", "ctr", "average_impression_position", "average_click_position"],
      queries.map((row) => [row.key, row.clicks, row.impressions, row.ctr, row.averageImpressionPosition, row.averageClickPosition]),
    ),
  );
  const report = reportMarkdown({
    site,
    days: args.days,
    pages,
    queries,
    generated: new Date().toISOString(),
  });
  const reportPath = path.join(outputDir, `${stamp}-bing-report.md`);
  await fs.writeFile(reportPath, report);
  await fs.writeFile(path.join(outputDir, "latest-bing-summary.md"), report);
  console.log(`Bing 페이지 ${pages.length}개, 검색어 ${queries.length}개를 저장했습니다.`);
  console.log(`완료: ${reportPath}`);
}

main().catch((error) => {
  console.error(error.message);
  process.exitCode = 1;
});
