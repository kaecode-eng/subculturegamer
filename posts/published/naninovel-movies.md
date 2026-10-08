---
title: "나니노벨 Movies"
url: https://subculturegamer.com/naninovel-movies/
published: 2024-10-06
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Movies](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-movies.png)

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/movies)

---

### 역자주

```
※원문의 Movies는 직역하면 '영화'이나, 실제로는 게임에서 재생되는 '시네마틱'이나 '컷신'에 가까운 개념입니다.
하지만 의역하게 되면 나니노벨 Project Settings UI에 쓰인 용어(예: En에서는 'Movies', 한국어로는 '시네마틱')와의 통일성이 깨지게 되므로 이 글에서는 '무비'라고 번역했습니다.
```

---

‘무비’는 *IMovieUI* UI로 씬 위에서 재생되는 비디오입니다. 무비가 재생되는 동안에는 스크립트 실행과 사용자 입력이 잠시 중단됩니다.

무비 재생을 시작하기 전 지정된 페이드 텍스처(디폴트는 블랙 아웃)로 Fade-In 됩니다. 재생이 끝나면 페이드 텍스처에서 씬 콘텐츠까지 페이드 아웃이 수행됩니다.

플레이어는 *Cancel* 입력(스탠드어론 입력 모듈에서는 보통 ‘Esc’)을 사용하여 무비 재생을 건너뛸 수 있습니다. 키 바인딩은 configuration 메뉴에서 변경할 수 있습니다.

무비 리소스를 추가, 편집 및 제거하려면 *Naninovel -> Resources -> Movies* 상황에 맞는 메뉴를 통해 액세스할 수 있는 무비 매니저를 활용하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-movies-3.avif)

[Unity](https://docs.unity3d.com/Manual/VideoSources-FileCompatibility)에서 지원하는 모든 비디오 형식을 사용할 수 있습니다.

무비 재생 동작은 *Naninovel -> Configuration -> Movies* 에디터 메뉴를 사용하여 구성할 수 있습니다. 사용 가능한 옵션은 [구성 가이드](https://naninovel.com/guide/configuration#movies)를 참조하세요.

naninovel 스크립트에서 동영상을 재생하려면 @movie 명령어 뒤에 비디오 클립 이름을 사용하십시오.

```
;무비 리소스로 추가된 "Opening" 비디오 클립을 재생합니다.
@movie Opening
```

기본적으로 재생되는 비디오는 비율이 틀어지는 것을 방지하기 위해 16:9 화면 비율로 맞춰집니다.

*IMovieUI* UI를 [재정의](https://naninovel.com/guide/user-interface.html#ui-customization)하여 이 동작을 변경할 수 있습니다. *MovieImage* 게임 오브젝트에 연결된 *Aspect Ratio Fitter* 구성 요소는 피팅 동작을 제어합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-movies-2.avif)

---

## WebGL 환경에서의 한계

플랫폼 제한으로 인해 WebGL에서의 비디오 재생은 URI 스트리밍 모드에서만 가능합니다. WebGL 플레이어를 빌드할 때 모든 무비 리소스는 자동으로 *Assets/StreamingAssets* 디렉터리에 복사됩니다.

플레이어 빌드 디렉터리에서 웹 호스팅이 로컬 파일 액세스를 허용하는지 구성을 확인하세요.

.mp4 등의 비디오 파일 포맷(예: webm)을 사용하는 경우 리소스 공급자 구성의 `Video Stream Extension` 프로퍼티로 호스팅된 파일의 확장자를 설정합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-movies-1.avif)

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)