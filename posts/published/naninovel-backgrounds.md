---
title: "나니노벨 Backgrounds"
url: https://subculturegamer.com/naninovel-backgrounds/
published: 2024-09-29
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

※원문 페이지: [(링크)](https://naninovel.com/guide/backgrounds)

※최종 수정일: 25/12/20

---

## 배경

배경 액터는 씬 레이어의 ‘뒷부분’에 해당하는 영역입니다.

즉, 로케이션, 배경, 풍경 또는 캐릭터 뒤에 나타나는 모든 것을 나타내는 데 쓰이는 액터입니다. 배경 액터에 대한 간략한 개요는 다음 비디오 튜토리얼을 확인하세요.

배경 액터는 이름, 모양, 가시성 및 변환(위치, 회전, 크기)으로 정의됩니다.

게임의 진행(시간이 지남)에 따라 모양, 가시성 및 변형에 변화를 줄 수 있습니다.

배경 액터는 *Naninovel – Configuration – Backgrounds* 메뉴에서 구성할 수 있습니다. 사용 가능한 옵션은 [구성 가이드](https://naninovel.com/guide/configuration#backgrounds)를 참조하세요. 배경의 리소스 관리자는 *Naninovel -> Resources -> Backgrounds* 컨텍스트 메뉴로 접근할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-backgrounds-6.avif)

사용할 배경이나 해당 배경의 무드(낮, 밤 등) 개수가 많아서 편집기 메뉴로 일일히 할당하는 것이 불편하다면 액터 레코드 에셋(*Create – Naninovel – Actor Record – Background*)의 다중 편집과 폴더별로 분류해주는 기능이 편리합니다; 예를 보려면 아래 비디오를 확인하십시오.

[어드레서블 에셋 시스템](https://naninovel.com/guide/resource-providers#addressable)으로 에디터 메뉴 없이 리소스를 액터 레코드와 연결할 수 있습니다.

예를 들어, “MainBackground” 배경에 “Beach” 외형을 연결하려면 텍스처 에셋을 다음 주소에 할당하면 됩니다: *Naninovel/Backgrounds/MainBackground/Beach*.

그리고 어드레서블 그룹 구성에서 에셋에 “Naninovel” 레이블을 할당하세요. 기본적으로 어드레서블 공급자는 에디터에서 사용되지 않으므로, 리소스 공급자 구성 메뉴에서 *Allow Addressable In Editor* 속성을 활성화하여 에디터에서 사용할 수 있습니다. 어드레서블 공급자 사용 방법에 대한 자세한 정보는 [리소스 공급자 문서](https://naninovel.com/guide/resource-providers#addressable)를 참조하십시오.

나니노벨 스크립트에서는 배경을 주로 **@back 명령어**로 제어합니다:

```
; River를 메인 배경의 외형으로 설정합니다.
@back River

; 위와 동일하나, RadialBlur 전환 효과를 함께 사용합니다.
@back River.RadialBlur
```

배경은 전통적인 비주얼 노벨 게임 플로우를 더 잘 수용하기 위해 캐릭터와는 조금 다르게 처리됩니다. 대부분의 경우, 하나의 씬에 단일 배경 액터만 있을 것이며, 이 배경이 다른 외형으로 계속 전환됩니다. 같은 액터 ID를 스크립트에서 반복적으로 입력하는 번거로움을 줄이기 위해, 외형과 전환 유형(선택 사항)을 이름 없는 매개변수로 제공하여 *MainBackground* 액터가 영향을 받도록 할 수 있습니다. 이와 같은 상황이 아닐 경우, *ID 매개변수*를 통해 배경 액터의 ID를 명시적으로 지정할 수 있습니다:

```
; CityVideo 액터에 Night와 Day 비디오 클립이 있는 경우.

; 비디오 배경을 day 클립으로 보여줍니다.
@back Day id:CityVideo

; ripple 효과로 night 클립으로 전환합니다.
@back Night.Ripple id:CityVideo

; 비디오 배경을 숨깁니다.
@hide CityVideo
```

메인 배경 액터 레코드는 기본적으로 배경 리소스 관리자에서 생성되며, 이름을 변경하거나 삭제할 수는 없습니다. 그러나 메인 배경의 매개변수(구현, 축 기준, PPU 등)는 자유롭게 변경할 수 있습니다.

보다 자세한 내용은 아래의 비디오 튜토리얼을 참고해 주세요.

## Z-순서

여러 배경을 동시에 표시할 때, 서로 겹칠 수 있습니다:

```
@back id:1  
@back id:2
```

두 배경 1과 2가 모두 전체 화면 불투명 텍스처인 경우, 나중에 추가된 것이 다른 것을 완전히 덮어씁니다. 첫 번째 배경을 다시 보이게 하려면 다른 배경을 숨기거나 z-위치(깊이)를 변경하여 그리기 순서를 바꿀 수 있습니다:

```
; 두 번째 배경을 숨겨 첫 번째 배경을 보이게 합니다.
@back id:2 visible:false
; 액터를 숨기기 위한 전용 명령어도 있습니다.
@hide 2
; 또는 z-위치를 변경합니다.
@back id:1 pos:,,98
@back id:2 pos:,,99
```

z-포지션이 높을수록 카메라에서 더 멀리 떨어져 있으므로, 첫 번째 액터가 카메라에 더 가까이 배치되면 다른 것 위에 렌더링됩니다.

기본적으로 배경은 다른 액터 유형보다 뒤에 보이도록 특정 Z-Offset으로 배치됩니다. 이 오프셋 값은 배경 설정에서 *Z Offset* 속성을 통해 변경할 수 있습니다.

## 매치 모드(Match Mode)

카메라가 정사영(orthographic) 모드에서 렌더링되고 배경 액터 구성에서 Match Mode가 비활성화되지 않은 경우, 액터는 현재 화면 크기에 맞추려고 시도합니다.

이는 화면 비율이 배경과 다른 경우에 대비한 처리입니다.

매칭이 비활성화되고 화면 비율이 다르면 “검은 막대(black bars)”영역이 나타날 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-backgrounds-5.avif)

독립 실행형(PC, Mac, Linux) 빌드의 경우 [플레이어 설정](https://docs.unity3d.com/Manual/class-PlayerSettingsStandalone.html#Resolution)에서 사용 가능한 화면비를 제한할 수 있지만 웹, 콘솔 및 모바일에서는 불가능하며 대신 애플리케이션이 대상 장치에 맞게 조정해야 합니다.

각 배경 액터에 대해 다음 일치 모드를 설정할 수 있습니다(일반 구현 제외):

```
- Crop: 화면 비율에 상관없이 카메라 프러스텀 전체를 배경이 차지합니다. 검은 막대는 보이지 않지만, 일부 배경 영역이 잘릴 수 있습니다. 새로운 배경 액터에 기본으로 설정됩니다.

- Fit: 배경 영역이 항상 전체 화면에 나타나지만, 화면 비율이 다르면 검은 막대가 나타납니다.

- Custom: 사용자 지정 비율로 너비 또는 높이를 맞출 수 있습니다. Custom Match Ratio 속성으로 비율을 제어합니다.

- Disable: 매칭을 수행하지 않습니다.
```

> **팁**
>
> 일반 배경이나 사용자 정의 배경에 유사한 일치 기능을 구현하려는 경우 포럼에서 [화면 크기 조정 예시](https://discord.com/channels/545676116871086080/1369983634236379240)를 참조하세요.

## 포즈

각 배경에는 `Poses` 속성이 있으며, 이름이 지정된 상태(포즈)를 지정할 수 있습니다.

포즈 이름은 @back 명령에서 외형으로 사용할 수 있으며, 명령 매개변수를 개별적으로 지정하는 대신 포즈에서 지정된 모든 매개변수를 한 번에 적용합니다:

```
; 메인 배경에 Day 포즈가 정의된 경우,
; 포즈에 지정된 모든 매개변수를 적용합니다.
@back Day

; 위와 동일하지만, City ID의 배경 액터에 대해
; 3초 동안 DropFade 전환을 사용합니다.
@back Day id:City transition:DropFade time:3
```

포즈가 외형으로 사용될 때도 개별 매개변수를 재정의할 수 있습니다:

```
; 메인 배경에 Day 포즈가 정의된 경우,
; 포즈 상태에 지정된 모든 매개변수를 적용하지만,
; 색조(tint)는 명령에서 재정의됩니다.
@back Day tint:#ff45cb
```

## 스프라이트 배경

스프라이트 구현은 배경 액터에서 가장 일반적이고 간단한 것으로, 배경의 외형을 나타내기 위해 사각형 메쉬(스프라이트)에 [텍스처 에셋](https://docs.unity3d.com/Manual/Textures.html)을 씌웁니다. 텍스처는 .jpg, .png, .tiff, .psd 또는 [Unity](https://docs.unity3d.com/Manual/ImportingTextures)에서 지원하는 다른 이미지 파일 형식을 기반으로 할 수 있습니다.

> **팁**
>
> 개발 작업 흐름에 가장 적합한 파일 형식을 선택하세요. 프로젝트를 빌드할 때 Unity는 모든 소스 리소스(텍스처, 오디오, 비디오 등)를 대상 플랫폼에 가장 적합한 형식으로 자동 변환하므로 원래 프로젝트에 리소스를 저장하는 형식에는 차이가 없습니다. [공식 문서](https://docs.unity3d.com/Manual/AssetWorkflow)에서 Unity가 프로젝트 에셋을 관리하는 방법에 대한 자세한 내용을 알아보세요.

씬에 있는 스프라이트 배경 메시의 크기가 조정되지 않은 초기 크기는 참조 해상도(카메라 구성), 배경의 `Pixel Per Unit`(구성 메뉴에서 각 배경 액터에 대해 설정) 및 소스 텍스처 해상도에 따라 달라집니다.

Naninovel은 기본적으로 배경이 전체 카메라 프러스텀(절두체)를 덮도록 시도하므로 종횡비가 참조 해상도와 동일하도록 소스 텍스처의 크기를 조정해야 합니다. 이 동작을 변경하거나 비활성화하는 방법에 대한 자세한 내용은 [매치 모드 가이드](https://naninovel.com/guide/backgrounds#match-mode)를 참조하세요.

> **팁**
>
> 아트 에셋(캐릭터 및 배경 모두)에 대한 작업을 시작하기 전에 팀과 함께 참조 해상도를 정의하십시오. 이렇게 하면 아티스트가 올바른 크기로 에셋을 제작할 수 있으며 나중에 편집할 필요가 없습니다.

## 분할 스프라이트(Diced Sprite) 배경

오픈 소스 [SpriteDicing](https://github.com/elringus/SpriteDicing) 패키지로 구축된 *DicedSpriteBackground* 구현을 사용하면 관련 텍스처에 대부분 유사한 데이터가 포함되어 있는 경우 배경 스프라이트의 텍스처 영역을 재사용하여 빌드 크기와 텍스처 메모리를 크게 줄일 수 있습니다.

분할 배경은 분할 캐릭터 구현과 매우 유사합니다. 설정 및 사용 지침은 [분할 캐릭터 가이드](https://naninovel.com/guide/characters.html#diced-sprite-characters)를 참조하세요.

## 비디오 배경

비디오 배경은 반복되는 [비디오 클립](https://docs.unity3d.com/Manual/class-VideoClip) 에셋을 사용하여 외형을 나타냅니다.

각 플랫폼에 지원되는 비디오 형식은 비디오 소스에 대한 [Unity 문서](https://docs.unity3d.com/Manual/VideoSources-FileCompatibility.html)를 참조하세요.

알파 채널(투명도)이 포함된 비디오를 사용하는 경우 [지원되는 형식에 대한 가이드](https://docs.unity3d.com/Manual/VideoTransparency.html)를 참조하세요.

> **메모**
>
> 비디오 자산 가져오기 설정에서 *Transcode*가 비활성화되면 일부 플랫폼에서 클립이 재생되지 않을 수 있습니다. 빌드에서 비디오가 재생되지 않으면 트랜스코드 옵션을 활성화하고 플레이어를 다시 빌드해 보세요.
>
> ![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-backgrounds-4.avif)

> **예시**
>
> 원활한 루프를 달성하는 데 문제가 있는 경우 비디오의 시작 및 종료 프레임이 정확히 동일하고 인코딩 설정이 호환되는지 확인하세요. [비디오 액터 예제 프로젝트](https://naninovel.com/guide/samples#video-actor)를 참고하세요.

특정 표현이 반복되는 것을 방지하려면 표현 이름에 NoLoop(대소문자 구분)를 추가하세요.

### WebGL 한계

WebGL에서 Unity의 비디오 플레이어는 스트리밍 모드에서만 작동할 수 있으므로 WebGL 플레이어를 빌드할 때 모든 비디오 리소스가 Assets/StreamingAssets/Backgrounds 폴더에 복사됩니다. StreamingAssets 폴더는 빌드 출력 디렉터리에도 나타납니다. 빌드를 게시할 때 이를 보존하고 웹 서버가 이 폴더의 데이터를 읽을 수 있는지 확인하세요.

복사된 비디오 파일은 Unity에서 트랜스코딩되지 않으므로(옵션이 활성화된 경우에도) 소스 파일은 처음에 웹 브라우저에서 지원되는 형식이어야 합니다.

또는 빌드 후 게임 디렉터리의 클립 파일을 교체할 수 있습니다. 다음은 WebGL 데모에 사용된 배경 비디오 클립의 자세한 메타데이터입니다.

```
Container : MPEG-4  
Container profile : Base Media  
Container codec ID : isom (isom/iso2/avc1/mp41)  
Format : AVC  
Format/Info : Advanced Video Codec  
Format profile : High@L4  
Format settings, CABAC : Yes  
Format settings, RefFrames : 4 frames  
Codec ID : avc1  
Codec ID/Info : Advanced Video Coding  
Bit rate : 3 196 kb/s  
Width : 1 920 pixels  
Height : 1 080 pixels  
Display aspect ratio : 16:9  
Frame rate mode : Constant  
Frame rate : 25.000 FPS  
Color space : YUV  
Chroma subsampling : 4:2:0  
Bit depth : 8 bits  
Scan type : Progressive  
Writing library : x264 core 148 r2795 aaa9aa8  
Encoding settings : cabac=1 / ref=3 / deblock=1:0:0 / analyse=0x3:0x113 / me=hex / subme=7 / psy=1 / psy_rd=1.00:0.00 / mixed_ref=1 / me_range=16 / chroma_me=1 / trellis=1 / 8x8dct=1 / cqm=0 / deadzone=21,11 / fast_pskip=1 / chroma_qp_offset=-2 / threads=12 / lookahead_threads=2 / sliced_threads=0 / nr=0 / decimate=1 / interlaced=0 / bluray_compat=0 / constrained_intra=0 / bframes=3 / b_pyramid=2 / b_adapt=1 / b_bias=0 / direct=1 / weightb=1 / open_gop=0 / weightp=2 / keyint=250 / keyint_min=25 / scenecut=40 / intra_refresh=0 / rc_lookahead=40 / rc=crf / mbtree=1 / crf=23.0 / qcomp=0.60 / qpmin=0 / qpmax=69 / qpstep=4 / ip_ratio=1.40 / aq=1:1.00
```

mp4 이외의 비디오 형식(예: webm)을 사용하는 경우 리소스 공급자 구성의 *Video Stream Extension* 속성을 통해 호스팅된 파일의 확장자를 설정합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-backgrounds-3.avif)

---

## 레이어드(Layered) 배경

레이어드 구현을 사용하면 여러 스프라이트(레이어)에서 배경을 구성한 다음 런타임 시 naninovel 스크립트를 통해 개별적으로 전환할 수 있습니다.

> **팁**
>
> 계층화된 액터 구현은 발전해 왔으며 현재는 (일반과 달리) 모든 렌더링 기능을 지원하여 가장 유연합니다. 레이어 표현식을 사용하고 싶지 않지만 대신 Unity의 애니메이터나 기타 사용자 정의 시스템을 사용하여 모양을 제어하는 ​​경우에도 마찬가지입니다. 또는 파티클 시스템과 같은 중요하지 않은 개체를 렌더링하거나 타사 렌더러를 활용해야 하는 경우 일반 또는 사용자 정의 구현을 예약하기 전에 계층화된 액터에 사용할 수 있는 [렌더 전용](https://naninovel.com/guide/characters#outsourcing-appearance-management) 및 [카메라 렌더링](https://naninovel.com/guide/characters#camera-rendering) 옵션을 확인하세요.

계층화된 배경 프리팹을 만들려면 *Create -> Naninovel -> Background -> Layered* 에셋 컨텍스트 메뉴를 사용하세요.

레이어를 구성하려면 [프리팹 편집 모드](https://docs.unity3d.com/Manual/EditingInPrefabMode.html)로 들어가세요. 기본적으로 여러 레이어와 그룹이 생성됩니다. 이를 사용하거나 직접 삭제하고 추가할 수 있습니다.

레이어드 배경은 [레이어드 캐릭터](https://naninovel.com/guide/characters#layered-characters)와 매우 유사합니다. naninovel 스크립트를 통해 설정하고 제어하는 ​​방법에 대한 자세한 내용은 설명서를 참조하세요.

@back 명령의 이름 없는 매개 변수는 모양 및 전환 유형(@char 명령의 ID 및 모양이 아님)을 예상하므로 다음과 같은 방식으로 레이어 구성 표현식을 지정합니다.

; “LayeredForest” 배경 액터 지정  
@back Group>Layer,Other/Group+Layer,-RootLayer.TransitionType id:LayeredForest

## 일반(제네릭) 배경

일반 배경은 가장 유연한 배경 액터 구현입니다.

이는 루트 개체에 연결된 *Generic Background Behaviour* 구성 요소가 있는 프리팹을 기반으로 합니다. 모양 변경 및 기타 모든 배경 매개변수는 [Unity 이벤트](https://docs.unity3d.com/Manual/UnityEvents.html)로 라우팅되므로 원하는 방식으로 기본 개체의 동작을 구현할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-backgrounds-2.avif)
> **경고**
>
> 일반 행위자 구현은 시나리오 스크립트에서 이벤트를 라우팅할 뿐이며 기본 동작(예: 행위자가 모양이나 가시성 변경 명령에 어떻게 반응해야 하는지, 종횡비 변경에 적응할지 여부와 방법 등)을 구현하는 것은 사용자의 몫입니다. 대부분의 액터 관련 기능이 일반 구현에서 자동으로 작동할 것이라고는 기대할 수 없습니다.

템플릿에서 일반 배경 프리팹을 만들려면 *Create -> Naninovel -> Background -> Generic* 컨텍스트 에셋 메뉴를 사용하세요.

제네릭 배경은 제네릭 캐릭터와 매우 유사합니다.

가능한 사용 예 중 하나를 보려면 애니메이션 3D 모델을 일반 캐릭터로 설정하는 방법에 대한 튜토리얼 비디오를 확인하세요.

비디오는 이전 Naninovel 버전으로 캡처되었으며 현재 일부 속성 및 구성 요소 이름이 다릅니다. 최신 정보는 위 문서를 참조하세요.

**팁**

동일한 프레임에서 게임 개체가 활성화/비활성화되면 Unity의 *Animator* 컴포넌트가 *SetTrigger*를 등록하지 못할 수 있습니다. *GameObject.SetActive*를 사용하여 가시성 변경을 처리하는 경우(위 튜토리얼에 표시된 대로) 대신 렌더러를 사용하여 하위 개체를 활성화/비활성화하는 것이 좋습니다.

**예제**

애니메이션 스프라이트를 호스팅하는 데 일반 배경 구현이 사용되는 [GitHub](https://naninovel.com/guide/samples#generic-actor)에서 예제 프로젝트를 찾아보세요.

---

## 씬 배경

유니티 씬을 씬 배경 구현에 사용할 수도 있습니다.

Assets/Scenes 폴더 내에 새로운 씬을 생성(기존 씬을 이동도 동일)했을 때 씬 내부의 루트 게임 오브젝트에 카메라 컴포넌트가 최소 1개는 존재해야 합니다.

씬 배경을 로드할 때 Naninovel은 씬에서 처음 발견한 카메라에 렌더 텍스처를 할당합니다.

이후 렌더 텍스처는 배경 스프라이트에 할당되어 Naninovel 씬 공간 내부의 장면 배경으로 나타납니다. 이렇게 함으로써 씬 배경이 다른 배경 및 캐릭터 액터와 동시에 존재할 수 있고 모든 배경 전환(트랜지션) 효과를 지원하며 다양한 디스플레이 종횡비를 대응이 가능해 집니다.

단일 nanovel 스크립트에서 참조되는 경우처럼,

씬 오브젝트를 월드 공간에 배치하여, 동시에 로드될 수 있는 다른 씬의 오브젝트들과 겹치지 않도록 해야 합니다(예: 하나의 나니노벨 스크립트에서 참조될 때).

또한, 씬 배경 오브젝트가 글로벌 공간 원점(x0,y0,z0) 근처에 배치된 경우, 나니노벨의 메인 카메라에 의해 렌더링될 수 있다는 점에 유의해야 합니다. 이를 방지하려면, 모든 씬 오브젝트를 글로벌 원점에서 오프셋하거나, *Configuration -> Engine -> Override Objects Layer*를 사용해 나니노벨 관련 오브젝트들을 [레이어](https://docs.unity3d.com/Manual/Layers.html)로 분리하세요.

씬 설정이 완료된 후 *Naninovel -> Configuration -> Backgrounds* 메뉴를 통해 새 배경 액터를 생성하고 *SceneBackground* 구현을 선택한 다음 장면 자산을 액터 리소스에 추가합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-backgrounds-1.avif)

**주의**

리소스 이름은 할당된 씬 에셋명과 동일해야 합니다. 그렇지 않으면 Naninovel이 런타임에 씬을 찾아 로드할 수 없습니다.

씬 배경 액터에 리소스를 할당할 때 해당 씬 에셋이 자동으로 [빌드 설정](https://docs.unity3d.com/Manual/BuildSettings.html)에 추가되어야 합니다. 씬 에셋이 빌드에 추가되지 않았다는 오류가 발생하는 경우 수동으로 추가해 보세요.

@back 명령을 사용하여 생성된 씬 배경 액터를 제어할 수 있습니다. 예:

```
; 'TestScene1' Unity 장면의 콘텐츠와 함께 'Scene' 배경 액터를 표시합니다.
@back TestScene1 id:Scene

; 'RandomCircleReveal' 효과를 사용하여 액터를 'TestScene2'로 전환합니다.
@back TestScene2.RandomCircleReveal ID:Scene
```

> **팁**
>
> Unity 씬 배경을 구성할 때 각 외형에 대해 여러 장면을 생성하는 대신 장면 상태를 제어하기 위한 [커스텀 명령어](https://naninovel.com/guide/custom-commands)(예: 조명 색상을 수정하여 시간 변경 또는 카메라를 이동하여 보기 변경)추가를 고려해 보세요. 이렇게 하면 여러 씬을 로드할 때 겹치는 것을 방지하기 위해 개체 포지션(z-순서)를 추적할 필요가 없습니다.

---

## 텍스처 렌더

제네릭을 제외한 모든 구현 방식은 캐릭터나 배경 액터를 텍스처 자산으로 렌더링할 수 있습니다.

이것은 커스텀 UI, 다이얼로그 출력기, 머테리얼 또는 기타 호환 가능한 소스에 할당할 수 있습니다. 배경 액터의 텍스처 렌더링을 설정하는 것은 캐릭터의 렌더링과 매우 유사합니다.

자세한 정보와 예시는 [가이드](https://naninovel.com/guide/characters#render-to-texture)를 확인하세요.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)