---
title: "붕괴 3rd 복귀 시스템 역기획 2: 변수화와 Condition, ID 정리"
url: https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-2/
published: 2023-04-12
categories: ["기획 노트"]
tags: ["게임 기획 문서", "붕괴 3rd"]
related_posts:
  - 2026-04-29-honkai3rd-return-system-reverse-design
  - 2023-04-11-honkai-3rd-return-system-reverse-design-step-1
  - 2023-04-13-honkai-3rd-return-system-reverse-design-step-3
  - 2023-04-14-honkai-3rd-return-system-reverse-design-step-4
wiki_refs:
  - wiki/series-threads/honkai3rd-return-system-reverse-design-series
  - wiki/games/honkai-impact-3rd
series: "붕괴 3rd 복귀 시스템 역기획"
series_order: 2
---
> [1편](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-1/)에서는 캡처 자료를 표로 옮기고 Primary Key와 로컬라이즈 Key를 붙였다. 이번 글에서는 데이터에 박혀 있는 상수를 변수로 바꾸고 조건(Condition) 열의 역할을 다시 정의한 뒤, 개발자 코멘트와 명시적 ID로 표를 정리한다.

**이 글의 핵심 요약**

- 텍스트 속 숫자는 포맷 연산자(%d)와 변수로 바꾸면 행과 번역 비용이 줄어든다.
- Condition 열은 플레이어용 문장, 실제 값, 개발자용 코멘트로 역할을 나눈다.
- 전역에서 쓰는 중복 Key는 따로 모으고 넘버링 ID는 이름만 봐도 뜻을 알 수 있는 명시적 ID로 바꾼다.

---

## 상수를 변수로

데이터가 상수로 들어가 있으면 그 데이터의 아주 일부만 바뀌게 되더라도 그것을 다른 데이터로 인식한다. 즉, 추가된 데이터의 개수만큼 행이 필요하게 된다.

![붕괴 3rd 복귀 시스템 역기획 2편 – 상수를 변수로](data:image/png;base64,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)

위에서 보다시피, 상수에서는 숫자 1부터 5가 모두 상수 데이터로 들어가 있어서 상수의 수 만큼 행이 늘어났다. 반면 변수는 ‘n’이라고 하는 변수를 설정하고, 그 자리에 1이 오든 5가 오든 행은 1개만 필요하다. 변수로 지정하는 쪽이 훨씬 효율적이다.

보통 로컬라이즈에서는 위와 같은 상수 데이터가 많이 발생하는데, 따라서 불필요한 중복 번역이 많이 발생하게 된다. 그리고 이는 비용으로 이어진다. 따라서 상수와 변수 계획을 잘 세워둔다면 중복 데이터를 조금이라도 더 줄일 수 있다.

![붕괴 3rd 복귀 시스템 역기획 2편 – 상수를 변수로 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-139-1024x395.avif)

위 표는 1편에서 KEY 열을 추가하고 열 머리글을 수정한 ‘복귀 임무’ 데이터의 표다.

