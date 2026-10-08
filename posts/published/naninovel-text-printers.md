---
title: "나니노벨 Text Printers"
url: https://subculturegamer.com/naninovel-text-printers/
published: 2024-09-07
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-19.png)

나니노벨 Text Printers

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/text-printers)

---

## 텍스트 출력기(Text Printers)

텍스트 출력기는 시간에 따라 차례로 텍스트를 출력시키는 기능을 하는 액터(Actor)입니다.

출력기 기능에 관한 전반의 설정은 *Naninovel -> Configuration -> Printers* 컨텍스트 메뉴에서 편집할 수 있습니다. 편집 가능한 옵션은 [configuration guide](https://naninovel.com/guide/configuration#printers) 문서를 참고하세요.

naninovel 스크립트에서 텍스트 프린터는 대부분 *@print* 및 *@printer* 명령으로 제어됩니다.

```
; 다이얼로그 기본 출력기를 불러옵니다.
@printer Dialogue
```

```
; 다이얼로그 풀스크린 출력기를 불러옵니다.
@printer Fullscreen
```

```
; 아래 구문은 다이얼로그 기본 출력기로 텍스트를 출력합니다.
@print text:"Lorem ipsum dolor sit amet."
```

```
; 아래 구문은 위와 동일하지만 일반 텍스트문을 사용합니다.
Lorem ipsum dolor sit amet.
```

```
; 아래 구문은 위와 동일하지만 화자가 "Felix"입니다.
Felix: Lorem ipsum dolor sit amet.
```

내장된 텍스트 출력기가 UI로 구현되더라도, 여전히 나니노벨에서는 액터로 취급되는 것에 유의하세요.

이는 액터와 연관된 모든 명령어(숨기기/드러내기)에 텍스트 출력기도 다른 액터들과 마찬가지로 영향을 받는다는 것을 의미합니다.

예를 들어, *@showPrinter*의 *time* 파라미터는 애니메이션 지속시간을 보여주는데, 이 값이 지정되지 않은 경우 *Change Visibility Duration* 프린터 액터 구성 속성은 기본값으로 사용됩니다.

텍스트 출력기 UI 프리팹 루트에 있는 *Fade Time* 속성은 위 규칙에 예외로 적용됩니다.

---

### 자동 진행 텍스트

자동 진행 기능(Auto-advance feature)은 “i” 명령어를 이용해 자동으로 스크립트 실행을 계속하게 합니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-e6f58f861fa18bd62591db9794e7641b.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-e6f58f861fa18bd62591db9794e7641b.mp4?_=1)

“i” 명령어는 스크립트 진행을 잠깐 홀딩시키는 역할을 합니다. 플레이어가 어떤 키를 누르거나 Continue 기능을 활성화시키면 “i” 명령어 이후의 텍스트가 출력되게 됩니다. auto-advance 모드에서는 “i” 명령어가 일정 시간동안 스크립트 출력을 홀딩하다가 완료되고 다음 명령을 실행하게 합니다.

자동 진행 모드는 AutoPlay 입력(독립형 입력 모듈의 경우 기본적으로 “A”키) 또는 제어판의 “AUTO” 버튼을 사용하여 전환할 수 있습니다.

---

### 텍스트 스킵하기

텍스트 스킵 기능을 사용하면 *@print* 명령어 실행을 빨리 감아 텍스트 표시(출력) 프로세스를 효과적으로 건너뛸 수 있습니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-9605a5c8cd1911217350d77712f47e7d.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-9605a5c8cd1911217350d77712f47e7d.mp4?_=2)

스킵 모드는 스킵 입력(독립형 입력 모듈의 경우 기본적으로 Ctrl 키) 또는 제어판의 “SKIP” 버튼을 사용하여 전환할 수 있습니다.

기본적으로 스킵 모드는 이미 과거에 실행된 적 있는 명령어 실행 동안에만 사용할 수 있습니다. 예를 들어 사용자가 출력 텍스트를 아직 읽지 않은 경우 스킵 모드를 사용할 수 없습니다. 이는 게임 설정에서 “스킵 모드” 설정을 사용하여 변경할 수 있습니다.

---

### 백로그(Printer Backlog)

(프린터) 백로그는 사용자가 이전에 인쇄된 텍스트를 다시 읽고, 선택한 선택 사항을 수정하고, 음성 라인을 재생하고, (선택적으로) 기록된 메시지로 롤백할 수 있는 기능입니다.

