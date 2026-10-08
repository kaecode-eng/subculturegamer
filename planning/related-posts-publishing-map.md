# 발행용 연관글 교체 맵

> 2026-07-17 · P3 1차 배포 목록
>
> 목적: 글 하단의 반복·무관한 연관글을 독자의 다음 읽기로 바꾼다. 아래 목록은 워드프레스의 연관글 영역에 그대로 적용할 우선순위다.

## 적용 규칙

1. 각 글에는 연관글을 **2~4개만** 둔다.
2. 시리즈 글은 반드시 직전·직후 편을 먼저 둔다. 첫 편은 2편, 마지막 편은 직전 편과 확장 읽기 1개를 둔다.
3. 허브로 들어온 글은 같은 허브 안에서만 1~2개를 연결한다. 범용 글(MDA, 오리지널리티)을 매번 넣지 않는다.
4. 제목에는 번호 대신 독자가 얻는 가치를 쓴다. 예: `다음 편: 퀘스트의 4대 기둥`.
5. R18, 일상 후기, 설치 가이드는 독자 의도가 일치할 때만 연결한다.

## 워드프레스 삽입 형식

```markdown
### 다음에 읽을 글

- [글 제목](URL) — 연결 이유를 12~20자로 설명
- [글 제목](URL) — 연결 이유를 12~20자로 설명
```

글 맨 아래의 기존 `연관글` 블록을 이 형식으로 교체한다. 외부 이미지 URL과 존재 여부가 불확실한 옛 슬러그는 넣지 않는다.

## 1. 완결 시리즈: 순서 보장

### 퀘스트 디자인

| 적용 글 | 다음에 읽을 글 |
|---|---|
| 1편 `why-quest-design-is-important` | 2편 `types-of-quest-design` / 3편 `what-makes-a-good-quest-design-witcher-3` |
| 2편 `types-of-quest-design` | 1편 `why-quest-design-is-important` / 3편 `what-makes-a-good-quest-design-witcher-3` |
| 3편 `what-makes-a-good-quest-design-witcher-3` | 2편 `types-of-quest-design` / 4편 `game-quest-design-episode-planning-guide` |
| 4편 `game-quest-design-episode-planning-guide` | 3편 `what-makes-a-good-quest-design-witcher-3` / 5편 `game-quest-design-episode-planning-guide-2` |
| 5편 `game-quest-design-episode-planning-guide-2` | 4편 `game-quest-design-episode-planning-guide` / 6편 `game-quest-design-episode-planning-guide-3` |
| 6편 `game-quest-design-episode-planning-guide-3` | 5편 `game-quest-design-episode-planning-guide-2` / `game-item-concept-design` |

### 게임 모션 기획

`game-motion-design-basic` → `game-motion-dialogue-design` → `game-motion-trigger-design` → `game-motion-touch-voice` → `game-motion-effect` 순서다. 각 글에는 직전·직후 편을 넣고, 1편에는 3편, 5편에는 `3-basic-rules-for-game-character-concept-designer`를 추가한다.

### 스타레일 온보딩

`honkai-starrail-onboarding-experience-analysis-1` → `-2` → `-3` 순서를 유지한다. 3편의 추가 연결은 `honkai-starrail-event-ui-ux`, `lobby-design-guide`다.

### 란스X 시스템 분석

`rance-x-phase-system` → `rance-x-battle-system` → `rance-x-battle-dynamics` 순서를 유지한다. 설치·한글화 글은 이 분석 시리즈 하단에 넣지 않는다.

### 창세기전 템페스트 분석

`genesis-tempest-game-analysis-1` → `-2` → `-3` → `genesis-tempest-charter-analysis` 순서를 유지한다. 마지막 글의 확장 읽기는 `penacony-symbol-metaphor`가 아니라 `blue-archieve-scenario-post-mortem`처럼 캐릭터·서사 분석 의도가 같은 글로 둔다.

### 초단편 스토리

`very-short-story-writing`을 입구로 두고, 발행 순서의 단편을 1개씩 다음 글로 연결한다. `very-short-story-gourmet-blue-archive` 마지막에는 `blue-archieve-scenario-post-mortem`을 붙여 팬 창작에서 상업 게임 서사 분석으로 넘긴다.

## 2. 검색 유입 허브: 우선 교체 20개

