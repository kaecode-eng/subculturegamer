---
title: "나니노벨 Choices"
url: https://subculturegamer.com/naninovel-choices/
published: 2024-10-06
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Choices](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-Choices-1-1024x538.png)

나니노벨 Choices

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/choices)

---

선택지 기능으로 플레이어에게 다양한 선택을 제공하거나 사용자 선택에 따른 분기형 스크립트를 제공할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-choices-5.avif)

naninovel 스크립트에서 선택지를 추가하려면 선택지 요약 텍스트 및 (옵션) *goto* 뒤에 경로명을 붙여서 @choice 명령어를 사용하세요.

```
; 텍스트를 출력하고 나서 바로 선택지를 표시하고 스크립트 실행을 중지합니다.

이 스크립트를 계속 실행하거나 다른 스크립트를 로드하시겠습니까?[skipInput]
@choice "다음 라인 이후부터 진행합니다."
@choice "특정 레이블 이름 뒤부터 진행합니다." goto:.Labelname
@choice "(현재의) 스크립트로부터 AnotherScript를 불러옵니다." goto:AnotherScript
@choice "(현재의) 스크립트로부터 AnotherScript의 lable부터 시작합니다." goto:AnotherScript.LabelName
@stop
```

goto 매개변수의 값은 플레이어가 특정 선택지를 선택했을 경우 점프하게 만들 경로입니다.

스크립트 이름은 *스크립트명.레이블명* 형식으로 지정됩니다. 레이블 이름을 생략하면 스크립트 첫 지점부터 플레이가 진행됩니다. 스크립트을 생략하면 현재 진행중인 스크립트의 레이블이 참조되어 진행됩니다.

```
; Script001 스크립트의 첫 지점부터 플레이합니다.
goto:Script001

; Script001 스크립트의 'AfterStorm' 레이블부터 플레이합니다.
goto:Script001.AfterStorm

; 현재 재생 중인 스크립트의 'Epilogue' 레이블부터 플레이합니다.
goto:.Epilogue
```

> **메모**
>
> [스크립트 가이드](https://naninovel.com/guide/naninovel-scripts#label-lines)에서 레이블에 대해 더 알아보세요.

goto 매개변수를 지정하지 않으면 현재 스크립트가 (선택지) 다음 라인부터 계속 실행됩니다.

선택지 처리기 액터는 @choice 명령을 처리하는 데 사용됩니다. *Naninovel -> Resources -> Choice Handlers* 컨텍스트 메뉴를 통해 액세스할 수 있는 선택 관리자를 사용하여 선택지 처리기를 추가하거나, 편집, 제거할 수 있습니다.

선택지 처리기 동작은 *Naninovel -> Configuration -> Choice Handlers* 컨텍스트 메뉴를 사용하여 구성할 수 있습니다. 사용 가능한 옵션은 구성 가이드를 참조하세요.

---

## 선택지 버튼

@choice 명령어는 선택지 옵션 개체에 해당하는 커스텀 프리팹의 경로를 특정하는 데 선택 버튼 매개변수로 쓰입니다. (“Resources” 폴더 내에서 상대적 위치로 참조됨.)

```
@choice handler:ButtonArea button:MapButtons/Home pos:-300,-300 goto:.HomeScene
```

특정 맵에서 어떤 지역을 선택하는 등의 위치 지정 선택지로서도 ‘선택지 처리기’가 쓰일 수 있습니다. 여기서 Button 매개변수는 각 프리팹 지점으로 연결되는 버튼으로써 활용됩니다. 여기서 프리팹은 Assets/Resources/MapButtons/Home.prefab에 저장됩니다.

템플릿에서 선택지 버튼 프리팹을 만들려면 Create -> Naninovel -> Choice Button 에셋 컨텍스트 메뉴를 사용하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-choices-4.avif)

선택지 버튼 프리팹을 리소스 폴더에 저장하고 싶지 않거나 로컬라이징해야 하는 경우, 선택지 처리기 구성 메뉴에서 커스텀 로더를 설정하고 사용 가능한 [리소스 공급자](https://naninovel.com/guide/resource-providers)를 사용하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-choices-3.avif)

@choice 명령어에 *button* 매개변수를 지정하지 않으면 디폴트 버튼 프리팹이 사용됩니다.

기본적으로 사용되는 선택지 버튼을 변경하려면 커스텀 선택지 처리기를 생성하고 *Choice Handler Panel* 구성 요소의 *Default Button Prefab* 속성에 프리팹을 할당하거나 커스텀 구성 요소를 사용합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-choices-2.avif)