*ShowBacklog* 입력(독립 실행형 입력 모듈의 경우 기본적으로 *L* 키)을 활성화하거나 제어판에서 “LOG” 버튼을 눌러 메인 게임 루프 중에 언제든지 백로그를 표시할 수 있습니다.

다양한 백로그 UI 속성은 프리팹의 루트에 연결된 구성 요소를 통해 사용자 정의할 수 있습니다. 각 속성이 무엇을 제어하는지에 대한 자세한 내용은 속성의 도구 설명을 참조하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-01.png)

UI를 사용자 정의하고 구성하는 방법에 대한 자세한 내용은 [내장된 UI 사용자 정의 가이드](https://naninovel.com/guide/user-interface#modifying-built-in-ui)를 참조하세요.

프린터 출력기 구성에서 Add to Backlog 속성을 비활성화하여 특정 텍스트 출력기가 백로그에 메시지를 추가하는 것을 방지할 수 있습니다. Split Backlog Messages 속성이 활성화되면 백로그에 추가된 모든 메시지가 분할됩니다(별도의 레코드로 표시됨).

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-02.png)

---

### 작성된 템플릿

이미 화자가 있는 경우 직접 말하기(直話) 텍스트 메시지를 출력하는 과정을 자동화할 수 있습니다. 이러한 처리는 *Authored Template* 프로퍼티(속성)을 통해 각 텍스트 출력기 액터에 대해 개별적으로 구성됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-03.png)

텍스트 서식 지정 태그 또는 문자를 지정할 수 있습니다.

%AUTHOR%를 작성자 이름(캐릭터 표시 이름)으로, %TEXT%를 사용하여 텍스트 메시지로 바꿀 수 있습니다.

예를 들어, 아래의 템플릿을 확인해 보세요.

```
"%TEXT%" - <i>%AUTHOR%</i>
```

인쇄된 메시지를 따옴표로 묶고 대시와 작성자 이름이 이탤릭체로 표시됩니다.

예를 들어, Kohaku: Lorem ipsum. 이라는 텍스트를 입력했다고 가정하면 위 템플릿에 따르면 아래와 같은 처리 결과가 발생합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-04.png)

작성된 템플릿 기능 대신, 화자의 이름을 출력하고 일반 라인 시작 부분에 콜론을 표시하려면 아래 스크립트를 참고하세요.

```
; 액터 연관 옵션 없이 "John: Hello!"라는 텍스트를 출력할 때
John: Hello!
```

```
; 액터 ID에 "john"이 등록되어 있고, "John: Hello!" 텍스트를 메시지 컬러 등 특정 액터 연관 옵션과 함께 출력시키고 싶을 때
john: John: Hello!
```

```
; john의 출력 이름이 "John Doe"이고, "John Doe: Hello!"를 특정 액터 연관 옵션과 함께 출력시키고 싶을 때
john: {GetName(john)}: Hello!
```

```
; GetName 함수는 관리되는 텍스트 변수로 대체할 수 있습니다.
john: {t_johnName}: Hello!
```

※위의 작업을 수행하려면 “작성된 템플릿” 옵션을 비활성화해야 합니다.

---

### 다이얼로그 출력기

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-05.png)

다이얼로그 출력기는 넉넉한 높이의 UI 창 내부에 텍스트를 표시합니다. 처음에는 화면 크기의 약 1/3을 차지하고 콘텐츠에 더 많은 공간이 필요할 때 높이가 위아래로 늘어납니다. 또한 다이얼로그 출력기는 텍스트 창 위에 레이블에 등록된 해당 캐릭터 이름을 표시합니다.

---

### 넓은 (다이얼로그) 출력기

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-06.png)

넓은 (다이얼로그) 출력기는 와이드 디스플레이에 맞춰진 패널 레이아웃의 일부 변경을 제외하면 대화 프린터와 매우 유사합니다. 넓은 (다이얼로그) 출력기는 (좌측 하단에 캐릭터 얼굴을 노출시킬 수 있는) [캐릭터 아바타 기능](https://naninovel.com/guide/characters#avatar-textures)도 지원합니다.

---

### 풀스크린 (다이얼로그) 출력기

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-07.png)

