---
title: "나니노벨 IDE Extension"
url: https://subculturegamer.com/naninovel-ide-extension/
published: 2024-09-15
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

![나니노벨 IDE Extension](https://subculturegamer.com/wp-content/uploads/2025/12/나니노벨-ide-extension.png)

나니노벨 IDE Extension

## 개요

※이 글은 유니티 다이얼로그 시스템 에셋 ‘Naninovel(나니노벨)’의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/ide-extension)

---

[naninovel 스크립트](https://subculturegamer.com/%eb%82%98%eb%8b%88%eb%85%b8%eb%b2%a8-naninovel-scripts/)를 작성할 때 구문 강조, 오류 검사, 자동 완성 및 대화형 문서와 같은 IDE 기능은 생산성을 크게 높일 수 있습니다. 나니노벨은 NaniScript 구문에 대한 필수 IDE 지원을 제공하면서도 무료인 오픈소스 [Visual Studio Code](https://code.visualstudio.com/)(Windows, MacOS 및 Linux에서 사용 가능) IDE의 애드온을 제공합니다.

[<https://naninovel.com/imgit/fetched/i.gyazo.com-c07e4a512dec21b2dfdf582e73cc3b10.mp4>](https://naninovel.com/imgit/fetched/i.gyazo.com-c07e4a512dec21b2dfdf582e73cc3b10.mp4?_=1)

---

## 설치

### 유니티

1. Unity의 패키지 관리자를 통해 Newtonsoft Json 설치
2. Unity의 나니노벨 Configuration에서 Engine 탭 Bridging 옵션의 *Enable Bridging* 활성화

> **메모**
>
> Newtonsoft Json 패키지는 브리징 통신 메시지 직렬화를 위해 편집기에서만 사용되며 Naninovel의 런타임 어셈블리에서는 참조되지 않습니다. 패키지는 빌드에 포함되지 않으며 호환성이나 빌드 크기에 영향을 주지 않습니다.

### VS Code

1. VS Code에서 보기(View) – 확장(Extensions) 메뉴로 extensions 창 열기
2. Naninovel을 검색하고 Install을 버튼을 눌러 설치
3. ‘.nani’ 확장자 파일이 열리면, 애드온이 자동으로 실행됨

> **메모**
>
> VS Code 레지스트리 확장은 현재 안정적인 Naninovel 릴리스와 호환됩니다. 레거시(지원되지 않는) Naninovel 버전을 사용하는 경우 VS Code에서 자동 업데이트를 비활성화하고 관련 레거시 버전의 애드온을 설치하십시오. 나니노벨 엔진 프리뷰 릴리즈(베타)를 사용하는 경우 Discord 서버의 #download 채널을 통해 관련 미리보기 확장 프로그램을 다운로드하세요.

---

## 맞춤법 검사

naninovel 스크립트에서 맞춤법 검사를 활성화하려면 맞춤법 검사기 확장 프로그램을 설치하세요.

[Code Spell Check](https://marketplace.visualstudio.com/items?itemName=streetsidesoftware.code-spell-checker) 및 *naniscript* 언어 검사를 켜십시오. Code Spell Check extension에 대해 naniscript 언어를 활성화하는 방법에 대한 예는 아래 설정 섹션을 참고하세요.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-ide-extension-3.avif)

---

## VS Code 설정

다음은 Unity에서 자동 생성되는 메타 파일을 무시하고 의미론적 구문 강조, 단어 줄 바꿈 및 맞춤법 검사(Code Spell Check extension이 활성화되었다는 전제 하에)를 활성화하고 단어 기반 제안을 비활성화하기 위한 VS Code의 권장 설정입니다. (일반 텍스트 줄을 입력할 때 계속 팝업이 표시되지 않도록 합니다.)

```
{
    "files.exclude": {
        "**/*.meta": true
    },
    "editor.wordWrap": "on",
    "editor.wordBasedSuggestions": "off",
    "editor.occurrencesHighlight": "off",
    "editor.suggest.showWords": false,
    "editor.bracketPairColorization.enabled": false,
    "editor.semanticTokenColorCustomizations": {
        "enabled": true,
        "rules": {
            "CommentLine": { "foreground": "#5d6470", "italic": true },
            "CommentText": { "foreground": "#5d6470", "italic": true },
            "LabelLine": "#9bc37c",
            "LabelText": "#9bc37c",
            "CommandLine": "#6cb2ed",
            "InlinedCommand": "#6cb2ed",
            "Command": "#6cb2ed",
            "CommandIdentifier": "#6cb2ed",
            "Parameter": "#cd9769",
            "ParameterIdentifier": "#cd9769",
            "ParameterValue": "#e2be7f",
            "GenericTextLine": "#acb2be",
            "GenericTextPrefix": "#e2be7f",
            "GenericTextAuthor": "#e2be7f",
            "GenericTextAuthorAppearance": "#e2be7f",
            "Expression": "#62b8c1",
            "TextIdentifier": "#5d6470",
            "Error": "#d14e4e"
        }
    },
    "cSpell.enableFiletypes": [
        "naniscript"
    ]
}
```

VS Code에서 *파일(File) -> 기본 설정(Preference) -> 설정(Settings)* 메뉴로 진입할 수 있습니다. 여기에서 창 우측 상단의 ‘설정 열기(JSON)’ 버튼을 클릭하여 설정 JSON 파일에 접근할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-ide-extension-2.avif)

모든 프로젝트에 대한 설정을 편집하려면 ‘User’ 탭을 선택하고, naninovel 스크립트가 있는 현재 프로젝트에만 영향을 미치려면 ‘Workspace’을 선택하세요. 적절하다 생각하는 대로 설정을 자유롭게 커스터마이징하세요.

---

## IDE 메타데이터

프로젝트 메타데이터(액터, 스크립트, 커스텀 명령어 등)는 *NaninovelData/Metadata.json* 파일로 저장됩니다. Unity 에디터가 시작되면 자동으로 생성됩니다.

프로젝트가 열려 있는 동안 메타데이터를 업데이트하려면 *Naninovel -> Update Metadata* 에디터 메뉴나 *Ctrl + Shift + U* 단축키를 사용하세요.

메타데이터는 업데이트될 때마다 IDE와 자동으로 동기화됩니다. IDE 및 기타 관련 기능에서 자동 메타데이터 동기화를 비활성화하려면 ‘Naninovel’ 카테고리 아래의 확장 설정을 사용하세요.

설정을 변경한 후 IDE를 다시 시작하면(또는 Ctrl+Shift+P를 누르고 ‘Developer: Reload Window’ 선택) 변경 사항이 적용됩니다.

![](https://subculturegamer.com/wp-content/uploads/2024/09/나니노벨-ide-extension-1.avif)
> **메모**
>
> Generic 텍스트 라인을 입력할 때 화자 ID를 지정할지 아니면 대사를 입력할지 추정이 불가능하므로 화자 ID 자동 완성은 자동으로 실행되지 않습니다. 수동으로 자동 완성을 실행하려면 단축키(기본적으로 Ctrl+Space)를 사용하십시오.

---

## 비디오 튜토리얼

다음은 VS Code extension을 설치, 구성 및 사용법에 관한 비디오 레퍼런스입니다.

---

## 메타데이터 제공자

생성된 메타데이터에 추가 커스텀 값을 채우려면 IMetadataProvider 인터페이스를 구현해야 합니다.

구현 클래스들은 매개변수가 없는 생성자를 가져야 합니다. 이는 IDE 확장과 동기화되는 등 프로젝트 메타데이터가 생성될 때마다 인스턴스화되어 사용됩니다. 각 구현 결과는 서로 병합되며, 이를 통해 특정 메타데이터를 생성하는 여러 제공자를 가질 수 있습니다.

다음은 내장 메타데이터 제공자가 자동 완성에 사용할 스크립트 레이블 상수를 생성하는 예입니다.

```
public class LabelMetadataProvider : IMetadataProvider
{
    public Project GetMetadata (MetadataOptions options)
    {
        var scripts = LoadScripts();
        var constants = scripts.Select(CreateLabelConstant);
        return new Project { Constants = constants.ToArray() };
    }

    private Script[] LoadScripts ()
    {
        return EditorResources.LoadOrDefault()
            .GetAllRecords(ScriptsConfiguration.DefaultPathPrefix)
            .Select(kv => AssetDatabase.GUIDToAssetPath(kv.Value))
            .Where(path => !string.IsNullOrEmpty(path))
            .Select(AssetDatabase.LoadAssetAtPath<Script>)
            .ToArray();
    }

    private Constant CreateLabelConstant (Script script)
    {
        var name = $"Labels/{script.Name}";
        var values = script.Lines
            .OfType<LabelScriptLine>()
            .Where(l => !string.IsNullOrWhiteSpace(l.LabelText))
            .Select(l => l.LabelText.Trim());
        return new Constant { Name = name, Values = values.ToArray() };
    }
}
```

---

## IDE 속성

Naninovel은 다양한 [C# 속성](https://docs.microsoft.com/en-us/dotnet/csharp/programming-guide/concepts/attributes)을 가져, IDE 관련 커스텀 명령어 기능을 제공합니다. 예를 들어, 마우스를 올렸을 때(호버) 팝업 텍스트가 출력되게 하는 커스텀 명령어나 매개변수를 추가하려면 명령 유형 및 매개변수 필드에 *Documentation* 속성을 각각 적용합니다.

```
[Documentation("Summary of the custom command.")]
public class CustomCommand : Command
{
    [Documentation("Summary of the custom parameter.")]
    public StringParameter CustomParameter;
}
```

내장 함수, 커스텀 표현식 함수와 커스텀 정의 변수를 모두 사용하여 매개변수를 자동 완성하려면 *ExpressionContext* 속성을 사용하세요.

```
[ExpressionContext]  
public StringParameter Expression;
```

자동 완성 기능을 [enum 타입](https://docs.microsoft.com/en-us/dotnet/csharp/language-reference/builtin-types/enum) 값으로 단독 사용하려면 *ConstantContext* 속성을 사용하세요.

```
[ConstantContext(typeof(PlatformID))]
public StringParameter Platform;
```

내비게이션 엔드포인트(스크립트 이름과 레이블)의 사용법과 정확성을 자동 완성하고 분석하려면 *EndpointContext* 특성을 사용합니다.

```
[EndpointContext]  
public NamedStringParameter Goto;
```

리소스명을 자동 완성하려면 *ResourceContext*를 사용하고 리소스 경로의 접두사를 제공하세요. 아래는 오디오 리소스로 구성하는 예시입니다.

```
[ResourceContext(AudioConfiguration.DefaultAudioPathPrefix)]  
public StringParameter Audio;
```

모든 유형의 액터 ID에서 자동 완성을 사용하려면 *ActorContext* 속성을 사용하세요.

```
[ActorContext]  
public StringParameter ActorId;
```

특정 유형의 액터 ID로 자동 완성하려면 행위자 리소스의 경로 접두사를 지정하는 첫 번째 인수와 함께 *ActorContext* 속성을 사용하세요. 아래는 출력기 ID를 활용한 예시입니다.

```
[ActorContext(TextPrintersConfiguration.DefaultPathPrefix)]  
public StringParameter PrinterId;
```

현재 명령의 동일한 이름이나 다른 매개변수에 지정된 ID를 가진 액터의 모양을 자동 완성하려면 *AppearanceContext* 속성을 사용하세요. 이를 위해서는 동일한 명령에 지정된 *ActorContext* 속성이 필요합니다.

```
[ActorContext(CharactersConfiguration.DefaultPathPrefix)]  
public StringParameter CharacterId;  
[AppearanceContext]  
public StringParameter CharacterAppearance;
```

위의 각 속성은 namedIndex 인수를 옵션으로 활용이 가능합니다. 이 인수를 사용하여 속성이 매개변수 값의 어느 부분에 속하는지 지정할 수 있습니다. 아래 예시는 named 매개변수의 name 부분에 캐릭터 ID를 자동 완성하고, 현재 입력된 캐릭터에 대한 등장 횟수로 값을 자동 완성할 수 있게 해줍니다(이것은 @char 명령의 이름 없는 매개변수와 유사합니다).

```
[ActorContext(CharactersConfiguration.DefaultPathPrefix, 0), AppearanceContext(1)]  
public NamedStringParameter IdAndAppearance;
```

매개변수 컨텍스트 속성은 부모 클래스에서 선언된 필드에 대한 컨텍스트를 지정하거나 재정의할 수 있도록 필드 대신 클래스에 적용할 수 있습니다. 예를 들어, *Id* 매개변수가 추상 클래스인 *ModifyActor* 명령에서 선언되었지만, 컨텍스트는 상속받은 *ModifyBackground* 클래스에 적용됩니다.

```
[ActorContext(BackgroundsConfiguration.DefaultPathPrefix, paramId: "Id")]  
public class ModifyBackground : ModifyActor { }
```

내장된 명령어에서 커스텀 명령어를 상속할 때 동일한 방법을 재사용할 수 있습니다. 필드 대신 클래스에 매개변수 컨텍스트 속성을 적용할 때는 *paramId* 인수를 옵션으로 부여하세요.

---

## 상수 표현식

*ConstantContext* IDE 속성을 사용하는 경우 enum 대신 IDE에서 평가할 표현식을 지정하여 명령 매개변수 값이나 현재 검사된 스크립트와 같은 기타 변수를 기반으로 상수 이름을 생성할 수 있습니다.

**표현식 구문:**

- 평가된 부분은 중괄호({})로 묶어야 합니다.
- 현재 검사된 스크립트 이름을 참조하려면 $Script를 사용하세요.
- 매개변수 값을 참조하려면 : 뒤에 매개변수 ID(별칭이 아닌 C#에 지정된 필드 이름)를 사용하세요.
- 명명된 값을 지정하려면 매개변수 참조 뒤에 [0] 또는 [1]을 사용합니다(이름은 0, 인덱스는 1).
- 값이 지정되지 않은 경우 폴백을 위해 매개변수 참조 뒤에 Null 병합(??)을 사용합니다.
- 여러 상수의 값을 병합하려면 연결 연산자(+)를 사용하세요.

예를 들어, 내장된 [@goto] 명령어의 Path 매개변수에 할당된 표현식은 아래와 같습니다.

```
[ConstantContext("Labels/{:Path[0]??$Script}", 1)]  
public NamedStringParameter Path;
```

매개변수의 이름 구성 요소가 foo로 할당되면 Labels/foo로 평가됩니다. 또는, 검사된 스크립트 이름이 bar인 경우 Labels/bar로 평가됩니다.

아래는 @char 명령어에 적용된 캐릭터 포즈의 또 다른 예입니다.

```
[ConstantContext("Poses/Characters/{:Id??:IdAndAppearance[0]}+Poses/Characters/*", paramId: nameof(Pose))]  
public class ModifyCharacter { … }
```

‘ID’ 매개변수 또는 (할당되지 않은 경우) ‘IdAndAppearance’ 매개변수의 이름 구성 요소에 ID가 할당된 캐릭터의 포즈와 공유 캐릭터 포즈를 병합합니다.

[커스텀 메타데이터 제공자](https://naninovel.com/guide/ide-extension#metadata-providers)와 결합된 상수 표현식을 사용하면 IDE 확장에 대한 임의의 자동 완성 시나리오를 만들 수 있습니다.

---

## 기타 IDE 및 편집기

다른 편집자를 위한 확장 기능은 유지하지 않지만 Naninovel용 오픈 소스 언어 서버가 있습니다: [github.com/naninovel/language](https://github.com/naninovel/language).

C#으로 작성되었지만 JavaScript 바인딩이 있으며 대부분의 최신 IDE에서 사용할 수 있습니다. 구현에는 구문 강조, 자동 완성, 오류 검사 등이 포함됩니다. VS Code 확장(언어 서버를 기반으로 구축됨)도 오픈 소스입니다: [github.com/naninovel/vscode](https://github.com/naninovel/vscode).

또는 TextMate 문법 지원 기능이 있는 편집기(예: [Sublime](https://www.sublimetext.com/) 또는 [Visual Studio](https://visualstudio.microsoft.com/))를 사용하는 경우 [textmate.json](https://github.com/naninovel/docs/blob/main/docs/.vitepress/ext/lang/textmate.json) ↗가 준비되어 있습니다.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)