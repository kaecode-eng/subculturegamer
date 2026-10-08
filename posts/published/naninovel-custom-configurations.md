---
title: "나니노벨 Custom Configurations"
url: https://subculturegamer.com/naninovel-custom-configurations/
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

※원문 페이지: [(링크)](https://naninovel.com/guide/custom-configuration)

※마지막 수정일: 2025/1/30

---

구성 객체(Configuration Objects)는 엔진 서비스와 기타 엔진 시스템 초기화와 구성에 쓰입니다.

기본적으로 구성 객체는 [스크립트 가능한 객체](https://docs.unity3d.com/Manual/class-ScriptableObject.html)(Scriptable Object) 에셋으로 직렬화되고 *NaninovelData/Resources/Naninovel/Configuration* 프로젝트 경로에 저장됩니다. Unity 에디터에서 해당 구성 메뉴를 열 때(*Naninovel -Configuration*) 에셋이 자동으로 생성됩니다.

C#으로 구성 객체에 액세스하려면 *Engine.getConfigurationt<T>()* 정적 메소드를 사용하세요. 여기서 *T*는 액세스하려는 구성 객체 타입입니다.

다음 예제는 오디오 구성 객체에 액세스하는 방법입니다.

```
var audioConfig = Engine.GetConfiguration<AudioConfiguration>();
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-14.png)
> **메모**
>
> 엔진 초기화 절차는 비동기식이므로 자동 초기화가 활성화 되더라도 Unity에서 씬을 불러온 직후 엔진 API (예 : *GetConfiguration* 메서드)를 사용할 수 없을 수 있습니다 (Awake, Start, OnEnable Monobehaviour 메서드 등). 자세한 내용은 [엔진 API 액세스](https://naninovel.com/guide/integration-options#accessing-engine-api) 가이드를 참조하십시오.

*Engine.getConfiguration* 메서드는 엔진이 초기화 될 때만 사용 가능하나, 구성 공급자 개체를 필요로 합니다.

구성 공급자 개체는 엔진을 초기화할 때 정의되는데, 런타임 시 커스텀 서빙 시나리오를 가능케 합니다.

이로써 엔진에서 ProjectConfigurationProvider로 초기화되지 않았더라도 디폴트 공급자에 의해 구성 에셋에 접근할 수 있습니다. 예를 들어,

```
var config = ProjectConfigurationProvider.LoadOrDefault<AudioConfiguration>();
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-15.png)

구성 프로퍼티는 에디터 메뉴를 통해서 변경되도록 되어 있으나, 런타임 시 수정하는 것도 가능합니다. 디폴트 프로젝트 제공자에게 반환된 개체는 프로젝트에 실제 저장되는 에셋입니다. 이를 수정하게 되면 변경점들은 플레이 모드 세선에서 지속됩니다. 이는 `Engine.GetConfiguration` 메서드에 의해 제공되는 구성 개체와 달리, 원본 에셋을 변형하지 않고 인스턴스적으로 동작합니다.

아래는 엔진이 초기화 된 직후 카메라 구성 객체의 *ReferenceResolution* 프로퍼티를 변경하는 예시입니다.

```
using Naninovel;
using UnityEngine;

public static class ModifyConfigAtRuntime
{
    [RuntimeInitializeOnLoadMethod]
    private static void ModifyConfig ()
    {
        if (Engine.Initialized) OnInitializationFinished();
        else Engine.OnInitializationFinished += OnInitializationFinished;

        void OnInitializationFinished ()
        {
            Engine.OnInitializationFinished -= OnInitializationFinished;

            var cameraConfig = Engine.GetConfiguration<CameraConfiguration>();
            cameraConfig.ReferenceResolution = new Vector2Int(3840, 2160);
        }
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-16.png)
> **메모**
>
> 나니노벨 엔진이 초기화되는 동안, 구성이 변경 될 것으로 예측하고 동작하지 않습니다. 일부 변경점을 적용하기 위해서는 *ProjectConfigurationProvider* 또는 커스텀 제공자가 엔진을 초기화하기 전에 수정사항을 적용해야 할 수도 있습니다.

---

## 구성 추가

새 커스텀 구성을 추가하려면 C# 클래스를 만들어 Configuration에서 상속받게 하세요.

```
[EditInProjectSettings]
public class MyCustomConfiguration : Configuration
{
    [Header("My Custom Header 1")]
    [Tooltip("Tooltip for my custom string.")]
    public string MyCustomString = "Default value";
    [Range(0, 100), Tooltip("Tooltip for my custom float.")]
    public float MyCustomFloat = 10;

    [Header("My Custom Header 2")]
    public int[] MyCustomArray;
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-17.png)

*EditinProjectsettings* 속성에 유의하세요. 속성 적용 시 관련 에디터 메뉴가 프로젝트 설정에 자동으로 추가됩니다.

여기서 모든 빌트인 메뉴와 마찬가지로 커스텀 구성 에셋의 직렬화 가능 프로퍼티 수정이 가능합니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-configurations-3.avif)

