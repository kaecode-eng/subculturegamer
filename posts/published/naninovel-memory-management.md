---
title: "[26년 2월] 나니노벨 Memory Management"
url: https://subculturegamer.com/naninovel-memory-management/
published: 2024-12-16
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’ Memory Management 페이지의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/memory-management)

※마지막 수정일: 2026/5/10

---

일부 스크립트 명령어가 작동하려면 @bgm용 오디오 클립, @char용 캐릭터 프리팹 및/또는 표정 텍스처, @movie용 비디오 클립 등 리소스 로드가 필요합니다.

나니노벨은 대부분의 리소스를 사전에 로드 및 언로드합니다. 이에 관한 기본 동작은 리소스 공급자 구성에 있는 *Resource Policy* 설정을 기반으로 합니다.

![Image](https://subculturegamer.com/wp-content/uploads/2024/12/image-2.png)

---

## Conservative 방식

균형 잡힌 메모리 활용을 제공하는 기본 모드입니다. 스크립트 실행에 필요한 모든 리소스는 재생을 시작할 때 미리 로드되고 스크립트 재생이 끝나면 언로드됩니다. @gosub 명령어가 참조하는 스크립트도 미리 로드됩니다. @goto 명령의 Hold 매개변수를 사용하여 추가 스크립트를 미리 로드할 수 있습니다.

다음은 Conservative 방식에 따라 리소스를 언로드/로드하는 방법에 대한 데모입니다.

### Script1.nani

```
Script1, Script2 및 ScriptGosub의 리소스가 여기에 로드됩니다. Script2는 "@goto Hold!"로 탐색되었기 때문에 로드됩니다."@gosub"가 항상 미리 로드되어 있으므로 ScriptGosub가 로드됩니다.

...

gosub가 항상 미리 로드되어 있으므로 로딩 화면이 표시되지 않습니다.
@gosub ScriptGosub

...

'hold!'를 사용하고 있기 때문에 로딩 화면이 표시되지 않습니다.
@goto Script2 hold!
```

### Script2.nani

```
Script1, Script2 및 ScriptGosub의 리소스는 모두 여전히 로드되어 있습니다.
왜냐하면 이 스크립트는 '@goto Hold!'를 사용하여 탐색되었기 때문입니다.
따라서 Script1의 종속성으로 간주됩니다.

...

'hold!'를 사용하지 않기 때문에 로딩 화면이 표시됩니다.
@goto Script3
```

### Script3.nani

```
이제 Script1, Script2의 리소스가 언로드되고 리소스는
form Script3(이 스크립트)이 로드됩니다.
ScriptGosub의 리소스는 여기서 사용하고 있기 때문에 계속 로드됩니다.

...

gosub가 항상 미리 로드되어 있으므로 로딩 화면이 표시되지 않습니다.
@gosub ScriptGosub

...

'hold!'를 사용하지 않기 때문에 로딩 화면이 표시됩니다.
@goto Script4
```

### Script4.nani

```
이제 모든 리소스가 언로드되었으며(ScriptGosub 포함)
Script4(이 스크립트) 형식의 리소스가 로드됩니다.

...

@stop
```

### ScriptGosub.nani

```
여기서 탐색한 스크립트에 따라 다양한 리소스가 여기에 로드될 수 있습니다.

...

gosub는 항상 gosub로 이동하는 스크립트와 함께 로드되고 스크립트가 언로드될 때까지 언로드되지 않으므로 로딩 화면이 표시되지 않습니다.
@return
```

---

## Optimistic 방식

재생된 스크립트에 필요한 모든 리소스와 @goto 및 @gosub 명령에 지정된 모든 스크립트의 모든 리소스는 미리 로드되며 @goto 명령에 *release* 파라미터가 지정되지 않는 한 언로드되지 않습니다.

이는 화면 로딩을 최소화하고 원활한 롤백을 허용하지만 리소스를 언로드할 시기를 수동으로 지정해야 하므로 모바일 기기나 웹 브라우저와 같이 엄격한 메모리 제한이 있는 플랫폼에서 메모리 부족 예외상황이 발생할 위험이 증가합니다.

아래는 위 Conservative 방식과 유사한 스크립트 세트(데모)이지만 Optimistic 방식의 경우를 설명합니다.

### Script1.nani

```
Script1, Script2, Script3 및 ScriptGosub의 리소스가 모두 여기에 로드됩니다.
Script4는 '@goto release!'로 탐색되었기 때문에 로드되지 않습니다.

...

gosub가 항상 미리 로드되어 있으므로 로딩 화면이 표시되지 않습니다.
@gosub ScriptGosub

...

'릴리스!'가 아닌 이상 로딩 화면은 기본적으로 표시되지 않습니다. 지정됩니다.
@goto Script2
```

### Script2.nani

```
Script4를 제외한 모든 항목은 여전히 ​​로드됩니다.

...

'릴리스!'가 아닌 이상 로딩 화면은 기본적으로 표시되지 않습니다. 지정됩니다.
@goto Script3
```

### Script3.nani

```
Script4를 제외한 모든 항목은 여전히 ​​로드됩니다.

...

gosub가 항상 미리 로드되어 있으므로 로딩 화면이 표시되지 않습니다.
@gosub ScriptGosub

...

이제 '릴리스!'로 인해 로딩 화면이 표시됩니다.
@goto Script4 release!
```

### Script4.nani

```
여기서 탐색했기 때문에 Script4를 제외한 모든 리소스가 이제 언로드됩니다.

...

@stop
```

### ScriptGosub.nani

```
여기서 탐색한 스크립트에 따라 다양한 리소스가 여기에 로드될 수 있습니다.

...

gosub는 항상 gosub로 이동하는 스크립트와 함께 로드되고 스크립트가 언로드될 때까지 언로드되지 않으므로 로딩 화면이 표시되지 않습니다.
@return
```

---

## Lazy 방식

다른 방식은 게임이 일종의 ‘로딩 스크린’을 염두에 두고 제작되었다고 가정합니다. 예를 들어 씬이 바뀌거나 액트, 또는 날짜의 변경 등이 이에 해당합니다.

이러한 방식에서 나니노벨은 CPU 집약적인 리소스 로딩 작업을 일괄적으로 수행할 수 있도록 하여, 실제 게임 플레이를 원활하게 유지되도록 합니다.

하지만 일부 게임은 그러한 구조가 호환되지 않거나 최적화가 불필요한 경우도 있습니다. Lazy 방식을 선택하면, Naninovel은 스크립트를 재생하기 전 로딩 화면을 띄우거나 리소스를 미리 로드하려고 시도하지 않습니다. 그 대신, 스크립트가 실행되는 동안 필요한 리소스를 ‘실시간으로’ 로드합니다.

또한 게임 플레이 도중 지연을 최소화하기 위해 현재 실행 중인 명령보다 앞서 일정 개수의 명령을 미리 로드합니다.

미리 로드되는 명령의 수는 리소스 공급자 구성에 있는 Lazy Buffer 설정을 통해 조정할 수 있습니다.

### Script1.nani

```
Lazy Buffer"가 3으로 설정되어 있다고 가정해 보겠습니다(기본값은 더 높습니다).현재는 버퍼 메모리 내에 있는 "눈" 배경만 미리 로드되어 있습니다.

@back Snow

이제 "앰비언트" 오디오가 사전 로드됩니다.
"마을" 배경이 사전 로드됩니다.

@bgm Ambient
@back Town

이제 "눈" 배경이 보이지 않으므로 로드 해제됩니다.

...

로딩 화면이 표시되지 않습니다. 모든 리소스가 해제됩니다.
Script2의 "눈" 배경 이미지는 버퍼 범위 내에 미리 로드됩니다.

@goto Script2
```

### Script2.nani

```
...
@back Snow

이제 "마을" 배경이 보이지 않으므로 로드 해제됩니다.
```

Lazy 모드에는 중요한 주의사항이 있습니다.

특히 대형 배경 텍스처, HD 캐릭터 모델, 영상 파일 같은 “무거운” 에셋을 로드할 때 게임 플레이 중 눈에 띄는 끊김(stutter)이 발생할 수 있습니다.

Naninovel은 가능한 한 이러한 작업을 메인 스레드가 아닌 곳에서 처리하려고 시도하지만, 성능이 낮은 기기나 특정 플랫폼(특히 웹)에서는 여전히 끊김이 발생할 수 있으며, 특히 스킵(빠른 진행)이나 되감기(rollback) 중에 그 현상이 두드러질 수 있습니다.

따라서 Lazy 정책을 사용할지 결정하기 전에, 반드시 최소 지원 사양의 하드웨어에서 게임을 테스트해 보시기 바랍니다.

## 리소스 정책 선택하기

일반적으로 기본 옵션인 ‘Conservative’ 정책을 고수하는 것이 좋습니다. 이는 모든 대상 플랫폼에 적합한 균형 잡힌 메모리 사용을 제공하는 동시에, 필요 시 hold! 플래그로 유연한 스크립트 병합 기능을 제공하기 때문입니다.

그러나 스탠드얼론이나 게임용 콘솔기기와 같이 더 많은 램을 제공하는 더 강력한 플랫폼 독점으로 하는 경우에는 ‘Optimistic’ 방식을 선택하여 메모리의 리소스에 대한 큰 덩어리를 유지하고 로딩 화면을 최소화할 수 있습니다.

대안이 될 만한 방식으로써 또 다른 시나리오는, 나니노벨이 커스텀 게임 루프 내에서 다이얼로그 시스템으로써 사용되는 경우입니다. 그러한 경우 자체 리소스 관리 시스템을 갖게 될 가능성이 높습니다. ‘Optimistic’ 방식을 선택해도 기본적으로 스크립트를 재생하기 전에 필요한 모든 리소스를 로드된 상태로 유지하는 것 외에는 아무것도 하지 않으므로 명시적으로 `release!` 플래그를 사용하지 않는 한 문제가 되지 않습니다.

다음은 리소스 정책의 차이점을 표로 요약한 것입니다.

| 리소스 정책 | 메모리 사용량 | CPU 사용 | 씬 로딩 빈도 | 롤백 차이 |
| --- | --- | --- | --- | --- |
| Conservative | 균형잡힘 | 안정 | 잦음 | hold 내에서는 빠름 |
| Optimistic | 높음 | 안정 | 거의 없음 | release 외에는 빠름 |
| Lazy | 낮음 | 변동성 있음 | 없음 | 항상 느림 |

---

## 액터 리소스

액터(캐릭터, 배경, 텍스트 출력기 및 선택지 처리기)는 Naninovel의 핵심 실체(엔터티)입니다. 액터가 사용하는 대부분의 메모리는 외양(배리에이션 등)과 연관되어 있습니다.

### 외양

일부 액터 구현에는 외양과 리소스에 1:1로 매핑됩니다. 스프라이트 액터 외양은 단일 텍스처 에셋과 연결되고, 비디오 액터 외양은 단일 비디오 클립과 매핑되는 등입니다. 이를 통해 나니노벨은 시나리오 스크립트에서 참조된 특정 외양을 기반으로 리소스를 관리할 수 있습니다.

예를 들어, 주어진 스크립트에서 스프라이트 캐릭터의 Happy 및 Sad 외양만 사용되는 경우 캐릭터의 다른 외양의 수에 관계없이 스크립트가 재생되기 전에 Happy.png 및 Sad.png 텍스처만 미리 로드됩니다.

그러나 레이어드 방식, 다이스 스프라이트, 제네릭, Live2D 및 Spine 액터에서는 관련 외양 묘사를 위해서는 모노리스 프리팹이 필요하므로 스프라이트 방식과 달리 리소스를 독립적으로 로드할 수 없습니다. 이러한 경우 나니노벨은 모든 종속성과 함께 전체 프리팹을 미리 로드하게 되는데, 어떤 외양이 사용되는지에 관계없이 액터가 어떤 명령어에서도 참조되지 않을 때만 언로드합니다.

### 액터 언로딩

나니노벨은 기본적으로 스크립트 리소스를 언로드할 때 사용하지 않는 액터를 자동으로 제거하고 관련 게임 오브젝트를 삭제(언로드)합니다. 액터를 수동으로 삭제하려면 리소스 공급자 구성 메뉴에서 *Remove Actors* 옵션을 비활성화하고 @remove 명령어를 사용하세요.

```
@back id:LayeredBackground
@char GenericCharacter
@char DicedCharacter

; 'Remove Actors'가 비활성화되면 'NextScript'가 로드될 때
; 'LayeredBackground'가 삭제되지 않지만 두 캐릭터는 모두 삭제됩니다.

@hide GenericCharacter,DicedCharacter wait!
@remove GenericCharacter,DicedCharacter
@goto NextScript
```

또는 ‘\*’ 파라미터와 함께 @remove를 사용하여 기존 액터(텍스트 출력기 및 선택지 처리기 포함)를 모두 삭제하거나 파라미터만 포함하여 @resetState를 사용하여 특정 유형의 액터를 즉시 삭제합니다.

캐릭터의 경우 ICharacterManager, 배경의 경우 IBackgroundManager를 사용하면 됩니다.

```
...
@goto NextScript
; 모든 존재하는 배경 리소스 언로드하기
@resetState only:IBackgroundManager
```

---

## 유지시간 관리

리소스 공급자 관리자는 로드된 리소스에 대한 참조를 추적하고 사용자(‘보유자’)가 리소스를 사용(‘보유’)하지 않을 때 리소스를 삭제(언로드)합니다.

이 메커니즘은 스크립트 명령어에서 가장 두드러집니다.

예를 들어 커스텀 명령어를 사용하여 배경 음악을 재생한다고 가정해 보겠습니다. 오디오 플레이어를 재생하려면 오디오 클립 에셋(리소스)이 필요하므로 명령어가 실행되기 전에 에셋을 미리 로드하고 ‘hold’하고 이후에 해제해야 합니다.

```
public class PlayMusic : Command, Command.IPreloadable
{
    public StringParameter MusicName;

    private IAudioManager audio => Engine.GetService<IAudioManager>();

    public async UniTask PreloadResources ()
    {
        await audio.AudioLoader.LoadAndHold(MusicName, this);
    }

    public void ReleasePreloadedResources ()
    {
        audio.AudioLoader.Release(MusicName, this);
    }

    public override async UniTask Execute (AsyncToken asyncToken = default)
    {
        await audio.PlayBgm(MusicName, asyncToken: asyncToken);
    }
}
```

이 명령어는 Command.IPreloadable 인터페이스를 구현합니다. 스크립트 플레이어는 이러한 명령어를 감지하고 사전 로드 및 언로드 메서드를 호출하여 명령이 실행되기 전에 에셋이 준비되고 실행 이후에 해제되는지 확인합니다.

---

## 리소스 공유

어떤 경우에는 나니노벨과 커스텀 게임 플레이 모드 간에 리소스를 공유하고 싶을 수도 있습니다. 커스텀 게임플레이가 나니노벨과 독립적으로 구현되는 경우(커스텀 모드가 활성화되면 엔진이 비활성화됨) 아무런 문제가 없어야 합니다. 하지만 커스텀 모드와 나니노벨을 동시에 사용하는 경우에는 리소스 사용 방식에 주의를 기울여야 합니다.

예를 들어 일부 UI 요소의 소스로도 사용되는 외양 텍스처가 있는 나니노벨의 스프라이트 배경이 있다고 가정해 보겠습니다. 어느 시점에서 나니노벨은 텍스처 해제를 시도하고 UI 요소에서도 사라질 것입니다. 엔진이 텍스처를 사용하고 있고 언로드되어서는 안 된다는 사실을 인식하지 못하기 때문에 이런 일이 발생합니다.

에셋을 사용하고 있음을 나니노벨에 알리려면 리소스 공급자 서비스의 Hold 메소드를 사용하십시오.

```
var resourceManager = Engine.GetService<IResourceProviderManager>();
resourceManager.Hold(asset, holder);
```

에셋을 보유하고 있는 동안 나니노벨에 의해 언로드되지 않으므로 메모리 누수를 방지하기 위해 에셋을 폐기하는 것은 당신 몫입니다.

```
var holdersCount = resourceManager.Release(asset, holder);
// 에셋을 보유하고 있는 홀더가 아무도 없는 경우 에셋을 언로드해야 합니다.
if (holdersCount == 0) Resources.UnloadAsset(asset);
```

‘Holder’는 모든 객체에 대한 참조가 될 수 있습니다. 일반적으로 에셋을 사용하는 클래스와 동일합니다. 이는 홀더를 구별하고 동일한 홀더가 실수로 리소스를 여러 번 보유하는 것을 방지하는 데 사용됩니다.

다음은 나니노벨이 에셋을 언로드하는 것을 방지하는 Unity 구성 요소의 예입니다.

```
using Naninovel;
using UnityEngine;

public class HoldObject : MonoBehaviour
{
    public Object ObjectToHold;

    private async void Start()
    {
        while (!Engine.Initialized) await UniTask.DelayFrame(1);
        Engine.GetService<IResourceProviderManager>().Hold(ObjectToHold, this);
    }
}
```

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)