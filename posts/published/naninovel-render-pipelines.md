---
title: "나니노벨 Render Pipelines"
url: https://subculturegamer.com/naninovel-render-pipelines/
published: 2025-02-16
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’ 나니노벨 Render Pipelines의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/render-pipelines)

※마지막 수정일: 2025/2/16

---

나니노벨에서는 유니티의 스크팁트 가능한 렌더 파이프라인(SRP) – URP와 HDRP 포함 – 을 사용할 수 있지만 추가 설정이 뒤따라야 하며 일부 기능은 지원되지 않을 수 있습니다.

> **메모**
>
> SRP는 여전히 생산적이지 않으며 디폴트 렌더링 시스템에 비해 기능이 부족합니다.
>
> 렌더 파이프라인 기능을 사용하는 건 당신이 상당한 숙련자이고 어떠한 잠재적인 이슈와 한계를 극복할 수 있다는 준비가 되어있지 않다면 권장하지 않습니다. 나니노벨은 SRPs의 기본 영역을 벗어나는 어떠한 엔진 기능에 관한 지원이나 안내는 제공해드리기 어렵습니다.

## 설치

선택한 SRP를 설치하고 구성하는 방법은 [공식 문서](https://docs.unity3d.com/Manual/render-pipelines.html)를 참고하세요.

URP를 사용하는 경우 기본 설정 과정에서 나니노벨에 관한 구성은 필요없습니다.

HDRP는 카메라 스태킹을 지원하지 않으므로 카메라 구성 메뉴에서 *User UI Camera* 설정을 비활성화해야 합니다. (기본 설정은 활성화 상태)

![나니노벨 Render Pipelines - 설치](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-render-pipeline-2.avif)

HDRP에서 실행될 때는 컬러 스페이스를 선형(linear)으로 변경하십시오. HDRP는 새 유니티 프로젝트를 만들 때 기본적으로 설정되는 감마 모드를 지원하지 않습니다.

![나니노벨 Render Pipelines - 설치 2](https://subculturegamer.com/wp-content/uploads/2025/02/나니노벨-render-pipeline-1.avif)

---

## 한계

피사계 심도, 디지털 글리치 및 @trans 명령어와 같은 일부 내장 효과 및 기능은 필요한 렌더링 기능이 없기 때문에 SRPs와 호환되지 않을 수 있습니다.

나니노벨의 소스 코드나 패키지 콘텐츠를 수정하지 않고도 다양한 핵을 이용해 적절하게 설정되지 못한 이펙트나 피처 대다수를 교체하는 건 가능합니다. 자세한 내용은 special effects나 custom commands 가이드 문서로부터 엔진 확장에 관한 더 많은 정보를 얻을 수 있습니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)[## 나니노벨 Custom Script Parser](https://subculturegamer.com/naninovel-custom-script-parser/)