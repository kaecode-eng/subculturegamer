# 붕괴: 스타레일 허브 발행 준비 (2026-11-17)

- 근거: `planning/series-tracker.md`의 허브 예정 목록, `planning/taxonomy/2026-11-12-taxonomy-proposal.md` 2-6(추천 슬러그 `/honkai-starrail-series/`, 태그 붕괴: 스타레일 = 8편으로 허브 범위와 같음)
- **발행 완료(2026-11-17).** 데스크톱 앱 세션에서 임시글로 저장한 뒤 사용자 확인을 거쳐 발행했다. 허브와 연결 글 끝 조각, 대표 이미지 설정을 공개 REST로 확인했고 허브 안 링크는 모두 200(리다이렉트 없음). `/register`로 `posts/published/`에 등록했다.

## 1. 파일

| 용도 | 파일 |
|---|---|
| 초안(검토용, frontmatter 포함) | `posts/drafts/2026-11-17-honkai-starrail-series.md` |
| 새 글 본문(코드 편집기에 붙여 넣기) | `posts/drafts/2026-11-17-honkai-starrail-series.html` |

- 데스크톱 세션에 넘길 때: `https://raw.githubusercontent.com/kaecode-eng/subculturegamer/main/<경로>` (병합 후)
- 본문은 humanize-korean(light)으로 윤문했다. 연결어미 뒤 쉼표 6곳만 고쳤고 게이트 통과(문자 변경 약 0.5%).
- 사실 점검: 매출 3위는 원문대로 "국내 구글 플레이", 페나코니는 "TGA 2023 영상에서 출발" 표현으로 맞췄다. 분석 기준 버전(2023년 5월 출시 직후, 1.5 버전, 2024년 4월)을 도입부에 적었다.

## 2. 발행 설정

- 제목: 붕괴: 스타레일 분석 시리즈: 온보딩부터 필살기 연출, 캐릭터 흥행 공식까지
- 슬러그: `honkai-starrail-series` (2026-11-17 404 확인, 사용 중인 글·페이지 없음)
- 카테고리: 게임 분석 / 태그: 붕괴: 스타레일
- 대표 이미지: **새로 필요**(다른 허브처럼 1:1 헤더 이미지)
- SEOPress 메타 설명(제안): 붕괴: 스타레일을 기획자의 시선으로 해부한 분석 글 8편 모음. 첫 15분 온보딩, 미리환야담 이벤트, 필살기 연출, 반디 컨셉 아트, 아케론 흥행 공식, 페나코니 상징까지 읽는 순서를 정리했다.
- 글 형식: 고정 페이지가 아니라 **글(포스트)**로 발행(AGENTS.md 「연재와 허브」)

## 3. 8편에 넣을 "시리즈 목차 → 허브" 조각

허브가 위 슬러그로 발행된 **뒤에** 넣는다(먼저 넣으면 링크가 404). 「함께 읽으면 좋은 글」에는 허브가 나오지 않으므로 AGENTS.md 규칙대로 넣는다. 위치는 8편 모두 **본문 맨 끝**이다(온보딩 1·2편은 "N편에 계속." 문단 뒤, 페나코니는 "마지막으로, 좋은 꿈 꾸세요." 뒤).

| ID | 글 |
|---|---|
| 919 | 붕괴: 스타레일 온보딩 경험 분석 1편 |
| 960 | 붕괴: 스타레일 온보딩 경험 분석 2편 |
| 992 | 붕괴: 스타레일 온보딩 경험 분석 3편 |
| 2189 | 붕괴: 스타레일 이벤트 시스템 분석 – 미리환야담 해부하기 |
| 2725 | 『붕괴: 스타레일』 필살기 연출 분석 |
| 3871 | 「스타레일」 반디 컨셉 아트 8요소 분석 |
| 2945 | 아케론이 증명한 스타 시스템의 흥행 공식 |
| 3200 | 화합의 도시 「페나코니」의 메타포 분석 |

```html
<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>이 글은 「붕괴: 스타레일 분석」 시리즈에 포함된 글이다. 시리즈 전체 구성과 읽는 순서는 <a href="https://subculturegamer.com/honkai-starrail-series/">붕괴: 스타레일 분석 시리즈 안내 글</a>에서 한눈에 볼 수 있다.</p>
<!-- /wp:paragraph -->
```

## 4. 발행 후 할 일

1. 허브를 `/register`로 저장소에 등록하고 `wiki/games/honkai-star-rail`에 연결한다.
2. 8편에 3장 조각을 넣고 캐시 3종(객체·LiteSpeed·Cloudflare)을 비운다.
3. `planning/series-tracker.md`의 허브 예정 목록에서 붕괴: 스타레일을 완료로 옮긴다.
