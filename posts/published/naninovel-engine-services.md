---
title: "나니노벨 Engine Services"
url: https://subculturegamer.com/naninovel-engine-services/
published: 2025-01-12
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

※원문 페이지: [(링크)](https://naninovel.com/guide/engine-services)

※마지막 수정일: 2025/1/12

---

대부분의 엔진 기능은 엔진 서비스를 통해 구현됩니다. 엔진 서비스는 naninovel 스크립트 실행, 액터 관리 또는 게임 상태 저장 및 로드와 같은 특정 작업을 처리하는 *IEngineService* 인터페이스의 구현입니다.

엔진 시스템과 상호작용하려는 경우 엔진 서비스를 사용하고 싶을 가능성이 높습니다. *Engine.GetServiceTService()* 정적 메서드를 사용하여 엔진 서비스에 대한 레퍼런스를 얻을 수 있습니다. 여기서 *TService*는 얻고자 하는 서비스의 인터페이스입니다. 예를 들어 *IScriptPlayer* 서비스를 얻으려면 다음을 수행하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-3.png)

```
var player = Engine.GetService<IScriptPlayer>();
player.Stop();
```

> **메모**
>
> 엔진 초기화 절차는 비동기식이므로 자동 초기화가 활성화된 경우에도 유니티 엔진에서 씬을 로드한 직후(예: Awake, Start 및 OnEnable MonoBehaviour 메서드) 엔진 API(예: GetService 메서드)를 사용하지 못할 수 있습니다.
>
> 자세한 내용은 [엔진 API 액세스 가이드](https://naninovel.com/guide/integration-options#accessing-engine-api)를 참조하세요.

현재 사용 가능한 엔진 서비스는 아래와 같습니다.

| 서비스 인터페이스 | 설명 |
| --- | --- |
| IBackgroundManager | [background](https://naninovel.com/guide/backgrounds)(배경화면) 액터 관리. |
| ICharacterManager | [character](https://naninovel.com/guide/characters)(캐릭터) 액터 관리. |
| IChoiceHandlerManager | [choice handler](https://naninovel.com/guide/choices)(선택지 처리기) 액터 관리. |
| ITextPrinterManager | [text printer](https://naninovel.com/guide/text-printers)(텍스트 출력기) 액터 관리. |
| IAudioManager | 오디오([SFX](https://naninovel.com/guide/audio#sound-effects), [BGM](https://naninovel.com/guide/audio#background-music), [voicin](https://naninovel.com/guide/voicing)) 관리. |
| IInputManager | [input processing](https://naninovel.com/guide/input-processing)(입력 처리) 관리 |
| ILocalizationManager | [localization](https://naninovel.com/guide/localization)(번역 처리) 관리 |
| ITextManager | [managed text](https://naninovel.com/guide/managed-text)(관리형 텍스트) 관리. |
| IMoviePlayer | [movie](https://naninovel.com/guide/movies)(영상) 재생 관리. |
| IScriptManager | [naninovel script](https://naninovel.com/guide/naninovel-scripts)(나니노벨 스크립트) 리소스 관리. |
| IScriptPlayer | [naninovel scripts](https://naninovel.com/guide/naninovel-scripts)(나니노벨 스크립트) 실행 관리. |
| ICameraManager | 씬 렌더링에 필요한 카메라와 기타 시스템 관리. |
| IResourceProviderManager | `IResourceProvider` 개체 관리. |
| IStateManager | IEngineService 관련 영구 데이터 역직렬화 처리. 게임 상태를 [저장하고 불러오는 API](https://naninovel.com/guide/save-load-system) 제공. |
| IUIManager | IManagedUI 개체 관리 및 [UI 커스터마이징](https://naninovel.com/guide/user-interface#ui-customization) 기능 처리. |
| ICustomVariableManager | [커스텀 변수](https://naninovel.com/guide/custom-variables) 접근 및 수정 처리. |
| ISpawnManager | [`@spawn`](https://naninovel.com/api/#spawn) 명령어로 생성된 개체 관리. |
| IUnlockableManager | [unlockable items](https://naninovel.com/guide/unlockable-items)(잠금해제 가능 항목) 처리. (CG, 무비 갤러리, 팁, 기타 등등) |

Naninovel/Runtime에 저장된 런타임 소스 코드에서 서비스의 내장 구현을 찾을 수 있습니다.

---

## 커스텀 서비스 추가하기

새로운 커스텀 엔진 서비스를 추가하려면 *IEngineService* 인터페이스를 구현하고 구현 클래스에 *InitializeAtRuntime* 속성을 추가합니다.

구현 인스턴스는 엔진 초기화 중에 자동으로 생성되며 *Engine.GetServiceTService()* API를 통해 사용할 수 있게 됩니다.

*InitializeAtRuntime* 속성의 *InitializationPriority* 인수를 사용하여 다른 서비스 전후에 커스텀 서비스를 강제로 초기화할 수 있습니다. 값이 낮을수록 실행 대기열의 다른 서비스보다 먼저 푸시되고 값이 높을수록 나중에 푸시됩니다.

자동으로 인스턴스화하려면 서비스 구현에 호환 가능한 생성자(또는 기본 생성자)가 있어야 합니다.

(순서에 상관 없이) 다음의 인수가 허용됩니다.

- 기타 서비스들 (IEngineService 파생)
- 구성 오브젝트들 (Configuration 파생)
- Unity의 ‘MonoBehavior’ 프록시 객체(IEngineBehaviour 파생)

생성자(constructor)에서 다른 서비스를 사용하는 것은 안전하지 않습니다. 대신 InitializeService 메서드에서 다른 서비스를 사용해야 하는 초기화 작업을 수행하고, 필요한 서비스에 액세스할 때 초기화가 필요한지 확인하려면 서비스 생성자에 해당 서비스를 나열하세요(초기화 대기열은 생성자 인수에 따라 위상적으로 정렬됩니다).

커스텀 서비스가 지속적인 상태일 때, 가령 다른 엔진 서비스와 직렬화되거나 역직렬화가 되어야하는 상황이라면 IStatefulServiceTState 인터페이스를 구현합니다. 여기서 TState는 상태를 게임 세션별, 전역 상태 또는 설정과 함께 저장하려는지 여부에 따라 GameStateMap, GlobalStateMap 또는 SettingsStateMap 중 하나입니다.

필요한 경우 단일 서비스에 대해 세 가지 인터페이스를 모두 구현할 수 있습니다. 다양한 유형의 엔진 상태에 대한 자세한 내용은 [상태 관리 가이드](https://naninovel.com/guide/state-management)를 참조하세요.

다음은 일부 사용 공지가 포함된 사용자 정의 엔진 서비스 구현의 예입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image.png)

```
using Naninovel;
using UnityEngine;

[InitializeAtRuntime]
public class CustomService : IEngineService
{
    private readonly InputManager inputManager;
    private readonly ScriptPlayer scriptPlayer;

    public CustomService (InputManager inputManager, ScriptPlayer scriptPlayer)
    {
        // The services are potentially not yet initialized here,
        // refrain from using them.
        this.inputManager = inputManager;
        this.scriptPlayer = scriptPlayer;
    }

    public UniTask InitializeService ()
    {
    	// Initialize the service here.
        // It's now safe to use services requested in the constructor.
        Debug.Log(inputManager.ProcessInput);
        Debug.Log(scriptPlayer.PlayedScript);
        return UniTask.CompletedTask;
    }

    public void ResetService ()
    {
        // Reset service state here.
    }

    public void DestroyService ()
    {
        // Stop the service and release any used resources here.
    }
}
```

이제 다음과 같은 방법으로 앞서 언급한 커스텀 서비스에 액세스할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-1.png)

```
var customService = Engine.GetService<CustomService>();
```

> **예시**
>
> 아이템 리소스와 인벤토리 UI 구성을 관리하기 위해 커스텀 엔진 서비스를 추가하는 또 다른 예는 [인벤토리 샘플](https://naninovel.com/guide/samples#inventory)에서 찾을 수 있습니다. 특히 커스텀 엔진 서비스는 *Scripts/Runtime/Inventory/InventoryManager.cs* 런타임 스크립트를 통해 구현됩니다.

---

## 내장 서비스 재정의하기

모든 내장 서비스는 엔진 소스 코드의 인터페이스를 통해 참조되며, 이를 커스텀 구현으로 교체 가능합니다.

위에서 설명한 것과 동일한 방식으로 커스텀 서비스를 추가합니다. 단, IEngineService 대신 구체적인 엔진 인터페이스를 구현하고 초기화 유형(인터페이스가 아닌 구현 유형)을 `InitializeAtRuntime`을 통해 지정합니다. 그러면 내장 구현 대신 커스텀 구현이 초기화됩니다.

아래는 아무 작업도 수행하지 않고 메서드가 호출될 때 로그를 기록하는 더미 IInputManager 구현 예시입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-2-608x1024.png)

```
using Naninovel;
using Naninovel.UI;
using UnityEngine;

[InitializeAtRuntime(@override: typeof(InputManager))]
public class CustomInputManager : IInputManager
{
    public InputConfiguration Configuration { get; }
    public bool ProcessInput { get; set; }

    public CustomInputManager (InputConfiguration config)
    {
        Configuration = config;
    }

    public UniTask InitializeService ()
    {
        Debug.Log("CustomInputManager::InitializeService()");
        return UniTask.CompletedTask;
    }

    public void ResetService ()
    {
        Debug.Log("CustomInputManager::ResetService()");
    }

    public void DestroyService ()
    {
        Debug.Log("CustomInputManager::DestroyService()");
    }

    public IInputSampler GetSampler (string bindingName)
    {
        Debug.Log($"CustomInputManager::GetSampler({bindingName})");
        return default;
    }

    public void AddBlockingUI (IManagedUI ui, params string[] allowedSamplers)
    {
        Debug.Log($"CustomInputManager::AddBlockingUI({ui.GetType().Name})");
    }

    public void RemoveBlockingUI (IManagedUI ui)
    {
        Debug.Log($"CustomInputManager::RemoveBlockingUI({ui.GetType().Name})");
    }
}
```

이제 *Engine.GetServiceIInputManager()*를 통해 입력 관리자가 요청되면 내장된 *Naninovel.InputManager* 대신 커스텀 구현이 제공됩니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)