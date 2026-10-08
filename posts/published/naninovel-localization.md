---
title: "나니노벨 Localization"
url: https://subculturegamer.com/naninovel-localization/
published: 2024-12-08
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

※원문 페이지: [(링크)](https://naninovel.com/guide/localization)

※마지막 수정일: 2024/12/08

---

나니노벨에서는 모든 게임 리소스(스크립트, 오디오, 보이스, 배경, 등등)는 다양한 언어와 문화권에 맞춰 로컬라이즈할 수 있습니다.

원래 프로젝트를 작성하는 데 사용된 리소스는 기본적으로 소스 로케일과 연동됩니다.

예를 들어, 게임이 처음에 영어로 제작된 경우 모든 원본(소스) 나니노벨 스크립트, UI, 배경 표시 등은 영어로 구성됩니다. 이는 소스 로케일이 *en(또는 특정 지역에 대해 별도의 로케일을 사용하려는 경우 en-GB / en-US / 등)*임을 의미합니다.

소스 로케일은 `Naninovel -> Configuration -> Localization` 메뉴의 Source Locale 프로퍼티에서 변경 가능합니다.

Source Locale 속성은 소스 프로젝트 자산과 관련된 로케일의 이름(ID)을 결정합니다. 또한 ‘Language’ 드롭다운 설정 메뉴 및 관련 엔진 API에서 로케일을 구별하는 데 사용됩니다.

![나니노벨 Localization 1](https://subculturegamer.com/wp-content/uploads/2024/12/image.png)

로케일을 추가하려면 Resources/Naninovel/Localization(소위 말하는 로컬라이즈 리소스 루트) 내에 하위 폴더를 만듭니다. 이때 폴더의 이름은 [RFC5646](https://gist.github.com/Elringus/db90d9c74f13c00fa35131e61d1b73cb) 언어 태그 중 하나와 동일한 이름을 가져야 합니다.

예를 들어 독일어 로캘을 추가하려면 Resources/Naninovel/Localization/de 폴더를 만듭니다. 게임 설정 빌트인 UI의 ‘Language’ 드롭다운 목록에는 추가된 모든 로케일이 자동으로 통합됩니다.

소스 로케일에 대한 *localization resources root* 경로에 하위 폴더를 만들 필요는 없습니다. *localization resources root* 외부에 저장된 모든 프로젝트 리소스는 기본적으로 소스 로케일에 속합니다.

*Localization resources root* 특정 경로는 로컬라이제이션 구성 메뉴에서 Loader > Path Prefix 프로퍼티로 변경할 수 있습니다. 구성된 경로는 ‘Resources’ 폴더(‘Assets’이 아님)에 상대 경로로 인식됩니다. 리소스 폴더는 Unity에서 [특별한 방식](https://docs.unity3d.com/Manual/LoadingResourcesatRuntime.html)으로 처리됩니다. 조직에서 사용하기 위한 목적으로 프로젝트 에셋 내부 어디에나 이러한 폴더를 여러 개 저장할 수 있습니다.

> **팁**
>
> 다른 유형의 리소스와 마찬가지로 Resources 폴더를 사용하는 대신 다른 리소스 공급자를 선택할 수 있습니다. 예를 들어 어드레서블 공급자를 사용하면 기본 게임 패키지와 별도로 로케일별 리소스를 번들로 묶고 필요할 때 다운로드할 수 있습니다.

---

## 디폴트 로케일

플레이어가 게임을 처음 실행할 때 기본적으로 선택되는 로케일을 지정하려면 로컬라이제이션 구성 메뉴의 Default Locale 프로퍼티를 사용하세요. 프로퍼티가 지정되지 않으면 게임은 *Source Locale*에서 시작됩니다.

구성에서 *Auto Detect Locale* 옵션이 활성화되고 게임이 처음 실행되면 Naninovel은 시스템 언어를 기반으로 로케일을 자동으로 감지하려고 시도합니다. 성공하고 해당 로캘이 게임에서 지원되면 선택됩니다. 그렇지 않으면 디폴트 로케일로 돌아갑니다.

> **주의**
>
> 자동으로 감지된 로케일에는 지정자가 없습니다. 즉, 시스템 언어가 영어인 경우 감지된 로케일은 en이 되며 en-US 또는 en-GB가 아닙니다. 이는 Unity의 [시스템 언어 감지](https://docs.unity3d.com/ScriptReference/Application-systemLanguage)의 제한 사항입니다. 자동 감지에 의존하는 경우 추가된 로케일에 지정자를 사용하지 않도록 하세요.

## 리소스 로컬라이제이션

localization resources root 내부는 게임 세팅에서 지정된 상응하는 로컬라이제이션이 아닌 소스들 리소스를 저장합니다.

예를 들어, ja-JP 로캘을 선택할 때 기본 배경(‘MainBackground’ ID가 있는 배경 액터)의 ‘City’ 모양 스프라이트를 다른 것으로 바꾸려면 현지화된 버전을 다음 경로에 배치하세요: *Resources/ Naninovel/현지화/ja-JP/Backgrounds/MainBackground/City.*

## 스크립트 로컬라이제이션

위에서 설명한 리소스 로컬라이제이션 스키마는 naninovel 스크립트 및 관리되는 텍스트 문서를 제외한 모든 리소스 유형에서 작동합니다. 이러한 유형의 리소스에는 Naninovel -> Tools -> Localization를 통해 액세스할 수 있는 로컬라이제이션 툴을 사용하세요.

![나니노벨 Localization 2](https://subculturegamer.com/wp-content/uploads/2024/12/image-1.png)

먼저 *Scripts Folder (input)* — Naninovel 시나리오 스크립트(.nani)가 저장되는 프로젝트 경로(예: *Assets/Scenario*)를 선택합니다.

옵션 사항으로, 관리형 텍스트(Managed text)에 관해서도 로컬라이즈 문서를 만들고 싶다면 *Text Folder (input)*란에 관리형 텍스트 문서가 저장되는 경로를 입력하세요.(디폴트 경로: `Assets/Resources/Naninovel/Text`)

이전에 생성한 문서에서 소스 로케일이 아니라 다른 로케일에 대해 로컬라이즈 문서를 생성하려는 경우 소스 시나리오 스크립트 폴더 대신 다른 로케일에 대한 기존 로컬라이즈 문서가 있는 텍스트 폴더를 선택합니다. (예: *Assets/Resources/Naninovel/Localization/ja-JP/Text*)

그런 다음 생성된 로컬라이즈 리소스를 저장할 로케일 폴더 경로를 선택합니다. 실제 로케일 폴더(예: *Resources/Naninovel/Localization/ja-JP*)를 선택했는지 확인하세요. 유효한 출력 로케일 폴더가 선택되면 프로퍼티 필드 아래에 선택한 로컬라이즈 대상의 이름이 표시됩니다.

> **팁**
>
> 프로젝트에서 사용 가능한 모든 로케일에 대한 리소스를 한 번에 생성할 수 있습니다. 특정 로케일 폴더 대신 *localization resources root* 경로를 선택하고 다른 것은 동일하게 진행합니다. 이 도구는 선택한 경로에 하위 폴더 및 각 폴더에 대한 리소스를 반복 생성합니다.
>
> ![나니노벨 Localization 3](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-1.avif)

‘Generate’ 버튼을 누르면 로컬라이즈 리소스가 생성(또는 업데이트)됩니다. 후속 실행시에는 이전에 생성된 로컬라이즈 문서를 보존하고, 변경되지 않았던 자료에 대한 로컬라이즈 상태는 그대로 유지합니다.

현지화 리소스를 생성(업데이트)하려면 ‘생성’ 버튼을 누르세요. 후속 실행 시 도구는 이전에 생성된 지역화 문서를 존중하고 소스 자료가 변경되지 않은 경우 지역화된 설명을 보존합니다.

스크립트 로컬라이즈 문서는 *Scenario* 폴더 아래에 그룹화되어 있으며 다음 형식의 명령문으로 구성됩니다.

```
# ID
; 소스 텍스트
번역문
```

- **# ID** 라인은 로컬라이즈 콘텐츠의 고유 식별자이므로 수정하면 안 됩니다.
- **; 소스 텍스트** 라인은 번역할 것으로 예상되는 원본 콘텐츠입니다. 이것은 단지 주석이므로 이 줄을 변경해도 아무런 효과가 없습니다. 편의를 위해 제공됩니다.
- **번역문** 라인은 실제 번역 스크립트입니다.

원본 텍스트가 포함된 주석 줄 바로 뒤에 실제 번역을 넣어야 합니다. 가독성을 위해 번역에 여러 줄을 사용할 수 있습니다(이러한 입력 방식도 결합될 것입니다). 단, 번역문을 개행하는 경우에도 다음에 이어질 # ID 라인 앞에 배치해야 합니다.

> **예시**
>
> ```
> # aj0e5dea
> ; Aliquam ut <b>ultricies</b> enim, id venenatis.<br>Nullam rhoncus eros tempus.
> Оценивая блеск <b>металлического</b> шарика, пространство равноденственно.<br>
> Противостояние есть метеорный дождь.
> ```

### 라인 결합

번역된 일반 라인에 인라인된 명령이나 표현식이 포함된 경우 여러 텍스트 조각으로 분할되며 각각은 고유한 텍스트 ID에 매핑됩니다. 라인 결합 옵션이 활성화되면 이러한 조각은 파이프 기호 ‘|’를 사용하여 단일 라인으로 결합됩니다.

아래의 소스 스크립트의 예시를 확인해 보세요.

```
Looks like rain is starting[rain]. Hey, {MC}, hurry up!
```

위 라인은 아래와 같이 로컬라이즈 문서가 생성됩니다.

```
# id1|id2|id3
; Looks like rain is starting|. Hey, |, hurry up!
```

인라인된 명령과 표현식이 ‘|’로 대체되었습니다.

아래와 같이, 번역된 텍스트에서 이를 보존하는 것을 잊지 마십시오.

```
# id1|id2|id3
; Looks like rain is starting|. Hey, |, hurry up!
Похоже, дождь начинается|. Эй, |, поспеши!
```

필요한 경우 로컬라이즈 텍스트를 재배열하는 것도 가능합니다. 아래는 그 예시입니다.

```
# id1|id2
; Hey, |, hurry up!
|, эй, поспеши!
```

위 문장은 {mc} (메인 캐릭터 이름)을 나머지 문장 앞에 출력시킬 것입니다.

> **팁**
>
> 예를 들어 실제 명령어를 다시 작성하거나 표현식의 순서를 변경하도록 허용하는 등 번역자가 인라인된 콘텐츠에 대해 더 많은 제어권을 부여하려면 [이벤트 드러내기](https://naninovel.com/guide/text-printers#reveal-events) 및 [표현식 드러내기](https://naninovel.com/guide/text-printers#reveal-expressions)를 확인하세요.

### 주석

**Include Annotations**(주석 포함) 옵션이 활성화되면 생성된 로컬라이즈 문서에는 현지화되는 소스 스크립트 콘텐츠(명령어 또는 일반 라인)와 그 앞에 배치된 모든 설명이 포함됩니다.

예를 들어, 다음 소스 스크립트 텍스트를 확인해 보세요.

```
; Player has to pick route.
@choice "Go left" set:route="left"
@choice "Go right" set:route="right"
@stop
Narrator: You've decided to go {route}. Wise choice!
```

위 문서를 로컬라이즈하면 아래와 같은 문서가 생성됩니다.

```
# id1
; > Player has to pick route.
; > @choice "|#id1|" set:route="left"
; Go left

# id2
; > @choice "|#id2|" set:route="right"
; Go right

# id3|id4
; > Narrator: |#id3|{route}|#id4|
; You've decided to go |. Wise choice!
```

이는 로컬라이즈된 텍스트에 대해 번역자에게 더 많은 맥락을 제공하는 데 유용할 수 있습니다. 번역 줄에 주석( ; >로 시작하는 줄)을 포함하지 않도록 하세요. ‘;’만으로 시작하는 줄의 현지화된 텍스트만 번역될 것으로 예상 가능합니다.

> **예시**
>
> 로컬라이즈 샘플에서 [로컬라이즈 설정 예시](https://naninovel.com/guide/samples#localization)를 찾아보세요. 자신의 프로젝트에서 현지화를 설정하는 데 문제가 있는 경우 참조로 사용하는 것을 고려해보세요.

---

## 스프레드시트

모든 프로젝트 시나리오 스크립트와 관리되는 텍스트 로컬라이즈를 스프레드시트로 컴파일 및 관리하고 싶을 수 있습니다. 이는 예를 들어 언어 교정을 위해 번역 대행사나 편집자와 텍스트를 공유하는 경우에 유용합니다.

스프레드시트 도구를 사용하면 프로젝트에서 로컬라이즈가능한 모든 텍스트를 *.csv* 시트로 추출한 다음 다시 가져올 수 있습니다.

![나니노벨 Localization 4](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-2.avif)

프로젝트 데이터를 내보내기 전에는 항상 로컬라이즈 도구(Naninovel – Tools – Localization)를 사용하여 로컬라이즈 데이터를 먼저 생성하세요.

Locale Folder (output) 프로퍼티에 로컬라이즈 루트 디렉터리(기본적으로 Resources/Naninovel/Localization)를 설정하여 프로젝트에 정의된 모든 로케일에 대한 리소스를 한 번에 생성할 수 있습니다.

![나니노벨 Localization 5](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-3.avif)

로컬라이즈 데이터가 최신이면 Naninovel -> Tools -> Spreadsheet 에디터 메뉴를 사용하여 스프레드시트 도구를 엽니다.

![나니노벨 Localization 6](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-4.avif)

위 팝업에서 각기 필요한 폴더를 지정합니다.

- Input Script Folder: 소스 로케일의 naninovel 시나리오 스크립트(.nani)를 저장하는 폴더입니다. 일반적으로 예제 프로젝트에서는 Assets/Scenario 폴더에 저장합니다.
- Input Text Folder: 소스 로케일의 관리형 텍스트 문서가 생성되는 폴더입니다. (디폴트 경로: *Assets/Resources/Naninovel/Text*) 폴더가 누락된 경우 관련 도구를 통해 관리되는 텍스트 문서를 생성하십시오.
- Input Localization Folder: 소스 로케일이 아닌 다른 로컬라이즈 로케일에 대한 리소스가 저장되는 로컬라이즈 루트입니다. (디폴트 경로: *Assets/Resources/Naninovel/Localization*)
- Output Folder: 생성된 시트를 저장하거나 편집된 시트를 가져올 폴더입니다.

선택한 대상으로 시트를 내보내려면 ‘Export’ 버튼을 클릭하세요.

각 스크립트와 관리형 텍스트 문서는 개별 시트로 내보내집니다. 각 시트에는 로컬라이즈 가능한 텍스트 ID를 저장하는 ‘ID’ 열과 각 로케일 별 추가 열이 있습니다. 스프레드시트에서는 ‘ID’를 제외한 모든 열을 자유롭게 수정할 수 있습니다. 단, 소스 로케일과 연관된 열을 수정해도 가져오기에는 아무런 영향이 없습니다.

**Include Annotations** 옵션이 활성화되면 생성된 시트에는 소스 스크립트 내용, 예를 들면 화자의 이름, 인라인 명령어, 번역문 앞에 배치되는 주석 등이 포함됩니다. 가져오는 동안 열은 무시됩니다.

필요한 수정을 수행한 후 ‘가져오기’ 버튼을 클릭하여 데이터를 프로젝트로 다시 가져옵니다.

> **주의**
>
> 스프레드시트에서 가져올 때 프로젝트의 로컬라이즈 문서를 덮어쓰게 되므로 충돌을 방지하기 위해 스프레드시트를 편집하는 동안 문서를 수정하지 마십시오.

### 커스텀 프로세서

커스텀 스프레드시트 프로세서를 삽입하여 시트 생성 방식과 가져오기 및 내보내기 프로세스를 사용자 정의할 수 있습니다.

빌트인 Naninovel.Spreadsheet.Processor 핸들러를 상속하여 커스텀 프로세서 클래스를 만듭니다. 유틸리티는 자동으로 커스텀 핸들러를 선택하여 빌트인 핸들러 대신 사용합니다.

다음은 몇 가지 주요 재정의 지점이 있는 맞춤형 프로세서의 예입니다.

```
using Naninovel.Spreadsheet;

public class CustomProcessor : Processor
{
    public CustomProcessor (ProcessorOptions options) : base(options)
    {
        // 내보내기/가져오기 프로세스 옵션에 액세스, eg:
        // options.ScriptFolder
        // options.SourceLocale
        // ...etc
    }

    // 프로젝트에서 시트로 스크립트를 내보내는 방법을 재정의합니다.
    protected override void ExportScripts () { }
    // 관리형 텍스트를 프로젝트에서 시트로 내보내는 방법을 재정의합니다.
    protected override void ExportText () { }
    // 스크립트를 시트에서 프로젝트로 가져오는 방법을 재정의합니다.
    protected override void ImportText () { }
    // 관리형 텍스트를 시트에서 프로젝트로 가져오는 방법 재정의합니다.
    protected override void ImportScripts () { }
}
```

> **예시**
>
> [로컬라이즈 샘플](https://naninovel.com/guide/samples#localization)에서 도구를 설정하고 사용하는 방법에 대한 예를 찾아보세요.

---

## UI 로컬라이즈

커스텀 UI와 빌트인 UI를 모두 로컬라이즈하려면 [managed text provider](https://naninovel.com/guide/managed-text#managed-text-provider) 컴포넌트를 사용하세요. 이는 다른 커스텀 게임 오브젝트(프리팹)를 현지화하는 데에도 사용할 수 있습니다. 관리 텍스트 레코드를 사용하고 지역화하는 방법에 대한 자세한 내용은 관리 텍스트 가이드를 참조하세요.

### 폰트

일부 언어로 텍스트를 표시하려면 호환되는 글꼴이 필요합니다. [Inter](https://github.com/rsms/inter) 폰트는 기본적으로 유니코드 7.0의 모든 라틴어, 키릴 문자 및 그리스 문자를 지원하는 데 사용됩니다.

> **팁**
>
> 단일 글꼴로 여러 언어를 지원하려는 경우 [Noto 폰트](https://www.google.com/get/noto/)를 확인하세요.

오른쪽에서 왼쪽(RTL) 언어(아랍어, 히브리어, 페르시아어 등)는 TMPro 텍스트 프린터에서 지원되지만 추가 설정이 필요합니다. 자세한 내용은 [가이드](https://naninovel.com/guide/text-printers.html#right-to-left-arabic-text)를 참조하세요.

CJK 언어(중국어, 일본어, 한국어)로 출판할 때 문자 추출 유틸리티를 사용하여 TMPro 글꼴 아틀라스 크기를 최적화하는 것을 고려해 보십시오. ([가이드](https://naninovel.com/guide/text-printers.html#cjk-languages))

글꼴을 특정 로케일과 연결하려면 UI 구성에 있는 글꼴 옵션의 `Apply On Locale` 속성을 사용하세요. 로케일을 선택하면 게임 설정에서 해당 로케일을 선택할 때 글꼴이 자동으로 적용됩니다.

![나니노벨 Localization 7](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-5.avif)

기능이 작동하려면 *Font Change Configuration* 컴포넌트가 텍스트 출력기에 올바르게 설정되어 있는지 확인하십시오. ([가이드](https://naninovel.com/guide/user-interface#changing-font))

---

## 커뮤니티 로컬라이즈

### 로컬라이즈 리소스 추출

현지화 리소스(스크립트 및 관리되는 텍스트 문서)를 생성하려면 *-nani-eject* 인수를 사용하여 게임 실행 파일을 실행하세요. 예:

```
./game.exe -nani-eject
```

평소와 같이 게임이 시작되지만 Naninovel이 초기화된 후 로컬라이즈 폴더 아래의 Unity [persistent data folder](https://docs.unity3d.com/ScriptReference/Application-persistentDataPath.html)에 로컬라이즈 리소스가 추출됩니다.

예를 들어, 애플리케이션 회사가 *Foo*이고 게임 제목이 *Bar*인 경우 Windows에서 추출된 경로는 *C:/Users/User/AppData/LocalLow/Foo/Bar/Localization*입니다.

내장된 로컬라이즈를 기반으로 로컬라이즈 리소스를 생성하려면 로케일 태그를 추출 인수에 포함시키세요.

예를 들어, 게임이 ja-JP 로컬라이즈를 가지면 다음 인수를 사용하여 일본어 로컬라이즈 문서를 추출합니다.

- *-nani-eject-ja-JP*.

별도의 로케일 태그를 지정하지 않으면 소스 로케일에 대한 문서가 추출됩니다.

이제 로컬라이즈에 사용할 글꼴을 제공합니다. Localization 디렉터리 아래에 폰트 파일을 놓습니다(예: *Localization/Noto.ttf*).

*Localization/Info.txt* 파일을 확인하세요. 여기에서는 파일의 기본 콘텐츠를 대체하여 로컬라이즈 작성자(첫 번째 줄)와 제공된 글꼴 파일명(두 번째 줄)을 지정해야 합니다. 예는 다음과 같습니다.

```
Awesome Author
Noto.ttf
```

— ‘Awesome Author’는 기본적으로 언어 드롭다운에 표시되지만 개발자는 이 동작을 사용자 정의할 수 있습니다. 게임을 시작하면 기본적으로 글꼴이 적용됩니다.

Info.txt 파일은 커뮤니티 로컬라이즈의 존재를 감지하는 데 필요하므로 삭제하거나 이동하지 마십시오.

### 번역

문서가 추출된 후 번역을 시작할 수 있습니다. 이 과정은 위에서 설명한 ‘스크립트 로컬라이즈’, ‘UI 로컬라이즈’와 유사합니다. 스크립트 로컬라이즈 문서는 *Localization/Text/Scripts* 폴더에 저장되고, 관리형 텍스트 문서는 *Localization/Text* 폴더에 저장됩니다.

Eject 인수 없이 평소대로 게임을 다시 시작하면 persistent data folder의 로컬라이즈 리소스가 자동으로 사용됩니다. 스크립트 로컬라이즈 변경 사항을 적용하려면 관련 스크립트를 다시 로드해야 하지만(일반적으로 저장-로드만으로 충분함) 경우에 따라 게임을 다시 시작해야 할 수도 있습니다.

개발자가 게임을 업데이트하는 경우 다시 추출해서 기존 로컬라이즈를 업데이트할 수 있습니다. 새로운 라인과 기록이 삽입되지만 변경되지 않은 원본 자료에 대한 기존 번역은 손실되지 않습니다.

로컬라이즈가 완료된 후 로컬라이즈 폴더를 공유하고 최종 사용자에게 이를 앞서 언급한 persistent data 경로에 배치하여 로컬라이즈를 활성화하도록 지시합니다. 현지화를 비활성화하려면 폴더를 삭제하세요.

---

## 컴파일러 로컬라이즈

NaniScript는 자연어와 밀접하게 얽혀 있다는 점에서 도메인별 언어 중에서 특별합니다. 즉, 플레이어에게 표시되는 출력된 텍스트 라인과 명령어 및 레이블과 같은 엔진 스크립팅 구성 사이를 끊임없이 전환해야 합니다.

영어로 시나리오를 작성하는 한 문제가 되지 않습니다. 그러나 다른 언어로 작업하는 시나리오 작성자를 상상해 보십시오. 그들은 자신의 언어로 된 자연 텍스트와 영어로 된 명령줄을 입력하기 위해 레이아웃 사이를 끊임없이 전환해야 합니다. 더 나쁜 것은 일부 키보드 레이아웃에는 명령에 사용되는 ‘@’와 같은 필수 제어 키가 없어 작성자가 키 코드를 통해 입력해야 할 수도 있다는 것입니다.

영어 이외의 언어로 시나리오를 작성하는 데 도움이 되도록 Naninovel에는 컴파일러 로컬라이즈 기능이 있습니다. 이를 통해 모든 제어 문자는 물론 명령 및 매개변수 이름, 상수 및 기본적으로 시나리오 작성 시 입력해야 하는 모든 항목을 다시 매핑할 수 있습니다.

먼저 *Create – Naninovel – Compiler Localization* 컨텍스트 메뉴를 통해 컴파일러 로컬라이즈 에셋을 생성합니다. 에셋을 선택하고 컴파일러 아티팩트에 대해 선호하는 로컬라이즈를 지정합니다.

![나니노벨 Localization 8](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-6.avif)

명령어, 매개변수, 기능 및 상수를 재정의하려면 전용 목록을 사용하십시오. 명령어 및 매개변수와 관련된 문서 및 사용 예시를 로컬라이즈할 수도 있습니다. 이는 IDE 확장에 표시됩니다.

![나니노벨 Localization 9](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-7.avif)

목록은 처음에는 비어 있습니다. 프로젝트에서 사용할 수 있는 명령과 기능으로 채우려면 검사기 상황에 맞는 메뉴를 사용하세요.

![나니노벨 Localization 10](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-8.avif)

필요한 사항을 변경한 후 Unity 에디터를 다시 시작하고 변경 사항을 적용하려면 시나리오 스크립트 에셋을 다시 가져옵니다.

현지화된 아티팩트가 비주얼 에디터 및 IDE 확장에 전파되므로 메타데이터를 동기화한 후 자동 완성 및 마우스오버 시 문서를 얻을 수 있습니다.

![나니노벨 Localization 11](https://subculturegamer.com/wp-content/uploads/2024/12/나니노벨-localization-9.avif)

예시

컴파일러가 러시아어 및 키보드 레이아웃으로 지역화되어 있는 [컴파일러 로컬라이즈 샘플](https://naninovel.com/guide/samples#compiler-localization)을 확인하세요.

### 연관글:

[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 아니메재팬 2025 출장 후기](https://subculturegamer.com/animejapan-2025-review/)[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)