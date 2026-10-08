"""모든 포스트의 frontmatter를 읽어서 요약 출력"""
import re
from pathlib import Path

POSTS_DIR = Path(__file__).parent / "posts" / "published"

def read_frontmatter(filepath):
    text = filepath.read_text(encoding="utf-8")
    m = re.match(r"^---\n(.*?)\n---", text, re.DOTALL)
    if not m:
        return {}
    fm = {}
    for line in m.group(1).splitlines():
        if ":" in line:
            k, _, v = line.partition(":")
            fm[k.strip()] = v.strip()
    return fm

posts = []
for f in sorted(POSTS_DIR.glob("*.md")):
    fm = read_frontmatter(f)
    posts.append({
        "slug": f.stem,
        "title": fm.get("title", "").strip('"'),
        "published": fm.get("published", ""),
        "tags": fm.get("tags", "[]"),
        "series": fm.get("series", "").strip('"'),
    })

# 날짜순 정렬
posts.sort(key=lambda x: x["published"])

import sys, io
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding="utf-8", errors="replace")

print(f"총 {len(posts)}개 포스트\n")
print("=== 전체 목록 (날짜순) ===")
for p in posts:
    tags = p['tags'][:38]
    print(f"{p['published']} | {tags:<40} | {p['title']}")
