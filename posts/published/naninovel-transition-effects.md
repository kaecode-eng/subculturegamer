---
title: "나니노벨 Transition Effects"
url: https://subculturegamer.com/naninovel-transition-effects/
published: 2024-09-29
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Transition Effects](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-transition-effects.png)

나니노벨 Transition Effects

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/transition-effects)

---

@back 및 @char 명령어로 각각 배경 및 캐릭터 외양을 변경하거나 @startTrans 및 @finishTrans 명령을 사용하여 씬 전환 시 전환 효과를 추가로 지정할 수 있습니다.

예를 들어 다음 명령은 ‘DropFade’ 전환 효과를 사용하여 ‘River’ 배경으로 전환됩니다.

```
@back River.DropFade
```

전환 효과가 지정되지 않으면 기본적으로 크로스페이드가 사용됩니다. (Fade Out – Fade In)

time 매개변수를 사용하여 전환 기간(초)을 지정할 수도 있습니다.

```
@back River.DropFade time:1.5
```

위 명령문은 1.5초에 걸쳐 ‘DropFade’ 전환을 사용하여 ‘River’ 배경으로 전환됩니다. 모든 전환의 디폴트 시간은 0.35초입니다.

전환 시 전환 효과가 지속되는 것을 기다리는 대신 즉시 다음 명령을 실행하고 싶다면 wait 매개변수를 false로 설정하면 됩니다. 예:

```
@back River.Ripple time:1.5 wait:false  
@bgm PianoTheme
```

— 위 명령어는 배경 전환 1.5초를 대기하는 대신, ‘PianoTheme’ 배경 음악 즉시 재생시킵니다.

일부 전환 효과는 *params* 매개변수로 제어할 수 있는 추가 매개변수도 지원합니다.

```
@back River.Ripple params:10,5,0.02
```

— Ripple 효과의 빈도를 10으로, 속도를 5로, 진폭을 0.02로 설정합니다. 매개변수를 지정하지 않으면 기본 매개변수가 사용됩니다.

선택 매개변수를 수정하려면 다른 매개변수를 비워두면 됩니다. 비워진 값에는 기본값이 적용됩니다.

```
@back River.Ripple params:,,0.02
```

모든 트랜지션 매개변수는 10진수입니다.

위의 예는 캐릭터에도 적용됩니다. 스탠드얼론 transition 매개변수를 통해 트랜지션을 제공하기만 하면 됩니다.

```
@char CharID.Appearance transition:TransitionType params:…
```

아래 문서에서 해당 매개변수 및 기본값과 함께 사용 가능한 전환 효과를 찾을 수 있습니다.

---

## 빌트인 트랜지션

### BandedSwirl