선택지 텍스트에 다른 텍스트 컴포넌트를 사용하려면 선택지 버튼 컴포넌트의 *On Summary Text Changed* [Unity 이벤트](https://docs.unity3d.com/Manual/UnityEvents)를 사용하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-choices-1.avif)

---

## 버튼 리스트 선택지 처리기

버튼 리스트 처리기가 디폴트로 사용됩니다.

선택지 버튼을 가로 레이아웃 패널에 저장하고 @choice 명령어의 *pos* 매개변수를 무시합니다.

---

## 버튼 영역 선택지 처리기

버튼 리스트 선택지와 달리, 버튼 영역 선택지 처리기는 특정 레이아웃을 적용하지 않습니다.

*pos* 매개변수를 통해 추가된 선택 버튼의 위치를 ​​수동으로 설정할 수 있습니다.

예를 들어, 선택지 명령어와 버튼 영역 선택지 핸들러를 사용하여 대화형 지도를 만드는 한 가지 방법은 다음과 같습니다.

```
# Map
@back Map
@hidePrinter
@choice handler:ButtonArea button:MapButtons/Home pos:-300,-300 goto:.HomeScene
@choice handler:ButtonArea button:MapButtons/Shop pos:300,200 goto:.ShopScene
@stop

# HomeScene
@back Home
Home, sweet home!
@goto .Map

# ShopScene
@back Shop
Don't forget about cucumbers!
@goto .Map
```

> **예시**
>
> GitHub의 [맵 샘플 프로젝트](https://github.com/naninovel/samples/tree/main/unity/map)에서 Naninovel을 사용한 인터랙티브 맵의 고급 구현을 찾아보세요.

---

## 채팅형 선택지 처리기

Chat 다이얼로그에서 선택지를 처리할 때 사용하는 방법의 예시입니다.

```
@printer Chat  
Kohaku: Where're you right now?  
@choice "Play dumb" handler:ChatReply do:"Yuko: ¯_(ツ)_/¯"  
@choice "Answer" handler:ChatReply do:"Yuko: school. preping for the festival"  
@stop
```

[<https://naninovel.com/imgit/encoded/i.gyazo.com-338f8519b3a1656059a407fe0232b376.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-338f8519b3a1656059a407fe0232b376.mp4@main.mp4?_=1)

---

## 커스텀 선택지 처리기

내장 템플릿을 기반으로 커스텀 선택지 처리기를 추가하거나 처음부터 새 처리기를 만드는 것도 가능합니다.

예를 들어 빌트인 버튼 영역 선택지 처리기 템플릿을 커스터마이징해 보겠습니다.

*Create – Naninovel – Choice Handler – ButtonArea* 에셋 컨텍스트 메뉴를 사용하여 Naninovel 패키지 외부 어딘가에 버튼 영역 핸들러 프리팹을 생성합니다. *Assets/ChoiceHandlers* 폴더에 있습니다.

- 처리기 편집: 글꼴, 텍스처 변경, 애니메이션 추가 등. 사용 가능한 UI 구축 도구에 대한 자세한 내용은 [Unity 문서](https://docs.unity3d.com/Packages/com.unity.ugui@latest)를 확인하세요.

*Naninovel -> Resources -> Choice Handlers* 에디터 컨텍스트 메뉴로 액세스할 수 있는 선택지 처리기 관리자 GUI를 사용하여 엔진 리소스에 처리기를 표시합니다.

‘+(더하기) 버튼’을 사용하여 새 레코드를 추가하고 액터 ID(프리팹 이름과 다를 수 있음)를 입력한 다음 레코드를 두 번 클릭하여 액터 설정을 엽니다. 처리기 프리팹을 *Resource* 필드로 드래그 앤 드롭합니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-cb3a0ff7f22b22cec6546acb388719fc.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-cb3a0ff7f22b22cec6546acb388719fc.mp4@main.mp4?_=2)

이제 @choice 명령어의 핸들러 매개변수에 ID를 지정하여 새로운 선택지 처리기를 사용할 수 있습니다.

```
@choice "Choice summary text." handler:MyNewHandler
```

> **예시**
>
> GitHub의 UI 샘플에서 파티클 시스템을 사용해 커스텀 선택지 처리기를 만드는 예를 찾아보세요.

*IChoiceHandlerActor* 인터페이스를 수동으로 구현하여 처음부터 선택 핸들러를 생성하는 것도 가능합니다. 자세한 내용은 [커스텀 액터 구현](https://naninovel.com/guide/custom-actor-implementations)에 대한 가이드를 참조하세요.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)