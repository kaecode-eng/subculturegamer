import { spawn } from "node:child_process";
import path from "node:path";

const DEFAULT_DAYS = 28;
const toolsDir = import.meta.dirname;

function parseArgs(argv) {
  let days = DEFAULT_DAYS;
  for (let index = 0; index < argv.length; index += 1) {
    const value = argv[index];
    if (value === "--days") days = Number(argv[++index]);
    else if (value === "--help") return { help: true, days };
    else throw new Error(`알 수 없는 옵션: ${value}`);
  }
  if (!Number.isInteger(days) || days < 1 || days > 180) {
    throw new Error("--days는 1~180 사이의 정수여야 합니다.");
  }
  return { help: false, days };
}

function run(scriptName, args) {
  return new Promise((resolve, reject) => {
    const child = spawn(process.execPath, [path.join(toolsDir, scriptName), ...args], {
      stdio: "inherit",
    });
    child.once("error", reject);
    child.once("exit", (code, signal) => {
      if (code === 0) resolve();
      else reject(new Error(`${scriptName} 실행 실패 (${signal || code})`));
    });
  });
}

async function main() {
  const args = parseArgs(process.argv.slice(2));
  if (args.help) {
    console.log("사용법: node tools/blog-stats.mjs [--days 28]");
    return;
  }

  console.log(`[1/2] Google Search Console 최근 ${args.days}일 수집`);
  await run("search-console-stats.mjs", ["--days", String(args.days)]);

  console.log(`\n[2/2] Bing Webmaster Tools 최근 ${args.days}일 수집`);
  await run("bing-webmaster-stats.mjs", ["--days", String(args.days)]);

  console.log("\nGoogle과 Bing 통계 갱신이 완료되었습니다.");
}

main().catch((error) => {
  console.error(error.message);
  process.exitCode = 1;
});
