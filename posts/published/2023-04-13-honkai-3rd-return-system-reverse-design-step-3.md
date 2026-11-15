---
title: "붕괴 3rd 복귀 시스템 역기획 3: 로컬라이즈 테이블 분리"
url: https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-3/
published: 2023-04-13
categories: ["기획 노트"]
tags: ["게임 기획 문서", "붕괴 3rd"]
related_posts:
  - 2026-04-29-honkai3rd-return-system-reverse-design
  - 2023-04-11-honkai-3rd-return-system-reverse-design-step-1
  - 2023-04-12-honkai-3rd-return-system-reverse-design-step-2
  - 2023-04-14-honkai-3rd-return-system-reverse-design-step-4
wiki_refs:
  - wiki/series-threads/honkai3rd-return-system-reverse-design-series
  - wiki/games/honkai-impact-3rd
series: "붕괴 3rd 복귀 시스템 역기획"
series_order: 3
---
> [2편](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-2/)에서는 상수를 변수로 바꾸고 Condition 열을 정리한 뒤, 중복 Key를 없애고 명시적 ID를 붙였다. 이번 글에서는 각 데이터에 필요한 로컬라이즈 키를 정리하고 로컬라이즈 데이터를 별도의 테이블로 분리한다.

**이 글의 핵심 요약**

- 글로벌 서비스를 한다면 로컬라이즈 데이터는 Data Table과 따로 관리하는 편이 낫다.
- Data Table에 LocalizeKey 열을 두고 Localize Table의 기본 키를 외래 키(Foreign Key)로 불러온다.
- 로컬라이즈 키 부여 규칙은 스튜디오마다 다르니, 중요한 건 팀이 함께 지킬 규칙을 먼저 정하는 것이다.

---

## 로컬라이즈 데이터를 왜 분리할까

지금까지의 로컬라이즈 데이터는 하나의 시트, 각각의 표 안에서 관리하고 있었다.

이런 관리 방법이 틀린 것은 아니다. 이렇게 관리함으로써 얻는 장점도 있다. 일단 데이터 테이블의 구조가 간단해지고 굳이 다른 테이블 데이터를 참조할 필요가 없으니 표 내용이 직관적이다. 만약 하나의 권역(예: KR)에만 서비스할 계획이라면 로컬라이즈 테이블을 따로 관리하지 않는 것도 크게 문제되지 않을 것이다.

하지만 우리 게임이 글로벌 권역을 서비스하게 된다면 로컬라이즈 테이블을 별도로 관리해야 한다. 서비스 대상 국가(또는 언어)의 수 만큼 열이 늘어나야 하기 때문이다.

로컬라이즈 데이터는 보통 아주 긴 문장이 포함된다. 따라서 이러한 열이 하나라도 존재한다면 그 테이블을 관리하는 입장에서는 관리가 다소 까다로울 수 있다.

예를 들어 긴 로컬라이즈 열 하나 때문에 amount 같은 작은 열 다섯 개가 화면 밖으로 밀려나면, 개발자 입장에서는 문서를 읽기가 훨씬 어려워진다. 실무에서는 이처럼 하나의 표 안에 굉장히 많은 열 또는 데이터가 들어감으로써 문서의 활용도가 떨어지는 일이 비일비재하게 발생한다. 그래서 데이터 구조를 미리 잘 짜 두고 로컬라이즈 데이터도 따로 분리하기를 권한다.

테이블을 미리 이렇게 짜 두면 나중에 서비스 권역이 늘어나도 대처하기 쉽다.

