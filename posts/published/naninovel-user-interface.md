---
title: "[26년 2월] 나니노벨 GUI(Graphical User Interface)"
url: https://subculturegamer.com/naninovel-user-interface/
published: 2024-10-06
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 User Interface](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-Choices-2-1024x538.png)

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’ GUI 페이지의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/gui)

---

Naninovel에는 타이틀(메인) 메뉴, 게임 설정, 저장 로드 메뉴, 백로그 패널, CG 갤러리, 팁 등 다양한 UI가 내장되어 있습니다.

빌트인 되어있는 각각의 UI는 비활성화시키거나 커스터마이징할 수 있습니다. 자세한 내용은 [UI 사용자 정의 가이드](https://naninovel.com/guide/user-interface#ui-customization)를 참조하세요.

---

## 반응형 UI 레이아웃

모든 빌트인 UI는 반응형 레이아웃으로 구현되어 있습니다. 반응형 레이아웃은 화면 해상도에 관계없이 모든 플랫폼에서 UI를 계속 사용할 수 있게 합니다.

[](https://naninovel.com/imgit/encoded/i.gyazo.com-b6bddf8a0c6f2ba68dcdc1bc65db0c09.mp4@main.mp4)

UI가 화면 해상도 및/또는 종횡비에 적응하는 방식을 변경하거나 사용자 정의 UI를 구축하고 적응형 레이아웃을 구성하려는 경우 사용 가능한 옵션에 대한 uGUI의 Unity 가이드 및 튜토리얼을 참조하세요.

- 예: [다중 해상도에서의 UI 디자인에 관한 가이드](https://docs.unity3d.com/Packages/com.unity.ugui@1.0/manual/HOWTO-UIMultiResolution.html)

---

## UI 켜기/끄기

UI 켜기/끄기(토글링) 기능으로 게임 내 UI를 전체적으로 숨기거나 표시할 수 있습니다.

[](https://naninovel.com/imgit/encoded/i.gyazo.com-e267c4ab3654efbfaf611011502de79f.mp4@main.mp4)

*ToggleUI* 입력(스탠드얼론 모듈에서는 보통 ‘*space*‘ 키)을 활성화하거나 제어판의 *HIDE* 버튼을 사용하여 UI를 숨기거나 표시합니다.

UI가 숨겨져 있는 경우 *Continue* 버튼을 입력하거나 화면을 클릭(터치)하면 UI 숨김이 해제됩니다.

---

## UI 커스터마이징

UI 커스터마이징으로 사용하면 커스텀 UI를 추가하고 제목 메뉴, 설정 메뉴, 백로그와 같은 빌트인 UI 컴포넌트를 수정하거나 완전히 교체할 수 있습니다.

텍스트 출력기와 선택지 처리기는 액터 인터페이스를 통해 구현되며 다른 방식으로 커스터마이징됩니다. 자세한 내용은 해당 문서([텍스트 출력기](https://subculturegamer.com/%eb%82%98%eb%8b%88%eb%85%b8%eb%b2%a8-text-printers/), [선택지 처리기](https://naninovel.com/guide/choices))를 참조하세요.

> **주의**
>
> 커스텀 UI를 만들거나 기존 UI를 수정하기 전에 먼저 [Unity의 UI 시스템(uGUI)](https://docs.unity3d.com/Packages/com.unity.ugui@latest)에 대해 잘 알고 있어야 합니다. 하단에는 UI 커스터마이징 가이드를 위한 비디오 튜토리얼과 예제 프로젝트가 있지만, Unity의 내장 도구에 대한 추가 지침이나 지원은 제공해드릴 수 없습니다. 자세한 내용은 [지원 페이지](https://naninovel.com/support/#unity-support)를 참조하세요.

커스텀 UI를 추가하거나 내장된 UI를 수정(비활성화)하려면 *Naninovel -> Resources -> UI* 에디터 메뉴로 액세스할 수 있는 UI 리소스 관리자를 사용하세요.

![UI 커스터마이징](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-user-interface-07.avif)

엔진이 초기화되면 리소스 관리자에 할당된 모든 UI 프리팹을 인스턴스화합니다.

> **메모**
>
> 일부 기능(예: UI 켜기/끄기 등)은 *Screen Space – Camera* 모드에서 UI를 렌더링이 필요합니다.
>
> 최상의 호환성을 위해 커스텀 UI에 올바른 렌더링 모드가 선택되어 있고 렌더링 카메라 필드가 비어 있는지(그래야 UI 매니저가 카메라를 자동으로 할당할 수 있습니다.) 확인하세요.
>
> ![UI 커스터마이징 2](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-user-interface-06.avif)

리소스 관리자에 나열된 UI를 표시하거나 숨기려면 각각 @showUI 및 @hideUI 명령을 사용하세요.

### 커스텀 UI 추가하기

새 커스텀 UI를 추가하려면 Create -> Naninovel -> Custom UI 에셋 컨텍스트 메뉴에서 프리팹을 생성하고 이를 UI 리소스 목록에 추가합니다. 이후 유니티 엔진 재실행 시 다른 UI 프리팹과 함께 인스턴스화됩니다.

아래의 비디오 튜토리얼에서는 특별한 표시 및 숨기기 애니메이션을 사용하여 커스텀 캘린더 UI를 추가하는 방법을 보여줍니다. 캘린더는 사용자 정의 변수를 기반으로 날짜를 표시하며, 이는 naninovel 스크립트로 변경 가능하고 게임과 함께 저장됩니다. 캘린더는 변수가 업데이트되면 자동으로 업데이트됩니다. 이 모든 것은 C# 스크립팅 없이도 가능합니다.

> **예시**
>
> 위 영상 튜토리얼에 나온 Unity 프로젝트는 [GitHub](https://github.com/naninovel/samples/tree/main/unity/ui)에서 보실 수 있습니다. 또한 스크롤 보기 및 웹 링크가 있는 크레딧 스크린 추가, 파티클 이펙트가 있는 선택 버튼, 텍스트 출력기에서 이모티콘 사용, 대화창 출력기에서 타임스탬프 추가하는 방법 등에 대한 예제도 포함되어 있습니다.

> **예시**
>
> 그리고, 커스텀 인벤토리 UI를 그리드 레이아웃으로 추가하거나 페이지 매기기, 드래그앤드롭 창 등의 예시는 [GitHub에서의 인벤토리 예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/inventory)로 확인 가능합니다. 특별히 UI 관련 스크립트는 [Runtime/UI](https://github.com/naninovel/samples/tree/main/unity/inventory/Assets/NaninovelInventory/Runtime/UI)에 저장되고 프리팹은 [Prefabs](https://github.com/naninovel/samples/tree/main/unity/inventory/Assets/NaninovelInventory/Prefabs) 디렉터리에 저장됩니다.

상황에 맞는 메뉴로 새 커스텀 UI 프리팹을 생성하면 해당 프리팹에는 루트 오브젝트에 연결된 커스텀 UI 컴포넌트를 가집니다. 이 컴포넌트(또는 컴포넌트가 IManagedUI 인터페이스를 구현하는 경우에도)는 엔진에서 프리팹을 UI로 허용하도록 만드는 데 꼭 필요합니다.

![UI 커스터마이징 3](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-user-interface-05.avif)

*Disable Interaction* 프로퍼티는 Visibility에 관계없이 UI와의 상호 작용을 영구적으로 비활성화할 수 있습니다. 동일 게임 오브젝트에 *Canvas Group* 컴포넌트가 필요합니다.

*Visible On Awake*가 활성화되면 UI가 인스턴스화될 때(엔진이 초기화된 직후) UI가 표시되고 그 반대의 경우도 마찬가지입니다.

*Control Opacity*가 활성화되고 *Canvas Group* 컴포넌트가 동일 게임 오브젝트에 연결되면 *Canvas Group* 컴포넌트의 *Alpha* 프로퍼티가 UI 요소의 현재 Visibility 상태와 동기화되어 변경됩니다.

*Fade Time*은 불투명 페이드 애니메이션의 시간(초 단위)을 제어합니다.

커스텀 자체 효과로 UI 요소를 만들고 Visibility 상태를 조정하려는 경우(예: 불투명도를 페이딩하는 대신 슬라이드 애니메이션을 사용하는 등) *Control Opacity* 프로퍼티를 비활성화하고 *On Show* 및 *On Hide* Unity 이벤트로 가시성 변경에 대응합니다.

게임 패드나 키보드 내비게이션 UI를 지원하려는 경우, 버튼 등의 인터랙티브 컴포넌트가 있는 게임 오브젝트를 *Focus Object* 프로퍼티에 할당하세요. 이 오브젝트는 UI가 키보드나 게임패드 등에서 상호작용 가능한 오브젝트에 자동으로 할당됩니다. 내비게이션 동작 설정 가이드의 자세한 내용은 UI 탐색에 대한 [Unity 가이드](https://docs.unity3d.com/Packages/com.unity.ugui@1.0/manual/script-SelectableNavigation.html)를 참조하세요.

*Focus Object*가 할당되면 *Focus Mode* 프로퍼티가 언제 오브젝트에 포커싱될 지 선택할 수 있습니다. Visibility 모드는 UI가 표시된 직후에 객체에 초점을 맞추고 Navigation은 플레이어가 게임 패드(왼쪽 스틱 또는 D 패드)에서 탐색 키를 활성화할 때까지 초점을 연기합니다. 또는 키보드(화살표 키).

*On Show* 및 *On Hide* Unity 이벤트로 커스텀 핸들러를 UI Visibility 변화에 대응시킬 수 있습니다. 예를 들어, *Animator* 트리거로 특정 커스텀 애니메이션을 실행하거나 종료할 때 UI Visibility에 대응 가능합니다.

*Hide On Load*을 활성화하면 엔진 로드 작업 시 UI가 자동으로 숨겨집니다. 이는 일반적으로 다른 naninovel 스크립트를 로드하거나 타이틀 메뉴로 나갈 때 발생합니다.

*Save Visibility State*을 활성화하면 UI의 가시성 상태가 지속되므로 플레이어가 저장된 게임을 로드할 때 UI는 게임이 저장되었을 때와 동일한 상태(표시 또는 숨김)가 됩니다.

*Block Input When Visible*은 UI가 표시될 때 [입력 처리](https://naninovel.com/guide/input-processing)를 비활성화할 수 있습니다. 플레이어가 UI와 상호작용하는 동안 다양한 단축키(UI 숨기기, 계속 읽기 등)를 사용하는 것을 방지하는 데 유용합니다.

`Allowed Samplers`를 사용하면 입력 차단 시에도 특정 예외를 추가할 수 있습니다. 예를 들어, 플레이어가 다른 입력을 하지 못하게 하면서 *ToggleUI* 입력 이름을 목록에 추가하면 UI를 전환할 수 있습니다.

*Modal UI*를 활성화하면 UI가 표시되는 동안 다른 모든 UI가 상호 작용을 무시합니다.

*Block Input When Visible*과 유사하지만 직접 입력하는 처리 대신에 이벤트 기반 인터랙션(마우스 클릭, 터치, UI 탐색)에 영향을 미칩니다.

커스텀 UI를 생성할 때 기본적으로 여러 가지 다른 컴포넌트도 추가됩니다.

- Canvas Group은 불투명도(Fade Duration으로 제어)를 변경하여 UI를 숨길 수 있으며 필요한 경우 UI가 사용자 인터랙션을 무시하게 할 수 있습니다.
- Canvas Scaler는 현재 디스플레이 해상도에 맞게 레이아웃의 크기를 자동으로 조정합니다.
- Graphic Raycaster를 사용하면 플레이어가 UI Canvas 내부 버튼이나 기타 인터랙션 가능 요소와 인터랙션할 수 있습니다.

위의 컴포넌트를 원하는 대로 자유롭게 수정하거나 제거할 수 있습니다.

### 폰트 변경하기

[게임 설정](https://naninovel.com/guide/game-settings)에 의해 폰트나 텍스트 크기 변경에 대응할 텍스트 요소를 지정하려면 *Custom UI*의 *Font Change Configuration*과 관련 컴포넌트를 사용하세요.

![폰트 변경하기](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-user-interface-04.avif)

컴포넌트의 각 요소에는 다음과 같은 프로퍼티가 있습니다.

| 프로퍼티 | 설명 |
| --- | --- |
| Object | 폰트 변경에 영향받는 텍스트 컴포넌트가 있는 게임 오브젝트입니다. |
| Include Children | 게임 오브젝트의 하위 요소에 영향을 미칠지에 관한 여부입니다. 비활성화 시 지정된 하위 개체의 텍스트 컴포넌트만 영향을 받습니다. |
| Allow Font Change | 텍스트 컴포넌트가 폰트 변경을 허용할지 여부입니다. |
| Allow Font Size Change | 텍스트 컴포넌트가 폰트 사이즈 변경을 허용할지 여부입니다. |
| Font Sizes | 텍스트 컴포넌트에 적용할 실제 폰트 사이즈입니다. 리스트의 각 요소는 폰트 사이즈 크기 드롭다운 목록 인덱스에 해당합니다. – Small: 0 – Default: 1 – Large: 2 – Extra Large: 3 (SettingsUI를 통해 변경 가능).  폰트 사이즈 디폴트는 무시되고 프리팹에 최초 설정된 폰트 사이즈가 대신 사용됩니다. |

Font Sizes 에셋은 *Create -> Naninovel -> Font Sizes* 에셋 컨텍스트 메뉴에서 생성할 수 있습니다. 에셋을 사용하여 여러 UI에서 공통 폰트 사이즈를 공유합니다.

게임 설정 메뉴에서 사용할 수 있는 특정 텍스트 폰트 옵션은 UI 구성 메뉴에서 설정됩니다.

![폰트 변경하기 2](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-user-interface-03.avif)

폰트 리소스는 TMPro 폰트 에셋의 [리소스 경로](https://naninovel.com/guide/resource-providers)를 지정해야 합니다.

기본적으로 Naninovel은 어드레서블 에셋을 사용하고 프로젝트 리소스 공급자에서 폰트 에셋을 찾습니다. (Font Loader로 동작 변경도 가능합니다.) 디폴트 세팅으로 폰트 에셋을 노출시키는 가장 간단한 방법은 폰트를 *Resources/Naninovel/Fonts* 폴더에 배치하는 것입니다. 이 경우 폰트 에셋명을 폰트 리소스 경로로 사용할 수 있습니다.

폰트를 만들고 구성하는 방법에 대한 자세한 내용은 Unity의 TextMesh Pro 설명서를 참조하세요.

커스텀 UI 오브젝트 외의 폰트를 변경하려면(예: 선택지 처리기 버튼 프리팹)에서 글꼴을 변경하려면 *Font Changer* 컴포넌트를 사용하세요. 동일한 폰트 구성 옵션이 있으며 모든 게임 오브젝트에 적용할 수 있습니다.

### 내장 UI 비활성화하기

내장 UI를 비활성화하려면 UI 리소스 목록에서 해당 레코드를 제거하면 엔진 초기화 시 프리팹이 인스턴스화되지 않습니다.

### 내장 UI 커스터마이징하기

기본 내장된 UI 프리팹을 수정하려는 경우, 프리팹 파일은 *Naninovel/Prefabs/DefaultUI* 패키지 폴더에서 찾을 수 있습니다.

내장된 프리팹을 직접 편집하는 것은 ‘가능하기는 하나’ 패키지 업데이트 시 문제가 발생할 가능성이 있어 권장하지 않습니다. 대신, *Create -> Naninovel -> Default UI -> …* 에셋 컨텍스트 메뉴를 이용하거나 직접 프리팹 파일을 복사하는 식으로, 내장 프리팹을 패키지 폴더 바깥으로 복제합니다. 그 다음 생성하거나 수정된 프리팹을 UI 리소스 관리자 기존 레코드 (오브젝트 필드) 에 할당합니다.

다음 비디오 튜토리얼에서는 내장된 타이틀(메인) 메뉴를 재정의하는 방법을 안내합니다. 또한 타이틀 메뉴 진입 시 타이틀 스크립트를 사용하여 배경화면과 특수 효과를 추가하는 방법도 보여줍니다. C# 스크립팅을 하지 않아도 이러한 기능을 활용할 수 있습니다.

> **예시**
>
> 위 영상 튜토리얼에 나온 Unity 프로젝트는 [GitHub](https://github.com/naninovel/samples/tree/main/unity/ui)에서 보실 수 있습니다.

처음부터 새 프리팹을 생성하는 경우에는 UI 인터페이스를 구성하는 컴포넌트를 직접 연결해야 합니다. 이 컴포넌트는 프리팹 루트 오브젝트에 연결되어 있어야 합니다.

모든 UI 인터페이스는 Naninovel.UI 네임스페이스에 저장됩니다.

| 인터페이스 | 해당 UI |
| --- | --- |
| IBacklogUI | 출력 기록을 표시하는 UI. |
| ILoadingUI | 게임 로딩 중에 표시되는 패널. |
| IMovieUI | 무비를 호스팅하는 UI. |
| ISaveLoadUI | 게임 저장 및 불러오기 패널. |
| ISceneTransitionUI | 씬 전환을 처리하는 UI (@startTrans 및 @finishTrans 명령어 사용). |
| ISettingsUI | 게임 설정을 변경하는 패널. |
| ITitleUI | 게임 타이틀 관련 메뉴. |
| IExternalScriptsUI | 외부 스크립트 브라우저 UI (커뮤니티 모딩 기능). |
| IVariableInputUI | 임의의 텍스트를 커스텀 상태 변수에 할당하는 입력 양식 (@input 명령어 사용). |
| IConfirmationUI | 중요 명령어를 확인할 때 사용하는 UI 패널 (예: 타이틀 메뉴로 나가기 또는 저장 슬롯 삭제 시). |
| ICGGalleryUI | 잠금 해제 가능한 CG 갤러리 항목 브라우저. |
| ITipsUI | 잠금 해제 가능한 팁 브라우저. |
| IRollbackUI | 상태 롤백 기능을 위한 표시기. |
| IContinueInputUI | UI 스택의 맨 아래에 위치하며 클릭하거나 터치 시 계속 입력 트리거를 받아오는 풀스크린 투명 UI 레이어. |
| IToastUI | 자동으로 숨겨지는 팝업 알림(“toast”)을 위한 범용 UI; 나니노벨 스크립트에서 @toast 명령어를 사용하여 호출 가능. |

UI가 visibility(awake 상태에서 보임, 시간 페이드)이나 옵션들의 인터랙션을 위해(또는 비활성화하기 위해)서는 동일 오브젝트에 *Canvas Group* 컴포넌트를 추가하세요.

당신이 C# 스크립팅에 익숙하고, UI의 기본 로직을 재정의하기를 희망한다면 새 컴포넌트를 만들고 , IManagedUI 인터페이스를 구현하고(모든 인터페이스 요구 사항을 충족하려면 CustomUI에서 구성 요소를 상속받아야 함) 당신이 생성한 커스텀 컴포넌트를 기존 것에 대신해서 연결하세요.

내장 UI의 참조 구현을 보려면 *Naninovel/Runtime/UI* 폴더를 확인하세요.

다음은 커스텀 UI 컴포넌트의 최소 구현 예입니다.

```
using Naninovel.UI;

public class MyCustomUI : CustomUI
{

}
```

---

### Unity 이벤트에서 스크립트 재생

커스텀 UI를 생성할 때 일부 이벤트(예: [버튼 클릭](https://docs.unity3d.com/Manual/script-Button.html))에 대한 반응으로 일부 명령을 실행하거나 특정 naninovel 스크립트 재생을 시작할 수 있습니다.

게임 오브젝트에 Play Script 컴포넌트를 추가하고 기존 naninovel 스크립트를 선택하거나 텍스트 영역 필드 바로 안에 명령어를 기입합니다. 그런 다음 다른 구성 요소의 [Unity 이벤트](https://docs.unity3d.com/Manual/UnityEvents.html)를 라우팅하여 *Play Script* 구성 요소에서 *Play()* 메서드를 호출합니다. 플레이 모드에서 이벤트가 트리거되면 스크립트가 실행됩니다. 아래 예에서는 버튼을 클릭할 때 사용자 정의 UI를 숨깁니다.

![Unity 이벤트에서 스크립트 재생](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-user-interface-02.avif)

또한 스크립트 텍스트에서 {arg} 표현식을 사용하여 Unity 이벤트 인수를 참조할 수 있습니다. 지원되는 인수 타입은 문자열(string), 정수형(integer), 부동 소수점(float), 불리언(boolean)입니다.

아래 예시는 boolean Unity 이벤트가 true일 때 카메라 흔들림과 사운드 이펙트를 재생하고, false일 때 배경 음악을 재생하는 방법을 보여줍니다.

![Unity 이벤트에서 스크립트 재생 2](https://subculturegamer.com/wp-content/uploads/2024/10/naninovel-user-interface-01.avif)
> **주의**
>
> 조건부 블록 명령어(if, else, elseif, endif)는 스크립트 텍스트에서 지원되지 않습니다.

드롭다운 리스트에서 기존 나니노벨 스크립트를 선택하면, 스크립트 텍스트 필드는 무시되고 선택된 나니노벨 스크립트가 현재 실행 중인 스크립트를 대신하여 실행됩니다. 현재 실행 중인 스크립트를 중단하지 않고 명령어를 추가적으로 실행하려면 스크립트 텍스트 필드를 사용하십시오.

> **예시**
>
> UI 예제 프로젝트에서 Play Script 컴포넌트를 사용하는 예시를 찾아보세요. 이 컴포넌트는 구성 요소는 ‘Prefabs/Calendar’ 사용자 정의 UI 프리팹 내에 배치된 ‘CloseButton’ 게임 개체에 사용됩니다.

---

### UI 툴킷

Unity의 새로운 UI 제작 솔루션인 [UI Toolkit](https://docs.unity3d.com/Packages/com.unity.ui@latest)은 기본적으로 지원되지 않지만, IManagedUI 인터페이스를 구현하는 어댑터와 함께 사용할 수 있습니다. GitHub의 [UI Toolkit 예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/ui-toolkit)에서 해당 어댑터 예시를 찾을 수 있습니다.

> **주의**
>
> UI Toolkit은 아직 초기 개발 중이며, 기본 UI 솔루션(uGUI)과 비교했을 때 많은 기능이 부족합니다. 숙련된 개발자가 아니거나 관련 문제를 해결할 준비가 되어 있지 않다면 사용하지 마십시오. UI Toolkit을 나니노벨과 함께 사용하는 것에 대한 지원이나 가이드를 제공할 수 없습니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)