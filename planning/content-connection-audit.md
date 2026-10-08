# 콘텐츠 연결성 전수 분석

> 2026-07-17 · `posts/published/` 166개 글 기준

## 결론

블로그의 문제는 콘텐츠 부족이 아니라 관계 데이터의 부재와 범용 링크의 과다 사용이다.

- 166개 글 중 `related_posts`와 `wiki_refs`가 채워진 글은 극소수다.
- 퀘스트 디자인, 나니노벨, 게임 모션 기획처럼 순서가 명확한 시리즈도 대부분 `series`, `series_order`가 비어 있다.
- 본문에는 내부 링크가 존재하지만, 다수 글에서 `MDA 프레임워크`와 `Zero에서 시작하는 게임 디자인`으로 반복된다. 이 링크는 입문 허브로는 유효하지만, 모든 글의 하단 연관글로 쓰면 독자의 다음 행동을 안내하지 못한다.

따라서 모든 글을 서로 연결하지 않는다. 각 글에는 **같은 독자 의도**를 가진 다음 글 2~4개만 연결하고, 그 묶음마다 한 개의 허브를 둔다.

## 우선순위

| 우선순위 | 작업 | 독자 효과 |
|---|---|---|
| P0 | 이미 완성된 시리즈의 순서·양방향 연결 복원 | 한 편으로 들어온 독자가 처음부터 끝까지 읽음 |
| P1 | 실무·커리어·AI의 큰 묶음에 허브 만들기 | 검색 유입을 다음 글로 전환 |
| P2 | 게임 분석을 설계 주제별로 횡단 연결 | 개별 리뷰를 포트폴리오형 분석 자산으로 전환 |
| P3 | 일상·단발 콘텐츠는 엄선된 연결만 유지 | 그래프 잡음과 억지 링크 감소 |

## P0: 즉시 정식 시리즈로 등록할 글

**반영 완료 (2026-07-17)** — 아래 6개 묶음, 총 28개 글에 `series`, `series_order`, `related_posts`, `wiki_refs`를 기록하고 시리즈 허브를 연결했다.

### 퀘스트 디자인 6부작

`퀘스트 디자인` · 순서 1~6 · 허브: `wiki/series-threads/quest-design-series.md`

1. `why-quest-design-is-important.md`
2. `types-of-quest-design.md`
3. `what-makes-a-good-quest-design-witcher-3.md`
4. `game-quest-design-episode-planning-guide.md`
5. `game-quest-design-episode-planning-guide-2.md`
6. `game-quest-design-episode-planning-guide-3.md`

각 편은 직전·직후 편과 허브를 연결한다. 4~6편은 실무편이라는 하위 묶음도 표시한다.

### 게임 모션 기획 5부작

`게임 모션 기획` · 순서 1~5

1. `game-motion-design-basic.md`
2. `game-motion-dialogue-design.md`
3. `game-motion-trigger-design.md`
4. `game-motion-touch-voice.md`
5. `game-motion-effect.md`

### 붕괴: 스타레일 온보딩 3부작

`붕괴: 스타레일 온보딩 분석` · 순서 1~3

1. `honkai-starrail-onboarding-experience-analysis-1.md`
2. `honkai-starrail-onboarding-experience-analysis-2.md`
3. `honkai-starrail-onboarding-experience-analysis-3.md`

연장 읽기: `honkai-starrail-event-ui-ux.md`, `lobby-design-guide.md`, `umamusume-player-journey-map-analysis.md`.

### 란스X 시스템 분석 3부작

`란스X 시스템 분석` · 순서 1~3

1. `rance-x-phase-system.md`
2. `rance-x-battle-system.md`
3. `rance-x-battle-dynamics.md`

`rance-x-setup-knowhow.md`, `rance-x-korean-patch-knowhow.md`는 분석 시리즈가 아닌 별도 "플레이 가이드" 묶음으로 분리한다.