[<https://naninovel.com/imgit/encoded/i.gyazo.com-37432ac584ef04d94d3e4f9535fdffc4.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-37432ac584ef04d94d3e4f9535fdffc4.mp4@main.mp4?_=1)

**Parameters**

| Name | Default |
| --- | --- |
| Twist amount | 5 |
| Frequency | 10 |

```
; 디폴트 파라미터로 트랜지션
@back Appearance.BandedSwirl

; 파라미터 적용 예시
@back Appearance.BandedSwirl params:,2.5
```

### Blinds

[<https://naninovel.com/imgit/encoded/i.gyazo.com-73a259f2a513a92ef893ebd6a25e9013.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-73a259f2a513a92ef893ebd6a25e9013.mp4@main.mp4?_=2)

**Parameters**

| Name | Default |
| --- | --- |
| Count | 6 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Blinds

; 파라미터 적용 예시
@back Appearance.Blinds params:30
```

### CircleReveal

[<https://naninovel.com/imgit/encoded/i.gyazo.com-4f914c6741a5e48a22cafe2ab242a426.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-4f914c6741a5e48a22cafe2ab242a426.mp4@main.mp4?_=3)

**Parameters**

| Name | Default |
| --- | --- |
| Fuzzy amount | 0.25 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.CircleReveal

; 파라미터 적용 예시
@back Appearance.CircleReveal params:3.33
```

### CircleStretch

[<https://naninovel.com/imgit/encoded/i.gyazo.com-f09bb69a3c045eeb1f6c8ec0b9dcd790.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-f09bb69a3c045eeb1f6c8ec0b9dcd790.mp4@main.mp4?_=4)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.CircleStretch
```

### CloudReveal

[<https://naninovel.com/imgit/encoded/i.gyazo.com-618ec451a9e10f70486db0bb4badbb71.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-618ec451a9e10f70486db0bb4badbb71.mp4@main.mp4?_=5)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.CloudReveal
```

### Crossfade

[<https://naninovel.com/imgit/encoded/i.gyazo.com-dc4781a577ec891065af1858f5fe2ed1.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-dc4781a577ec891065af1858f5fe2ed1.mp4@main.mp4?_=6)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Crossfade
```

### Crumble

[<https://naninovel.com/imgit/encoded/i.gyazo.com-e27c8477842a2092728ea0cc1ae76bda.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-e27c8477842a2092728ea0cc1ae76bda.mp4@main.mp4?_=7)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Crumble
```

### Dissolve

[<https://naninovel.com/imgit/encoded/i.gyazo.com-b2993be8de032a65c7d813c6d749e758.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-b2993be8de032a65c7d813c6d749e758.mp4@main.mp4?_=8)

**Parameters**

| Name | Default |
| --- | --- |
| Step | 99999 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Dissolve

; 파라미터 적용 예시
@back Appearance.Dissolve params:100
```

### Dissolve

**Parameters**

| Name | Default |
| --- | --- |
| Step | 99999 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Dissolve

; 파라미터 적용 예시
@back Appearance.Dissolve params:100
```

### DropFade

[<https://naninovel.com/imgit/encoded/i.gyazo.com-3c3840bb311ccb9fe223960f2e46f800.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-3c3840bb311ccb9fe223960f2e46f800.mp4@main.mp4?_=9)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.DropFade
```

### LineReveal

[<https://naninovel.com/imgit/encoded/i.gyazo.com-c0e5259cd3d4ed2016ab74a65a7eec63.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-c0e5259cd3d4ed2016ab74a65a7eec63.mp4@main.mp4?_=10)

**Parameters**

| Name | Default |
| --- | --- |
| Fuzzy amount | 0.25 |
| Line Normal X | 0.5 |
| Line Normal Y | 0.5 |
| Reverse | 0 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.LineReveal

; 세로선 슬라이드 트랜지션
@back Appearance.LineReveal params:,0,1

; 방향 반대로 트랜지션 (R T L)
@back Appearance.LineReveal params:,,,1
```

### Pixelate

[<https://naninovel.com/imgit/encoded/i.gyazo.com-0ac9339b21303e20c524aaf6b6ca95f4.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-0ac9339b21303e20c524aaf6b6ca95f4.mp4@main.mp4?_=11)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Pixelate
```

### RadialBlur

[<https://naninovel.com/imgit/encoded/i.gyazo.com-f8269fb68519c57c99643948a027a2a1.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-f8269fb68519c57c99643948a027a2a1.mp4@main.mp4?_=12)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.RadialBlur
```

### RadialWiggle

[<https://naninovel.com/imgit/encoded/i.gyazo.com-a401b3b93a61276ed68ededa2e75e9ae.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-a401b3b93a61276ed68ededa2e75e9ae.mp4@main.mp4?_=13)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.RadialWiggle
```

### RandomCircleReveal

[<https://naninovel.com/imgit/encoded/i.gyazo.com-f6e685b13fe2d76733fd43878602eabc.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-f6e685b13fe2d76733fd43878602eabc.mp4@main.mp4?_=14)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.RandomCircleReveal
```

### Ripple

[<https://naninovel.com/imgit/encoded/i.gyazo.com-ff1bd285dc675ca5ac04f7ae4500f1c4.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-ff1bd285dc675ca5ac04f7ae4500f1c4.mp4@main.mp4?_=15)

**Parameters**

| Name | Default |
| --- | --- |
| Frequency | 20 |
| Speed | 10 |
| Amplitude | 0.5 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Ripple

; 파라미터 적용 예시
@back Appearance.Ripple params:45,,1.1
```

### RotateCrumble

[<https://naninovel.com/imgit/encoded/i.gyazo.com-8d476f466858e4788e5ad6014d6db314.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-8d476f466858e4788e5ad6014d6db314.mp4@main.mp4?_=16)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.RotateCrumble
```

### Saturate

[<https://naninovel.com/imgit/encoded/i.gyazo.com-ad6eb77b7065387b9cb9afd77adbc784.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-ad6eb77b7065387b9cb9afd77adbc784.mp4@main.mp4?_=17)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Saturate
```

### Shrink

[<https://naninovel.com/imgit/encoded/i.gyazo.com-8c8bf00348df28ab89813c21f8655c07.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-8c8bf00348df28ab89813c21f8655c07.mp4@main.mp4?_=18)

**Parameters**

| Name | Default |
| --- | --- |
| Speed | 200 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Shrink

; 파라미터 적용 예시
@back Appearance.Shrink params:50
```

### SlideIn

[<https://naninovel.com/imgit/encoded/i.gyazo.com-800ee6f5fba39ab8d46f5eb09f2126cf.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-800ee6f5fba39ab8d46f5eb09f2126cf.mp4@main.mp4?_=19)

**Parameters**

| Name | Default |
| --- | --- |
| Slide amount | 1 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.SlideIn
```

### SwirlGrid

[<https://naninovel.com/imgit/encoded/i.gyazo.com-5a21293d979323a112ffd07f1fffd28d.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-5a21293d979323a112ffd07f1fffd28d.mp4@main.mp4?_=20)

**Parameters**

| Name | Default |
| --- | --- |
| Twist amount | 15 |
| Cell count | 10 |

```
; 디폴트 파라미터로 트랜지션
@back Appearance.SwirlGrid

; 파라미터 적용 예시
@back Appearance.SwirlGrid params:30,4
```

### Swirl

[<https://naninovel.com/imgit/encoded/i.gyazo.com-6ac9a2fe1bb9dfaf6a8292ae5d03960e.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-6ac9a2fe1bb9dfaf6a8292ae5d03960e.mp4@main.mp4?_=21)

**Parameters**

| Name | Default |
| --- | --- |
| Twist amount | 15 |

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Swirl

; 파라미터 적용 예시
@back Appearance.Swirl params:25
```

### Water

[<https://naninovel.com/imgit/encoded/i.gyazo.com-7c684f9a122006f38a0be2725895b76f.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-7c684f9a122006f38a0be2725895b76f.mp4@main.mp4?_=22)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Water
```

### Waterfall

[<https://naninovel.com/imgit/encoded/i.gyazo.com-b6eebcb68002064ababe4d7476139a7c.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-b6eebcb68002064ababe4d7476139a7c.mp4@main.mp4?_=23)

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Waterfall
```

### Wave

[<https://naninovel.com/imgit/encoded/i.gyazo.com-e189ca12868d7ae4c9d8f0ca3d9dd298.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-e189ca12868d7ae4c9d8f0ca3d9dd298.mp4@main.mp4?_=24)

**Parameters**

| Name | Default |
| --- | --- |
| Magnitude | 0.1 |
| Phase | 14 |
| Frequency | 20 |

**Examples**

```
; 디폴트 파라미터로 트랜지션
@back Appearance.Wave

; 파라미터 적용 예시
@back Appearance.Wave params:0.75,,5
```

---

## 커스텀 트랜지션 효과

### 디졸브 마스크

디졸브 마스크 텍스처를 기반으로 커스텀 트랜지션을 만들 수 있습니다. 디졸브 마스크는 그레이스케일 텍스처로, 색상은 픽셀이 대상 텍스처로 전환되는 시기를 정의합니다.

예를 들어 다음 나선형 디졸브 마스크를 고려해 보세요.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-transition-effects-2.avif)

— 오른쪽 상단 모서리에 있는 검은색 사각형은 전환 시작 시 전환 대상이 표시되어야 함을 나타내며 중앙의 순백색 사각형은 맨 끝에서 전환됩니다.

팁

최적의 메모리 사용을 위해 디졸브 텍스처 가져오기 설정에서 ‘단일 채널’과 ‘빨간색’을 설정하세요. 또한 시각적 아티팩트를 방지하려면 *Non-Power of 2* 및 *Generate Mip Map* 옵션이 비활성화되어 있는지 확인하십시오.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-transition-effects-1.avif)

커스텀 트랜지션을 만들려면 커그텀 전환 모드를 사용하고 디졸브 매개변수를 통해 디졸브 마스크 텍스처에 대한 경로(프로젝트 ‘리소스’ 폴더 기준)를 지정하십시오. 예:

```
@back Appearance.Custom dissolve:Textures/Spiral
```

전환의 경계를 부드럽게(퍼즈)하려면 0(스무딩 없음)에서 100(최대 스무딩) 범위의 첫 번째 매개변수를 사용하십시오. 예:

```
@back Appearance.Custom dissolve:Textures/Spiral params:90
```

전환을 반전하려면(디졸브 마스크의 더 밝은 영역이 먼저 표시됨) 두 번째 매개변수를 1로 설정합니다. 예:

```
@back Appearance.Custom dissolve:Textures/Spiral params:,1
```

사용 예는 다음 비디오를 확인하십시오.

---

### 커스텀 셰이더

커스텀 액터 [셰이더](https://docs.unity3d.com/Manual/ShadersOverview.html)를 통해 완전한 커스터마이징 트랜지션 효과를 추가하는 것도 가능합니다.

> **경고**
>
> 이 주제에는 Unity의 그래픽 프로그래밍 기술이 필요합니다. 우리는 커스텀 셰이더 작성에 대한 지원이나 튜토리얼을 제공하지 않습니다. 자세한 내용은 [지원 페이지](https://naninovel.com/support/#unity-support)를 참조하세요.

새 셰이더를 생성하고 이를 커스텀 효과를 사용하는 액터의 *Custom Texture Shader* 속성에 할당합니다. 사용자 정의 액터 셰이더를 만들고 할당하는 방법에 대한 자세한 내용은 [커스텀 액터 셰이더](https://naninovel.com/guide/custom-actor-shader) 가이드를 참조하세요.

스크립트 명령에 전환 이름이 지정되면 액터가 사용하는 재질에서 동일한 이름(NANINOVEL\_TRANSITION\_이 앞에 붙음)을 가진 [셰이더 키워드](https://docs.unity3d.com/ScriptReference/Shader.EnableKeyword.html)가 활성화됩니다.

사용자 정의 액터 셰이더에 자신만의 전환을 추가하려면 multi\_compile 지시어를 사용하세요. 예:

```
#pragma multi_compile_local _ NANINOVEL_TRANSITION_CUSTOM1 NANINOVEL_TRANSITION_CUSTOM2
```

*Custom1* 및 *Custom2* 전환을 추가합니다.

그런 다음 조건부 지시문을 사용하여 활성화된 전환 키워드를 기반으로 특정 렌더링 방법을 선택할 수 있습니다. 내장 액터 셰이더를 재사용하는 경우 조각 처리기에서 사용되는 *ApplyTransitionEffect* 메서드를 통해 사용자 지정 전환을 구현할 수 있습니다.

```
fixed4 ApplyTransitionEffect(sampler2D mainTex, float2 mainUV,
sampler2D transitionTex, float2 transitionUV, float progress,
float4 params, float2 randomSeed, sampler2D cloudsTex, sampler2D customTex)
{
const fixed4 CLIP_COLOR = fixed4(0, 0, 0, 0);
fixed4 mainColor = Tex2DClip01(mainTex, mainUV, CLIP_COLOR);
fixed4 transColor = Tex2DClip01(transitionTex, transitionUV, CLIP_COLOR);

#ifdef NANINOVEL_TRANSITION_CUSTOM1 // Custom1 transition.
return transitionUV.x > progress ? mainColor
    : lerp(mainColor / progress * .1, transColor, progress);
#endif

#ifdef NANINOVEL_TRANSITION_CUSTOM2 // Custom2 transition.
return lerp(mainColor * (1.0 - progress), transColor * progress, progress);
#endif

// When no transition keywords enabled default to crossfade.
return lerp(mainColor, transColor, progress);
}
```

그런 다음 내장된 전환과 동일한 방식으로 추가된 전환을 호출할 수 있습니다. 예:

```
@back Snow.Custom1  
@back River.Custom2
```

전체 셰이더 예제는 [커스텀 액터 셰이더](https://naninovel.com/guide/custom-actor-shader) 가이드를 참조하세요.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)