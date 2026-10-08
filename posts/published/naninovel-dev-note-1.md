---
title: "나니노벨 개발 노트 #1"
url: https://subculturegamer.com/naninovel-dev-note-1/
published: 2024-10-21
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 들어가는 글

나니노벨은 Unity 엔진의 확장(extension)이다.

주로 비주얼 노벨 게임을 만들기 위해 활용되지만, RPG나 어드벤처 등 비주얼 노벨 장르가 아닌 게임에서도 나니노벨 시스템을 활용할 수 있다.

나니노벨은 웬만한 수집형 RPG 및 비주얼 노벨에서는 차고 넘칠 정도로 많은 기능을 지원한다.

그 가이드 개수만 해도 수십 개, 그리고 각 페이지마다 읽는 데 수십 분이 걸리는 문서도 있다.

가이드를 읽기만 해도 지친다.

특히 영어로 되어있다는 점이 이 좋은 툴을 습득하는 데 큰 장벽으로 다가온다.

그렇다면 우리는 나니노벨의 어떤 페이지부터 보아야하는 것일까?

## 나니노벨?

- 연관글: [나니노벨 Introduction](https://subculturegamer.com/%eb%82%98%eb%8b%88%eb%85%b8%eb%b2%a8-introduction/)

나니노벨은 유니티 에셋 스토어에서 150달러에 판매되고 있는 비주얼 노벨 전문 에셋이다.

(그들 스스로는 Visual Novel Engine이라고 칭하나, 유니티 엔진과의 구분을 위해 엔진이라는 용어를 에셋으로 수정하였습니다.)

툴을 쓸 지 말 지 고민이 되는 상황에서 150달러나 하는 유료 에셋을 구매하는 건 쉽지 않은 선택이다.

특히 모든 가이드가 영어라는 언어의 장벽 또한 결코 무시할 수 없는 커다란 장해물이다

영어 네이티브가 아닌 한, 영어 독해를 하면서 게임 개발 병행은 비영어권 국가에 사는 우리가 이 에셋을 활용하는 건 난관이 예상된다.

본인이 프로그래머라면 나니노벨 에셋을 구입해서 조금 손 보거나(?), 나니노벨에서 제공하는 기능들을 직접 본인 손으로 구현할지도 모르겠다.

우리는 이러한 나니노벨 도입에 앞서 이런 과제들을 고민하게 된다.

> Q. 나니노벨을 왜 쓸까?
>
> Q. 나니노벨의 장점과 단점은 무엇일까?
>
> Q. 나니노벨을 쓰면 내가 가진 어떤 고민을 해결할 수 있을까?

그렇다면 나니노벨을 사용했을 때의 이점에 관해서 짤막하게 알아보도록 하자.

### 공식 소개 문구

- 공식 소개 페이지: [(링크)](https://assetstore.unity.com/packages/tools/game-toolkits/naninovel-visual-novel-engine-135453)

나니노벨을 사용하면 어떤 변화가 생기게 될까?

아래는 유니티 에셋 스토어의 ‘나니노벨’ 상점 페이지에서 볼 수 있는 공식 소개 문구이다.

> Naninovel는 **작가 친화적** 도구로 완벽한 **비주얼 노벨**을 창조하는 종합 솔루션입니다.
>
> **문서 기반 스크립트**  
> 스크립트 작가를 위해 설계된 [Naninovel 스크립트](https://naninovel.com/guide/naninovel-scripts.html)는 고유 엔진 기능을 갖춘 친숙한 텍스트 에디터를 통해 복합적인 텍스트 기반 어드벤처 게임을 개발할 수 있습니다. 코드 대신 스토리를 작성해보세요!
>
> **종합적인 도구**  
> 완벽한 비주얼 노벨 제작에 필요한 모든 요소들을 활용해보세요. 텍스트 프린터, 건너뛰기 및 자동 보정, 저장-불러오기 시스템, 캐릭터 음성, 전환 및 특수 이펙트, 조건적 스토리 흐름 외에도 [더 많은 요소](https://naninovel.com/guide/#features)들이 있습니다.
>
> **향상된 비주얼**  
> Unity 게임 엔진으로 최신 GPU 동력을 원하는 대로 사용 가능하며, 나만의 비주얼을 제작하거나 [내장된 여러 이펙트](https://naninovel.com/guide/special-effects.html#snow)를 사용할 수도 있습니다.
>
> **크로스 플랫폼**  
> [모든 최신 플랫폼](https://naninovel.com/guide/compatibility.html#platforms)에서 잘 작동하도록 데스크톱, 모바일, 콘솔 및 웹 브라우저에 최적화되었습니다. 한 번의 제작으로 전 세계에 출시해보세요!
>
> **확장성**  
> 엔진 시스템의 자체 구현을 주입하고 새로운 커스텀 기능을 추가하며 [기존 프로젝트와 통합할 수 있는](https://naninovel.com/guide/integration-options) 개방형 API를 제공합니다.
>
> **커뮤니티 성능 변경**  
> Naninoverl로 구축한 게임은 새로운 시나리오, 리소스 및 현지화를 추가해야 할 때 [쉽게 수정](https://naninovel.com/guide/community-modding.html)할 수 있습니다. 플레이어가 자신만의 스토리를 만들게 해주고 팬층을 넓힐 수 있도록 게임을 공개하세요!

### 구체적인 특징

위 설명은 텍스트 위주라서 구체적으로 어떤 화면에서 우리가 작업하게 될 지에 대해서는 알기가 어렵다.

실제 나니노벨을 이용하게 되면 어떤 화면에서 어떤 작업이 가능하게 되는 걸까?

아래의 이미지들은 공식에서 제공하는 대표 특징들을 이미지와 함께 나열한 것이다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/17d042ec-a718-4100-ac91-f3c020b2027d-1024x576.webp)

Clean Syntax Highlighting AutoComplete

![](https://subculturegamer.com/wp-content/uploads/2024/10/26fbd35f-b5f5-4530-b0b4-f523dadf8c06-1024x576.webp)

Visual Editor Auto Sync with Text Scripts

깔끔한 구문 강조 자동 완성

![](https://subculturegamer.com/wp-content/uploads/2024/10/e0359079-84ef-4938-8b9a-f6a1f8be5274-1-1024x576.webp)

Hot Reload: Edit Scripts at Play Mode

핫 리로드: 플레이 모드에서 스크립트 편집

![](https://subculturegamer.com/wp-content/uploads/2024/10/2ce4ef7c-d86a-405a-8404-a98ffcc20065-1024x576.webp)

Script Graph: Story Flow Diagram

스크립트 그래프: 스토리 흐름 다이어그램

![](https://subculturegamer.com/wp-content/uploads/2024/10/ccdb4571-937a-4f45-95d9-cbbf07f032ca-1024x576.webp)

Comin/manga Style Text Printer Option

Comin/manga 스타일 텍스트 출력기 옵션

![](https://subculturegamer.com/wp-content/uploads/2024/10/d845d552-50b4-4101-8b76-b38049cf2395-1024x576.webp)

Chat/Im App Style Text Printer Option

채팅/이모티콘 앱 스타일 텍스트 출력기 옵션

![](https://subculturegamer.com/wp-content/uploads/2024/10/2264f87f-15e0-4d3b-a1f6-8bcc566a522e-1024x576.webp)

Customizable Serialization and Save-Load System

커스텀 가능한 직렬화 및 세이브-로드 시스템

![](https://subculturegamer.com/wp-content/uploads/2024/10/90f2b70f-9552-4cad-98e9-7f2bfc7a2d53-1024x576.webp)

In-Game Settings Menu

게임 내 설정 메뉴

![](https://subculturegamer.com/wp-content/uploads/2024/10/48f30ece-f78e-4b16-8b5a-8422e6a5ffae-1024x576.webp)

Unlockable Cg Gallery

잠금 해제 가능한 CG 갤러리

![](https://subculturegamer.com/wp-content/uploads/2024/10/849f8186-d2f0-4918-8b25-f8ca17cf4c91-1024x576.webp)

Unlockable Tips

잠금 해제 가능한 팁

![](https://subculturegamer.com/wp-content/uploads/2024/10/7cd0771c-3117-4997-b6ca-10e3fbc7fdec-1024x576.webp)

Depth of Field (Bokeh) Effect

피사계 심도(Bokeh) 효과

![](https://subculturegamer.com/wp-content/uploads/2024/10/67026fd9-4a2f-4351-897c-bc936a5ff1e8-1024x576.webp)

Use with an Exiting Project as a drop-in diaglogue System

드롭인 대화 시스템으로 기존 프로젝트와 함께 사용 가능

![](https://subculturegamer.com/wp-content/uploads/2024/10/ffb41278-f0f1-4e05-aa40-05ae1b5cc840-1024x576.webp)

Localiaztion, Managed Text, Auto Voicing

현지화, 관리형 텍스트, 자동 보이싱

![](https://subculturegamer.com/wp-content/uploads/2024/10/bc653204-e4ea-405b-9e92-b3be7ff038e4-1024x576.webp)

Sprite Dicing: Lossless Texture Compression

스프라이트 다이싱: 무손실 텍스처 압축

![](https://subculturegamer.com/wp-content/uploads/2024/10/ec56a59a-4fe3-4436-a121-db5016339a32-1024x576.webp)

Generic Behaviour: Build Actors with Third Party Tools

일반 동작: 타사 도구를 사용하여 액터 구축

![](https://subculturegamer.com/wp-content/uploads/2024/10/642333b5-03ba-4b6c-9293-bca2e08124e9-1024x576.webp)

Rich Configuration Menus

풍부한 구성 메뉴

![](https://subculturegamer.com/wp-content/uploads/2024/10/5abda88f-506a-4692-9d08-51a2f12549ad-1024x576.webp)

Customizable Resource Providers Addressable System Support

사용자 정의 가능한 리소스 공급자 주소 지정 가능 시스템 지원

![](https://subculturegamer.com/wp-content/uploads/2024/10/a691e05e-ff1f-4f73-90ab-2a4d9188529a-1024x576.webp)

Customizable Controls Inpit System Support

맞춤형 컨트롤 Inpit 시스템 지원

![](https://subculturegamer.com/wp-content/uploads/2024/10/35d5a4b2-d7e5-4978-8017-666d7560b064-1024x576.webp)

Comprehensive Documentation With Fast and Relevant Search

빠르고 관련성 있는 검색을 통한 포괄적인 문서화

![](https://subculturegamer.com/wp-content/uploads/2024/10/3801737c-9cb4-4eb0-a187-703499db53bd-1024x576.webp)

Extend and Integrate Via C# API or with Visual Scripting Tools

C# API 또는 비주얼 스크립팅 도구를 통해 확장 및 통합

---

## 호환성 체크

### 유니티 버전

- 연관글: [나니노벨 Compatibility](https://subculturegamer.com/%eb%82%98%eb%8b%88%eb%85%b8%eb%b2%a8-compatibility/)

2024년 10월 기준, 나니노벨은 유니티 버전 2022.3(최신 버전)까지 지원한다.

권장 유니티 버전은 2019.4.40이지만 이제 막 게임 개발을 들어가는 프로젝트라면 굳이 이 버전을 이용해서 게임을 만들 필요는 없을 것 같다.

LTS를 오랫동안 지원할 수 있는 버전을 선택하는 게 더 사후지원에 유리하기 때문에 나니노벨이 지원하는 지원하는 버전 내에서 유니티 엔진의 최신 버전을 사용하도록 한다.

### 플랫폼

게임을 실행하는 플랫폼은 PC나 모바일, 콘솔 등이 대표적이다.

비주얼 노벨 전반을 커버할 수 있는 범용성이 좋은 에셋이기에, 다양한 플레이 환경을 지원한다.

구분하자면 아래와 같다.

- 스탠드얼론: Windows, Mac, Linux
- 보바일: iOS, Android
- 웹: WebGL
- 콘솔: Nintendo Switch

눈에 띄는 점은, 콘솔은 닌텐도 스위치만 지원하고 있다는 점이다.

그 외에는 나니노벨을 구동시키는 데는 그리 큰 문제로 다가올 것은 없어 보인다.

---

## 정리하는 글

이번 글에서는 나니노벨의 대략적인 정보와 호환성 체크에 관해 알아보았다.

다음 글에서는 나니노벨을 작성하기 위한 IDE를 세팅하는 방법에 관해 알아보자.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)