---
title: "나니노벨 Samples"
url: https://subculturegamer.com/naninovel-samples/
published: 2025-03-16
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

※원문 페이지: [(링크)](https://naninovel.com/guide/samples)

※마지막 수정일: 2025/3/16

---

## Samples

일반적인 개발 시나리오를 시작하는 데 도움이 되는 예제 프로젝트 컬렉션이 제공됩니다. 샘플에 액세스하는 방법과 각 샘플에 대한 간략한 설명을 읽어보세요.

---

### 샘플 프로젝트 접근하기

샘플은 [엔진의 모노레포](https://github.com/naninovel/engine/tree/stable/unity/samples) 하위에 호스팅됩니다. 저장소에 액세스하려면 [Naninovel 라이선스](https://naninovel.com/register)를 등록하고 대시보드 지침에 따라 GitHub 사용자를 할당하세요.

액세스 권한이 부여되면 저장소를 [클로닝](https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository)하거나 [다운로드](https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository)하세요.

다운로드한 저장소의 압축을 풀고 Unity 에디터를 사용하여 *unity/samples* 디렉터리를 엽니다. 나니노벨은 패키지 관리자에서 로컬 패키지로 참조된다는 점에 주의하세요. 로컬 패키지의 소스는 Unity 익스텐션의 소스 코드가 포함된 *unity/client*로 연결됩니다.

샘플에 사용된 기타 서드파티 패키지는 편의를 위해 프로젝트에 포함되어 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-8.avif)

Unity 에디터에서 *Assets/Scenes/Main.unity* 씬을 열고 플레이 모드로 들어갑니다. [데모 프로젝트](https://naninovel.com/demo)의 타이틀 화면을 볼 수 있습니다. 데모를 시작하거나 ‘SAMPLES’ 버튼을 클릭하여 아래에 설명된 사용 가능한 샘플을 탐색할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-7.avif)

---

### 어드레서블

이 샘플은 [어드레서블 공급자](https://naninovel.com/guide/resource-providers.html#addressable)에 나니노벨 리소스를 수동으로 등록하고(리소스 에디터 메뉴를 사용하지 않고) 원격 호스트에서 에셋을 제공하는 방법을 보여줍니다.

샘플 프로젝트의 리소스 대부분은 리소스 관리자 메뉴에 할당되어 있지 않습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-6.avif)

— 동일한 방식으로 나니노벨 스크립트에서 계속 액세스할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-13.png)

```
@back Snow
```

에셋에 Naninovel 리소스 주소와 레이블이 할당되어 있어야 작동합니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-5.avif)
> **메모**
>
> 수동으로 등록된 리소스가 Unity 에디터에서 작동하려면 리소스 공급자 구성에서 Editor에서 *Allow Addressable In Editor* 옵션을 활성화해야 합니다.

---

### 피사계 심도 뷰(Perspective) 씬

이 샘플은 여러 애니메이션 환경 스프라이트, 원근 모드의 카메라 렌더링 및 보케(피사계 심도) 효과로 채워진 일반 배경을 보여줍니다. 배경은 *Content/Backgrounds/Perspective* 디렉터리에 저장됩니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-610d2cafe5fbe42aba7adb9ac71720d1.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-610d2cafe5fbe42aba7adb9ac71720d1.mp4@main.mp4?_=1)

---

### 컴파일러 로컬라이제이션

샘플 프로젝트에서 컴파일러 현지화를 활성화하려면 *Profiles/Naninovel/CompilerRU* 자산을 스크립트 구성의 `Compiler Localization` 필드에 할당하세요. 그런 다음 Unity 편집기와 VS Code 확장을 다시 시작하세요. 이제 VS Code를 사용하여 프로젝트를 열고 `Compiler Localization` 샘플 시나리오를 실행할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-4.avif)

---

### E2E

*E2E Tests* 샘플은 [자동화 엔드 투 엔드 테스트](https://naninovel.com/guide/automated-testing) 모음을 설정하고 사용 가능한 대부분의 API를 사용하는 방법을 보여줍니다.

테스트 스크립트는 Scripts/E2E 폴더에 저장됩니다. 폴더에 있는 .asmdef 파일을 확인하세요. 이는 Unity 관련 테스트 환경에서 테스트 소스를 컴파일하는 데 필요합니다. 또한 테스트 어셈블리를 Unity의 테스트 실행기에 노출하는 *Packages/manifest.json* 파일의 *testables* 항목을 참고하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-3.avif)

