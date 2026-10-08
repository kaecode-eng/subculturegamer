---
title: "나니노벨 State Management"
url: https://subculturegamer.com/naninovel-state-management/
published: 2025-02-09
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

※원문 페이지: [(링크)](https://naninovel.com/guide/state-management)

※마지막 수정일: 2025/2/9

---

나니노벨 런타임 도중 생성되거나 사용된 모든 지속되는 데이터는 크게 세 가지로 나뉩니다.

- 게임 상태(Game state)
- 전역 상태(Global state)
- 사용자 설정(User settings)

---

데이터는 JSON 포맷으로 직렬화되며, 플랫폼에 따라 [영구 데이터 디렉토리](https://docs.unity3d.com/ScriptReference/Application-persistentDataPath.html)에 바이너리 .nson(기본값) 또는 텍스트 .json 세이브 슬롯 파일로 저장됩니다. WebGL 플랫폼에서는 최근의 웹 브라우저의 LFS 보안 정책에 인해 직렬화된 데이터는 [인덱스 DB](https://en.wikipedia.org/wiki/Indexed_Database_API)에 대신 저장됩니다.

직렬화 동작은 게임 저장, 전역 상태 및 사용자 설정을 위해 직렬화 처리기에 의해 제어됩니다. 기본적으로 범용 직렬화 처리기가 사용됩니다. 대부분의 경우 비동기 [System.IO](https://docs.microsoft.com/en-us/dotnet/api/system.io)를 사용하여 슬롯 파일을 로컬 파일 시스템에 읽고 씁니다. 그러나 일부 플랫폼 (예 : 콘솔 등)에서는 .NET IO API를 사용할 수 없으며 이 경우 범용 처리기는 유니티 크로스 플랫폼 [PlayerPrefs](https://docs.unity3d.com/ScriptReference/PlayerPrefs.html)로 폴백됩니다.

직렬화 처리기, 저장 폴더 경로, 최대 저장 슬롯의 수 및 기타 관련 매개 변수는 상태 구성 메뉴에서 수정할 수 있습니다.

![나니노벨 State Management - Project Settings](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-state-management-2.avif)

---

## 게임 상태

게임 상태(Game State)는 게임 저장 슬롯마다 다른 데이터입니다. 게임과 관련하여 엔진 서비스 및 기타 객체의 상태를 설명합니다.

게임 상태 데이터의 예는 다음과 같습니다.

현재 플레이된 나니노벨 스크립트와 스크립트 내에서 플레이 된 스크립트 명령어 인덱스, 현재 보이는 캐릭터와 씬에서의 위치, 현재 재생되는 BGM 트랙 이름과 볼륨 등에 해당합니다.

현재 게임 상태를 특정 저장 슬롯에 저장하거나 로드하려면 *IStateManager* 엔진 서비스를 다음과 같이 사용하십시오.

```
// 상태 매니저에서 인스턴스를 불러옵니다.
var stateManager = Engine.GetService<IStateManager>();

// 현재 게임 세션을 "mySaveSlot"에 저장합니다.
await stateManager.SaveGame("mySaveSlot");
// 게임 세션을 "mySaveSlot"에서 불러옵니다.
await stateManager.LoadGame("mySaveSlot");

// 특정 슬롯 이름을 지정하지 않고도 빠른 세이브-로드도 가능합니다.
await stateManager.QuickSave();
await stateManager.QuickLoad();
```

![나니노벨 State Management - stateManager](https://subculturegamer.com/wp-content/uploads/2025/02/image.png)

Save-Load API는 [비동기식](https://docs.microsoft.com/en-us/dotnet/csharp/programming-guide/concepts/async/)입니다. 동기 메서드에서 API를 호출하는 경우 `IStateManager.OnGameSaveFinished` 및 `IStateManager.OnGameLoadFinished`를 사용하여 완료 이벤트를 확인하세요.

---

## 전역 상태

어떤 데이터는 게임 세션간에서도 지속적이어야합니다.

예를 들어, “Skip Read Text” 기능을 사용하려면 엔진에서 어떤 나니노벨 스크립트 명령어가 적어도 한번 실행되었는지 설명하는 데이터를 저장해야합니다. (플레이어가 ‘이미’ 보았다는 것을 의미합니다.).

이와 같은 데이터는 단일 “전역(global)” 저장 슬롯에 저장하며 게임 세이브-로드 작업에 의존하지 않습니다.

전역 상태는 엔진 초기화 시 자동으로 로드됩니다. 아래와 같이 IStateManager를 사용하여 언제든지 글로벌 상태를 저장할 수 있습니다.

```
await stateManager.SaveGlobalState();
```

![나니노벨 State Management - 전역상태](https://subculturegamer.com/wp-content/uploads/2025/02/image-42-1024x89.png)

---

## 사용자 설정

전역 상태와 유사하게도, 사용자 설정 데이터 (디스플레이 해상도, 언어, 사운드 볼륨 등)는 단일 저장 슬롯에 저장되나 기본적으로 살짝 다르게 처리됩니다.

생성된 저장 파일은 “Saves” 폴더 바깥에 위치합니다. 읽을 수 있는 방식으로 포맷하여 사용자가 원하는 경우 값을 수정할 수 있습니다.

사용자 설정은 엔진 초기화 시 자동으로 로드됩니다. 아래와 같이 IStateManager를 사용하여 언제든지 설정을 저장할 수 있습니다.

```
await stateManager.SaveSettings();
```

![나니노벨 State Management - 사용자 설정](https://subculturegamer.com/wp-content/uploads/2025/02/image-3.png)

---

## 커스텀 상태(Custom State)

커스텀 오브젝트의 상태 처리기를 IStateManager에 위임 할 수 있습니다.

플레이어가 게임을 저장할 때 세이브 슬롯에 엔진의 모든 데이터와 함께 직렬화시키며 게임을 로드할 때에는 다시 직렬화하지 않도록 합니다. 내장된 모든 상태 관련 기능(예: 롤백)도 커스텀 상태에서 즉시 작동합니다.

다음 예는 ‘MyCustomBehaviour’ 컴포넌트의 상태 처리를 위임하는 것을 보여줍니다.

```
using UnityEngine;
using Naninovel;

public class MyCustomBehaviour : MonoBehaviour
{
    [System.Serializable]
    private class GameState
    {
    	public bool MyCustomBool;
    	public string MyCustomString;
    }

    private bool myCustomBool;
    private string myCustomString;
    private IStateManager stateManager;

    private void Awake ()
    {
        stateManager = Engine.GetService<IStateManager>();
    }

    private void OnEnable ()
    {
        stateManager.AddOnGameSerializeTask(SerializeState);
        stateManager.AddOnGameDeserializeTask(DeserializeState);
    }

    private void OnDisable ()
    {
        stateManager.RemoveOnGameSerializeTask(SerializeState);
        stateManager.RemoveOnGameDeserializeTask(DeserializeState);
    }

    private void SerializeState (GameStateMap stateMap)
    {
        var state = new GameState() {
            MyCustomBool = myCustomBool,
            MyCustomString = myCustomString
        };
        stateMap.SetState(state);
    }

    private UniTask DeserializeState (GameStateMap stateMap)
    {
        var state = stateMap.GetState<GameState>();
        if (state is null) return UniTask.CompletedTask;

        myCustomBool = state.MyCustomBool;
        myCustomString = state.MyCustomString;
        return UniTask.CompletedTask;
    }
}
```

![나니노벨 State Management - 커스텀 상태](https://subculturegamer.com/wp-content/uploads/2025/02/image-4-544x1024.png)
> **메모**
>
> 인벤토리 UI의 게임 상태를 저장하기 위해 커스텀 구조와 함께 커스텀 상태를 사용하는 더 발전한 예시는 [인벤토리 샘플](https://naninovel.com/guide/samples#inventory)에서 찾을 수 있습니다. 특히, 커스텀 상태에서 직렬화하거나 직렬화하지 않는 구현의 예시는 Scripts/Runtime/Inventory/UI/InventoryUi.cs 커스텀 UI에서 확인 가능합니다.

엔진의 전역 상태 및 설정 상태에 액세스하여 커스텀 데이터를 저장할 수도 있습니다.

게임 세션에 한정된데다 세이브/로드 이벤트를 구독해야하는 게임 상태와는 달리, 전역 상태 및 설정 상태 개체는 싱글톤이며 상태 관리자 프로퍼티를 통해 바로 접근이 가능합니다.

```
[System.Serializable]
class MySettings
{
    public bool MySettingsBool;
}

[System.Serializable]
class MyGlobal
{
    public string MyGlobalString;
}

MySettings MySettings
{
    get => stateManager.SettingsState.GetState<MySettings>();
    set => stateManager.SettingsState.SetState<MySettings>(value);
}

MyGlobal MyGlobal
{
    get => stateManager.GlobalState.GetState<MyGlobal>();
    set => stateManager.GlobalState.SetState<MyGlobal>(value);
}
```

![나니노벨 State Management - MySettingsBool](https://subculturegamer.com/wp-content/uploads/2025/02/image-43-1024x835.png)

상태 객체는 유형별로 인덱스가 매겨지지만 경우에 따라 각각의 개별 상태를 가진 동일한 타입의 여러 개체 인스턴스가 있을 수 있습니다. GetState 메서드와 SetState 메서드 모두 이러한 객체를 구별하기 위해 선택적인 instanceId 인수를 제공할 수 있습니다:

```
[System.Serializable]
class MonsterState
{
    public int Health;
}

var monster1 = stateMap.GetState<MonsterState>("1");
var monster2 = stateMap.GetState<MonsterState>("2");
```

![나니노벨 State Management - MonsterState](https://subculturegamer.com/wp-content/uploads/2025/02/image-44-1024x324.png)

---

## 커스텀 직렬화 처리기

기본적으로 범용 직렬화 핸들러를 선택하면 엔진 상태(게임 저장, 전역 상태, 설정)는 비동기 [System.IO](https://docs.microsoft.com/en-us/dotnet/api/system.io) 또는 일부 플랫폼의 폴백으로 Unity의 크로스 플랫폼 [PlayerPrefs](https://docs.unity3d.com/ScriptReference/PlayerPrefs.html)로 직렬화됩니다.

커스텀 처리기를 추가하려면 `I`*`SaveSlotManager<GameStateMap>`, `ISaveSlotManager<GlobalStateMap>`, `ISaveSlotManager<SettingsStateMap>`* 게임용 인터페이스를 구현해야 합니다. 이는 게임 저장 슬롯, 전역 상태 및 설정을 각각 저장합니다(각각 고유한 구현 클래스를 가져야 합니다).

구현에는 StateConfiguration과 문자열 인수를 가진 공개 생성자가 있어야 합니다. 첫 번째는 상태 구성 객체의 인스턴스이고 두 번째는 폴더를 저장하는 경로입니다. 커스텀 구현에서 인수를 무시해도 됩니다.

아래는 커스텀 설정 직렬화 처리기의 예입니다. 이 방법은 메서드가 호출될 때 로그를 수행하는 것 외에는 아무것도 하지 않습니다.

```
using Naninovel;
using System;
using UnityEngine;

public class CustomSettingsSlotManager : ISaveSlotManager<SettingsStateMap>
{
    public event Action<string> OnBeforeSave;
    public event Action<string> OnSaved;
    public event Action<string> OnBeforeLoad;
    public event Action<string> OnLoaded;
    public event Action<string> OnBeforeDelete;
    public event Action<string> OnDeleted;
    public event Action<string, string> OnBeforeRename;
    public event Action<string, string> OnRenamed;

    public bool Loading => false;
    public bool Saving => false;

    public CustomSettingsSlotManager (StateConfiguration config, string saveDir)
    {
        Debug.Log($"Ctor({saveDir})");
    }

    public bool AnySaveExists () => true;

    public bool SaveSlotExists (string slotId) => true;

    public void DeleteSaveSlot (string slotId)
    {
        Debug.Log($"DeleteSaveSlot({slotId})");
    }

    public void RenameSaveSlot (string sourceSlotId, string destSlotId)
    {
        Debug.Log($"RenameSaveSlot({sourceSlotId},{destSlotId})");
    }

    public UniTask Save (string slotId, SettingsStateMap data)
    {
        Debug.Log($"Save({slotId})");
        return UniTask.CompletedTask;
    }

    public UniTask<SettingsStateMap> Load (string slotId)
    {
        Debug.Log($"Load({slotId})");
        return UniTask.FromResult(new SettingsStateMap());
    }

    public UniTask<SettingsStateMap> LoadOrDefault (string slotId)
    {
        return Load(slotId);
    }
}
```

![나니노벨 State Management - CustomSettingsSlotManager](https://subculturegamer.com/wp-content/uploads/2025/02/image-7-530x1024.png)
> **메모**
>
> 사용자 정의 직렬화 처리기의 이름을 선택할 수 있습니다. CustomSettingsSlotManager는 예입니다.

커스텀 처리기가 구현되면 상태 구성 메뉴에 표시되며 내장 처리기 대신 설정할 수 있습니다.

![나니노벨 State Management - 직렬화 처리기](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-state-management-1.avif)

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 Custom Script Parser](https://subculturegamer.com/naninovel-custom-script-parser/)