---
title: "나니노벨 Input Processing"
url: https://subculturegamer.com/naninovel-input-processing/
published: 2024-10-13
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

※원문 페이지: [(링크)](https://naninovel.com/guide/input-processing)

---

엔진은 사전 구성된 리스너를 사용하여 사용자 입력을 처리합니다. 각 입력 리스너에는 다음과 같은 속성이 있습니다.

| Property | 설명 |
| --- | --- |
| Name | 입력 리스너의 식별자입니다. 다른 엔진 시스템에서 리스너를 참조하는 데 사용됩니다. |
| Always Process | 입력 차단 모드에서 입력을 처리할지 여부입니다. 예: ‘무비’를 볼 때. |
| Keys | 입력을 활성화하는 키(버튼) 목록입니다. |
| Axes | 입력을 활성화하는 축 목록(예: 마우스 또는 게임패드 아날로그 스틱)입니다. |
| Swipes | List of swipes (touch screen) which activate the input. 입력을 활성화하는 터치스크린에서의 스와이프 목록입니다. |

구체적인 값은 Unity의 [입력 가이드](https://docs.unity3d.com/Manual/ConventionalGameInput.html)를 참조하세요.

*Naninovel -> Configuration -> Input*에 맞는 메뉴를 사용하여 내장 입력 바인딩을 구성하고 새 리스너를 추가할 수 있습니다. 사용 가능한 옵션은 [구성 가이드](https://naninovel.com/guide/configuration#input)를 참조하세요.

> **예시**
>
> 인벤토리 UI를 전환하기 위해 커스텀 입력 바인딩을 추가하는 예는 GitHub의 [인벤토리 프로젝트](https://github.com/naninovel/samples/tree/main/unity/inventory)에서 찾을 수 있습니다.
>
> 특히 커스텀 ‘ToggleInventory’ 바인딩은 [UI/InventoryUI.cs](https://github.com/naninovel/samples/blob/main/unity/inventory/Assets/NaninovelInventory/Runtime/UI/InventoryUI.cs#L215) 런타임 스크립트에서 사용됩니다. 동일한 이름의 바인딩은 제어 구성표 아래의 입력 구성 메뉴를 통해 추가됩니다.

@processInput 명령어로 입력 처리를 중지시키고 다시 시작할 수 있습니다.

---

## 디폴트 리스너

다음은 키보드 및 게임패드에 대한 기본 키 바인딩이 포함된, 사전에 구성된 입력 리스너 목록과 관련 설명입니다.

| 명칭 | 키보드 + 마우스 | 게임패드 | 설명 |
| --- | --- | --- | --- |
| Submit | Enter | Button South | 프롬프트 수락 또는 입력 양식 제출과 같은 일반적인 확인 의도입니다. |
| Cancel | Escape | Button East | 프롬프트를 거부하거나 메뉴를 종료하는 등 일반적인 거부 의도입니다. |
| Delete | Delete | Button North | 선택한 저장 슬롯 삭제와 같은 일반적인 삭제 의도입니다. |
| NavigateX | Left <-> Right | D-Pad (X), Left Stick (X) | 연속적으로 저장 슬롯을 선택하는 등 가로 축을 통한 일반 탐색 의도입니다. |
| NavigateY | Up <-> Down | D-Pad (Y), Left Stick (Y) | 열에서 저장 슬롯 선택과 같은 수직 축에 대한 일반적인 탐색 의도입니다. |
| ScrollY | Scroll Wheel (Y) | Right Stick (Y) | 스크롤 백로그와 같은 세로 축에 대한 일반 스크롤 의도입니다. |
| Page |  | Left Trigger <-> Right Trigger | 저장-로드 메뉴에서 페이지 변경과 같은 일반적인 페이지 매기기 의도입니다. |
| Tab |  | Left Bumper <-> Right Bumper | 설정 메뉴의 탭 변경과 같은 일반적인 변경 탭 의도입니다. |
| Continue | Enter, Scroll Wheel (Y+) | Button South | 스크립트 재생을 계속하려면 입력 모드(메시지가 인쇄될 때 활성화됨) 대기를 비활성화합니다. |
| Pause | Backspace | Start | 일시정지 UI를 표시합니다. |
| Skip | Ctrl | Button West | 작업이 활성화된 동안(버튼 누르고 있음) 건너뛰기 모드(빨리 감기)를 사용합니다. |
| ToggleSkip | Tab | Right Stick Press | 건너뛰기 모드를 전환합니다(비활성화된 경우 영구적으로 활성화하거나 그 반대의 경우도 마찬가지). |
| AutoPlay | A | Button East | 입력 대기 모드가 설정된 지연 후 자동으로 비활성화되는 자동 재생 모드를 전환합니다. |
| ToggleUI | Space | Button North | 전체 UI 레이어의 가시성(숨기기/표시)을 전환합니다. |
| ShowBacklog | L | Right Bumper | 백로그 UI 표시 상태를 전환합니다. |
| Rollback | B, Scroll Wheel (Y-) | Left Bumper | 스크립트를 뒤로 되돌립니다. |
| CameraLookX | Mouse X | Right Stick (X) | @look 모드에 있는 동안 카메라를 수평 축 위로 이동합니다. |
| CameraLookY | Mouse Y | Right Stick (Y) | @look 모드에 있는 동안 카메라를 수직 축 위로 이동합니다. |
| ToggleConsole | ` |  | 개발 콘솔로 전환합니다. |

---

## 입력 시스템

Naninovel은 Unity의 [새 입력 시스템](https://blogs.unity3d.com/2019/10/14/introducing-the-new-input-system/)을 지원합니다. 입력 시스템 패키지를 설치하고 활성화하는 방법은 [공식 문서](https://docs.unity3d.com/Packages/com.unity.inputsystem@1.5/manual/Installation.html)를 참조하세요.

패키지가 설치된 후 이벤트 시스템 프리팹을 생성합니다. 하이어라키 창에서 *UI -> Event System*을 사용하여 디폴트 창을 만듭니다. *Input System UI Input Module*이 프리팹에 연결되어 있는지 확인하세요.

디폴트 이벤트 시스템을 생성할 때 Unity는 레거시 입력 모듈 구성 요소를 새 구성 요소로 변환하도록 자동으로 제안합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-input-processing-3.avif)

생성된 이벤트 시스템 프리팹을 Naninovel UI 구성 메뉴의 *Custom Event System* 속성에 할당한 다음 동일한 메뉴에서 *Spawn Input Module*을 비활성화합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-input-processing-2.avif)

입력 시스템 패키지가 설치되면 입력 구성 메뉴에 Input Actions 프로퍼티가 나타납니다. [입력 작업 에셋](https://docs.unity3d.com/Packages/com.unity.inputsystem@1.0/manual/ActionAssets.html?q=input%20actions%20asset)을 프로퍼티에 할당한 다음 ‘Naninovel’ 액션 맵을 만들고 Naninovel의 바인딩 이름과 동일한 이름을 가진 입력 작업을 추가합니다.

내장된 바인딩 이름 목록은 동일한 구성 창의 ‘Control Scheme’ 아래 ‘Bindings’ 목록에서 확인할 수 있습니다.

다음은 입력 작업 구성의 예입니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-input-processing-1.avif)
> **팁**
>
> 기본 이벤트 시스템과 입력 작업 에셋은 *Naninovel/Prefabs/Input* 폴더에 저장됩니다. 자신만의 결과물을 만들 때 레퍼런스로 자유롭게 활용하세요.

적절하게 구성되었다면 입력 작업이 Naninovel의 바인딩을 활성화합니다. 레거시 입력 처리(‘바인딩’ 목록에 설정됨)를 비활성화하려는 경우 입력 구성 메뉴에서 *Process Legacy Bindings* 프로퍼티를 비활성화합니다.

> **주의**
>
> *Process Legacy Bindings*이 활성화된 상태로 유지되면 일부 바인딩이 두 번 트리거될 수 있습니다(새 입력에서 하나, 레거시에서 하나). 각 바인딩이 해당 시스템에서만 처리되는지 확인하거나 옵션을 완전히 비활성화하십시오.

입력 시스템 사용에 대한 자세한 내용은 [공식 매뉴얼](https://docs.unity3d.com/Packages/com.unity.inputsystem@latest)을 참고하세요.

> **예시**
>
> 새로운 입력 시스템을 사용하고 플레이어가 GitHub에서 기본 컨트롤을 변경할 수 있도록 리바인드 UI를 구현하는 방법에 대한 예제 프로젝트를 찾아보세요.

---

## 입력 모드에의 적용

Unity의 새 입력 시스템이 설치되고 활성화되면 모든 내장 UI는 마지막 활성 입력 장치를 기반으로 현재 입력 모드(마우스 및 키보드, 게임패드 또는 터치)에 적용됩니다.

예를 들어 플레이어가 게임과 상호 작용하기 위해 마우스를 사용하고 있지만 어느 시점에서 게임 패드의 버튼을 누르면 UI가 게임 패드 입력 모드로 전환됩니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-a2f38246d7eee8d75d7f3f6660a092ed.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-a2f38246d7eee8d75d7f3f6660a092ed.mp4@main.mp4?_=1)

엔진 초기화 후 활성화된 기본 입력 모드는 대상 플랫폼을 기반으로 입력 관리자에 의해 감지됩니다.

- 콘솔 – 게임패드
- 모바일 – 터치
- 기타 – 마우스 및 키보드

### 마우스와 키보드

이 모드에서는 UI가 모든 기본 [Selectable](https://docs.unity3d.com/Packages/com.unity.ugui@1.0/manual/script-Selectable.html) 개체에 대한 탐색을 비활성화합니다. 이는 마우스로 버튼을 클릭했을 때 버튼이 ‘선택됨’ ​​상태로 전환되는 것을 방지하기 위한 것입니다.

또한 *Button Controls* 오브젝트가 *Custom UI*(또는 파생된 것) 컴포넌트에 할당된 경우 활성화되고 *Controls Legend*는 비활성화됩니다. 이를 통해 마우스 입력 모드에 특정한 버튼(예: ‘닫기’ 버튼)을 유지하고 관련 입력 모드가 활성화된 경우에만 표시되는 범례(예: 게임패드 버튼 라벨)를 제어할 수 있습니다.

### 게임패드

게임패드 모드는 탐색을 유지하므로(마우스 모드에서 전환하면 다시 변경) 플레이어가 dpad를 사용하여 선택 항목을 탐색할 수 있습니다.

할당되면 *Button Controls*이 비활성화되고 *Controls Legend*가 활성화됩니다.

> **팁**
>
> 게임패드 범례 아이콘을 커스터마이징하려면 [Xelu의 무료 컨트롤러 프롬프트](https://thoseawesomeguys.com/prompts/)를 확인하세요.

또한, 게임패드 모드에서 모달 UI가 표시되는 동안 내부에서 선택 가능한 첫 번째 활성 항목에 초점이 맞춰져 이전에 선택한 개체에 초점이 고정되는 것을 방지합니다. 이 동작은 커스텀 UI 또는 파생 구성 요소의 *Focus Object*를 명시적으로 할당하여 변경할 수 있습니다.

이 경우 UI는 포커스 개체를 자동으로 찾으려고 시도하지 않습니다.

### 터치

터치 모드에 있을 때 Naninovel은 기본적으로 관리되는 UI에서 특별한 변경을 수행하지 않습니다. 그러나 *CustomUI* 컴포넌트의 *HandleInputModeChanged* 메서드를 재정의하여 터치 관련 동작을 추가할 수 있습니다.

특정 UI에 대한 입력 모드 적응 기능을 비활성화하려면 *Custom UI*(또는 파생된 것) 컴포넌트의 *Adapt To Input Mode* 옵션을 선택 취소합니다. 이 기능을 전체적으로 비활성화하려면 입력 구성에서 *Detect Input Mode* 옵션을 사용하십시오.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)