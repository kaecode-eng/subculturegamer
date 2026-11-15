---
title: "붕괴 3rd 복귀 시스템 역기획 1: 자료 확보와 Key 설계"
url: https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-1/
published: 2023-04-11
categories: ["기획 노트"]
tags: ["게임 기획 문서", "붕괴 3rd"]
related_posts:
  - 2026-04-29-honkai3rd-return-system-reverse-design
  - 2023-04-12-honkai-3rd-return-system-reverse-design-step-2
  - 2023-04-13-honkai-3rd-return-system-reverse-design-step-3
  - 2023-04-14-honkai-3rd-return-system-reverse-design-step-4
wiki_refs:
  - wiki/series-threads/honkai3rd-return-system-reverse-design-series
  - wiki/games/honkai-impact-3rd
series: "붕괴 3rd 복귀 시스템 역기획"
series_order: 1
---
![붕괴 3rd 복귀 시스템 역기획 1편 – 도입](https://subculturegamer.com/wp-content/uploads/2023/04/man-g06f6d35ef_1920-1024x605.avif)

@[StartupStockPhotos](https://pixabay.com/ko/users/startupstockphotos-690514/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=593333), Pixabay

> 이 글은 「붕괴 3rd 복귀 시스템 역기획」 시리즈의 1편이다. 시리즈 전체 흐름과 용어는 [허브 글](https://subculturegamer.com/honkai3rd-return-system-reverse-design/)에 정리해 두었다.

**이 글의 핵심 요약**

- 역기획은 기억이 아니라 캡처와 녹화 자료에서 시작한다.
- 화면 이미지를 표로 옮긴 뒤 각 행에 Primary Key를 붙이고 플레이어에게 보이는 텍스트는 LocalizeKey로 분리한다.

---

## 들어가는 글

> (게임) 역기획서란, 특정 게임에 대해 어떠한 콘텐츠나 시스템, 레벨 디자인 등을 개발자가 아닌 다른 사람(예 : 게임 개발자 지망생, 게임 분석가 등)이 분석하며 **인사이트를 얻기 위해 작성한 문서**다.

잘 쓴 역기획서는, 그 문서만 봐도 그 콘텐츠를 기획할 수 있을 정도로 정교하고 이해가 잘 되는 문서라고 할 수 있다.

역기획서도 ‘기획서’이므로 기획서의 포맷을 가져야 하며, 기획서의 목적은 기획자의 아이디어를 ‘구현’하는 것이기 때문에 ‘구현 가능성’이 중요하다.

따라서 기획자라고 할지라도 데이터 구조에 대한 이해, 게임 엔진이나 UI에 관한 이해가 어느 정도 있으면 분석하는 데 도움이 될 수 있다.

나는 역기획서에서 가장 중요한 건 바로 **그 콘텐츠나 시스템을 기획한 사람의 ‘기획의도’를 파악하는 것이라고 생각한다.** 예를 들어, 복귀 시스템 기획은 특정 게임에 오랫동안 접속하지 않은 플레이어가 게임에 접속했을 때 체감을 향상시키기 위해 만들어진 시스템이다. 역기획서를 작성하는 사람은 그 시스템을 역기획하며 실제로 그 기획자의 의도가 ‘작동하는지’ 파악하는 게 중요하다.

그래서 이번 글을 시작으로 내가 가진 지식을 바탕으로 하나의 주제를 잡아 역기획을 진행해보고자 한다.

---

![붕괴 3rd 복귀 시스템 역기획 1편 – 들어가는 글](https://subculturegamer.com/wp-content/uploads/2023/04/image-127-1024x538.avif)

**첫 번째 타깃은 바로 ‘붕괴 3rd’, 그리고 역기획서의 주제는 바로 ‘복귀 시스템’이다.**

---

## 역기획의 시작

### 캡처 / 녹화 자료 확보하기

역기획을 하기 위해서는 특정 주제를 선정하고 그것을 분석하기에 충분한 ‘자료 조사’가 필요하다.

여기에서 말하는 ‘자료’란, 실제 그 게임의 이미지 파일과 녹화 영상 등을 말한다.

![붕괴 3rd 복귀 시스템 역기획 1편 – 역기획의 시작](https://subculturegamer.com/wp-content/uploads/2023/04/image-117-1024x553.avif)

역기획을 하기 위해서는, 실제 게임 내 캡처를 확보해두는 게 중요하다. 특히 녹화 영상은 모든 플레이 경험을 빠트리지 않고 찍기 때문에 정말 큰 도움이 된다.

이런 데이터가 확보되지 않은 채 기억에 의존하면서 역기획을 할 수는 없다.

나는 역기획을 시작하기 전에 붕괴 3rd 복귀 시스템의 인게임 UI를 모두 캡처하고 녹화본도 확보해 두었다.

다만 복귀 당일의 자료는 구하지 못했다. 그래서 복귀 당일의 경험 디자인과는 조금 다를 수 있다는 점을 미리 밝혀 둔다.

### 스펙 옮겨적기

복귀 시스템 UI를 모두 캡처했다면 이제 그것을 바탕으로 데이터 구조를 거꾸로 짚어 보자.

안타깝지만 지금까지 얻은 데이터는 모두 (캡처) ‘이미지’ 이기 때문에 , 이러한 데이터를 가공이 가능하도록 스프레드시트(표)로 정리하는 게 필요하다.

붕괴 3rd의 ‘복귀 시스템’은 아래와 같이 세부 페이지로 하위 구조가 나뉜다.

- 복귀 출석
- 복귀 임무
- 보너스 상점
- 복귀 펀드
- 복귀 상점
- 플레이 추천
- 복귀 설문

‘복귀 출석’부터 표로 옮겨 적어 보자.

아래 표는 역기획을 진행하면서 단순 정리표에서 정규화된 데이터 테이블로 조금씩 바꿔 나갈 것이다.

#### 복귀 출석

![붕괴 3rd 복귀 시스템 역기획 1편 – 역기획의 시작 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-118-1024x207.avif)

#### 복귀 임무

![붕괴 3rd 복귀 시스템 역기획 1편 – 역기획의 시작 (3)](https://subculturegamer.com/wp-content/uploads/2023/04/image-119-1024x874.avif)

#### 보너스 상점

![붕괴 3rd 복귀 시스템 역기획 1편 – 역기획의 시작 (4)](https://subculturegamer.com/wp-content/uploads/2023/04/image-120-1024x288.avif)

#### 복귀 펀드

![붕괴 3rd 복귀 시스템 역기획 1편 – 역기획의 시작 (5)](https://subculturegamer.com/wp-content/uploads/2023/04/image-122-1024x110.avif)

#### 복귀 상점

![붕괴 3rd 복귀 시스템 역기획 1편 – 역기획의 시작 (6)](https://subculturegamer.com/wp-content/uploads/2023/04/image-123-1024x42.avif)

#### 플레이 추천

정리할 데이터 없음.

#### 복귀 설문

정리할 데이터 없음.

위 데이터는 ‘어떤 페이지에서 어떤 보상을 어떤 조건을 만족하면 얻는지’ 정리한 표다.

하지만 위 표만 가지고서는 게임을 만들 수 없기 때문에 ‘역기획서’라고 볼 수는 없다.

시작이 반이다. 이제 이 표를 바탕으로 데이터를 조금씩 다듬어 보자.

### 참조용 데이터 정리

표를 정리하다 보면 공통점이 보인다.

‘아이템’이나 특정 ‘문장’이 중복되어 쓰이는 것을 볼 수 있다.

이런 데이터는 보통 ‘로컬라이즈 테이블’에서 따로 관리하고 테이블끼리 참조할 수 있도록 Primary Key를 둔다.

지금까지 얻은 데이터를 바탕으로 자주 등장한 용어를 아래와 같이 정리했다.

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-2.png)

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-3.png)

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-4.png)

이 표도 완성본이 아니어서 역기획을 진행하면서 ID나 설명이 바뀔 수 있다.

---

## Primary Key 부여

데이터베이스에는 ‘기본 키(Primary Key)’라는 개념이 있다.

주민등록번호를 생각해보자. 한국인이라면 누구나 주민등록번호를 가지고 있다.

주민등록번호가 중복인 사람이 있거나, 주민등록번호가 없는 사람이 있을까? 일반적으로는 없을 것이다.

Primary Key는 바로 이런 ‘주민등록번호’ 같은 값을 의미한다.

### Primary Key의 특징

- 표 안에 포함된 행마다 서로 다르게 구분되는, 고유한 값이다.
- 중복값이 존재하지 않는다.
- 값이 없을 수 없다.

이런 값을 왜 추가해야 할까? 테이블을 ‘관계형 데이터베이스’ 구조로 짤 것이기 때문이다.

### 관계형 데이터베이스란?

관계형 데이터베이스(Relational Database)는 서로 다른 테이블이 기본 키와 외래 키로 서로를 참조하는 구조의 데이터베이스다. 흔히 듣는 RDBMS(Relational Database Management System)는 이런 데이터베이스를 만들고 관리하는 시스템(MySQL, PostgreSQL 등)을 가리킨다. 이 시리즈의 역기획서도 이 구조를 따르니, 관심이 있다면 관계형 데이터베이스를 따로 공부해 보길 권한다. 여기서는 역기획서에 필요한 만큼만 다룬다.

![붕괴 3rd 복귀 시스템 역기획 1편 – Primary Key 부여](https://subculturegamer.com/wp-content/uploads/2023/04/image-128-993x1024.avif)

관계형 데이터베이스의 구조 도식화. Customer Table에서 Order Table의 Customer ID를 참조하고 있다.  
@[cloud.google.com/learn/what-is-a-relational-database?hl=ko](https://cloud.google.com/learn/what-is-a-relational-database?hl=ko)

이제 앞서 만든 데이터에 KEY를 붙여 보자. ID는 아래 규칙으로 붙인다.

- 복귀 출석 -> Return\_Attendance\_01
- 복귀 임무 -> Return\_Mission\_01

Return(복귀)이 출석이나 임무보다 큰 범주라서 앞에 두고 숫자는 맨 뒤에 붙였다.

아래는 ‘복귀 출석’ 테이블에 KEY 열을 추가하고 Primary Key를 부여한 것이다.

![붕괴 3rd 복귀 시스템 역기획 1편 – Primary Key 부여 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-129-1024x123.avif)

이쯤에서 ‘복귀 출석’ 인게임 화면을 다시 보자.

---

## 로컬라이즈 Key 분리

![붕괴 3rd 복귀 시스템 역기획 1편 – 로컬라이즈 Key 분리](https://subculturegamer.com/wp-content/uploads/2023/04/image-130-1024x553.avif)

화면에 적힌 한국어 가운데 일부는 ‘이미지’이고 일부는 ‘텍스트’다.

![붕괴 3rd 복귀 시스템 역기획 1편 – 로컬라이즈 Key 분리 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-131.avif)

![붕괴 3rd 복귀 시스템 역기획 1편 – 로컬라이즈 Key 분리 (3)](https://subculturegamer.com/wp-content/uploads/2023/04/image-132.avif)

위의 두 이미지는 별도의 UI 이미지로 관리되고 있을 것이다. 이런 UI는 로컬라이즈 Key로 관리하는 게 아니라 UI 시스템에서 별도의 경로에 모여 있는 이미지를 불러와 입혀주는 구조로 보인다.

![붕괴 3rd 복귀 시스템 역기획 1편 – 로컬라이즈 Key 분리 (4)](https://subculturegamer.com/wp-content/uploads/2023/04/image-133-1024x71.avif)
![붕괴 3rd 복귀 시스템 역기획 1편 – 로컬라이즈 Key 분리 (5)](https://subculturegamer.com/wp-content/uploads/2023/04/image-134.avif)

반면에, 위의 두 이미지는 인게임에서 텍스트로 기입된 부분으로 보인다. 이런 텍스트는 보통 현지화(로컬라이즈)를 위해 별도의 테이블에서 관리하고 있을 가능성이 높다.

예를 들면,

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-5.png)

이런 유의 테이블 구조는 각 권역별로 하나의 로컬라이즈 키에 여러 개의 언어가 대응한다. 따라서 중국 빌드는 CN을 불러와서 중국어가 나오고, 한국 빌드는 KR을 불러와서 한국어가 나오는 식이다. 이런 식의 테이블 구조가 되어 있다면, 기획자가 CN에서 확보한 안정성을 다른 KR, EN, JP 등에서도 보장할 수 있다는 장점이 있다. (단, 위 권역별 번역 텍스트를 잘 채워놨다는 전제 하에)

이제 세부 항목마다 있는 로컬라이즈 요소에 모두 KEY를 붙여 보자.

그리고 지금까지 한국어로 적은 열 머리글(어트리뷰트)을 모두 영어로 바꾸고 중복 없이 적는다.

![붕괴 3rd 복귀 시스템 역기획 1편 – 로컬라이즈 Key 분리 (6)](https://subculturegamer.com/wp-content/uploads/2023/04/image-138-1024x253.avif)

새로 추가하거나 고친 곳은 모두 빨간색으로 칠했다.

LocalizeKey 테이블을 추가했다. 이 부분은 추후 별도의 로컬라이즈 테이블에서 관리할 것이기 때문에 열 머리글을 녹색으로 칠했다. 그리고 LocalizeKey에 Key값을 부여했는데, 아래의 일반 데이터와 혼동이 없도록 값의 제일 앞에 ‘Localize\_’ 머리글을 추가했다. 이 ID 또한 추후 ID관리가 더 유리한 방법으로 수정할 수도 있다.

그리고 기존의 복귀 출석 테이블의 열 머리글을 모두 영문으로 바꾸었다. 특히 Reward\_1 처럼, 열 머리글 사이에 띄어쓰기 대신 언더바를 넣었는데, 이것은 강제 요소는 아니지만 데이터를 관리하는 팀 내부 규칙에 맞게 진행하면 된다. Reward\_1의 보상은 Reward\_get\_1의 (보상) 수량과 대응한다.

이로써 각 세부 항목의 모든 테이블 데이터에 ID를 부여하는 것까지 완료하였다.

다음 글에서는 표에 박혀 있는 숫자(상수)를 변수로 바꾸고 플레이어가 보는 문장과 실제 조건 데이터를 나눈다. → [다음 글: 역기획 2: 변수화와 Condition, ID 정리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-2/)

---

## 붕괴 3rd 복귀 시스템 역기획 시리즈

1. [시리즈 소개: 게임 역기획서 작성 실전 가이드](https://subculturegamer.com/honkai3rd-return-system-reverse-design/)
2. **붕괴 3rd 복귀 시스템 역기획 1: 자료 확보와 Key 설계** (현재 글)
3. [붕괴 3rd 복귀 시스템 역기획 2: 변수화와 Condition, ID 정리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-2/)
4. [붕괴 3rd 복귀 시스템 역기획 3: 로컬라이즈 테이블 분리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-3/)
5. [붕괴 3rd 복귀 시스템 역기획 4: 아이템 Key 규칙과 엑셀 참조 구조](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-4/)
6. [붕괴 3rd 복귀 시스템 분석: 게임디자인 관점에서 본 복귀 설계](https://subculturegamer.com/honkai3rd-return-system-analysis/)
