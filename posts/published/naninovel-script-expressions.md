---
title: "나니노벨 Script Expressions"
url: https://subculturegamer.com/naninovel-script-expressions/
published: 2024-11-17
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Script Expressions](https://subculturegamer.com/wp-content/uploads/2024/11/나니노벨-script-expressions.png)

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/script-expressions)

---

나니노벨 스크립트를 작성할 때 중괄호 {}를 사용하여 명령어 매개변수 값과 일반 텍스트 라인에 표현식 구문을 삽입할 수 있습니다.

```
1 더하기 2는 {1 + 2}.
```

위 구문은 *1 더하기 2는 3.* 을 출력할 것입니다.

[UnityEngine.Mathf](https://docs.unity3d.com/ScriptReference/Mathf.html) 및 [System.Math](https://docs.microsoft.com/en-us/dotnet/api/system.math#methods) 네임스페이스의 모든 수학 함수뿐만 아니라 모든 수학 및 논리 연산자를 사용할 수 있습니다.

```
@char Kohaku scale:{Pow(Cosh(33.5), 3) % Log(0.5)}
```

위 구문은 ID Kohaku 캐릭터의 크기를 33.5도의 쌍곡선 코사인을 세제곱으로 나눈 후 자연 로그 0.5로 나눈 값의 나머지로 조정합니다.

명령어가 실행되는 순간 구문 내 식이 계산됩니다. 따라서 구문 내에서 [커스텀 변수](https://naninovel.com/guide/custom-variables)를 사용할 수 있습니다.

```
@input color summary:"가장 좋아하는 색이 무엇입니까?"
@stop
{color}, 말이죠? { color == "오렌지" ? "저도요!" : (color == "블랙" ? "그건 별로네요." : "아 네...") }
```

위 구문은 플레이어가 좋아하는 색상을 입력할 수 있는 입력창 UI를 보여줍니다. 여기에 입력한 값은 ‘color’ 커스텀 변수에 할당됩니다.

입력한 값이 ‘오렌지’일 경우 ‘저도요!’가 출력되고, ‘블랙’일 경우에는 ‘그건 별로네요.’가 출력됩니다. 그 외의 값을 입력했다면 ‘아 네…’가 출력됩니다.

일반 텍스트 값과 변수 이름을 구별하려면 값을 큰따옴표(” “)로 감싸면 됩니다.

```
이것은 단순한 텍스트입니다: { "score" }.
이것은 'score' 변수의 값입니다 : { score }.
```

구문에 큰따옴표(” “)를 입력하려면 슬래시 기호를 이용해서 이스케이프 처리합니다.

```
{ "차를 멈춰" } 라고 말한 건 실수였다.
```

[@set](https://naninovel.com/api/#set) 및 [@if](https://naninovel.com/api/#if) 명령어(다른 명령어의 매개변수로 사용된 set 및 if 포함)에 사용되는 스크립트 표현식에는 중괄호가 필요하지 않습니다.

```
@set randomScore=Random(-100,100)
@goto EpicLabel if:Abs(randomScore)>=50
```

하지만 다른 모든 매개변수 값과 마찬가지로 표현식 내부에 공백문자(스페이스)를 사용하려면 큰따옴표로 묶어야 합니다.

```
@set "randomScore = Random(-100, 100)"  
@goto EpicLabel if:"Abs(randomScore) >= 50"
```

일반 텍스트 라인 안에 중괄호를 출력시키고자 표현식 시작 및 끝을 나타내는 기호로 인식되지 않도록 하려면 아래의 예시처럼 중괄호를 백슬래시로 이스케이프 처리하세요.

```
Some text { text inside braces }
```

위 구문은 “Some text { text inside braces }”를 출력합니다.

---

## 표현식 함수

다음 함수는 스크립트 표현식 내에서도 사용할 수 있습니다.

| 표현식 | 설명 | 예시 |
| --- | --- | --- |
| Random (*System.Double* min, *System.Double* max) | min 값(포함)과 max 값(포함) 사이의 임의의 부동소수점 숫자를 반환합니다. | `Random(0.1, 0.85)`  //0.1~0.85 사이의 값 중 하나가 반환된다. |
| Random (*System.Int32* min, *System.Int32* max) | min(포함)과 max(포함) 사이의 임의의 정수를 반환합니다. | `Random(0, 100)`  //0~100 사이의 값 중 하나가 반환된다. |
| Random (*System.String[]* args) | 앞서 제공된 문자열 중 하나에서 선택된 문자열을 반환합니다. | `Random("Foo", "Bar", "Foobar")`  //”Foo”, “Bar”, “Foobar” 중 하나가 반환된다. |
| CalculateProgress () | 사용 가능한 모든 naninovel 스크립트의 총 명령 수와 비교하여 실행된 고유 명령 수를 나타내는 0.0에서 1.0 범위의 부동 소수점 숫자를 반환합니다. 1.0은 플레이어가 사용 가능한 모든 게임 콘텐츠를 **읽었거나** **본 것**을 의미합니다. 이 기능을 사용하기 전에 스크립트 구성 메뉴에서 *Count Total Commands*을 활성화해야 합니다. | `CalculateProgress()` |
| IsUnlocked (*System.String* unlockableId) | Checks whether an unlockable item with the provided ID is currently unlocked. 해금 가능 항목 중에 입력한 ID가 현재 해금되었는지 확인합니다. | `IsUnlocked("Tips/MyTip")` |
| HasPlayed () | 현재 플레이되고 있는 명령어가 이전에 플레이된 적이 있었는지 확인합니다. | `HasPlayed()` |
| HasPlayed (*System.String* scriptName) | 제공된 이름의 스크립트가 이전에 플레이되었는지 확인합니다. | `HasPlayed("Script001")`  //Script001의 플레이 여부를 확인 |
| GetName (*System.String* id) | 제공된 ID를 가진 캐릭터 액터의 표시용 이름을 반환합니다. | `GetName("Kohaku")`  //Kohaku의 Display Name을 반환 |

---

## 커스텀 함수 추가하기

*ExpressionFunctions* 특성을 정적 C# 클래스에 할당하여 커스텀 함수를 추가할 수 있습니다. 이 클래스의 호환되는 기호가 있는 모든 퍼블릭 메서드가 자동으로 스크립트 표현식에서 사용 가능해집니다.

인수 및 반환 유형으로는 [simple](https://docs.microsoft.com/en-us/dotnet/csharp/language-reference/language-specification/types#simple-types) 및 문자열 유형만 지원됩니다. 단일 가변(params 키워드) 인수를 사용하는 것도 가능합니다. 가변 변수를 다른 인수와 혼합하는 것은 지원되지 않습니다. 분수를 나타내려면 double 타입을 사용하십시오(float는 지원되지 않음).

```
[Naninovel.ExpressionFunctions]
public static class CustomFunctions
{
    // 제공된 문자열의 모든 문자가 소문자로 변환되어 반환됩니다.
    public static string ToLower (string content) => content.ToLower();

    // 제공된 숫자를 더해서 출력합니다.
    public static int Add (int a, int b) => a + b;

    // 제공된 수를 나눈 나머지가 출력됩니다.
    public static double Modulus (double a, double b) => a % b;

    // 제공된 문자열 중 하나에서 무작위로 선택된 문자열을 반환합니다.
    public static string Random (params string[] args)
	{
            if (args == null || args.Length == 0)
			return default;

            var randomIndex = UnityEngine.Random.Range(0, args.Length);
	    return args[randomIndex];
	}
}
```

### 예시

> 인벤토리에 항목이 있는지 확인하기 위해 커스텀 표현식 함수를 추가하는 또 다른 예는 GitHub의 [인벤토리 예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/inventory)에서 찾을 수 있습니다.
>
> 특히 커스텀 기능은 InventoryFunctions.cs 런타임 스크립트를 통해 구현됩니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)