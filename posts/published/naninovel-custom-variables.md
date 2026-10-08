---
title: "나니노벨 Custom Variables"
url: https://subculturegamer.com/naninovel-custom-variables/
published: 2025-01-05
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/custom-variables)

※마지막 수정일: 2025/1/5

---

커스텀 변수(Custom Variables) 기능으로 커스텀 변수를 생성해 이를 수정하고 사용하여 나니노벨 스크립트 또는 기타 시스템의 조건부 실행을 구동할 수 있습니다.

예를 들어, 커스텀 변수를 사용해 플레이어가 과거에 내린 결정을 기반으로 여러 나니노벨 스크립트(시나리오 경로) 중 하나를 선택해 재생시킬 수 있습니다. 자주 쓰이는 또 다른 상황은 플레이어가 게임 전반에 걸쳐 내리는 선택을 기반으로 플레이어 통계를 화면(예: 점수, 돈, 자원 등)에 보여주는 등 입니다.

> **메모**
>
> 변수 이름은 문자로 시작해야 하며 라틴 문자, 숫자, 밑줄만 포함할 수 있습니다.
>
> - 예: name, Char1Score, my\_score;
>
> 이름은 대소문자를 구분하지 않습니다.
>
> - 예: myscore는 MyScore와 같습니다.

