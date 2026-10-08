---
title: "나니노벨 Special Effects"
url: https://subculturegamer.com/naninovel-special-effects/
published: 2024-09-29
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Special Effects](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-special-effects.png)

나니노벨 Special Effects

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/special-effects)

---

특수 효과(FX)는 @spawn 명령 뒤에 효과 이름을 입력하여 활성화합니다.

```
@spawn ShakeBackground
```

위 명령어는 배경화면에 shake FX를 적용합니다.

params 매개변수를 사용하여 효과의 매개변수를 제어할 수 있습니다. 예:

```
@spawn ShakeCharacter params:Kohaku,1
```

위 명령어는 Kohaku를 디폴트 3번이 아니라 1번만 Shake합니다.

매개변수의 하위 집합을 선택적으로 지정하고 나머지는 기본값으로 두는 것이 가능합니다.

```
@spawn ShakePrinter params:,,0.5
```

처음 두 매개변수(출력시 ID 및 shake 횟수)는 건너뛰고 디폴트지만, 세 번째 매개변수(shake FX 지속시간)는 0.5초로 설정합니다.

결과적인 @spawn 명령을 사용하여 다시 시작하지 않고도 효과 매개변수를 업데이트할 수 있습니다. 예:

```
; Kohaku가 Loop로 계속 흔들리게 하기
; 완료될 때까지 기다리지 않음(무한 루프).
@spawn ShakeCharacter params:Kohaku,0,,,0.1 wait:false
Kohaku: It's rumbling!

; 더 강한 강도로 3번 흔들기
@spawn ShakeCharacter params:Kohaku,3,,,0.8
```

일부 효과는 기본적으로 지속되며 @despawn 명령을 사용하여 수동으로 중지해야 합니다. 예:

```
; rain FX를 시작합니다.
@spawn Rain

; rain FX를 끕니다.
@despawn Rain
```

일부 효과의 @despawn 명령은 매개변수(예: 페이드 아웃 기간 제어)를 수신할 수도 있습니다. 예:

```
; 10초 뒤에 Rain FX를 천천히 제거합니다.
@despawn Rain params:10
```

매개변수(*params*)를 지정하지 않으면 기본 매개변수가 사용됩니다. 각 효과에 사용할 수 있는 ‘start'(@spawn 명령어로도 대체 가능) 및 ‘stop'(@despawn 명령어로도 대체 가능) 매개 변수와 해당 기본값을 아래 문서에서 찾을 수 있습니다.

효과 이름 뒤에 #으로 구분된 ID를 추가하여 동일한 유형의 여러 효과를 시작할 수 있습니다. 예:

```
; Kohaku와 Yuko를 동시에 루프로 Shake한다.
@spawn ShakeCharacter#1 params:Kohaku,0 wait:false
@spawn ShakeCharacter#2 params:Yuko,0 wait:false
```

인스턴스 효과를 중지하거나 업데이트할 때 ID를 지정하는 것을 잊지 마세요.

```
; Yuko의 Shake를 멈추고, Kohaku의 Shake 강도를 증가시킵니다.
@despawn ShakeCharacter#2
@spawn ShakeCharacter#1 params:Kohaku,0,,,1
```

