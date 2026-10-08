---
title: "나니노벨 개발 노트 #2"
url: https://subculturegamer.com/naninovel-dev-note-2/
published: 2024-12-21
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 들어가는 글

최근 나니노벨이 1.20 업데이트를 진행했다.

나니노벨 에셋 개발자는 단순히 출시 및 판매만하는 게 아니라, 꾸준히 나니노벨 사용성 개선을 위해 힘 써주고 있다.

다만, 한 가지 문제가 있다.

업데이트를 할 때마다 ‘호환성 문제’와 ‘새로운 학습’ 문제가 생긴다는 점이다.

나니노벨의 현재 버전은 1.20이고, 아마도 이번에 준하는 스케일의 버전 업데이트는 흔하지는 않을 것 같다.

하지만 일단 한번 버전을 업데이트 할 때마다 기존의 스크립트에 문제가 없는지에 대해서는 전수조사가 필요할 수 있다.

특히 이번 1.20 업데이트처럼 다양한 명령어(commands)들이 기존과 다른 문법체계를 사용하게 되는 경우에는 더욱 그렇다.

이번 글은 나니노벨 1.20 업데이트에 따른 주요 변경점을 소개하고 디테일하게 어떤 부분이 바뀌었는지도 함께 살펴보고자 한다.

---

## 변경점 하이라이트

## 호환성

나니노벨 1.20부터는 유니티 6를 지원한다.

단, 나니노벨 1.19까지 지원하던 버전보다 ‘최소 지원 버전’이 높아졌다.

나니노벨 1.20을 사용하기 위해서는, 만약 낮은 버전의 유니티를 사용하고 있다면 버전 업데이트를 고려해야 한다.

- 나니노벨 1.19 지원 범위 : 유니티 2019.4 ~ 2022.3
- 나니노벨 1.20 지원 범위 : 유니티 **2022.3.45 ~ 6000.0** (Unity 6)

## 나니노벨 1.20 업그레이드 가이드

이미 나니노벨을 사용하고 있던 사용자 중에서 1.20으로 업그레이드를 희망하는 경우에 대해서도 ‘가이드 문서’가 마련되어 있다.