| 유입 글 | 연관글 2~4개 | 연결 의도 |
|---|---|---|
| `10-page-concept-documents` | `game-design-pillars`, `1-page-proposal-for-game-designer`, `fast-feedback` | 컨셉 → 설득 → 피드백 |
| `1-page-proposal-for-game-designer` | `10-page-concept-documents`, `fast-feedback`, `narrative-director-cowork-guide` | 문서와 협업 실무 |
| `fast-feedback` | `1-page-proposal-for-game-designer`, `manager-cowork`, `saas-cowork` | 피드백을 팀 프로세스로 확장 |
| `asset-buying-cowork` | `1-page-proposal-for-game-designer`, `manager-cowork`, `cowork-asana` | 외부 협업의 실행 도구 |
| `dialogue-system-table` | `narrative-designer-combat-mechanics`, `game-narrative-designer-ai-survival-guide`, `narrative-designer-portfolio-guide` | 설계 역량을 커리어로 연결 |
| `narrative-designer-combat-mechanics` | `dialogue-system-table`, `game-presenment-5-elements`, `narrative-team-postmortem` | 서사와 시스템의 접점 |
| `game-narrative-designer-ai-survival-guide` | `ndc-2026-insights-from-3-session`, `narrative-designer-portfolio-guide`, `narrative-team-postmortem` | AI 전망 → 실무·커리어 |
| `narrative-team-postmortem` | `narrative-director-cowork-guide`, `1-page-proposal-for-game-designer`, `fast-feedback` | 팀 관리와 협업 |
| `ai-game-design-gdc-2026-trends` | `ndc-2026-insights-from-3-session`, `game-narrative-designer-ai-survival-guide`, `chatgpt-unity-learning-planning` | 전망 → 실습 |
| `ndc-2026-insights-from-3-session` | `ai-game-design-gdc-2026-trends`, `game-narrative-designer-ai-survival-guide`, `comfyui-subculture-bishojyo-making-with-illust` | 관찰 → 적용 |
| `chatgpt-unity-learning-planning` | `stable-diffusion-setup`, `stable-diffusion-txt2img`, `comfyui-subculture-bishojyo-making-with-illust` | AI 도구 학습 경로 |
| `stable-diffusion-setup` | `stable-diffusion-txt2img`, `comfyui-subculture-bishojyo-making-with-illust`, `game-narrative-designer-ai-survival-guide` | 설치 → 생성 → 실무 맥락 |
| `why-should-game-designer-know-mise-en-scene` | `camera-work-knowing`, `mise-en-scene-cinematography`, `starrail-ultimate-analysis` | 이론 → 게임 사례 |
| `starrail-ultimate-analysis` | `camera-work-knowing`, `mise-en-scene-cinematography`, `starrail-firefly-concept-art-8-elements` | 연출 요소를 캐릭터 분석으로 확장 |
| `starrail-firefly-concept-art-8-elements` | `3-basic-rules-for-game-character-concept-designer`, `penacony-symbol-metaphor`, `reverse-1999-lobby-design-analysis` | 캐릭터 → 세계관·미술 |
| `lobby-design-guide` | `reverse-1999-lobby-design-analysis`, `honkai-starrail-event-ui-ux`, `umamusume-player-journey-map-analysis` | 로비 → 경험 흐름 |
| `honkai-starrail-event-ui-ux` | `lobby-design-guide`, `honkai3rd-return-system-analysis`, `persona-3-reload-daily-life-analysis` | 이벤트 → 리텐션 |
| `honkai3rd-return-system-analysis` | `honkai-3rd-daily-contents-routine`, `honkai-3rd-weekly-contents-routine`, `umamusume-player-journey-map-analysis` | 복귀 → 반복 플레이 |
| `tempest-post-mortem` | `concentric-development`, `how-they-design-the-success-game`, `1-page-proposal-for-game-designer` | 회고 → 기획 산출물 |
| `how-they-design-the-success-game` | `gamejob-resume-tips`, `narrative-designer-portfolio-guide`, `tempest-post-mortem` | 분석서를 포트폴리오로 전환 |

## 3. 나머지 글의 배치 원칙

| 글 유형 | 연관글 선택 기준 |
|---|---|
| 단일 게임 리뷰 | 같은 게임이 아니라 동일한 분석 관점의 글 2개 |
| 서브컬처 정의·문화 글 | `subculture-definition`을 입구로 두고 문화·게임 사례를 각각 1개 |
| 설정 기획 글 | 기존 설정 기획자 1~3편의 앞뒤 편, 내러티브 실무 글 1개 |
| 나니노벨 글 | 인접 공식 문서 1~2개와 개발 노트 또는 샘플 1개 |
| 일상·도구 후기 | 관련 주제가 명확할 때만 1개, 없으면 연관글 영역을 비운다 |

## 발행 전 체크

- 링크 대상이 실제 게시 상태인지 확인한다.
- 제목과 URL의 슬러그가 다르면, Markdown 파일의 `url` frontmatter를 기준으로 한다.
- 기존 연관글의 조회 성과가 있다면 즉시 삭제하지 않는다. 28일간 신규 목록과 클릭률을 비교한다.
- 새 글을 발행할 때는 이 문서의 규칙에 맞춰 연관글 2~4개를 함께 작성한다.
