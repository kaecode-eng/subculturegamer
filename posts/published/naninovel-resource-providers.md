---
title: "[26년 3월] 나니노벨 Resource Providers"
url: https://subculturegamer.com/naninovel-resource-providers/
published: 2024-10-27
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’ Resource Providers의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/resource-providers)

※최종 수정일: 2026-05-13

---

리소스 제공자는 Naninovel 관련 데이터를 가져오는 데 쓰입니다.

- 시나리오 스크립트의 “.nani” 텍스트 파일
- 캐릭터 스프라이트 텍스처
- 음악의 오디오 클립
- 등등

각 제공자는 특정 소스에서 데이터를 가져오는 데 특화되어 있습니다.

- 프로젝트의 “리소스” 폴더
- Unity Addressable asset system
- 로컬 파일 저장소
- Google Drive 계정
- 등등

리소스 제공자의 구성은 *Naninovel -> Configuration -> Resource Provider* 메뉴에서 가능합니다.

![Image](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-13.png)

리소스 정책(Resource Policy) 프로퍼티는 스크립트 실행 중에 리소스가 로드 및 언로드되는 시기를 지정합니다. 자세한 내용은 [메모리 관리 가이드](https://naninovel.com/guide/memory-management)를 참고하세요.

로그 리소스 로딩(Log Resources Loading) 활성화 시, 다양한 제공자 관련 로그 메시지가 기본 로딩 화면 UI에 표시됩니다.

*빌드 처리 활성화(Enable Build Processing)*는 에디터 메뉴에서 할당된 에셋을 빌드에서 사용 가능한지 확인하는 데 필요한 빌드 사전 처리 절차를 활성화합니다.

[커스텀 빌드 환경](https://naninovel.com/guide/custom-build-environment)을 사용하거나 자체 빌드 후크를 연결하는 경우 처리를 비활성화해야 할 수 있습니다.

해당 속성을 활성화하거나 비활성화할 때 변경 사항을 적용하려면 Unity 에디터를 다시 시작하세요.

[어드레서블 시스템(addressable system)](https://docs.unity3d.com/Packages/com.unity.addressables@latest)이 사용 가능한 상태에서는, *Use Addressables* 옵션을 활성화하면 처리 단계가 최적화되어 빌드 시간이 향상됩니다.

*자동 빌드 번들(Auto build Bundles)*을 동시에 활성화하면 빌드할 때 에셋 번들이 자동으로 컴파일됩니다.

configuration 메뉴의 다른 프로퍼티는 공급자별로 다르며 아래에 설명되어 있습니다.

특정 리소스 제공자의 동작은 해당 구성 메뉴에서 사용할 수 있는 로더 속성을 통해 구성됩니다.

예를 들어 오디오 리소스(BGM 및 SFX)를 검색하는 데 사용되는 기본 로더 구성은 다음과 같습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-12.png)

*Path Prefix* 속성으로 특정 유형의 리소스에 대해 공급자의 루트 경로를 통해 추가 경로를 지정할 수 있습니다.

예를 들어, 프로젝트의 “Resources” 폴더에서 “Explosion” 오디오 파일을 검색하려는 경우 경로 접두사를 “Audio”로 설정하면 다음과 같은 리소스 요청이 발생합니다.

- Resources.Load(“Audio/Explosion”)

*제공자 리스트(Providers List)* 옵션으로, 사용할 공급자 유형과 순서를 지정할 수 있습니다.

예를 들어, 위의 예에서 오디오 리소스를 요청할 때 먼저 “Addressable” 공급자가 사용되고, 공급자가 요청된 리소스를 찾을 수 없는 경우 “Project” 공급자가 사용됩니다.

에디터에 있는 동안에는 (로더 구성에 관계없이) 특별한 “Editor” 리소스 제공자가 항상 먼저 사용된다는 점에 유의하세요.

제공자는 Naninovel의 구성 및 리소스 관리자 메뉴(*Naninovel -> Resources-> …*)를 통해 할당된 모든 리소스에 액세스할 수 있습니다.

게임이 빌드되면 이러한 모든 리소스는 임시 “Resources” 폴더에 자동으로 복사되거나 ([어드레서블 시스템](https://docs.unity3d.com/Packages/com.unity.addressables@latest)이 설치 및 활성화된 경우) 어드레서블 구성에 등록되어 에셋 번들로 컴파일됩니다.

제공자 관련 테스트를 할 땐 Unity 에디터가 아닌 빌드 과정에서 수행한다는 점을 명심하세요.

## 어드레서블(Addressable)

어드레서블 에셋 시스템은 “주소”로 에셋을 로드할 수 있는 Unity 패키지입니다. 비동기 로딩을 사용하여 종속성 컬렉션이 있는 모든 위치(로컬 스토리지, 원격 웹 호스팅 등)에서 로드를 지원합니다. 시스템 설정, 구성 및 사용 방법에 대한 Unity 설명서를 참조하세요.

Naninovel은 프로젝트에 패키지가 설치되고 리소스 제공자 구성에서 `Use Addressables` 옵션이 활성화되면 어드레서블 항목을 자동으로 사용되며 추가 설정이 필요하지 않습니다.

Naninovel의 구성 메뉴에 할당된 모든 에셋(예: 시나리오 스크립트, 캐릭터 스프라이트, 오디오 클립 등)은 플레이어를 구축할 때 시스템에 등록(주소 할당)됩니다.

> **<경고>**
>
> [Unity 버그](https://github.com/naninovel/docs/issues/159)로 인해 addressable은 공통 번들에 패킹된 개별 에셋을 언로드할 수 없습니다. 일시적인 해결 방법은 번들 간에 에셋을 분배하거나 *Bundle Mode*의 Addressable Group 설정을 *Pack Separately*로 설정합니다.
>
> ![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-08.avif)

Naninovel 어드레서블 에셋이 제공되는 방식을 구성하려는 경우(예: 원격 웹 호스트 지정) 메뉴를 통해 Naninovel 그룹을 편집합니다.

*Window -> Asset Management -> Addressables -> Groups*

그룹은 게임을 처음 빌드할 때 자동으로 생성됩니다. 누락된 경우 수동으로 만들 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-11.png)
> **<****메모****>**
>
> Naninovel 주소 지정 가능 그룹 아래의 에셋 레코드는 각 빌드에서 자동으로 생성됩니다.
>
> 변경 사항은 빌드 시 손실되므로 레코드를 수동으로 편집하지 마세요.

### 카테고리 그룹

기본적으로 리소스 공급자 구성의 *Group By Category*은 비활성화되어 모든 Naninovel 리소스가 단일 “Naninovel” 어드레서블 그룹 아래에 추가됩니다.

범주별로 리소스를 그룹화하려는 경우(예: 개별로 패킹하거나 특정 옵션 활성화 시) 속성을 활성화하고 다시 빌드하세요.

활성화되면 각 리소스 범주(예: 스크립트, 오디오, 문자 등)가 “Naninovel-Category”라는 고유한 어드레서블 그룹 아래에 추가됩니다.

여기서 Category는 리소스의 범주입니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-07.avif)

### 수동으로 할당

에디터 메뉴를 사용하지 않고 어드레서블 에셋을 Naninovel 리소스로 등록하려면 주소에 *Naninovel/* 접두사를 추가하고 그 뒤에 리소스 유형(경로 접두사)과 로컬 리소스 경로를 추가하세요.

주소에 파일 확장자는 포함시키면 안 됩니다.

다음은 일반적인 리소스 유형을 수동으로 할당하기 위해 사용할 수 있는 주소의 예시입니다.

| 리소스 타입 | 주소 |
| --- | --- |
| 시나리오 스크립트 | `Naninovel/Scripts/{SCRIPT_PATH}` |
| 캐릭터 외양 스프라이트 | `Naninovel/Characters/{CHARACTER_ID}/{APPEARANCE_PATH}` |
| 일반 캐릭터(제네릭) | `Naninovel/Characters/{CHARACTER_ID}` |
| 오디오 | `Naninovel/Audio/{AUDIO_PATH}` |
| 관리형 텍스트 문서 | `Naninovel/Text/{DOCUMENT_PATH}` |
| 로컬라이징 문서 스크립트 | `Naninovel/Localization/{L10N_TAG}/Text/Scripts/{SCRIPT_PATH}` |

> **<예시>**
>
> Naninovel 리소스를 어드레서블 공급자에 수동으로 노출하고(리소스 편집기 메뉴를 사용하지 않고) 원격 호스트에서 특정 에셋을 제공하는 방법에 대한 [예제 프로젝트](https://naninovel.com/guide/samples#addressable)를 확인하세요.
>
> 어드레서블에 대한 [공식 Unity 학습 자료](https://learn.unity.com/course/get-started-with-addressables)를 참고하셔도 좋습니다.

### 스크립트 레이블

[Unity의 설계 상의 문제](https://github.com/naninovel/docs/issues/159)로 Addressable 에셋은 전체 에셋 번들이 언로드되기 전까지 메모리에서 언로드되지 않습니다. 이는 번들을 제대로 구성하지 않으면 에셋들이 단일 번들에 포함되어 한 번 로드되면 절대 언로드되지 않아 메모리 부족 예외를 발생시킬 수 있다는 의미입니다.

가장 간단한 해결책은 [그룹 설정](https://docs.unity3d.com/Packages/com.unity.addressables@1.22/manual/GroupSchemas.html)에서 *Bundle Mode*를 *Pack Separately*로 설정하는 것입니다.

![Image](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-14.png)

이렇게 하면 각 에셋이 자체 번들이 되어 릴리스되자마자 언로드될 수 있습니다. RAM 사용량 측면에서는 최적이지만, CPU 오버헤드와 로딩 시간이 증가합니다. 하나의 큰 연속된 바이너리 블롭을 로드하는 것이 여러 개의 작은 파일을 반복적으로 찾아 로드하는 것보다 훨씬 빠르기 때문입니다(특히 느린 드라이브에서).

리소스 프로바이더 설정에서 *Label By Scripts*가 활성화되어 있으면(기본값), Naninovel은 절충안을 사용합니다: 빌드 과정에서 모든 시나리오 스크립트를 스캔하여 각 스크립트에 필요한 에셋을 판단하고, 해당 스크립트를 참조하는 addressable 에셋에 레이블을 할당합니다.

![Image](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-15.png)

*Bundle Mode*를 *Pack Together By Label*로 설정하면(기본값), 에셋들이 시나리오 스크립트와의 연관성에 따라 번들로 분할되어 Naninovel의 [메모리 관리 정책](https://naninovel.com/guide/memory-management)에 최적화된 번들 구조를 만듭니다.

> **메모**
>
> Addressables를 통해 수동으로 할당된 에셋을 포함한 모든 Naninovel 에셋이 레이블링 대상입니다. 에셋에 Naninovel 레이블이 있는 한, 연관된 스크립트로 레이블링됩니다.

레이블링 프로세스는 어느 정도 추측이 필요하며 항상 완벽하지는 않습니다. 에셋이 올바르게 레이블링되도록 하려면 다음 가이드라인을 따르세요:

- 액터 ID, 외양, 오디오 경로 등 리소스 컨텍스트의 파라미터에서 [표현식](https://naninovel.com/guide/script-expressions)을 사용하지 마세요. 표현식은 명령이 실행되기 직전에 평가되므로 빌드 시점에 최종 경로를 확인할 수 없습니다. Naninovel은 빌드 중 이러한 경우를 감지하면 경고를 표시합니다.
- [@char](https://naninovel.com/api/#char) 및 [@back](https://naninovel.com/api/#back) 같은 명령에서 항상 액터 ID와 외양을 명시하세요. 이러한 명령이 기본값으로 대체될 수 있지만, 빌드 시에 기본값을 항상 해석할 수 있는 것은 아닙니다.
- [커스텀 명령어](https://naninovel.com/guide/custom-commands)를 만들 때 리소스를 참조하는 파라미터에 [리소스 컨텍스트 속성](https://naninovel.com/guide/ide-extension#ide-attributes)을 적용하세요(예: 액터 ID를 받는 파라미터에 *[ActorContext]*를 적용). 이러한 속성은 주로 IDE 확장의 자동완성에 사용되지만, 레이블링 도구도 이를 사용하여 에셋 주소를 해석합니다.

## 프로젝트

프로젝트 공급자는 Unity 프로젝트의 “Resources” 폴더에 있는 에셋을 제공합니다. [프로젝트 리소스 로딩 API](https://docs.unity3d.com/Manual/LoadingResourcesatRuntime)에 대한 자세한 내용은 Unity 가이드를 참조하십시오.

> **주의**
>
> **대부분의 경우**[**“Resources” 폴더를 사용하지 않는 것**](https://docs.unity3d.com/Manual/BestPracticeUnderstandingPerformanceInUnity6)**이 좋습니다.** 가능하면 Naninovel 리소스 관리자 메뉴를 통해 리소스를 할당하거나 대안으로 어드레서블 시스템을 사용하는 것이 좋습니다. 그후에 에셋을 “Resources” 폴더 밖으로 이동하는 것을 잊지 마십시오.

## 로컬(Local)

로컬 공급자를 사용하면 로컬 파일 시스템의 임의의 위치에서 간단한(시나리오 스크립트 및 관리 텍스트, 스프라이트 캐릭터 및 배경, 오디오) 에셋을 제공할 수 있습니다.

> **메모**
>
> 로컬 공급자는 파일 시스템에서 raw 파일(원본 파일)을 로드하고 런타임에 변환하므로 다른 공급자에 비해 속도가 느리고 지원되는 파일 형식이 제한됩니다.
>
> 개발 또는 특정 기능(예: [커뮤니티 모딩](https://naninovel.com/guide/resource-providers#community-modding))에만 사용하십시오.

**<지원되는 파일 형식>**

- **.nani:** 시나리오 스크립트
- **.png /****.jpg:** 이미지/텍스처
- **.wav:** 오디오(PCM16 44100Hz 스테레오)

> **팁**
>
> 지원되는 파일 형식을 더 추가할 수 있습니다. *`IResourceProviderManager`*나니노벨 엔진 서비스를 재정의하고 로컬 공급자에 대한 사용자 지정 변환기를 추가하는 방법이 있습니다.
>
> ![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-06.avif)

*Local Path Root* 리소스 제공자 구성의 속성은 로컬 리소스가 저장된 폴더를 가리켜야 합니다.

절대 경로(예: C:Resources) 또는 상대 경로를 사용할 수 있으며, 다음 원본 중 하나로 시작합니다.

- %DATA% — 대상 디바이스의 게임 데이터 폴더(Application.dataPath)
- %PDATA% — 대상 디바이스의 영구 데이터 디렉토리(Application.persistentDataPath)
- %STREAM% — “StreamingAssets” 폴더(Application.streamingAssetsPath)
- %SPECIAL{F}% — OS 특수 폴더로, 여기서 F는 특수 폴더 열거형 값의 이름입니다.

*기본값(%DATA%/Resources)*은 게임의 데이터 디렉터리 내에 있는 “Resources” 폴더를 가리킵니다. (단, 대상 플랫폼에 따라 다를 수 있습니다)

사용 예 중 하나로, 시나리오 공동 작업을 위해 공유 폴더에서 naninovel 스크립트를 로드한다고 가정해 보겠습니다.

*C:/Users/Admin/Dropbox/MyGame/Scripts*

루트 폴더에 대한 절대 경로(*C:/Users/Admin/Dropbox/MyGame*)를 지정하는 것도 가능하지만, 이를 위해서는 모든 공동 작업자가 정확히 동일한 경로(동일한 드라이브 레이블 및 사용자 아래)로 폴더를 저장해야 합니다. 이름).

대신 “UserProfile” 특수 폴더 원본에 대해 다음 상대 경로를 사용하는 것을 권장합니다.

*%SPECIAL{UserProfile}%/Dropbox/MyGame*

![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-05.avif)

스크립트 설정에서 주어진 Path Prefix가 Scripts로 설정되고 로컬 제공자(local provider)가 리스트에 추가되었다면, 스크립트 내비게이터는(nav [콘솔 명령](https://naninovel.com/guide/development-console)으로 액세스 가능한) 폴더 아래에 저장된 모든 “.nani” 텍스트 파일을 선택해야 합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-04.avif)

## 커스텀 제공자(Custom Providers)

리소스 제공자의 커스텀 구현을 추가하고 Naninovel이 이를 내장 공급자와 함께(또는 대신) 사용하도록 하는 것이 가능합니다.

커스텀 제공자를 추가하려면 매개 변수가 없는 생성자를 사용하여 C# 클래스를 만들고 *IResourceProvider* 인터페이스를 구현합니다.

일단 생성되면 커스텀 제공자 유형이 빌트인 타입과 함께 모든 로더 구성 메뉴에 나타납니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-01.avif)

*Naninovel/Runtime/Common/ResourceProvider* 패키지 디렉터리에서 내장 리소스 공급자 구현을 찾을 수 있습니다. 자신의 버전을 구현할 때 이를 참조로 자유롭게 사용하십시오.다음은 아무 작업도 수행하지 않고 사용될 때 메시지를 기록하는 커스텀 제공자의 예입니다.

## 커뮤니티 모딩

커뮤니티 모딩은 플레이어가 자신만의 시나리오와 리소스를 추가하여 빌드를 수정하면서도 게임의 내장 리소스에 계속 접근할 수 있게 해줍니다.

이 기능을 활성화하려면 Scripts 설정 UI(Naninovel -> Configuration -> Scripts)에서 *Enable Community Modding* 속성을 활성화하고, 모딩에 노출하고자 하는 모든 리소스에 대해 Local 프로바이더를 설정하세요. [Local](https://naninovel.com/guide/resource-providers#local) 프로바이더의 루트 경로가 기본값(*%DATA%/Resources*)으로 설정되어 있는지 확인하여 빌드 디렉토리 내에서 리소스를 찾도록 해야 합니다.

![Image](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-resource-providers-16.png)

기능이 활성화되면 타이틀 메뉴에 “EXTERNAL SCRIPTS” 버튼이 나타나며, 이를 클릭하면 외부 스크립트 브라우저가 열립니다. 에디터에서는 브라우저가 프로젝트 에셋의 시나리오 스크립트도 함께 표시합니다.

참고로, *External Loader* 설정은 외부 스크립트 브라우저에 표시되는 스크립트를 제어하고, *Loader* 설정은 실제 스크립트 리소스 로딩을 제어합니다. 외부 로더는 기본적으로 로컬 제공자를 사용하므로 게임 빌드 디렉터리에 있는 스크립트만 찾습니다. 배경, 캐릭터 등 다른 리소스 유형의 경우, 플레이어가 추가할 수 있도록 해당 설정 메뉴에서 로컬 제공자를 수동으로 설정해야 합니다.

빌드에 외부 리소스를 추가하려면, 게임의 *Resources* 디렉터리 아래에 있는 하위 폴더에 해당 리소스를 넣어야 합니다. 이 하위 폴더는 *Loader* 접기 메뉴(Foldout)에서 설정한 리소스의 Path Prefix 프로퍼티와 대응됩니다.

예를 들어:

외부 시나리오 스크립트 추가  
→ *GameFolder/GameName\_Data/Resources/Scripts*  
배경 이미지 추가  
→ *GameFolder/GameName\_Data/Resources/Backgrounds*

이와 같은 방식으로 넣으면 됩니다.

GameFolder와 GameName은 Unity 프로젝트의 이름에 따라 달라집니다.

[UI 사용자 지정 기능](https://naninovel.com/guide/gui#ui-customization)을 사용하면 외부 스크립트 브라우저의 UI를 사용자 지정하거나 완전히 대체할 수 있습니다.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)