# 창세기전 템페스트 허브 발행 준비 (2026-11-17)

- 근거: `planning/series-tracker.md`의 허브 예정 목록, `planning/taxonomy/2026-11-12-taxonomy-proposal.md` 2-6(추천 슬러그 `/genesis-tempest-series/`, 허브 이름 "창세기전 템페스트", 범위는 분석 4편, `tempest-post-mortem`은 허브에서 제외하고 태그만 유지 — 2026-11-12 사용자 결정)
- **발행 완료(2026-11-17).** 데스크톱 앱 세션에서 임시글로 저장한 뒤 사용자 확인을 거쳐 발행했다. 허브와 연결 글 끝 조각, 대표 이미지 설정을 공개 REST로 확인했고 허브 안 링크는 모두 200(리다이렉트 없음). `/register`로 `posts/published/`에 등록했다.

## 1. 파일

| 용도 | 파일 |
|---|---|
| 초안(검토용, frontmatter 포함) | `posts/drafts/2026-11-17-genesis-tempest-series.md` |
| 새 글 본문(코드 편집기에 붙여 넣기) | `posts/drafts/2026-11-17-genesis-tempest-series.html` |

- 데스크톱 세션에 넘길 때: `https://raw.githubusercontent.com/kaecode-eng/subculturegamer/main/<경로>` (병합 후)
- 본문은 humanize-korean(light)으로 윤문했다. 연결어미 뒤 쉼표 2곳을 고쳤고, 게이트가 남은 쉼표 2곳("따라가고,", "짚고,")을 경고해 직접 걷어냈다(문자 변경 약 0.2%).
- 사실 점검: 1998년·시리즈 4번째·최초 보이스·지루한 전투(1편), 한 달 단위 루프(3편, 달이 바뀌면 퀘스트 버튼), 미니게임 5종(3편 소제목), 히로인 8명/선택에 따라 9명(4편), 포스트모템 5개월(제목) 모두 원문 근거가 있다.
- 4편의 스포일러(9번째 히로인)를 도입부와 4편 소개에 경고했다.

## 2. 발행 설정

- 제목: 창세기전 템페스트 분석 시리즈: 트레이닝과 타로카드부터 히로인 9명까지
- 슬러그: `genesis-tempest-series` (2026-11-17 404 확인, 사용 중인 글·페이지 없음)
- 카테고리: 게임 분석 / 태그: 창세기전 템페스트
- 대표 이미지: **새로 필요**(다른 허브처럼 1:1 헤더 이미지)
- SEOPress 메타 설명(제안): 1998년 창세기전 외전: 템페스트를 기획자의 시선으로 다시 해부한 분석 글 4편 모음. 트레이닝과 타로카드, 퀘스트와 엔딩 분기, 히로인 9명까지 읽는 순서를 정리했다.
- 글 형식: **글(포스트)**로 발행(AGENTS.md 「연재와 허브」)

## 3. 4편에 넣을 "시리즈 목차 → 허브" 조각

허브가 위 슬러그로 발행된 **뒤에** 넣는다. 「함께 읽으면 좋은 글」에는 허브가 나오지 않으므로 AGENTS.md 규칙대로 넣는다. 위치는 4편 모두 **본문 맨 끝**이다(1편은 "(다음 편에 계속)", 2편은 "(다음 글에 계속)" 문단 뒤). 포스트모템(4176)에는 넣지 않는다.

| ID | 글 |
|---|---|
| 1596 | 창세기전 외전 템페스트 게임 분석 1편 |
| 1616 | 창세기전 외전 템페스트 게임 분석 2편 |
| 1628 | 창세기전 외전 템페스트 게임 분석 3편 |
| 1687 | 창세기전 「템페스트」 캐릭터 분석 |

```html
<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>이 글은 「창세기전 템페스트 분석」 시리즈에 포함된 글이다. 시리즈 전체 구성과 읽는 순서는 <a href="https://subculturegamer.com/genesis-tempest-series/">창세기전 템페스트 분석 시리즈 안내 글</a>에서 한눈에 볼 수 있다.</p>
<!-- /wp:paragraph -->
```

## 4. 발행 후 할 일

1. 허브를 `/register`로 저장소에 등록하고 `wiki/series-threads/genesis-tempest-analysis-series`, `wiki/games/genesis-tempest`에 연결한다.
2. 4편에 3장 조각을 넣고 캐시 3종(객체·LiteSpeed·Cloudflare)을 비운다.
3. `planning/series-tracker.md`의 허브 예정 목록에서 창세기전 템페스트를 완료로 옮긴다.
