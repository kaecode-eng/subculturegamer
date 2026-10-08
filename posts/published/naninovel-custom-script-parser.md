---
title: "나니노벨 Custom Script Parser"
url: https://subculturegamer.com/naninovel-custom-script-parser/
published: 2025-01-30
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

※원문 페이지: [(링크)](https://naninovel.com/guide/custom-parser)

※마지막 수정일: 2025/1/30

---

스크립트 파싱은 (.nani 파일을 포함하는) 대상 스크립트 텍스트를 데이터 구조로 변환해, 게임 플로우를 조작하는 데 쓰이는 프로세스입니다.

예를 들어, ‘@hide Kohaku’라는 나니노벨 스크립트 파일의 텍스트 라인을 파서는 “Kohaku”라는 이름의 액터 Id 파라미터에 적용되는 HideActor 명령어로 변환시킵니다.

커스텀 스크립트 파서를 구현해 파싱 방식을 조정하거나 완전히 변경할 수 있습니다. 다른 커스텀 정의 구현과 마찬가지로, IscriptParser를 구현하는 새로운 C# 클래스를 만들어 간단히 추가 가능합니다.

스크립트 파서는 Scripts 구성 메뉴에서 Script Parser 프로퍼티에서 선택할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-script-parser.avif)
> **메모**
>
> 스크립트 파서를 다른 것으로 전환한 다음에는 변경 사항 적용을 위해 스크립트 에셋이 포함된 폴더를 마우스 오른쪽으로 클릭해 *Reimport*해야합니다.

아래는 대상 스크립트에서 “…” 문구를 발견할 때마다 ‘wait’ 명령어를 삽입하는 커스텀 파서의 예시입니다.

```
public class CustomParser : ScriptAssetParser
{
    public override Script ParseText (string scriptPath, string scriptText,
        ParseOptions options = default)
    {
        scriptText = scriptText.Replace("...", "...[wait 1]");
        return base.ParseText(scriptPath, scriptText, options);
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-24.png)

해당하는 파서가 선택되고 게임에서 “…”이 출력되면 스크립트 텍스트에 명시적으로 할당되지 않았더라도 1초의 지연(wait) 명령어가 자동 추가됩니다. 이 단순 구현은 오직 예시 목적입니다. 실제 프로젝트에서는 제너릭 텍스트 서브 파서를 수정하여 출력된 텍스트에만 영향을 미치게 하거나 REGEX를 사용하여보다 정확한 일치를 원하게 될 것입니다.

iScriptParser 인터페이스를 처음부터 구현하는 대신 위의 예제에 있는 파서는 빌트인 파서로부터 상속받아서 그것의 메소드 중 하나를 재정의하고 있습니다.

이처럼 내장된 파서를 가져와 하나씩 수정하는 방식으로 명령어와 제너릭 텍스트 라인, 레이블, 주석 등을 추가 조정하는 것도 가능합니다.

예를 들어, 커스텀 제너릭 텍스트 라인의 서브 파서를 아래와 같이 재정의하는 것도 가능합니다.

```
using Naninovel;

public class CustomParser : ScriptAssetParser
{
    protected override GenericTextLineParser GenericTextLineParser { get; }
        = new CustomGenericLineParser();
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-25.png)

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)