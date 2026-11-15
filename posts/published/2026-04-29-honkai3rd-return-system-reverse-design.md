---
title: "게임 역기획서 작성 실전 가이드: 붕괴 3rd 복귀 시스템 시리즈"
url: https://subculturegamer.com/honkai3rd-return-system-reverse-design/
published: 2026-04-29
categories: ["기획 노트"]
tags: ["게임 기획 문서"]
related_posts:
  - 2023-04-11-honkai-3rd-return-system-reverse-design-step-1
  - 2023-04-12-honkai-3rd-return-system-reverse-design-step-2
  - 2023-04-13-honkai-3rd-return-system-reverse-design-step-3
  - 2023-04-14-honkai-3rd-return-system-reverse-design-step-4
  - honkai3rd-return-system-analysis
wiki_refs:
  - wiki/series-threads/honkai3rd-return-system-reverse-design-series
  - wiki/games/honkai-impact-3rd
  - wiki/series-threads/game-planning-documents-and-collaboration
series: "붕괴 3rd 복귀 시스템 역기획"
series_order: null
---
![게임 역기획서 작성 실전 가이드: 붕괴 3rd 복귀 시스템 시리즈](https://subculturegamer.com/wp-content/uploads/2026/04/honkai3rd-return-system-reverse-design-1024x1024.png)
> 역기획서를 쓰라는 말은 많이 들었지만, 막상 시작하면 어디서 어떻게 끊어야 할지 막막한 경우가 많다.  
>   
> 이 시리즈는 붕괴 3rd의 복귀 시스템을 실제 사례로 삼아, 역기획서를 ‘감상문’이 아닌 ‘구현 문서’로 만들어가는 과정을 단계별로 다룬다.

---

## 게임 역기획서란?

게임 역기획서는 출시된 게임의 특정 시스템이나 콘텐츠를 분석해, 그 구조와 로직을 역으로 설계해 보는 문서다.

보통 게임 기획자 지망생들이 취업용 포트폴리오로 이 형식을 활용하곤 한다. 이것 역시 엄연한 기획서이기 때문에, 문서를 통해 작성자의 기획력과 문서 구성 능력을 어느 정도 엿볼 수 있다.

이 작업은 단순히 “이 게임에 이런 기능이 있더라”를 정리하는 데서 끝나지 않는다. 특정 콘텐츠나 시스템이 어떤 의도로 설계되었고, 그 의도가 실제 플레이 경험 안에서 제대로 작동하는지를 분석해, 나중에는 **그 자료만 보고도 유사한 구조를 설계할 수 있을 정도로 체계화하는 과정에 가깝다.**

따라서 글은 플레이 감상문이 아니라 실제 개발을 염두에 둔 기획서처럼 보여야 한다. 화면에 보이는 UI만 적는 데서 멈추지 않고, 데이터 구조와 컬럼 간 참조 관계, 로컬라이즈 같은 구현 가능성까지 함께 고려해야 한다.

---

## 붕괴 3rd와 복귀 시스템을 고른 이유는?

이번 역기획서 시리즈의 타깃은 호요버스(HoYoverse)의 대표작, **‘붕괴 3rd’의 복귀 시스템**이다.  
  
복귀 시스템은 오랫동안 접속하지 않은 유저가 다시 돌아왔을 때, 이들을 어떻게 정착시키고 체감을 향상시킬 것인가에 대한 ‘기획 의도’가 고스란히 반영되는 치밀한 시스템이다. 특히 호요버스의 라이브 서비스 게임들은 UI/UX와 데이터 구조가 매우 탄탄하기로 유명하므로, 역기획 훈련의 주제로 삼기에 가장 적절하다.

*분석 기준은 2023년 4월 당시 최신이던 붕괴 3rd 6.5 버전이다. 지금의 게임 화면이나 복귀 시스템 구성과는 다를 수 있다.*

![Honkai3rdlogo](https://subculturegamer.com/wp-content/uploads/2026/04/honkai3rdlogo.webp)

Honkai Impact 3 Official Site – Fight for All That is Beautiful in the World!

Honkai Impact 3 Official Site – In this Honkai-corrupted world, the Valkyries, brave girls with Honkai resistance, have been fighting for all that is beautiful in the world.

---

## 역기획의 시작: 재료 손질부터

제 아무리 뛰어난 요리사라고 해도, 요리를 시작할 때 가장 먼저 해야하는 건 ‘재료 손질’이다.

역기획서의 시작은 내가 요리할 주제의 재료, 즉 ‘원본 데이터’를 확보하는 일이다.

실제로 게임을 켜서 게임 내부의 동작을 녹화하거나 스크린샷을 충분히 찍은 뒤, 그것을 적절하게 ‘가공’하는 과정이 필요하다.

이러한 과정을 거치다 보면  게임 내부 로직, 즉 어떠한 규칙이나 반복되는 패턴이 보이기 시작한다.

예를 들어 화면에 보이는 ‘기억 전장에서 누적 10,000점 획득’이라는 문구가, 실제 설계에서는 ‘기억 전장에서 누적 %d점 획득’이라는 텍스트와 10,000이라는 ‘조건값(변수)’으로 분리되어 있다는 것을 깨닫게 된다.

마찬가지로 아이템명, 재화명, 남은 기간 문구 같은 요소도 화면에서는 하나의 문장처럼 보이지만, 실제 데이터에서는 로컬라이즈 키나 참조 키로 분리되어야 유지보수와 다국어 대응이 가능해진다.

역기획서를 쓰면 이렇게 **‘게임 기획자의 안목’을 기를 수 있다**는 점에서 게임 기획자 지망생에게 큰 도움이 된다.

---

## 시리즈에서 다루는 흐름

이 시리즈의 전반적인 역기획 흐름을 요약해보자면 아래와 같다.

1. 인게임 캡처와 녹화본을 바탕으로 자료를 확보한다.
2. 캡처한 인게임 정보를 표로 옮겨 데이터화한다.
3. 각 행과 열에 Primary Key를 부여하고, 중복되는 텍스트는 LocalizeKey로 분리한다.
4. 텍스트 안에 섞여 있던 상수와 조건값을 변수와 데이터 열로 분해한다.
5. Item, Currency, Category 같은 참조 대상을 별도 테이블로 분리하고 관계를 설계한다.
6. 마지막으로 엑셀의 표, 관계, 데이터 모델 기능을 통해 실제 참조 구조로 연결한다.

> **💡 기획 의도의 파악과 검증**역기획서를 작성할 때 가장 중요한 것은 기획자의 ‘기획 의도’가 실제로 작동하는지 파악하는 것이다. 문서를 끝까지 썼다면, 스스로 게임에 복귀한 플레이어라 가정하고 그 의도가 제대로 동작하는지 반드시 검증해 보도록 하자.

---

## 이 글의 대상 독자

이 시리즈는 특히 이런 사람에게 도움이 된다.

- 게임 기획 지망생으로서 역기획서를 처음 구조적으로 써보려는 사람.
- 시스템 기획서를 감상문이 아니라 데이터 중심 문서로 바꾸고 싶은 사람.
- 엑셀이나 스프레드시트를 활용해 게임 데이터를 정리하는 감각을 익히고 싶은 사람.
- 복귀 시스템, 미션 구조, 상점 구조 같은 라이브 서비스 콘텐츠를 분석하고 싶은 사람.

포트폴리오로 역기획서를 낸다면 1~4편의 과정을 모두 담을 필요는 없다. 1~4편은 데이터를 다루는 감각을 기르는 훈련에 가깝다. 실제 문서에는 시스템 개요와 기획 의도, 핵심 데이터 테이블 몇 장, 그리고 5편처럼 플레이어 경험에서 찾은 개선안을 담으면 충분하다. 심사하는 사람이 가장 보고 싶어 하는 것도 결국 “이 사람이 기획 의도를 읽어 내는가”이기 때문이다.

---

## 읽는 순서

이 글은 역기획서 시리즈의 허브 글이다. 각 편은 아래 순서대로 읽으면 가장 이해하기 쉽다.

### 1. 자료 확보와 Key 설계

복귀 출석, 복귀 임무, 보너스 상점, 복귀 펀드, 복귀 상점처럼 복귀 시스템의 하위 페이지를 나누고, 캡처 이미지와 녹화본을 바탕으로 보상·조건·구성 요소를 표로 옮긴다. 이어서 각 행에 Primary Key를 붙이고 플레이어에게 보이는 텍스트를 LocalizeKey로 분리한다.

→ [1편: 자료 확보와 Key 설계](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-1/)

### 2. 변수화와 Condition, ID 정리

텍스트 안의 숫자를 포맷 연산자(%d)와 변수로 바꾸고 Condition 열이 플레이어용 문장인지 실제 값인지 개발자용 코멘트인지 역할을 다시 나눈다. 전역에서 쓰는 중복 Key를 없애고 넘버링 ID를 명시적 ID로 바꾼다.

→ [2편: 변수화와 Condition, ID 정리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-2/)

### 3. 로컬라이즈 테이블 분리

표마다 흩어져 있던 로컬라이즈 데이터를 별도의 Localize Table로 모은다. 로컬라이즈 키 부여 규칙을 정하고, Data Table과 Localize Table이 외래 키로 이어지는 구조를 만든다.

→ [3편: 로컬라이즈 테이블 분리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-3/)

### 4. 아이템 Key 규칙과 엑셀 참조 구조

아이템 테이블에 로컬라이즈 열을 더하고 엑셀 정렬 문제를 피하는 아이템 Key 규칙을 정한다. 마지막으로 엑셀의 표, 관계, 데이터 모델 다이어그램으로 테이블을 실제 참조 구조로 연결한다.

→ [4편: 아이템 Key 규칙과 엑셀 참조 구조](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-4/)

### 5. 분석: 게임디자인 관점에서 본 복귀 설계

정리한 데이터를 바탕으로 페르소나와 사용자 여정 맵을 만들고 복귀 플레이어의 경험을 긍정·부정·의문으로 나눠 기획 의도와 개선점을 찾는다.

→ [5편: 붕괴 3rd 복귀 시스템 분석: 게임디자인 관점에서 본 복귀 설계](https://subculturegamer.com/honkai3rd-return-system-analysis/)

시리즈에서 만든 엑셀 완성본도 함께 올려 둔다. 2023년 4월(6.5 버전) 화면과 공개 정보만 보고 추정해 만든 학습용 예제라 실제 게임 데이터와는 다를 수 있다. 1~4편을 따라 하다 막히는 곳이 있으면 이 파일과 비교해 보자.

[붕괴 3rd 복귀 시스템 역기획서 예제 (xlsx)](https://subculturegamer.com/wp-content/uploads/2026/11/honkai3rd-return-system-reverse-design-example.xlsx)[다운로드](https://subculturegamer.com/wp-content/uploads/2026/11/honkai3rd-return-system-reverse-design-example.xlsx)

---

## 용어 정리

**역기획⁠서**

특정 게임의 콘텐츠나 시스템을 분석해, 그 설계 의도와 작동 방식을 추론하고 문서화한 기획 문서다. 단순 요약이 아니라, 협업 가능한 수준의 구조와 구현 가능성을 갖추는 것이 중요하다.

**Primary Key**

각 데이터 행을 고유하게 식별하기 위한 기본 키다. 중복이 없어야 하고, 비어 있어도 안 되며, 다른 테이블과 관계를 맺을 때 기준점이 된다.

**LocalizeKey**

플레이어에게 노출되는 텍스트를 다국어 기준으로 분리해 관리하기 위한 키다. 시스템 데이터와 텍스트 데이터를 분리하면 가독성, 재사용성, 현지화 대응이 좋아진다.

**참조 구조**

한 테이블의 데이터를 다른 테이블에서 조회해 쓰는 구조다. 아이템명, 재화명, 텍스트처럼 중복될 수 있는 데이터를 참조 구조로 분리하면, 중복 관리 비용과 오류 가능성을 줄일 수 있다.

---

## 본격적인 역기획 시작하기

역기획의 목적과 방향을 이해했다면 이제 엑셀과 캡처 도구를 켜고 첫 단계를 시작할 차례다.  
**👉 [1편: 자료 확보와 Key 설계 바로 가기](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-1/)**
