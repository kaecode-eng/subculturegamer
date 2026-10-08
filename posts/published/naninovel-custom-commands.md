---
title: "나니노벨 Custom Commands"
url: https://subculturegamer.com/naninovel-custom-commands/
published: 2024-11-30
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

※원문 페이지: [(링크)](https://naninovel.com/guide/custom-commands)

※마지막 수정일: 2025/11/23

---

명령어는 씬에서 일어나는 일을 제어하는 단일 작업을 의미합니다.

예를 들어, 배경을 변경하거나 캐릭터를 이동시키거나 다른 Naninovel 스크립트를 불러오는 데 사용할 수 있습니다.

[Naninovel 스크립트](https://naninovel.com/guide/naninovel-scripts)에 정의한 매개변수화된 명령어 시퀀스는 게임의 흐름을 효과적으로 제어합니다. [API reference](https://naninovel.com/api/)에서 이미 정의된(빌트인) 명령어 목록을 확인하실 수 있습니다.

코드에서 모든 내장 스크립트 명령어 구현은 *Naninovel.Commands* 이름공간 하위에서 정의됩니다.

---

## 커스텀 명령어 추가하기

커스텀 스크립트 명령어를 추가하려면 *Command*에서 파생된 새 C# 클래스를 만들고 *Execute*로 추상 메서드를 구현합니다.

생성된 클래스는 엔진에 의해 자동으로 선택되며 클래스 이름이나 별칭(할당된 경우)을 사용하여 naninovel 스크립트에서 명령을 호출할 수 있습니다. naninovel 명령에 별칭을 할당하려면 *CommandAlias* ​​특성을 클래스에 적용합니다.

다음은 Naninovel 스크립트에서 *@HelloWorld* 또는 *@hello*라는 명령어를 입력했을 때 콘솔창에 ‘Hello World!’ 텍스트를 출력하는 커스텀 명령어의 예시입니다. name 파라미터를 이용하여 (예: @hello name:Felix) ‘Hello world!’ 대신에 ‘Hello Felix!’라는 이름으로 출력시키는 것도 가능합니다.

```
using Naninovel;
using Naninovel.Commands;
using UnityEngine;

[CommandAlias("hello")]
public class HelloWorld : Command
{
    public StringParameter Name;

    public override UniTask Execute (AsyncToken asyncToken = default)
    {
        if (Assigned(Name)) Debug.Log($"Hello, {Name}!");
        else Debug.Log("Hello World!");
        return UniTask.CompletedTask;
    }
}
```

### Execute 메서드

*Execute*는 비동기 메서드로써 명령어가 명령어 로직이 위치하고 있는 스크립트 플레이어에 의해 재생될 때 호출됩니다.

engine services를 이용하여 (나니노벨) 엔진에 내장된 시스템에 접근 가능합니다.

Naninovel 스크립트에서 Execute 시에는 Wait 매개변수가 True일 때 이 메서드가 Task를 완료 처리할 때까지 잠시 멈추게 됩니다.

### 비동기토큰

*Execute* 메서드에 의해 전달되는 선택적 *AsyncToken* 구문을 확인하세요. [비동기 작업](https://docs.microsoft.com/en-us/dotnet/csharp/programming-guide/concepts/async/)을 수행할 때 각 비동기 작업 후에 취소 및 완료 요청에 대한 토큰을 확인하고 그에 따라 대응하십시오.

- *AsyncToken.Canceled*는 (나니노벨) 엔진이 종료되었거나 리셋되었음을 의미합니다. 두 경우 모두 엔진 API를 사용하는 것이 더 이상 안정적이지 않으며 상태 변화로 인해 정의되지 않은 동작이 발생하게 될 것입니다. 취소되었을 시 명령어 구현은 즉시*AsyncOperationCanceledException*을 발생시키고 현재 수행된 활동을 모두 삭제하게 됩니다.
- AsyncToken.Completed는 명령어가 모든 활동을 가능한 한 빨리 완료해야 함을 의미합니다. 예를 들어 애니메이션을 실행 중인 경우 해당 작업의 예상 완료 기간에 관계없이 즉시 완료시킵니다. 보통 플레이어가 계속하기 입력을 활성화시키거나 게임 저장 작업이 시작되었을 때 일어납니다.

```
public override async UniTask Execute (AsyncToken asyncToken = default)
{
    await PerformSomething();
    // 위 메서드 동작 중 엔진이 디스트로이되었을 수 있습니다.
    // 위 경우, 아래 명령어는 상태 확인 후 예외처리를 동작시킵니다.
    asyncToken.ThrowIfCanceled();
    // 체크 이후 엔진 API를 동작시킵니다.
    var someUI = Engine.GetService<IUIManager>().GetUI<SomeUI>();
    // 완료 요청을 받은 경우 UI를 즉시 페이드합니다.
    var fadeDuration = asyncToken.Completed ? 0 : 5;
    await someUI.ChangeVisibility(false, fadeDuration, asyncToken);
    // 위의 방법은 토큰을 수락했으며, 이러한 방법은 내부적으로 
    // 취소 처리하므로 취소 후 확인할 필요가 없습니다.
}
```

### 파라미터 타입

Naninovel 스크립트에 명령어 파라미터를 노출시키려면 지원되는 유형 중 하나를 사용하여 명령어 클래스에 공개 필드(public field)를 추가하십시오.

| 필드 타입 | 값 타입 | 스크립트 예시 |
| --- | --- | --- |
| StringParameter | String | `LoremIpsum`, `"Lorem ipsum"` |
| LocalizableTextParameter | LocalizableText | `"Lorem ipsum|#id|"` |
| IntegerParameter | Int32 | `10`, `0`, `-1` |
| DecimalParameter | Single | `0.525`, `-55.1` |
| BooleanParameter | Boolean | `true`, `false` |
| NamedStringParameter | NamedString | `Script001.LabelName`, `.LabelName` |
| NamedIntegerParameter | NamedInteger | `Yuko.5` |
| NamedDecimalParameter | NamedFloat | `Kohaku.-10.25` |
| NamedBooleanParameter | NamedBoolean | `Misaki.false` |
| StringListParameter | List<String> | `Lorem,ipsum,"doler sit amet"` |
| IntegerListParameter | List<Int32> | `10,-1,0` |
| DecimalListParameter | List<Single> | `0.2,10.5,-88.99` |
| BooleanListParameter | List<Boolean> | `true,false,true` |
| NamedStringListParameter | List<NamedString> | `Felix.Happy,Jenna.Confidence` |
| NamedIntegerListParameter | List<NamedInteger> | `Yuko.5,Misaki.-8` |
| NamedDecimalListParameter | List<NamedFloat> | `Nanikun.88.99,Yuko.-5.1` |
| NamedBooleanListParameter | List<NamedBoolean> | `Misaki.false,Kohaku.true` |

### 파라미터 약어

선택적으로 *[ParameterAlias]* 특성을 필드에 적용하여 naninovel 스크립트에서 파라미터를 참조할 때 필드 이름 대신 파라미터에 별칭 이름을 할당해 사용할 수 있습니다.

파라미터를 이름 없이 설정하려면 NamelessParameterAlias ​​상수(빈 문자열)를 별칭으로 설정하세요. 명령어당 하나의 이름 없는 파라미터만 허용됩니다.

```
[ParameterAlias(NamelessParameterAlias)]
public StringParameter MyNamelesParameter;
[ParameterAlias("myParam")]
public StringParameter MyParameter;
```

```
@cmd "value of the nameless param" myParam:"value of 'MyParameter' param"
```

### 파라미터가 필수인 명령어

파라미터가 필수인 명령어를 만들려면(naninovel 스크립트에 지정되지 않은 경우 오류가 기록되도록 함) 해당 필드에 [RequiredParameter] 특성을 적용하세요. 속성이 적용되지 않으면 파라미터가 옵션 사항으로 간주됩니다.

```
[RequiredParameter]
public StringParameter MyRequiredParameter;
```

### 파라미터가 옵션인 명령어

파라미터가 필요하지 않은 경우 시나리오 스크립트에 값이 할당되거나 할당되지 않을 수 있습니다. *HasValue* 프로퍼티를 사용하여 이것이 사실인지 테스트할 수 있습니다.

또한, *Assigned()* 정적 메서드를 사용해 제공된 파라미터가 null값이 아니고 값이 할당된 경우에 대해 true 값을 반환하는 파라미터 인스턴스를 만들 수 있습니다.

```
public StringParameter MyOptionalParameter;
...
if (MyOptionalParameter.HasValue) { }
if (Assigned(MyOptionalParameter)) { }
```

### 로컬라이즈 가능한 명령어

명령어에 로컬라이즈 가능한 파라미터(일반적으로 사용자에게 직접 표시되는 텍스트)가 있는 경우 *Command.ILocalized* 인터페이스를 구현하여 생성된 스크립트 로컬라이즈 문서에 명령어를 추가하고 *LocalizedTextParameter* 파라미터 타입을 사용합니다.

```
public class PrintText : Command, Command.ILocalizable
{
    public LocalizableTextParameter Text;
}
```

### 사전 로드 가능한 명령어

명령어를 실행하기 위해서는 일부 리소스를 사전 로드해야 하는 경우가 있을 수 있습니다. *Command.IPreloadable* 인터페이스를 구현하여 게임을 로드할 때 필요한 리소스를 미리 로드하세요. 자세한 내용은 [메모리 관리 가이드](https://naninovel.com/guide/memory-management)를 참조하세요.

```
public class PlayAudioClip : Command, Command.IPreloadable
{
    public StringParameter ClipPath;

    public async UniTask PreloadResources ()
    {
        if (!Assigned(ClipPath) || ClipPath.DynamicValue) return;
        await ... (load the audio clip here)
    }

    public void ReleasePreloadedResources ()
    {
        if (!Assigned(ClipPath) || ClipPath.DynamicValue) return;
        ... (unload the clip here)
    }
}
```

*ClipPath.DynamicValue* 확인에 유의하세요. 명령어가 실행될 때만 이름이 알려진 경우(예: 파라미터가 [스크립트 표현식](https://naninovel.com/guide/script-expressions)을 포함하는 경우) 리소스를 미리 로드할 수 없습니다. 이 경우 리소스는 *Execute* 메서드 내에 로드되어야 합니다.

### 명령어 예시

*Naninovel/Runtime/Commands* 패키지 폴더에서 모든 빌트인 명령어 구현이 포함된 스크립트를 찾을 수 있습니다.

커스텀 명령어를 구현할 때 이를 참고로 삼아 자유롭게 사용하십시오.

> 예시
>
> 인벤토리 시스템의 항목을 추가/제거하기 위해 커스텀 명령어를 추가하는 또 다른 예는 [GitHub의 인벤토리 예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/inventory)에서 찾을 수 있습니다.
>
> 특히 명령어 구현은 [Runtime/Commands](https://github.com/naninovel/samples/tree/main/unity/inventory/Assets/NaninovelInventory/Runtime/Commands) 디렉터리에 저장됩니다.

---

## 빌트인 명령어 재정의하기

어떤 경우에는 빌트인 Naninovel 명령어를 재정의하는 것이 유용할 수 있습니다.

예를 들어, 커스텀 명령어를 추가하지 않고 @print 명령이 작동하는 방식을 변경하여 변경 사항이 일반 텍스트 줄에도 영향을 미치도록 할 수 있습니다(일반 줄의 텍스트는 내부적으로 print 명령어로 파싱됩니다).

빌트인 명령어를 재정의하려면 커스텀 명령어를 추가하고 빌트인 명령어와 동일한 별칭을 적용하세요. 변경 사항을 적용하려면 명령을 재정의한 후 naninovel 스크립트를 다시 가져옵니다(저장된 폴더를 마우스 오른쪽 버튼으로 클릭한 다음 ‘다시 가져오기’ 클릭). 그러면 naninovel 스크립트를 재생시킬 때 빌트인 명령 대신 커스텀 명령어가 자동으로 사용됩니다.

다음은 빌트인 @print 명령을 재정의하여 출력된 텍스트가 플레이어에게 보여지기 전에 콘솔에 로그가 남게 되는 예입니다.

```
[CommandAlias("print")]
public class MyCustomPrintCommand : PrintText
{
    public override UniTask Execute (AsyncToken asyncToken = default)
    {
        Debug.Log(Text);
        return base.Execute(asyncToken);
    }
}
```

명령과 매개변수에는 IDE 및 웹 편집기에서 문서화, 자동 완성 및 고급 진단 기능을 제공하기 위해 다양한 컨텍스트 속성이 적용될 수 있습니다. 사용 가능한 속성은 IDE 확장 가이드에서 확인하세요.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)