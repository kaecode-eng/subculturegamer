# 포트폴리오 가이드 내부 링크 작업 (2026-11-17)

- 대상: 「서류전형 통과하는 게임잡 포트폴리오 작성 방법」 `/narrative-designer-portfolio-guide/` (ID 24389, 커리어, 태그 취업·이직)
- 배경: `docs/handoff-2026-11-12.md` 2장 C — 10/13~11/9 세션 +19%의 최대 요인, "게임 포트폴리오" 평균 3.9위. 노출 +20% 대비 CTR 하락 점검 필요
- **사이트 미적용.** 클라우드 세션의 REST 쓰기가 401이라(`docs/work-context.md`), 붙여 넣을 블록 HTML만 만들었다.

## 1. 현재 상태 (2026-11-17 공개 REST 기준)

- 포트폴리오 가이드에서 나가는 내부 링크: 1편 이력서 글 2개(임베드 + 본문)뿐. 「다음 글 예고」에 3편 링크가 없다(3편은 2026-07-11 공개).
- 포트폴리오 가이드로 들어오는 링크: 3편 면접 전략 글 1곳뿐. **1편 이력서 글에는 내부 링크가 하나도 없다.** 수습 회고, 포트폴리오 리뷰(`how-they-design-the-success-game`), 스텔라 나이츠, AI 생존 가이드, 설정 기획 가이드도 이 글로 링크하지 않는다.
- 같은 문단이 두 번씩 나오는 곳 6군데: 인용 블록 바로 뒤에 같은 문장이 일반 문단으로 반복된다(재지원, 이전 회사 작업물, 오리지날 포트폴리오, 출시 게임 기반, 노션 페이지, 들어가는 글의 안내문).
- 검색어(2026-09-27 저장 데이터, 최근 데이터는 저장소에 없음): 페이지 전체 CTR 9.5%·평균 7.4위. "게임 포트폴리오" CTR 5.9%. **"포트폴리오 예시" 계열 검색어가 6개**(게임 시나리오 포트폴리오 예시, 게임 기획자 포트폴리오 예시, 게임 기획서 포트폴리오 예시 등)인데 본문에는 예시 글로 가는 링크가 없었다.

## 2. 포트폴리오 가이드 수정본

- 파일: `posts/drafts/2026-11-17-narrative-designer-portfolio-guide-update.html` (블록 HTML, 본문 전체 대체)
- 추가한 링크 5곳

| # | 위치 | 링크 대상 | 이유 |
|---|---|---|---|
| L1 | 「‘실무 능력’을 증명할 수 있는 포트폴리오」, 세계관/설정 준비 부담 문단 뒤 | 게임 설정 기획 실무 가이드 3가지 | 설정 준비 방법을 묻는 독자의 다음 행동 |
| L2 | 「지원하는 프로젝트와 유사한 점이 많은 게임의 포트폴리오」, 벤치마킹 문단 뒤 | 포트폴리오 리뷰(신입 분석서 원문), 스텔라 나이츠 면접 과제 | "포트폴리오 예시" 검색 의도에 직접 대응 |
| L3 | 「AI 활용 능력을 실무에 접목한 포트폴리오」, A4 20페이지 문단 뒤 | AI 시대, 게임 내러티브 기획자는 무엇을 해야 할까 | AI 포트폴리오의 배경 설명 |
| L4 | 「다음 글 예고」 마지막 문장 | 3편 면접 전략 | 공개된 다음 글을 예고만 하고 링크하지 않았음 |
| N2 | 글 맨 끝(구분선 뒤) | 1편·3편·수습 회고 | 연재 안내. 허브가 없어 연재 목록을 직접 적음 |

- 함께 고친 것: 인용 뒤 중복 문단 10개 삭제(인용 블록은 유지), H2 앞 여백 + 구분선 + 여백(SEP 규칙) 정리.
- 새 문장은 humanize-korean(light)으로 점검했다. 변경 0건, 게이트는 "쉼표 사이 구간 길이" 목표 미달 경고 1건(연재 안내 고정 문구 때문, 의미·사실 이상 없음).
- 분량: 공백 제외 약 8,800자 → 약 8,500자(중복 삭제분이 추가분보다 많음).

## 3. 다른 글에 넣을 조각

각 조각은 해당 글 편집기의 코드 편집기에서 지정 위치에 붙여 넣는다.

### R1 — 1편 이력서 글, "서류 합격 여부는 ‘포트폴리오’로 갈린다." 문단 뒤

```html
<!-- wp:paragraph -->
<p>포트폴리오를 어떻게 만들어야 서류를 통과하는지는 <a href="https://subculturegamer.com/narrative-designer-portfolio-guide/">서류전형 통과하는 게임잡 포트폴리오 작성 방법</a>에서 자세히 다뤘다.</p>
<!-- /wp:paragraph -->
```

