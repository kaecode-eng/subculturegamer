---
title: "나니노벨 Voicing"
url: https://subculturegamer.com/naninovel-voicing/
published: 2024-10-01
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 Voices](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-Voices-1024x538.png)

나니노벨 Voicing

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/voicing)

※최종 수정일: 2024년 12월 13일

---

엔진에 음성 클립을 노출하려면, 이를 *`Resources/Naninovel/Voice`* 폴더에 저장하세요(로더 설정에서 변경 가능).

원한다면 하위 폴더로 정리할 수도 있습니다. 이 경우, 나니노벨 스크립트에서 참조할 때 슬래시(`/`)를 사용하세요.

- 예: `Resources/Naninovel/Voice/Intro/Day/25.wav`에 저장된 음성 클립은 스크립트에서 `Intro/Day/25`로 참조할 수 있습니다.

어드레서블 에셋 시스템으로 리소스를 수동으로 보여줄 수 있습니다. 이때 에셋에 “`Resources/`” 부분을 생략한 경로를 주소로 지정하세요.

예를 들어, “Hello.wav” 음성 클립을 노출하려면, `Naninovel/Voice/Hello` 주소로 에셋을 지정하세요. 기본적으로 에디터에서는 어드레서블 제공자가 사용되지 않으니, 리소스 제공자 설정 메뉴에서 `Enable Addressable In Editor` 옵션을 활성화하세요.

