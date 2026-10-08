---
title: "나니노벨 Characters"
url: https://subculturegamer.com/naninovel-characters/
published: 2024-09-21
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters.png)

나니노벨 Characters

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/characters)

---

캐릭터는 배경 액터 앞에 배치되는 장면 개체를 나타내는 데 사용되는 액터입니다.

캐릭터 액터는 이름, 외양, 가시성, 변환(위치, 회전, 크기 조정) 및 시선 방향으로 정의됩니다. 시간 경과에 따라 앞서 정의된 모양, 가시성, 변형 및 시선 방향을 변경될 수 있습니다.

캐릭터의 행동은 *Naninovel -> Configuration -> Characters* 컨텍스트 메뉴에서 구성할 수 있습니다. 사용 가능한 옵션은 [구성 가이드](https://naninovel.com/guide/configuration#characters)를 참조하세요. 캐릭터 리소스 관리자는 *Naninovel -> Resources -> Character*s 컨텍스트 메뉴에서 접근할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-19.avif)

캐릭터나 캐릭터에 할당된 외모(표정 등)가 많아 에디터 메뉴에서 모두 할당하기가 불편한 경우, 다중 편집 및 레코드 정리를 지원하는 액터 레코드 에셋(*Create – Naninovel – Actor Record – Character*)을 사용하세요.

아래 영상에서 예시를 확인할 수 있습니다.

에디터 메뉴를 사용하지 않고도 어드레서블 에셋 시스템([addressable asset system](https://naninovel.com/guide/resource-providers#addressable))을 사용하여 리소스를 액터 레코드와 연결할 수 있습니다.

예를 들어 ‘Happy’ 외양(표정)을 ‘Kohaku’ 캐릭터와 연결하려면 *Naninovel/Characters/Kohaku/Happy* 주소로 텍스처 에셋을 할당하고 어드레서블 그룹 구성에서 Naninovel 라벨을 자산에 할당합니다. 어드레서블 공급자는 기본적으로 에디터에서 사용되지 않습니다. 리소스 공급자 구성 메뉴에서 *Allow Addressable In Editor* 프로퍼티를 활성화하여 이를 허용할 수 있습니다. [리소스 공급자 설명서](https://naninovel.com/guide/resource-providers#addressable)에서 어드레서블 공급자 사용에 대한 자세한 내용을 찾아보세요.

naninovel 스크립트에서 캐릭터는 대부분 **@char** 명령어로 제어됩니다.

기본 외형으로 ‘소라’라는 이름의 캐릭터를 표시합니다.

```
; 기본 외형으로 'Sora'라는 이름의 캐릭터를 표시합니다.
@char Sora
```

```
; 위와 동일하지만 외양(표정)을 'Happy'로 설정합니다.
@char Sora.Happy
```

```
; 위와 동일하지만, 캐릭터의 위치가 왼쪽으로부터 45%, 아래쪽으로부터 10% 떨어져 있게 호출합니다. 또한 Sora의 방향성은 왼쪽입니다.
@char Sora.Happy look:left pos:45,10
```

팁

장면에 액터를 배치하는 데 도움이 되도록 [Scene Assistant](https://github.com/idaocracy/NaninovelSceneAssistant) 확장 기능을 사용해 보세요.

---

### 포즈(Poses)

각 캐릭터는 미리 지정된 상태(포즈)를 지정할 수 있는 *Poses* 속성을 갖습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-18.avif)

포즈 이름을 *@char* 명령어의 모양으로 사용하면 명령어 매개변수를 개별 지정하지 않고 포즈에 지정된 모든 선택된 매개변수를 한번에 적용할 수 있습니다.

```
; Kohaku 캐릭터에 'SuperAngry' 포즈가 이미 지정되었다면, 앞서 파라미터에 지정된 값이 적용됩니다.
@char Kohaku.SuperAngry
```

```
; 위와 다른 건 동일하지만, DropFade 트랜지션을 3초간 적용하는 예시입니다.
@char Kohaku.SuperAngry transition:DropFade time:3
```

포즈가 외양으로 사용되는 경우에도 개별 매개변수를 무시할 수 있습니다.

```
; 앞서 Kohaku 캐릭터의 SuperAngry 포즈에 tint라는 명령어로 #ff45cb 컬러를 지정하는 예시입니다.
@char Kohaku.SuperAngry tint:#ff45cb
```

캐릭터 및 배경 구성에서 *Shared Poses*(공유 포즈;모든 액터간에 공유하는 공통 포즈)도 찾을 수 있습니다.

공유 포즈의 사용 사례로는 말하기/말하지 않기 템플릿을 재사용하거나 카메라에 따라 사전 정의된 단계를 만드는 것 등이 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-17.avif)

액터별 포즈와 공유 포즈 모두 전용 포즈 매개변수를 통해 적용할 수도 있습니다.

```
@char Kohaku.Happy pose:DownLeft  
@char Yuko.Surprise pose:UpCenter  
@char Misaki pose:UpRight
```

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-16.avif)

액터별 포즈는 공유 포즈보다 우선순위가 높습니다. 액터 포즈 이름이 공유 포즈와 같으면 액터 포즈가 사용됩니다. 이 기능을 통해 필요에 따라 특정 액터의 공유 포즈를 재정의할 수 있습니다.

---

### 표시 이름(Display Names)

캐릭터 구성에서 특정 캐릭터의 표시 이름(*Display Name*)을 설정할 수 있습니다. 설정 시, 출력기의 이름 레이블 UI에 캐릭터 ID 대신 표시 이름이 대신 표시됩니다. 이를 통해 캐릭터 ID에는 사용할 수 없는 공백 문자나 특수 문자를 사용한 복합적인 이름 구성이 가능해집니다.

이 방법 대신, 관리 텍스트 자원 생성 태스크를 실행할 때 자동으로 생성되는 ‘CharacterNames’ [관리 텍스트 문서](https://naninovel.com/guide/managed-text)를 사용하여 이름을 지정할 수 있습니다. 표시 이름을 현지화하거나 Unity 에디터 외부에서 편집하려면 이 기능을 사용하세요. 관리되는 텍스트 문서의 레코드는 행위자 구성에 설정된 표시 이름보다 우선순위가 높으며 이를 재정의합니다.

표시 이름을 사용자 정의 변수에 바인딩하여 naninovel 스크립트를 통해 게임 전반에 걸쳐 동적으로 변경할 수 있습니다. 표시 이름을 바인딩하려면 캐릭터 구성 메뉴에서 중괄호로 묶인 사용자 정의 변수의 이름을 지정하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-15.avif)

그런 다음 스크립트에서 변수 값을 변경할 수 있으며 표시 이름도 변경됩니다.

```
@set PlayerName="Mistery Man"
Player: …

@set PlayerName="Dr. Stein"
Player: You can call me Dr. Stein.
```

플레이어가 **@input** 명령을 사용하여 표시 이름을 선택할 수 있도록 이름 바인딩 기능을 사용할 수도 있습니다.

```
@input PlayerName summary:"Choose your name."  
@stop  
Player: You can call me {PlayerName}.
```

중괄호의 내용은 실제로 본격적인 스크립트 표현식으로 처리되므로 표시 이름을 평가하기 위한 복잡한 시나리오가 가능합니다. 예를 들어, 캐릭터에게 미리 정의된 현지화 가능한 표시 이름을 유지하다가, 특정 지점에서부터는 플레이어가 사용자 정의 이름을 선택하도록 할 수 있습니다.

이름이 지정되지 않은 캐릭터로 ‘Char1’ ID가 있다고 가정해 보겠습니다. 이 캐릭터의 사전 정의된 이름이 ‘T\_PredefineName’ 관리 텍스트 레코드로 저장되어 있다면, 플레이어가 값을 입력하면 이는 ‘name’ 커스텀 변수로 저장되고 ‘nameSet’ 변수가 플레이어가 이름을 설정했을 때부터 ‘true’가 될 것입니다.

(에디터에서 이처럼 정의하려면) Display Name 란에 파라미터를 아래와 같이 입력하세요.

```
{ nameSet ? name : T_PredefinedName }
```

위와 같은 상황을 스크립트 예시로 작성해본다면 아래와 같습니다.

> @char Char1
>
> Char1: My name is now pre-defined by `T_PredefinedName` managed text record.  
> Char1: It’s localizable; try changing the locale and it will update accordingly.  
> Char1: Now, we’ll make the player input a custom name.
>
> ; input 란에 할당된 기본값은 ‘value’ 매개변수를 따릅니다. 이는 현지화 가능한 텍스트이며 관리되는 텍스트에서 호출할 수 있습니다.
>
> @input name summary:”Choose your name.” value:{T\_DefaultName}  
> @stop
>
> ; 여기에서 표시 이름으로 사용하기 위해 value에 입력된 변수 값을 사용할 수 있게 설정합니다.  
> @set nameSet=true
>
> Char1: My display name is now bound to `name` custom variable.
>
> @stop

---

### 메시지 컬러

character configuration에서 Use Character Color이 활성화된 경우, @print 명령어나 일반 텍스트 줄에 해당하는 캐릭터 ID가 지정될 때 출력기 텍스트 메시지와 이름 레이블이 앞서 지정된 특정 컬러로 반영되어 출력됩니다.

다음 영상에서는 표시 이름과 메시지 컬러를 사용하는 방법을 보여줍니다.

---

### 아바타 텍스처(Avatar Textures)

@char 명령어에 아바타 매개변수를 사용하여 캐릭터에 아바타 텍스처를 할당할 수 있습니다.

아바타는 캐릭터와 관련된 텍스트 메시지를 인쇄할 때 호환되는 텍스트 출력기에 표시됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-14.avif)

현재는 넓은 다이얼로그 출력기(Wide) 및 채팅 출력기(Chat Printers) 내장 출력기(TMPro 대응 출력기 포함)만이 아바타 기능을 지원합니다. 커스텀 출력기에서 이 기능을 지원하려면 *Author Image* 컴포넌트가 있는 게임 개체를 *Revealable Text Printer Panel* 컴포넌트의 *Author Avatar Image* 프로퍼티에 할당하세요.

특정 아바타를 사용하려면 먼저 아바타 리소스에 추가하고 이름을 지정해야 합니다. 캐릭터 구성 메뉴의 *Avatar Resources* 프로퍼티를 통해 이 작업을 수행할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-13.avif)
> **메모**
>
> 아바타 이름은 단독으로 쓰일 수 있으며 기존 캐릭터 ID나 외모(표정)를 반드시 포함할 필요는 없습니다. 이는 아바타를 캐릭터와 연결하여 자동으로 표시하려는 경우에만 필요합니다.