### N1 — 1편 이력서 글 맨 끝, 연재 안내

```html
<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>이 글은 「내러티브 기획자 취업 가이드」 시리즈의 1편이다. 1편 이력서 작성 방법(이 글) → 2편 <a href="https://subculturegamer.com/narrative-designer-portfolio-guide/">포트폴리오 작성 방법</a> → 3편 <a href="https://subculturegamer.com/narrative-designer-interview-guide/">면접 전략</a> 순서로 읽으면 서류부터 면접까지 한 흐름으로 볼 수 있다. 합격한 뒤의 이야기는 <a href="https://subculturegamer.com/game-company-probation-period-retrospective/">수습 기간 3개월 회고</a>로 이어진다.</p>
<!-- /wp:paragraph -->
```

### N3 — 3편 면접 전략 글 맨 끝, 연재 안내

```html
<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>이 글은 「내러티브 기획자 취업 가이드」 시리즈의 3편이다. 1편 <a href="https://subculturegamer.com/gamejob-resume-tips/">이력서 작성 방법</a> → 2편 <a href="https://subculturegamer.com/narrative-designer-portfolio-guide/">포트폴리오 작성 방법</a> → 3편 면접 전략(이 글) 순서로 읽으면 서류부터 면접까지 한 흐름으로 볼 수 있다. 합격한 뒤의 이야기는 <a href="https://subculturegamer.com/game-company-probation-period-retrospective/">수습 기간 3개월 회고</a>로 이어진다.</p>
<!-- /wp:paragraph -->
```

### N4 — 수습 기간 회고 글 맨 끝, 연재 안내

```html
<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>이 글은 「내러티브 기획자 취업 가이드」 시리즈의 후속 회고다. 합격하기까지의 과정은 1편 <a href="https://subculturegamer.com/gamejob-resume-tips/">이력서 작성 방법</a> → 2편 <a href="https://subculturegamer.com/narrative-designer-portfolio-guide/">포트폴리오 작성 방법</a> → 3편 <a href="https://subculturegamer.com/narrative-designer-interview-guide/">면접 전략</a>에 차례로 정리해 두었다.</p>
<!-- /wp:paragraph -->
```

### P1 — 포트폴리오 리뷰 글(how-they-design-the-success-game) 맨 끝

```html
<!-- wp:paragraph -->
<p>이 분석서 하나만이 아니라 포트폴리오 전체를 어떻게 구성하고 어떤 순서로 넣을지는 <a href="https://subculturegamer.com/narrative-designer-portfolio-guide/">서류전형 통과하는 게임잡 포트폴리오 작성 방법</a>에 정리해 두었다.</p>
<!-- /wp:paragraph -->
```

## 4. CTR 점검과 제안 (선택)

최근 4주 Search Console 데이터가 저장소에 없어 하락 폭은 확인하지 못했다. 링크를 반영하고 2~4주 뒤 Windows에서 `node tools/blog-stats.mjs --days 28`로 다시 비교한다.

- 메타 설명(SEOPress)이 139자로 길고, 앞부분이 질문형이라 핵심이 검색 결과에서 잘린다. 제안: "내러티브 기획자가 6개월 구직 끝에 3N 서류를 통과한 포트폴리오 작성법. 시간만 버린 방법 3가지와 서류를 통과한 구성, 실제 포트폴리오 예시까지 정리했다." — 6개월·3N·예시는 모두 본문 근거가 있다(예시는 L2 링크 반영 후에만 사실).
- 제목은 그대로 둔다. 평균 순위가 상위권이라 제목을 바꾸면 순위가 흔들릴 수 있다. 바꾼다면 "예시"를 덧붙이는 정도만 검토한다.

## 5. 범위 밖 발견 (수정하지 않음)

- 필자 문체(P0): 포트폴리오 가이드에 글쓴이 자신을 가리키는 "나는 ‘내러티브’ 직군이다보니", "내 작업물을 재가공하거나", "‘내 작품’" 등이 남아 있다. 3편 면접 전략에도 "다만 내가 통제할 수 있는 유일한 영역은 준비였고" 등이 있다. 지원자 일반을 가리키는 "내가"(예: “내가 이런 일을 했다”)와 구분해 따로 고칠지 결정이 필요하다.
- 2026-11-16에 비공개였던 68·445·352·19510이 2026-11-17 현재 모두 공개(200) 상태다. `planning/taxonomy/2026-11-16-private-posts-tags.md`, `planning/2026-11-16-directing-merge-into-25.md`의 전제가 바뀌었으니 `/register`와 함께 다시 정한다.