### 창세기전 템페스트 분석 4부작

`창세기전 템페스트 분석` · 순서 1~4

1. `genesis-tempest-game-analysis-1.md`
2. `genesis-tempest-game-analysis-2.md`
3. `genesis-tempest-game-analysis-3.md`
4. `genesis-tempest-charter-analysis.md`

### 초단편 스토리·게임 스토리 응용

`초단편 스토리` · 창작 묶음. `very-short-story-writing.md`를 입문·제작 글로 두고 아래 창작물을 발행 순으로 연결한다.

- `very-short-story-present-is-difficult.md`
- `very-short-story-do-it-with-my-best.md`
- `very-short-story-training-for-mental-health.md`
- `very-short-story-feed-the-mind.md`
- `very-short-story-a-little-time-with-you.md`
- `very-short-story-gourmet-blue-archive.md`

## P1: 새 시리즈 또는 허브 후보

**허브 생성 완료 (2026-07-17)** — 아래 5개 허브를 `wiki/series-threads/`에 만들고, 각 허브에서 핵심 글로 직접 이동하는 옵시디언 위키링크를 추가했다. 개별 글의 발행용 연관글 교체는 P3에서 다룬다.

### 게임 기획 문서와 협업

검색 유입이 많은 실무형 글을 하나의 독서 경로로 만든다. 단, 협업툴 리뷰와 문서 작성법은 한 글 안에서 뒤섞지 않는다.

| 역할 | 글 |
|---|---|
| 시작: 기획의 의도 정리 | `game-design-pillars.md`, `10-page-concept-documents.md` |
| 설득: 짧은 제안서 | `1-page-proposal-for-game-designer.md` |
| 실행: 협업과 피드백 | `fast-feedback.md`, `asset-buying-cowork.md`, `manager-cowork.md` |
| 도구 선택 | `saas-cowork.md`, `cowork-asana.md` |

허브 제목 후보: **게임 기획 문서와 협업: 아이디어를 실제 개발로 옮기는 순서**

### 내러티브 기획자의 성장 경로

기존 취업 가이드는 유지하고, 입사 후 실무·리드 역할로 이어지는 두 번째 경로를 만든다.

| 단계 | 글 |
|---|---|
| 취업 | `gamejob-resume-tips.md` → `narrative-designer-portfolio-guide.md` → `narrative-designer-interview-guide.md` |
| 실무 설계 | `dialogue-system-table.md`, `narrative-designer-combat-mechanics.md` |
| 전문성 변화 | `game-narrative-designer-ai-survival-guide.md` |
| 리드·관리 | `narrative-team-postmortem.md`, `narrative-director-cowork-guide.md`, `1-page-proposal-for-game-designer.md` |

주의: 취업 시리즈와 실무·관리 글을 하나의 번호 시리즈로 합치지 않는다. 독자가 다른 별도 허브 2개로 두되, 취업 시리즈 마지막에서 실무 허브로 보내는 방식이 적합하다.

### AI 도구와 게임 개발

`AI × 게임 기획 인사이트`는 콘퍼런스 글 중심의 뉴스레터로 유지하고, 별도로 실습형 허브를 둔다.

- 관찰·전망: `ai-game-design-gdc-2026-trends.md`, `ndc-2026-insights-from-3-session.md`, `game-narrative-designer-ai-survival-guide.md`
- 실습: `chatgpt-unity-learning-planning.md`, `stable-diffusion-setup.md`, `stable-diffusion-txt2img.md`, `comfyui-subculture-bishojyo-making-with-illust.md`

허브 제목 후보: **게임 기획자·아티스트를 위한 AI 도구 입문: 전망부터 이미지 제작까지**

### 게임 연출과 서브컬처 캐릭터

미장센 3부작을 이 묶음의 이론 축으로 둔다.

1. `why-should-game-designer-know-mise-en-scene.md`
2. `camera-work-knowing.md`
3. `mise-en-scene-cinematography.md`