![붕괴 3rd 복귀 시스템 역기획 3편 – 도입](https://subculturegamer.com/wp-content/uploads/2023/04/image-159-1024x191.avif)

Data Table(기존까지 우리가 수정하던 테이블)과 Localize Table을 서로 분리하여 참조하는 구조를 도식화한 것이다.

DataTable의 Primary Key는 Key01, Key02, Key03, Key04이다. 이 값은 DataTable의 기본키로 동작한다.

그런데 DataTable의 값을 로컬라이즈 테이블에서 ‘참조’하려면, 로컬라이즈 키를 불러올 열이 필요하다. 따라서 DataTable에 LocalizeKey 열을 추가한다. (녹색)

마지막으로, 로컬라이즈 테이블에 잘 모아둔 데이터의 Primary Key(LocalizeKey\_01, LocalizeKey\_02, LocalizeKey\_03, LocalizeKey\_04)를, DataTable에 새로 생성한 녹색 열 값에 붙여넣는다.

이때 로컬라이즈 키는 DataTable입장에서는 Foreign Key가 된다. 다른 테이블에서 불러온 키라는 의미이다.

이렇게 작업을 진행하기 위해, 먼저 DataTable(기존에 작업하던 테이블)에 로컬라이즈 열을 생성해보도록 하자.

---

## 로컬라이즈 열 생성

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성](https://subculturegamer.com/wp-content/uploads/2023/04/image-160-1024x255.avif)

앞서 위 표처럼, 복귀 시스템 LocalizeKey를 녹색 열 머리글로 따로 정리한 바 있다.

여기서 회색 열 머리글에 해당하는 데이터에 LocalizeKey를 넣어보도록 하자.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-161-1024x289.avif)

그러자, 위의 표처럼 정리가 된다. 여기서 ‘복귀 출석 1일’에 해당하는 Text 1일에 대응하는 LocalizeKey부터, ‘복귀 출석 7일’에 해당하는 Text 7일에 대응하는 LocalizeKey까지, 총 7개의 로컬라이즈 키를 추가한 것을 알 수 있다.

그런데 여기서 아차, 위에서 보는 것처럼 위에 별도로 빼둔 해당 세부 목록 페이지의 다른 로컬라이즈 키와 중복이 발생하고 말았다.

이는 세부 목록 페이지의 로컬라이즈 키 부여 정책과, 데이터의 로컬라이즈 키 부여 정책이 별도로 정해지지 않은 채 그저 ID를 입력했기 때문이다.

그렇다면 어느 쪽을 고치는 게 나을까? 판단 근거는 사람마다 다르겠지만 나는 이렇게 봤다.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성 (3)](https://subculturegamer.com/wp-content/uploads/2023/04/image-162-1024x253.avif)

회색 열 머리글의 테이블에 입력한 값을 보라색으로 칠해보았다. 이 테이블만 본다면, Return\_Attendance\_01은 Localize\_Return\_Attendance\_01 키와 1:1 대응한다.

반면, 위의 녹색 열 머리글 테이블의 데이터는 하나의 테이블에 다른 대응하는 Key가 없다. 그러니 위의 녹색 열 머리글 데이터의 로컬라이즈 키 부여 규칙을 변경하도록 하자.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성 (4)](https://subculturegamer.com/wp-content/uploads/2023/04/image-163-1024x553.avif)

이쯤에서 ‘복귀 출석’ 세부 페이지를 다시 보자. 위에 주황색 글씨로 정리한 데이터는 이 세부 페이지의 UI 영역에 들어가 있으며, 전역적으로도 쓰일 수 있게 생긴 것을 알 수 있다. 그래서 나는 여기서 ID 부여 규칙을 ‘Localize\_Return\_Attendence**\_UI**‘로 수정하겠다.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성 (5)](https://subculturegamer.com/wp-content/uploads/2023/04/image-164.avif)

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-10.png)

그런데 지금 보니, 위에 ‘복귀 출석’부터 ‘복귀 설문’ 까지의 텍스트도 전역적으로 쓰이는데다 로컬라이즈 키로 별도로 정리해야 할 것 같다. 이 데이터들도 전역 키로 관리하도록 하자.

