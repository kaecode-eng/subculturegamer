---
title: "나니노벨 Engine Architecture"
url: https://subculturegamer.com/naninovel-engine-architecture/
published: 2025-01-12
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

※원문 페이지: [(링크)](https://naninovel.com/guide/engine-architecture)

※마지막 수정일: 2025/1/12

---

나니노벨 엔진은 아래의 철학을 바탕으로 설계되었습니다.

- 씬 독립성
- 서비스 지향

---

## 씬 독립성

유니티 엔진은 씬과 프리팹 구성으로 게임을 디자인하는 것을 장려하지만 이는 비주얼 노벨 개발에 그다지 실용적이지 않습니다.

나니노벨의 시스템은 MonoBehaviour나 에 직접 바인딩되지 않으며 영구적인 루트 게임 오브젝트(persistent root GameObject)에 연결되지 않습니다.

환경에 따라 다음 루트 개체가 사용됩니다.

- 런타임: Naninovel<Runtime>
  - 에디터의 플레이 모드와 빌드용
- 에디터: Naninovel<Editor>
  - 플레이 모드 외

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-engine-architecture-1.avif)

모든 필수 게임 객체는 엔진 초기화(실행) 시 생성됩니다.

애플리케이션이 시작될 때(플레이 모드에 진입하거나 빌드를 실행한 직후) [RuntimeInitializeOnLoadMethod](https://docs.unity3d.com/ScriptReference/RuntimeInitializeOnLoadMethodAttribute.html)메서드를 통해 자동적으로 비동기적으로 실행됩니다.

초기설정을 임의로 정의하려면 [수동으로 초기설정하기 가이드](https://docs.unity3d.com/ScriptReference/RuntimeInitializeOnLoadMethodAttribute.html)를 참조하세요.

> **메모**
>
> 씬 독립성 설정이 필요 없다면, 나니노벨 엔진 구성 메뉴에서 씬 독립성(Scene Independent) 옵션을 비활성화하세요.
>
> 이렇게 하면 나니노벨의 관련 모든 객체도 씬에 종속됩니다. 씬을 시작하면 나니노벨이 초기화되며, 유니티 엔진 씬이 종료되면 나니노벨의 관련 데이터도 언로드됩니다.

---

## 서비스 지향

대부분의 엔진 기능은 엔진 서비스를 통해 구현됩니다. 엔진 서비스는 naninovel 스크립트 실행, 액터 관리 또는 게임 상태 저장 및 로드와 같은 특정 작업을 처리하는 *IEngineService* 인터페이스의 구현입니다.

엔진 시스템과 상호작용하려는 경우 엔진 서비스를 사용하고 싶을 가능성이 높습니다. *Engine.GetServiceTService()* 정적 메서드를 사용하여 엔진 서비스에 대한 레퍼런스를 얻을 수 있습니다. 여기서 *TService*는 얻고자 하는 서비스의 인터페이스입니다. 예를 들어 *IScriptPlayer* 서비스를 얻으려면 다음을 수행하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-4.png)

```
var player = Engine.GetService<IScriptPlayer>();
player.Stop();
```

나니노벨 [엔진 서비스 가이드](https://naninovel.com/guide/engine-services#engine-services)에서 현재 사용 가능한 모든 나니노벨 엔진 서비스 목록과 사용자 지정 나니노벨 엔진 서비스 덮어쓰기/추가하기 방법에 관한 정보를 확인할 수 있습니다.

---

## 상위 수준 개념

다음 UML 다이어그램은 나니노벨 엔진 아키텍처의 상위 수준 개념을 보여줍니다.

다이어그램의 모든 클래스와 인터페이스 이름은 Naninovel 네임스페이스 하에 구성되어 있습니다.

예를 들어 Engine 클래스를 참조하려면 Naninovel.Engine을 사용하거나 [네임스페이스](https://learn.microsoft.com/en-us/dotnet/csharp/fundamentals/types/namespaces)를 포함합니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/high-level-concept.png)

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)