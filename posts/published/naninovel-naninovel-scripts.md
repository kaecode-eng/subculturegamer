---
title: "나니노벨 Naninovel Scripts"
url: https://subculturegamer.com/naninovel-naninovel-scripts/
published: 2024-08-21
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Naninovel Scripts](https://subculturegamer.com/wp-content/uploads/2024/08/나니노벨-naninovel-scripts.png)

나니노벨 Naninovel Scripts

## 개요

Naninovel 스크립트는 고유의 텍스트 호환 포맷(*.nani* extension)을 사용합니다.  
여기에서 당신은 씬에서 일어나는 일을 컨트롤할 수 있습니다.

스크립트는 *Create -> Naninovel -> Naninovel Script*에서 생성 가능합니다.  
유니티에 내장된 Visual Editor를 활용하거나, MS Word, VS Code를 사용하여 편집하실 수 있습니다.

![나니노벨 Naninovel Scripts - 개요](https://subculturegamer.com/wp-content/uploads/2024/08/image-62.png)

하나의 행은 하나의 지시문에 해당합니다.

지시문에는 명령어, 일반 텍스트, 레이블 또는 주석이 포함됩니다.

지시문은 크게 세 가지 타입이 있는데, 각 행의 가장 첫 문장에 적는 기호에 따라 타입이 결정됩니다.

지시문 기호를 따로 적지 않은 문장은 ‘일반 대사’로 취급됩니다.

---

| 기호 | 구문 타입 | 지시문 구분 |
| --- | --- | --- |
| @ | [명령어](https://naninovel.com/guide/naninovel-scripts#command-lines) | 특정 명령어(@bgm 등)를 실행시키기 위한 기호 |
| # | [레이블](https://naninovel.com/guide/naninovel-scripts#label-lines) | 일종의 머리말(heading)로, @goto 명령어로 레이블 이동 등에 활용 가능 |
| ; | [주석](https://naninovel.com/guide/naninovel-scripts#comment-lines) | 개발자 코멘트용 |

---

## 명령문

‘@’ 문자로 시작하는 문장은 ‘명령문(명령어 지시문)’에 해당합니다.

명령문은 씬에서 일어나는 일을 제어합니다. (배경 변경, 캐릭터 이동 등)

명령문은 대소문자를 구분하지 않습니다. 아래의 4개의 문장은 모두 가능합니다.

### 명령문 식별자

명령어 식별자 바로 뒤에는 명령문이 와야 합니다. 명령을 구현하는 C# 클래스이거나 명령어의 별칭(*CommandAlias* ​​특성을 통해 적용되는 경우)일 수 있습니다.

예를 들어, *@save* 명령어(게임을 자동 저장하는 데 쓰임)는 *AutoSave* C# 클래스를 통해 구현됩니다. 구현 클래스에는 *[CommandAlias(“save”)]* 특성도 적용되어 있으므로 스크립트에서 *@save* 및 *@AutoSave* 문 모두 명령을 호출할 수 있습니다.

명령 식별자는 대소문자를 구분하지 않습니다. 다음 구문은 모두 유효한 문법이며 동일한 AutoSave 명령을 호출합니다.

```
@save
@Save
@AutoSave
@autosave
```

### 명령어 매개변수

대부분의 명령어에는 명령어의 효과를 정의하는 여러 매개변수가 있습니다.

매개변수는 명령문 식별자 뒤에 정의된 키-값 표현식으로, 콜론 기호(:) 뒤에 위치합니다. 매개변수 식별자(키)는 명령어 구현 클래스의 상응하는 매개변수 필드 이름이거나 매개변수의 *별칭*(*CommandParameter* 특성의 별칭 속성을 통해 정의된 경우)일 수 있습니다.

```
@commandId paramId:paramValue
```

장면에 보이는 모든 캐릭터를 숨기고 싶다면 *@hideChars* 명령어를 사용해 보세요. 다음과 같이 사용할 수 있습니다.

```
@hideChars
```

여기에서 time 명령어와 소수점 매개변수를 사용하여 캐릭터가 사라지는(페이드 아웃되는) 시간을 제어할 수 있습니다.

```
@hideChars time:5.5
```

이렇게 하면 캐릭터가 장면에서 완전히 제거되기까지 5.5초 동안 페이드 아웃됩니다.

*wait boolean* 매개변수를 사용하여 다음 명령이 현재 명령 직후에 실행할지 아니면 완료될 때까지 기다려야 할지 지정할 수도 있습니다.

```
@hideChars time:5.5 wait:false  
@hidePrinter
```

캐릭터가 페이드 아웃되기 시작한 직후에 텍스트 출력기가 숨겨집니다. *wait*가 *true*이거나 특별히 매개변수가 표기되어있지 않다면 *@hideChars*가 실행된 이후 텍스트 출력기가 숨겨집니다.

#### 팁

*wait:false*를 자주 사용하는 경우, 스크립트 플레이어 설정에서 기본 wait 옵션(*Wait By Default*)을 비활성화하는 것이 좋습니다. 이렇게 하면 wait 매개변수가 명시적으로 true로 설정되지 않는 한 스크립트 플레이어가 명령을 기다리지 않습니다.

### 매개변수 타입

명령 매개변수에 따라 다음 값 타입 중 하나임을 짐작할 수 있습니다.

| 자료형 | 타입 | Description |
| --- | --- | --- |
| string | 문자열 | 간단한 문자열 타입입니다. – 예: *LoremIpsum* 문자열 안에 공백(스페이스)이 있다면 큰따옴표(“”)를 씁니다. – 예: *“Lorem ipsum dolor sit amet.”* |
| integer | 정수형 | 분수형이 아닌 숫자입니다. – 예: *1, 150, -25* |
| decimal | 실수형 | 따옴표(“.”) 뒤에 값이 있는 숫자입니다. – 예: *`1.0`, `12.08`, `-0.005`.* |
| boolean | 논리형 | 참(true) 또는 거짓(false)으로 구분되는 형식입니다. 대소문자를 구분하지 않습니다. |
| named | 지정형 | 위 자료형 중 하나의 값과 연관된 문자열입니다. 이름 부분과 나머지는 따옴표(“.”)로 구분됩니다. – 예: *foo.8, bar.-20* |
| list | 목록형 | 위 자료형 중 하나의 값이 쉼표(“,”)로 나열된 목록입니다. – 예: *foo,bar,”Lorem ipsum.”* (문자열 목록형) – 예: *12,-8,0.105,2* (실수형 목록형) |

### 이름 없는 매개변수

대부분의 명령어에는 이름이 없는 매개변수가 있습니다. 이름을 지정하지 않고 사용할 수 있는 매개변수는 이름이 없는 매개변수로 간주됩니다.

예를 들어 *@bgm* 명령어는 재생할 음악 트랙의 이름을 지정하는 이름 없는 매개변수입니다.

```
@bgm PianoTheme
```

여기서 “PianoTheme”은 “BgmPath” *String* 매개변수의 값입니다.

하나의 명령 당 이름 없는 매개변수는 하나만 존재할 수 있으며 항상 다른 매개변수보다 먼저 지정되어야 합니다.

### 필수 매개변수와 옵션 매개변수

대부분의 명령 매개변수는 **선택사항**입니다. 이는 미리 정의된 값이 있거나 명령을 실행하기 위해 어떤 값도 필요하지 않음을 의미합니다. 예를 들어 매개변수를 지정하지 않고 *@resetText* 명령어를 사용하면 기본 프린터의 텍스트가 재설정되지만 *@resetText printer:Dialogue*와 같이 특정 프린터 ID를 설정할 수도 있습니다.

일부 매개변수는 명령 실행을 위해 필수로 지정해야하는 경우도 있습니다.

### 명령어 API 레퍼런스

현재 사용 가능한 모든 명령어 목록과 그 예시를 보려면 명령 API 레퍼런스 페이지를 참조하세요.

---

## 일반 텍스트 라인(Generic Text Lines)

많은 양의 텍스트가 포함된 스크립트를 더 쉽게 작성하려면 일반 텍스트 라인을 사용하세요. Line은 사전에 정의된 명령문 기호(‘@’, ‘#’, ‘;’)로 시작하지 않는 경우 일반 텍스트 명령문으로 간주됩니다.

```
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
```

출력된 텍스트를 캐릭터 액터와 연결하기 위해 콜론과 띄어쓰기((: ))으로 구성된 일반 텍스트 라인의 시작 부분에 캐릭터 화자 ID를 지정할 수 있습니다. 예를 들면,

```
Felix: Lorem ipsum dolor sit amet, consectetur adipiscing elit.
```

출력된 텍스트와 관련된 캐릭터 외형이 지속적으로 변경될 필요가 있을 땐 입력 시간 절약을 위해 캐릭터 화자의 ID 뒤에 외형을 바로 지정할 수도 있습니다.

```
Felix.Happy: Lorem ipsum dolor sit amet.
```

다음 두 라인은 그 결과가 직전의 예시와 동일하게 실행됩니다.

```
@char Felix.Happy wait:false  
Felix: Lorem ipsum dolor sit amet.
```

### 명령어 도중에 삽입하기

텍스트 메시지를 출력하면서 동시에 특정 명령어를 실행하고 싶을 수 있습니다.

예를 들어, 캐릭터 액터가 특정 대사를 한 뒤 외형(표정)이 바뀌거나, 스토리상 특정 텍스트가 사건을 묘사할 때 그에 상응하는 SFX를 출력시키고 싶은 경우 등이 있습니다. 명령어 도중에 삽입하기 기능은 이와 같은 니즈를 충족시켜줍니다.

모든 명령어(built-in 명령어와 커스텀 명령어 둘 다)는 대괄호([ ])를 사용하여 일반 텍스트 라인에 삽입할 수 있습니다.

```
Felix: Lorem ipsum[char Felix.Happy pos:0.75 wait:false] dolor sit amet, consectetur adipiscing elit.[i] Aenean tempus eleifend ante, ac molestie metus condimentum quis.[i][br 2] Morbi nunc magna, consequat posuere consectetur in, dapibus consectetur lorem. Duis consectetur semper augue nec pharetra.
```

삽입된 명령문은 ‘@ 기호’가 생략되고 명령문이 대괄호로 묶였다는 점을 제외하면 일반적인 명령문 문법과 같습니다. 기본적으로 어떤 명령어든 일반 텍스트 라인에 삽입할 수 있으며 동일한 효과를 가지지만, 텍스트 내부의 위치에 따라 그 실행 시점이 달라집니다.

내부적으로는 일반 텍스트 라인이 인라인 인덱스로 식별되는 개별 명령으로 구문 분석됩니다. *@print* 명령어로 텍스트를 출력합니다.

다음 일반 텍스트 라인의 예시를 봐 주세요.

```
Lorem ipsum[char Felix.Happy pos:75 wait:false] dolor sit amet.
```

위 구문은 실제 엔진에서는 다음과 같이 일련의 개별 명령으로 처리됩니다.

```
@print "Lorem ipsum" waitInput:false  
@char Felix.Happy pos:75 wait:false  
@print "dolor sit amet."
```

일반 텍스트 라인 내에서 ‘대괄호 문자’를 실제로 출력시키려면 백슬래시로 이스케이프 처리하세요.

```
Some text [ text inside brackets ]
```

위와 같은 구문은 실제로 아래와 같이 출력될 것입니다.

```
Some text [ text inside brackets ]
```

---

### 레이블 라인

*@goto* 명령어를 사용하여 naninovel 스크립트를 탐색할 때 레이블은 “앵커(기준)”로 사용됩니다. 레이블을 정의하려면 줄 시작 부분에 # 문자를 사용하고 그 뒤에 레이블의 이름을 붙입니다.

```
# Epilogue
```

그런 다음 *@goto* 명령을 사용하여 해당 라인으로 “점프”할 수 있습니다.

```
@goto ScriptName.Epilogue
```

@goto와 대상 레이블이 모두 동일한 스크립트에 있는 경우 스크립트 이름을 생략할 수 있습니다.

```
@goto .Epilogue
```

---

### 주석 라인

라인이 세미콜론 문자(“;”)로 시작하면 주석으로 간주됩니다.

스크립트가 구문 분석될 때 엔진은 주석 행을 완전히 무시합니다. 주석 문자를 사용하여 자기 자신이나 naninovel 스크립트로 작업하는 다른 팀 구성원을 위한 메모나 주석을 추가하세요.

```
; 다음 명령어는 게임을 자동 저장할 것입니다.
@save
```

---

### 조건부 실행

스크립트는 기본적으로 선형 방식으로 실행되지만 모든 명령에서 지원하는 *if* 매개변수를 사용하여 분기를 도입할 수 있습니다.

```
; level이 9000 초과일 때, 선택지를 추가합니다.
@choice "It's over 9000!" if:level>9000
```

```
; 'dead' 변수가 false라면, 해당 print 명령문을 실행합니다.
@print text:"I'm still alive." if:!dead
```

```
; 'glitch'가 참이거나, 1~10 사이의 값이 5 이상이면,
; @spawn 명령어를 실행합니다.
@spawn GlitchCamera if:"glitch || Random(1, 10) >= 5"
```

```
; 'score' 값이 7 이상 13 이하이거나 'lucky' 변수가 참이면,
; 'LuckyEnd' 스크립트를 로드합니다.
@goto LuckyEnd if:"(score >= 7 && score <= 13) || lucky"
```

```
; 도중에 삽입된 명령문으로 조건문을 실행할 수도 있습니다.
Lorem sit amet. [style bold if:score>=10]Consectetur elit.[style default]
```

```
; 조건문 내에 쌍따옴표를 썼다면 escape 문자를 붙이는 것을 잊지 마세요.
@print {remark} if:remark=="Saying "Stop the car" was a mistake."
```

*@if, @else, @elseif* 및 *@endif* 명령어를 사용하여 여러 라인의 조건부 블록을 지정할 수도 있습니다.

```
@if score>10
    Good job, you've passed the test!
    @bgm Victory
    @spawn Fireworks
@elseif attempts>100
    You're hopeless… Need help?
    @choice "Yeah, please!" goto:.GetHelp
    @choice "I'll keep trying." goto:.BeginTest
    @stop
@else
    You've failed. Try again!
    @goto .BeginTest
@endif
```

> #### 메모
>
> 위 예시의 탭은 가독성을 높이기 위해 사용되었으며 완전히 선택사항입니다. Naninovel은 명령줄과 레이블 줄 앞뒤의 모든 종류의 공백(공백, 탭 등)을 무시하므로 원하는 대로 형식을 지정할 수 있습니다.

---

## 메모리 관리

어떤 스크립트 명령어는 리소스를 불러와야 작동하는 케이스도 있습니다. 대표적으로 *@BGM* 명령어는 오디오 파일을, *@char* 명령어는 캐릭터 프리팹이나 텍스처를, *@movie* 명령어는 비디오 클립을 불러옵니다. 나니노벨이 리소스를 미리 불러오거나 언로딩하는 전반의 규칙은 ‘리소스 제공자 설정’ 내의 리소스 정책(*Resource Policy*)에서 관리되고 있습니다.

| 정책 | 설명 |
| --- | --- |
| Static (정적) | 스크립트 실행에 필요한 모든 리소스는 재생을 시작할 때(일반적으로 *@goto*) 미리 로드되고 스크립트 재생이 끝나면 언로드됩니다. 로딩 작업은 로딩 UI로 마스킹됩니다. 이 정책은 기본값이며 대부분의 경우에 권장됩니다. |
| Dynamic (동적) | 동적 정책 단계(*Dynamic Policy Steps*)는 명령어 실행에 필요한 리소스만 스크립트 실행 중에 미리 불러오고 사용되지 않는 모든 리소스는 즉시 언로드됩니다. 엄격한 메모리 제한이 있는 플랫폼으로 개발하거나, nanonovel 스크립트를 적절하게 구성하는 것이 불가능할 때 이 모드를 사용하세요. 게임이 진행되는 동안 리소스가 백그라운드에서 로드되면 버벅임이 발생할 수 있습니다. |

모든 경우에 리소스를 자동으로 언로드할 수 있는 건 아닙니다.

- layered
- diced sprite
- generic
- Live2D and Spine

위 액터는 정상 출력을 위해서는 monolith 프리팹을 필요로하기 때문에 리소스를 독립적으로 불러오지 못합니다. 메모리 누수를 방지하려면 아래 설명된 방법 중 하나를 사용하여 해당 리소스를 수동으로 언로드하세요.

### 선택한 액터 제거하기

특정 액터를 숨겨서 삭제하려면 *@hide* 명령어를 *remove* 매개변수와 함께 사용하세요. 일부 액터가 스크립트상 남아있어야하는 경우에 쓰입니다.

```
@back id:LayeredBackground
@char GenericCharacter
@char DicedCharacter
; LayeredBackground는 남기고, char 두 종을 삭제해야하는 경우의 예시
@hide GenericCharacter,DicedCharacter remove:true
@goto NextScript
```

### 모든 액터 제거하기

*@hideAll* 명령어를 *remove* 파라미터와 함께 사용해 현재까지 출력된 모든 액터(텍스트 출력기 및 선택지 포함)를 숨길 수 있습니다.

*@resetState*를 *only* 파라미터와 함께 사용해 특정 타입의 모든 액터를 즉시 숨김 처리도 가능합니다. 가령, *ICharacterManager나 IBackgroundManager*)를 즉시 삭제하려면 매개변수만 있는 *@resetState*를 사용하세요.

스크립트 로딩 시 모든 액터나 특정 타입의 액터가 존재해야하는 경우가 아닐 때 유용합니다.

…  
@goto NextScript  
; 현재 출력한 모든 배경 액터를 없앱니다.  
@resetState only:IBackgroundManager

### @goto 명령어를 쓸 때 자동으로 제거하기

스크립트 간 리소스가 유지될 필요가 없을 때, 예를 들면 현재 플레이중인 음악을 이어서 재생하거나 특정 이펙트가 출력되어야하는 경우가 아닌, 즉 [engine service](https://naninovel.com/guide/engine-services) 상태가 불필요하다면 *Reset On Goto* 옵션을 활성화하세요.

이렇게 하면 naninovel 스크립트 간 점프할 때 모든 모든 engine service 관련 리소스가 자동으로 삭제되므로 리소스를 언로드하기 위해 특별한 명령을 사용할 필요가 없습니다.

---

## 타이틀 스크립트

타이틀 스크립트는 스크립트 구성 메뉴에 할당된 특수한 나니노벨 스크립트입니다. 타이틀 스크립트에 할당되면 타이틀 UI(메인 메뉴)가 표시될 때 자동으로 로드됩니다. 타이틀 스크립트를 사용하여 타이틀 화면 씬(배경, 음악, 효과 등)을 설정할 수 있습니다.

스크립트는 플레이어가 “NEW GAME”, “EXIT” 또는 게임을 로드하기 위해 저장 슬롯을 클릭할 때 명령을 호출하는 데 사용될 수도 있습니다. 아래는 타이틀 스크립트의 예입니다.

```
; 아래의 명령어는 메인 메뉴(타이틀)에 들어갈 때 호출됩니다.
; 타이틀 UI가 표시될 때 동시에 타이틀 스크립트가 출력됩니다.
@back MainMenuBackground time:3 wait:false
@bgm MainMenuMusic wait:false
@spawn Rain wait:false
@stop
```

```
# OnNewGame
; 아래의 명령은 플레이어가 'NEW GAME'으로 게임을 시작할 때 실행됩니다.
; stopBGM 명령어는 대기되다가 새 게임이 시작되기 직전 완전히 멈춥니다.
@sfx NewGameSoundEffect wait:false
@stopBgm
@stop
```

```
# OnLoad
; 플레이어가 게임을 로드하기 전 아래의 명령이 실행됩니다.
@sfx LoadGameEffect
@wait 0.5
@stop
```

```
# OnExit
; 플레이어가 "EXIT"를 클릭했을 때 실행됩니다.
@sfx ExitGameEffect
@wait 1.5
@stop
```

---

## 비주얼 에디터

비주얼 스크립트 편집기를 사용하여 naninovel 스크립트를 편집할 수 있습니다. 스크립트 에셋을 선택하면 인스펙터(inspector) 창에 비주얼 에디터가 자동으로 세팅됩니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-ba57b9f78116e57408125325bdf66be9.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-ba57b9f78116e57408125325bdf66be9.mp4@main.mp4?_=1)

스크립트에 새 라인을 추가하려면 줄을 삽입하려는 위치에 마우스 오른쪽 버튼을 클릭하거나 ‘*Ctrl+Space*‘를 누르고 원하는 라인을 지정하거나 명령어를 선택하세요. (단축키는 입력 구성 메뉴에서 변경할 수 있습니다.) 라인의 순서를 바꾸려면 번호 라벨을 클릭해 원하는 위치로 드래그하세요. 라인을 제거하려면 해당 줄을 마우스 오른쪽 버튼으로 클릭하고 “제거(Remove)”를 선택하세요.

비주얼 에디터를 사용하여 스크립트를 변경한 경우 검사기 헤더의 스크립트 이름 위에 별표(‘\*’)가 표시됩니다. 이는 에셋이 수정되었다는 표시이며, 이를 유지하려면 저장해야 한다는 의미합니다. 수정된 내용을 저장하려면 ‘*Ctrl+S*‘를 누르세요. 스크립트가 편집된 상태에서 다른 에셋을 선택하려고 한다면 변경사항을 저장하거나 되돌릴 수 있는 대화 상자가 팝업됩니다.

외부 파일에서 내용을 수정해도 비주얼 에디터가 편집된 스크립트를 자동으로 동기화하므로 Words 등의 텍스트 편집기와 비주얼 에디터 양쪽에서 스크립트를 원활히 편집할 수 있습니다. 자동 동기화가 작동하지 않는 경우 *Edit -> Preferences -> General* Unity 편집기 메뉴에서 *Auto Refresh* 옵션이 활성화되어 있는지 확인하세요.

플레이 모드 중에 비주얼 에디터를 사용하여 현재 재생 중인 스크립트 라인을 추적하고 상황에 맞는 메뉴를 사용하거나, Shift 키를 누르고 원하는 라인을 클릭하여 재생중인 스크립트를 되감을 수 있습니다. 이 기능을 사용하려면 스크립트에 동일한 리소스 ID(리소스 관리자 메뉴에서 할당된 경우)와 에셋명이 있어야 합니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-b6e04d664ce4b513296b378b7c25be03.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-b6e04d664ce4b513296b378b7c25be03.mp4@main.mp4?_=2)

현재 재생 중인 라인은 녹색으로 강조 표시됩니다. 사용자 입력을 기다리느라 스크립트 재생이 중단되면 재생된 라인이 노란색으로 강조 표시됩니다.

에디터 동작을 편집하고 스크립트 구성 메뉴를 살펴볼 수 있습니다.

![나니노벨 Naninovel Scripts - 비주얼 에디터](https://subculturegamer.com/wp-content/uploads/2024/08/image-64.png)

---

## 스크립트 그래프

스크립트의 양이 많거나 비선형 스토리를 작업할 때 스토리 흐름을 시각적으로 표현하는 것이 편리할 수 있습니다. 이때 스크립트 그래프 도구가 유용할 수 있습니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-0dd3ec2393807fb03d501028e1526895.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-0dd3ec2393807fb03d501028e1526895.mp4@main.mp4?_=3)

스크립트 그래프를 열려면 *Naninovel -> Script Graph Editor* 메뉴를 사용하세요. 원하는 경우 창을 다른 편집기 패널처럼 도킹할 수 있습니다.

이 도구는 편집기 리소스(*Naninovel -> Resources-> Scripts*)와 이들 간의 연결을 통해 할당된 모든 naninovel 스크립트(노드로 표시됨)의 그래프 표현을 자동으로 구축합니다.

링크는 *@goto*, *@gosub* 및 *@choice*(*goto* 매개변수가 있는 경우) 명령어를 기반으로 생성됩니다. 명령에 조건식이 할당된 경우(*if* 매개변수) 노드의 해당 포트가 노란색으로 강조 표시되고 포트를 가리키면 표현식을 볼 수 있습니다.

노드를 두 번 클릭하거나 포트를 클릭하여 스크립트 에셋을 선택하고 비주얼 에디터를 열 수 있습니다. 지정된 레이블이 있는 경우 포트를 클릭하면 비주얼 에디터가 레이블이 포함된 라인으로 스크롤됩니다.

원하는 대로 노드 위치를 변경할 수 있습니다. 그래프 창을 닫거나 Unity를 종료할 때 해당 위치가 자동으로 저장돼, 창을 다시 열면 위치가 복원됩니다. “저장” 버튼을 클릭하여 수동으로 저장할 수도 있습니다. “자동 정렬” 버튼을 클릭하면 모든 위치가 재설정됩니다.

스크립트를 변경하거나 새 스크립트를 추가할 때 “그래프 재구성” 버튼을 클릭하여 동기화하세요.

스크립트 상단에 Comment Lines(주석 라인)이 있으면 관련 그래프 노드가 이를 개요로 표시합니다. 이를 비활성화하려면 스크립트 구성 메뉴에서 *Show Synopsis* 옵션을 비활성화하세요.

![나니노벨 Naninovel Scripts - 스크립트 그래프](https://subculturegamer.com/wp-content/uploads/2024/08/image-65.png)

---

## 핫 리로드

플레이 중에 비주얼 에디터나 외부 편집기로 스크립트를 편집하고 게임 재실행 없이 변경사항을 즉시 적용할 수 있습니다. 이 기능은 스크립트 구성의 *Hot Reload Scripts* 속성을 통해 제어되며 기본적으로 활성화됩니다.

현재 재생되고 있던 라인 이전에 라인을 추가, 수정 또는 삭제하는 경우, 상태 불일치를 방지하기 위해 수정된 라인에 상태 롤백이 자동으로 발생합니다.

핫 리로드가 작동하지 않는 경우 자동 새로 고침(*Auto Refresh*)이 활성화되어 있고 재생 중 스크립트 변경(*Script Changes While Playing*)이 다시 컴파일하고 계속 재생(*Recompile And Continue Playing*)으로 설정되어 있는지 확인하세요. 두 속성 모두 Unity 편집기 메뉴의 *Edit -> Preferences -> General*에서 찾을 수 있습니다.

![나니노벨 Naninovel Scripts - 핫 리로드](https://subculturegamer.com/wp-content/uploads/2024/08/image-66.png)

현재 재생 중인 naninovel 스크립트의 핫 리로드를 수동으로 시작하려면(예: Unity 프로젝트 외부에서 스크립트 파일을 편집하는 경우) *reload* [콘솔 명령](https://naninovel.com/guide/development-console)을 사용하세요. 이 명령은 에디터에서만 작동합니다(빌드에서는 작동하지 않음).

---

## IDE 지원

구문 강조(Syntax highlighting), 오류 검사(Error Checking), 자동 완성(Auto-completion) 및 인터랙티브 문서화(Interactive Documentation)과 같은 IDE 기능은 스크립트를 작성할 때 생산성을 크게 높일 수 있습니다.

나니노벨은는 VS Code 에디터에서 NaniScript 구문에 대한 필수적인 IDE 지원을 제공합니다. (Windows, MacOS, Linux 호환)

![나니노벨 Naninovel Scripts - IDE 지원](https://subculturegamer.com/wp-content/uploads/2024/08/image-67.png)

확장 설치 및 사용 방법에 대한 자세한 내용은 [IDE 확장 가이드](https://naninovel.com/guide/ide-extension)를 참조하세요.

---

## 스크립트 디버그

나니노벨 스크립트로 대규모 작업을 진행할 때 스크립트의 특정 부분이 어떻게 작동하는지 확인하기 위해 항상 처음부터 재생하는 것은 지루할 수 있습니다.

개발 콘솔([development console](https://naninovel.com/guide/development-console))을 사용하면 현재 재생 중인 스크립트를 임의의 줄로 즉시 “되감기”할 수 있습니다.

```
rewind 12
```

위 명령어는 12번째 라인부터 현재의 스크립트를 재생하기 위한 콘솔 명령어입니다.

같은 방법으로 앞으로 점프하거나 및 뒤로 되감을 수 있습니다. 게임이 실행되는 동안 콘솔을 열려면 엔진 구성에서 콘솔이 활성화되어 있는지 확인하고 ‘~’ 키를 누릅니다.(옵션에서 변경 가능)

스마트폰과 같은 터치스크린 장치에서 빌드가 실행 중인 경우, 3개 이상의 동시 터치를 수행하면 콘솔을 활성화할 수 있습니다.

현재 재생 중인 스크립트와 라인을 확인하려면 디버그 창을 사용하세요. 개발 콘솔에 debug를 입력하고 Enter 키를 눌러 창을 표시하세요.

![나니노벨 Naninovel Scripts - 스크립트 디버그](https://subculturegamer.com/wp-content/uploads/2024/08/image-68.png)

현재 재생 중인 스크립트 이름, 줄 번호, 명령(인라인) 인덱스가 창 제목에 표시됩니다. 자동 음성 기능(auto voiceing)이 활성화된 상태라면 해당 음성 클립의 이름도 표시됩니다. 제목을 드래그하여 창 위치를 변경할 수 있습니다. “Stop” 버튼을 누르면 스크립트 실행이 중단됩니다. 스크립트 플레이어가 중지된 상태에서 “Play” 버튼을 누르면 다시 실행됩니다. “Close” 버튼을 눌러 디버그 창을 닫을 수 있습니다.

디버그 창은 에디터와 플레이어의 빌드 모두에서 사용할 수 있습니다.

---

## 텍스트 식별자

[스크립트 현지화](https://naninovel.com/guide/localization#scripts-localization)나 [자동 음성](https://naninovel.com/guide/voicing#auto-voicing)과 같은 기능을 사용하려면 Naninovel 시나리오 스크립트로 작성된 텍스트를 다른 리소스와 연결해야 합니다.

예를 들어 관련 텍스트 대신 표시할 번역된 텍스트나 관련 텍스트가 인쇄될 때 재생할 음성 클립 등이 있습니다. 이것을 작동시키려면 각 텍스트에 고유한 식별자를 할당해야 합니다.

Naninovel은 기본적으로 스크립트 에셋을 로드할 때 콘텐츠 해시로 로컬라이즈 가능한 모든 텍스트를 자동으로 식별합니다. 이 기능은 텍스트를 수정하지 않는 한 문제 없이 작동합니다. 만약 텍스트를 수정한다면 모든 연결이 끊어집니다. 자동 보이스 클립을 다시 매핑하거나 변경된 텍스트를 다시 번역해야 합니다.

텍스트를 편집할 때 연결이 끊어지는 것을 방지하려면 스크립트 구성 메뉴에서 *Stable Identification* 옵션을 활성화하세요. 이 옵션은 Naninovel이 가져온 스크립트의 현지화 가능한 각 텍스트에 고유 ID를 명시적으로 기록합니다. 단점은 이제 스크립트 텍스트에 현지화 가능한 각 매개변수에 ID가 추가된다는 것입니다. 아래의 예시를 봐 주세요.

```
Kohaku: Hey!|#1|[i] What's up?|#2|  
@choice "Option 1|#3|"  
@choice "Option 2|#4|"
```

대신, 그 대가로 ID를 제거하거나 변경하지 않는 한 연결은 끊어지지 않습니다. 시각적으로 산만해보이지 않기 위해 IDE 확장기(extension)와 비주얼 에디터에서는 흐리게 표시됩니다.

Stable Identification이 활성화되면 시스템은 생성된 모든 텍스트 ID가 고유한지, 이전에 스크립트 문서 내에서 사용된 적이 없는지 확인합니다.

이를 위해 *NaninovelData/ScriptRevisions* 에디터 에셋에 최신 리비전 넘버를 저장합니다. 수동으로 지정하지 않는 한, 이전에 할당된 적이 있는 텍스트 ID 라인을 제거할 때마다 이 ID가 원치 않는 위치에 갑자기 출력되지 않게 할 수 있습니다.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)