“NVL” 모드라고도 하는 풀스크린 출력기는 창 안에 텍스트를 고정된 크기로 표시합니다. 화면 크기의 대부분을 차지하며 많은 양의 텍스트를 표시하기 위해 기본적으로 들여쓰기 되어 있습니다.

풀스크린 출력기는 기본적으로 텍스트를 출력할 때마다 앞서 출력된 텍스트를 지우지 않습니다. 대신, 필요할 때 *@resetText* 명령을 사용하여 이미 출력된 내용을 지울 수 있습니다. printer actor configuration 메뉴에서 *Auto Reset*을 활성화하여 변경할 수 있습니다.

풀스크린 출력기에서 처리하는 각 출력 명령은 출력기의 현재 내용이 비어 있는 경우 제외하고는 기본적으로 출력된 텍스트 앞에 2줄 개행을 추가합니다. 이는 출력기 액터 구성 메뉴에서 *Auto Line Break*를 0으로 설정하여 비활성화할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-08.png)

아래는 전체 화면 출력기 사용 예시입니다.

```
; 전체화면 출력기 기능 활성화.
@printer Fullscreen
```

```
; 아래의 텍스트는 각 한 번씩 개행이 되며 하나의 화면에서 출력됩니다.
Lorem ipsum dolor sit amet. Proin ultricies in leo id scelerisque.
Praesent vel orci luctus, tincidunt nisi et, fringilla arcu. In a metus orci.
Maecenas congue nunc quis lectus porttitor, eget commodo massa congue.
```

```
; 출력기에 출력된 텍스트를 초기화합니다.
@resetText
```

```
; 그 다음 라인에 텍스트를 출력시킵니다.
Morbi ultrices dictum diam, in gravida neque vulputate in.
…
```

---

### 채팅 출력기

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-09.png)

채팅 출력기는 모바일 메시지 앱과 유사합니다. 수직 스크롤이 가능한 콘텐츠가 포함된 창 프레임의 메시지 말풍선 안에 텍스트를 표시합니다.

여타 출력기에서는 출력 메시지를 한 글자씩 출력하지만 채팅 출력기는 “상대방이 타이핑 중” 애니메이션을 보여주다가 즉시 인쇄된 메시지를 보여줍니다. 채팅 출력기는 캐릭터 아바타 기능을 지원합니다.

채팅 출력기 내에 선택지를 포함하려면 *[ChatReply](https://naninovel.com/guide/choices#chatreply-choice-handler)* 선택지 핸들러를 참조하세요. *Chat Printer Panel* 구성 요소에 있는 *Choice Handler ID* 속성을 통해 사용자 정의 핸들러를 지정할 수도 있습니다.

---

### 말풍선 출력기

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-10.png)

말풍선 출력기는 카툰풍 대화 감성을 주고자 할 때 유용합니다.

내장된 말풍선 출력기는 “왼쪽”과 “오른쪽”이라는 두 가지 모양을 지원하며, 캐릭터를 기준으로 출력기의 위치와 방향을 정렬하는 데 사용할 수 있습니다.

```
@printer Bubble.Left pos:42,80 visible:false time:0
@show Bubble wait:false
Misaki: Aliquam lobortis!
@char Nanikun.Happy wait:false
@printer Bubble.Right pos:53,55 visible:false time:0
@show Bubble wait:false
Nanikun: Integer nec maximus elit, eget posuere risus.
```

한 번에 두 개 이상의 말풍선(또는 기타) 출력기를 표시하고 싶다면 커스텀 출력기를 추가할 수 있습니다.

---

### 커스텀 출력기 추가하기

내장된 템플릿을 기반으로 커스텀 텍스트 출력기를 추가하거나 처음부터 새 출력기를 만들 수 있습니다. 예를 들어 내장된 다이얼로그 템플릿을 커스터마이징 해 보겠습니다.

*Create -> Naninovel -> Text Printers -> Dialogue* 에셋 컨텍스트 메뉴를 사용하여 Naninovel 패키지 외부 어딘가에 다이얼로그 프리팹을 생성합니다. 예를 들어, *Assets/TextPrinters* 폴더를 만들어 이 안에 생성했다고 가정합니다.

