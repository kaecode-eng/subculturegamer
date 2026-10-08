"""
subculturegamer.com 블로그 포스트 전체 import 스크립트
posts/published/ 에 마크다운 파일로 저장
"""

import requests
from bs4 import BeautifulSoup
import markdownify
import xml.etree.ElementTree as ET
from pathlib import Path
import re
import time
import sys

BASE_DIR = Path(__file__).parent
OUTPUT_DIR = BASE_DIR / "posts" / "published"
OUTPUT_DIR.mkdir(parents=True, exist_ok=True)

HEADERS = {
    "User-Agent": "Mozilla/5.0 (compatible; SubcultureGamer-Importer/1.0)"
}


def get_all_urls():
    """post-sitemap.xml에서 모든 포스트 URL 수집 (중복 제거)"""
    seen = set()
    sitemap_url = "https://subculturegamer.com/post-sitemap.xml"

    resp = requests.get(sitemap_url, headers=HEADERS, timeout=10)
    resp.raise_for_status()

    root = ET.fromstring(resp.content)
    ns = {"sm": "http://www.sitemaps.org/schemas/sitemap/0.9"}

    urls = []
    for loc in root.findall(".//sm:loc", ns):
        url = loc.text
        if url and url not in seen:
            seen.add(url)
            urls.append(url)

    print(f"  총 {len(urls)}개 고유 URL 발견")
    return urls


def slug_from_url(url):
    """URL에서 슬러그 추출"""
    url = url.rstrip("/")
    return url.split("/")[-1]


def parse_post(url):
    """포스트 페이지를 파싱해서 메타데이터와 본문 반환"""
    resp = requests.get(url, headers=HEADERS, timeout=15)
    resp.raise_for_status()
    soup = BeautifulSoup(resp.text, "lxml")

    # 제목: og:title 우선 (h1은 사이트 제목)
    og_title = soup.find("meta", property="og:title")
    title = og_title.get("content", "").strip() if og_title else ""
    if not title:
        title = slug_from_url(url)

    # 발행일
    date = ""
    date_el = soup.find("time")
    if date_el:
        date = date_el.get("datetime", date_el.get_text(strip=True))[:10]

    # 카테고리
    categories = []
    for el in soup.select("a[rel='category tag']"):
        categories.append(el.get_text(strip=True))
    for el in soup.select(".cat-links a, .entry-categories a"):
        categories.append(el.get_text(strip=True))
    categories = list(dict.fromkeys(categories))

    # 태그
    tags = []
    for el in soup.select("a[rel='tag']"):
        tags.append(el.get_text(strip=True))
    for el in soup.select(".tags-links a, .entry-tags a"):
        tags.append(el.get_text(strip=True))
    # 카테고리와 겹치는 태그 제거
    tags = [t for t in dict.fromkeys(tags) if t not in categories]

    # 본문
    content_el = soup.find("div", class_=re.compile(r"entry-content|post-content"))
    if not content_el:
        content_el = soup.find("article")

    if content_el:
        for el in content_el.select("style, script, .sharedaddy, .jp-relatedposts, nav, .navigation, ins, .wpcnt"):
            el.decompose()
        content_md = markdownify.markdownify(str(content_el), heading_style="ATX", bullets="-")
    else:
        content_md = ""

    content_md = re.sub(r"\n{3,}", "\n\n", content_md).strip()
    # base64 이미지 정리
    content_md = re.sub(r"!\[([^\]]*)\]\(data:image[^)]+\)", "", content_md)

    return {
        "title": title,
        "url": url,
        "published": date,
        "categories": categories,
        "tags": tags,
        "content": content_md,
    }


def save_post(data, force=False):
    """파싱된 포스트를 마크다운 파일로 저장"""
    slug = slug_from_url(data["url"])
    filepath = OUTPUT_DIR / f"{slug}.md"

    # 이미 있으면 스킵 (force 모드 제외)
    if filepath.exists() and not force:
        return filepath, False

    cats = str(data["categories"]).replace("'", '"')
    tags = str(data["tags"]).replace("'", '"')

    frontmatter = f"""---
title: "{data['title'].replace('"', "'")}"
url: {data['url']}
published: {data['published']}
categories: {cats}
tags: {tags}
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

"""
    filepath.write_text(frontmatter + data["content"], encoding="utf-8")
    return filepath, True


def main():
    force = "--force" in sys.argv
    print(f"=== SubcultureGamer 블로그 Import {'(강제 재처리)' if force else ''} ===\n")

    print("1) 사이트맵에서 URL 수집 중...")
    urls = get_all_urls()
    print(f"   총 {len(urls)}개 URL 발견\n")

    if not urls:
        print("URL을 찾지 못했습니다.")
        sys.exit(1)

    success, skipped, failed = 0, 0, []

    print("2) 포스트 크롤링 중...\n")
    for i, url in enumerate(urls, 1):
        slug = slug_from_url(url)

        # 홈페이지 URL 스킵
        if not slug or slug == "subculturegamer.com":
            skipped += 1
            continue

        try:
            data = parse_post(url)
            filepath, is_new = save_post(data, force=force)

            if is_new:
                print(f"  [{i:3}/{len(urls)}] ✓ {slug}")
                success += 1
            else:
                print(f"  [{i:3}/{len(urls)}] - {slug} (이미 존재)")
                skipped += 1

            time.sleep(0.5)  # 서버 부하 방지

        except Exception as e:
            print(f"  [{i:3}/{len(urls)}] ✗ {slug}: {e}")
            failed.append(url)

    print(f"\n=== 완료 ===")
    print(f"  성공: {success}개")
    print(f"  스킵: {skipped}개")
    print(f"  실패: {len(failed)}개")

    if failed:
        print("\n실패한 URL:")
        for url in failed:
            print(f"  - {url}")

    print(f"\n저장 위치: {OUTPUT_DIR}")


if __name__ == "__main__":
    main()
