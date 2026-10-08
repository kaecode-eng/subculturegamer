---
title: "나니노벨 Managed Text"
url: https://subculturegamer.com/naninovel-managed-text/
published: 2024-11-10
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

※원문 페이지: [(링크)](https://naninovel.com/guide/managed-text)

---

Managed Text(관리형 텍스트) 기능을 이용하면 게임 내 UI나 캐릭터의 표시명과 같이 Naninovel 전역에서 사용되는 다양한 텍스트 요소를 각 현지화 국가에 맞춰 교체 표시할 수 있습니다.

관리형 텍스트 문서를 생성하려면 *Naninovel -> Tools -> Managed Text* 에디터 컨텍스트 메뉴를 통해 접근 가능합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/11/나니노벨-managed-text-4.avif)

‘Select’ 버튼을 이용하여 관리형 텍스트 문서를 저장할 경로(기본적으로 *Resources/Naninovel/Text*)를 선택하고 ‘Generate’ 버튼을 눌러 문서를 생성합니다.

*Create -> Naninovel -> Managed Text* 에셋 컨텍스트 메뉴를 사용하여 커스텀 관리형 텍스트 문서를 생성할 수도 있습니다.

관리형 텍스트 문서의 각 줄(라인)은 **Path: Value** 형식의 표현식으로 되어 있습니다. 여기서 Path는 텍스트 변수의 경로이고 Value는 해당 변수의 값입니다.

예를 들어, 빌트인 UI에 대한 레코드가 포함된 ‘DefaultUI’ 문서의 기본 내용은 아래와 같습니다.

