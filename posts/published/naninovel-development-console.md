---
title: "나니노벨 Development Console"
url: https://subculturegamer.com/naninovel-development-console/
published: 2024-10-12
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Development Console](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-Development-Console-1024x538.png)

나니노벨 Development Console

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/development-console)

---

개발 콘솔은 인게임 UI로 정적 C# 메서드를 실행하는 데 사용됩니다.

기능을 활성, 비활성하려면 엔진 구성에서 *Enable Development Console* 속성을 사용합니다. 개발(디버그) 빌드에서만 기능을 사용하려면 같은 구성 메뉴에서 *Debug Only Console*을 활성화하세요.

게임 실행 중에 콘솔 UI를 표시하려면 개발 콘솔이 활성화되어 있는지 확인하고 ‘~(물결표)’ 키를 누르세요. 원한다면 ToggleConsole 바인딩 아래의 입력 구성에서 키를 변경할 수 있습니다.

C# 메서드를 콘솔에서 보이게 하려면 정적 메서드에 *ConsoleCommand* 특성을 추가합니다. 속성에는 선택적인 문자열 인수가 있어 바로가기를 설정할 수 있습니다.

```
[ConsoleCommand("debug")]  
public static void ToggleDebugInfo () => UI.DebugInfoGUI.Toggle();
```

콘솔에서 전체 메서드 이름이나 숏컷(만약 적용된 경우)를 입력하고 Enter 키를 눌러 메서드를 실행합니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-bd41a9a8fff91eb575b235a6b641dcce.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-bd41a9a8fff91eb575b235a6b641dcce.mp4?_=1)

아래 명령어는 현재 지원되는 명령어 목록입니다.

| Command | 설명 |
| --- | --- |
| nav | naninovel 스크립트 내비게이터 UI를 토글(전환)합니다. |
| debug | naninovel 스크립트 디버그 창을 토글(전환)합니다. |
| var | 커스텀 변수 에디터 창을 토글(전환)합니다. |
| purge | 구글 드라이브 공급자가 쓰이고 있는 경우, 다운로드된 리소스 캐시를 퍼지(초기화)합니다. |
| play | 현재 불러온 naninovel 스크립트를 실행을 시작합니다. |
| stop | 현재 로드된 naninovel 스크립트의 실행을 중지합니다. |
| rewind (int) | 현재 로드된 naninovel 스크립트를 제공된 행 인덱스로 되돌립니다. 해당 줄은 명령이거나 일반 텍스트여야 합니다. 되감기할 때 해당 줄은 롤백 스택에 있어야 합니다. |
| reload | 현재 출력중인 nanovel 스크립트의 빠른 불러오기를 수행합니다. Unity 에디터에서만 작동합니다. |

---

## 명령어 실행하기

개발 콘솔에서도 스크립트 명령어를 불러올 수 있습니다.

naninovel 스크립트에서와 마찬가지로 명령어 문자열을 입력하면 즉시 실행됩니다. 무엇보다도 이는 커스텀 상태 변수를 디버깅하는 데 유용하게 쓰일 수 있습니다.

예를 들어 다음 명령어로 커스텀 변수의 현재 값을 출력시킬 수 있습니다.

```
@print {VariableName}
```

위 명령어는 디폴트 다이얼로그 출력기로 VariableName의 값을 출력시킵니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)