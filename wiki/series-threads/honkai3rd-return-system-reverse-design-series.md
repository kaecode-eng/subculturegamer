---
title: 붕괴 3rd 복귀 시스템 역기획 시리즈
type: series-thread
tags: [게임 기획, 역기획, 데이터 테이블, 라이브 서비스, 시리즈]
related_posts:
  - 2026-04-29-honkai3rd-return-system-reverse-design.md
  - 2023-04-11-honkai-3rd-return-system-reverse-design-step-1.md
  - 2023-04-12-honkai-3rd-return-system-reverse-design-step-2.md
  - 2023-04-13-honkai-3rd-return-system-reverse-design-step-3.md
  - 2023-04-14-honkai-3rd-return-system-reverse-design-step-4.md
  - honkai3rd-return-system-analysis.md
related_wiki:
  - wiki/games/honkai-impact-3rd.md
  - wiki/series-threads/game-planning-documents-and-collaboration.md
  - wiki/series-threads/live-service-player-experience-hub.md
last_updated: 2026-11-12
---

## 시리즈 개요

붕괴 3rd 복귀 시스템(2023년 4월, 6.5 버전)을 사례로 역기획서를 '감상문'이 아닌 '구현 문서'로 만드는 과정을 다룬 실전 시리즈다. 허브 글(`/honkai3rd-return-system-reverse-design/`, 2026-04-29)과 데이터 정리 1~4편, 분석편(5편)으로 구성된다. 1~4편은 2023-04 날짜로 공개됐고, 섬네일을 통일했다. 허브 글에서 엑셀 완성본(학습용 예제 xlsx)을 내려받을 수 있다.

## 편 구성

| 편 | 파일 | 핵심 내용 |
|----|------|----------|
| 허브 | `2026-04-29-honkai3rd-return-system-reverse-design.md` | 역기획서의 정의, 붕괴 3rd를 고른 이유, 6단계 흐름, 용어 정리 |
| 1편 | `2023-04-11-...-step-1.md` | 자료 확보, 하위 페이지 분리, Primary Key 설계 |
| 2편 | `2023-04-12-...-step-2.md` | 포맷 연산자(%d) 변수화, Condition 열 역할 분리, ID 정리 |
| 3편 | `2023-04-13-...-step-3.md` | Localize Table 분리, 로컬라이즈 키 규칙, 외래 키 |
| 4편 | `2023-04-14-...-step-4.md` | 아이템 Key 규칙, 엑셀 표·관계·데이터 모델로 참조 구조 완성 |
| 5편(분석) | `honkai3rd-return-system-analysis.md` | 페르소나와 사용자 여정 맵, 기획 의도와 개선점 |

## 블로그에서 다룬 맥락

- 허브 글은 포트폴리오에 역기획서를 낼 때 1~4편 과정을 다 넣을 필요는 없고, 시스템 개요와 기획 의도 검증이 핵심이라고 정리한다. 이 기준은 [[wiki/series-threads/game-planning-documents-and-collaboration.md]]의 문서 작성 흐름과 이어진다.
- 복귀 설계는 라이브 서비스 리텐션 주제이므로 [[wiki/series-threads/live-service-player-experience-hub.md]]와 함께 읽힌다.

## 미개척 각도

- 같은 방법론을 다른 시스템(출석부, 배틀패스, 상점)에 적용하는 후속편
- 역기획 데이터에서 '기획 의도 검증'까지 가는 체크리스트형 글
- 스타레일 복귀 시스템과의 비교 (같은 개발사의 설계 변화)