---

### 제네릭 액터

Unity 애니메이터로 제작된 3D 모델 및 애니메이션으로 일반 액터 구현을 설정하고 사용하는 방법을 보여주는 *Content/Backgrounds/Beach*, *Content/Backgrounds/Perspective* [제네릭 배경](https://naninovel.com/guide/backgrounds#generic-backgrounds) 및 *Content/Characters/Kohaku/K3D* [제네릭 캐릭터](https://naninovel.com/guide/characters#generic-characters)를 찾아보세요.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-2.avif)

---

### 입력 키 할당

문서: [https://naninovel.com/guide/input-processing.html#input-system ↗](https://naninovel.com/guide/input-processing.html#input-system)

플레이어가 기본 컨트롤을 변경할 수 있는 입력 리바인딩 UI의 예는 *Content/UI/InputRebind* 폴더에서 찾을 수 있습니다. 이는 입력 시스템 패키지와 함께 번들로 제공되는 ‘Rebind UI’ 샘플을 기반으로 합니다. [Unity 문서](https://docs.unity3d.com/Packages/com.unity.inputsystem@1.1/manual/ActionBindings.html#interactive-rebinding)에서 자세한 내용을 확인하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-samples-1.avif)

---

### (드롭인) 통합

3D 어드벤처 게임의 드롭인 다이얼로그와 전환 가능한 스탠드얼론 비주얼 노벨 모드로 사용하는 나니노벨 예제 프로젝트입니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-b1b6042db4a91b3a8cee74236b33c17c.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-b1b6042db4a91b3a8cee74236b33c17c.mp4@main.mp4?_=2)

모든 프로젝트별(예제) 스크립트는 *Scripts/Runtime/Integration* 폴더에 저장됩니다.

Naninovel은 통합 씬에 있는 *SetupGame* 게임 오브젝트에 연결된 *SetupGame.cs* 스크립트로 수동으로 초기화됩니다(엔진 구성 메뉴에서 자동 초기화가 비활성화되어 있습니다).

트리거의 구성 요소로 사용되는 *DialogueTrigger.cs* 스크립트는 플레이어가 트리거 콜라이더에 접촉할 때(hit) 다이얼로그 모드로 전환시킵니다.

*SwitchToNovelMode.cs* 커스텀 명령어는 C# 및 naninovel 스크립트 양쪽에서 노벨 모드로 전환하는 데 사용됩니다.

*SwitchToAdventureMode.cs* 커스텀 명령어는 노벨 모드에서 어드벤처로 전환하는 데 사용됩니다.

---

### 인벤토리

인벤토리 시스템은 비주얼 노벨의 범위를 벗어나지만, 나니노벨과의 통합 과정에서 많은 요청과 질문이 있었습니다.

현재 나니노벨에서는 인벤토리를 생성하고 통합하는 인벤토리 확장의 예시가 되는 ‘인벤토리 샘플’을 지원합니다. 엔진 소스 코드를 수정하지 않고도 나니노벨 설치 시 설정해서 활용할 수 있습니다.

> **메모**
>
> 인벤토리는 나니노벨 내의 스탠드얼론 프로젝트이거나 그 일부가 아닙니다. 엔진을 커스터마이징하고 확장하는 방법을 터득하기 위해 사용해야 하지, 그것을 인벤토리 시스템을 구현하기 위한 예비 프로덕션의 해결책으로 사용하는 건 무리가 있습니다. 그러한 솔루션을 찾고 계시다면 에셋 스토어를 차장보시거나 scratch를 이용해 자신만의 것을 만드는 것을 권장합니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-86c577f007daf4ec5d79c0e91db7bc10.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-86c577f007daf4ec5d79c0e91db7bc10.mp4@main.mp4?_=3)

샘플 프로젝트는 그리드 레이아웃, 페이지 매기기, 드래그&드롭 윈도우, 그리고 커스텀 엔진 서비스와 연관 구성 메뉴, 입력 바인딩, 상태 아웃소싱, 화자 커스텀 시나리오 명령어 및 표현식 등을 이용하여 만드는 것으로 구성되어 있습니다.

템플릿으로부터 앞서 만들어진 인벤토리 UI를 만드려면 Create – Naninovel – Inventory – Inventory UI 에셋 컨텍스트 메뉴를 활용하세요. 그 다음 Naninovel – Resources – UI 에디터 메뉴로 나니노벨 UI 리소스에 프리팹을 추가하세요. 일단 추가하면 UI는 @showUI 및 @hideUI 명령어를 가진 다른 모든 UI와 같이 표시하거나/숨길 수 있습니다.

인벤토리 UI 컴포넌트는 인벤토리의 슬롯 수를 결정하는 Capacity 프로퍼티를 가집니다. 슬롯 그리드는 Content/InventoryGrid 게임 오브젝트를 통해 구성되는데, 슬롯의 수와 레이아웃, 페이지당 슬롯의 수 등이 여기서 결정됩니다. 윈도우 드래그&드롭 행위는 Content 게임 오브젝트에 내장된 Drag Drop 컴포넌트에 의해 활성/비활성 여부가 구성됩니다.

![](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-samples-인벤토리.avif)

인벤토리 아이템 프리팹은 Create -> Naninovel -> Inventory -> Inventory Item 에셋 컨텍스트 메뉴에서 생성됩니다. 아이템 프리팹은 Naninovel -> Resources -> Inventory 에디터 메뉴를 통해 인벤토리 리소스로 할당되어야 합니다.

등록 필요 개수가 많고 에디터 메뉴에서 일일히 할당하는 것이 불편하다면 Resources/Naninovel/Inventory 폴더에 파일을 두면 엔진에서 자동으로 노출됩니다. 원하는 경우 하위 폴더를 추가하여 구성하는 방법도 가능합니다. 이 경우 나니노벨 스크립트에서 참조할 때 전방 슬래시 (/)를 사용하세요. 예를 들어, Resources/Naninovel/Inventory/Armor/Fullplate.prefab이라고 저장된 아이템은 스크립트에서 Armor/FullPlate로 참조할 수 있습니다.

어드레서블 에셋 시스템을 활용하여 리소스를 수동으로 노출시킬 수도 있습니다. 에셋을 노출시키려면 위에서 묘사된 메서드를 통했던 것처럼 동일한 경로의 주소를 할당하는 것으로 가능한데, 이때 “Resourcs/” 부분은 제외합니다.

예를 들어, “FullPlate.prefab” 아이템을 노출시키려면 Naninovel/Inventory/FullPlate 주소를 프리팹 에셋에 할당합니다. 어드레서블 공급자는 에디터에서 디폴트로 사용되지 않습니다. 리소스 공급자 구성 메뉴(resource provider configuration)에서는 Enable Addrassable In Editor 설정을 활성화할 수 있습니다.

각 아이템은 Stack Count Limit 프로퍼티를 가져, 하나의 타입의 아이템이 단일 인벤토리 슬롯 내에서 얼마나 많이 누적될 수 있는지 제한합니다. 그리고 On Item Used 유니티 이벤트는 아이템이 사용된 경우 활성화됩니다. (@useItem 명령어 또는 유저가 인벤토리 아이템을 클릭했을 때)   
아래는 Play Script 컴포넌트 이벤트를 설정하여 항목을 사용하면 항목을 제거하고 글리치 특수 효과를 스폰하고 문자 메시지를 인쇄하는 방법에 대한 예입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-samples-인벤토리-2.avif)