음성 클립에는 [Unity](https://docs.unity3d.com/Manual/AudioFiles.html)에서 지원하는 모든 오디오 포맷을 사용할 수 있습니다.

음성 재생 동작은 *Naninovel -> Configuration -> Audio* 상황에 맞는 메뉴를 사용하여 구성할 수 있습니다. 사용 가능한 옵션은 [구성 가이드](https://naninovel.com/guide/configuration#audio)를 참조하세요.

나노노벨 스크립트에서 `@voice` 명령 뒤에 음성 클립 이름(경로)을 입력해 음성을 재생할 수 있습니다.

```
@voice Hello
```

이 명령은 *`Resources/Naninovel/Voice/Hello.wav`*에 저장된 음성 클립을 재생합니다.

> **메모**
>
> `@voice` 명령어는 특정 순간에 음성 클립을 재생하는 용도로 적합하지, 전체 음성을 구현하는 데는 적합하지 않습니다. 대부분의 텍스트 줄에 음성 클립이 연결된 프로젝트에서는 이 문서 하단의 “녹음용 스크립트” 섹션을 참고하세요.
>
> 일부 기본 제공 기능(예: 백로그의 음성 재생, 내래이션 문서 등)은 오토 보이스 워크플로에서만 작동합니다.

---

## 오토 보이스

음성이 완전히 포함된 게임에서는 각 음성이 있는 라인마다 `@voice` 명령어을 지정하는 것이 번거로울 수 있습니다. 오토 보이스 기능은 재생 지점 또는 고유 텍스트 식별자와 연결된 음성 클립을 자동으로 재생합니다. 이 기능을 활성화하려면 오디오 설정 메뉴에서 *`Enable Auto Voicing`* 옵션을 활성화하세요.

보이스 오디오 클립과 보이스 텍스트 라인 간의 연결은 보이스 지도 유틸리티(voice map utility)를 통해 또는 Unity의 어드레서블 에셋 시스템을 사용하여 오디오 클립 자산에 주소를 할당함으로써(또는 에셋을 다른 리소스 공급자에 노출함으로써) 수행할 수 있습니다.

오토 보이스가 활성화되면 ‘Open Voice Map Utility’ 버튼이 오디오 구성 메뉴에 나타납니다. *Naninovel -> Tools -> Voice Map* 에디터 메뉴로 유틸리티에 액세스할 수도 있습니다.

[<https://naninovel.com/imgit/encoded/i.gyazo.com-3c8fad99f7a18e3f0eaf419c9be92277.mp4@main.mp4>](https://naninovel.com/imgit/encoded/i.gyazo.com-3c8fad99f7a18e3f0eaf419c9be92277.mp4@main.mp4?_=1)

먼저 오디오 클립을 매핑할 스크립트 파일을 선택합니다. 선택한 스크립트에 print 명령어(또는 일반 텍스트 줄)가 포함되어 있으면 오디오 클립 필드와 쌍으로 나열됩니다. 필드를 통해 음성 클립을 드롭(또는 선택)하여 음성을 텍스트와 연결합니다. 클립을 자동으로 매핑하는 것도 가능합니다. 이 경우 이름의 음성 라인 텍스트의 시작과 동일한 클립 에셋을 선택하고 클립(또는 클립이 있는 폴더)을 보이스 맵 유틸리티로 드래그합니다.

> **주의**
>
> 보이스 맵 유틸리티를 통해 클립을 할당하는 경우 충돌을 방지하기 위해 보이스 클립을 ‘Resources’ 폴더 외부에 저장해야 합니다.

소스가 아닌 로케일에 대한 보이스 클립을 연결하려면 Localization Document 필드에서 [스크립트 로컬라이즈 문서](https://naninovel.com/guide/localization#scripts-localization)를 선택하세요.

(※역자 주: 예를 들어, 시나리오 스크립트는 한국어인데 보이스 클립이 일본어인 경우 등)

유효한 문서가 선택되면 할당된 보이스 클립에는 해당 음성 언어가 선택될 때 문서가 저장되고 사용되는 로케일이 자동으로 붙습니다.

동일 화자가 동일한 텍스트 메시지(동일한 스크립트)를 가진 경우 두 메시지 모두 동일한 음성 클립과 연결됩니다. 이를 원하지 않는 경우 메시지 중 하나에 고유한 텍스트 식별자를 추가하세요.

```
Hello.
Hello.|#uniqueid|
```

> **팁**
>
> Naninovel이 보이스 대사를 포함하여 로컬라이즈 가능한 모든 스크립트 텍스트에 대해 고유 ID를 자동으로 생성하도록 하려면 스크립트 구성 메뉴에서 *Stable Identification*을 활성화하세요. 이렇게 하면 중복된 라인에 ID를 수동으로 할당할 필요가 없으며 이미 매핑된 라인을 편집해도 연결이 끊어지지 않습니다. 자세한 내용은 [text identification](https://naninovel.com/guide/naninovel-scripts#text-identification)을 참조하세요.

보이스 맵 유틸리티를 사용하지 않고 클립을 연결하려면, Text ID를 리소스 이름으로 사용하여 음성 로더 접두사(기본값은 *Voice*)로 에셋을 리소스 제공자에 노출시키세요.

특정 텍스트의 ID를 찾으려면 [내래이션 문서](https://naninovel.com/guide/voicing#voiceover-documents)를 사용하세요. 음성의 재생 지점 뒤에 `#`로 시작하는 ID가 표시됩니다.

예를 들어, `2670eb4` ID와 주소 가능한 리소스 제공자에 연결하려면, `Naninovel/Voice/2670eb4` 주소를 사용하세요.

게임 실행 중에 현재 출력된 텍스트와 연결된 Text ID를 찾으려면 디버그 창을 사용하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-voicing-5.avif)

디버그 창을 표시하려면 엔진 설정에서 `Enable Development Console`을 활성화하고, 플레이 모드에서 `~` 키를 누른 후 `debug`를 입력하고 Enter 키를 누르세요.

---

## 화자 볼륨

자동 음성을 사용할 때 플레이어가 특정 캐릭터 또는 더 정확하게는 출력된 캐릭터 메시지 화자의 음성 볼륨을 제어하도록 할 수 있습니다. 예를 들어, 플레이어는 주인공의 목소리를 음소거하거나 특정 캐릭터의 목소리를 낮추기로 결정할 수 있습니다.

화자(캐릭터)별 음성 제어를 설정하려면 커스텀 설정 UI를 만들고 새 슬라이더를 추가하고(프리팹에 이미 있는 ‘VoiceVolumeSlider’를 복제할 수 있음) 작성자 ID 필드에 작성자(캐릭터) ID를 지정합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-voicing.avif)

추가된 슬라이더는 이제 지정된 캐릭터의 음성 볼륨을 제어합니다. 작성자 ID 필드에 아무것도 할당되지 않은 경우 슬라이더는 오디오 믹서의 음성 그룹 볼륨을 제어하여 모든 음성에 영향을 미칩니다.

---

## 보이스 언어

다양한 현지화에 대한 음성 내래이션을 추가할 때 플레이어가 기본 현지화와 별도로 음성 언어를 선택하도록 허용할 수 있습니다(예: 영어 텍스트 및 UI로 게임을 플레이하지만 일본어 음성 해설로 플레이).

게임 설정에 보이스 언어 드롭다운을 추가하려면 오디오 구성 메뉴에서 음성 로케일 속성을 할당하세요. 해당 음성 리소스가 있는 로캘의 언어 태그를 추가합니다. 예를 들어 아래 예에서는 플레이어가 영어와 일본어 음성 중에서 선택할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-voicing-4.avif)

속성이 할당되면 게임 설정 메뉴에 ‘음성 언어’ 드롭다운이 나타납니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-voicing-3.avif)

게임 리소스를 현지화하는 방법에 대한 자세한 내용은 [현지화 가이드](https://naninovel.com/guide/localization)를 참조하세요.

---

## 녹음용 스크립트(Voiceover Documents)

녹음용 스크립트(음성 대본;Voiceover Documents)은 음성 녹음 엔지니어와 성우들이 음성 파일을 제작할 때 사용하기 위한 문서입니다.

*Naninovel -> Tools -> Voiceover Documents* 메뉴에서 음성 대본 생성기를 사용해 문서를 생성할 수 있습니다. 이 문서에는 `@print` 명령어와 일반 텍스트 라인에서 출력된 텍스트가 포함되며, 각 출력된 텍스트 메시지는 오토 보이스 클립 이름과 해시값과 연결됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-voicing-2.avif)

**Locale** 속성을 사용하면 특정 로케일을 선택해 해당 로케일에 맞춘 문서를 생성할 수 있습니다. (프로젝트에 해당 로케일에 맞는 로컬라이즈된 나니노벨 스크립트가 존재해야 합니다.)

**Format** 속성은 생성할 음성 대본의 파일 형식과 포맷을 제어합니다:

- **Plaintext**: 포맷팅 없이 단순한 텍스트 파일로 생성.
- **Markdown**: 가독성을 높이기 위한 추가 포맷이 포함된 [Markdown](https://en.wikipedia.org/wiki/Markdown) 파일로 생성.
- **CSV**: [값을 쉼표(‘,’)로 구분](https://en.wikipedia.org/wiki/Comma-separated_values)하여 테이블 프로세서(예: Google Sheets나 Microsoft Excel)에서 사용할 수 있는 CSV 파일로 생성.

아래는 Markdown 형식으로 생성된 음성 대본의 예시입니다.

![](https://subculturegamer.com/wp-content/uploads/2024/10/나니노벨-voicing-1.avif)

### 커스텀 생성기

문서 형식을 사용자정의하여 특정 방식으로 커스텀 녹음용 스크립트를 생성할 수 있습니다.

커스텀 생성기를 추가하려면, 파라미터가 없는 생성자와 **IVoiceoverDocumentGenerator** 인터페이스를 구현하는 새로운 C# 클래스를 작성하십시오. 유틸리티가 자동으로 해당 클래스를 감지해 빌트인 생성기 대신 사용할 것입니다.

*`GenerateVoiceoverDocument`* 메서드는 선택한 로케일의 각 스크립트에 대해 유틸리티에 의해 호출됩니다. *`list`* 인수는 스크립트에 포함된 명령 목록이며, `locale`은 유틸리티에서 선택된 로케일을 나타냅니다. `outDir`은 유틸리티에서 선택된 출력 경로입니다.

다음은 커스텀 음성 스크립트 생성기의 예시입니다. 이 생성기는 스크립트 이름과 로케일을 헤더에 추가한 후, 각 `print` 명령에 대해 *voice path and hash > author > text* 라인을 포함합니다.

```
public class VoiceoverGenerator : IVoiceoverDocumentGenerator  
{  
public void GenerateVoiceoverDocument (ScriptPlaylist list, string locale, string outDir)  
{  
var builder = new StringBuilder();  
builder.AppendLine($"Voiceover for '{list.ScriptName}' ({locale} locale)");  
foreach (var cmd in list.OfType())  
{  
var voicePath = AudioConfiguration.GetAutoVoiceClipPath(cmd.PlaybackSpot);  
var voiceHash = AudioConfiguration.GetAutoVoiceClipPath(cmd);  
builder.AppendLine($"{voicePath} #{voiceHash} > {cmd.AuthorId} > {cmd.Text}");  
}  
File.WriteAllText($"{outDir}/{list.ScriptName}.txt", builder.ToString());  
}  
}
```

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)