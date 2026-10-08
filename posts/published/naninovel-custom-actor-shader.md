---
title: "나니노벨 Custom Actor Shader"
url: https://subculturegamer.com/naninovel-custom-actor-shader/
published: 2025-01-30
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

※원문 페이지: [(링크)](https://naninovel.com/guide/custom-actor-shader)

※마지막 수정일: 2025/1/30

---

대부분 캐릭터와 배경 액터(제네릭은 제외)를 렌더링 할 때 특수 셰이더는 반투명 오버드로우를 처리하는 등 다양한 트랜지션 효과 지원에 쓰입니다.

액터 구성 메뉴에서 *Custom Texture Material* 프로퍼티에 머테리얼을 할당하여 디폴트 쉐이더를 재구성할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-actor-shader.avif)

할당된 머테리얼에 쓰인 쉐이더는 특정 프로퍼티를 갖게 됨에 유의하세요.

*Naninovel/Resources/Naninovel/Shaders/TransitionAltexture*에서 기본 셰이더를 확인하여 레퍼런스로 삼으세요.

텍스처로 렌더링되지 않은 비 generic 구현의 경우, 액터가 씬에서 스프라이트로 표현되면 *Custom Sprite Material* 프로퍼티를 사용할 수 있습니다.

기본적으로 간단한 무제한 투명 셰이더가 사용됩니다. 조명 또는 표면 효과를 구현하려는 경우 사용자 정의 셰이더가있는 재료를 속성에 할당하십시오.

디폴트로써, 간단한 아직 불이 켜지지 않은 셰이더가 쓰입니다. 조명이나 표면 이펙트 구현을 하려는 경우에는 프로퍼티에 커스텀 셰이더 머테리얼을 할당하세요.

> **예시**
>
> [액터 셰이더 샘플](https://naninovel.com/guide/samples#actor-shader)을 확인해 보세요.
>
> 커스텀 트랜지션 효과와 스프라이트 셰이더의 라이팅 및 자체 일루미네이션 서포트 기능을 적용하기 위한 텍스터 셰이더 생성 및 사용 방법을 알 수 있습니다.
>
> 이로써 배경 액터의 하루의 시간의 변화를 시뮬레이션할 수 있습니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-a9d7fb29d5e076245ac515d673cc155e.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-a9d7fb29d5e076245ac515d673cc155e.mp4?_=1)

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)