프리팹 편집은 글꼴, 텍스처 변경, 애니메이션 추가 등이 가능합니다. 사용 가능한 UI 구성 도구에 대한 자세한 내용은 uGUI에 대한 [Unity 문서](https://docs.unity3d.com/Packages/com.unity.ugui@latest)를 참조하세요. [UI 사용자 정의 가이드](https://naninovel.com/guide/user-interface#ui-customization)에는 uGUI 작업에 대한 몇 가지 튜토리얼 비디오와 예제 프로젝트도 있습니다.

나니노벨 출력기 관리자 GUI는 *Naninovel -> Resources-> Printers* 컨텍스트 메뉴를 통해 접근 가능합니다. 이곳에서 (나니노벨 엔진) 리소스에 프리팹을 노출시킬 수 있습니다.

+(더하기) 버튼을 사용하여 새 레코드를 추가하고 액터 ID(프리팹 이름과 다를 수 있음)를 입력한 다음 레코드를 두 번 클릭하여 액터 설정을 엽니다. 출력기 프리팹을 *Resources* 필드로 드래그 앤 드롭합니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-3f51881fa554720b7a4092dca42fd15e.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-3f51881fa554720b7a4092dca42fd15e.mp4?_=3)

이제 *@printer* 명령을 통해 활성화하고 관리자에서 설정한 액터 ID를 지정하여 새 텍스트 출력기를 사용할 수 있습니다.

```
@printer MyNewPrinter
```

> **예시**
>
> 사용자 정의 프린터 추가에 대한 예는 데모 프로젝트를 확인하세요.
>
> 프리팹은 *Assets/Prefabs/CustomPrinter.prefab* 로 저장됩니다.

*ITextPrinterActor* 인터페이스를 수동으로 구현하여 처음부터 프린터를 만드는 것도 가능합니다. 자세한 내용은 [커스텀 액터 구현](https://naninovel.com/guide/custom-actor-implementations)에 대한 가이드를 참조하세요.

---

### 텍스트 출력 이펙트

출력된 텍스트 메시지의 진행 상황 표시는 *Revealable Text* 구성 요소에 의해 유지됩니다. 이것은 Unity의 TMPro Text를 래핑하고 동일한 기능을 모두 지원합니다. 그러나 Revealable Text 그 자체는 출력 효과가 적용되지 않습니다.

*Reveal Clipped*와 같은 독립형 컴포넌트는 현재 출력 상태에 맞춰 표시되는 최대 문자 수를 제한하는데 쓰입니다.

Reveal Fader는 대부분의 내장 출력기 컴포넌트에 포함되어 이는 글자에 그라디언트 투명도를 제어하는 데 사용됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/08/naninovel-textprinters-11.png)

표시 효과 강도(페이드가 늘어나는 정도)를 변경하려면 Length 속성을 변경합니다.

*Slack Opacity*가 1 미만이면 마지막 추가 전에 인쇄된 텍스트의 불투명도가 *Slack Duration 초* 동안 지정된 값으로 희미해집니다. (내장된 *전체화면 출력기*에서 기본적으로 활성화된 기능입니다)

[<https://naninovel.com/imgit/fetched/i.gyazo.com-29017ea20e8b7b95c3f7f25658b645f9.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-29017ea20e8b7b95c3f7f25658b645f9.mp4?_=4)

텍스트 출력기의 크기가 고정되어 있고 다양한 메시지 길이 또는 글꼴 크기를 수용할 수 없는 경우에는 TMPro의 텍스트 오버플로 모드를 “Page”로 설정하고, 현재 표시된 페이지를 표시 진행률과 동기화하는 *Reveal Paginator* 컴포넌트를 추가하세요. *Fullscreen* 내장 프린터에서 예제 설정을 찾아보세요.

---

### 텍스트 스타일

**@style** 명령어를 사용하거나 텍스트 바로 앞에 리치 텍스트(rich text) 태그를 입력해 다양한 텍스트 스타일 사용이 가능합니다.

자세한 건 [공식 문서](http://digitalnativestudios.com/textmeshpro/docs/rich-text/)를 참고하세요.

---

### 루비 (후리가나)

루비 문자는 나니노벨의 Naninovel TMPro Text 컴포넌트(Revealable Text를 기반으로 한)에서 커스텀 <ruby> 태그로 제공됩니다. 루비 문자를 배치해야 하는 텍스트에 루비 태그를 감싸고 태그 안에 루비 텍스트를 지정합니다.

예를 들면,

```
Lorem <ruby="VERY">ipsum</ruby> dolor sit amet.
```

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-12.png)

위처럼 텍스트를 입력했을 때, “VERY”라는 텍스트가 “ipsum” 텍스트의 위에서 출력됩니다.

> **메모**
>
> <ruby>를 다른 태그와 결합할 때 형식 문제를 방지하려면 Ruby 태그를 먼저 지정하세요.
>
> Lorem <ruby=”VERY”><tip=”TipID”>ipsum</tip></ruby> dolor sit amet.

*Naninovel TMPro Text* 컴포넌트 속성을 변경하여 루비 텍스트의 크기와 수직선 오프셋을 추가로 제어할 수 있습니다.

기본적으로 출력문에 루비 문자가 삽입되면 한 줄의 높이가 길어집니다. 루비 텍스트가 있거나 없는 모든 줄의 높이를 동일하게 하고 싶다면 *Add Ruby Line Height* 속성을 비활성화하고 기본 줄 높이를 늘립니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-13.png)