지금까지의 수정사항을 반영하면 아래와 같다.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성 (6)](https://subculturegamer.com/wp-content/uploads/2023/04/image-166-1024x160.avif)

이제 위 적용한 규칙을 바탕으로, 아래의 다른 세부 페이지(예: 복귀 미션)까지 수정을 적용해주도록 하자.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성 (7)](https://subculturegamer.com/wp-content/uploads/2023/04/image-167-1024x721.avif)

위는 복귀 미션의 로컬라이즈 적용 과정인데, 우측의 Text\_2열에 해당하는 데이터는 중복값이 발생한 것을 알 수 있다. 그래서 위 색깔 영역처럼 ID를 부여하였는데, 오히려 지금의 데이터 구조로 보아하니 이렇게 관리하면 오히려 복잡해보일 듯하다.

따라서 지금 정책을 마련하겠다.

> ‘시스템 테이블에서 하나의 테이블 내에 두 개의 로컬라이즈 키 열 머리글이 존재한다면, 두 로컬라이즈 키의 숫자값은 서로 대응하도록 한다.’

이에 맞춰서 수정을 하게 되면,

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 열 생성 (8)](https://subculturegamer.com/wp-content/uploads/2023/04/image-168-1024x721.avif)

이렇게 대응하는 구조로 만들 수 있다.

로컬라이즈 키 부여 규칙은 다시 한번 강조하지만 스튜디오마다 조직마다 다를 수 있으니 어떤 것이 정답이라고는 말할 수 없다. 다만 나는 내가 생각하는 중복값 이슈보다는 이러한 직관적인 ID 대응이 더 중요하다고 생각하여 이렇게 새로 정책을 마련했을 뿐이다.

---

## 로컬라이즈 데이터 분리

이제 위에 녹색으로 된 영역을 별도의 로컬라이즈 테이블로 분리하도록 하자.

로컬라이즈 테이블로 분리할 때, 대상이 되는 테이블의 규칙이 뒤죽박죽이 되어서는 안 되니 아래와 같은 포맷 안에 넣을 수 있도록 하자.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 데이터 분리](https://subculturegamer.com/wp-content/uploads/2023/04/image-170-1024x36.avif)

지금 작업하고 있는 언어는 한국어(KR)이니, 기존의 Text 열에 들어가 있던 데이터는 모두 KR에 넣도록 하겠다.

그런데 위 표를 보면 알 수 있지만, ‘로컬라이즈’ 테이블 내에 이렇게 Condition\_value가 관리되는 것은 일반적이지 않다.

각 세부 페이지(복귀 출석 등) 내부의 데이터는 각 Key에서 이러한 값을 통제하지만, 위처럼 전역 Key(\_UI\_)는 별도로 관리해주는 테이블이 없다.

일단 지금은 임시로 Condition\_value를 적어두고, 나중에 별도의 Condition Value를 관리하는 전역 변수 테이블을 만들어주도록 하자.

이제 기존의 Data 표에 각각 분산되어 있던 LocalizeKey와 그 데이터(녹색 행)를 하나로 합치도록 하자.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 데이터 분리 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-171-1024x358.avif)

이렇게, 하나의 표 안에 Global, Attendance, Mission 등이 합쳐졌다.

기왕이면 A-Z 순(오름차순)으로 정렬하는 게 보기 좋을 테니, LocalizeKey열에 오름차순 정렬을 적용해주자.

그리고 LocalizeKey열에는 중복값이 생기면 안 되므로 중복값이 나타나면 알려줄 수 있도록 조건부 서식 – 중복값 표시를 적용해주도록 하자.

중복값이 따로 나타나지 않았다면, 붉은 색 셀 없이, 아래와 같이 오름차순으로 정리되어 있는 표를 볼 수 있다.

![붕괴 3rd 복귀 시스템 역기획 3편 – 로컬라이즈 데이터 분리 (3)](https://subculturegamer.com/wp-content/uploads/2023/04/image-172-1024x562.avif)

이제 기존 데이터 테이블에 있던 텍스트(기존 Text 열)는 지우자.

해당 테이블의 전역(\_UI\_) 키값도 지워도 된다. 모든 데이터가 이미 로컬라이즈 테이블로 옮겨 갔기 때문이다.

다음 글에서는 아이템 이름까지 ID로 바꾸고 엑셀의 관계 기능으로 테이블을 실제 참조 구조로 연결한다. → [다음 글: 역기획 4: 아이템 Key 규칙과 엑셀 참조 구조](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-4/)

---

## 붕괴 3rd 복귀 시스템 역기획 시리즈

1. [시리즈 소개: 게임 역기획서 작성 실전 가이드](https://subculturegamer.com/honkai3rd-return-system-reverse-design/)
2. [붕괴 3rd 복귀 시스템 역기획 1: 자료 확보와 Key 설계](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-1/)
3. [붕괴 3rd 복귀 시스템 역기획 2: 변수화와 Condition, ID 정리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-2/)
4. **붕괴 3rd 복귀 시스템 역기획 3: 로컬라이즈 테이블 분리** (현재 글)
5. [붕괴 3rd 복귀 시스템 역기획 4: 아이템 Key 규칙과 엑셀 참조 구조](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-4/)
6. [붕괴 3rd 복귀 시스템 분석: 게임디자인 관점에서 본 복귀 설계](https://subculturegamer.com/honkai3rd-return-system-analysis/)
