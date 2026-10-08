---
title: "나니노벨 Integration Options"
url: https://subculturegamer.com/naninovel-integration-options/
published: 2025-02-16
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

※원문 페이지: [(링크)](https://naninovel.com/guide/integration-options)

※마지막 수정일: 2025/2/16

---

나니노벨은 전통적인 비주얼 노벨 게임에 중점을 두고 있으며 그러한 게임을 만들 때 템플릿으로서 가장 잘 작동합니다. 다만 (비주얼 노벨 게임을 만들기만을 위해서가 아닌) 현존하는 프로젝트를 제작할 때 나니노벨을 통합하는 것도 가능합니다.

3D 어드벤처, RPG, 기타 다른 장르의 게임을 만들 때 나니노벨은 ‘다이얼로그 시스템’으로서 활용 가능합니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-b1b6042db4a91b3a8cee74236b33c17c.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-b1b6042db4a91b3a8cee74236b33c17c.mp4?_=1)

나니노벨을 커스텀 프로젝트와 통합하기 위한 다양한 방법이 있으며, 나니노벨을 정확히 어떤 프로젝트 타입과 함께 개발할 것이고 그 목적이 어떠하냐에 따라 구현의 방향성이 달라질 것입니다. 아래의 내용은 스탠드얼론 게임을 나니노벨로 개발할 때 “페어링(pairing)”하기 유용한 API와 구성 옵션을 설명합니다.