아래는 루비 태그를 사용하는 방법에 관한 시연 영상입니다.

---

### 우->좌 (아랍어) 텍스트 출력

모든 내장 출력기에서 RTL(Right to Left) 텍스트 표시 효과 지원을 활성화할 수 있습니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-38b9ec2bbf18dc6ee469c3fb452eae29.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-38b9ec2bbf18dc6ee469c3fb452eae29.mp4?_=5)

출력기에서 RTL 텍스트를 사용하려면 다음 절차를 따르세요.

1. 내장된 템플릿에서 커스텀 출력기(custom text printer)를 만듭니다.
2. 출력기 내부의 *Revealable Text* 컴포넌트에서 *Enable RTL Editor* 속성을 설정합니다.
3. 동일 컴포넌트에서 *Fix Arabic Text* 속성을 활성화합니다(“Naninovel 설정” 드롭다운 내).

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-14.png)

[호환되는 글꼴](https://fonts.google.com/?subset=arabic&sort=popularity)을 사용해야한다는 점과 아틀라스 구성이 필요하다는 걸 명심하 요.

예는 다음과 같습니다.

```
Font Size: Auto Sizing  
Font padding: 5  
Packing Method: Optimum  
Atlas res: 1024x1024  
Character Set: Unicode Range (Hex) with this Sequence:  
20-7E,600-603,60B-615,61B,61E-61F,621-63A,640-65E,660-6DC,6DF-6E8,6EA-6FF,750-76D,FB50-FBB1,FBD3-FBE9,FBFC-FBFF,FC5E-FC62,FD3E-FD3F,FDF2,FDFC,FE80-FEFC  
Font Render Mode: Distance Field 16
```

> **예시**
>
> RTL 텍스트(아랍어) 지원 맞춤형 텍스트 메시 프로 프린터 설정에 대한 전체 예를 보려면 GitHub의 Naninovel RTL 프로젝트를 참조하세요.

> **메모**
>
> Unity는 기본적으로 아랍어 텍스트를 지원하지 않습니다. 아랍어를 지원해야 하는 텍스트 레이블(출력기 제외)에는 *Naninovel TMPro Text* 컴포넌트를 사용하는 것이 좋습니다.

---

### CJK Languages

중국어, 일본어, 한국어는 고유 기호가 많지만, 게임에서는 일반적으로 작은 하위 집합만 필요합니다. 생성된 글꼴 아틀라스 크기를 최적화하기 위해 TMPro에는 SDF 텍스처를 빌드할 문자 집합을 지정하는 옵션이 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-15.png)

Naninovel에서 표시할 문자를 찾으려면 *Naninovel -> Tools-> Character Extractor* 에디터 메뉴에서 액세스할 수 있는 문자 유틸리티를 사용하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-16.png)

이 도구는 지정된 폴더(모든 하위 폴더 포함)에 있는 시나리오 스크립트와 관리되는 텍스트 문서를 모두 검사해서 Naninovel이 플레이어에게 표시한 모든 텍스트, 인쇄된 모든 텍스트, UI 레이블, 잠금 해제 가능한 팁 등을 포함한 모든 텍스트 문자를 가져옵니다.

> **예시**
>
> 일본어 로케일용 맞춤 TMPro 글꼴 아틀라스 사용에 대한 예는 GitHub 프로젝트를 확인하세요. 일본어를 선택하면 글꼴이 자동으로 전환되고, 다른 언어를 선택하면 기본 아틀라스로 다시 전환됩니다.