다음과 같이 사용하여 특정 아바타 텍스처를 표시할 수 있습니다.

```
@char CharacaterId avatar:AvatarName
```

캐릭터 기본 아바타를 설정하려면 *CharacterID/Default*와 동일한 아바타 텍스처 리소스 이름을 지정하면 됩니다. 예를 들어 ID가 *Kohaku*인 캐릭터의 기본 아바타를 설정하려면 아바타 리소스 이름을 *Kohaku/Default*로 지정합니다. @char 명령어로 아바타 매개변수를 지정하지 않아도 기본 아바타가 자동으로 표시됩니다.

아바타를 특정 캐릭터 외모(표정)와 연관시켜 캐릭터의 표정이 변경되면 아바타도 자동으로 변경되도록 하는 것도 가능합니다. 이를 위해 *CharacterID/CharacterAppearance* 형식을 사용하여 아바타 리소스의 이름을 지정합니다. 여기서 *CharacterAppearance*는 아바타 리소스를 매핑할 모양의 이름입니다.

텍스트 출력기 내에 캐릭터 아바타만 표시하고 캐릭터 자체는 숨기려면 @char 명령어의 visible 매개변수를 false로 설정합니다.

```
@char CharacaterId visible:false
```

캐릭터 포트레이트를 숨긴 동안 아바타를 계속 변경하는 경우 캐릭터 구성 메뉴에서 Auto Show On Modify를 비활성화하는 것이 좋습니다. 이 옵션을 비활성화하면 캐릭터가 숨겨져 있는 동안 캐릭터의 매개변수를 변경하기 위해 *visible:false*를 지정할 필요가 없습니다.

