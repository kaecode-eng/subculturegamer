---
title: "나니노벨 Compatibility"
url: https://subculturegamer.com/naninovel-compatibility/
published: 2024-10-20
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

※원문 페이지: [(링크)](https://naninovel.com/guide/compatibility)

---

## 유니티 버전

- 지원되는 Unity 버전 범위: 2019.4 – 2022.3.

- 해당 범위에 있는 관련 [LTS 스트림](https://unity.com/releases/lts-vs-tech-stream)의 최신 패치만 지원됩니다. 알파, 베타 및 LTS가 아닌 릴리스(예: 2021.1 또는 2022.2)는 지원되지 않습니다. 작동할 수도 있지만 Naninovel 사용에 대한 지원은 제공할 수 없습니다.
- 권장 Unity 버전은 [2019.4.40](https://unity3d.com/unity/whats-new/2019.4.40)입니다.

> **팁**
>
> Unity가 LTS 패치(주요 릴리스는 물론)에서도 회귀를 도입하는 것은 드문 일이 아니므로 최종 상태에 있고 일반적인 VN 개발과 관련된 알려진 버그가 없는 2019.4.40을 권장합니다. 2020년과 2021년은 안정성과 성능 회귀로 어려움을 겪는 것으로 알려져 있습니다. 최신 Unity 버전이 필요한 경우 2022.3을 사용하세요.

향후 Unity 릴리스(LTS 상태에 도달하면)와의 호환성 문제는 다음 Naninovel 릴리스에서 해결될 예정입니다. 이전 Naninovel 릴리스와 호환되는 Unity 버전은 [변경 로그](https://github.com/naninovel/docs/releases)에 지정되어 있습니다.

---

## UPM 패키지

검증된 패키지 버전만 지원됩니다. Unity 패키지 관리자를 통해 패키지를 설치하거나 업데이트할 때 현재 사용 중인 Unity 버전에 대한 ‘verified’ 라벨이 있는지 확인하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-compatibility-2.avif)

---

## 플랫폼

모든 엔진 기능은 크로스 플랫폼 API를 사용하여 구현되며 Unity가 대상으로 삼을 수 있는 모든 플랫폼과 호환될 것으로 예상됩니다.

다음 플랫폼은 호환성 테스트를 거쳤으며 공식적으로 지원됩니다.

- 스탠드얼론: 윈도우, 맥, 리눅스
- 모바일: iOS, 안드로이드
- 웹: WebGL
- 콘솔: 닌텐도 스위치

> **메모**
>
> Unity는 다양한 다른 플랫폼(PlayStation, Xbox, Stadia 등)에 대한 빌드를 허용하지만 플랫폼별 SDK에 대한 액세스는 등록된 개발자에게만 제한되므로 일부 기능(예: 저장 시스템)이 기본적으로 작동하지 않을 수 있습니다. 우리는 그러한 SDK에 대한 액세스 권한이 없으며 위 목록에 없는 플랫폼에 대한 지원을 제공할 수 없습니다. [아티클](https://unity.com/how-to/develop-console-video-games-unity)에서 게임 콘솔 개발에 대한 자세한 내용을 찾아보세요.

---

## 플레이 모드 진입

Naninovel은 프로젝트 설정의 ‘플레이 모드 설정 입력’ 카테고리에서 *Reload Domain* 및 *Reload Scene* 옵션을 모두 비활성화하는 것을 지원합니다. 옵션을 비활성화하면 특히 대규모 프로젝트에서 재생 모드로 들어가는 시간이 단축됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-compatibility-1.avif)

---

## 렌더 파이프라인

Unity의 [스크립팅 가능한 렌더 파이프라인](https://docs.unity3d.com/Manual/render-pipelines.html)(URP 및 HDRP 모두)과 함께 Nanionvel을 사용하는 것이 가능하지만 일부 내장 기능은 기본적으로 작동하지 않을 수 있으며 이러한 경우 지원을 제공할 수 없습니다. 자세한 내용은 [렌더 파이프라인 가이드](https://naninovel.com/guide/render-pipelines)를 참조하세요.

## 텍스트

레거시(uGUI) 텍스트 구성 요소는 내장 UI 또는 관련 API에서 지원되지 않습니다. TextMesh Pro ↗가 기본적으로 사용됩니다.

## 스트리핑 관리

‘중간’ 및 ‘높음’ 관리 [바이트코드 스트리핑 프로필](https://docs.unity3d.com/Manual/ManagedCodeStripping.html)은 지원되지 않습니다. 스트리핑을 비활성화하거나 ‘낮음’ 프로필(기본적으로 선택됨)을 사용하십시오.

## 예외

‘게시 설정’의 *Enable Exceptions* 옵션에는 최소한 ‘명시적으로 발생한 예외만’ 수준이 필요합니다(기본적으로 선택됨). 이 설정은 [WebGl 빌드](https://docs.unity3d.com/Manual/webgl-building)에만 적용됩니다. ‘None’ 단계에서는 지원되지 않습니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)