import requests
from bs4 import BeautifulSoup

headers = {"User-Agent": "Mozilla/5.0"}
resp = requests.get("https://subculturegamer.com/mda-framework/", headers=headers)
soup = BeautifulSoup(resp.text, "lxml")

print("=== H1 태그들 ===")
for h1 in soup.find_all("h1"):
    cls = str(h1.get("class"))
    text = h1.get_text(strip=True)[:80]
    print(f"  class={cls}, text={text}")

print("\n=== og:title ===")
og = soup.find("meta", property="og:title")
print(og.get("content") if og else "None")

print("\n=== 카테고리 관련 a 태그 ===")
for el in soup.select("a[rel='category tag'], [class*='categor'] a, [class*='cat-link'] a"):
    print(f"  text={el.get_text(strip=True)}")

print("\n=== 태그 관련 ===")
for el in soup.select("a[rel='tag'], [class*='tag'] a"):
    print(f"  text={el.get_text(strip=True)}")

print("\n=== 본문 div 클래스 후보 ===")
for div in soup.find_all("div", class_=True):
    cls = " ".join(div.get("class", []))
    if any(k in cls for k in ["entry", "content", "post-body", "article"]):
        length = len(div.get_text())
        print(f"  class={cls[:80]}, length={length}")