공식 가이드 문서의 링크는 [(여기)](https://naninovel.com/releases/1.20#upgrade-guide)를 참고.

아래는 위 공식 가이드 문서 내용을 한국어로 번역한 것이다.

※현재 나니노벨 버전 1.18 이하 프로젝트를 사용하다가 1.20으로 업그레이드하는 경우, 먼저 [v1.19 업그레이드 가이드](https://naninovel.com/releases/1.19)를 따른 후 다음 지침을 계속하세요.

---

1. 업그레이드 도중 잘못될 것을 대비하여 기존 데이터를 백업하거나, 버전 관리 시스템(VCS)를 이용하여 롤백 버전을 준비합니다.
2. VS Code 익스텐션을 사용하던 경우에는 익스텐션과 VS Code 자체를 모두 최신 버전으로 업데이트하세요.
   - VS Code에서 View – Command Palette로 들어갑니다.
   - Naninovel: Purge Cached Metadata를 실행합니다.
   - VS Code를 재실행합니다.
3. 프로젝트에서 Naninovel과 NaninovelData/Saves 폴더를 제거합니다.
   - Git URI(https://github.com/naninovel/upm.git#1.20)에서 새 버전을 받아옵니다.
4. 스크립트 구성(configuration)에서 Script Parser를 리셋합니다.
   - 커스텀 Script Parser를 사용하지 않는 경우 사용 가능한 유일한 옵션을 다시 선택하기만 하면 됩니다)
   - Unity 에디터를 다시 시작한 다음 시나리오 스크립트를 리 임포트합니다.
5. Unity 프로젝트에서 스크립트 에셋이 저장되는 방식을 수정합니다.
   - 이제 모든 스크립트를 단일 루트 디렉터리에 저장해야 합니다.
   - 디폴트는 Assets/Scenario 경로입니다. 단, 스크립트 구성에서 Script Root 옵션을 이용해 변경할 수 있습니다.
   - 스크립트가 지정된 루트 외부에 저장되면 warning 메시지가 로그에 기록됩니다.
6. 스크립트 루트의 하위 경로에 스크립트 에셋을 구성하는 경우 로컬 경로로 참조해야 합니다.
   - 예를 들어, Assets/Scenario/Prologue/Day1.nani 스크립트로 이동하려면 @goto Prologue/Day1 명령어를 사용합니다.
7. 이제 스크립트는 이름이 아닌 로컬 경로로 식별되므로 로컬라이즈와 오토 보이스 설정을 다시 생성해야 합니다.
   - 기존 번역을 유지하려면 로컬라이즈 문서가 스크립트 파일 구조를 반영하는지 확인하세요.
   - 예를 들어 Assets/Scenario/Prologue/Day1.nani 스크립트에 대한 일본어 로컬라이즈 문서는 Assets/Resources/Naninovel/Localization/ja/Text/Scripts/Prologue/Day1.txt에 있어야 합니다.
   - [로컬라이즈 샘플 프로젝트](https://github.com/naninovel/samples/tree/main/unity/localization)를 참고하여 설정을 구성하세요.
8. 일부 관리형 텍스트 문서를 다시 생성해야 할 수도 있습니다.
   - 정적 필드와 연관된 일부 레코드가 잘못된 키를 가졌을 수 있습니다.
   - 예를 들어, DefaultUI 문서 내의 GameSettingsFontDropdown.DefaultFontName 레코드에는 Naninovel.UI.GameSettingsFontDropdown.DefaultFontName 키가 있습니다.
9. input 구성에서 SkipMovie 입력 바인딩을 추가하거나, 새로운 입력 시스템을 사용하는 경우에는 input 동작 에셋을 추가합니다.
   - 영상 스킵하기는 Esc키(디폴트)를 기본 키로 가집니다.
10. @if 조건부 블록을 사용하는 경우, 블록 내부의 명령어가 들여쓰기되지 않았는지 확인하세요.
    - 또는 @endif 명령어를 제거하고 들여쓰기가 있는 새 구문으로 전환하세요.
    - [참고 링크](https://naninovel.com/guide/naninovel-scripts#conditional-blocks)
11. @elseif … 명령어를 사용하고 있었다면 일괄 @else if:…. 명령어 구문으로 대체합니다.
12. @choice 명령어에서 do 매개변수를 사용하고 있었다면 중첩된 콜백 구문으로 대체합니다.
    - [참고 링크](https://naninovel.com/guide/choices#nested-callback)
13. @wait 명령어의 do 매개변수를 사용하고 있었다면 @delay 명령으로 대체합니다.
14. @startTrans 및 @stopTrans 명령어를 사용하고 있었다면 @trans로 대체합니다.
15. [skipInput] 명령어를 사용하고 있었다면 해당 항목을 [< skip!] 일반 매개변수로 대체합니다.
16. ExpressionFunctions 특성을 사용하여 커스텀 표현식 함수를 노출하는 경우, 클래스에서 특성을 제거하고 대신 클래스의 메서드에 ExpressionFunction 특성을 적용합니다.
    - [참고 링크](https://naninovel.com/guide/script-expressions#adding-custom-functions)
17. @hide, @hideAll 또는 @hideChars 명령어의 *remove* 파라미터를 사용하고 있었다면, 이 파라미터를 제거하고 액터를 숨긴 다음 라인(line)에 @remove 명령어를 사용하세요.
18. Live2D 또는 Spine 확장을 사용하는 경우 확장 디렉터리를 제거하고 전용 캐릭터 가이드의 설정 지침을 따르세요. (두 확장 모두 기본 패키지와 병합되었습니다).
    - 설정을 마친 후 캐릭터 구성에서 캐릭터 구현 유형을 다시 할당해야 할 수도 있습니다.
    - [참고 링크](https://naninovel.com/guide/characters#live2d-characters)
19. Naninovel C# API의 비동기 메서드를 사용하고 있었다면 ‘Async’ 접미사를 제거하세요.
    - 예를 들어 Command.ExecuteAsync는 이제 Command.Execute입니다.
20. 커스텀 액터 셰이더를 사용하고 있었다면 셰이더 대신 머테리얼을 할당하십시오.
    - [참고 링크](https://naninovel.com/guide/custom-actor-shader)
21. Authored Template 및 Auto Line Breaks이 텍스트 출력기 UI 설정으로 이동되어 서식 설정을 수정해야 합니다.
    - 예를 들어, ‘Fullscreen’ 출력기에는 작성된 메시지(+)에 대한 %AUTHOR%: ‘%TEXT%’ 템플릿이 기본적으로 지정되어 있습니다.
    - [참고 링크](https://naninovel.com/guide/text-printers#message-templates)
22. @style 명령어를 사용하고 있었다면 @format 명령어로 바꾸세요.
23. [br] 인라인 명령어를 사용하고 있었다면 <br> 태그로 교체하세요.

> **주의**
>
> 이전 버전에서 생성된 게임 내 저장(저장/로드 메뉴의 슬롯, 설정 메뉴의 값 및 전역 게임 상태)은 업데이트된 버전으로 로드할 때 예기치 않은 동작을 일으킬 수 있습니다.
>
> 새 Naninovel 버전으로 출시된 프로젝트를 패치할 때 기존 저장이 예상대로 작동하는지 확인하세요.

---

## 나니노벨 1.20 추가 기능

- 컴파일러 로컬라이즈 기능이 추가되었습니다.
  - 캐릭터 조작, 명령어 및 파라미터 이름, 상수 및 기본적으로 시나리오 작성에 필요한 기능을 리매핑합니다.
  - [참고 링크](https://naninovel.com/guide/localization#compiler-localization)
- **나니스크립트에 중첩(Nest) 기능이 추가되었습니다.**
  - 다른 명령어 아래에 중첩된(연관된) 명령어 블록을 지정할 수 있습니다.
  - 기존에 쓰인 다양한 명령어는 이제 더 읽기 쉽고 간결해졌습니다.
  - 이전에 새 구문 없이는 나니스크립트에서 제한되던 몇 가지 새 명령어를 추가했습니다.
  - [참고 링크](https://naninovel.com/guide/naninovel-scripts#nesting)
- **@if 및 @else 명령어가 이제 중첩(Nest) 기능을 지원합니다.**
- **@choice 명령어가 중첩(Nest) 기능을 지원합니다.**
- @startTrans와 @finishTrans 명령어가 @trans 명령어로 병합되었습니다.
  - 추가적으로, 매 명령어에 time:0를 기입할 필요가 없어졌습니다.
  - 디폴트 시간으로 적용됩니다.
- @while 명령어가 추가되었습니다.
  - 조건문이 참(True)이라면 중첩 명령어를 루프시킵니다.
- @delay 명령어가 추가되었습니다.
  - 중첩된 명령어의 실행을 지연시킵니다.
- @random 명령어가 추가되었습니다.
  - 자손 명령어 중 하나를 랜덤하게 실행시킵니다.
- @group 명령어가 추가되었습니다.
  - 여러 개의 명령어줄을 하나의 명령어 블록으로 조인(결합)시킵니다.
- @await 명령어가 추가되었습니다.
  - 스크립트 재생을 계속하기 전에 중첩된 비동기 명령을 기다리게 합니다.
  - 스크립트 플레이어 구성에서 기본 설정으로 Wait By Default가 비활성화된 상태에서 사용할 수 있도록 설계되었으며, 이는 현재 새로운 프로젝트에서 기본 설정입니다.
  - [참고 링크](https://naninovel.com/guide/naninovel-scripts#async-execution)
- 불 파라미터값에 대한 바로가기를 위해 불 플래그가 추가되었습니다.
- 부분 또는 전체 일반(generic) 텍스트 라인에 @print 명령어의 매개변수를 적용할 수 있게 개선되었습니다.
  - [참고 링크](https://naninovel.com/guide/naninovel-scripts#generic-parameters)
- ‘[](빈 인라인 명령)를 사용하여 일반 텍스트 라인이 공백으로 시작하거나 끝날 수 있게 되었습니다.
  - [참고 링크](https://naninovel.com/guide/naninovel-scripts#white-space-delimiters)

- Static 및 Dynamic 대신 Conservative 및 Optimistic 리소스 정책 모드가 추가되었습니다.
  - [참고 링크](https://naninovel.com/guide/memory-management)
- 스크립트 파일 이름은 더 이상 고유할 필요가 없으며 로컬 경로로 참조할 수 있습니다.
  - 예를 들어 Scripts/Prologue/Day1.nani 및 Scripts/MainRoute/Day1.nani가 있다면,
  - @goto Prologue/Day1 및 @goto MainRoute/Day1로 참조할 수 있습니다.
- 엔진 구성의 Type Assemblies 옵션이 제거됩니다.
  - 이 속성을 통해 커스텀 유형에 대한 어셈블리를 지정할 필요가 없게 되었습니다.
- **이제 Naninovel을 UPM 패키지로 설치할 수 있습니다.**
- **Live2D 및 Spine 확장이 기본 패키지에 병합되었습니다. 통합을 활성화하기 위해 더 이상 전용 패키지를 설치할 필요가 없습니다.**
- 엔진 초기화 시간을 개선했습니다. 런타임 시 리플렉션 대신 빌드 시 유형을 캐싱합니다.
- 이제 스크립트 및 관리형 텍스트 리소스가 요청 시 로드됩니다. 대규모 프로젝트에서 RAM 사용량이 크게 줄어들고 엔진 초기화 시간이 향상됩니다.
- 리소스 제공자 구성에 *Label By Scripts* 옵션이 추가되었습니다.
  - 기본값은 활성화되어 있으며, 사용되고 있는 스크립트의 모든 Naninovel 어드레서블 에셋에 레이블을 지정합니다.
  - 어드레서블 그룹의 *Bundle Mode*가 *Pack Together By Label*로 설정되면 에셋 번들이 프로젝트 시나리오 구조에 최적화되어 로드 시간과 RAM 사용량이 향상됩니다.
  - [참고 링크](https://naninovel.com/guide/resource-providers#script-labels)

- 필수 데이터가 빌드 시 캐시되므로 플레이어 읽기 진행 기능으로 인해 더 이상 런타임 오버헤드가 발생하지 않습니다.
  - *Count Total Commands* 옵션은 이제 기본적으로 항상 사용 가능/활성화되므로 스크립트 구성에서 제거되었습니다.
- 리소스 제공자 구성에 *Remove Actors* 옵션을 추가했습니다.
  - 기본값은 활성화되어 있으며 @remove 명령어를 사용할 필요 없이 스크립트 리소스를 언로드할 때 사용되지 않는 액터가 자동으로 제거되고 관련 게임 오브젝트가 삭제됩니다.
  - [참고 링크](https://naninovel.com/guide/memory-management#removing-actors)
- 엔진 구성에 *Async Instantiation*를 추가했습니다.
  - 기본값은 활성화되어 있으며 성능 향상과 원활한 자산 로딩을 위해 객체 인스턴스화를 메인 스레드 밖으로 이동시킵니다.
- Generic, Live2D 및 Spine 액터는 이제 한 번에 적용되는 여러 모양을 지원하여 복잡한 애니메이션 상태를 더 쉽게 설정할 수 있습니다.
  - [참고 링크](https://naninovel.com/guide/characters#multiple-appearances)

- 로컬라이즈 유틸리티에 Join Lines을 추가했습니다. 활성화 시 로컬라이즈 문서의 일반 줄이 편의를 위해 한 줄로 유지됩니다.
  - [참고 링크](https://naninovel.com/guide/localization#joined-lines)
- 이제 번역자에게 더 많은 맥락을 제공하기 위해 로컬라이즈 문서 내의 주석에 번역된 콘텐츠의 요점도 포함됩니다.
  - [참고 링크](https://naninovel.com/guide/localization#annotations)
- @choice 명령어에 lock 매개변수를 추가했습니다.
  - 선택지 항목을 잠그거나 비활성화할 수 있습니다.
  - [참고 링크](https://naninovel.com/guide/choices#locked-choice)
- 로컬라이즈 구성에 *Auto Detect Locale*을 추가했습니다. 기본값은 활성화되어 있으며 게임이 처음 시작될 때 시스템 언어를 사용하여 로케일을 자동 감지하려고 시도합니다.
  - [참고 링크](https://naninovel.com/guide/localization#default-locale)
- 페이지 변경 전에 페이지 매기기를 드러내기 위한 계속하기 입력 프롬프트를 추가했습니다.
- 레이어드 액터 프리팹 인스턴스가 연관된 액터 게임 오브젝트 아래에 중첩됩니다.
  - 라이팅, 인러택티브 스팟 등 객체 변환에 의존하는 동작에 대한 지원이 추가되었습니다.
- 액터를 렌더링할 때 보존할 추가 카메라 레이어를 지정할 수 있도록 레이어드 액터 동작 구성 요소에 *Camera Mask* 옵션을 추가했습니다. Unity의 2D 조명과 같은 전용 카메라 레이어가 필요한 렌더링 기능을 지원하는 데 사용됩니다.
- 캐릭터 구성에 *Has Name*을 추가했습니다. 비활성화되면 표시 이름이나 행위자 ID가 출력기 UI에 표시되지 않습니다. 연관 출력기의 내레이터 유형 캐릭터에 유용합니다.
  - [참고 링크](https://naninovel.com/guide/characters#display-names)
- 커뮤니티 로컬라이즈에 글꼴 제공 옵션이 추가되었습니다.
  - [참고 링크](https://naninovel.com/guide/localization#community-localization)
- 액터 렌더링을 위한 커스텀 머테리얼을 할당하는 옵션이 추가되어 셰이더 그래프를 사용하여 커스텀 액터 셰이더를 작성할 수 있습니다.
- 관리형 텍스트 레코드에서 제목, 카테고리 및 팁 텍스트를 구분하는 데 사용되는 문자를 변경할 수 있도록 내장 팁 UI에 *Separator Literal*을 추가했습니다.
- *Selected Prefix*를 빌트인 팁 UI에 추가했습니다.
  - 항목이 한 번 이상 표시되었음을 나타내는, 잠금 해제 가능한 ID 접두사를 변경할 수 있는 UI입니다.
- 팁 패널에 선택되지 않은 항목이 포함되어 있는지 확인할 수 있는 TipsPanel.HasUnselectedItem() 메서드를 추가했습니다.
- 플레이어를 빌드하지 않고도 나니노벨 관련 프로젝트 리소스(활성화된 경우 어드레서블 항목 포함)를 빌드할 수 있는 *Build Resources* 에디터 메뉴를 추가했습니다.
- @char, @back, @camera, @slide 및 기타 명령에 플레이어가 애니메이션을 스킵할 때 애니메이션을 완료하지 못하도록 하는 lazy 플래그를 추가했습니다.
  - 카메라 패닝과 같이 오랫동안 실행되는 비동기 애니메이션을 혼합하는 데 유용합니다.
- 식별자 앞에 &를 추가하여 식별된 텍스트 참조를 생성하는 방법을 추가했습니다.
  - [참고 링크](https://naninovel.com/guide/naninovel-scripts#identified-text-references)
- 커스텀 표현식 함수에 대한 별칭(alias) 및 문서를 지정하는 옵션이 추가되었습니다.
- 숫자 표현식 함수 파라미터는 더 이상 double로 제한되지 않습니다.
- *Play SFX While Skipping* 옵션이 오디오 설정에 추가되었습니다. 비활성화되면 @sfx는 loop! 가 입력되지 않았다면 스킵 시 재생되지 않습니다.
- 커스텀 이름 레이블을 설정할 수 있도록 @print 명령에 *as* 파라미터가 추가되었습니다.
  - *author* 파라미터와 결합하면 이제 여러 작성자(,로 구분)와 \*로 지정된 모든 작성자를 처리합니다.
  - 단일 텍스트 라인을 사용하는 여러 캐릭터(화자)를 나타내는 데 유용합니다.
  - [참고 링크](https://naninovel.com/guide/characters#name-labels)
- 로컬라이즈 문서에 스크립트 표현식을 포함하고 로케일이 변경되면 강제로 재평가하는 방법을 추가했습니다.
  - [참고 링크](https://naninovel.com/guide/text-printers#reveal-expressions)
- 누락된 글꼴에 대한 우아한 처리기가 추가되었습니다. 경고가 기록되고 예외가 발생하는 대신 기본 글꼴이 사용됩니다.
- @movie 명령어에 *block* 파라미터가 추가되었습니다.
  - 영상이 재생되는 동안 플레이어의 조작(상호 작용)에 의해 스킵되는 것을 방지하기 위해 사용됩니다.
- **보다 강력한 텍스트 서식 지정 기능을 위해 @style 대신 @format 명령을 추가했습니다.**
- 엔진 구성의 *GeneratedDataPath* 옵션에 폴더 선택기를 추가했습니다.
- SkipMovie 입력 바인딩을 추가했습니다
  - 이전에는 Cancel 바인딩을 공유했으나 영상 건너뛰기 전용 바인딩이 추가됐습니다.
- **액터 삭제를 위한 @remove 명령어를 추가했습니다.**
- 텍스트 표시 페이더 효과에 *Support Custom Opacity* 옵션을 추가했습니다.
  - 활성화되면 효과는 <alpha> 태그를 반영합니다.
  - 최대 불투명도는 일부 성능 전반의 코스트가 전부 드러났을 때 제한됩니다.
- 입력 변수 값의 타입을 강제할 수 있도록 @input 명령에 type 파라미터를 추가했습니다.
- Include Author To Backlog 옵션을 추가했습니다.
  - 이 기능은 출력 메시지의 작성자를 백로그에 포함하지 않도록 허용합니다.
  - ‘전체 화면’ 출력기에서는 기본적으로 비활성화되어 있습니다.
- 씬 배경 액터 설정에 Scene Path Root 옵션을 추가했습니다.
  - 액터 외양과 관련된 씬 에셋의 루트 디렉터리를 변경할 수 있습니다.
  - [예시](https://i.gyazo.com/207b721a062ffa7870df1005a0552a3e.png)
- 이제 엔진에는 자체 CSV 파서가 있으며 더 이상 타사 라이브러리에 의존하지 않습니다.
- IDE(VS Code) 확장 개선 사항이 있습니다.
  - 새로운 파일 기반 브리징 서비스는 Unity, VS Code 및 Web Editor 간의 연결을 더욱 안정적으로 만들어 주며 기본 소켓 포트 지정과 같은 설정이나 조정이 필요하지 않습니다.
  - 브리징 연결 상태에 대한 시각적 표시기를 추가했습니다. [(링크)](https://i.gyazo.com/04c404ea30c432b18d1d2953db13bc6a.png)
  - 라벨, 스크립트 파일 및 폴더에 대한 이름 변경 리팩터링 옵션이 추가되었습니다. [(링크)](https://i.gyazo.com/b35279c0c37631a144bf2fd9d373e02a.mp4)
  - 이제 확장 기능을 통해 NaniScript 문서의 형식을 지정할 수 있습니다. [(링크)](https://i.gyazo.com/a109c49ab9b08cd009c35e76fd485c4c.mp4)
  - 레이블 자동 완성 및 진단에는 더 이상 에디터와 메타데이터 동기화가 필요하지 않습니다.
  - 진단 성능을 최적화하기 위해 *Debounce Delay* 설정을 추가했습니다. 확장 프로그램은 더 이상 각 문서 변경 사항을 진단하지 않고 대신 변경 사항을 누적하여 지정된 디바운스 간격(기본적으로 500ms)에 따라 일괄 처리합니다.
  - 이미 지정된 파라미터는 자동 완성 목록에 더 이상 제안되지 않습니다.
  - @if 명령의 *if* 파라미터 및 비동기가 아닌 명령의 *wait* 파라미터와 같이 효과가 없거나 명령에서 지원되지 않는 파라미터는 더 이상 자동 완성 목록에 제안되지 않습니다.
  - 이제 값이 {}로 래핑되지 않은 경우에도 표현식 컨텍스트가 있는 파라미터 값이 표현식으로 강조 표시됩니다.
  - 이제 출력된 텍스트 및 선택지 레이블과 같은 로컬라이즈 가능한 파라미터 값이 독립적으로 강조 표시되어 플레이어에게 표시되는 ‘자연어’ 텍스트를 다른 값과 더 잘 구분할 수 있습니다.
  - 커스텀 접이식 블록을 지정하는 옵션이 추가되었습니다. [(링크)](https://naninovel.com/guide/ide-extension#folding)
  - 표현식 함수 파라미터에 대한 컨텍스트를 지정하는 옵션이 추가되었습니다. [(링크)](https://naninovel.com/guide/script-expressions#parameter-context)
  - 이제 미니맵 섹션 헤더를 지원합니다. [(링크)](https://code.visualstudio.com/updates/v1_88#_minimap-section-headers)
  - 툴팁 내부의 예제 스니펫에 코드 강조 표시가 추가되었습니다.
  - 토큰 색상, *.meta* 파일 숨기기, 단어 줄 바꿈 등 익스텐션의 기여에 공통 구성 기본값을 추가했습니다.
  - 동적 파라미터 값이 리소스 사전 로드를 방해하는 경우 VS Code에 약한(정보용) 경고가 추가되었습니다.
  - 일반, live2d 및 스파인 액터에 대한 외양 메타데이터(VS Code의 자동 완성에 사용됨)는 이제 구현 프리팹의 애니메이터 구성 요소에 있는 트리거 파라미터를 기반으로 생성됩니다.

## 나니노벨 1.20 변경점

- **지원되는 최소 Unity 버전이 2022.3으로 변경되었습니다.**
- 이제 상태 재설정은 빈 게임 상태로 IStateManager.AddOnGameDeserializeTask로 추가된 모든 작업을 추가로 호출합니다. 이는 내장된 변수 트리거 컴포넌트와 백로그, 변수 입력, 채팅 출력기 및 선택지 처리기 UI에 영향을 미치며 타이틀을 종료하고 새 게임을 시작할 때 로컬 상태를 재설정합니다.
- @gosub 명령어의 대상 스크립트는 이제 항상 미리 로드됩니다.
- **@elseif 명령어가 제거되었습니다. 대신 @else if:…를 사용하세요.**
- **@choice 명령어의 do 파라미터가 제거되었습니다. 대신 중첩된 콜백을 사용하세요.**
- **@wait 명령의 do 매개변수가 제거되었습니다. 대신 @delay 명령을 사용하세요.**
- 이제 새 프로젝트에서는 스크립트 플레이어 구성의 *Wait By Default* 기본 비활성화됩니다.
- ‘Lazy’ 리소스 정책을 제거했습니다. 대신 새로운 ‘Conservative’ 또는 ‘Optimistic’ 정책을 사용하세요.
- [skipInput] 명령어를 제거했습니다. 대신 [< skip!] 일반 파라미터를 사용하세요.
- ExpressionFunctions 클래스 속성이 제거되었습니다. 대신 ExpressionFunction 메서드 속성을 사용하세요.
- 이제 전용 SkipMovie 입력 바인딩(이전 공유 취소 바인딩)을 사용하여 영상를 건너뜁니다.
- **명령어가 대기되지 않을 때의 문제로 인해 @hide, @hideAll 및 @hideChars 명령어에서 remove 파라미터가 제거되었습니다. 대신 액터를 숨긴 후 @remove 명령어를 사용하세요.**
- 눈과 비 효과의 강도를 0.0-1.0 범위로 정규화했습니다. 이제 기본값은 둘 다 0.5입니다.
- **@startTrans 및 @stopTrans 명령이 제거되었습니다. 대신 @trans를 사용하세요.**
- 시나리오 스크립트는 이제 에셋 이름 대신 로컬 리소스 경로로 식별됩니다. 이에 따라 관련 API가 변경되었습니다.
- 레거시(playback spot) 오토 보이스 모드를 제거했습니다.
- 모든 비동기 메서드 이름에서 ‘Async’ 접미사를 삭제했습니다.
- 셰이더 그래프와의 유연성과 호환성을 높이기 위해 셰이더 대신 머테리얼을 허용하도록 액터 메타데이터의 Custom Texture Shader 및 Custom Sprite Shader 속성을 변경했습니다.
- Authored Template 및 Auto Line Breaks을 텍스트 출력기 액터 메타데이터에서 출력기 UI로 이동했습니다.
- **@style 명령이 제거되었습니다. 대신 @format을 사용하세요.**
- @br 명령이 제거되었습니다. 대신 <br> 태그를 사용하세요.

## 나니노벨 1.20 버그 픽스

- 로케일 변경 시 채팅 프린터에서 메시지가 중복되는 문제를 수정했습니다.
- 채팅 출력기가 다시 시작될 때까지 로케일 변경 시 인쇄된 텍스트를 업데이트하지 않는 문제를 해결했습니다.
- 짧은 타입명 대신 전체 타입명을 키로 사용하는 정적 필드와 연결된 일부 관리 텍스트 레코드를 수정했습니다.
- Microsoft Excel로 편집한 로컬라이즈 CSV 시트를 가져올 때 선행 및 후행 공백이 손실되는 문제를 수정했습니다.
- 이름 없는 파라미터가 지정되지 않은 경우 명령어 식별자 뒤에 추가 공백을 추가하는 비주얼 에디터를 수정했습니다.
- 재생된 라인을 강조 표시할 때 VS Code가 최대화되고 포커싱을 가져오는 문제를 수정했습니다.
- 클래스 수준 특성과 관련된 VS Code 누락 메타데이터가 수정되었습니다.
- ID는 동일하지만 타입이 다른 액터의 VS Code 혼합 외양을 수정했습니다.
- VS Code에서 스크립트 이름을 삽입하는 과정에서 ‘.’을 입력할 때 @goto 및 @gosub 명령어에서 스크립트를 건너뛰는 문제를 수정했습니다.
- VS Code 익스텐션이 ASCII가 아닌 문자가 포함된 파일 이름을 제대로 처리하지 못하는 문제를 수정했습니다.

---

## 정리하는 글

여기서부터는 여담이다.

필자는 지금까지 살면서 ‘업데이트’라는 말은 무조건 좋은 것이라고 생각했었다.

그런데 이번 나니노벨 1.20 업데이트는 그렇지만은 않았다.

왜냐하면 필자가 그동안 블로그에 올린 수많은 나니노벨 번역 문서를 전부 다시 봐야하기 때문이다.

이미 많은 문서에서부터 불일치가 발견되고 있다.

이 블로그에 나니노벨 관련 문서를 다 올리기도 전에 이렇게 큰 폭의 업데이트가 일어나는 바람에 필자의 일이 더 늘어난 셈이다.

나니노벨 문서 작성 및 업데이트는 생각했던 것보다 더 오래 진행될 전망이다…

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)