@additem 명령어로 이벤토리에 아이템을 추가하고 @removeItem (또는 @removeItemAt, @removeAllItems)으로 제거 할 수 있습니다. 아이템 ID는 아이템 프리팹 이름과 같습니다. 인벤토리 슬롯 ID는 그리드 슬롯 인덱스와 같습니다. (예: 첫 슬롯은 0, 두 번째는 1, 등등)

itemExist () 및 itemCount () 커스텀 표현식 기능을 이용해 아이템이 인벤토리에 존재하는지, 아이템의 개수는 현재 몇 개인지 등을 편의를 위해 사용할 수 있습니다.

아래는 예제 프로젝트의 스크립트입니다.

```
# Start

Select an action.[< skip!]

@choice "Pick up sword" if:!itemExist("Sword")
    @addItem Sword
@choice "Pick up armor" if:!itemExist("Armor")
    @addItem Armor
@choice "Adventure awaits, venture forth!"
@stop

# Adventure

@if itemExist("Sword")
	@set monstersSlayed={ itemExist("Armor") ? random(3,5) : 2 }
	@addItem Food amount:{monstersSlayed}
	You've encountered and slayed {monstersSlayed} monsters with your sword.
	@goto .Start
@else
	But you don't have a weapon! You've been beaten by the monsters.
	@goto .Start
```

