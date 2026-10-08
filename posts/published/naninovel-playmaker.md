---
title: "나니노벨 Playmaker"
url: https://subculturegamer.com/naninovel-playmaker/
published: 2024-10-12
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Playmaker](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-Playmaker-1024x538.png)

나니노벨 Playmaker

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/playmaker)

---

[PlayMaker](https://assetstore.unity.com/packages/tools/visual-scripting/playmaker-368)는 프로그래머가 아닌 사람들에게도 친숙하도록 특별히 설계된 인기 있는 Unity용 비주얼 스크립팅 도구입니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-playmaker-2.avif)
> **메모**
>
> 서드파티 확장 기능은 주로 Naninovel을 다른 도구와 통합하는 방법에 대한 예시로 활용됩니다. 최소한의 기능만 포함되어 있으며 서드파티에서의 변경점 발생 시 Naninovel과 호환되지 않을 수 있습니다. 이러한 확장 기능을 Naninovel의 일부로 생각하지 마십시오. 샘플 프로젝트 범위를 넘어선 Naninovel에서 확장 기능 사용법에 관한 지원이나 도움은 제공되지 않습니다.

---

## 설치

[공식 매뉴얼](https://hutonggames.fogbugz.com/default.asp?W11')의 지침에 따라 PlayMaker를 설치하세요.

[PlayMaker 확장 패키지](https://github.com/naninovel/samples/raw/main/unity/playmaker/NaninovelPlayMaker.unitypackage)를 다운로드하고 임포트합니다.

커스텀 Naninovel 작업 시 PlayMaker 작업 브라우저에 있는 ‘Naninovel’ 카테고리에 표시되어야 합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-playmaker-1.avif)

---

## 사용방법

다음 영상은 PlayMaker FSM(유한 상태 머신)을 사용하여 Naninovel 엔진을 초기화하고 시나리오 스크립트를 미리 로드하고 재생하는 방법을 보여줍니다.

### 이벤트

필수 Naninovel 이벤트 중 일부는 자동으로 PlayMaker FSM으로 라우팅됩니다. 이를 위해 적절한 이름으로 [전역 사용자 이벤트](https://hutonggames.fogbugz.com/default.asp?W148)를 생성하고 FSM 내에서 사용합니다.

사용 가능한 이벤트 이름은 다음과 같습니다.

- `Naninovel/Engine/OnInitialized`
- `Naninovel/ScriptPlayer/OnPlay`
- `Naninovel/ScriptPlayer/OnStop`
- `Naninovel/StateManager/OnGameSaveStarted`
- `Naninovel/StateManager/OnGameSaveFinished`
- `Naninovel/StateManager/OnGameLoadStarted`
- `Naninovel/StateManager/OnGameLoadFinished`
- `Naninovel/TextPrinterManager/OnPrintTextStarted`
- `Naninovel/TextPrinterManager/OnPrintTextFinished`
- `Naninovel/LocalizationManager/OnLocaleChanged`

@playmaker 명령을 사용하여 naninovel 스크립트에서 맞춤 PlayMaker 이벤트를 브로드캐스트하는 것도 가능합니다.

아래 명령어는 씬의 모든 활성 FSM에서 ‘EventName’이라는 전역 사용자 이벤트를 호출합니다.

```
@playmaker EventName
```

이 명령어(@playmaker)로 fsm 및 오브젝트 매개변수를 사용하여 특정 FSM에 이벤트를 보낼 수도 있습니다.

@playermaker 명령어에서 첫 번째 매개변수를 사용하면 이벤트를 수신해야 하는 FSM 이름을 지정할 수도 있습니다.

```
;'EventName'이라는 이벤트를 'fsm1, 'fsm2'라는 FSM들에서 호출합니다.
@playmaker EventName fsm:Fsm1,Fsm2
```

개체 매개변수가 지정된 경우에는 이벤트는 해당 이름을 가진 FSM, 즉 해당 게임 오브젝트에만 FSM으로 적용됩니다.

```
; 이름이 'Obj1' 및 'Obj2'인 게임 오브젝트에 연결된 모든 FSM에서 'EventName' 이벤트를 호출합니다.

@playmaker EventName object:Obj1,Obj2
```

fsm과 오브젝트 매개변수를 결합해 이벤트를 수신해야 하는 FSM을 더 자세히 필터링할 수도 있습니다.

### 전역 변수

확장 패키지에서 사용할 수 있는 다음 커스텀 [표현식 기능](https://naninovel.com/guide/script-expressions.html#expression-functions)을 사용하여 Naninovel 스크립트의 전역 PlayMaker 변수에 액세스할 수 있습니다.

- `GetPlayMakerGlobalVariable("variableName")` — ‘variableName’ 이름을 가진 단순 유형(int, float, string 등)의 변수를 검색합니다.
- `GetPlayMakerGlobalArray("variableName", arrayIndex)` — ‘variableName’ 이름을 가진 배열 변수의 ‘arrayIndex’ 인덱스에 저장된 값을 검색합니다.

정수형 ‘Score’ 변수와 와 ‘FinishedRoutes’ 불린 배열 전역 PlayMaker 변수가 있는 경우 다음과 같이 Naninovel 스크립트에서 사용할 수 있습니다.

```
Felix: 내 점수는 {GetPlayMakerGlobalVariable("Score")} 이야.

@if GetPlayMakerGlobalArray("FinishedRoutes",2)
세 번째 경로 (두 번째 배열 인수)가 완료되었습니다.
@else
아직 완료되지 않았습니다.
@endif
```

Naninovel 스크립트에서 PlayMaker 전역 변수 값을 할당하려면 다음과 같이 @pset 명령을 사용하십시오.

; ‘Score’라는 PlayMaker의 정수형 전역 변수에 ’10’을 할당합니다.  
@pset name:Score value:10

; PlayMaker 전역 배열 ‘Groceries’의 10번째 인덱스에 ‘Banana’를 할당합니다.  
@pset name:Groceries index:10 value:Banana

---

## IDE 확장

확장 패키지(예: @playmaker)와 함께 배포되는 Playmaker 관련 명령에 대한 IDE 지원을 추가하려면 사용자 지정 명령에 대한 [메타데이터 생성 가이드](https://naninovel.com/guide/custom-commands#ide-metadata)를 참조하세요.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)