![붕괴 3rd 복귀 시스템 역기획 2편 – 상수를 변수로 (3)](https://subculturegamer.com/wp-content/uploads/2023/04/image-140-1024x553.avif)

그런데 지금 보니, Condition\_1 열에 입력한 데이터는 사실 플레이어에게 노출되는 텍스트다. 즉, 이렇게 입력을 해도 조건 데이터로써 기능할 수 없다. 플레이어가 보는 텍스트이기 때문에 Condition이 아니라 Text로 분류하는 게 맞다. 이런 요인이 계속 쌓이다보면 나중에 예기치 못한 데이터 오류를 초래하거나 커뮤니케이션 미스를 일으킬 수 있으니 이 부분부터 먼저 수정하도록 하자.

먼저 플레이어가 직접 눈으로 볼 수 있는 텍스트이기 때문에 텍스트로 빼도록 하자.

위에 첨부한 실제 게임 인게임 이미지를 확인해보면,

- 하얀색 텍스트: 제목 부분
- 회색 텍스트: 본문 부분
- 노란색 텍스트 : 변수(Parameter) 부분

여기서 하얀색 텍스트외 회색 텍스트는 고정되어 있고, 노란색 텍스트는 수치가 1000, 2000, 3000, 4000 등으로 바뀌고 있다.

따라서 하얀색 텍스트와 회색 텍스트는 로컬라이즈로 따로 관리하도록 한다.

그렇다면 저 변수에 해당하는 노란색 텍스트는 엑셀에 어떻게 기입하면 될까?

---

## 변수값을 포맷연산자로 표기

변수는 값이 계속 변하기 때문에 숫자 1, 2 등을 입력해둘 수 없다. 이럴 땐 값을 입력하는 자리에 ‘변수가 들어간다’고 알리기 위한 포맷연산자를 입력하면 된다.

> 포맷연산자(*format* specifier)란, 원하는 위치에 출력할 데이터 유형(자료형)을 정의하는 연산자를 말한다.
>
> 예를 들어, ‘3등’, ‘4등’, ‘5등’처럼 숫자 3,4,5가 입력된 자리의 값만 바뀌는 데이터가 있다고 한다면, 이 숫자가 있는 자리에 포맷연산자 ‘%d’를 입력한다.(파이썬 기준) 그리고 %d에 들어가는 값을 따로 변수처럼 관리하면 된다.

그렇다면 위의 텍스트를 포맷연산자 표기를 반영하여 수정하면 아래처럼 변경될 것이다.

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-6.png)

숫자가 있던 자리에 포맷연산자 ‘%d’가 들어가게 되었다. 그렇다면 이 %d에 숫자를 어떻게 넣을까? 이 값은 Condition 열에 입력한 값을 불러오는 구조로 만들어보도록 하자.

---

## Condition 설정

Condition은 사용자의 눈에 보이지 않는다. 사용자가 볼 수 있는 건 조건이 쓰여진 ‘텍스트’일 뿐이다.

![붕괴 3rd 복귀 시스템 역기획 2편 – Condition 설정](https://subculturegamer.com/wp-content/uploads/2023/04/fingers-gc6d97a4ec_1280-1024x706.avif)

가위바위보를 생각해보자. 가위는 보를 이기고, 보는 바위를 이기고, 바위는 가위를 이긴다. 이게 바로 가위바위보 게임의 룰이다. 그런데 이 ‘룰’은 눈에 보이는 게 아니다. 우리 모두가 암묵적으로 알고 있는 규칙이다. 조건도 이러한 가위바위보 룰처럼 눈에 보이지 않는 규칙 같은 것이다.

‘기억 전장에서 누적 %d점 획득’이라는 조건을 보자.

여기서 중요한 건 이 조건이 행해지는 콘텐츠의 이름인 ‘기억 전장’, 그리고 이 콘텐츠에서 달성할 수 있는 지표에 해당하는 누적 ‘%d’점 획득이다. 간단하게 정리하자면, 어떤 ‘콘텐츠’에서 어떤 ‘조건’을 달성하라는 말이다. 이것을 Condition에 적어주도록 하자.

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-7.png)

여기에서 생각해보자.

Condition\_1에 입력한 값을 보면, ‘월정액 가입’, ‘BP 경험치 달성’, ‘초끈 공간 특정 스테이지 완료’ 등이 입력된 것을 확인할 수 있다.

그런데 이러한 값은 실제 게임 내부에 어떤 개발명 및 ID로 들어가 있는지 알 수 있는 방법이 없다.

또한, 저 조건식(Condition\_1)을 게임 내에서 실제로 불러오지 않는다. 실제 조건은 콘텐츠 내부에 포함되어 구동될 것이다.

예를 들어 ‘초끈 공간’이라는 콘텐츠가 있다면, 그 콘텐츠 내부에 있는 함수 및 데이터를 위의 복귀 시스템에서 ‘참조’하는 구조는 가능할 것이다.

따라서 위 표에 구체적인 함수 및 데이터의 값 기입은 무의미하다.

하지만 우리가 위의 값을 적는 이유가 뭘까. 그건 바로 위 문서가 ‘기획서’이기 때문이다. 협업 부서 개발자에게 내가 원하는 ‘니즈’를 전달하는 것도 중요하다.

