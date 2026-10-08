---
title: "나니노벨 Community Modding"
url: https://subculturegamer.com/naninovel-community-modding/
published: 2025-01-05
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

※원문 페이지: [(링크)](https://naninovel.com/guide/configuration)

※마지막 수정일: 2025/1/5

---

커뮤니티 모딩 기능을 통해 플레이어는 빌드를 수정하고 자신만의 시나리오와 리소스를 추가하는 동시에 게임에 내장된 리소스에 액세스할 수 있습니다.

기능을 활성화하려면 `Naninovel -> Configuration -> Scripts` 컨텍스트 메뉴로 액세스할 수 있는 스크립트의 구성 UI에서 `Enable Community Modding` 속성을 활성화하고 모딩을 위해 노출되어야 하는 리소스에 대한 [로컬 공급자를 설정](https://naninovel.com/guide/resource-providers#local)합니다.

로컬 공급자의 루트 경로가 기본값(*%DATA%/Resources*)으로 설정되어 있는지 확인하여 빌드 디렉터리에서 추가 리소스를 찾습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-community-modding.avif)

해당 기능이 활성화되면 타이틀 메뉴에 ‘EXTERNAL SCRIPTS’ 버튼이 나타납니다.

외부 스크립트 브라우저가 열립니다. 에디터에 있는 동안 브라우저는 프로젝트 에셋의 나니노벨 스크립트도 나열합니다.

`External Loader` 구성은 외부 스크립트 브라우저에 표시할 스크립트를 제어하는 ​​반면 `Loader`는 실제 스크립트 리소스의 로드를 구성합니다.

외부 로더에는 기본적으로 로컬 공급자가 설정되어 있으므로 게임 빌드 디렉터리에서만 스크립트를 찾습니다. 다른 리소스 유형(배경, 캐릭터 등)의 경우 플레이어가 리소스를 추가할 수 있도록 해당 구성 메뉴에서 로컬 공급자를 수동으로 설정해야 합니다.

리소스 공급자의 작동 방식과 설정 방법에 대한 자세한 내용은 [리소스 공급자 가이드](https://naninovel.com/guide/resource-providers)를 참조하세요.

빌드에 외부 리소스를 추가하려면 *Loader* 아래에 구성된 리소스의 `Path Prefix` 속성에 해당하는 게임의 *`Resources`* 디렉터리 아래 하위 폴더에 해당 리소스를 놓습니다.

예를 들어 외부 naninovel 스크립트를 추가하려면 *GameFolder/GameName\_Data/Resources/Scripts* 폴더에 놓습니다. 배경은 *GameFolder/GameName\_Data/Resources/Backgrounds* 등으로 이동합니다. GameFolder 및 GameName은 Unity 프로젝트 이름에 따라 달라집니다.

외부 스크립트 브라우저 UI는 *[UI 커스터마이제이션](https://naninovel.com/guide/user-interface#ui-customization)* 기능을 사용하여 커스터마이징하거나 완전히 교체할 수 있습니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)