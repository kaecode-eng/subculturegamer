---
title: "나니노벨 Getting Started"
url: https://subculturegamer.com/naninovel-getting-started/
published: 2024-08-18
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Getting Started 표지](https://subculturegamer.com/wp-content/uploads/2024/08/나니노벨-getting-started.png)

나니노벨 Getting Started

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/getting-started)

---

### 사전 준비

나니노벨은 유니티 게임 엔진 기능을 확장해주는 기능을 담당합니다.

이 페이지를 진행하기에 앞서 적어도 기초 배우기 단계를 거치시기를 권장합니다.

나니노벨을 별도의 게임플레이(예: RPG 등)와 함께 사용하기 위해 쓰시는 게 아니라면, 유니티 엔진의 씬과 연관된 정보는 넘어가셔도 좋습니다.

---

### 핵심 개념

나니노벨을 본격적으로 시작하기에 앞서, 몇 가지 핵심 개념을 짚어보겠습니다.

‘액터(Actor)’는 이 가이드에서 지속적으로 접하게 될 필수 개념입니다. 액터는 식별자(Id), 외형, 공간에서의 위치(씬)과 그 외 매개변수를 설명하는 개체입니다.

액터는 추상적 개체(abstract entity)입니다. 직접 존재할 수는 없고, 각 액터 타입에 따라 특화된 양식의 맞춤형 추가 매개변수로서 기능합니다.