따라서 위의 Condition\_1에 기입한 텍스트는, 프로그래머(개발자)에게 디자이너(기획자)가 원하는 조건을 기입한 협업용 텍스트 열이라고 정의하도록 하자. 나는 이러한 개발자용 열에는 \_dev\_라는 문자열을 붙이겠다.

정작 프로그래머에게 중요한 건, 해당 조건의 ‘수치(Value)’이다. 따라서 이 값은 콘텐츠 등에서 불러올 수 있도록 위 기획서에 적어주는 게 중요하다.

쉽게 말해, 여기서 적어주는 건 메이플스토리에서 “‘주황버섯’을 ‘999’마리 잡기”퀘스트의, ‘주황버섯’과 ‘999’에 해당하는 데이터다.

따라서 저 Condition\_1은 개발자용 텍스트로 분류하고, 실제로 중요한 ‘수치’ 데이터를 기입하는 열을 우측에 빼두도록 하자.

그렇게 정리한 표는 아래와 같다.

![붕괴 3rd 복귀 시스템 역기획 2편 – Condition 설정 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-145-1024x250.avif)

다른 표의 값들도 이번 글에서 진행한 규칙에 따라 정리하도록 하자.

여기까지가 변수와 조건 정리다. 데이터가 꽤 정리됐으니 이제 참조 구조를 준비하면서 ID를 손볼 차례다.

---

## 개발자 코멘트 추가

이제 데이터의 정리가 많이 진행되었으니, 슬슬 데이터 구조를 참조 구조로 변경하려고 한다.

그런데 참조 구조로 변경하게 되면, 현재 표 안에 입력된 데이터가 정확히 어떤 데이터였는지 알기가 어려워진다.

따라서 개발자 코멘트를 추가하여 추후 이 데이터가 어떤 데이터였는지 더 알기 쉽도록 표기를 추가해보았다.

그러면 현재까지 진행된 테이블 업데이트 내역은 아래와 같다.

---

