---
title: "나니노벨 Unlockable items"
url: https://subculturegamer.com/naninovel-unlockable-items/
published: 2024-12-01
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

※원문 페이지: [(링크)](https://naninovel.com/guide/unlockable-items)

※마지막 수정일: 2024/12/01

---

잠금 해제 기능을 사용하면 잠겨 있거나 잠금 해제된 상태가 지속되는 항목을 관리할 수 있습니다.

플레이어가 특정 조건을 만족했을 때 활성화되거나 언락되는 일부 개체들 – 예를 들면 CG, 무비 갤러리, 업적, 팁, 그 외 다양한 시스템 – 이 이에 해당합니다.

잠금 해제 가능한 각 항목은 문자열 식별자와 불린 값으로 잠금 해제 여부가 표시됩니다.

naninovel 스크립트에서는 *@unlock* 및 *@lock* 명령어를 사용하여 특정 ID로 항목을 각각 잠금 해제하거나 잠글 수 있습니다.

예를 들어,

```
@unlock SecretAchievement
```

위 구문은 *SecretAchievement*를 잠금 해제합니다.

```
@lock SecretAchievement
```

위 구문은 *SecretAchievement*를 다시 잠그게 됩니다.

아이템의 잠금 해제 가능 상태는 전역 범위에 저장되며 로컬 게임 세션에 의존하지 않습니다.

예를 들어 일부 항목을 잠금 해제하면 플레이어가 새 게임을 시작하거나 저장된 다른 게임을 로드할 때 다시 잠겨 있지 않습니다.

실제 [GameObject](https://docs.unity3d.com/Manual/class-GameObject.html)를 잠금 해제 가능한 항목과 바인딩하려면 *UnlockableTrigger* 컴포넌트를 사용하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-unlockable-items-1.avif)

항목의 ID를 *Unlockable Item Id* 필드로 설정하고 항목이 잠금 해제될 때 수행되어야 하는 명령을 바인딩합니다.

예를 들어 위 이미지에서는 SecretAchievement가 잠금 해제될 때 GameObject를 활성화하고 그 반대의 경우도 마찬가지입니다.

C#에서는 *UnlockableManager* [엔진 서비스](https://naninovel.com/guide/engine-services)를 사용하여 잠금 해제 가능한 항목에 액세스할 수 있습니다.

> **예시**
>
> GitHub의 [UI 예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/ui)에서 C# 스크립팅 없이 음악 갤러리를 구현하기 위해 잠금 해제 가능한 시스템을 사용하는 예제를 찾아보세요. 다른 유형의 잠금 해제 가능한 갤러리(영상, 업적 등)도 비슷한 방식으로 구현할 수 있습니다.

---

## 잠금 해제 가능한 리소스

잠금 해제 가능 구성 메뉴(*Naninovel – Configuration – Unlockables*)에서 잠금 해제 가능 기능과 함께 사용할 임의 에셋을 저장할 수 있는 리소스 관리자를 찾을 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-unlockable-items-2.avif)

잠금 해제 가능한 리소스는 [CG 갤러리](https://naninovel.com/guide/unlockable-items#cg-gallery)와 같은 내장 잠금 해제 시스템에서 사용됩니다. 자신만의 커스텀 시스템을 위해 관리자를 활용할 수도 있습니다.

---

## CG 갤러리

CG 갤러리 기능을 사용하면 게임 전반에 걸쳐 잠금을 해제한 다음 타이틀 메뉴에서 액세스할 수 있는 *ICGGalleryUI* UI를 통해 탐색할 수 있는 텍스처 리소스(이미지)를 지정할 수 있습니다.

기본적으로 [잠금 해제 가능한 리소스 관리자](https://naninovel.com/guide/unlockable-items#unlockable-resources)를 통해 추가된 CG 접두사가 있는 모든 잠금 해제 가능한 텍스처 리소스와 동일한 접두사가 있는 *MainBackground* 액터의 [배경](https://naninovel.com/guide/backgrounds) 스프라이트 리소스는 잠금 해제 가능한 CG 항목으로 간주됩니다.

잠금 해제 가능한 CG 항목을 갤러리에 추가하려면 경로 앞에 *CG*를 추가하여 기존 기본 배경 리소스 중 하나를 사용할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-unlockable-items-3.avif)

— 또는 *Naninovel – Resources – Unlockables*로 액세스할 수 있는 잠금 해제 가능한 리소스 관리자를 사용하여 ‘독립형(standalone)’ 텍스처를 추가합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-unlockable-items-4.avif)

여러 CG를 하나의 갤러리 슬롯(예: 단일 씬의 배리에이션 그룹)으로 그룹화하려면 잠금 해제 가능한 ID에 \_ 뒤에 숫자를 추가하세요.

예를 들어 다음 ID를 가진 CG를 추가하는 경우:

- `CG/EpicScene_1`
- `CG/EpicScene_2`
- `CG/EpicScene_3`

— 모두 단일 CG 슬롯 아래에 그룹화되며 플레이어가 화면을 클릭하면 크로스페이드 효과와 함께 순서대로 표시됩니다.

> **메모**
>
> UI 그리드의 CG 슬롯은 왼쪽에서 오른쪽, 위에서 아래로 정렬되며 잠금 해제 가능한 경로 이름에 따라 정렬됩니다. 리소스 편집기 메뉴의 위치는 무시됩니다. 특정 순서로 슬롯을 정렬하려는 경우 그에 따라 리소스 이름을 지정합니다. 예:
>
> - `CG/01`
> - `CG/02_1`
> - `CG/02_2`
> - …
> - `CG/35`
> - `CG/36`

CG 항목을 잠금 해제하고 잠그려면 [@unlock](https://naninovel.com/api/#unlock) 및 [@lock](https://naninovel.com/api/#lock) 명령을 각각 사용하십시오.

예를 들어 위 그림에 추가된 *CG/Map* 항목을 잠금 해제하려면 다음 스크립트 명령을 사용하십시오.

```
@unlock CG/Map
```

CG 항목을 추가하기 위해 잠금 해제 가능 리소스와 배경 리소스를 모두 사용하는 경우 잠금 해제 가능 항목 관리자에 지정된 리소스가 CG 갤러리에 먼저 표시됩니다.

CG 갤러리를 나타내는 UI 프리팹의 루트에 연결된 CG 갤러리 패널 스크립트의 CG 소스 속성을 사용하여 사용 가능한 CG 리소스를 검색하는 실제 소스뿐만 아니라 이 동작을 변경할 수 있습니다(*Naninovel/Prefabs/DefaultUI/ICGGalleryUI.CGGalleryPanel*에 저장된 내장 구현).

![](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-unlockable-items-5.avif)

잠금 해제 상태에 관계없이 소스에 하나 이상의 CG 항목이 추가되면 *CG GALLERY* 버튼이 제목 메뉴에 나타나 CG 갤러리 브라우저에 액세스할 수 있습니다.

[UI 커스텀 기능](https://naninovel.com/guide/user-interface#ui-customization)을 사용하여 내장된 *ICGGalleryUI* 구현을 수정하거나 완전히 교체할 수 있습니다.

---

## 팁

잠금 해제 가능한 팁 시스템을 사용하면 로컬라이즈 가능한 관리 텍스트 문서를 사용하여 텍스트 레코드 세트를 지정할 수 있습니다.

그런 다음 게임 전반에 걸쳐 기록을 잠금 해제하고 타이틀 메뉴 및 텍스트 프린터 제어판에서 액세스할 수 있는 *ITipsUI* UI를 통해 검색할 수 있습니다.

이 시스템은 게임 내 용어/사전 또는 업적 달성 기능을 구축하는 데 사용할 수 있습니다.

> **메모**
>
> 위의 비디오는 최신 Naninovel 버전의 팁에 대한 기본값이 아닌 인라인 관리 텍스트 문서 형식을 보여줍니다. 현재 기본(여러 줄) 형식과 인라인으로 전환하는 방법은 아래를 참조하세요.

사용 가능한 팁을 정의하려면 [관리형 텍스트](https://naninovel.com/guide/managed-text) 리소스 디렉터리(기본적으로 *Resources/Naninovel/Text*) 내에 *Tips.txt* 텍스트 문서를 만듭니다. 형식은 스크립트 로컬라이즈 문서(멀티라인)와 유사합니다.

*#*으로 시작하는 라인은 팁 ID(키)를 저장합니다. 아래 라인은 |으로 구분된 제목(필수), 카테고리 및 설명(선택 사항)을 포함할 수 있는 팁 레코드 값에 해당합니다.

예:

```
# Tip1ID
Tip 1 Title | Tip 1 Category | Tip 1 Description
# Tip2ID
Tip 2 Title || Tip 2 Description
# Tip3ID
Tip 3 Title
# Tip4ID
Tip 4 Title | Tip 4 Category |
```

팁의 길이가 너무 길면 가독성을 위해 여러 줄로 나눌 수 있습니다.

```
# Tip1
Title | Category |
Long description line 1.<br>
Long description line 2.<br>

# Tip2
Title | Category |
Long description line 1.<br>
...
```

인라인 형식을 선호하는 경우 Managed text 구성의 *Multiline Categories* 목록에서 *Tips*을 제거하십시오. 그러면 다른 관리되는 텍스트 문서와 유사하게 팁을 작성할 수 있습니다.

```
Tip1ID: Title
Tip2ID: Title | Category | Description
Tip3ID: Title || Description
```

<br> 태그 외에도 선택한 텍스트 렌더링 시스템에서 지원하는 다른 서식 있는 텍스트 태그를 사용할 수 있습니다(TMPro는 내장된 팁 UI에서 사용됨).

Tips.txt 관리형 텍스트 문서에 하나 이상의 팁 레코드가 있는 경우 ‘TIPS’ 버튼이 메인 메뉴와 제어판에 나타나 팁 브라우저로 연결됩니다.

팁 레코드를 잠금 해제하려면 @unlock 및 @lock을 사용하여 naninovel 스크립트에서 팁 ID(항상 Tips/ 접두사가 앞에 와야 함) 뒤에 레코드를 다시 잠급니다. 예를 들어 *Tip1ID* 팁 레코드를 잠금 해제하려면 다음을 사용하세요.

```
@unlock Tips/Tip1ID
```

### 출력기에서의 팁

[TMPro 출력기](https://naninovel.com/guide/text-printers#textmesh-pro)를 통해 관련 텍스트가 인쇄되면 팁을 자동으로 잠금 해제할 수 있습니다. 또한 플레이어가 해당 텍스트를 클릭하면 관련 팁 레코드가 선택된 *ITipsUI* UI가 자동으로 표시됩니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-3c0d761576c351066022be32b8595e6d.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-3c0d761576c351066022be32b8595e6d.mp4@main.mp4?_=1)

인쇄된 텍스트를 팁과 연결하려면 팁 태그를 사용하세요. 예:

```
Lorem ipsum <tip="VN">visual novel</tip> pharetra nec.
```

— ‘VN’ ID가 있는 팁 레코드가 있으면 관련 ‘비주얼 노벨’ 텍스트(TMPro 프린터로 인쇄할 때)에 밑줄이 그어지고 팁 레코드가 잠금 해제되며 플레이어가 텍스트를 클릭하면 팁 UI가 열리고 관련 항목이 표시됩니다.

출력기 관련 팁 처리 동작을 변경하고 싶다면(예를 들어 관련 텍스트의 서식을 수정하거나 팁을 클릭할 때 커스텀 동작 추가하고 싶다면) 모든 팁의 텍스트 게임 오브젝트에 연결된 *Revealable TMPro Text* 컴포넌트에 있는 ‘Tips’ 섹션 아래의 속성을 사용하세요.

커스텀 프린터를 생성하여 조정하는 방법에 대한 [가이드](https://naninovel.com/guide/text-printers#adding-custom-printers)를 참조하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-unlockable-items-6.avif)

*On Tip Clicked* 이벤트에 커스텀 핸들러가 할당되면 기본 동작(팁 UI 표시)이 비활성화됩니다.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)