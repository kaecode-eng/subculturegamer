"""Import selected public posts from the WordPress REST API into posts/published/.

usage: python -I tools/import_posts_rest.py <repo_dir> <post_id> [<post_id> ...]
Requires: pip install markdownify ; curl on PATH. Public posts only (no login).
Find post IDs: https://subculturegamer.com/wp-json/wp/v2/posts?slug=<slug>&_fields=id
Writes YYYY-MM-DD-<slug>.md with the project frontmatter. Does not overwrite.
"""
import html
import json
import re
import subprocess
import sys
import time
import urllib.parse
import urllib.request
from pathlib import Path

import markdownify

B = "https://subculturegamer.com/wp-json/wp/v2"


def get(url):
    for attempt in range(5):
        out = subprocess.run(["curl", "-sS", "--max-time", "30", url], capture_output=True)
        try:
            return json.loads(out.stdout)
        except ValueError:
            time.sleep(2 * (attempt + 1))
    raise RuntimeError(f"no JSON from {url}: {out.stdout[:200]!r}")


def names(kind, ids):
    if not ids:
        return []
    d = get(f"{B}/{kind}?include={','.join(map(str, ids))}&per_page=100&_fields=id,name")
    m = {x["id"]: html.unescape(x["name"]) for x in d}
    return [m[i] for i in ids if i in m]


def q(xs):
    return "[" + ", ".join(json.dumps(x, ensure_ascii=False) for x in xs) + "]"


def main():
    repo = Path(sys.argv[1])
    out = repo / "posts" / "published"
    for pid in sys.argv[2:]:
        p = get(f"{B}/posts/{pid}?_fields=id,slug,link,date,title,content,categories,tags")
        slug = urllib.parse.unquote(p["slug"])
        date = p["date"][:10]
        path = out / f"{date}-{slug}.md"
        if path.exists():
            print("skip (exists)", path.name)
            continue
        body = markdownify.markdownify(p["content"]["rendered"], heading_style="ATX", bullets="-")
        body = re.sub(r"\n{3,}", "\n\n", body).strip() + "\n"
        title = html.unescape(p["title"]["rendered"])
        fm = [
            "---",
            f"title: {json.dumps(title, ensure_ascii=False)}",
            f"url: {urllib.parse.unquote(p['link'])}",
            f"published: {date}",
            f"categories: {q(names('categories', p['categories']))}",
            f"tags: {q(names('tags', p['tags']))}",
            "related_posts: []",
            "wiki_refs: []",
            'series: ""',
            "series_order: null",
            "---",
            "",
        ]
        path.write_text("\n".join(fm) + body, encoding="utf-8")
        print("wrote", path.name, len(body))


if __name__ == "__main__":
    main()
