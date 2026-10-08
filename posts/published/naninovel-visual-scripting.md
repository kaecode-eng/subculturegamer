---
title: "나니노벨 Visual Scripting"
url: https://subculturegamer.com/naninovel-visual-scripting/
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

※원문 페이지: [(링크)](https://naninovel.com/guide/visual-scripting)

---

비주얼 스크립팅(Visual Scripting;구 명칭 Bolt)은 Unity 2021 및 최신 버전에 기본적으로 번들로 제공되는 내장 패키지입니다.

프로그래머와 비프로그래머 모두 코드를 작성하지 않고도 사용할 수 있는 유닛 기반 그래프로 게임이나 애플리케이션에 대한 로직을 짤 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-visual-scripting-7.avif)

---

## 설치

먼저, 호환되는 Unity 버전(2021.2 이상)을 사용하고 있고 Visual Scripting 패키지가 패키지 관리자에 설치되어 있는지 확인하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-visual-scripting-6.avif)

‘Visual Scripting’ 프로젝트 설정 메뉴에 있는 *Node Library* 목록에 *Elringus.Naninovel.Runtime* 라이브러리를 추가합니다. 이는 엔진 유형과 API를 비주얼 스크립팅 그래프에 노출하는 데 필요합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-visual-scripting-5.avif)

‘비주얼 스크립팅’은 라이브러리에서 사용 가능한 모든 타입을 자동으로 노출하지 않습니다.

따라서 동일한 설정 메뉴에 있는 *Type Options* 목록에서 필요한 Naninovel 유형을 추가해주어야 합니다.

아래 예에서는 엔진 및 *Script Player Interface*를 추가하는 예시를 시연하기는 하나, 다른 [엔진 서비스 인터페이스](https://naninovel.com/guide/engine-services), 구성 등과 같은 더 많은 유형의 추가가 동반되어야 할 것입니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-visual-scripting-4.avif)

변경 사항 적용하려면 라이브러리와 유형을 추가한 후 유닛을 다시 생성해주어야 합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-visual-scripting-3.avif)

---

## 사용방법

Naninovel 라이브러리와 타입이 비주얼 스크립팅 설정에 추가되면 그래프 보기 아래의 퍼지 파인더에서 엔진 API를 사용할 수 있으며 다른 Unity 또는 타사 API와 동일한 방식으로 사용할 수 있습니다.

아래는 엔진 초기화 및 스크립트 재생 예시입니다. 이 예제를 시도하기 전에 *Initialize On Application Load* 및 *Show Title UI*를 비활성화해야 합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-visual-scripting-2.avif)

시나리오 스크립트에서 비주얼 스크립팅 그래프 또는 상태 머신으로 이벤트를 보내고 싶을 수 있습니다.

아래는 제공된 이름을 가진 게임 개체를 찾고 지정된 이름과 인수를 가진 이벤트를 보내는 사용자 지정 명령의 예입니다.

```
using Naninovel;
using Naninovel.Commands;
using Unity.VisualScripting;
using UnityEngine;

[CommandAlias("bolt")]
public class BroadcastBoltEvent : Command
{
[ParameterAlias("object"), RequiredParameter]
public StringParameter GameObjectName;
[ParameterAlias("name"), RequiredParameter]
public StringParameter EventName;
[ParameterAlias("args")]
public StringListParameter Arguments;

public override UniTask ExecuteAsync (AsyncToken asyncToken = default)
{
    var gameObject = GameObject.Find(GameObjectName);
    if (gameObject == null)
    {
        Debug.LogError($"Failed to find `{GameObjectName}` game object.");
        return UniTask.CompletedTask;
    }

    CustomEvent.Trigger(gameObject, EventName, Arguments);

    return UniTask.CompletedTask;
}
}
```

프로젝트 Assets 디렉터리에 저장된 새 C# 스크립트에 내용을 복사-붙여넣기만 하면 명령어가 자동으로 사용 가능해지며 다음과 같이 사용할 수 있습니다.

; 제공된 인수를 사용하여 `MyEvent`를 `ExampleEvent` 게임 개체로 보냅니다.  
@bolt object:ExampleEvent name:MyEvent args:ExampleMessage,Script002

다음은 예제 그래프입니다. 이 그래프를 예제이벤트 게임 오브젝트에 연결하면 메시지가 출력되고 지정된 스크립트 재생이 시작됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-visual-scripting-1.avif)
> **예시**
>
> 앞서 언급한 그래프와 테스트 스크립트가 모두 포함된 예제 프로젝트는 GitHub ↗에서 확인할 수 있습니다. Naninovel은 프로젝트와 함께 배포되지 않으므로 처음 열면 컴파일 오류가 발생합니다. 문제를 해결하려면 Asset Store에서 패키지를 가져오세요.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)