import fs from "node:fs/promises";
import http from "node:http";
import os from "node:os";
import path from "node:path";

const host = "127.0.0.1";
const port = 8766;
const privateDir = path.join(
  process.env.LOCALAPPDATA || path.join(os.homedir(), "AppData", "Local"),
  "SubcultureGamerStats",
);
const keyPath = path.join(privateDir, "bing-api-key.txt");

const page = `<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="default-src 'none'; style-src 'unsafe-inline'; form-action 'self'; base-uri 'none'">
  <title>Bing API 키 저장</title>
  <style>
    body { font-family: system-ui, sans-serif; max-width: 640px; margin: 64px auto; padding: 0 24px; line-height: 1.6; }
    label { display: block; font-weight: 700; margin-bottom: 8px; }
    input { box-sizing: border-box; width: 100%; padding: 12px; font: inherit; }
    button { margin-top: 16px; padding: 10px 18px; font: inherit; font-weight: 700; }
    .note { color: #555; }
  </style>
</head>
<body>
  <h1>Bing Webmaster API 키 저장</h1>
  <p class="note">이 페이지는 이 PC의 127.0.0.1에서만 열립니다. 키는 채팅이나 프로젝트 저장소로 전송되지 않습니다.</p>
  <form method="post" action="/save" autocomplete="off">
    <label for="apiKey">기존 Bing Webmaster API 키</label>
    <input id="apiKey" name="apiKey" type="password" required minlength="16" maxlength="512" autofocus>
    <button type="submit">로컬에 저장</button>
  </form>
</body>
</html>`;

const server = http.createServer(async (request, response) => {
  if (request.method === "GET" && request.url === "/") {
    response.writeHead(200, {
      "content-type": "text/html; charset=utf-8",
      "cache-control": "no-store",
      pragma: "no-cache",
    });
    response.end(page);
    return;
  }

  if (request.method === "POST" && request.url === "/save") {
    let body = "";
    for await (const chunk of request) {
      body += chunk;
      if (body.length > 2048) {
        response.writeHead(413, { "content-type": "text/plain; charset=utf-8" });
        response.end("입력값이 너무 깁니다.");
        return;
      }
    }
    const apiKey = new URLSearchParams(body).get("apiKey")?.trim() || "";
    if (!/^[A-Za-z0-9._~-]{16,512}$/.test(apiKey)) {
      response.writeHead(400, { "content-type": "text/plain; charset=utf-8" });
      response.end("API 키 형식을 확인해 주세요.");
      return;
    }
    await fs.mkdir(privateDir, { recursive: true });
    await fs.writeFile(keyPath, apiKey, { mode: 0o600 });
    response.writeHead(200, {
      "content-type": "text/html; charset=utf-8",
      "cache-control": "no-store",
    });
    response.end("<meta charset='utf-8'><title>저장 완료</title><h1>API 키를 로컬에 저장했습니다.</h1><p>이 창을 닫아도 됩니다.</p>");
    console.log(`Bing API 키 저장 완료: ${keyPath}`);
    setTimeout(() => server.close(), 250);
    return;
  }

  response.writeHead(404, { "content-type": "text/plain; charset=utf-8" });
  response.end("Not found");
});

server.listen(port, host, () => {
  console.log(`Bing API 키 입력 페이지: http://${host}:${port}/`);
});

server.on("error", (error) => {
  console.error(error.message);
  process.exitCode = 1;
});
