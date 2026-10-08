---
title: "나니노벨 Custom Actor Implementations"
url: https://subculturegamer.com/naninovel-custom-actor-implementations/
published: 2025-01-19
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

※원문 페이지: [(링크)](https://naninovel.com/guide/custom-actor-implementations)

※마지막 수정일: 2025/1/19

---

액터는 이름, 모양, 가시성 및 변환(위치, 회전, 스케일) 등으로 정의되는 씬 독립체(엔터티)입니다. 이러한 액터는 시간 경과에 따라 비동기식으로 모양, 가시성 및 변형을 일으킬 수 있습니다.

액터의 예로는 캐릭터, 배경, 텍스트 출력기 및 선택지 처리기가 있습니다.

액터는 IActor 인터페이스와 그로부터 파생된 개체가 대표적입니다.

```
ICharacterActor
IBackgroundActor
ITextPrinterActor
IChoiceHandlerActor
```

각 액터 인터페이스는 여러 구현 요소를 가질 수 있습니다.

현재 버전 기준, 캐릭터 액터는 스프라이트, 분절된 스프라이트, 제네릭, 레이어드, 내레이터, Spine 및 Live2D 등 7가지 빌트인 구현 요소를 갖고 있습니다.

액터 구현은 *Naninovel -> Configuration* 컨텍스트 메뉴에서 액세스할 수 있는 구성 관리자에서 설정할 수 있습니다. 기본 구현 요소를 활용해 액터를 구성해도 되지만, 만약 원한다면 각 액터마다 커스텀 구성을 적용할 수 있습니다. 구성을 변경하기 위해서는 *Default Metadata* 프로퍼티를 사용하고 Implementation의 드롭다운 리스트에서 액터 설정을 변경시킬 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-actor-implementations-1.avif)![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-actor-implementations-2.avif)

구현 드롭다운 리스트는 특정 액터 인터페이스 구현에 필요한 모든 유형을 포함합니다.

커스텀 구현을 추가할 수도 있고, 이는 리스트에 표시됩니다. 커스텀 액터 구현이 필요하다면 *Naninovel/Runtime/Actor* 스크립트를 참고하세요.

액터가 씬에 생성되어야하는 경우 기본적인 인터페이스 요구사항을 충족하려면 *MonoBehaviourActor* 빌트인 추상 액터 구현을 사용하세요.

커스텀 액터 구현을 생성할 때 호환되는 공개 생성자가 있는지 확인하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-5.png)

```
public ActorImplementationType (string id, ActorMetadata metadata) { }
```

여기서 id는 액터와 메타데이터(액터(액터 레코드가 리소스에 있는 경우) 또는 기본 메타데이터)의 id입니다.

특정 액터 인터페이스를 구현할 때 해당 특정 메타데이터(예: ‘ICharacterActor’ 구현의 경우 ‘CharacterMetadata’)를 요청할 수 있습니다.

> **예시**
>
> 모든 빌트인 액터 구현은 동일한 액터 API 위에 작성되므로 직접 추가할 때 이를 참조로 사용할 수 있습니다. Naninovel 패키지의 *Runtime/Actor* 디렉터리에서 소스를 찾으세요.

---

## 액터 리소스

구현 유형에 ActorResources 속성을 적용하여 커스텀 액터의 리소스로 사용할 수 있는 에셋과 에디터 메뉴에서 여러 리소스를 할당할 수 있는지 여부를 지정합니다. 여러 리소스가 허용되지 않는 경우(디폴트) 액터 ID만 지정하여 사용 가능한 단일 리소스를 로드할 수 있습니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-6.png)

```
var resource = await resourceLoader.Load(actorId);
```

여러 리소스가 허용되는 경우 전체 경로를 지정하세요. 예를 들어 ‘CubeBackground’ 이름을 가진 리소스를 할당한 경우 이 리소스를 불러오려면 아래와 같이 사용하세요.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-actor-implementations-3.avif)![](https://subculturegamer.com/wp-content/uploads/2025/01/image-7.png)

```
var resource = await resourceLoader.Load($"{actorId}/CubeBackground");
```

---

## 커스텀 메타데이터

(빌트인 및 커스텀 구현 모두 해당) 액터 메타데이터에 커스텀 데이터를 추가할 수 있습니다.

커스텀 데이터를 삽입하려면 새 C# 클래스를 생성하고 이를 CustomMetadata<TActor> 타입에서 상속합니다. 여기서 *TActor*는 데이터와 연결되어야 하는 액터 구현 타입입니다.

이하는 ‘CustomCharacterImplementation’ 구현 시 캐릭터에 커스텀 데이터를 추가하는 예입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-8.png)