사례 연결: `game-presenment-5-elements.md`, `starrail-ultimate-analysis.md`, `starrail-firefly-concept-art-8-elements.md`, `penacony-symbol-metaphor.md`, `reverse-1999-lobby-design-analysis.md`.

다음 글 공백: "조명과 색채", "서브컬처 게임 컷신 1장면 분석". 이 두 편이 들어오면 연출 시리즈의 독서 경로가 완성된다.

### 라이브서비스 플레이어 경험 설계

게임명으로 묶지 말고, 플레이어 경험의 흐름으로 연결한다.

- 진입: `honkai-starrail-onboarding-experience-analysis-1.md`~`3.md`
- 정착: `lobby-design-guide.md`, `honkai-starrail-event-ui-ux.md`
- 반복·복귀: `honkai-3rd-daily-contents-routine.md`, `honkai-3rd-weekly-contents-routine.md`, `honkai3rd-return-system-analysis.md`
- 사례 비교: `umamusume-player-journey-map-analysis.md`, `persona-3-reload-daily-life-analysis.md`

허브 제목 후보: **온보딩부터 복귀까지: 라이브서비스 플레이어 경험 설계**

## P2: 게임 분석을 횡단 자산으로 바꾸는 연결

**허브 생성 완료 (2026-07-17)** — 캐릭터·서사, 전투·시스템, 콘셉트·미술, 제작 회고의 4개 분석 허브를 만들었다. 각 허브는 게임명이 아니라 분석 관점으로 글을 횡단 연결한다.

| 분석 관점 | 우선 연결 글 |
|---|---|
| 캐릭터·서사 | `blue-archieve-scenario-post-mortem.md`, `penacony-symbol-metaphor.md`, `starrail-firefly-concept-art-8-elements.md`, `subculture-game-character-episode-proposal.md` |
| 전투·시스템 | `rance-x-*`, `ccg-and-battle-meta-design.md`, `girls-adventure-system-analysis.md` |
| 콘셉트·미술 | `3-basic-rules-for-game-character-concept-designer.md`, `reverse-1999-lobby-design-analysis.md`, `mise-en-scene-*` |
| 게임 제작 회고 | `tempest-post-mortem.md`, `concentric-development.md`, `the-friday.md`, `how-they-design-the-success-game.md` |

## 연결 규칙

각 글의 `related_posts`는 다음 순서로 최대 4개만 채운다.

1. 같은 시리즈의 이전 또는 다음 편
2. 바로 실천할 수 있는 심화·사례 글 1개
3. 다른 독서 경로로 이어 주는 허브 또는 관문 글 1개
4. 필요할 때만 반대 관점 또는 비교 사례 1개

다음에는 넣지 않는다.

- 단지 카테고리가 같다는 이유만으로 연결한 글
- 이미지 파일 URL 또는 변경된 옛 슬러그
- 모든 글에 반복되는 범용 링크 2개 이상
- R18·일상·후기처럼 독자 의도가 다른 글의 무관한 교차 연결

## 반영 순서

1. P0의 6개 묶음에 `series`, `series_order`, `related_posts`, `wiki_refs` 반영
2. P1의 5개 허브 Wiki 페이지 생성 및 기존 글 연결
3. 각 글의 본문 하단 연관글을 메타데이터 기준으로 교체할 발행용 목록 작성 — **1차 배치 완료**: [[planning/related-posts-publication-plan]]
4. 남은 단독 글은 유지·보관·새 묶음 후보로 분류

P3의 1차 워드프레스 적용 목록은 [[planning/related-posts-publishing-map]]에 정리한다.

이 분석은 관계 데이터 반영 전의 설계 문서다. 실제 반영 시에는 URL 슬러그와 현재 본문 링크를 다시 대조해, 존재하지 않는 옛 주소를 새 링크로 쓰지 않는다.