---

### 텍스트 출력 사운드

내장된 출력기에서는 텍스트 출력 효과를 지원합니다. (현재 기준, 다이얼로그, 풀스크린, 넓은 다이얼로그까지) 텍스트가 출력될 때 SFX가 재생되는 옵션을 설정할 수 있습니다.

먼저, “커스텀 출력기 추가하기” 가이드에 따라 내장된 출력기 기반의 커스텀 출력기를 만듭니다.

그 다음 프리팹의 루트 객체에 연결된 *Revealable Text Printer Panel* 컴포넌트를 찾아 *Reveal Sfx* 속성을 사용하여 문자 출력 시 재생될 SFX를 설정합니다. 사용 가능 옵션의 실제 목록은 *Naninovel -> Resources-> Audio* 메뉴에 추가한 오디오 리소스를 기반으로 합니다.

Chars SFX 목록 속성을 사용하여 여러 SFX를 특정 문자에 매핑할 수도 있습니다.

다음 이미지는 ‘공백 문자’에 대해 “KeyStroke2″가, ‘D, d, F, 1, 4, 9 및 \*’에 대해 “Explosion”가 재생되게 하면서 ‘%’ 문자는 아무것도 재생되지 않고 나머지의 경우에는 “KeyStroke1″이 출력되게 설정한 예시입니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-17.png)

또는 캐릭터 구성 메뉴(character configuration menus)에서 *Message Sound*를 설정하면 어떤 텍스트 프린터가 해당 메시지를 출력하는지에 관계 없이 특정 캐릭터가 화자인 경우에 텍스트 출력 사운드를 지정할 수 있습니다.

화자(캐릭터)의 메시지 사운드와 기본 출력기의 Reveal Sfx가 모두 할당되어있는 경우에는 출력기의 기본 Reveal SFX 대신에 메시지 사운드가 재생됩니다. Chars SFX를 구성하면 화자(캐릭터)의 메시지 사운드 지정 여부와 관계없이 해당 사운드가 항상 재생됩니다.

문자 출력 사운드는 매우 자주 재생되어, 텍스트 출력 속도에 따라 동일한 사운드가 재생될 때 잘리는 경우가 생깁니다. 따라서 해당 오디오 클립이 매우 짧고 선명한지(중간 끊김이나 무음구간이 없는지) 확인하세요.

사운드가 작동하지 않는 경우(예: 사운드가 각 문자가 표시될 때마다 재생할 만큼 짧지 않은 경우) *TextPrinterManager* 엔진 서비스의 *OnPrintTextStarted* 및 *OnPrintTextFinished* 이벤트를 사용하여 그에 따라 사운드 반복을 시작/중지하는 것이 좋습니다. 비주얼 스크립팅 방식을 선호하는 경우 이러한 이벤트는 PlayMaker에도 노출됩니다.

---

### 이벤트 드러내기

특정 문자가 출력될 때 이벤트를 후킹하여 임의의 작업을 수행하는 것이 가능합니다. 이벤트가 호출되어야 하는 인쇄된 텍스트의 위치를 ​​<@…> 태그로 지정합니다.

예를 들어, “dolor”라는 텍스트가 출력된 직후 “foo” 페이로드로 공개 이벤트를 트리거하려면 다음 방법을 따르세요.

```
Lorem ipsum dolor<@foo> sit amet.
```

이벤트를 연동(listen)하려면 Printer 프리팹의 표시 가능한 텍스트 개체에 연결된 Event Broadcaster 컴포넌트를 사용하세요. 모든 내장 출력기에는 이미 컴포넌트가 연결되어 있으므로 리스너를 연동하기만 하면 됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/naninovel-textprinters-18.png)

내장 출력기에도 **Play Command** 옵션이 활성화되어 있습니다. 이렇게 하면 컴포넌트가 이벤트 본문(@ 다음 부분)을 명령으로 구문 분석하고 실행하려고 시도합니다.

예를 들어 다음 문장은 “dolor”가 출력된 뒤 배경에 색조가 적용됩니다.

```
Lorem ipsum dolor<@back tint:blue> sit amet.
```

이벤트 태그를 인라인 명령어 대신 사용하여 번역자가 선택한 로케일을 기반으로 실행된 명령을 재정의할 수 있도록 로컬라이즈 문서에 이벤트 태그를 노출할 수 있습니다.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)