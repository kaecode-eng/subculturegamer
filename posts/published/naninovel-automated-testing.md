---
title: "나니노벨 Automated Testing"
url: https://subculturegamer.com/naninovel-automated-testing/
published: 2025-02-23
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’ Automated Testing 페이지의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/automated-testing)

※마지막 수정일: 2025/2/23

---

대규모 프로젝트를 만들거나 다양한 팀 멤버가 시나리오 스크립트나 게임 플레이 로직을 수정하는 환경의 팀이라면 게임을 출시하기 전 게임이 제대로 작동하는지 확인하는 게 필수입니다.

상호작용 환경의 게임은 더욱 엄격한 수동 테스트가 필요하나, 그러나 비주얼 노벨에서는 그 과정을 자동화하여 간소화하는 게 가능합니다.

나니노벨은 *Naninovel.E2E* 네임스페이스 하에 도구를 제공하는데, 게임이 동작하는 동안 유저 인터랙션을 시뮬레이트하는 시퀀스 구조를 조성하여 엔드-투-엔드 테스트가 가능하도록 돕습니다.

[유니티 테스트 툴](https://docs.unity3d.com/Packages/com.unity.test-framework@latest)과 결합하면 에디터 상으로 타깃 디바이스나 CI에서 실행되는 자동화 테스트 환경을 구축할 수 있습니다.

![나니노벨 Automated Testing - Test Runner](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-automated-testing-3.avif)

---

## 시작하기

Window -> General -> Test Runner 에디터 메뉴에서 Test Runner 탭을 열고, 플레이 모드 테스트의 설정 지시를 따릅니다.

자세한 내용은 UTF 가이드 문서를 참고하세요. 필요한 API를 사용할 수 있도록 나니노벨의 common, runtime, 그리고 E2E assemblies를 참고하세요.

아래는 테스트 어셈블리 설정의 예시입니다.

![나니노벨 Automated Testing - E2E Import Settings](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-automated-testing-2.avif)

Naninovel이 UPM 패키지로 설치된 경우 프로젝트의 Packages/manifest.json을 통해 [테스트 가능하게](https://docs.unity3d.com/Manual/cus-tests.html#tests) 만들어야 할 수도 있습니다.

```
{
    "dependencies": {
        "com.elringus.naninovel": "...",
        "other-packages": "..."
    },
    "testables": [
        "com.elringus.naninovel"
    ]
}
```

![Image](https://subculturegamer.com/wp-content/uploads/2025/02/image-28-1024x361.png)

테스트는 비동기식으로 실행되므로 *[UnityTest]* 속성을 사용하고 테스트 메서드에서 *IEenumerator*를 반환해야합니다.

예를 들어, 플레이어가 새로운 게임을 시작할 수 있도록 하는 간단한 방법이 있습니다.

```
[UnityTest]
public IEnumerator CanStartGame () => new E2E()
    .Once(() => Engine.GetService<IUIManager>().GetUI<ITitleUI>().Visible)
    .Click("NewGameButton")
    .Ensure(() => Engine.GetService<IScriptPlayer>().Playing);
```

스크립트를 컴파일한 뒤, Test Runner 탭으로 이동해 새로 추가된 테스트를 찾으세요.

일단 실행되면 ITitleUI가 표시될 때까지 기다렸다가 “NewGameButton” 객체에 연결된 버튼을 찾아 클릭하고 스크립트가 플레이되는지 확인합니다.

만약 어떠한 단계가 실패했다면 테스트가 중지되고 관련 레코드가 유니티의 테스트 러너에 붉은 십자로 표시됩니다.

> **주의**
>
> 테스트를 실행하기 전에 엔진 구성에서 ‘Initialize On Application Load’를 비활성화하세요. 정상 사용 중에 자동 초기화를 유지하려면 메인 씬의 게임 오브젝트에 적용되는 *Runtime Initializer* 컴포넌트를 사용하세요. [가이드](https://naninovel.com/guide/integration-options#manual-initialization)에서 엔진 초기화에 대한 자세한 정보를 찾아보세요.

---

## 숏컷

간결한 테스트 환경을 구성하기 위해 [정적인 가져오기](https://learn.microsoft.com/en-us/dotnet/csharp/language-reference/keywords/using-directive#static-modifier)로 Naninovel.E2E.Shortcuts 클래스를 이용하세요.

여기에는 다양한 유용한 바로 가기가 포함되어있어 테스트를 더 컴팩트하고 읽기 쉽게 만들 수 있습니다. 예를 들어, 숏컷의 도움으로 재작성한 테스트 스크립트는 아래와 같이 구성할 수 있습니다.

```
[UnityTest]
public IEnumerator CanStartGame () => new E2E().StartNew().Ensure(Playing);
```

![나니노벨 Automated Testing - UnityTest](https://subculturegamer.com/wp-content/uploads/2025/02/image-20.png)

---

## 환경 조성

엔트-투-엔드 테스트는 가능한 한 실제 사용 시나리오에 근접하게 수행된다고 예상되기는 하나, 테스트를 보다 실용적으로 수행하기 위해 여러 파라미터를 조정할 필요가 있을 수 있습니다.

가령, 플레이어가 계속 시나리오를 읽기 위해 매 순간 클릭을 하는 것을 클릭 시퀀스로 구성하는 게 불필요할 수 있습니다.

이처럼 UI 페이드나 카메라 애니메이션과 같은 다양한 효과는 재생 중에 시간이 소요되는 것이지만 테스트에서 그러한 연출 시간을 기다리는 것은 불필요합니다.

테스트 수행 시 엔진을 구체적으로 구성하려면 E2E 인스턴스에서 사용할 수 있는 다양한 With 메서드를 이용하세요.

아래는 모든 이펙트를 매우 빠르게 실행하고 매 요청 시마다 입력을 활성화하기 위해 타임스케일과 등장 딜레이를 재정의하는 예시입니다.

```
[UnityTest]
public IEnumerator Test () => new E2E()
    .WithConfig<ScriptPlayerConfiguration>(c => c.SkipTimeScale = 999)
    .WithConfig<TextPrintersConfiguration>(c => c.MaxRevealDelay = 0)
    .With(() => Service<IScriptPlayer>().OnWaitingForInput += _ => Input("Continue").Activate(1))
```

![나니노벨 Automated Testing - IEnumerator Test](https://subculturegamer.com/wp-content/uploads/2025/02/image-21-1024x200.png)

이것은 일반적인 구성이므로 WithFastForward 익스텐션을 이용해 적용할 수 있습니다.

```
[UnityTest]
public IEnumerator Test () => new E2E().WithFastForward()
```

![나니노벨 Automated Testing - IEnumerator Test 2](https://subculturegamer.com/wp-content/uploads/2025/02/image-32-1024x121.png)

또 다른 일반적인 시나리오는 클린한 엔진 상태를 설정하여 각 테스트가 실행되기 시작할 때 글로벌, 설정 및 게임 상태가 이전 테스트 실행이나 플레이 세션에서 저장된 것에 의해 어떠한 영향도 받지 않도록 하는 것입니다.

특정 테스트 데이터를 메모리에 저장하여 디스크에 직렬화되지 않도록 하고 싶을 수 있습니다.

이 모든 것은 WithTransientState 익스텐션 메서드를 이용해 달성할 수 있습니다. 또한 이 메서드는 초기 글로벌 및 설정 상태를 지정할 수 있습니다.

```
[UnityTest]
public IEnumerator WhenTrueCompleteTitleBackChanges () => new E2E()
    .WithTransientState(GlobalStateMap.With(
        new CustomVariableManager.GlobalState {
            GlobalVariables = new[] {
                new CustomVariable("g_completedX", CustomVariableScope.Global, new CustomVariableValue(true)),
                new CustomVariable("g_completedY", CustomVariableScope.Global, new CustomVariableValue(true))
            }
        }))
```

![나니노벨 Automated Testing - WhenTrueCompleteTitleBackChanges](https://subculturegamer.com/wp-content/uploads/2025/02/image-33-1024x350.png)

위 스크립트는 엔진을 클린 상태로 초기화하여 첫 게임 런칭을 시뮬레이션합니다. 그러나 추가적으로 *g\_completedX* 및 *g\_completedY* 글로벌 변수를 True로 설정합니다.

---

## 시퀀스 구성

분기별 테스트 시나리오를 구성할 때, 플레이어가 특정 시나리오를 클리어할 수 있는 많은 가능한 방법을 찾아내기 위해 공통 인터랙션 시퀀스를 반복적으로 구성할 필요가 있을 수 있습니다. 반복작업을 최소화하기 위해 시퀀스 오브젝트에 모든 테스트 API에 의해 허용되는 ISequence 인터페이스를 구현할 수 있습니다. 이를 통해 공통 시퀀스를 변수에 저장하거나 다른 일반 시퀀스 내에서 구성할 수 있습니다.

아래는 플레이어가 공통 루트, X와 Y 루트를 완료했다면 타이틀 메뉴에서 TrueRoute UI를 보여주는 샘플 테스트입니다.

```
[UnityTest]
public IEnumerator WhenXYRoutesCompleteTrueUnlocks () => new E2E()
    .WithTransientState().WithFastForward()
    .StartNew().Play(CommonX, RouteX)
    .StartNew().Play(CommonY, RouteY)
    .Once(InTitle).Ensure(() => UI("TrueRoute").Visible);

ISequence CommonX => Play(D1QuickX, D2TowardX, D3LooseHP);
ISequence CommonY => Play(D1QuickY, D2TowardY, D3LooseX);

ISequence D1QuickX => Once(Choice("d1-qte-x")).Choose("d1-qte-x");
ISequence D1QuickY => Once(Choice("d1-qte-y")).Choose("d1-qte-y");
ISequence D1QuickNone => Once(Choice()).Wait(0.5f);

ISequence D2TowardX => Once(Choosing).Choose("d2-toward-x");
ISequence D2TowardY => Once(Choosing).Choose("d2-toward-y");

ISequence D3LooseHP => Once(Choosing).Choose("d3-loose-hp");
ISequence D3LooseX => Once(Choosing).Choose("d3-loose-x");
ISequence D3LastY => Once(Choosing).Choose("d3-last-y");
ISequence D3LastNah => Once(Choosing).Choose("d3-last-nah");

ISequence RouteX => On(Choosing, Choose(), Var("g_completedX", false));
ISequence RouteY => On(Choosing, Choose(), Var("g_completedY", false));
```

![나니노벨 Automated Testing - WhenXYRoutesCompleteTrueUnlocks](https://subculturegamer.com/wp-content/uploads/2025/02/image-31-1024x870.png)

어떻게 1~3일 동안의 공통 루트 선택지가 X나 Y루트로 가도록 구성되는지 CommonX, CommonY 변수에 의해 구성되는지 살펴보세요. 이 변수들은 실제 테스트 메서드에서도 구성됩니다.

---

위 스크립트 샘플에서 알 수 있듯이 테스트 시 선택지는 *d1-qte-x*와 같은 문자열로 참조될 수 있습니다. 이들은 시나리오 스크립트에 할당된 커스텀 [텍스트 식별자](https://naninovel.com/guide/naninovel-scripts#text-identification)입니다. 안정적인 텍스트 식별이 활성화 되더라도 스크립트에서 커스텀 텍스트 ID를 정의할 수 있으며 시스템에 의해 보존됩니다.

아래 시나리오 스크립트를 살펴보세요.

```
@choice "Choice 1|#my-id-for-choice-1|"
@choice "Choice 2|#my-id-for-choice-2|"
```

![나니노벨 Automated Testing - Choices](https://subculturegamer.com/wp-content/uploads/2025/02/image-34-1024x119.png)

첫 번째 선택지에 *my-id-for-choice-1*을 할당했고 두 번째 선택지에 *my-id-for-choice-2*를 할당했습니다. 실제 ID는 무엇이든 될 수 있으나 스크립트 내부에서 고유값이어야 합니다. 이제 지정된 ID를 이용해 테스트에서 선택지를 참조할 수 있습니다.

```
Once(Choosing).Choose("my-id-for-choice-2")
```

![나니노벨 Automated Testing - Choices 2](https://subculturegamer.com/wp-content/uploads/2025/02/image-35-1024x91.png)
> **예시**
>
> E2E 샘플은 사용 가능한 단축키, 확장 및 테스트 시나리오의 대부분을 보여줍니다.

---

## 커버리지

테스트 중에 스크립트 라인이나 명령어가 실행되었는지 확인하는 것이 도움이 될 수 있습니다. 테스트를 구성할 때 플레이어가 실제로 사용가능한 모든 컨텐츠를 볼 수 있는지 확인하고 싶을 수 있습니다. 모든 테스트가 진행된 뒤에도 어떤 명령어가 실행되지 않았다면, 시나리오 로직이나 불완전한 테스트 환경이 이슈일 수 있습니다.

기본적으로 모든 E2E 테스트가 완료된 후에는 커버리지 보고서가 콘솔에 기록됩니다.

![나니노벨 Automated Testing - Coverage](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-automated-testing-1.avif)

첫 줄에서는 모든 시나리오 스크립트의 수 대비 총 명령어 비율이 요약되어 표시됩니다. 그 이하의 라인에서부터는 스크립트 당 커버리지를 보여줍니다. 커버되지 않은 스크립트 명령어가 발견된 경우, 명령어가 포함된 줄 번호도 표시됩니다.

커버리지를 비활성화하려면 E2E 생성자에서 Cover 옵션을 비활성화하세요.

```
[UnityTest]
public IEnumerator Test () => new E2E(new Options { Cover = false })
```

![나니노벨 Automated Testing - IEnumerator Test](https://subculturegamer.com/wp-content/uploads/2025/02/image-36-1024x123.png)

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)