| 액터 타입(Actor Type) | 추가 매개 변수 | 묘사 |
| --- | --- | --- |
| 캐릭터 | 시선을 바라보는 방향 | 씬에 있는 캐릭터를 나타냅니다. |
| [배경](https://naninovel.com/guide/backgrounds) | 없음 | 씬의 배경을 나타냅니다. 기본적으로 캐릭터 액터 뒤에 배치됩니다. |
| [텍스트](https://naninovel.com/guide/text-printers) 출력기 | 텍스트, 캐릭터 Id, 진행 상황 표시 | 시간이 지남에 따라 텍스트 메시지를 점진적으로 표시(prints)합니다. |
| [선택지 처리기](https://naninovel.com/guide/choices) | 선택지 | 플레이어가 선택지 중 하나를 고를 수 있습니다. |

배경 위에 캐릭터가 있는 전형적인 비주얼 노벨 설정을 생각해 보세요.

나니노벨 용어로는 다음과 같이 표현됩니다.

[<https://naninovel.com/assets/img/docs/actor-concept.mp4>](https://naninovel.com/assets/img/docs/actor-concept.mp4?_=1)

이제 “코하쿠(Kohaku;영상에 있는 캐릭터 이름)”가 행복해 보이게 하고 싶다고 가정해 보겠습니다.

해당 캐릭터는 각각 다른 감정을 묘사하는 여러 텍스처(이미지)가 있습니다. 나니노벨에서는 이러한 텍스터를 배우의 *외형(Appearances)*이라고 부릅니다. 코하쿠를 행복하게 만들어 주려면, 캐릭터 액터 외형을 변경해야 합니다. 마찬가지로 “MainBackground”가 다른 것을 표시하도록 하려면 해당 배경 액터의 외형을 변경해야 합니다.

액터와 그들의 매개변수는 [나니노벨 스크립트](https://naninovel.com/guide/naninovel-scripts)에 지정된 명령을 통해 제어(지시)됩니다.

널리 사용되는 또 다른 개념은 [UI(사용자 인터페이스](https://naninovel.com/guide/user-interface))입니다. UI는 플레이어가 액터나 게임의 나머지 부분과 상호작용하기 위해 쓰입니다. 여기에는 다양한 메뉴(제목, 저장-로드, 설정 등)와 제어판(자동 읽기 모드 전환, 텍스트 건너뛰기 등)이 포함됩니다. UI 요소는 기본적으로 액터보다 앞(플레이어 방향)에 배치됩니다.

텍스트 출력기와 선택지 처리기는 액터와 UI 요소 양쪽 다 해당합니다. 이는 액터로서의 품질을 공유하고 naninovel 스크립트를 통해 제어할 수 있으면서, 플레이어가 게임과 상호작용하는 데 사용된다는 것을 의미합니다.

프로그래밍에 익숙하다면, [엔진 아키텍처](https://naninovel.com/guide/engine-architecture)를 살펴보고 소프트웨어 관점에서 어떻게 설계되었는지 파악해 보세요.

---

### 새 Unity 프로젝트 만들기[​](https://naninovel.com/guide/getting-started#create-new-unity-project)

핵심 개념을 읽으셨다고 가정하고 초기 설정을 시작해보겠습니다. 가장 먼저 필요한 것은 Unity 프로젝트입니다. 계정을 만드는 방법은 Unity 설명서를 참조하세요.

프로젝트를 만들 때 에디터를 2D Templet으로 설정한다면 이미지를 추가할 때마다 이미지가 스프라이트(sprite) 에셋을 추가되게 됩니다. 이는 수동으로 임포트(import) 설정을 변경해줄 필요가 없다는 뜻입니다. 물론 나중에 [프로젝트 설정](https://docs.unity3d.com/Manual/2DAnd3DModeSettings.html)에서 에디터 동작 모드를 변경할 수 있습니다.

새 프로젝트를 생성하면 Unity는 내부에 “메인 카메라(Main Camera)”와 “디렉셔널 라이트(직사광선)”라는 두 개의 게임 오브젝트가 있는 샘플 씬을 자동으로 추가합니다. Naninovel은 씬과 완전히 독립적이므로 불필요한 성능 낭비를 방지하고자 씬에서 두 개체를 제거할 수 있습니다. 샘플 씬 자체를 제거할 수도 있지만, 일부 에디터 기능이 제대로 작동하려면 프로젝트에 씬이 하나 이상 있는 것이 좋습니다.

> #### 팁
>
> ![나니노벨 Getting Started - 새 프로젝트 만들기](https://subculturegamer.com/wp-content/uploads/2024/08/image-54.png)
>
> Reload Domain과 Reload Scene 옵션을 끄면, 플레이 모드 진입이 더 빨라질 수 있습니다.

---

### 나니노벨 설치하기

Unity 엔진 에디터 프로젝트 창으로 Naninovel.package 파일을 드래그&드롭하거나 에셋 스토어 메뉴에서 산 패키지를 임포트하면 초기 스크립트 컴파일 및 에셋 가져오기 프로세스가 진행되며 나니노벨을 설치할 수 있습니다.

Naninovel 패키지 폴더를 옮기고 싶다면 프로젝트 에셋 디렉터리 내 어디든 옮길 수 있습니다.

> #### 팁
>
> 에셋 스토어에서 호스팅되고 Unity의 패키지 관리자를 통해 제공되는 Naninovel 패키지는 일반적으로 예전 버전(레거시)입니다. [Discord 서버에서](https://discord.gg/BfkNqem) 최신 버전을 받으세요.

Naninovel을 사용하는 동안 여러 에셋(구성, 설정, 저장 등)이 Assets/NaninovelData 폴더 내에 자동으로 생성됩니다. 패키지 폴더와 달리 데이터 폴더는 수동으로 이동해서는 안 됩니다(자동으로 다시 생성되어 버립니다). 데이터 폴더의 위치를 변경하려면 엔진 구성 메뉴(Generated Data Path)에서 속성을 편집합니다.

> #### 경고
>
> Naninovel 폴더 안에 아무것도 저장, 수정 또는 삭제하지 마십시오. 이러한 변경 사항은 패키지가 업데이트될 때 손실되며 수정된 버전의 패키지에 대한 지원을 제공하지 않습니다.

---

### 나니노벨 스크립트 추가하기

Create -> Naninovel -> Naninovel Script 에셋 컨텍스트 메뉴에서 나니노벨 스크립트 에셋을 추가합니다.

![나니노벨 Getting Started - 나니노벨 스크립트 추가하기](https://subculturegamer.com/wp-content/uploads/2024/08/image-55.png)
> #### 메모
>
> 프로젝트 폴더 아래에 Naninovel 스크립트(및 다른 나니노벨 리소스)를 만들고 저장하는 것은 임의로 구성할 수 있습니다. 그 네이밍도 마음대로 하셔도 됩니다. 위는 하나의 예시일 뿐입니다.

> #### 주의
>
> Unity 엔진은 Resources라는 이름이 지정된 폴더를 특별한 방식으로 처리합니다. 해당 폴더 안에 있는 리소스는 강제로 빌드에 포함되며, 이는 성능 저하 이슈에 직결될 수 있습니다. 가장 중요한 건, 가이드가 특별히 요구하지 않는 한 Resources/Naninovel 폴더 아래에 어떤 것도 저장하지 않는 것입니다. 이것만 지켜지면 뜻밖의 충돌이나 비정상적인 실행이 일어나는 것을 예방할수 있습니다.

---

나니노벨 스크립트는 씬에서 일어나는 일을 제어하는 .nani 확장자를 가진 텍스트 문서입니다. 이것을 Word로 열든 VS Code로 열든 Google Docs로 열든 그 어떠한 것도 자유입니다.

![나니노벨 Getting Started - 스크립트 추가하기 1](https://subculturegamer.com/wp-content/uploads/2024/08/image-56.png)

비주얼 스크립트 편집기를 이용해 naninovel 스크립트를 직접 편집할 수도 있습니다. 생성된 스크립트 에셋을 선택하면 유니티 엔진의 inspector 창에 비주얼 에디터가 자동으로 열리는 것을 확인하실 수 있습니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-ba57b9f78116e57408125325bdf66be9.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-ba57b9f78116e57408125325bdf66be9.mp4@main.mp4?_=2)

스크립트에 새 줄을 추가하려면 줄을 삽입할 위치를 마우스 오른쪽 버튼으로 클릭하거나 ‘Ctrl + Space’ 키를 눌러 원하는 줄 삽입 또는 명령어 입력이 가능합니다. (Ctrl + Space를 변경하고싶다면 Configuration menu에서 기본 키 설정을 변경할 수 있습니다.) 줄을 재정렬하려면 번호 레이블을 선택하고 줄을 드래그&드롭합니다. 하나의 줄을 제거하려면 선을 마우스 오른쪽 버튼으로 클릭하고 “제거(Remove)”를 선택합니다.

비주얼 편집기를 사용하여 스크립트를 변경하면 검사기 헤더의 스크립트 이름 위에 별표(‘\*’기호;아스터리스크)가 표시됩니다. 이는 애셋에 수정사항이 발생했다는 의미이며 이 변경사항을 반영하려면 저장해야 함을 의미합니다. 에셋을 저장하려면 ‘Ctrl + s’를 누릅니다. 스크립트에 변경사항이 있는 상태에서 다른 에셋을 선택하려고 하면 다이얼로그 팝업이 나타나 변경 사항을 저장하거나 되돌릴 지 묻습니다.

비주얼 편집기는 외부에서 업데이트하는 경우 편집된 스크립트를 자동으로 동기화하므로 텍스트 편집기와 비주얼 편집기 모두에서 스크립트로 원활하게 작업할 수 있습니다.

> #### 메모
>
> 이 가이드의 나머지 부분에서는 텍스트 편집기를 사용하지만 원하는 경우 비주얼 에디터를 사용하여 동일한 단계를 모두 반복할 수 있습니다.

나니노벨 관련 에셋(예: 우리가 만든 스크립트)이 유니티 엔진에서 “표시”되게 하려면, 프로젝트 리소스로 할당되어야 합니다.

에셋 생성 메뉴에서 생성한 스크립트는 자동으로 프로젝트 리소스로 할당됩니다. 스크립트 리소스를 수동으로 할당(또는 편집/제거)하려면 에디터 컨텍스트 메뉴로 액세스할 수 있는 스크립트 리소스 창(Naninovel -> Resources -> Scripts)을 사용할 수 있습니다.

스크립트를 추가하려면, ‘+’ 버튼을 눌러 새 레코드를 추가하고 스크립트 자산을 목록에 드래그 앤 드롭합니다. 여러 자산 또는 전체 폴더를 목록으로 끌어다 놓아 일괄적으로 추가할 수도 있습니다.

![나니노벨 Getting Started - 스크립트 추가하기 2](https://subculturegamer.com/wp-content/uploads/2024/08/image-57.png)

생성된 스크립트를 텍스트 편집기에서 열고 다음 텍스트를 추가합니다.

```
Hello World!
@stop
```

첫 번째 줄은 게임이 실행될 때 “Hello World!” 텍스트를 인쇄하고 두 번째 줄은 스크립트 실행을 정상적으로 중지합니다.

플레이 모드로 들어가 새 게임을 시작하여 결과를 확인하세요.

> #### 메모
>
> 사용 가능한 모든 기본 제공 스크립트 명령, 지원되는 매개 변수 및 사용 예제는 [API 참조](https://naninovel.com/api/)에 나열되어 있습니다. 사용자 지정 명령을 추가할 수도 있습니다. 자세한 내용은 [가이드를](https://naninovel.com/guide/custom-commands) 참조하세요.

타이틀 메뉴의 “NEW GAME” 버튼이 활성화되지 않은 경우 Start Game Script 구성이 스크립트 구성(Naninovel -> Configuration -> Scripts)에서 생성된 스크립트와 동일한 이름인지 확인하세요.

![나니노벨 Getting Started - 스크립트 추가하기 3](https://subculturegamer.com/wp-content/uploads/2024/08/image-58.png)

---

### 캐릭터 추가하기

나니노벨의 캐릭터 리소스로는 일반 포트레이트(regular), 분절된 스프라이트(diced sprites), 애니메이션 Live 2D나 Spine 모델 및 3D 메쉬를 추가할 수 있습니다. 사용하기에 따라서는 앞서 예시를 든 것 외의 고유의 구현사항을 추가하는 것도 가능합니다. 이번 가이드에서는 스프라이트 구현을 예시로 들겠습니다.

각 캐릭터는 ID와 외모의 세트(set of appearances)로 구성됩니다. 캐릭터를 추가하려면 Naninovel -> Resources -> Characters 메뉴의 Character manager GUI를 사용해, 해당 ID를 지정하는 새 캐릭터 액터 레코드를 추가한 뒤, 레코드를 더블 클릭하고 모든 외형 스프라이트를 목록에 추가합니다. Naninovel 스크립트때와 마찬가지로 여러 에셋과 폴더를 목록으로 한번에 끌어다 놓을 수 있습니다.

![나니노벨 Getting Started - 캐릭터 추가하기](https://subculturegamer.com/wp-content/uploads/2024/08/image-59.png)

추가된 캐릭터 ID가 “Kohaku”라고 가정해 보겠습니다. naninovel 스크립트를 편집하여 추가된 캐릭터를 표시합니다.

```
@char Kohaku
Hello World!
@stop
```

게임을 실행하면 화면 중앙에 캐릭터 외형 스프라이트 중 하나가 표시됩니다. 외형을 지정하지 않으면 캐릭터의 ID와 동일한 이름의 외형 또는 “기본값”이 기본적으로 선택됩니다. 특정 모양을 선택하려면 다음과 같이 점으로 구분된 문자 ID 뒤에 해당 이름을 추가합니다.

```
@char Kohaku.Happy
Hello World!
@stop
```

캐릭터 “Kohaku”에 대해 “Happy”라는 이름이 추가된 외형이 있으므로 이제 기본 스프라이트 대신 해당 스프라이트가 표시됩니다.

이제 텍스트 앞 ID 뒤에 콜론을 추가하여 캐릭터와 캐릭터 대사를 연결할 수 있습니다.

```
@char Kohaku.Happy
Kohaku: Hello World!
@stop
```

캐릭터 외형과 출력할 텍스트를 바로 입력하여 입력 방식을 조금 더 효율화할 수 있습니다.

```
Kohaku.Happy: Hello World!
@stop
```

캐릭터(또는 배경이나 텍스트 출력기같은 다른 액터들)를 숨기려면 @hide 명령어 다음에 액터 ID를 사용합니다.

```
Kohaku.Happy: Hello World!
@hide Kohaku
@stop
```

---

### 배경 추가하기

캐릭터와 마찬가지로 배경은 Naninovel에서 여러 가지 방법으로 표현될 수 있습니다 : 스프라이트, 일반 객체(generic object), 비디오 및 씬; 커스텀 사용자 구현도 가능합니다.

여러 개의 독립적인 배경 액터를 만들 수도 있겠지만, 일반적으로 비주얼 노벨에서는 하나의 배경에서도 다양한 다른 무드를 가질 때가 있습니다. (낮, 밤, 노을 등)

루틴을 단순화하기 위하여 MainBackground 액터에 배경 액터를 미리 등록해놓는다면 Naninovel 스크립트에서 액터를 변경할 때마다 ID를 지정하지 않아도 됩니다.

Naninovel -> Resources -> Backgrounds 메뉴에서 배경 스프라이트를 추가합니다. MainBackground 레코드가 자동으로 열리지만, 원한다면 액터 리스트로 돌아가서 다른 액터를 생성하는 것도 가능합니다.

![나니노벨 Getting Started - 배경 추가하기 1](https://subculturegamer.com/wp-content/uploads/2024/08/image-60.png)

추가된 배경 외형 스프라이트 이름을 “City”라고 가정해 보겠습니다. 배경을 표시하려면 @back 명령어 다음에 배경 외형 이름을 기입합니다.

```
@back City
```

배경 사이를 전환할 때에는 기본적으로 크로스 페이드 전환 효과(transition effect)가 사용됩니다. 이 효과를 변경하고 싶다면 이름 뒤에 트랜지션 유형을 지정해줄 수 있습니다.

```
@back City
@back School.RadialBlur
```

위 명령어는 RadialBlur 전환 효과를 사용하여 “City”를 “School”로 전환하는 예시입니다.

기본 배경 이외의 배경을 참조하려면(예: 서로 위에 여러 배경을 구성하려는 경우) 액터의 ID를 지정합니다. 예를 들어 Flower라는 ID를 가진 배경 액터가 메인 액터 옆에 존재한다고 가정하면, 다음 명령은 그 외형을 “Bloomed”에서 “Withered”로 변경합니다.

```
@back Bloomed id:Flower
@back Withered id:Flower
```

---

### BGM, SFX 추가

BGM(배경 음악) 또는 SFX(음향 효과) 에셋을 추가하려면 Naninovel -> Resources -> Audio 에디터 메뉴를 사용합니다. Unity에서 지원하는 모든 오디오 형식을 사용할 수 있습니다.

![나니노벨 Getting Started - BGM, SFX 추가](https://subculturegamer.com/wp-content/uploads/2024/08/image-61.png)

추가된 BGM 파일명이 “ThePromenade”라고 가정해 보겠습니다. 이 트랙을 배경 음악으로 재생하려면 @bgm 명령 다음에 트랙 이름을 사용합니다.

```
@bgm ThePromenade
```

BGM을 전환할 땐 크로스 페이드 효과가 자동으로 적용됩니다. BGM 설정상 반복(Loop)이 디폴트 설정이지만 변경 또한 가능합니다. 명령어 매개변수를 사용하여 볼륨 및 페이드 지속 시간도 변경할 수 있습니다.

반대로 SFX는 기본적으로 반복되지 않습니다. “폭발” SFX를 추가했다고 가정하면 @sfx 명령을 사용하여 재생합니다.

```
@sfx Explosion
```

---

### 영상 가이드

영상으로 보는 가이드가 더 편한 분들은, 아래의 영상 가이드를 참고하셔도 좋습니다.

---

### 데모 프로젝트[​](https://naninovel.com/guide/getting-started#demo-project)

데모 프로젝트의 전체 소스(스토어에 전시된 것과 동일)는 GitHub에서 사용할 수 있습니다 .

[Git 클라이언트를 사용하여 저장소(repository)를 복제(clone)](https://help.github.com/en/github/creating-cloning-and-archiving-repositories/cloning-a-repository)하거나 zip 아카이브로 다운로드할 수 있습니다. 데모 프로젝트와 함께 배포되는 자산은 사용자 지정 라이선스의 적용을 받을 수 있으며 학습 목적으로만 제공됩니다.

> #### 경고
>
> Naninovel 패키지는 프로젝트와 함께 배포되지 않으므로 처음 열면 컴파일 오류가 발생합니다. 패키지를 가져오면 문제가 해결됩니다.

---

#### 작성 기준일

: 2024. 8. 14.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)