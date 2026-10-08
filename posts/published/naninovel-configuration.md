---
title: "[26년 2월] 나니노벨 Configuration"
url: https://subculturegamer.com/naninovel-configuration/
published: 2024-12-30
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’ Configuration의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/configuration)

※마지막 수정일: 2026/5/13

---

엔진 구성(Configuration)은 *Assets/NaninovelData/Resources/Naninovel/Configuration* 폴더에 있는 스크립팅 가능한 다양한 개체 에셋에 저장됩니다. Unity 에디터에서 해당 구성 메뉴를 처음 열 때 자동으로 생성됩니다.

*Naninovel – Configuration* 또는 *Edit -> Project Settings -> Naninovel*으로 구성 메뉴에 진입할 수 있습니다.

모든 구성 메뉴는 [Unity 프리셋 기능](https://docs.unity3d.com/Manual/Presets)을 지원합니다. 여러 구성 프리셋을 만드는 것이 다양한 대상 플랫폼(예: 모바일, 스탠드얼론, 콘솔 등)에 배포할 때 유용할 수 있습니다.

[](https://naninovel.com/imgit/encoded/i.gyazo.com-55f5c74bfc16e1af2455034647525df3.mp4@main.mp4)

런타임에 구성 객체를 수정하고, 새 커스텀 구성을 추가하고, 런타임에 객체에 액세스하는 방식을 변경할 수 있습니다(예: 원격 호스트에 저장된 JSON 파일에서 구성 읽어오기). 자세한 내용은 [커스텀 구성 가이드](https://naninovel.com/guide/custom-configuration)를 참조하세요.

---

## Audio

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Audio Loader | Audio- (Addressable, Project) | 오디오(BGM 및 SFX) 리소스와 함께 사용되는 리소스 로더 구성입니다. |
| Voice Loader | Voice- (Addressable, Project) | 음성 리소스와 함께 사용되는 리소스 로더 구성입니다. |
| Audio Player | Naninovel Audio Player | IAudioPlayer 시행은 오디오 클립 재생을 담당합니다. |
| Default Master Volume | 1 | 게임을 처음 시작할 때 설정하는 마스터 볼륨입니다. |
| Default Bgm Volume | 1 | 게임을 처음 시작할 때 설정하는 BGM 볼륨입니다. |
| Default Sfx Volume | 1 | 게임을 처음 시작할 때 설정할 SFX 볼륨입니다. |
| Default Voice Volume | 1 | 게임을 처음 시작할 때 설정하는 보이스 볼륨입니다. |
| Enable Auto Voicing | False | 활성화 시, 매 [`@print`](https://naninovel.com/api/#print) 명령어는 연관된 보이스 클립을 재생하려고 시도합니다. |
| Voice Overlap Policy | Prevent Overlap | 동시 음성 재생을 처리하는 방법을 지정합니다. • Allow Overlap(중첩 허용) — 보이스가 서로 겹치는 상황을 허용합니다. • Prevent Overlap(중첩 방지) — 새 보이스 클립이 재생되어야할 때 이미 출력중인 보이스가 있다면 강제 중지하여 보이스 중첩을 방지합니다. • Prevent Character Overlap(캐릭터 중첩 방지) — 동일한 캐릭터만 보이스 출력 시 보이스가 중첩되는 것을 막습니다. 다양한 캐릭터의 보이스(오토 보이스)와 @voice 명령어를 동시에 수행할 수 있습니다. |
| Voice Locales | Null | 기본 로컬라이즈와 별도로 게임 설정에서 음성 언어를 선택할 수 있도록 로컬라이즈 태그를 할당하세요. |
| Default Fade Duration | 0.35 | 오디오 재생을 시작하거나 중지할 때 볼륨 페이드 인/아웃의 기본 지속 시간입니다. |
| Play Sfx While Skipping | True | 스킵 중에 SFX(루프되지 않는 사운드 이펙트)를 출력시킬 것인가에 대한 설정입니다. 비활성화 시, ‘loop!’ 명령어가 없는 한 @sfx 명령어는 모두 무시될 것입니다. |
| Custom Audio Mixer | Null | 오디오 그룹을 제어하는 ​​오디오 믹서. 지정하지 않으면 기본 값을 사용합니다. |
| Master Group Path | Master | 마스터 볼륨을 제어하는 ​​믹서 그룹의 경로입니다. |
| Master Volume Handle Name | Master Volume | 마스터 볼륨을 제어하는 ​​믹서 핸들(노출되는 파라미터)의 이름입니다. |
| Bgm Group Path | Master/BGM | 배경음악의 볼륨을 조절하는 믹서 그룹의 경로입니다. |
| Bgm Volume Handle Name | BGM Volume | 배경 음악 볼륨을 제어하는 ​​믹서 핸들(노출되는 파라미터)의 이름입니다. |
| Sfx Group Path | Master/SFX | SFX 볼륨을 제어하는 ​​믹서 그룹의 경로입니다. |
| Sfx Volume Handle Name | SFX Volume | SFX 볼륨을 제어하는 ​​믹서 핸들(노출되는 파라미터)의 이름입니다. |
| Voice Group Path | Master/Voice | 보이스 볼륨을 제어하는 ​​믹서 그룹의 경로입니다. |
| Voice Volume Handle Name | Voice Volume | 보이스 볼륨을 제어하는 ​​믹서 핸들(노출되는 파라미터)의 이름입니다. |

## Backgrounds

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Default Metadata | Object Ref | 배경 액터 생성 시 기본적으로 사용하는 메타데이터와 생성된 액터 ID에 대한 커스텀 메타데이터가 존재하지 않을 시 기본값이 사용됩니다. |
| Metadata | Object Ref | 특정 ID를 가진 배경 액터를 생성할 때 사용할 메타데이터입니다. |
| Shared Poses | Object Ref | 지정된 상태(포즈)는 배경 간에 공유됩니다. 포즈 이름은 마치 배리에이션처럼 쓰이며, [@back](https://naninovel.com/api/#back) 명령어가 연관 상태의 속성을 활성화하는 데 사용됩니다. |
| Scene Origin | (0.50, 0.00) | 관리형 액터의 원점으로 간주되는 씬의 참조점입니다. 위치 지정에는 영향을 주지 않습니다. |
| Z Offset | 100 | 액터 생성 시 Z축 기준으로 액터가 카메라로부터 이 수치만큼 (깊이)떨어져있도록 세팅하는 값입니다. |
| Z Step | 0.1 | 액터가 생성될 때 액터 사이에 설정할 Z축별 거리입니다. z-fighting 문제를 방지하는 데 사용됩니다. |
| Default Duration | 0.35 | 모든 액터 조정(외모, 위치, 색조 등 변경) 시의 기본 기간(초)입니다. |
| Default Easing | Linear | 모든 액터 조정 애니메이션(모양, 위치, 색조 등 변경)에 기본적으로 사용되는 이징 기능입니다. |
| Auto Show On Modify | True | 조정 명령어 실행 시 액터를 자동으로 공개(표시)할지 여부입니다. |

## Camera

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Reference Resolution | (1920, 1080) | 레퍼런스 해상도는 액터가 씬에 올바르게 배치되도록 적절한 렌더링 넓이를 측정하는 데 사용됩니다. 경험상 이 값은 게임용으로 만드는 배경 텍스처의 해상도와 동일하게 설정하시기를 권장합니다. |
| Reference PPU | 100 | 씬 단위에 해당하는 픽셀 수입니다. 이를 줄이면 모든 액터가 더 작게 보이거나 그 반대로 동작합니다. 대부분의 경우 기본값 100이 권장됩니다. |
| Match Screen Width | False | 레퍼런스 씬 직사각형 너비가 화면 너비와 일치해야 하는지 여부입니다. 활성화 시, 상대적으로(씬) 위치 측정은 화면 테두리를 원점으로 사용합니다. 그렇지 않으면(False) 레퍼런스 해상도가 사용됩니다. |
| Initial Position | (0.00, 0.00, -10.00) | 관리형 카메라의 초기 월드 위치입니다. |
| Custom Camera Prefab | Null | 렌더링에 사용할 카메라 컴포넌트가 있는 프리팹입니다. 지정되지 않은 경우 디폴트를 사용합니다. 일부 카메라 속성(배경색, FOV, HDR 등)을 설정하거나 포스트 프로세싱을 추가하려는 경우 원하는 카메라 설정으로 프리팹을 생성하고 이 필드에 프리팹을 할당합니다. |
| Use UI Camera | True | 전용 카메라로 UI를 렌더링할지 여부입니다. 이 옵션은 이전 버전과의 호환성을 위한 것이므로 새 프로젝트에서는 비활성화하면 안 됩니다. 비활성화되면 문제가 발생할 수 있습니다(예: 카메라 애니메이션에서 지속적인 uGUI 레이아웃 재구축). |
| Custom UI Camera Prefab | Null | UI 렌더링에 사용할 카메라 컴포넌트가 있는 프리팹입니다. 지정되지 않은 경우 디폴트를 사용합니다. `Use UI Camera` 옵션 비활성 시 효과가 없습니다. |
| Default Duration | 0.35 | 모든 카메라 수정(확대/축소, 위치, 회전 등 변경)에 대한 기본 기간(초)입니다. |
| Default Easing | Linear | 모든 카메라 수정(줌, 위치, 회전 등 변경)에 기본적으로 사용되는 이징 기능입니다. |
| Thumbnail Resolution | (240, 140) | 게임 저장 슬롯을 미리 볼 수 있는 썸네일이 캡처되는 해상도입니다. |
| Hide UI In Thumbnails | False | 썸네일 캡처 시 UI 레이어를 무시할지 여부입니다. |

## Characters

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Auto Arrange On Add | True | 새 캐릭터를 추가할 때 지정된 위치 없이 캐릭터를 X축으로 균등하게 배치할지 여부입니다. |
| Arrange Range | (0.00, 1.00) | 캐릭터가 배치되는 범위를 씬 너비를 기준으로 나타내는 시작(x) 및 끝(y) 위치(0.0~1.0 범위)입니다. |
| Default Metadata | Object Ref | 배경 액터 생성 시 기본적으로 사용하는 메타데이터와 생성된 액터 ID에 대한 커스텀 메타데이터가 존재하지 않을 시 기본값이 사용됩니다. |
| Metadata | Object Ref | 특정 ID를 가진 배경 액터를 생성할 때 사용할 메타데이터입니다. |
| Avatar Loader | Character Avatars- (Addressable, Project) | 캐릭터 아바타 텍스처 리소스와 함께 사용되는 리소스 로더의 구성입니다. |
| Shared Poses | Object Ref | 지정된 상태(포즈)는 캐릭터 간에 공유됩니다. 포즈 이름은 마치 배리에이션처럼 쓰이며, [@char](https://naninovel.com/api/#char) 명령어가 연관 상태의 속성을 활성화하는 데 사용됩니다. |
| Scene Origin | (0.50, 0.00) | 관리형 액터의 원점으로 간주되는 씬의 참조점입니다. 위치 지정에는 영향을 주지 않습니다. |
| Z Offset | 50 | 액터 생성 시 Z축 기준으로 액터가 카메라로부터 이 수치만큼 (깊이)떨어져있도록 세팅하는 값입니다. |
| Z Step | 0.1 | 액터가 생성될 때 액터 사이에 설정할 Z축별 거리입니다. z-fighting 문제를 방지하는 데 사용됩니다. |
| Default Duration | 0.35 | 모든 액터 조정(외모, 위치, 색조 등 변경) 시의 기본 기간(초)입니다. |
| Default Easing | Smooth Step | 모든 액터 조정 애니메이션(모양, 위치, 색조 등 변경)에 기본적으로 사용되는 이징 기능입니다. |
| Auto Show On Modify | True | 조정 명령어 실행 시 액터를 자동으로 공개(표시)할지 여부입니다. |

## Choice Handlers

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Default Handler Id | Button List | 기본적으로 사용할 선택지 처리기의 ID입니다. |
| Choice Button Loader | – (Addressable, Project) | 커스텀 선택지 버튼을 로드하는 데 사용되는 리소스 로더의 구성입니다. |
| Default Metadata | Object Ref | 배경 액터 생성 시 기본적으로 사용하는 메타데이터와 생성된 액터 ID에 대한 커스텀 메타데이터가 존재하지 않을 시 기본값이 사용됩니다. |
| Metadata | Object Ref | 특정 ID를 가진 배경 액터를 생성할 때 사용할 메타데이터입니다. |
| Default Duration | 0.35 | 모든 액터 조정(외모, 위치, 색조 등 변경) 시의 기본 기간(초)입니다. |
| Default Easing | Linear | 모든 액터 조정 애니메이션(모양, 위치, 색조 등 변경)에 기본적으로 사용되는 이징 기능입니다. |
| Auto Show On Modify | True | 조정 명령어 실행 시 액터를 자동으로 공개(표시)할지 여부입니다. |

## Custom Variables

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Predefined Variables | Object Ref | 기본적으로 초기화할 변수 목록입니다. 전역 변수(g\_로 시작하는 이름)는 첫 번째 애플리케이션 시작 시 초기화되고 다른 변수는 각 상태 재설정 시 초기화됩니다. |

## Engine

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Override Objects Layer | False | 모든 엔진 오브젝트에 특정 레이어를 할당할지 여부입니다. 엔진의 카메라는 컬링 마스크에 레이어를 사용합니다. 이를 사용하여 Naninovel 오브젝트가 다른 카메라에 의해 렌더링되지 않도록 격리합니다. |
| Objects Layer | 0 | `Override Objects Layer` 옵션 활성화 시, 지정된 레이어가 모든 엔진 오브젝트에 할당됩니다. |
| Async Exception Log Type | Error | UniTask 관련 예외 처리에 사용할 로그 타입입니다. |
| Async Instantiation | True | 엔진 오브젝트의 인스턴스화에 Object.InstantiateAsync를 사용하여 대부분의 관련 작업을 메인 스레드 외부로 이동시킵니다. 문제가 발생하지 않는 한 활성화된 상태를 유지하세요. |
| Initialize On Application Load | True | 애플리케이션 시작 시 엔진을 자동으로 초기화할지 여부입니다. |
| Scene Independent | True | 엔진 오브젝트에 `DontDestroyOnLoad`를 적용하여 어떤 로드된 씬과 그 수명을 독립적으로 구성합니다. 비활성화 시 오브젝트는 엔진이 실행된 Unity 씬의 일부가 되며 씬이 언로드될 때 삭제됩니다. |
| Show Initialization UI | True | 엔진이 초기화되는 동안 로딩 UI를 표시할지 여부입니다. |
| Custom Initialization UI | Null | 엔진이 초기화되는 동안 표시되는 UI입니다(활성화된 경우). 지정되지 않은 경우 디폴트를 사용합니다. |
| Enable Bridging | True | 외부 Naninovel 도구(IDE 확장, 웹 편집기 등)와 통신하기 위해 브리징 서버를 자동으로 시작할지 여부입니다. |
| Auto Generate Metadata | True | Unity 에디터가 시작될 때나 C# 스크립트를 컴파일한 후, 프로젝트 메타데이터를 자동으로 생성할지 여부입니다. |
| Enable Development Console | True | 개발 콘솔을 활성화할지 여부입니다. |
| Debug Only Console | False | 활성화 시, 개발 콘솔은 개발(디버그) 빌드에서만 사용할 수 있습니다. |

## Input

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Spawn Event System | True | 초기화 시 이벤트 시스템을 생성할지 여부입니다. |
| Custom Event System | Null | 입력 프로세싱을 위해  `EventSystem` 컴포넌트를 스폰하는 프리팹입니다. 미 지정 시, 디폴트가 스폰됩니다. |
| Spawn Input Module | True | 초기화 시 입력 모듈을 생성할지 여부입니다. |
| Custom Input Module | Null | 입력 프로세싱를 위해 InputModule 컴포넌트를 스폰하는 프리팹입니다. 지정하지 않으면 디폴트가 생성됩니다. |
| Input Actions | Null | Unity의 새로운 입력 시스템이 설치되면 이곳에 입력 액션 에셋을 할당하세요. 입력 액션을 Naninovel의 입력 바인딩에 매핑하려면 Naninovel 액션 맵을 만들고 바인딩 이름과 동일한 이름을 가진 액션을 추가합니다(아래 `Control Scheme` – Bindings list). 2차원(Vector2) 축은 지원되지 않습니다. |
| Process Legacy Bindings | True | 레거시 입력 바인딩을 처리할지 여부입니다. Unity의 새 입력 시스템을 사용하고 있고 입력 작업 외에 레거시 바인딩이 작동하는 것을 원하지 않는 경우에는 비활성화하세요. |
| Touch Frequency Limit | 0.1 | 등록된 터치 입력의 빈도를 초 단위로 제한합니다. 레거시 입력에만 해당됩니다. |
| Touch Distance Limit | 25 | 등록된 터치 입력의 거리를 픽셀 단위로 제한합니다. 레거시 입력에만 해당됩니다. |
| Detect Input Mode | True | 관련 장치가 활성화되면 입력 모드를 변경할지 여부입니다. 예를 들어, 게임패드 버튼을 누르면 게임패드로 전환되고, 마우스 버튼을 클릭하면 다시 마우스로 전환됩니다. 새로운 입력 시스템이 필요합니다. |
| Bindings | Object Ref | 입력을 처리하기 위한 바인딩입니다. ‘Input Processing’ 가이드에서 각 디폴트 입력에 대한 설명을 찾을 수 있습니다. |

## Localization

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Loader | Localization- (Addressable, Project) | 로컬라이즈 리소스와 함께 사용되는 리소스 로더의 구성입니다. |
| Languages | Object Ref | RFC5646 언어 태그는 디폴트 언어 표시 이름에 매핑됩니다. 변경 사항을 적용하려면 Unity 에디터를 다시 시작하세요. |
| Source Locale | En | 소스 프로젝트 리소스의 로케일(프로젝트 에셋이 작성되는 언어) |
| Default Locale | Null | 게임을 처음 실행할 때 기본적으로 선택되는 로케일입니다. 지정되지 않은 경우 `Source Locale`을 선택합니다. |
| Auto Detect Locale | True | 활성화되고 게임이 처음 실행되면 시스템 언어를 기반으로 로케일을 자동으로 감지하려고 시도합니다. 성공하고 해당 로케일이 게임에서 지원되면 이를 선택합니다. 그렇지 않으면 ‘디폴트 로케일’로 돌아갑니다. |
| Record Separator |  |  |
| Annotation Prefix | > | 번역된 텍스트와 구별하기 위해 주석 줄 앞에 삽입할 텍스트 문자입니다. 주석은 번역자에게 출력된 텍스트 메시지, 인라인 명령어 및 로컬라이즈 된 파라미터가 포함된 명령어 라인의 작성자와 같은 추가적인 맥락을 제공하기 위해 생성된 로컬라이즈 문서에 옵션으로 추가되는 설명입니다. 스텁 문자는 이러한 주석의 로컬라이즈된 부분을 대체하는 데 사용됩니다. 이는 로컬라이즈할 텍스트가 포함된 다음 주석 줄에 중복되기 때문입니다. |

## Managed Text

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Loader | Text- (Addressable, Project) | 관리형 텍스트 문서와 함께 사용되는 리소스 로더의 구성입니다. |
| Multiline Documents | Object Ref | 멀티라인 포맷을 사용할 관리형 텍스트 문서의 로컬 리소스 경로입니다. |

## Movies

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Loader | Movies- (Addressable, Project) | 영상 리소스와 함께 사용되는 리소스 로더 구성입니다. |
| Skip On Input | True | 유저가 Cancel 입력 키를 활성화했을 때 영상 재생을 스킵할지 여부입니다. |
| Skip Frames | True | 현재 시간을 따라잡기 위해 프레임을 건너뛸지 여부입니다. |
| Fade Duration | 1 | 영상 재생을 시작/종료하기 전에 페이드 인/아웃되는 시간(초)입니다. |
| Custom Fade Texture | Null | 페이딩되는 동안 표시할 텍스처입니다. 지정하지 않으면 단순한 검은색 텍스처를 사용합니다. |
| Play Intro Movie | False | 엔진 초기화 후 메인 메뉴 표시 전 자동으로 영상을 재생할지 여부입니다. |
| Intro Movie Name | Null | 인트로 영상 리소스 경로입니다. |

## Resource Provider

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Resource Policy | Conservative | 스크립트 실행 중 리소스가 로드 및 언로드되는 시기를 지정합니다. • Conservative — 균형 잡힌 메모리 활용을 제공하는 기본 모드입니다. 스크립트 실행에 필요한 모든 리소스는 재생을 시작할 때 미리 로드되고 스크립트 재생이 끝나면 언로드됩니다. 참조된 스크립트 [`@gosub`](https://naninovel.com/api/#gosub) 명령어도 미리 로드되어 있습니다. 추가 스크립트도 [`@goto`](https://naninovel.com/api/#goto) 명령어의 hold 매개변수를 이용하여 미리 로드할 수 있습니다. • Optimistic — 재생된 스크립트에 필요한 모든 리소스와 @goto 및 @gosub 명령어에 지정된 모든 스크립트의 모든 리소스는 미리 로드되며 @goto 명령어의 release 파라미터가 지정되지 않는 한 언로드되지 않습니다. 이렇게 하면 로딩 씬이 최소화되고 원활한 롤백이 가능하지만 리소스를 언로드해야 하는 시기를 수동으로 지정해야 하므로 메모리 부족 예외가 발생할 위험이 높아집니다. |
| Remove Actors | True | 스크립트 리소스를 언로드할 때 사용하지 않는 액터(캐릭터, 배경, 텍스트 출력기 및 선택지 처리기)를 자동으로 언로드할지 여부입니다. 활성화된 경우에도 언제든지 @remove 명령어로 액터를 수동으로 언로드할 수 있습니다. |
| Log Resource Loading | False | 리소스 언로드/로드 작업을 기록할지 여부입니다. |
| Enable Build Processing | True | Naninovel 리소스로 할당된 에셋을 처리하기 위해 커스텀 빌드 플레이어 핸들을 등록할지 여부입니다.  경고: 이 설정을 적용하려면 Unity 에디터를 다시 시작해야 합니다. |
| Use Addressables | True | Addressable Asset System이 설치된 경우 이 속성을 활성화하면 에셋 처리 단계가 최적화되어 빌드 시간이 향상됩니다. |
| Auto Build Bundles | True | 유니티 플레이를 위한 빌드 시 어드레서블 에셋 번들을 자동으로 빌드할지 여부입니다. `Use Addressables` 옵션 비활성화 시 효력이 없습니다. |
| Allow Addressable In Editor | False | 에디터에서 어드레서블 가능한 제공자를 사용할지 여부입니다. Naninovel의 리소스 관리자를 사용하여 할당하는 대신 어드레서블 주소로 리소스를 수동으로 노출하는 경우 활성화합니다. 이 기능을 활성화하면 리소스 관리자에서 리소스를 할당하고 어드레서블 가능한 주소로 등록한 뒤 이름을 바꾸거나 복제할 때 문제가 발생할 수 있습니다. |
| Label By Scripts | True | 사용된 시나리오 스크립트 경로에 따라 모든 나니노벨 어드레서블 에셋에 레이블을 지정할지 여부.  어드레서블 그룹 설정에서 Bundle Mode가 `Pack Together By Label`로 설정된 경우 번들 패키징이 더욱 효율적으로 이루어집니다.  스크립트 레이블은 어드레서블 리소스 공급자에 수동으로 노출된 에셋을 포함하는 ‘나니노벨’ 레이블이 있는 모든 에셋에 할당됩니다(리소스 에디터 메뉴를 사용하지 않음). |
| Group By Category | False | Naninovel 리소스 범주(스크립트, 캐릭터, 오디오 등)별로 어드레서블 그룹을 생성할지 여부. 비활성화 시, 모든 리소스에 대해 단일 나니노벨 그룹을 사용합니다. |
| Extra Labels | Null | 어드레서블 공급자가 Naninovel 레이블 외에 연관된 추가 레이블이 있는 경우에 작동하게 합니다. 사용자 정의 기준을 기반으로 엔진에서 사용하는 에셋을 필터링하는 데 사용할 수 있습니다. (예: HD vs SD 텍스처) |
| Local Root Path | %DATA%/Resources | 로컬 리소스 공급자에 사용할 경로 루트입니다. 리소스가 있는 폴더의 절대 경로이거나 사용 가능한 원본 중 하나의 상대 경로일 수 있습니다. • %DATA% — 대상 디바이스의 게임 데이터 폴더 (UnityEngine.Application.dataPath). • %PDATA% — 대상 디바이스의 영구 데이터 디렉터리 (UnityEngine.Application.persistentDataPath). • %STREAM% — `StreamingAssets` 폴더 (UnityEngine.Application.streamingAssetsPath). • %SPECIAL{F}% — OS 특수 폴더(여기서 F는 System.Environment.SpecialFolder의 값)입니다. |
| Video Stream Extension | .mp 4 | WebGL에서 비디오(동영상, 비디오 배경)를 스트리밍하는 경우 비디오 파일의 확장자를 지정합니다. |
| Project Root Path | Naninovel | 상대 경로 `Resources` naninovel 관련 에셋이 있는 폴더입니다. |

## Script Player

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Default Skip Mode | Read Only | 게임이 처음 시작될 때 설정되는 기본 스킵 모드입니다. |
| Skip Time Scale | 10 | 건너뛰기(빨리 감기) 모드에 있을 때 사용할 시간 척도입니다. |
| Min Auto Play Delay | 1 | 자동 재생 모드에서 다음 명령을 실행하기 전에 대기하는 최소 시간(초)입니다. |
| Complete On Continue | True | 계속 입력이 활성화될 때 시간이 지남에 따라 수행되는 차단 명령( `wait!`)을 즉시 완료할지 여부. (예: 애니메이션, 숨기기/표시, 색조 변경 등) |
| Show Debug On Init | False | 엔진 초기화 시 플레이어 디버그 창을 표시할지 여부입니다. |
| Wait By Default | False | wait 매개변수가 명시적으로 지정되지 않은 경우 재생된 명령을 기다릴지 여부입니다. 대기 가능한(비동기) 명령에만 적용 가능합니다.  경고: 이 옵션은 이전 버전과의 호환성을 위해 유지되며 다음 릴리스에서 제거될 예정이므로 새 프로젝트에서는 활성화하지 마십시오. |
| Show Loading UI | True | 스크립트가 사전/로드되는 동안 ILoadingUI를 표시할지 여부입니다. 로딩 화면에서 리소스 로딩 프로세스를 마스킹할 수 있습니다. |
| Resolve Mode | Nearest | 게임 상태를 로드할 때 스크립트 플레이어가 누락된 재생 지점을 처리하는 모드입니다. 이는 플레이어가 시나리오 스크립트 진행 도중 게임을 저장했는데 스크립트가 변경된 경우(예: 게임 업데이트 등) 저장된 재생 지점(라인 및 인라인 인덱스)을 더 이상 사용할 수 없을 때 발생할 수 있습니다. • Nearest — 가장 가까운 다음 지점에서 플레이를 시도합니다. 다음 지점을 찾을 수 없는 경우(스크립트가 더 짧아지는 등) 가장 가까운 이전 지점부터 시작합니다. 가장 관대한 모드이지만 정의되지 않은 동작이 일어날 수 있습니다. • Restart — 처음부터 현재 스크립트 재생을 시작합니다. 모든 상태가 시나리오 스크립트에 로컬인 경우 정의되지 않은 동작이 발생하지 않지만 플레이어는 시작 시 스크립트를 다시 재생해야 합니다. • Error — 오류가 발생합니다. 정의되지 않은 동작이 허용되지 않는 경우 이 옵션을 선택하십시오. |

## Scripts

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Loader | Scripts- (Addressable, Project) | naninovel 스크립트 리소스와 함께 사용되는 리소스 로더 구성입니다. |
| Script Parser | Naninovel Script Asset Parser | 텍스트에서 스크립트 에셋을 생성하는 데 사용하는 IScriptParser 구현입니다. 변경 사항을 적용하려면 이 설정을 수정한 후 스크립트 에셋을 다시 가져오세요. |
| Compiler Localization | (Naninovel.Compiler Localization) | 로케일별 NaniScript 컴파일러 옵션. 메타데이터 동기화 시 IDE 확장으로 전파됩니다. 변경 사항을 적용하려면 Unity 에디터를 다시 시작하고 스크립트 에셋을 다시 가져오세요. |
| Stable Identification | False | 가져온 스크립트의 모든 로컬라이즈 가능한 텍스트 파라미터에 식별자를 자동으로 쓸지 여부입니다. 텍스트 콘텐츠를 편집하는 동안 연결(예: 로컬라이즈 및 보이스오버)을 유지할 수 있습니다. 변경 사항을 적용하려면 스크립트를 다시 가져와야 합니다. |
| Initialization Script | Null | 엔진 초기화 직후 재생할 스크립트의 로컬 리소스 경로입니다. |
| Title Script | Null | 타이틀 UI를 표시할 때 재생할 스크립트의 로컬 리소스 경로입니다. 타이틀 화면 장면(배경, 음악 등)을 설정하는 데 사용할 수 있습니다. |
| Start Game Script | Null | 새 게임을 시작할 때 재생할 스크립트의 로컬 리소스 경로입니다. 지정되지 않은 경우 가장 처음 사용됩니다. |
| Auto Add Scripts | True | 생성된 naninovel 스크립트를 리소스에 자동으로 추가할지 여부입니다. |
| Auto Resolve Path | True | 스크립트가 생성되거나 이름이 바뀌거나 이동할 때마다 리소스 경로를 자동으로 확인하고 업데이트할지 여부입니다. |
| Hot Reload Scripts | True | 수정된(시각적 및 외부 편집기를 통해) 스크립트를 다시 로드하고 재생을 다시 시작하지 않고 재생 모드 중에 변경 사항을 적용할지 여부입니다. |
| Watch Scripts | True | ‘.nani’ 파일에 대해 파일 시스템 감시자를 실행할지 여부입니다. 외부 애플리케이션으로 편집할 때 스크립트 변경 사항을 등록하는 데 필요합니다. |
| Show Script Navigator | False | 엔진이 초기화된 후 스크립트 탐색기 UI를 자동으로 표시할지 여부(UI 리소스에서 사용 가능한 ‘IScriptNavigatorUI’ 필요) |
| Enable Visual Editor | True | 스크립트를 선택할 때 비주얼 스크립트 에디터를 표시할지 여부입니다. |
| Hide Unused Parameters | True | 명령어 라인에 마우스를 올리거나 초점을 두지 않을 때 명령어 라인의 지정되지 않은 파라미터를 숨길지 여부입니다. |
| Select Played Script | True | 비주얼 에디터가 열려 있을 때 현재 재생 중인 스크립트를 자동으로 선택할지 여부입니다. |
| Insert Line Key | Space | 비주얼 에디터에 포커스가 있을 때 ‘라인 삽입’ 창을 표시하는 데 사용되는 단축키입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Insert Line Modifier | Control | ‘라인 키 삽입’에 대한 수정자입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Indent Line Key | Right Arrow | 줄 들여쓰기에 사용되는 단축키입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Indent Line Modifier | Control | ‘들여쓰기 라인 키’에 대한 수정자입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Unindent Line Key | Left Arrow | 줄 들여쓰기를 취소하는 데 사용되는 단축키입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Unindent Line Modifier | Control | ‘Unindent Line Key’에 대한 수정자입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Save Script Key | S | 비주얼 편집기에 포커스가 있을 때 편집된 스크립트를 저장(직렬화)하는 데 사용되는 단축키입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Save Script Modifier | Control | ‘스크립트 키 저장’에 대한 수정자입니다. 비활성화하려면 ‘None’으로 설정하세요. |
| Rewind Mouse Button | 0 | 비주얼 에디터에서 라인을 클릭했을 때 되감기를 활성화해야 하는 마우스 버튼: ‘0’은 왼쪽, ‘1’은 오른쪽, ‘2’는 가운데입니다. 비활성화하려면 ‘-1’로 설정하세요. |
| Rewind Modifier | Shift | ‘마우스 되감기 버튼’에 대한 수정자입니다. 비활성화하려면 ‘없음’으로 설정하세요. |
| Editor Page Length | 300 | 비주얼 에디터 페이지당 렌더링해야 하는 스크립트 라인의 수입니다. |
| Editor Custom Style Sheet | Null | 비주얼 에디터의 기본 스타일을 수정할 수 있습니다. |
| Graph Orientation | Horizontal | 그래프를 세로로 그릴지, 가로로 그릴지 여부입니다. |
| Graph Auto Align Padding | (10.00, 0.00) | 자동 정렬 시 각 노드에 추가할 여백값입니다. |
| Show Synopsis | True | 그래프 노드 내부에 스크립트의 첫 번째 주석 줄을 표시할지 여부입니다. |
| Graph Custom Style Sheet | Null | 스크립트 그래프의 기본 스타일을 수정할 수 있습니다. |
| Enable Community Modding | False | 빌드에 외부 naninovel 스크립트를 추가할 수 있는지 여부입니다. |
| External Loader | Scripts- (Local) | 외부 naninovel 스크립트 리소스와 함께 사용되는 리소스 로더 구성입니다. |

## Spawn

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Loader | Spawn- (Addressable, Project) | 스폰 리소스와 함께 사용되는 리소스 로더의 구성입니다. |

## State

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Save Folder Name | Naninovel Data/Saves | 게임 데이터 폴더 안에 저장 폴더가 생성됩니다. |
| Default Settings Slot Id | Settings | 전역 저장 파일의 이름입니다. |
| Default Global Slot Id | Global Save | The name of the global save file. |
| Save Slot Mask | Game Save{0:000} | 저장 슬롯의 이름을 지정하는 데 사용되는 마스크입니다. |
| Quick Save Slot Mask | Game Quick Save{0:000} | 빠른 저장 슬롯의 이름을 지정하는 데 사용되는 마스크입니다. |
| Save Slot Limit | 99 | 최대 저장 슬롯 개수. |
| Quick Save Slot Limit | 18 | 빠른 저장 슬롯의 최대 개수. |
| Binary Save Files | True | 저장 내용을 텍스트 파일(.json) 대신 바이너리 파일(.nson)로 압축하여 저장할지 여부입니다. 이렇게 하면 파일 크기가 크게 줄어들고 편집하기가 더 어려워지지만(부정행위 방지) 저장 및 로드 시 더 많은 메모리와 CPU 시간이 소모됩니다. |
| Reset On Goto | False | [@goto](https://naninovel.com/api/#goto) 명령어로 다른 스크립트를 로드할 때 엔진 서비스 상태를 재설정할지 여부입니다. 각 goto의 모든 리소스를 자동으로 언로드하기 위해 [@resetState](https://naninovel.com/api/#resetstate) 명령어 대신 사용할 수 있습니다. |
| Enable State Rollback | True | 플레이어가 스크립트를 뒤로 되돌릴 수 있도록 상태 롤백 기능을 활성화할지 여부입니다. |
| State Rollback Steps | 1024 | 런타임에 보관할 상태 스냅샷 수입니다. 롤백을 얼마나 멀리까지 수행할 수 있는지 결정합니다. 이 값을 늘리면 더 많은 메모리가 소모됩니다. |
| Saved Rollback Steps | 128 | 게임 저장 슬롯 아래에 저장할 상태 스냅샷 수입니다. 저장된 게임을 로드한 후 롤백을 수행할 수 있는 기간을 결정합니다. 이 값을 늘리면 저장 게임 파일이 커집니다. |
| Game State Handler | Naninovel Universal Game State Serializer | 로컬(세션별) 게임 상태를 역직렬화/직렬화하는 구현을 담당합니다. 커스텀 직렬화 처리기를 추가하는 방법에 대한 `State Management` 가이드를 참조하세요. |
| Global State Handler | Naninovel Universal Global State Serializer | 전역 게임 상태의 역직렬화/직렬화를 담당하는 구현입니다. 커스텀 직렬화 핸들러를 추가하는 방법에 대한 `State Management` 가이드를 참조하세요. |
| Settings State Handler | Naninovel Universal Settings State Serializer | 게임 설정 역직렬화/직렬화를 담당하는 구현입니다. 커스텀 직렬화 핸들러를 추가하는 방법에 대한 `State Management` 가이드를 참조하세요. |

## Text Printers

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| Default Printer Id | Dialogue | 기본적으로 사용할 텍스트 출력기의 ID입니다. |
| Default Base Reveal Speed | 0.5 | 게임을 처음 시작할 때 설정하는 기본 공개 속도(게임 설정)입니다. |
| Default Base Auto Delay | 0.5 | 게임을 처음 시작할 때 설정하는 기본 자동 지연(게임 설정)입니다. |
| Max Reveal Delay | 0.06 | 텍스트 메시지 출력 시 지연 제한(초)입니다. 특정 공개 속도는 게임 설정의 `message speed`로 제어됩니다. 이 값은 사용 가능한 범위를 정의합니다(값이 높을수록 표시 속도가 낮아짐). |
| Max Auto Wait Delay | 0.02 | 자동 재생 모드에서 계속 기다리는 동안 출력되는 각 문자당 지연 제한(초)입니다. 특정 지연은 게임 설정의 `auto delay`에서 설정됩니다. 이 값은 사용 가능한 범위를 정의합니다. |
| Scale Auto Wait | True | 출력 명령에 설정된 표시 속도에 따라 자동 재생 모드에서 대기 시간을 조정할지 여부입니다. |
| Default Metadata | Object Ref | 텍스트 출력기 생성 시 기본적으로 사용하는 메타데이터와 생성된 액터 ID에 대한 커스텀 메타데이터가 존재하지 않을 시 기본값이 사용됩니다. |
| Metadata | Object Ref | 특정 ID를 가진 텍스트 출력기 액터를 생성할 때 사용할 메타데이터입니다. |
| Scene Origin | (0.50, 0.00) | 관리형 액터의 원점으로 간주되는 씬의 참조점입니다. 위치 지정에는 영향을 주지 않습니다. |
| Z Offset | 0 | 액터 생성 시 Z축 기준으로 액터가 카메라로부터 이 수치만큼 (깊이)떨어져있도록 세팅하는 값입니다. |
| Z Step | 0 | 액터가 생성될 때 액터 사이에 설정할 Z축별 거리입니다. z-fighting 문제를 방지하는 데 사용됩니다. |
| Default Duration | 0.35 | 모든 액터 조정(외모, 위치, 색조 등 변경) 시의 기본 기간(초)입니다. |
| Default Easing | Linear | 모든 액터 조정 애니메이션(모양, 위치, 색조 등 변경)에 기본적으로 사용되는 이징 기능입니다. |
| Auto Show On Modify | False | 조정 명령어 실행 시 액터를 자동으로 공개(표시)할지 여부입니다. |

## UI

| 프로퍼티 | 기본값 | 설명 |
| --- | --- | --- |
| UI Loader | UI- (Addressable, Project) | UI 리소스와 함께 사용되는 리소스 로더 구성입니다. |
| Font Loader | Fonts- (Addressable, Project) | 글꼴 리소스와 함께 사용되는 리소스 로더 구성입니다. |
| Override Objects Layer | True | 엔진이 관리하는 모든 UI 객체에 특정 레이어를 할당할지 여부입니다. Toggle UI와 같은 일부 내장 기능에 필요합니다. |
| Objects Layer | 5 | `Override Objects Layer` 활성화 시, 지정된 레이어가 모든 관리되는 UI 개체에 할당됩니다. |
| Font Options | Object Ref | 플레이어가 선택할 수 있도록 게임 설정 UI(Default 외에)에서 사용할 수 있는 글꼴 옵션입니다. |
| Default Font | Null | 게임을 처음 시작할 때 기본적으로 적용할 Font Options의 글꼴 이름입니다. 지정하지 않을 경우 Default 글꼴이 적용됩니다. |

## Unlockables

| 프로퍼티 | 기본값 | Description |
| --- | --- | --- |
| Loader | Unlockables- (Addressable, Project) | 잠금 해제 가능한 리소스와 함께 사용되는 리소스 로더의 구성입니다. |

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)