![](https://subculturegamer.com/wp-content/uploads/2024/11/나니노벨-managed-text-3.avif)

이 값은 편집할 수 있으며 변경 사항은 다음 실행 시 적용됩니다.

Delete Unused 프로퍼티를 활성화하면 관리형 텍스트 문서의 레코드 중에서ManagedTextProvider 컴포넌트나 소스 코드의 ManagedText 속성을 통해 직접 참조되지 않는 레코드가 제거됩니다(자세한 내용은 아래 참조).

> **팁**
>
> 관리형 텍스트 값에 줄 바꿈을 삽입하려면 기본적으로 TMPro 텍스트에서 지원되는 br 태그를 사용하세요.

## 관리형 텍스트 제공자

*ManagedTextProvider* 컴포넌트로 스크립트를 작성하지 않고도 임의의 Unity 게임 오브젝트를 관리형 텍스트 레코드에 바인딩할 수 있습니다. 게임 오브젝트에 컴포넌트를 추가하고, 카테고리(레코드를 포함할 문서의 이름), 키(문서 내부의 레코드 이름)를 지정하고 *OnValueChanged* 이벤트를 사용하여 값을 게임 오브젝트 속성에 바인딩합니다.

다음은 ‘MyCustomText’ 키를 사용하여 ‘MyCustomDocument’ 문서에 저장된 관리되는 텍스트 레코드를 Unity의 ‘Text’ 컴포넌트에 바인딩하는 예입니다.

![](https://subculturegamer.com/wp-content/uploads/2024/11/나니노벨-managed-text-2.avif)

ManagedTextProvider 컴포넌트가 커스텀 UI, 텍스트 출력기 또는 선택지 처리기에서 사용되는 경우, 구성 메뉴에서 리소스가 할당되어 있다면 관리형 텍스트 도구를 사용할 때 해당 레코드가 자동으로 생성됩니다.

다른 경우에는 레코드를 수동으로 추가해야 합니다.

![](https://subculturegamer.com/wp-content/uploads/2024/11/나니노벨-managed-text-1.avif)

---

## 관리형 텍스트 변수

관리형 텍스트 레코드를 소스 코드의 변수와 바인딩하는 것도 가능합니다. 이를 위해 정적 문자열 필드에 *ManagedText* 속성을 추가하고 클래스를 선언합니다. 필드 값은 엔진 초기화 시 관리형 텍스트 문서에 지정된 값으로 덮어쓰여집니다.

다음은 관리형 텍스트 변수를 사용하여 C# 스크립트에서 텍스트 레이블을 로컬라이즈하는 예입니다.

```
using Naninovel;
using UnityEngine.UI;

// Inheriting from Unity's text component, so we can use it as one.
[ManagedText]
public class CustomLabel : Text
{
    // Value of the "CustomLabel.LabelText" managed text record will be assigned
    // to the below variable on engine init and updated on locale changes.
    [ManagedText("foo")] // "foo" is the document name for the record.
    public static string LabelText = "bar"; // "bar" is the default value.

    protected override void Awake ()
    {
        base.Awake();

        text = LabelText; // Assign current record value to the label.

        var l10n = Engine.GetService<ILocalizationManager>();
        // Update the label when user changes the locale at runtime.
        l10n.OnLocaleChanged += _ => text = LabelText;
    }
}
```

---

## 스크립트 텍스트

나니노벨 스크립트로부터 직접 관리형 텍스트값을 가져올 수 있습니다. 이는 편리한 기능이지만, 그 전제로 스크립트 표현식에 일부 텍스트를 사용해야 하며 해당 텍스트는 현지화 가능해야 합니다.

가령, ‘Script’라는 관리 텍스트 문서를 만들고 T\_ 또는 t\_ 접두사가 있는 키를 사용하여 레코드를 추가합니다.

이제 스크립트 표현식의 값을 참조할 수 있습니다. 예를 들어 ‘Script’ 관리형 텍스트 문서에 다음 레코드가 있는 경우:

T\_Greeting1: Hey!  
T\_Greeting2: Hello!  
T\_Greeting3: Hi!

위 레퍼런스는 아래와 같이 참조할 수 있습니다.

```
@print {Random(T_Greeting1,T_Greeting2,T_Greeting3)}
```

‘Script’ 관리형 텍스트 문서는 다른 문서와 동일한 방식으로 로컬라이즈할 수 있습니다. 사용자가 다른 로케일을 선택하면 해당 로컬라이즈된 문서에서 텍스트가 자동으로 참조됩니다.

---

## 로컬라이제이션

관리형 텍스트 로컬라이제이션 프로세스는 naninovel 스크립트의 프로세스와 유사합니다.

1. *`Resources/Naninovel/Text` folder* 에 관리형 텍스트 문서를 생성한다.
2. `Resources/Naninovel/Localization/{Locale}` 로케일 폴더에 로컬라이제이션 유틸리티를 실행한다. (여기서 {Lacale}은 현지화 할 로케일 태그에 해당)
3. 소스 관리 텍스트 문서에 대한 현지화 문서는 해당 로케일 폴더에 나타납니다. 이를 사용하여 번역을 추가하거나 편집하세요.

관리형 텍스트 문서와 해당 로컬라이즈 문서를 업데이트하려면 먼저 *Resources/Naninovel/Text* 폴더에서 관리되는 텍스트 생성 유틸리티를 실행한 다음 *Resources/Naninovel/Localization/{Locale}* 폴더에서 로컬라이제이션 유틸리티를 실행하세요.

두 유틸리티 모두 기본적으로 기존 수정 사항(관리되는 텍스트 레코드 및 해당 번역)을 보존하려고 시도하므로 업데이트할 때마다 처음부터 모든 내용을 다시 작성할 필요가 없습니다.

현지화 유틸리티 사용 방법에 대한 자세한 내용은 [로컬라이제이션 페이지](https://naninovel.com/guide/localization)를 참조하세요.

> **예시**
>
> [데모](https://github.com/naninovel/samples/tree/main/unity/demo) 및 [스프레드시트](https://github.com/naninovel/samples/tree/main/unity/spreadsheet) 샘플 프로젝트에서 지역화 설정 예(관리 텍스트 포함)를 찾을 수 있습니다. 자신의 프로젝트에서 현지화를 설정하는 데 문제가 있는 경우 참조로 사용하세요.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)