```
using Naninovel;
using UnityEngine;

public class MyCharacterData : CustomMetadata<CustomCharacterImplementation>
{
    public int MyCustomInt;
    [Range(0f, 100f), Tooltip("Tooltip for my custom range.")]
    public float MyCustomRange = 50f;
    [ColorUsage(false, true)]
    public Color MyCustomColor = Color.white;
}
```

연관된 구현이 있는 액터가 선택되면, 생성된 커스텀 데이터 클래스의 직렬화 가능 필드가 나니노벨 에디터 메뉴에 자동으로 노출됩니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-actor-implementations-4.avif)

런타임 시 커스텀 데이터에 액세스하려면 ActorMetadata 인스턴스의 GetCustomData<TData>() 메서드를 사용하세요. 여기서 TData는 커스텀 데이터 클래스의 타입입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-9.png)

```
var charsConfig = Engine.GetConfiguration<CharactersConfiguration>();
var myCharMeta = charsConfig.GetMetadataOrDefault("CharId");
var myCharData = myCharMeta.GetCustomData<MyCharacterData>();
Debug.Log(myCharData.MyCustomInt);
```

### 커스텀 메타데이터 에디터

프로퍼티 드로어([Property Drawers](https://docs.unity3d.com/Manual/editor-PropertyDrawers.html))로 커스텀 메타데이터 에디터를 커스터마이징할 수 있습니다. 다음은 편집된 필드 위에 추가 레이블을 삽입하는 프로퍼티 드로어를 추가하는 예시입니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-10-708x1024.png)

```
// 직렬화된 필드에 적용할 속성을 만듭니다.;
// `PropertyAttribute`에서 상속받도록 합니다.
public class ExtraLabelAttribute : PropertyAttribute
{
    public readonly string LabelText;

    public ExtraLabelAttribute (string labelText)
    {
        LabelText = labelText;
    }
}

// 영향을 받는 필드를 그릴 때 사용할 커스텀 에디터를 만듭니다.
// 스크립트는 'UnityEditor' API를 사용하므로 'Editor' 폴더 안에 있어야 합니다.
[CustomPropertyDrawer(typeof(ExtraLabelAttribute))]
public class ExtraLabelPropertyDrawer : PropertyDrawer
{
    public override void OnGUI (Rect rect, SerializedProperty prop, GUIContent label)
    {
        var extraLabelAttribute = attribute as ExtraLabelAttribute;

        rect.height = EditorGUIUtility.singleLineHeight;
        EditorGUI.LabelField(rect, extraLabelAttribute.LabelText);

        rect.y += EditorGUIUtility.singleLineHeight +
                  EditorGUIUtility.standardVerticalSpacing;
        EditorGUI.PropertyField(rect, prop);
    }

    public override float GetPropertyHeight (SerializedProperty prop, GUIContent label)
    {
        return EditorGUIUtility.singleLineHeight * 2 +
               EditorGUIUtility.standardVerticalSpacing;
    }
}

// 이제 속성을 사용하여 직렬화된 필드에 추가 레이블을 적용할 수 있습니다.
public class MyCharacterData : CustomMetadata<CustomCharacterImplementation>
{
    [ExtraLabel("Text from my custom property drawer")]
    public string MyCustomProperty;
}
```

위의 구현 결과, 이제 커스텀 캐릭터 데이터가 다음과 같이 표시됩니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-actor-implementations-5.avif)
> **팁**
>
> 빌트인 구성 에디터를 전체적으로 재정의하는 것도 가능합니다. 자세한 내용과 예시는 [커스텀 구성 가이드](https://naninovel.com/guide/custom-configuration#overriding-built-in-editors)를 참조하세요.

---

## 커스텀 상태

커스텀 액터의 상태 유형을 재정의하거나 확장하려면, 상태가 직렬화되어 관리되는 액터에 적용되므로 [액터 관리자도 재정의](https://naninovel.com/guide/engine-services#overriding-built-in-services)해야 합니다.

> **메모**
>
> 이는 내장 IActor 인터페이스로부터 파생된 개체(캐릭터, 배경, 텍스트 출력기 및 선택지 처리기) 중 하나의 커스텀 액터 구현에 적용됩니다. IActor에서 직접 커스텀 액터를 상속한 경우 커스텀 상태를 사용하기 위해 빌트인 매니저를 재정의할 필요는 없습니다. 직접 만들기만 하면 됩니다.
>
> 다른 시스템(예: Naninovel 외부의 다양한 게임 메커니즘을 위한 UI, 게임 오브젝트 또는 컴포넌트)에 대한 커스텀 상태를 추가하려는 경우 [상태 관리 가이드](https://naninovel.com/guide/state-management#custom-state)를 참조하세요.

다음은 마지막으로 추가된 선택의 시간을 저장하는 LastChoiceTime 필드를 추가하여 선택지 처리기 상태를 확장하는 예입니다. 커스텀 선택지 처리기가 표시되면 시간이 콘솔에 인쇄됩니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-11.png)![](https://subculturegamer.com/wp-content/uploads/2025/01/image-12-625x1024.png)

```
// 마지막 선택 시간을 직렬화하는 확장된 상태입니다.
public class MyChoiceHandlerState : ChoiceHandlerState
{
    // 이 필드는 직렬화 가능하며 게임 저장 로드를 통해 지속됩니다.
    public string LastChoiceTime;

    // 이 메서드는 게임을 저장할 때 호출됩니다. 필요한 데이터를 얻습니다
    // 액터로부터 직렬화 가능한 필드에 저장합니다.
    public override void OverwriteFromActor (IChoiceHandlerActor actor)
    {
        base.OverwriteFromActor(actor);
        if (actor is MyCustomChoiceHandler myCustomChoiceHandler)
            LastChoiceTime = myCustomChoiceHandler.LastChoiceTime;
    }

    // 이 메서드는 게임을 로드할 때 호출됩니다.
    // 직렬화된 데이터를 다시 가져와 액터에 적용합니다.
    public override void ApplyToActor (IChoiceHandlerActor actor)
    {
        base.ApplyToActor(actor);
        if (actor is MyCustomChoiceHandler myCustomChoiceHandler)
            myCustomChoiceHandler.LastChoiceTime = LastChoiceTime;
    }
}

// 마지막 선택 시간을 사용하는 커스텀 선택지 처리기 구현입니다.
public class MyCustomChoiceHandler : UIChoiceHandler
{
    public string LastChoiceTime { get; set; }

    public MyCustomChoiceHandler (string id, ChoiceHandlerMetadata metadata)
        : base(id, metadata) { }

    public override void AddChoice (ChoiceState choice)
    {
        base.AddChoice(choice);
        LastChoiceTime = DateTime.Now.ToShortTimeString();
    }

    public override UniTask ChangeVisibility (bool visible, float duration,
        EasingType easingType = default, AsyncToken token = default)
    {
        Debug.Log($"Last choice time: {LastChoiceTime}");
        return base.ChangeVisibility(visible, duration, easingType, token);
    }
}

// 확장된 상태를 사용하도록 내장된 선택지 처리기 매니저를 재정의합니다.
// 중요한 단계는 제너릭 타입에 'MyChoiceHandlerState'를 지정하는 것입니다.
// 다른 수정 사항은 단지 인터페이스 요구 사항을 충족하기 위한 것입니다.
[InitializeAtRuntime(@override: typeof(ChoiceHandlerManager))]
public class MyChoiceHandlerManager : ActorManager<IChoiceHandlerActor,
    MyChoiceHandlerState, ChoiceHandlerMetadata,
    ChoiceHandlersConfiguration>, IChoiceHandlerManager
{
    public MyChoiceHandlerManager (ChoiceHandlersConfiguration config)
        : base(config) { }

    public UniTask<IChoiceHandlerActor> AddActor (string actorId,
        ChoiceHandlerState state)
    {
        return base.AddActor(actorId, state as MyChoiceHandlerState);
    }

    ChoiceHandlerState IActorManager<IChoiceHandlerActor,
        ChoiceHandlerState, ChoiceHandlerMetadata,
        ChoiceHandlersConfiguration>.GetActorState (string actorId)
    {
        return base.GetActorState(actorId);
    }
}
```

이제 커스텀 선택지 처리기는 마지막 선택이 저장 슬롯에서 로드된 이전 게임 세션에 추가된 경우에도 마지막으로 추가된 선택 시간을 유지하고 콘솔에 기록합니다.

이런 방식으로 빌트인 액터 상태 외에 원하는 만큼의 커스텀 데이터를 저장할 수 있습니다. 지원되는 직렬화 가능 데이터 유형은 [Unity의 직렬화 가이드](https://docs.unity3d.com/Manual/script-Serialization.html)를 참조하세요.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)