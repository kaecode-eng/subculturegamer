# 홈 「대표 연재글」 캐러셀 화살표 지연 진단 (2026-11-17)

- 대상: 홈(`/`)의 `.sg-three` 캐러셀 3개(「대표 연재글」 포함)의 ‹ › 화살표와 `.sg-autoplay` 자동 넘김
- 배경: `docs/handoff-2026-11-12.md` 2장 C "대표 연재글 캐러셀 화살표 지연(LiteSpeed) 수정"
- **사이트 미적용.** 클라우드 세션은 WordPress 쓰기가 막혀 있고, 캐러셀 코드는 저장소에 없다(사이트의 Code Snippets 또는 테마 쪽에 있는 것으로 보인다).

## 1. 원인

화살표를 만드는 인라인 스크립트(`document.querySelectorAll('.sg-three')…`)와 자동 넘김 스크립트(`document.querySelector('.sg-autoplay')…`)에 LiteSpeed가 `type="litespeed/javascript"`를 붙여 **JS 지연(Delayed)** 대상으로 만들었다. 지연 스크립트는 두 단계로 늦어진다.

1. **방문자의 첫 조작을 기다린다.** LiteSpeed 로더는 `mouseover`, `click`, `keydown`, `wheel`, `touchmove`, `touchstart`, `pointerup`, `pointerdown` 중 하나가 일어나야 지연 스크립트를 실행하기 시작한다. 시간 제한으로 강제 실행하는 장치는 없다. 휴대폰에서는 첫 터치 전까지 화살표가 없고 자동 넘김도 돌지 않는다.
2. **시작된 뒤에도 한 줄로 기다린다.** 지연 스크립트 14개를 순서대로 하나씩 내려받아 실행하는데, 캐러셀 스크립트는 13·14번째다. 앞에 Google 태그(`googletagmanager.com/gtag/js`), Google 로그인 클라이언트(`accounts.google.com/gsi/client`), Site Kit, Content Views, 스크롤 버튼 스크립트가 있다.

맨 위 「최신 글」 슬라이더(`<script id="sg-hero-js" data-no-optimize="1" data-no-defer="1">`)는 지연 대상에서 빠져 있어 이 문제가 없다. 같은 처리가 `.sg-three`, `.sg-autoplay` 스크립트에는 빠져 있는 것이 원인이다.

## 2. 측정 (Playwright, 실사이트, 2026-11-17)

| 조건 | 결과 |
|---|---|
| 데스크톱, 조작 없음 | 브라우저가 페이지를 그리며 보내는 `mouseover`(약 1.0초)로 지연 로딩 시작 → 화살표는 약 **3.4초**에 생김(DOMContentLoaded 약 1.1초 뒤 2.3초 더 기다림) |
| iPhone 13 에뮬레이션, 같은 조건 | 화살표 약 **3.9초** |
| iPhone 13, **조작 이벤트 없음**(실제 휴대폰에서 터치 전 상태 재현) | 8초가 지나도 **화살표 0개, 자동 넘김 꺼짐**, 지연 스크립트 14개 그대로 |
| 위와 같은 조건 + 두 스크립트에 `data-no-optimize="1" data-no-defer="1"`을 붙인 사본 | DOMContentLoaded(약 1.1초) 시점에 **화살표 6개 생성**, 자동 넘김 켜짐, 나머지 지연 스크립트 12개는 그대로 지연 |

## 3. 수정 방법

둘 중 하나만 하면 된다. **A를 권장**한다. 실제로 검증한 방법이고, 이미 「최신 글」 슬라이더에 쓰는 방식과 같다.

### A. 스크립트 태그에 지연 제외 속성 붙이기 (권장)

1. 관리자 화면에서 `sg-hero-js`를 출력하는 곳을 찾는다. Code Snippets 목록에서 `sg-three` 또는 `sg-hero`로 검색하거나, 테마 템플릿(외모 → 편집기)의 사용자 정의 HTML 블록을 본다.
2. `.sg-three` 스크립트와 `.sg-autoplay` 스크립트의 여는 태그를 `sg-hero-js`와 같게 바꾼다.
   - 바꾸기 전: `<script>` (PHP라면 `wp_print_inline_script_tag()`/`wp_add_inline_script()` 등)
   - 바꾼 뒤: `<script data-no-optimize="1" data-no-defer="1">`
   - `wp_print_inline_script_tag( $js, array( 'data-no-optimize' => '1', 'data-no-defer' => '1' ) )`처럼 속성 배열로 넘겨도 된다.
3. LiteSpeed 캐시 전체 비우기 → Cloudflare 캐시 비우기.

### B. LiteSpeed 설정에서 제외하기 (코드를 못 찾을 때)

1. LiteSpeed Cache → 페이지 최적화 → (튜닝) **JS 지연/연기 제외(JS Deferred / Delayed Excludes)**에 아래 두 줄을 추가한다. 인라인 스크립트는 내용에 이 문자열이 있으면 제외된다.
   ```
   sg-three
   sg-autoplay
   ```
2. LiteSpeed 캐시 전체 비우기 → Cloudflare 캐시 비우기.
3. B는 설정 이름·동작이 LiteSpeed 버전에 따라 다를 수 있어 이 세션에서 직접 검증하지 못했다. 적용 후 4장 확인을 꼭 한다.

### 주의

- 두 스크립트는 jQuery 등 다른 스크립트에 의존하지 않는 순수 JS이고 캐러셀 마크업 뒤(푸터)에 있어, 지연을 풀어도 실행 순서 문제가 없다.
- 다른 지연 스크립트(Google 태그·광고·로그인 등)는 그대로 두어야 페이지 속도 점수가 유지된다. 제외는 이 두 개만 한다.

## 4. 적용 후 확인

- 클라우드 세션에서: 홈 HTML에서 두 스크립트에 `type="litespeed/javascript"`가 없어졌는지, Playwright로 "조작 이벤트 없는 휴대폰" 조건에서 DOMContentLoaded 시점에 `.sg-three .sg-nav-btn`이 생기는지 확인한다(이 문서 2장과 같은 방법).
- 사람이: 휴대폰에서 홈을 열고 화면을 건드리지 않은 채 「대표 연재글」까지 내려가 › 화살표가 바로 보이는지, 7초 뒤 자동으로 넘어가는지 본다. 단, 스크롤 자체가 터치라 지연 로딩이 시작되므로, 화살표가 "스크롤 직후 바로" 보이면 정상이다.

## 5. 함께 본 것 (선택)

- 측정용 스크린샷(iPhone 13 에뮬레이션)에서 캐러셀 두 번째 카드의 대표 이미지가 연보라 바탕으로만 보였다. LiteSpeed 지연 로드(lazyload)가 가로 스크롤 영역의 이미지를 늦게 불러오는 것으로 추정하지만 원인은 확인하지 못했다. 실제 휴대폰에서도 같은지 한 번 봐 두면 좋다.