C#에서 커스텀 구성에 접근하려면 빌트인 에셋과 동일한 API를 사용하세요.

```
var myConfig = Engine.GetConfiguration<MyCustomConfiguration>();
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-18.png)
> **예시**
>
> 인벤토리 시스템을 설정하기 위해 커스텀 구성 메뉴를 추가하는 또 다른 예는 [인벤토리 샘플](https://naninovel.com/guide/samples#inventory)에서 찾을 수 있습니다. 특히 커스텀 구성은 Scripts/Runtime/Inventory/InventoryConfiguration.cs에서 구현됩니다.

나니노벨 프로젝트 설정으로부터 커스텀 구성 에디터 동작을 커스터마이징하려면 에디터 스크립트 아래에 클래스를 작성하고 ConfigurationSettings<T>에서 상속받도록 합니다. 이때 T는 커스텀 구성의 타입입니다.

자체 에디터를 구축 시에는 *Naninovel/Editor/Settings* 패키지 폴더에 저장된 빌트인 설정 에디터 스크립트를 레퍼런스로 활용할 수 있습니다.

---

## 빌트인 에디터 재구성하기

나니노벨 프로젝트 세팅 메뉴에서의 빌트인 구성 에디터를 재구성할 수 있습니다.

OverrideSettings 속성이 ConfigurationSettings<T>(또는 그 파생)으로부터 에디터 클래스를 상속받게 하면 됩니다. 이때 T는 구성의 타입에 해당합니다.

이때 커스텀 에디터 스크립트가 “Editor” 폴더 내에 위치하게 하여 에디터 어셈블리에 포함될 수 있게 해야 합니다.

이하는 빌트인 캐릭터 매니저 구성 에디터를 재구성하는 예시입니다. 새 에디터는 내장된 에디터로부터 상속받는데, Shared Poses 필드 이하에 Shared Poses의 총합 레이블을 표시합니다.

```
[OverrideSettings]
public class CustomCharacterSettings : CharactersSettings
{
    protected override Dictionary<string, Action<SerializedProperty>>
        OverrideConfigurationDrawers ()
    {
        var drawers = base.OverrideConfigurationDrawers();
        drawers[nameof(CharactersConfiguration.SharedPoses)] = property => {
            ActorPosesEditor.Draw(property);
            EditorGUILayout.LabelField(
                $"Number of shared poses is {property.arraySize}.");
        };
        return drawers;
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-19.png)

위의 에디터에 의하면, 캐릭터 구성은 아래와 같이 표시됩니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-configurations-2.avif)

빌트인 액터 메타 데이터 에디터를 무시할 수도 있습니다.

이하는 Message Color 필드의 아래에 조사된 액터의 컬러명과 함께 표시하는 레이블을 삽입합니다.

