---
title: "나니노벨 Audio"
url: https://subculturegamer.com/naninovel-audio/
published: 2024-10-01
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Audio](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-audio.png)

나니노벨 Audio

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/audio)

---

이번 글에서는 배경 음악(BGM)과 효과음(SFX)에 대해 다룹니다. 보이스(Voice)에 대한 내용은 [voicing guide](https://naninovel.com/guide/voicing) 페이지를 참고하세요.

BGM 및 SFX 리소스를 추가, 편집 또는 제거하려면 *Naninovel -> Resources -> Audio*를 통해 오디오 리소스 관리자를 사용할 수 있습니다. [Unity에서 지원](https://docs.unity3d.com/Manual/AudioFiles.html)하는 모든 오디오 포맷을 사용할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-audio-2.avif)
> **팁**
>
> 개발 워크플로에 가장 적합한 파일 형식을 선택하세요. 프로젝트 빌드 시 Unity는 모든 원본 리소스(텍스처, 오디오, 비디오 등)를 대상 플랫폼에 가장 적합한 형식으로 자동 변환하므로, 프로젝트에 저장한 리소스의 형식은 중요하지 않습니다. Unity가 프로젝트 에셋을 관리하는 방법에 대한 자세한 내용은 [공식 문서](https://docs.unity3d.com/Manual/AssetWorkflow)를 참조하세요.

오디오 파일이 많아 편집기 메뉴를 통해 할당하기 불편할 경우, *Resources/Naninovel/Audio* 폴더에 파일을 바로 추가하면 스크립트에서 자동으로 사용할 수 있습니다. 필요 시 하위 폴더를 생성해 원하는대로 정리할 수 있는데, 슬래시(‘/’) 문자로 naninovel 스크립트에서 참조 가능합니다.

예를 들어, *Resources/Naninovel/Audio/Music/Ambient/Noise002.wav*라는 경로와 이름으로 저장된 오디오 클립은 스크립트에서 *Music/Ambient/Noise002*라고 기재하면 참조할 수 있습니다.

어드레서블 에셋 시스템으로 수동으로 리소스를 추출해 사용할 수도 있습니다. 에셋을 추출하려면 “Resources/” 부분을 제외하고 위 설명의 경로와 동일한 주소를 할당하세요.

예를 들어, “MainTheme.wav” BGM을 사용하려면 Naninovel/Audio/MainTheme으로 클립 에셋을 할당합니다. 어드레서블 공급자는 기본적으로 에디터에서 사용되지 않으며, 리소스 공급자 구성 메뉴에서 “Enable Addressable In Editor” 속성을 활성화하여 사용할 수 있습니다.

> **경고**  
> 리소스 관리자에서 할당되지 않은 오디오 에셋은 캐릭터 배우의 메시지 사운드를 선택하는 드롭다운과 같은 다양한 편집기 드롭다운에서 사용할 수 없습니다.

오디오 재생 동작은 *Naninovel -> Configuration -> Audio* 컨텍스트 메뉴에서 설정할 수 있습니다. 가능한 옵션은 [설정 가이드](https://naninovel.com/guide/configuration#audio)를 참조하세요.

---

### 배경음악(BGM)

naninovel 스크립트에서 @bgm 명령어 뒤에 클립명을 입력해 음악 재생을 제어할 수 있습니다.

```
; Sanctuary라는 이름의 음악 트랙을 반복 재생합니다.
@bgm Sanctuary

; 위와 동일하지만, 10초 동안 볼륨을 서서히 키우고 한 번만 재생합니다.
@bgm Sanctuary fade:10 loop:false

; 모든 재생 중인 음악 트랙의 볼륨을 2.5초 동안 50%로 변경하고 반복 재생합니다.
@bgm volume:0.5 loop:true time:2.5
```

음악 트랙은 기본적으로 반복 재생(루프)됩니다.

@bgm 명령어에서 음악 트랙 이름을 지정하지 않으면 현재 재생 중인 모든 트랙에 영향을 미칩니다.

이미 재생 중인 트랙(음악)에 대해 명령어를 호출하면 재생이 중단되지 않습니다. (트랙이 처음부터 다시 재생되지 않음)

대신, 새롭게 지정된 매개변수(볼륨 및 반복 여부)가 적용됩니다.

*intro* 매개변수를 사용하여 도입부 뒤에 반복 재생되는 트랙을 재생할 수도 있습니다.

```
; BattleThemeIntro를 한 번 재생한 후 BattleThemeMain을 반복 재생합니다.
@bgm BattleThemeMain intro:BattleThemeIntro
```

재생 중인 음악 트랙을 중지하려면 @stopBgm 명령 뒤에 클립 이름을 입력하세요. 클립 이름이 지정되지 않은 경우, 명령은 현재 재생 중인 모든 트랙을 중지합니다.

```
; Promenade 음악 트랙의 재생을 10초 동안 페이드 아웃시키고 중지합니다.
@stopBgm Promenade fade:10

; 현재 재생 중인 모든 음악 트랙을 중지합니다.
@stopBgm
```

---

### 효과음(SFX)

naninovel 스크립트에서 @sfx 및 @stopSfx 명령 뒤에 클립 이름을 입력하여 사운드 효과 재생을 제어할 수 있습니다.

```
; `Explosion`이라는 이름의 SFX를 한 번 재생합니다.
@sfx Explosion

; `Rain`이라는 이름의 SFX를 반복 재생합니다.
@sfx Rain loop:true

; 모든 재생 중인 SFX 트랙의 볼륨을 2.5초 동안 75%로 변경하고 모든 반복을 비활성화합니다.
@sfx volume:0.75 loop:false time:2.5
```

효과음 트랙은 기본적으로 반복(루프)되지 않습니다.

@sfx 명령어에서 sfx 트랙 이름을 지정하지 않으면 현재 재생 중인 모든 트랙에 영향을 미칩니다.

이미 재생 중인 트랙(효과음)에 대해 명령어를 호출하면 재생이 중단되지 않습니다. (트랙이 처음부터 다시 재생되지 않음)

대신, 새롭게 지정된 매개변수(볼륨 및 반복 여부)가 적용됩니다.

`` ; `Rain`이라는 이름의 SFX 재생을 15초 동안 페이드 아웃하며 중지합니다. ``  
@stopSfx Rain fade:15

; 현재 재생 중인 모든 사운드 효과 트랙을 중지합니다.  
@stopSfx

---

## 오디오 믹서

Naninovel은 오디오 재생 시 [오디오 믹서](https://docs.unity3d.com/Manual/AudioMixer.html) 에셋을 사용하여 BGM, SFX 및 목소리 채널을 분리합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-audio-1.avif)

커스텀 믹서 에셋을 할당하고 각 오디오 채널 및 볼륨 제어 핸들러(노출된 매개변수 이름)를 오디오 구성 메뉴에서 변경할 수 있습니다. 커스텀 믹서 에셋이 할당되지 않은 경우 기본 믹서가 사용됩니다.

커스텀 믹서 그룹을 통해 오디오를 재생하려면 @bgm, @sfx 및 @voice 명령에서 *group* 매개변수를 사용하여 그룹 경로를 지정하세요.

```
; `Master/Ambient` 믹서 그룹에서 `Noise` 오디오 리소스를 반복 재생합니다.@sfx Noise loop:true group:Master/Ambient

; Master/Reverb 믹서 그룹을 통해 ScaryVoice 음성을 재생합니다.
@voice ScaryVoice group:Master/Reverb
```

그룹은 현재 할당된 오디오 믹서 에셋의 *FindMatchingGroups(groupPath)* 메서드를 통해 검색됩니다. 경로 형식에 대한 자세한 내용은 [Unity 문서](https://docs.unity3d.com/ScriptReference/Audio.AudioMixer.FindMatchingGroups)를 참조하세요. 제공된 경로에 여러 그룹이 연결된 경우 첫 번째 그룹이 오디오를 재생하는 데 사용됩니다.

C# 스크립트에서 현재 사용 중인 오디오 믹서는 [IAudioManager 엔진 서비스](https://naninovel.com/guide/engine-services)를 통해 가져올 수 있습니다.

```
var audioManager = Engine.GetService();  
var audioMixer = audioManager.AudioMixer;
```

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)