![](https://subculturegamer.com/wp-content/uploads/2025/02/image-17.png)

---

### Live2D

아래 샘플은 Live2D 캐릭터를 나니노벨에서 활용한 시연입니다. *Content/Characters/Hiyori*와 *Content/Characters/Senko* 경로를 찾아 보세요.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-b81df72fc7afaed569520496cbee09f0.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-b81df72fc7afaed569520496cbee09f0.mp4@main.mp4?_=4)

---

### 로컬라이제이션

- 생성된 로컬라이제이션 문서는 *Profiles/Naninovel/Resources/Naninovel/Localization* 경로에 저장됩니다.
- 생성된 시트는 샘플 프로젝트 루트 경로의 Sheets에 저장됩니다.
- 로컬라이제이션에 사용된 폰트는 *Profiles/Naninovel/Resources/Naninovel/Fonts* 경로에 저장됩니다.

#### Localization Tool을 위한 폴더

| 폴더 | 경로 |
| --- | --- |
| Script Folder (input) | Assets/Scripts/Scenario |
| Text Folder (input) | Assets/Profiles/Naninovel/Resources/Naninovel/Text |
| Locale Folder (output) | Assets/Profiles/Naninovel/Resources/Naninovel/Localization |

#### Spreadsheet Tool을 위한 폴더

| 폴더 | 경로 |
| --- | --- |
| Input Scripts Folder | Assets/Scripts/Scenario |
| Input Text Folder | Assets/Profiles/Naninovel/Resources/Naninovel/Text |
| Input Localization Folder | Assets/Profiles/Naninovel/Resources/Naninovel/Localization |
| Output Folder | Sheets |

[<https://naninovel.com/imgit/encoded/i.gyazo.com-97d232751dd7e97bc828f3521f1d2066.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-97d232751dd7e97bc828f3521f1d2066.mp4@main.mp4?_=5)

---

### 맵

아래 샘플은 C# 스크립팅 없이 상호작용 가능한 맵을 구현하는 예시입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-월드맵.avif)

맵은 Content/UI/Map에 커스텀 UI로 구현됩니다. 해당 위치는 일반 유니티의 UI 버튼 경로입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-월드맵-하이어라키.avif)

버튼의 클릭 및 호버 이벤트는 Naninovel의 [Play Script](https://naninovel.com/guide/user-interface.html#play-script-on-unity-event) 컴포넌트에서 처리됩니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/i.gyazo_.com-a64ee9beee378c687d0d8093334f4ef7.png@main.avif)

위치의 가용성은 버튼에 연결된 [가변 트리거(Variable Trigger)](https://naninovel.com/guide/custom-variables.html#variable-triggers) 컴포넌트에서 제어됩니다.

---

### RTL

RTL 출력기는 *Content/Printers/RTL* 경로에 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-rtl.avif)

---

### 액터 셰이더

예제에서는 커스텀 트랜지션 효과와 스프라이트 셰이더에 라이팅과 자체 조명 기능을 지원하는 텍스처 셰이더를 생성하고 사용하는 방법을 보여줍니다. 후자는 배경 액터의 시간을 시뮬레이션하는 데 사용됩니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-a9d7fb29d5e076245ac515d673cc155e.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-a9d7fb29d5e076245ac515d673cc155e.mp4@main.mp4?_=6)

커스텀 셰이더는 `Scripts/Shaders` 디렉토리에 저장됩니다.

배경 텍스처의 알파 레이어에는 자체 조명 마스크가 있습니다. 커스텀 셰이더에 의해 제어되는데, 전역 광원(global light)를 무시하고 어떤 영역에 빛을 방출할 것인지 계산합니다.

일일 시간(Time of Day)은 *Scripts/Runtime/Shader/TimeOfDay.cs*로 제어되며, 이는 24시간 중 특정 지점에서 밝기의 색상과 빛의 강도를 구성하게 합니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-timeofday.avif)

컴포넌트 API는 *Scripts/Runtime/Shader/SetHour.cs* 커스텀 명령어에 의해 naninovel 스크립트에 노출되며, 이로써 @hour 명령어로 시간을 설정할 수 있습니다.