```
[OverrideSettings]
public class CustomCharacterSettings : CharactersSettings
{
    protected override MetadataEditor<ICharacterActor,
        CharacterMetadata> MetadataEditor { get; } = new MetaEditor();

    private class MetaEditor : CharacterMetadataEditor
    {
        protected override Action<SerializedProperty>
            GetCustomDrawer (string propertyName)
        {
            if (propertyName == nameof(CharacterMetadata.MessageColor))
                return property => {
                    EditorGUILayout.PropertyField(property);
                    EditorGUILayout.LabelField($"Message color of " +
                        "'{Metadata.DisplayName}' is '{property.colorValue}'.");
                };
            return base.GetCustomDrawer(propertyName);
        }
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-20.png)

위의 스크립트는 아래와 같은 결과로 표시됩니다.

![](https://subculturegamer.com/wp-content/uploads/2025/01/나니노벨-custom-configurations.avif)

---

## 구성 제공자

런타임 시 구성 객체가 제공되는 방식을 변경할 수 있습니다. 예를 들어, 정적 프로젝트 에셋 대신 원격 호스트에 저장된 JSON 파일의 구성을 읽어올 수 있습니다.

커스텀 구성 서빙 시나리오를 지정하려면 C# 클래스를 만들어 IconFigurationProvider 인터페이스를 구현합니다. 인터페이스는 *Type* 인자를 갖고 *Configuration* 개체를 반환하는 하나의 메서드를 가집니다.

요청된 구성 객체를 구성하고 채우는 방법은 사용자에게 달려 있습니다. 반환된 객체의 유형이 요청된 객체와 동일한지 확인하기만 하면 됩니다.

아래는 디폴트 구성 객체를 반환하는 커스텀 제공자 구현의 예입니다.

```
public class CustomConfigurationProvider : IConfigurationProvider
{
    public Configuration GetConfiguration (System.Type type)
    {
        var defaultAsset = ScriptableObject.CreateInstance(type);
        return defaultAsset as Configuration;
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-21.png)

아래는 런타임 시 프로젝트 캐릭터 구성에 메타 데이터를 주입하여 재구성하는 예시입니다.

```
public class CustomConfigurationProvider : ProjectConfigurationProvider
{
    public override Configuration GetConfiguration (System.Type type)
    {
        // 캐릭터를 제외한 모든 것은 프로젝트 구성과 동일하게 반환한다.
        if (type != typeof(CharactersConfiguration))
            return base.GetConfiguration(type);

        // 캐릭터의 메타데이터를 재구성하거나 삽입한다.
        // 실 데이터는 런타임 시 외부 소스로부터 채워진다.
        var charsConfig = (CharactersConfiguration)base.GetConfiguration(type);
        charsConfig.Metadata["NewCustomChar"] = new CharacterMetadata {
            Implementation = typeof(NarratorCharacter).AssemblyQualifiedName,
            DisplayName = "Custom Narrator",
            UseCharacterColor = true,
            MessageColor = Color.cyan,
            // etc...
        };

        // 수정된 캐릭터 설정을 반환한다.
        return charsConfig;
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-22.png)

커스텀 구성 제공자가 준비되면, 커스텀 엔진 초기화 스크립트를 작성해 엔진이 내장(빌트인)된 것 대신에 커스텀 엔진을 사용하게 해야 합니다. 기본적으로 엔진은 `Naninovel/Runtime/Engine/RuntimeInitializer.cs`에 의해 초기화됩니다. 이 스크립트를 커스텀 초기화 스크립트 제작에 레퍼런스로 활용하세요.

대신, 커스텀 구성 공급자를 사용하는 것만으로도 충분하다면 기본 엔진 구성 루틴을 유지한 채 `RuntimeInitializer.Initialize(IConfigurationProvider)` 정적 메서드 사용을 고려하세요. 구성 제공자의 선택적 인수를 활용할 수 있게 도와줍니다.

```
public class CustomInitializer
{
    [RuntimeInitializeOnLoadMethod]
    private static void InitializeWithCustomProvider ()
    {
        var customProvider = new CustomConfigurationProvider();
        RuntimeInitializer.Initialize(customProvider).Forget();
    }
}
```

![](https://subculturegamer.com/wp-content/uploads/2025/01/image-23.png)

엔진을 초기화 여부와 관계없이 기본 초기화 절차를 비활성화하기 위해 엔진 구성 메뉴에서 *Initialize On Application Load* 옵션을 비활성화하세요.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## [26년 3월] 나니노벨 Custom Build Environment](https://subculturegamer.com/naninovel-custom-build-environment/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)