> **메모**
>
> 아바타는 캐릭터 외양과 직접적으로 연결되지 않으며 씬에서 캐릭터를 표현하는 방법으로 간주되어서는 안 됩니다. 아바타는 호환되는 텍스트 프린터에 임의의 이미지를 ‘주입’하는 독립형 기능입니다. 텍스트 출력기(또는 커스텀 UI) 내에 실제 캐릭터 (포트레이트)가 나타나도록 하려면 [액터 텍스처로 렌더링 기능](https://naninovel.com/guide/characters.html#render-to-texture)을 확인하세요.

---

### 화자 (캐릭터) 하이라이트(Speaker Highlight)

(화자 하이라이트 기능이) 캐릭터 구성에서 활성화된 상태라면, 마지막으로 출력된 대사가 캐릭터와 연관되어 있는지 여부에 따라 캐릭터에 지정된 포즈가 설정됩니다. 아래 동영상은 이전 버전의 Naninovel에서 화자 이름에 색상을 지정한 기능을 보여줍니다. 현재 버전에서는 이와 설정이 유사하지만 색상 대신 포즈를 지정한다는 차이가 있습니다.

---

### 립 싱크

#### 이벤트 기반

애니메이션 가능한 캐릭터 구현(generic;일반적, layered;레이어, Live2D, 기타 등등)은 *On Started Speaking* 및 *On Finished Speaking* 유니티 이벤트를 제공합니다. 어떤 캐릭터가 출력 텍스트의 화자일 경우에 이벤트 기반으로 립 싱크를 시작하거나, 출력 대사가 모두 출력되었을 때 립 싱크를 중지시키는 등의 커스텀 로직을 제어하는 것도 가능합니다.

자동 음성 할당 기능(auto voice)이 활성화된 경우에는 이벤트가 음성 해설(voice-over)에 의해 기반해 구동됩니다. 그렇지 않으면 출력되는 텍스트 대사가 이벤트를 활성화 시킵니다. 후자의 경우 이벤트를 수동으로 음소거할 수 있습니다. (예: 마침표 등 문장부호가 있을 때 립 싱크가 발생하는 경우를 예방하기 위해) 이러한 경우에는 *@lipSync* 명령어를 사용하세요.

#### 오디오 기반

보이스 오디오 클립 실제 파장이 캐릭터 립 싱크를 구동하게 하려면 캐릭터 구성에서 *Voice Source* 옵션을 사용하세요. Unity의 *Audio Source* 컴포넌트가 포함된 프리팹이 할당되면 Naninovel은 캐릭터 개체 아래에 프리팹을 인스턴스화하고 오디오 소스 구성요소를 통해 캐릭터의 음성을 재생합니다.

캐릭터 음성에 사용되는 전용 오디오 소스 컴포넌트에 액세스하면 커스텀 솔루션을 연결하여 재생되는 오디오 파동을 분석하고 이에 립 싱크를 맞춰 구동할 수 있습니다. 이에 도움이 될 수 있는 여러 써드 파티 솔루션이 있습니다. 예를 들어 Live2D의 *Cubism Audio Mouth Input* 컴포넌트나 [SALSA](https://assetstore.unity.com/packages/tools/animation/salsa-lipsync-suite-148442) 등이 있습니다.

---

### 연결된 출력기

*Linked Printer* 프로퍼티로 텍스트 출력기를 문자와 연결할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-12.avif)

연결하면 출력기가 자동으로 화자(캐릭터)의 메시지를 처리하는 데 사용됩니다.

@print 명령어(일반 텍스트 줄을 인쇄할 때 내부적으로도 사용됨)는 연결된 출력기를 기본값으로 설정하고 기본적으로 다른 보이는 프린터를 숨깁니다.

출력기가 캐릭터에 연동되면 print 명령어는 현재 보이는 기본 텍스트 출력기를 해당 캐릭터와 자동으로 변경하여 텍스트를 인쇄합니다. 프린터 행위자 구성 메뉴에서 *Auto Default* 프로퍼티를 비활성화하여 이 동작을 방지할 수 있습니다. 단, 비활성화된 경우에는 @printer 명령어를 사용하여 기본 출력기를 수동으로 표시하거나 숨기는 등 전환해야 합니다.

---

### 스프라이트 캐릭터

캐릭터 액터의 스프라이트 구현은 가장 보편적이고 간단한 것입니다. 캐릭터의 모습을 표현하기 위해 쿼드 메시(스프라이트) 위에 래핑된 텍스처 에셋 세트를 사용합니다. 텍스처는 *.jpg, .png, .tiff, .psd* 또는 [Unity에서 지원하는 기타 이미지 파일](https://docs.unity3d.com/Manual/ImportingTextures) 형식을 기반으로 할 수 있습니다.

> **팁**
>
> 개발 프로세스에 가장 적합한 파일 형식을 선택하세요. 프로젝트를 빌드할 때 Unity는 모든 소스 리소스(텍스처, 오디오, 비디오 등)를 대상 플랫폼에 가장 적합한 형식으로 자동 변환하므로 원래 프로젝트에 리소스를 저장하는 형식에는 차이가 없습니다. [공식 문서](https://docs.unity3d.com/Manual/AssetWorkflow)에서 Unity가 프로젝트 에셋을 관리하는 방법에 관해 자세히 알아보세요.

크기가 조정되지 않은 씬의 최초 스프라이트 캐릭터 메시 사이즈는 카메라 구성의 레퍼런스 해상도, 캐릭터의 Pixel Per Unit 속성(configuration 메뉴에서 각 캐릭터 액터에 대해 설정할 수 있다.) 및 소스 텍스처 해상도에 따라 달라집니다.

최고의 렌더링 품질과 최적의 성능을 얻으려면 일반적으로 모든 캐릭터에 대해 Pixel Per Unit 값을 100으로 유지하고 텍스처 해상도를 통해 원하는 초기 캐릭터 사이즈를 제어하는 ​​것이 좋습니다.

예를 들어, 게임의 참조 해상도가 기본 *1920×1080* 픽셀인 경우 캐릭터가 전체 화면 높이를 차지하도록 하려면 캐릭터 텍스처의 높이를(예: Photoshop 또는 기타 이미지 편집기를 통해 크기를 조정하여) 1080픽셀로 설정합니다. 캐릭터가 화면 높이의 2/3를 차지하게 하려면 또다른 캐릭터 이미지의 높이를 1080 \* 2/3 등으로 설정하세요.

---

### 쪼개진(Diced) 스프라이트 캐릭터

오픈소스 [SpriteDicing](https://github.com/elringus/SpriteDicing) 패키지로 구축된 *DicedSpriteCharacter* 구현을 사용하면 캐릭터 스프라이트 텍스처 영역을 재활용하여 빌드 사이즈와 텍스처 메모리를 크게 줄일 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-11.avif)

[Unity package manager](https://docs.unity3d.com/Manual/upm-ui.html)를 통해 패키지 설치: 패키지 관리자 창(Window – Package Manager)을 열고 ‘+’ 버튼을 클릭한 후 ‘Add package from git URL’를 선택하고 https://github.com/elringus/SpriteDicing.git# 입력 입력 필드에 패키지를 추가하고 ‘Add’를 클릭하세요.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-b54e9daa9a483d9bf7f74f0e94b2d38a.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-b54e9daa9a483d9bf7f74f0e94b2d38a.mp4@main.mp4?_=1)

> **메모**
>
> Git 리포지토리에서 패키지를 설치하기 전에 Git 클라이언트가 컴퓨터에 설치되어 있고 Git 실행 경로가 PATH 시스템 환경 변수로 설정되어 있는지 확인하세요(일반적으로 설치 중에 자동으로 수행됨).

UPM을 통해 ‘SpriteDicing’ 확장 프로그램을 설치하면 Naninovel.DicedSpriteCharacter 옵션이 character implementations 목록에 나타납니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-10.avif)
> **메모**
>
> 캐릭터 메타데이터 속성(예: 단위당 픽셀, 피벗 등)은 씬의 캐릭터를 표현하는 데 사용되는 렌더링 텍스처에 적용되는 반면, 유사한 다이싱된 아틀라스 속성은 생성된 다이싱된 스프라이트에 적용됩니다. 아틀라스 속성을 변경할 때 변경 사항이 적용되도록 다시 빌드해야 한다는 것을 명심하세요.

---

### 레이어(Layered) 캐릭터

레이어 (캐릭터) 구현으로 캐릭터를 여러 레이어로 구성하여 런타임 시 naninovel 스크립트에서 개별 또는 그룹으로 전환할 수 있습니다.

> **팁**
>
> 레이어 (캐릭터) 액터 구현은 발전해 왔으며, 현재는 Generic과 달리 모든 렌더링 기능을 지원하여 가장 유연하게 동작합니다. 레이어 표현식을 사용하는 대신 Unity의 애니메이터나 다른 커스텀 시스템을 사용하여 외양을 제어하려는 ​​경우에도 마찬가지입니다.
>
> 파티클 시스템과 같이 사소하지 않은 개체를 렌더링하거나 타사 렌더러를 활용해야 하는 경우, 일반 캐릭터 또는 커스텀 캐릭터 구현에 앞서 레이어 (캐릭터) 액터에 사용할 수 있는 [render only](https://naninovel.com/guide/characters#outsourcing-appearance-management) 및 [카메라 렌더링](https://naninovel.com/guide/characters#camera-rendering) 옵션을 확인하세요.

레이어 캐릭터 프리팹을 만들려면 *Create – Naninovel – Character – Layered* 에셋 컨텍스트 메뉴를 사용하세요. 레이어를 구성하려면 [프리팹 편집 모드](https://docs.unity3d.com/Manual/EditingInPrefabMode.html)로 들어가세요. 기본적으로 여러 레이어와 그룹이 생성됩니다. 이를 사용하거나 입맛에 맞게 추가하거나 삭제할 수 있습니다.

렌더러에서 파생된 컴포넌트(예: *SpriteRenderer, MeshRenderer* 등)가 있는 루트 프리팹 객체의 각 하위 게임 객체는 **레이어**로 간주됩니다. 다른 개체는 **그룹**으로 간주됩니다. 구성 변환 목적 외에도 그룹 내에 레이어를 배치하면 단일 레이어를 선택하거나 naninovel 스크립트의 단일 표현식을 사용하여 그룹 내의 모든 레이어를 비활성화/활성화할 수 있습니다(나중에 자세히 설명).

구성이나 변환 목적 외에도 그룹 내에 레이어를 배치하면 단일 레이어를 선택하거나 naninovel 스크립트의 단일 표현식을 사용하여 그룹 내의 모든 레이어를 비활성화/활성화할 수 있습니다.

> **메모**
>
> 기본(비카메라) 렌더 모드에서는 *스프라이트 렌더러*의 ‘simple’ 그리기 모드만 지원됩니다. 다른 모드를 선택하면 ‘simple’ 모드로 설정된 대로 렌더링됩니다.

특정 레이어가 기본적으로 표시되지 않도록 숨기려면 렌더러 구성 요소(게임 오브젝트 아님)를 비활성화하세요.

프리팹 위에 그려진 흰색 프레임은 런타임 시 렌더 텍스처로 렌더링될 액터 캔버스를 묘사하는 데 사용됩니다. 텍스처 메모리 낭비를 방지하고 앵커링이 올바르게 작동될 수 있도록 레이어와 그룹을 이동시켜 프레임 내 빈 공간을 최소화해야 합니다. 일부 레이어에 애니메이션이 적용되어 기본 캔버스 바깥으로 삐져나오는 경우를 방지하기 위해 커스텀 캔버스 사이즈 지정이 필요하다면, *Render Canvas* 컴포넌트를 루트 개체에 추가하고 Size 컴포넌트를 세팅합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-9.avif)

루트 게임 오브젝트의 크기를 조정하여 액터의 기본 크기를 미세 조정할 수 있습니다.

Photoshop에서 레이어가 있는 캐릭터 아트를 제작할 때 Unity의 [PSD Importer 패키지](https://docs.unity3d.com/Packages/com.unity.2d.psdimporter@3.0/manual/index.html)를 사용해 보세요. 모든 레이어와 해당 위치를 자동으로 유지시키는 캐릭터 프리팹을 생성할 수 있습니다. 레이어 계층 구조를 유지하려면 가져오기 설정에서 *Use Layer Grouping* 옵션을 활성화해야 합니다.

> **팁**
>
> 스프라이트를 사용할 때 텍스처 가져오기 설정에서 Mesh Type을 Full Rect으로 설정하여 렌더링 문제를 방지하세요.
>
> ![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-8.avif)

생성된 레이어드 프리팹을 캐릭터 리소스에 추가하는 것을 잊지 마세요 (*Naninovel -> Resources -> Characters*). “Naninovel.LayeredCharacter” 구성을 선택하고, 리소스 레코드를 구성할 때 프리팹을 “Resource” 필드에 드롭하세요.

Naninovel 스크립트에서 레이어드 캐릭터를 제어하려면, 다른 캐릭터 구현과 마찬가지로 @char 명령을 사용하세요. 유일한 차이점은 외형을 설정하는 방식입니다. 단일 ID 대신 레이어 구성 표현식을 사용합니다. 표현식에는 세 가지 유형이 있습니다:

1. 그룹 내에서 단일 레이어를 활성화: `group>layer`
2. 레이어 활성화: `group+layer`
3. 레이어 비활성화: `group-layer`

예를 들어, “Miho” 캐릭터에 “Body” 그룹과 세 개의 레이어(“Uniform”, “SportSuit”, “Pajama”)가 있다고 가정하면, “Uniform” 레이어를 활성화하고 나머지 레이어는 모두 비활성화하려면 다음 명령을 사용하세요:

```
@char Miho.Body>Uniform
```

그룹의 다른 레이어에 영향을 주지 않고 레이어를 활성화하거나 비활성화하려면 “>” 대신 “+” 및 “-“를 각각 사용합니다. 쉼표로 구분하여 여러 구성 표현식을 지정할 수도 있습니다.

```
; 안경 '착용', '모자 '해제', 'Cool' 이모션
@char CharId.Head/Accessories+BlackGlasses,Head-Hat,Head/Emotions>Cool
```

그룹 외부의 레이어(루트 조립식 객체의 하위 레이어)를 선택하려면 그룹 부분을 건너뛰십시오. 예:

```
; "Halo" 레이어 개체가 조립식 루트 아래에 배치되어 있으면 이를 비활성화합니다.
@char CharId.-Halo
```

; 컴포지션 표현식에서 레이어 이름을 생략하여 그룹 내의 모든 레이어(선택 표현식을 사용하는 경우 추가로 이웃 레이어)에 영향을 줄 수도 있습니다.

```
; "Body/Decoration" 그룹의 모든 레이어를 비활성화하려면:
@char CharId.Body/Decoration-
```

```
; 모든 존재하는 레이어를 활성화하려면:
@char CharId.+
```

```
; Poses/Light 그룹의 모든 레이어를 활성화하고, Poses/Dark 그룹의 레이어를 비활성화하려면:
@char CharId.Poses/Light>
```

위의 표현식은 대상 그룹의 직계 자손뿐만 아니라 하위 그룹에 포함된 모든 레이어에 재귀적으로 영향을 미칩니다.

외형이 지정되지 않은 경우(예: `@char CharId`처럼 이전에 외형을 설정하지 않았을 때), 기본 외형이 사용됩니다. 레이어드 캐릭터의 기본 외형은 레이어드 프리팹이 에디터에서 표시되는 방식과 동일합니다.

아래 비디오에서는 레이어드 캐릭터를 설정하고 Naninovel 명령을 통해 제어하는 방법을 시연합니다.

> **메모**
>
> 영상에 표시된 *@char Miho.Shoes>* 명령어는 실제로 숨기는 것이 아니라 “신발” 그룹을 선택합니다(모든 이웃 그룹을 비활성화합니다). 그룹을 숨기는 올바른 명령은 @char Miho.Shoes-입니다.

*Layered Character Behavior* 구성 요소의 *Composition Map* 속성을 통해 구성 표현식을 키에 매핑할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/image-12.png)

그런 다음 키를 사용하여 계층화된 액터 모양을 지정할 수 있습니다.

```
; Body>Uniform,Hair/Back>Straight,Hair/Front>Straight,Shoes>Grey와 동일
@char Miho.Uniform
; Equal to Hair/Back>Straight,Hair/Front>Straight와 동일
@char Miho.StraightHair
; 키와 표현싱을 조합하는 것도 가능
@char Miho.Uniform,Hair/Front>Short
```

레이어드 캐릭터 프리팹을 편집할 때, 맵핑된 구성 표현식을 미리 보려면 맵 레코드를 오른쪽 클릭하고 “Preview Composition”을 선택할 수 있습니다. 또 다른 메뉴 항목인 “Paste Current Composition”은 현재 캐릭터의 구성 표현식 문자열을 생성하여(계층에서 활성화/비활성화된 스프라이트 렌더러를 기준으로) 검사 중인 레코드에 붙여넣습니다. 이를 사용하면 현재 프리팹 상태를 구성 항목에 빠르게 맵핑할 수 있습니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-84a2f8e51997cdccbfb8321d58586d2a.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-84a2f8e51997cdccbfb8321d58586d2a.mp4?_=2)

레이어 객체는 런타임에 Unity 카메라에서 직접 렌더링되지 않습니다. 대신, 각 구성(외형)이 변경될 때마다 임시 렌더링 텍스처로 한 번 렌더링된 다음 Naninovel 카메라에서 볼 수 있는 커스텀 메시에 공급됩니다. 이 설정은 반투명 중첩 문제를 방지하고 전환 애니메이션 효과를 지원하기 위해 필요합니다.

레이어드 캐릭터에 애니메이션이나 다른 동적 동작을 적용하려면, *Layered Character Behaviour* 컴포넌트에서 *Animated* 속성을 활성화하세요. 이 속성을 활성화하면, 레이어는 외형이 변경될 때 한 번만 렌더링되는 대신 매 프레임마다 렌더링됩니다.

#### 외양 관리 외부에서 관리하기

레이어드 구현은 반투명 중첩 처리, 전환 효과, 블러 및 심도 효과 지원 등 다양한 내장 렌더 기능을 지원하는 데 유용할 수 있지만, Unity의 Animator와 같은 외부 도구를 사용하여 액터의 외형을 관리하고 싶은 경우가 있을 수 있습니다. 기본적으로 레이어드 동작은 *On Appearance Changed* 이벤트를 통해 외형 변경 사항을 알릴 때 레이어드 표현식을 사용하지만, 이러한 경우에는 원하지 않는 동작일 수 있습니다.

*Render Only* 옵션을 활성화하면 레이어 관련 동작이 비활성화되고, 외형 변경 이벤트는 스크립트 명령에서 지정된 대로 외형을 보고하게 됩니다. 또한, 초기 프리팹 레이어 구성을 기반으로 기본 외형을 평가하는 것을 방지하기 위해 Behaviour 컴포넌트에서 *Default Appearance*를 명시적으로 지정해야 합니다.

#### 카메라 렌더링

캐릭터 프리팹에 파티클 시스템, 트레일, 스프라이트 마스크나 커스텀/써드파티 렌더러와 같은 중요한 렌더러가 포함되어 있는 경우 *Layered Behavior* 컴포넌트 *Render Camera* 필드에 카메라를 할당하면 레이어드 구성을 함께 사용할 수 있습니다(단, 카메라는 캐릭터 프리팹 내에 위치해야 합니다).

할당되면 사용자 지정 렌더링 절차 대신 배우가 카메라를 사용하여 콘텐츠를 렌더링하므로 스텐실 지원 부족과 같은 모든 고유한 한계가 제거됩니다. 단점은 콘텐츠가 액터 텍스처에만 렌더링되고 기본 카메라로 ‘누출’되지 않도록 하려면 이러한 종류의 액터를 렌더링하기 위해 특별히 카메라 레이어 ↗를 예약해야 한다는 것입니다.

할당 시, 커스텀 렌더링 절차 대신에 액터에서 콘텐츠 렌더링을 실행되어, 스텐실 서포트가 부족하다든지 등의 상속되는 한계가 해결됩니다. 다만 콘텐츠가 액터 텍스처에만 렌더링되고 기본 카메라로 ‘누출’되지 않게 하려면 이런 종류의 액터를 렌더링하기 위해 특별히 카메라 레이어를 설정해두어야 합니다.

Unity에는 총 32개의 레이어가 있으며, 그 중 8개는 엔진 내부용으로 예약되어 있습니다. 나머지 레이어는 원하는 대로 사용할 수 있습니다(기본적으로 사용되지 않음). Naninovel이 카메라 모드에서 레이어된 액터를 렌더링하기 위해 레이어를 사용하도록 허용하려면 *Naninovel*로 시작하는 레이어 이름을 지정하십시오. 예: *Naninovel 1, Naninovel 2* 등.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-7.avif)

추가할 총 레이어 수는 동시에 표시하려는 액터 수에 따라 다릅니다. 레이어드 액터가 렌더링될 때 풀의 레이어를 보유합니다. 액터가 숨겨지면 레이어가 해제되어 다른 액터가 재사용할 수 있습니다. 또한, 레이어된 배우는 등장 시 렌더링이 이루어지며, 이는 처음 씬에 추가될 때 (처음에 숨겨져 있더라도) 발생합니다. 따라서 레이어 풀의 크기는 시나리오 스크립트에서 카메라로 렌더링될 배우의 총 수를 수용할 수 있도록 해야 합니다.

카메라 렌더링 모드에 있는 동안 *Layered Actor Prefab*의 게임 오브젝트는 Layered Actor Layer 컴포넌트가 임베드된 경우 레이어로 간주되고 다른 객체는 그룹으로 간주됩니다. 컴포넌트를 연결한 후 카메라 레이어가 유지되고 해제될 때 발생해야 하는 작업을 구성하기 위해 *On Layer Held* 및 *On Layer Released* 유니티 이벤트를 이용해 합니다. 일반적으로 호스트 게임 개체에 고정된 레이어를 할당하고 관련 렌더러를 활성화하고 해제 시 렌더러를 비활성화합니다(다른 카메라에서 개체를 선택하지 않도록 하기 위해).

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-6.avif)

레이어 활성 상태는 카메라 모드에서도 다르게 반영됩니다. 즉, 렌더러 컴포넌트 활성화 상태 대신 게임 오브젝트의 활성 상태가 사용됩니다. 액터의 기본 모양을 설정하려면 게임 오브젝트를 활성화/비활성화하세요.

> **팁**
>
> 레이어에 많은 하위 항목이 포함된 경우 각 하위 항목에 대해 레이어 보유/해제 이벤트를 개별적으로 설정하는 것은 지루한 작업입니다. 이 경우 커스텀 이벤트 핸들러를 사용하여 변경사항을 일괄적으로 적용합니다. 레이어의 모든 하위 렌더러에 변경 사항을 적용하는 [예제](https://forum.naninovel.com/viewtopic.php?t=606)를 확인하세요.

Render Canvas 컴포넌트가 레이어 액터 프리팹의 루트에 부착되면, 일반 렌더 모드와 동일하게 동작하여 렌더 텍스처 크기를 제한합니다. 해당 컴포넌트가 없으면 렌더 텍스처는 카메라의 픽셀 크기와 동일해집니다. 카메라 크기는 보통 필요 이상으로 크기 때문에, 성능 최적화를 위해 Render Canvas를 사용하는 것이 권장됩니다.

> **예**
>
> [GitHub의 URP 프로젝트](https://github.com/naninovel/samples/tree/main/unity/urp)에서 파티클 시스템을 포함하는 계층화된 배경 설정에 대한 예를 찾아보세요. (이 기능에는 URP가 필요하지 않으며 기본 렌더 백엔드와 동일하게 작동합니다)

---

### 일반(Generic) 캐릭터

일반(Generic;제네릭) 캐릭터는 가장 유연한 캐릭터 액터 구현 방식입니다. 이는 루트 객체에 *Generic Character Behaviour* 컴포넌트가 부착된 프리팹을 기반으로 합니다. 외형 변경 및 기타 모든 캐릭터 매개변수는 Unity 이벤트로 전달되며, 이를 통해 기본 객체의 동작을 원하는 방식으로 구현할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-5.avif)
> **주의**
>
> 일반적 액터 구현은 시나리오 스크립트에서 이벤트를 라우팅할 뿐이며 액터가 모양이나 가시성 변경 명령에 어떻게 반응해야 하는지, 스피커 하이라이트 기능을 지원할지 여부와 방법 등을 구현하는 건 사용자의 몫입니다. 액터와 관련된 기능 대다수가 제네릭 구현에서 자동으로 지원하지 않음에 유의하세요.

템플릿에서 일반 캐릭터 프리팹을 만들려면 *Create – Naninovel – Character – Generic* 컨텍스트 에셋 메뉴를 사용하세요.

일반적 캐릭터로 3D 리깅된 모델을 세팅하고 Animator 컴포넌트로 애니메이션 리깅을 라우팅하는 방법에 대한 예시를 보려면 다음 영상 튜토리얼을 확인하세요. 영상은 이전 Naninovel 버전으로 캡처되었기 때문에 현재 일부 속성 및 컴포넌트 이름이 다릅니다. 최신 정보는 위 문서를 참조하세요.

> **팁**
>
> 동일한 프레임에서 게임 개체가 활성화/비활성화되면 Unity의 *Animator* 구성 요소가 *SetTrigger*를 등록하지 못할 수 있습니다. *GameObject.SetActive*를 사용하여 가시성 변경을 처리하는 경우(위 튜토리얼에 표시된 대로) 대신 렌더러를 사용하여 하위 개체를 활성화/비활성화하는 것이 좋습니다.

> **예시**
>
> 일반 캐릭터 구현을 사용하여 3D 애니메이션 모델을 호스팅하는 GitHub에서 [예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/generic-actor)를 찾아보세요.

---

### 비디오 캐릭터

비디오 캐릭터는 반복되는 [비디오 클립](https://docs.unity3d.com/Manual/class-VideoClip) 에셋을 사용하여 모양을 나타냅니다.

각 플랫폼에 지원되는 비디오 형식은 비디오 소스에 대한 [Unity 문서](https://docs.unity3d.com/Manual/VideoSources-FileCompatibility.html)를 참조하세요.

알파 채널(투명도)이 포함된 비디오를 사용하는 경우 [지원되는 형식에 대한 가이드](https://docs.unity3d.com/Manual/VideoTransparency.html)를 참조하세요.

특정 표현이 반복되는 것을 방지하려면 표현 이름에 *NoLoop*(대소문자 구분)를 추가하세요.

---

### Live2D 캐릭터

Live2D 캐릭터 구현에는 [Live2D Cubism](https://www.live2d.com/) 2D 모델링 및 애니메이션 소프트웨어로 만든 에셋을 사용합니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-b81df72fc7afaed569520496cbee09f0.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-b81df72fc7afaed569520496cbee09f0.mp4?_=3)

이 에셋을 사용하려면 먼저 [Live2D Cubism SDK for Unity](https://live2d.github.io/#unity)를 설치해야 합니다. 설치 방법과 사용 지침은 공식 Live2D 문서를 참조하세요. 그런 다음 Naninovel의 샘플 [Live2D 확장 패키지](https://github.com/naninovel/samples/raw/main/unity/live2d/NaninovelLive2D.unitypackage)를 다운로드하여 임포트합니다.

> **메모**
>
> (이번 레이블은 주로) 써드파티 제품 프로그램과 Naninovel을 통합시켜 작동시키는 예시를 다룹니다. Live2D 업데이트에 맞춰 변경점을 가능한 한 호환되게 하려고 하고 있지만 제공해드릴 수 있는 기능은 최소한으로 유지되며 예제 범위를 넘어서서 써드파티에 대한 사용법을 제공해드리는 것은 어렵다는 점에 유의해 주세요.

Live2D 모델 프리팹을 리소스로 사용하는 경우, 루트 객체에 Live2DController 컴포넌트를 부착해야 합니다. 외형 변경은 애니메이터 컴포넌트로 전달되며, appearance 값이 트리거 이름으로 설정된 SetTrigger 명령으로 전달됩니다. 예를 들어, “Kaori”라는 Live2D 캐릭터 프리팹이 있고 “Surprise”라는 이름의 트리거를 호출하려면, 다음과 같은 명령을 사용할 수 있습니다:

```
@char Kaori.Surprise
```

위 명령은 프리팹에 부착된 애니메이터 컨트롤러에서 “Surprise”라는 인수로 SetTrigger를 호출하려고 시도할 뿐입니다. 따라서 애니메이터 상태 머신을 직접 구성해야 합니다.

> 메모
>
> 현재 버전의 Unity용 Cubism SDK는 Animator 컴포넌트에 직접 동작합니다. 이전 Cubism 2.x에서 사용되던 expressions 및 poses (expression.json 및 pose.json으로 export)는 더 이상 지원되지 않으며, Naninovel의 Live2D 익스텐션에서도 지원되지 않습니다.

Live2D 모델 프리팹에 *CubismLookController*와 *CubismMouthController* 컴포넌트가 존재하고 설정되어 있는 경우, *Live2DController*는 이들을 사용하여 캐릭터의 시선과 입 모양 애니메이션(즉, 립싱크 기능)을 제어할 수 있습니다.

[시선 추적](https://docs.live2d.com/cubism-sdk-tutorials/lookat) 및 [립싱크](https://docs.live2d.com/cubism-sdk-tutorials/lipsync) 설정에 대한 자세한 내용은 각 링크의 Live2D 문서를 참고하세요.

모델의 크기가 너무 작거나 큰 경우, [비디오 가이드](https://youtu.be/rw_Z69z0pAg?t=353)에서 설명한 대로 Live2D 프리팹의 루트 게임 오브젝트에 대한 초기 스케일을 설정하세요.

내부적으로, Live2D 모델은 텍스처로 렌더링된 후 화면에 투영됩니다. 이는 캐릭터를 페이드 처리할 때 발생할 수 있는 반투명 오버드로우 아티팩트를 방지하기 위해 필요합니다. Naninovel은 자동으로 렌더 캔버스 크기를 측정하려고 하지만, 모델에 애니메이션된 부분이 초기 경계를 벗어나 이동하는 경우, 해당 부분이 잘릴 수 있습니다.

이를 방지하려면 Live2D 프리팹의 루트 게임 오브젝트에 Render Canvas 컴포넌트를 추가하고 원하는 캔버스 크기를 수동으로 설정하세요. 프리팹 모드에서 기즈모를 활성화하여 현재 렌더 캔버스 크기를 미리 볼 수 있습니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-23f916ae104f57828914221333e42dbf.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-23f916ae104f57828914221333e42dbf.mp4@main.mp4?_=4)

캔버스 크기가 클수록 텍스처가 더 많은 메모리를 사용하므로 가능한 한 작게 유지하세요.

다음 비디오 가이드는 Cubism Editor에서 Live2D 캐릭터를 내보내고, 프리팹을 설정하고, 간단한 애니메이터 상태 머신를 생성한 다음 Naninovel 스크립트에서 캐릭터를 제어하는 방법을 다룹니다.

> **예시**
>
> Naninovel에서 Live2D 캐릭터를 사용한 [예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/live2d)를 GitHub에서 확인하세요.

---

### Spine 캐릭터

**Spine 캐릭터 구현**은 Spine 2D 모델링 및 애니메이션 소프트웨어로 생성된 에셋을 사용합니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-08b04de115d97427d152cb5f37065d2d.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-08b04de115d97427d152cb5f37065d2d.mp4@main.mp4?_=5)

이를 사용하려면 먼저 Unity용 [Spine 런타임](http://esotericsoftware.com/spine-unity-download)을 설치해야 합니다. 설치 및 사용 방법은 [공식 문서](http://esotericsoftware.com/spine-unity)를 참고하세요. 그런 다음 Naninovel의 [Spine 샘플 확장 패키지](https://github.com/naninovel/samples/raw/main/unity/spine/NaninovelSpine.unitypackage)를 다운로드하고 가져오세요.

> **메모**
>
> 이 통합은 주로 Naninovel을 다른 도구와 함께 사용하는 방법에 대한 예시로 제공됩니다. Spine 업데이트와 변경 사항에 맞게 샘플 통합을 유지하기 위해 노력하겠지만, 기능은 최소한으로 유지되며 Naninovel 외의 다른 제품에 대한 지원은 제공하지 않습니다.

Spine 캐릭터 프리팹을 리소스로 사용하는 경우, 프리팹의 루트 객체에 *Spine Controller* 컴포넌트를 부착해야 합니다. Naninovel 스크립트 명령어(*@char* 등)에서 외형 변경은 Spine Controller의 *On Appearance Changed* 이벤트로 전달됩니다. 이를 원하는 방식으로 처리할 수 있으며, Spine의 *SetAnimation* 메서드를 사용하거나 Unity 애니메이터 컨트롤러에서 트리거를 호출할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-4.avif)
> **팁**
>
> *Spine Controller*에서 상속된 커스텀 컴포넌트를 사용할 수 있습니다. 이렇게 하면 가상 메서드와 관련된 동작을 재정의하여 특정 지속 시간이나 전환 매개변수를 사용해 외형 변경을 처리할 수 있습니다.

내부적으로 Spine 모델은 텍스처로 렌더링된 후 화면에 투영됩니다. 이는 캐릭터 페이드 처리 시 반투명 오버드로우 아티팩트를 방지하기 위해 필요합니다. 텍스처 크기를 지정하려면 *Render Canvas* 컴포넌트를 사용하세요(*Spine Controller*를 추가할 때 자동으로 부착됨). 프리팹 모드에서 기즈모를 활성화하여 현재 텍스처 크기를 미리 볼 수 있습니다. 크기가 클수록 텍스처가 더 많은 메모리를 사용하므로 가능한 한 작게 유지하세요.

**참고 사항**

Spine의 [Skeleton Render Separator](https://github.com/pharan/spine-unity-docs/blob/master/spine-unity-skeletonrenderseparator)(다중 렌더) 워크플로우는 지원되지 않습니다. 이 워크플로우를 Naninovel과 통합하려면 사용자 정의 캐릭터 구현을 만들어야 합니다.

**예시**

GitHub에서 Spine 캐릭터가 Naninovel과 함께 사용된 [예제 프로젝트](https://github.com/naninovel/samples/tree/main/unity/spine)를 확인해 보세요.

---

### Narrator 캐릭터

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-3.avif)

**내레이터 캐릭터**는 장면에서 시각적 존재(외형, 위치, 시선 방향, 색조 등)는 없지만, 여전히 메시지를 작성하고 관련 설정 옵션(표시 이름, 메시지 색상, 연결된 출력기 등)을 가질 수 있습니다.

---

### 텍스처로의 렌더링(Render To Texture)

모든 구현 유형(일반 구현 제외)의 캐릭터 및 배경 액터를 텍스처 에셋으로 렌더링할 수 있으며, 이는 커스텀 UI, 출력기, 머테리얼 및 기타 호환 가능한 요소에 할당할 수 있습니다.

액터 설정에서 *Render Texture* 속성으로 텍스처 에셋을 할당하세요. 텍스처가 할당되면, 액터는 씬에서 게임 오브젝트가 아니라 텍스처에 렌더링됩니다. *Render Rectangle* 속성을 사용하면 텍스처에 렌더링할 액터의 영역을 지정할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-2.avif)
> **메모**
>
> [어드레서블 패키지](https://docs.unity3d.com/Manual/com.unity.addressables.html)를 사용하는 경우 [Unity가 에셋을 제대로 참조 추적하지 못할 수 있으며](https://issuetracker.unity3d.com/product/unity/issues/guid/1277169), 이는 빌드 시 텍스처 중복을 유발하여 기능이 제대로 작동하지 않게 할 수도 있습니다. 이 문제를 해결하려면 *AssetReference* API를 통해 참조를 수동으로 처리하거나 *Get Actor Render Texture* 컴포넌트를 사용하세요.
>
> ![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-characters-1.avif)

액터가 텍스처로 렌더링되면 위치, 회전, 크기 조정과 같은 변형 및 기타 일부 수정은 효과가 없습니다. 대신 렌더 텍스처의 호스트 객체(예: UI의 이미지)에 변형을 적용하세요.

아래 비디오는 Live2D 캐릭터를 텍스처로 렌더링하고 이를 커스텀 텍스트 출력기에 할당하는 방법을 보여줍니다. 프린터가 캐릭터와 연결되어 있어, 관련 메시지가 처리될 때 캐릭터가 자동으로 표시 및 숨겨집니다.

> **예시**
>
> GitHub의 Naninovel Live2D 프로젝트에서 Live2D 캐릭터를 텍스처로 렌더링하고 텍스트 프린터에 연결하는 설정에 대한 완전한 예제를 확인하세요.

기타 모든 캐릭터 및 배경 구현 유형(일반 제외)도 Live2D 예제와 유사하게 텍스처로 렌더링할 수 있습니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)