@set 및 @if 명령어로 나니노벨 스크립트와 ICustomVariableManager [엔진 서비스](https://naninovel.com/guide/engine-services)를 사용하는 C# 스크립트에서 커스텀 변수를 생성, 수정 및 사용할 수 있습니다.

예를 들어 다음 스크립트 명령어는 선택지에 따라 score 커스텀 변수에 각기 다른 값을 할당합니다.

```
@choice "I'm humble, one is enough..." set:score=1
@choice "Two, please." set:score=2
@choice "I'll take your entire stock!" set:score=999
```

그리고 다음의 명령어는 score 변수값에 기반하여 스크립트 실행을 다시 분기시킵니다.

```
@goto MainRoute if:"score > 1 && score <= 900"
@goto BadEnd if:score>900
```

[@set](https://naninovel.com/api/#set) 및 [@if](https://naninovel.com/api/#if) 명령어에 대한 더 많은 예시는 각 명령어의 API 레퍼런스를 참조하세요.

모든 커스텀 변수는 게임과 함께 자동으로 저장됩니다.

기본적으로 변수는 로컬 범위에 저장됩니다. 즉, 게임 플레이 과정에서 일부 변수를 할당한 상태에서, 플레이어가 새 게임을 시작하거나 해당 변수가 할당되지 않은 다른 저장된 게임 슬롯을 로드하면 값이 손실됩니다. 이는 대부분의 변수 타입에서 유용하게 쓰입니다.

그러나 전역 범위에 변수를 저장하려면 이름 앞에 G\_ 또는 g\_를 추가하세요 (예: G\_FinishedMainRoute 또는 g\_total\_score).

전역 변수는 일부 메타 또는 전체 정보(예: 플레이어가 일부 경로를 완료한 횟수 또는 모든 플레이를 기반으로 한 총 점수)를 나타내는 데 사용할 수 있습니다.

![나니노벨 Custom Variables - Project Settings](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-variables-1.avif)

‘Custom Variables’ 구성 메뉴에서 초기값으로 커스텀 변수(전역 및 로컬 모두)를 사전에 정의하여 설정할 수 있습니다.

사전에 정의된 전역 변수는 처음 애플리케이션을 시작할 때 초기화되는 반면, 로컬 변수는 각 상태가 재설정될 때 초기화됩니다. 메뉴의 값 필드에는 원시 값 문자열이 아닌 유효한 스크립트 표현식이 필요합니다.

> **팁**
>
> 다시 플레이할 때(예: 롤백하거나 게임을 다시 시작한 후)에도 한 번만 증가하는 일종의 전역 카운터를 만들고 싶다면 HasPlayed() [표현식 함수](https://naninovel.com/guide/script-expressions#expression-functions)를 사용하세요.

```
@set g_GlobalCounter++ if:!HasPlayed()
```

---

## 변수 인젝션

중괄호를 사용하여 naninovel 스크립트 매개변수 값에 커스텀 변수를 인젝션(인라인)할 수 있습니다.

다음 스크립트는 사용자가 임의의 텍스트를 입력할 수 있는 입력 필드 UI를 보여줍니다. 제출하면 입력한 텍스트가 지정된 커스텀 변수에 할당됩니다.

```
; 유저가 임의의 텍스트를 입력하고 `name` 변수에 할당할 수 있도록 합니다.
@input name summary:"Choose your name."

; 유저가 입력할 때까지 스크립트 실행을 중지합니다.
@stop

; 그 다음 naninovel 스크립트에 할당된 `name` 변수를 삽입할 수 있습니다.
Archibald: Greetings, {name}!

; ...또는 @set 명령어와 함께 조건부 표현식을 사용할 수 있습니다.
@set score+=3 if:name=="Felix"
```

> **팁**
>
> 캐릭터 이름을 동적으로 만들려면 *[display name](https://naninovel.com/guide/characters#display-names)* 기능을 사용하세요.

타입이 허용하는 한 모든 매개변수 값에 커스텀 변수를 삽입할 수 있습니다. 예를 들어 스트링(문자열)을 integer(숫자) 매개변수에 할당할 수 없습니다.

```
@set PlayerName="Felix";PlayerYPosition=0.1;PlayerTint="lightblue"

; 다음은 `PlayerTint`가 숫자가 아니기 때문에 오류를 생성합니다.
@char {PlayerName} pos:50,{PlayerTint}

; ...아래의 식은 정상 동작합니다.
@char {PlayerName} pos:50,{PlayerYPosition} tint:{PlayerTint}
```

---

## 변수 트리거

커스텀 UI 또는 기타 시스템을 구축할 때 변수 값이 변경될 때 이벤트를 수신(반응)하게 하고 싶을 수 있습니다. 예를 들어, 캐릭터 통계 화면을 생성할 때 텍스트가 변수로 업데이트되기를 원할 수 있습니다.

![나니노벨 Custom Variables - Inspector](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-variables-2.avif)

이러한 동작을 구현하는 일반적인 방법은 C# 스크립트를 사용하는 것이지만 `Custom Variable Trigger` 컴포넌트를 사용할 수도 있습니다. 이 컴포넌트는 지정된 이름을 가진 변수가 변경될 때 Unity 이벤트를 호출합니다.

> **예시**
>
> [map sample](https://naninovel.com/guide/samples#map)에서 지도 위치의 가용성을 높이기 위해 변수 트리거를 사용하는 예를 찾아보세요.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-4987b1c53cd275f3fa56b533f53f3d8c.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-4987b1c53cd275f3fa56b533f53f3d8c.mp4@main.mp4?_=1)

---

## 변수 디버깅

게임이 실행되는 동안 모든 현존하는 변수를 확인하고 디버깅 목적으로 해당 값을 변경할 수 있습니다.

개발 콘솔([development console](https://naninovel.com/guide/development-console))을 열고 var 명령어를 입력하여 변수 편집기 창을 엽니다.

![나니노벨 Custom Variables - 변수 디버깅](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-variables-3.avif)

목록에 있는 변수의 값을 변경하면 ‘SET’ 버튼이 나타나며, 이 버튼을 눌러 변경 사항을 적용할 수 있습니다.

게임 실행 중 커스텀 변수가 변경되면 변수 목록이 자동으로 업데이트됩니다.

---

## C#에서 커스텀 변수 사용하기

커스텀 변수는 *ICustomVariableManager* [엔진 서비스](https://naninovel.com/guide/engine-services)로 C#에서 액세스할 수 있습니다.

변수 값을 얻으려면 *GetVariableValue(name)* 메소드와 *SetVariableValue(name, value)*를 사용하여 변수 값을 설정하십시오. 예를 들어 ‘MyVarName’ 커스텀 문자열 변수가 존재하는 경우 아래 코드는 이를 검색하고 ‘Hello!’를 추가합니다. 값에 문자열을 추가하고 다시 설정합니다.

```
var varManager = Engine.GetService<ICustomVariableManager>();
var myValue = varManager.GetVariableValue("MyVarName");
myValue += "Hello!";
varManager.SetVariableValue("MyVarName", myValue);
```

모든 커스텀 변수 값은 스트링(문자열)으로 저장된다는 점에 유의하세요. 이를 다른 유형(예: 정수, 부울 등)으로 사용하려면 반환된 문자열 값을 원하는 유형으로 구문 분석하고 값을 설정할 때 다시 문자열로 캐스팅해야 합니다.

가장 일반적인 데이터 유형의 경우 확장 방법을 사용할 수 있습니다. 예:

```
var varManager = Engine.GetService<ICustomVariableManager>();

varManager.TryGetVariableValue<float>("MyFloatVarName", out var floatValue);
Debug.Log($"My float variable value: {floatValue}");

varManager.TryGetVariableValue<int>("MyIntVarName", out var intValue);
Debug.Log($"My integer variable value: {intValue}");

varManager.TryGetVariableValue<bool>("MyBoolVarName", out var boolValue);
Debug.Log($"My boolean variable value: {boolValue}");

floatValue += 10.5f;
varManager.TrySetVariableValue("MyFloatVarName", floatValue);

intValue = -55;
varManager.TrySetVariableValue("MyIntVarName", intValue);

boolValue = !boolValue;
varManager.TrySetVariableValue("MyBoolVarName", boolValue);
```

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)