ID에 임의의 문자열을 사용할 수 있습니다. (위처럼 숫자일수도 있고, 또는 의미 맥락이 있는 문자열로 *@spawn ShakeCharacter#Kohaku*처럼 지정 가능) 주어진 효과 이름과 함께 사용 중인 다른 ID 중에서 고유한지 확인하세요.

> 팁
>
> Naninovel v1.19부터 모든 내장 효과에는 IDE extionsion의 자동 완성을 지원하는 전용 명령이 있습니다. 예를 들면 다음과 같습니다.
>
> ```
> @spawn Blur params:,1,2.5
> @despawn Blur params:1
> ```
>
> 아래와 같은 코드도 사용 가능합니다.
>
> ```
> @blur power:1 time:2.5
> @blur power:0 time:1
> ```

---

## 흔들기(Shake)

### Shake Printer(다이얼로그 출력기 흔들기)

지정된 ID 또는 기본 ID로 (다이얼로그) 출력기를 흔듭니다.

- 전용 명령어: @shake

[<https://naninovel.com/imgit/encoded/i.gyazo.com-f61fc35e318cce1949b00e5fe2448a80.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-f61fc35e318cce1949b00e5fe2448a80.mp4@main.mp4?_=1)

**시작 파라미터**

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| Printer ID | 스트링 | null | 흔들려는 출력기 ID입니다. 지정하지 않으면 기본 프린터가 흔들립니다. |
| Shake count | 정수형 | 2 | 흔들기 반복 횟수입니다. 0으로 설정하면 @despawn으로 중지될 때까지 효과가 반복됩니다. |
| Shake duration | 소수형 | 0.15 | 각 흔들기 반복의 기본 지속 시간(초)입니다. |
| Duration variation | 소수형 | 0.25 | 효과의 기본 지속 시간에 적용되는 무작위 델타 수정자입니다. |
| Shake amplitude | 소수형 | 0.5 | 각 흔들림 반복의 기본 변위 진폭(단위)입니다. |
| Amplitude variation | 소수형 | 0.1 | 효과의 기본 변위 진폭에 적용된 무작위 델타 수정자입니다. |
| Shake horizontally | 불(T,F) | false | 액터를 수평으로(x축 기준으로) 변위할지 여부입니다. |
| Shake vertically | 불(T,F) | true | 액터를 수직으로(y축 기준으로) 변위할지 여부입니다. |

UI가 ‘Screen Space Overlay’ 모드로 설정된 경우 눈에 띄는 효과를 얻으려면 흔들림 진폭이 기본값의 약 x100배가 되어야 합니다.

**예시**

```
; 디폴트 파라미터로 디폴트 출력기 흔들기
@spawn ShakePrinter

; 디폴트 프린터 좌우로 10번 흔들기
@spawn ShakePrinter params:,10,,,,,true,false

; 디폴트 출력기 루프로 흔들기, 텍스트 출력, 이후 흔들기 멈춤
@spawn ShakePrinter params:,0 wait:false
What a shaky situation!
@despawn ShakePrinter
```

### Shake Background(배경 흔들기)

지정된 ID 또는 기본 ID로 배경을 흔듭니다.

- 전용 명령어: @shake

[<https://naninovel.com/imgit/encoded/i.gyazo.com-fcf1153a0ad3d9a153908206211f5f5f.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-fcf1153a0ad3d9a153908206211f5f5f.mp4@main.mp4?_=2)

**시작 파라미터**

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| Background ID | 스트링 | null | 흔들려는 배경 ID입니다. 지정하지 않으면 메인 배경이 흔들립니다. |
| Shake count | 정수형 | 2 | 흔들기 반복 횟수입니다. 0으로 설정하면 @despawn으로 중지될 때까지 효과가 반복됩니다. |
| Shake duration | 소수형 | 0.15 | 각 흔들기 반복의 기본 지속 시간(초)입니다. |
| Duration variation | 소수형 | 0.25 | 효과의 기본 지속 시간에 적용되는 무작위 델타 수정자입니다. |
| Shake amplitude | 소수형 | 0.5 | 각 흔들림 반복의 기본 변위 진폭(단위)입니다. |
| Amplitude variation | 소수형 | 0.1 | 효과의 기본 변위 진폭에 적용된 무작위 델타 수정자입니다. |
| Shake horizontally | 불(T,F) | false | 액터를 수평으로(x축 기준으로) 변위할지 여부입니다. |
| Shake vertically | 불(T,F) | true | 액터를 수직으로(y축 기준으로) 변위할지 여부입니다. |

**예시**

```
; 디폴트 파라미터로 디폴트 배경 흔들기
@spawn ShakeBackground

; Video 배경 2번 흔들기
@spawn ShakeBackground params:Video,2
```

### Shake Character(캐릭터 흔들기)

지정된 ID 또는 무작위로 표시되는 ID를 가진 캐릭터를 흔듭니다.

- 전용 명령어: @shake

[<https://naninovel.com/imgit/encoded/i.gyazo.com-6001d3cfbee855c8a783d10e4a784042.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-6001d3cfbee855c8a783d10e4a784042.mp4@main.mp4?_=3)

**시작 파라미터**

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| Character ID | 스트링 | null | 흔들려는 캐릭터 ID입니다. 지정하지 않으면 캐릭터 중 하나가 랜덤으로 흔들립니다. |
| Shake count | 정수형 | 2 | 흔들기 반복 횟수입니다. 0으로 설정하면 @despawn으로 중지될 때까지 효과가 반복됩니다. |
| Shake duration | 소수형 | 0.15 | 각 흔들기 반복의 기본 지속 시간(초)입니다. |
| Duration variation | 소수형 | 0.25 | 효과의 기본 지속 시간에 적용되는 무작위 델타 수정자입니다. |
| Shake amplitude | 소수형 | 0.5 | 각 흔들림 반복의 기본 변위 진폭(단위)입니다. |
| Amplitude variation | 소수형 | 0.1 | 효과의 기본 변위 진폭에 적용된 무작위 델타 수정자입니다. |
| Shake horizontally | 불(T,F) | false | 액터를 수평으로(x축 기준으로) 변위할지 여부입니다. |
| Shake vertically | 불(T,F) | true | 액터를 수직으로(y축 기준으로) 변위할지 여부입니다. |

**예시**

```
; 디폴트 파라미터로 Kohaku 흔들기
@spawn ShakeCharacter params:Kohaku

; 임의의 캐릭터 흔들기 & 그에 따른 중지 또는 실행 선택지 출력하기 
@spawn ShakeCharacter params:,0 wait:false
@choice "Continue shaking" goto:.Continue
@choice "Stop shaking" goto:.Stop
@stop
# Stop
@despawn ShakeCharacter
# Continue
...
```

### Shake Camera(카메라 흔들기)

메인 Naninovel 렌더 카메라를 흔듭니다.

- 전용 명령어: @shake

[<https://naninovel.com/imgit/encoded/i.gyazo.com-f9521fbcf959d0b72e449ae6e2191f9f.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-f9521fbcf959d0b72e449ae6e2191f9f.mp4@main.mp4?_=4)

**시작 파라미터**

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| Camera ID | 스트링 | null | 흔들려는 카메라 ID입니다. 지정하지 않으면 메인 나니노벨 카메라가 흔들립니다. |
| Shake count | 정수형 | 2 | 흔들기 반복 횟수입니다. 0으로 설정하면 @despawn으로 중지될 때까지 효과가 반복됩니다. |
| Shake duration | 소수형 | 0.15 | 각 흔들기 반복의 기본 지속 시간(초)입니다. |
| Duration variation | 소수형 | 0.25 | 효과의 기본 지속 시간에 적용되는 무작위 델타 수정자입니다. |
| Shake amplitude | 소수형 | 0.5 | 각 흔들림 반복의 기본 변위 진폭(단위)입니다. |
| Amplitude variation | 소수형 | 0.1 | 효과의 기본 변위 진폭에 적용된 무작위 델타 수정자입니다. |
| Shake horizontally | 불(T,F) | false | 액터를 수평으로(x축 기준으로) 변위할지 여부입니다. |
| Shake vertically | 불(T,F) | true | 액터를 수직으로(y축 기준으로) 변위할지 여부입니다. |

**예시**

```
; 디폴트 파라미터로 메인 나니노벨 카메라 흔들기
@spawn ShakeCamera

; 메인 나니노벨 카메라 5번 흔들기
@spawn ShakeCamera params:,5,,,,,true,false
```

## 액터 이동시키기

액터 매개변수를 직접 변경(애니메이션)하려는 경우 @animate 명령어를 사용합니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-a0494329c713c4309a52d57d0b297bee.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-a0494329c713c4309a52d57d0b297bee.mp4@main.mp4?_=5)

```
; 위 애니메이션 예시
@animate Yuko
appearance:Surprise|Sad|Default|Angry
transition:DropFade|Ripple|Pixelate
posX:15|85|50
posY:0|-25|-85
scale:1|1.25|1.85
tint:fuchsia|lightblue|white|olive
easing:EaseInBounce|EaseInQuad
time:3|2|1|0.5
```

## 디지털 글리치

디지털 비디오 왜곡 및 아티팩트를 시뮬레이션하는 후처리 효과를 기본 카메라에 적용합니다.

- 전용 명령아: @glitch

[<https://naninovel.com/imgit/encoded/i.gyazo.com-94cb6db25c17956473db4de149281df5.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-94cb6db25c17956473db4de149281df5.mp4@main.mp4?_=6)

****시작 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 지속시간 | 소수형 | 1 | 지속 시간; 초(s) |
| 강도 | 소수형 | 1 | 이펙트의 강도; 0.0 ~ 10.0 |

****예시****

```
; 디폴트 파라미터로 DigittalGlitch를 활성화합니다.
@spawn DigitalGlitch

; 3.33초 동안 0.1의 강도의 DigitalGlitch를 활성화합니다.
@spawn DigitalGlitch params:3.33,0.1
```

## 날씨 효과

### Rain

비를 시뮬레이션하는 입자 시스템을 생성합니다.

- 전용 명령어: @rain

[<https://naninovel.com/imgit/encoded/i.gyazo.com-74af9eec30f6517ea5b8453a9c86d33c.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-74af9eec30f6517ea5b8453a9c86d33c.mp4@main.mp4?_=7)

****시작 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 강도 | 소수형 | 500 | 비의 강도(초당 입자 생성 속도) |
| 페이드인 시간 | 소수형 | 5 | 지정된 시간(초) 동안 스폰 속도를 0에서 지정값까지 점차적으로 증가 |
| X 속도 | 소수형 | 1 | 입자의 수평 속도에 대한 멀티플라이어입니다. 빗방울의 각도를 변경하는 데 사용 |
| Y 속도 | 소수형 | 1 | 입자의 수직 속도에 대한 멀티플라이어입니다. |

****종료 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 페이드아웃 시간 | 소수형 | 5 | 지정된 시간(초) 동안 스폰 속도를 0에서 지정값까지 점차적으로 감소 |

****예시****

```
; 10초간 비의 강도를 점진적으로 증가
@spawn Rain params:1500,10
; 비가 30초에 걸쳐 그치도록 파라미터를 설정
@despawn Rain params:30
```

### Snow

눈을 시뮬레이션하는 입자 시스템을 생성합니다.

- 전용 명령어: @snow

[<https://naninovel.com/imgit/encoded/i.gyazo.com-25a052444c561e40c8318272f51edf47.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-25a052444c561e40c8318272f51edf47.mp4@main.mp4?_=8)

****시작 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 강도 | 소수형 | 100 | 눈의 강도(초당 입자 생성 속도) |
| 페이드인 시간 | 소수형 | 5 | 지정된 시간(초) 동안 스폰 속도를 0에서 지정값까지 점차적으로 증가 |

****종료 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 페이드아웃 시간 | 소수형 | 5 | 지정된 시간(초) 동안 스폰 속도를 0에서 지정값까지 점차적으로 감소 |

****예시****

```
; 10초간 눈의 강도를 점진적으로 증가
@spawn Snow params:300,10
; 눈이 30초에 걸쳐 그치도록 파라미터를 설정
@despawn Rain params:30
```

### Sun Shafts

빛기둥(광선)을 시뮬레이션하는 입자 시스템을 생성합니다.

- 전용 명령어: @sun

****시작 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 강도 | 소수형 | 0.85 | 빛의 세기(opacity;불투명도) |
| 페이드인 시간 | 소수형 | 3 | 지정된 시간(초) 동안 스폰 속도를 0에서 지정값까지 점차적으로 증가 |

****종료 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 페이드아웃 시간 | 소수형 | 3 | 지정된 시간(초) 동안 스폰 속도를 0에서 지정값까지 점차적으로 감소 |

****예시****

```
; 10초간 햇빛 강도를 점진적으로 증가
@spawn SunShafts params:1,10
; 빛이 30초에 걸쳐 꺼지도록 파라미터를 설정
@despawn SunShafts params:30
```

---

## 피사계 심도(Depth of Field)

※Naninovel에서는 ‘Bokeh(보케)’라는 용어로 통용됨. (역자 주)

초점이 맞는 오브젝트만 선명하게 유지되고 다른 이미지는 흐려지는 피사계 심도 효과 시뮬레이션.

- 전용 명령어: @bokeh

> **팁**
>
> 하나의 개체(액터)만 블러 처리하고 싶다면 Bokeh 대신 [Blur effect](https://naninovel.com/guide/special-effects#blur)가 낫습니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-616a023c46f207b4a3a33d3d3fd9fbc9.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-616a023c46f207b4a3a33d3d3fd9fbc9.mp4@main.mp4?_=9)

****시작 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 포커스 오브젝트 이름 | 문자열 | null | 포커스를 설정할 게임 오브젝트의 이름입니다(옵션). 설정 시 초점은 해당 게임 오브젝트에 유지되고 *Focus Distance* 파라미터 값은 무시됩니다. |
| 포커스 거리 | 소수형 | 10 | 지정된 시간(초) 동안 스폰 속도를 0에서 지정값까지 점차적으로 증가 |
| 초점 길이 | 소수형 | 3.75 | 초점이 흐려진 영역에 적용할 블러의 양(강도)입니다. 또한 초점 감도를 결정합니다. |
| 연출 시간 | 소수형 | 1 | 보간 시간(매개변수가 목표 값에 도달하는 속도)입니다. |

****종료 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 연출 종료 | 소수형 | 1 | 연출 종료(디폴트로 복귀)하기까지 페이드오프(비활성화)하는데 소요되는 시간 |

****예시****

```
; 기본 매개변수로 효과를 활성화하고 'Kohaku' 게임 개체에 초점을 고정합니다.
@spawn DepthOfField params:Kohaku

; 10초 동안 효과가 페이드오프(비활성화)됩니다.
@despawn DepthOfField params:10

; 카메라에서 10단위 떨어진 곳에 초점 포인트를 설정하고,
; 초점 거리를 0.95로 설정하고 3초에 걸쳐 적용합니다.
@spawn DepthOfField params:,10,0.95,3
```

## 블러

지원되는 배경 및 캐릭터 액터(스프라이트, 레이어드, 분할, Live2D, 스파인, 비디오 및 씬 구현)에 Blur(흐림) 필터를 적용합니다.

첫 번째 매개 변수를 지정하지 않은 경우 기본적으로 효과는 *MainBackground* 액터에 적용됩니다.

- 전용 명령어: @blur

[<https://naninovel.com/imgit/encoded/i.gyazo.com-067614d77783683e74ca79652099b58d.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-067614d77783683e74ca79652099b58d.mp4@main.mp4?_=10)

****시작 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 액터 ID | 문자열 | MainBackground | 효과를 적용할 액터의 ID입니다. 효과를 지원하려면 액터에 *IBlurable* 인터페이스가 구현되어 있어야 합니다. |
| 강도 | 소수형 | 0.5 | 효과의 강도(0.0~1.0 범위) |
| 연출 시간 | 소수형 | 1 | 보간 시간(초)(연출 강도가 목표 값에 도달하는 속도) |

****종료 파라미터****

| 이름 | 타입 | 기본값 | 설명 |
| --- | --- | --- | --- |
| 연출 종료 | 소수형 | 1 | 연출 종료(디폴트로 복귀)하기까지 페이드오프(비활성화)하는데 소요되는 시간 |

****예시****

```
; 현재 메인 배경화면에 Blur 이펙트 적용
@spawn Blur

; 2.5초간 1의 강도로 Sky 배경에 Blur 적용.
@spawn Blur params:Sky,1,2.5

; Blur 취소
@despawn Blur
```

---

## 커스텀 이펙트 추가하기

### 스탠드얼론 이펙트

스폰 리소스 매니저(*Naninovel – Resources – Spawn*)로 커스텀 스탠드얼론 효과(‘Rain’, ‘Snow’ 등 내장 이펙트와 같은 프리팹을 통해 구현)를 이펙트 프리팹을 추가할 수 있습니다. 추가한 커스텀 이펙트는 @spawn 및 @despawn 명령어로 빌트인 이펙트와 동일한 방식으로 명령을 수행합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-special-effects-3.avif)

예를 들어 스폰 매니저에 Explosion.prefab이 할당된 경우 다음 명령어는 씬에서 프리팹을 스폰 또는 디스폰합니다.

```
@spawn Explosion  
@despawn Explosion
```

위 명령어는 변환 매개변수를 지원하여 특정 씬이나 월드 포지션에서 특정 회전이나 크기로 개체를 생성할 수 있습니다. 예:

```
; 화면 좌측으로부터 15% 떨어진 지점에 Explosion
; 10배 스케일, z-축에서 15도 정도 회전된 방향으로
@spawn Explosion pos:15 scale:10 rotation:,,15
```

생성할 프리팹이 많고 편집기 메뉴를 통해 할당하는 것이 불편한 경우 *Resources/Naninovel/Spawn* 폴더에 놓으면 자동으로 스크립트에서 사용할 수 있습니다.

원하는 경우 하위 폴더를 사용하여 추가로 정리할 수도 있습니다. 이 경우 naninovel 스크립트에서 참조할 때 슬래시(/)를 사용하십시오. 예를 들어 *Resources/Naninovel/Spawn/Explosions/Boom01*로 저장된 프리팹 에셋은 스크립트에서 *Explosions/Boom01*로 참조됩니다.

[어드레서블 에셋 시스템](https://naninovel.com/guide/resource-providers#addressable)을 사용하여 리소스를 수동으로 보여주 것도 가능합니다. 에셋을 보여주려면 ‘Resources/’ 부분을 생략하는 것을 제외하고 위에서 설명한 방법을 통해 에셋을 노출하는 데 사용할 경로와 동일한 주소를 할당하세요.

예를 들어 ‘Boom01’ 프리팹 에셋을 보여주려면 *Naninovel/Spawn/Boom01* 주소로 에셋을 할당합니다. 어드레서블 제공자는 기본적으로 편집기에서 사용되지 않습니다. 리소스 공급자 구성 메뉴에서 에디터에 *Enable Addressable In Editor* 속성을 활성화하여 이를 허용할 수 있습니다.

구현 참조를 위해 Naninovel/Prefabs/FX에 저장된 내장 효과 프리팹을 확인하세요.

### 카메라 이펙트

Naninovel 카메라에 [커스텀 후처리 효과](https://assetstore.unity.com/?q=post%20processing&orderBy=1)(‘Digital Glitch’ 빌트인 효과와 같은 이미지 효과 또는 카메라 필터)를 적용하려면 [카메라 프리팹을 만들고](https://docs.unity3d.com/Manual/CreatingPrefabs.html) [필요한 효과 구성 요소](https://docs.unity3d.com/Manual/UsingComponents.html)를 카메라의 객체를 선택하고 카메라 구성 메뉴(*Naninovel -> Configuration -> Camera*)의 *Custom Camera Prefab* 필드에 해당 프리팹을 할당합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-special-effects-2.avif)

토글 매개변수를 사용하여 naninovel 스크립트를 통해 추가된 구성요소를 *toggle*(비활성화된 경우 활성화 또는 활성화된 경우에는 그 반대로 비활성화)하고 @camera 명령의 *set* 매개변수를 사용하여 활성화 상태를 명시적으로 설정할 수 있습니다.

예를 들어 카메라 개체에 ‘*Bloom Image Effect*‘ 구성 요소를 추가했다고 가정해 보겠습니다. 먼저 구성 요소의 유형 이름이 무엇인지 알아보세요. 일반적으로 구성 요소의 *Script* 필드에 지정됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-special-effects-1.avif)

컴포넌트의 타입 이름은 *BloomImageEffect*입니다. 다음과 같이 런타임에 이 컴포넌트를 전환하려면 타입 이름을 사용하십시오.

```
@camera toggle:BloomImageEffect
```

타입 이름을 쉼표로 구분하여 여러 컴포넌트를 한 번에 전환할 수 있습니다.

```
@camera toggle:BloomImageEffect,Sepia,CameraNoise
```

그리고 컴포넌트를 명시적으로 활성화하거나 비활성화하려는 경우:

```
@camera set:BloomImageEffect.true,Sepia.false,CameraNoise.true
```

위 명령어는 *BloomImageEffect* 및 *CameraNoise* 구성 요소를 활성화하고Sepia를 비활성화합니다.

카메라 개체에 연결된 모든 컴포넌트를 전환, 비활성화 또는 활성화하려면 ‘\*’ 기호를 사용하십시오.

```
; 모든 컴포넌트 토글
@camera toggle:*

; 모든 컴포넌트 비활성화
@camera set:*.false

; 모든 컴포넌트 활성화
@camera set:*.true
```

현재 활성화된(및 비활성화된) 카메라 컴포넌트 상태는 게임 저장 로딩 작업 시 자동으로 저장되고 복원됩니다.

커스텀 카메라 필터 효과 추가에 대한 예를 보려면 다음 비디오를 확인하십시오.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)