![붕괴 3rd 복귀 시스템 역기획 2편 – 개발자 코멘트 추가](https://subculturegamer.com/wp-content/uploads/2023/04/image-146-1024x185.avif)![붕괴 3rd 복귀 시스템 역기획 2편 – 개발자 코멘트 추가 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-147-1024x225.avif)
![붕괴 3rd 복귀 시스템 역기획 2편 – 개발자 코멘트 추가 (3)](https://subculturegamer.com/wp-content/uploads/2023/04/image-148-1024x174.avif)
![붕괴 3rd 복귀 시스템 역기획 2편 – 개발자 코멘트 추가 (4)](https://subculturegamer.com/wp-content/uploads/2023/04/image-149-1024x200.avif)
![붕괴 3rd 복귀 시스템 역기획 2편 – 개발자 코멘트 추가 (5)](https://subculturegamer.com/wp-content/uploads/2023/04/image-150-1024x50.avif)
![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-8.png)
![붕괴 3rd 복귀 시스템 역기획 2편 – 개발자 코멘트 추가 (6)](https://subculturegamer.com/wp-content/uploads/2023/04/image-154-1024x73.avif)

---

## 중복 Key 제거

정리된 내용을 쭉 훑어보니, 일부 중복된 값이 보인다.

예를 들어, ‘복귀 출석’ 페이지에서 사용하는 ‘남은 기간: %d일 %d시’는, 복귀 임무, 보너스 상점 등에서도 똑같이 사용하고 있다. 즉, 이 키는 복귀 페이지 전역에서 사용하고 있으니 특정 세부 항목 페이지로 키를 두는 건 비효율적이다. (중복값이 발생하므로)

![붕괴 3rd 복귀 시스템 역기획 2편 – 중복 Key 제거](https://subculturegamer.com/wp-content/uploads/2023/04/image-158-1024x637.avif)

데이터를 관리하다보면 중복값은 계속 발생한다. 이는 어쩔 수 없다. 하지만 중복값을 계속 방치하게 된다면 예상치 못한 여러 가지 문제가 발생한다.

- 엑셀, 스프레드 시트를 불러오는 데 걸리는 시간이 늘어나는 문제
- 키가 서로 충돌하거나 호환되지 않는 문제
- 프로그램에서 버그를 일으키는 문제
- 중복값을 모두 번역 또는 확인해야 하므로 비용(시간, 금전)이 증가하는 문제
- 그 외 예기치못한 문제

나는 중복값을 통해 위의 문제를 경험한 바 있다. 따라서 중복값이 있을 수밖에 없다는 사실은 인정하되, 최대한 구조적으로 중복값을 예방하는 것이 중요하다고 생각한다.

따라서 전역적으로 사용하는 키는 별도로 표를 만들어서 관리하도록 하고, 기존에 각 세부 항목에 들어간 키는 삭제하도록 하자.

![붕괴 3rd 복귀 시스템 역기획 2편 – 중복 Key 제거 (2)](https://subculturegamer.com/wp-content/uploads/2023/04/image-155-1024x244.avif)

기존의 LocalizeKey\_Return\_Attendance\_01에 해당하던 ‘복귀 출석 남은 기간’을 복귀 시스템 전역 테이블로 옮기고, 기존 키를 삭제했다.

그리고 나머지 키의 값이 02, 03, 04이므로, 01부터 다시 부여하였다.

원래 Key값은 한 번 부여하면 웬만해서는 수정이 어렵다. 참조 구조가 깨지기 때문이다. 하지만 지금은 아직 참조 구조로 연결하기 전이라서 ID도 바꿀 수 있는 상황이다. 따라서 참조 구조가 되기 전에서나 이런 변경이 수월하다는 점에 유의하도록 하자. (이미 참조식이 짜인 경우 수정하는 건 불가능한 건 아니나 복잡하고 버그가 일어나기 매우 쉽다.)

---

## 명시적 ID 부여

지금까지는 ID의 이름 규칙을 계속 넘버링을 하는 식으로 쌓아왔다.

하지만 이런 ID로 데이터를 계속 관리하게 되면, 추후 어떤 ID가 어떤 항목을 가지고 있는지 확인하기가 어렵다. 이는 협업하는 환경에서 유지보수를 정말 어렵게 만든다.

따라서 지금까지 임시 ID로 부여한 넘버링 ID를 이제 명시적 ID로 변경할 것이다.

아래는 Reference 테이블에 이전에 별도로 정리한 아이템 및 카테고리의 ID를 최신화한 것이다.

![Image](https://subculturegamer.com/wp-content/uploads/2023/04/image-9.png)

실제 그 아이템의 개발명은 알 수 없기에, 플레이어에게 노출되는 ‘아이템명’ 기준으로 영어로 Key를 부여해보았다.

이렇게 이름을 바꾸면 01, 02일 때보다 Key만 보더라도 그 아이템이 무엇인지 알 수 있다.

하지만 이렇게 하면 입력하기 더 어려워지기 때문에 아이템명을 이렇게 길게 하기보다는 스튜디오 내부의 규칙을 마련하여 더 협업에 용이한 아이템명을 정하는 것이 좋다.

다음 글에서는 표마다 흩어져 있던 로컬라이즈 데이터를 별도의 테이블로 옮긴다. → [다음 글: 역기획 3: 로컬라이즈 테이블 분리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-3/)

---

## 붕괴 3rd 복귀 시스템 역기획 시리즈

1. [시리즈 소개: 게임 역기획서 작성 실전 가이드](https://subculturegamer.com/honkai3rd-return-system-reverse-design/)
2. [붕괴 3rd 복귀 시스템 역기획 1: 자료 확보와 Key 설계](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-1/)
3. **붕괴 3rd 복귀 시스템 역기획 2: 변수화와 Condition, ID 정리** (현재 글)
4. [붕괴 3rd 복귀 시스템 역기획 3: 로컬라이즈 테이블 분리](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-3/)
5. [붕괴 3rd 복귀 시스템 역기획 4: 아이템 Key 규칙과 엑셀 참조 구조](https://subculturegamer.com/honkai-3rd-return-system-reverse-design-step-4/)
6. [붕괴 3rd 복귀 시스템 분석: 게임디자인 관점에서 본 복귀 설계](https://subculturegamer.com/honkai3rd-return-system-analysis/)