```
; 현재 시간을 약 3초간 18:00 (6:00 PM)로 설정합니다.
@hour 18 duration:3
```

---

### 스파인

샘플에서는 나니노벨로 스파인을 시연하는 것을 보여줍니다. Content/Characters/Spine 경로를 확인해 보세요.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-08b04de115d97427d152cb5f37065d2d.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-08b04de115d97427d152cb5f37065d2d.mp4@main.mp4?_=7)

---

### UI

아래 샘플은 새 커스텀 UI와 내장된 UI를 수정한 버전의 예시를 보여줍니다.

- 타이틀 스크린

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-title.avif)

- 뮤직 갤러리

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-music-gallary.avif)

- 크레딧

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-credit.avif)

- 대화 출력기에서의 읽은 시간 표시

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-dialogue.avif)

- 커스텀 선택지 처리기

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-choice-handler.avif)

- 텍스트 이모지

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-emoji.avif)

- 텍스트 폰트 변형

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-font.avif)

- 캘린더

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-calander.avif)

모든 UI 샘플은 Content/UI 경로에서 확인할 수 있습니다.

---

### 레이어드 액터

*Content/Charecters/Miho* 경로에서 레이어드 캐릭터 액터를 찾을 수 있습니다.

*Content/Backgrounds/Particles* 경로에서 카메라 렌더링 모드로 설정된 레이어드 액터 배경을 찾을 수 있습니다.

### 분절된 액터

*Content/Charecters/kohaku/Diced* 경로에서 분절된 캐릭터 액터와 아틀라스를 찾을 수 있습니다.

### 비디오 액터

비디오 배경 액터는 `Content/Backgrounds/Video` 경로에서 확인할 수 있습니다.

비디오 캐릭터 액터는 `Content/Characters/Ball` 경로에서 확인 가능합니다.

### 씬 배경

씬 배경은 `Content/Backgrounds/Scene` 경로에 있습니다.

### 트랜지션 효과

데모에 쓰인 모든 트랜지션 효과는 *`Scripts/Scenario/Transitions`* 경로의 시나리오 스크립트에서 확인 가능합니다.

### 오토 보이스

영어(EN) 및 일본어(JA) 로케일의 보이스 클립은 Content/Audio/Voice 이하 경로에 저장됩니다.

“AUTO VOICING” 예시에서 게임 설정의 보이스 언어에서 언어 전환 예시를 확인할 수 있습니다.

### 뮤직 인트로

@BGM 명령어의 intro 파라미터를 사용하는 방법을 통해 트랙에서 루프되는 지점이 나오기 전 인트로 파트가 한 번 재생되는 예시를 확인할 수 있습니다.

### 배경화면 매칭

배경화면 매칭 기능의 데모에서는 서로 다른 종횡비를 가진 배경이 디스플레이 뷰포트와 일치하게 하는 방법을 보여줍니다.

### 비주얼 스크립팅

[비주얼 스크립팅](https://docs.unity3d.com/Packages/com.unity.visualscripting@latest) (이전에는 Bolt라고도 불림)은 기본적으로 Unity 2021 및 최신 버전에서 기본 번들로 제공되는 내장 패키지입니다. 프로그래머와 비 프로그램자가 코딩을 하지 않고도 유닛 기반 그래프를 사용하여 게임 또는 응용 프로그램에 대한 논리를 만들 수 있게 도와줍니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-flow-graphs.avif)

먼저, 호환 가능한 Unity 버전 (2021.2 또는 더 최신버전)을 사용하고 있는지, Package Manager에서 *Visual Scripting* 패키지가 설치되어 있는지 확인하십시오.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-visual-scripting.avif)

“Visual Scripting” 프로젝트 설정 메뉴에 있는 Node Library 목록에 Elringus.Naninovel.Runtime 라이브러리를 추가하세요. 엔진 타입과 API를 비주얼 스크립팅 그래프에 노출시키는 데 필요합니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-visual-scripting-2.avif)

비주얼 스크립팅은 라이브러리에 사용 가능한 모든 타입을 자동으로 보여주지 않습니다. 따라서 필요한 나니노벨 타입을 동일 설정 메뉴의 *Type Options* 리스트에 추가해야 합니다. 아래의 예시에서는 *Engine, Script Player Interface, Script Player Extensions*를 추가했지만, [엔진 서비스 인터페이스](https://naninovel.com/guide/engine-services), 구성 등을 더 추가해야할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-visual-scripting-3.avif)

라이브러리와 타입을 추가하여 변경 사항을 적용한 후에는 유닛 재생성(Regenerate Units)을 실행하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-visual-scripting-4.avif)