계속하기에 앞서, [엔진 아키텍처](https://naninovel.com/guide/engine-architecture) 문서를 읽어보고 개념적인 단계에서 나니노벨이 어떻게 작업을 수행하는지 이해하시기를 권장합니다.

> **예시**
>
> 나니노벨이 다이얼로그 시스템으로서 삽입되어, 스탠드얼론 3D 어드벤처 게임에서 비주얼 노벨 모드로 스위칭되는 경우의 [예시 프로젝트](https://naninovel.com/guide/integration-options#example-project)를 확인해 보세요.

---

## 수동 초기화

엔진 구성 메뉴에서 Initialize On Application Load 옵션이 활성화되었다면, 앱을 시작할 때 엔진 서비스가 자동으로 초기화됩니다.

![나니노벨 Integration Options - 수동 초기화](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-integration-options-4.avif)

게임을 비주얼 노벨 모드로 시작하려고 하는 게 아니라면, 나니노벨 초기화 시점을 앱 시작 시가 아니라 실제로 필요한 순간에 실행하고 싶을 수 있습니다.

그런 경우 C#의 정적 RuntimeInitializer.Initialize () 메서드를 호출하거나, Runtime Initializer 컴포넌트를 씬의 게임 오브젝트에 추가하면 됩니다.

아래는 MonoBehaviour 스크립트로 작성된 수동 초기화의 예시입니다.

```
using Naninovel;
using UnityEngine;

public class MyScript : MonoBehaviour
{
    private async void Start ()
    {
        await RuntimeInitializer.Initialize();
    }
}
```

![나니노벨 Integration Options - RuntimeInitializer](https://subculturegamer.com/wp-content/uploads/2025/02/image-37-1024x392.png)

Scene Independent 옵션을 비활성화하면 모든 나니노벨 관련 객체가 엔진이 초기화된 유니티 씬의 일부가 됩니다. 씬이 언로드되면 나니노벨이 종료됩니다.

엔진 서비스를 리셋하고 (대부분의 점유된 리소스를 버리려면) IstateManager 서비스의 ResetState() 메서드를 사용하세요. 다른 게임 플레이 모드로 임시로 전환할 때 유용하며 엔진을 다시 시작하지 않고도 (나니노벨) 비주얼 노벨 모드로 돌아갈 수 있습니다.

엔진 서비스를 완전히 종료하고 메모리에서 나니노벨을 완전히 삭제하려면 Engind.Destroy() 정적 메서드를 사용하세요.

---

## 엔진 API 접근하기

엔진 초기화 절차는 비동기식이므로 자동 초기화가 활성화되어 있더라도 Unity가 씬 로드한 직후 엔진 API를 사용할 수 없을 수 있습니다. (예 : Monobehaviour 메서드에서 Awake, Start, OnEnable하는 경우)

엔진이 현재 사용 가능한지 확인하려면 Engine.Initialized 프로퍼티를 사용하세요. Engine.OnInitializationFinished 이벤트는 초기화 절차가 완료된 후 작업을 실행할 수 있습니다.

```
public class MyScript : MonoBehaviour
{
    private void Awake ()
    {
        // Engine may not be initialized here, so check first.
        if (Engine.Initialized) DoMyCustomWork();
        else Engine.OnInitializationFinished += DoMyCustomWork;
    }

    private void DoMyCustomWork ()
    {
        // Engine is initialized here, it's safe to use the APIs.
        var scriptPlayer = Engine.GetService<IScriptPlayer>();
        ...
    }
}
```

![나니노벨 Integration Options - DoMyCustomWork](https://subculturegamer.com/wp-content/uploads/2025/02/image-38-1024x597.png)

---

## 나니노벨 스크립트 재생하기

주어진 경로가있는 나노 벨 스크립트를 예압하고 재생하려면 ISCRIPTPLAYER 서비스의 LOADANDPLAY (SCRIPTPATH) 메소드를 사용하십시오. 엔진 서비스를 얻으려면 Engine.getServicetService () 정적 메소드를 사용하십시오. 여기서 Tservice는 검색 할 서비스의 유형 (인터페이스)입니다. 예를 들어, 다음은 스크립트 플레이어 서비스를 얻은 다음 사전로드하고 이름 ‘script001’이있는 스크립트를 재생합니다.

미리 지정한 경로에 있는 나니노벨 스크립트를 미리 불러오거나 재생하기 위해서는 LoadAndPlay(ScriptPath) 메서드의 IScriptPlayer 서비스의 메서드를 사용하세요. 엔진 서비스를 받으려면 Engine.GetService<TService>() 정적 메서드를 사용하세요. Tservice는 검색을 위해 제공되는 타입(인터페이스)입니다.

아래의 예시는 스크립트 플레이어 서비스를 불러와, “Script001″이라는 이름의 스크립트를 미리 불러오고 재생시킵니다.

```
var player = Engine.GetService<IScriptPlayer>();
await player.LoadAndPlay("Script001");
```

![나니노벨 Integration Options - LoadAndPlay](https://subculturegamer.com/wp-content/uploads/2025/02/image-10.png)

비주얼 노벨 모드를 종료하고 메인 게임 모드로 돌아갈 때 나니노벨에서 현재 사용하는 모든 리소스를 언로드하고 나니노벨과 그 엔진 서비스를 종료시키고 싶다면 IStateManager 서비스의 ResetState() 메서드를 활용하세요.

```
var stateManager = Engine.GetService<IStateManager>();
await stateManager.ResetState();
```

![나니노벨 Integration Options - stateManager](https://subculturegamer.com/wp-content/uploads/2025/02/image-11.png)

---

## 타이틀 메뉴 비활성화

내장 타이틀 메뉴 구현은 엔진이 초기화되면 자동으로 표시됩니다.

자체적인 타이틀 메뉴를 구현하고 싶다면 [UI customization feature](https://naninovel.com/guide/user-interface#ui-customization)에서 내장 타이틀 메뉴를 제거하여 타이틀을 교체할 수 있습니다. 메뉴는 UI 리소스 리스트 내에 Title UI 아래에 위치합니다.

---

## 엔진 개체 레이어

나니노벨 엔진이 구성 메뉴에서 생성하는 모든 개체(UI 관련한 것 제외)는 특정 레이어를 할당할 수 있습니다.

![나니노벨 Integration Options - 엔진 개체 레이어 1](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-integration-options-3.avif)

위처럼 설정하면 엔진 카메라는 [컬링 마스크](https://docs.unity3d.com/ScriptReference/Camera-cullingMask.html)를 사용하고 지정된 레이어의 개체만 렌더링합니다.

![나니노벨 Integration Options - 엔진 개체 레이어 2](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-integration-options-2.avif)

엔진이 관리하는 UI 개체 레이어를 변경하려면 UI 구성 메뉴에서 *Objects Layer* 옵션을 사용하세요.

---

## 텍스처로 렌더링하기

카메라 구성 메뉴에서 커스텀 카메라 프리팹을 할당하여 엔진 카메라 렌더 설정을 커스텀 렌더 텍스터로 설정할 수 있습니다. (카메라 연관 설정도 함께 변경합니다.)

![나니노벨 Integration Options - 텍스처로 렌더링하기](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-integration-options-1.avif)

---

## 모드 변경하기

프로젝트에 따라 크게 달라질 수 있으나, 아래는 “어드벤처”와 “노벨” 모드간의 전환을 커스텀 커맨드를 활용해 전환시키는 구현의 추상적인 예시입니다. (앞서 레퍼런스로 언급된 프로젝트 기반)

```
[CommandAlias("novel")]
public class SwitchToNovelMode : Command
{
    public StringParameter ScriptPath;
    public StringParameter Label;

    public override async UniTask Execute (AsyncToken asyncToken)
    {
        // 1. Disable character control.
        var controller = Object.FindObjectOfType<CharacterController3D>();
        controller.IsInputBlocked = true;

        // 2. Switch cameras.
        var advCamera = GameObject.Find("AdvCamera").GetComponent<Camera>();
        advCamera.enabled = false;
        var naniCamera = Engine.GetService<ICameraManager>().Camera;
        naniCamera.enabled = true;

        // 3. Load and play specified script (if assigned).
        if (Assigned(ScriptPath))
        {
            var scriptPlayer = Engine.GetService<IScriptPlayer>();
            await scriptPlayer.LoadAndPlay(ScriptPath, label);
        }

        // 4. Enable Naninovel input.
        var inputManager = Engine.GetService<IInputManager>();
        inputManager.ProcessInput = true;
    }
}
```

![나니노벨 Integration Options - SwitchToNovelMode](https://subculturegamer.com/wp-content/uploads/2025/02/image-39-921x1024.png)

```
[CommandAlias("adventure")]
public class SwitchToAdventureMode : Command
{
    public override async UniTask Execute (AsyncToken asyncToken)
    {
        // 1. Disable Naninovel input.
        var inputManager = Engine.GetService<IInputManager>();
        inputManager.ProcessInput = false;

        // 2. Stop script player.
        var scriptPlayer = Engine.GetService<IScriptPlayer>();
        scriptPlayer.Stop();

        // 3. Reset state.
        var stateManager = Engine.GetService<IStateManager>();
        await stateManager.ResetState();

        // 4. Switch cameras.
        var advCamera = GameObject.Find("AdvCamera").GetComponent<Camera>();
        advCamera.enabled = true;
        var naniCamera = Engine.GetService<ICameraManager>().Camera;
        naniCamera.enabled = false;

        // 5. Enable character control.
        var controller = Object.FindObjectOfType<CharacterController3D>();
        controller.IsInputBlocked = false;
    }
}
```

![나니노벨 Integration Options - SwitchToAdventureMode](https://subculturegamer.com/wp-content/uploads/2025/02/image-40-979x1024.png)

명령어는 나니노벨 스크립트에서 아래와 같이 쓰일 수 있습니다.

```
; 어드벤처 모드로 전환하기
@adventure
```

![나니노벨 Integration Options - adventure](https://subculturegamer.com/wp-content/uploads/2025/02/image-15.png)

또는 C#으로 직접 연결할 수 있습니다. (예: 유니티 이벤트의 OnTrigger 활용)

```
private void OnTriggerEnter (Collider other)
{
	var switchCommand = new SwitchToNovelMode { ScriptPath = "Script001" };
	switchCommand.Execute().Forget();
}
```

![나니노벨 Integration Options - switchCommand](https://subculturegamer.com/wp-content/uploads/2025/02/image-41-1024x223.png)

---

## 다른 옵션

엔진을 다른 시스템과 통합할 때 상황에 맞게 도움이 될 수 있는 여러 기능이 있습니다. (상태 아웃소싱, 서비스 재정의, 커스텀 직렬화, 리소스 및 구성 제공자 등)

자세한 내용은 나머지 가이드를 확인하세요. [Configuration Options](https://naninovel.com/guide/configuration)의 사용 가능한 기능 또한 조사하는 걸 권장합니다. 일부 기능은 가이드에서 설명하고 있지 않을 수도 있지만 통합 목적에 관해 여전히 유용할 수 있습니다.

일부 엔진 API 또는 시스템 확장성이 부족하여 통합을 위해서는 소스 코드 수정이 필요하다고 생각되신다면 [contact to support](https://naninovel.com/support/#naninovel-support) 채널로 연락하세요. 개선할 수 있도록 하겠습니다.

> **예시**
>
> 통합 샘플을 확인하는 걸 권장합니다. 나니노벨이 3D 어드벤처 게임에서의 내장 다이얼로그로 활용되며 스탠드얼론 비주얼 노벨 모드로 전환 가능한 예시를 보여줍니다.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)