비주얼 스크립팅 설정에 Naninovel 라이브러리 및 타입이 추가되면, 엔진 API는 그래프 보기 아래의 퍼지 파인더에서 사용할 수 있으며 또다른 Unity나 서드파티 API와 같은 방식으로 사용할 수 있습니다. 아래는 엔진을 초기화하고 스크립트를 재생하는 예입니다.

이 예제를 실행하기 전 Initialize On Application Load와 remove Title UI 옵션을 비활성화하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-visual-scripting-5.avif)

시나리오 스크립트에서 비주얼 스크립팅 그래프 또는 상태 머신(state machine)으로 이벤트를 보내고 싶다면 아래의 예시를 참고하세요. 아래의 커스텀 명령어는 제공된 이름의 게임 오브젝트를 찾아서 지정된 이름과 인수가 있는 경우 이벤트 전송을 시도합니다.

```
using Naninovel;
using Unity.VisualScripting;
using UnityEngine;

[CommandAlias("bolt")]
public class BroadcastBoltEvent : Command
{
    [ParameterAlias("object"), RequiredParameter]
    public StringParameter GameObjectName;
    [ParameterAlias("name"), RequiredParameter]
    public StringParameter EventName;
    [ParameterAlias("args")]
    public StringListParameter Arguments;

    public override UniTask Execute (AsyncToken token = default)
    {
        var gameObject = GameObject.Find(GameObjectName);
        if (!gameObject)
        {
            Debug.LogError($"Failed to broadcast '{EventName}' bolt event: '{GameObjectName}' game object is not found.");
            return UniTask.CompletedTask;
        }

        CustomEvent.Trigger(gameObject, EventName, Arguments);

        return UniTask.CompletedTask;
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/03/image.png)

컨텐츠를 프로젝트 에셋 경로 내부에 저장된 새 C# 스크립트에 복사-붙여넣기하면 명령어를 자동으로 사용할 수 있게 되며 아래는 그 사용 예시입니다.

```
; 주어진 인수와 함께 MyEvent를 ExampleEvent 게임 오브젝트로 보냅니다.
@bolt object:ExampleEvent name:MyEvent args:ExampleMessage,Script002
```

![](https://subculturegamer.com/wp-content/uploads/2025/03/image-1.png)

아래는 ExampleEvent 게임 오브젝트에 첨부된, 메시지를 인쇄하고 지정된 스크립트를 플레이하는 예제 그래프입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/03/나니노벨-samples-visual-scripting-6.avif)

### 유니태스크

UniTask는 오픈 소스(MIT 라이센스) 라이브러리로, 유니티에서 더 효율적인 Task 기반 비동기 프로그래밍 구현을 제공합니다. 라이브러리의 저자가 쓴 기사로부터 최적화와 사용 예시에 관한 더 많은 내용을 찾아볼 수 있습니다.

나니노벨은 엔진 런타임 어셈블리 내부에 내장되어있는 Unitask V1의 스트리핑 및 수정 버전을 사용합니다. 비동기 메서드 대부분은 Unitask 오브젝트를 반환하는데, 이 객체는 “System.Threading” 네임 스페이스의 기본 Task 오브젝트와 동일한 방식으로 대기하게 합니다.

풀 스탠드얼론 UniTask 라이브러리를 사용하려는 경우, 공식 레포지토리 (github.com/Cysharp/Unitask)에서 Unitask V2를 설치하고 필요 시 Naninovel API에 ‘Naninovel.UniTask’를 지정하세요.

```
using Naninovel;
using UnityEngine;

public class UniTaskCommand : Command
{
    // This method uses embedded UniTask v1.
    public override async Naninovel.UniTask Execute (AsyncToken token = default)
    {
        var message = await WaitAndReturnMessage();
        Debug.Log(message);
    }

    // This method uses standalone UniTask v2.
    private async Cysharp.Threading.Tasks.UniTask<string> WaitAndReturnMessage ()
    {
        await Cysharp.Threading.Tasks.UniTask.DelayFrame(100);
        return "Hello from UniTask v2!";
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/03/image-2.png)

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)