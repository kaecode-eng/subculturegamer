---
title: "[26년 3월] 나니노벨 Custom Build Environment"
url: https://subculturegamer.com/naninovel-custom-build-environment/
published: 2025-02-23
categories: []
tags: ["나니노벨"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

※이 글은 유니티 다이얼로그 시스템 에셋 ‘나니노벨’ Custom Build Environment의 한국어 번역 페이지입니다.

※모든 내용의 저작권 및 내용의 책임과 권한은 Naninovel에 있습니다.

※원문 페이지: [(링크)](https://naninovel.com/guide/custom-build-environment)

※마지막 수정일: 2026/5/10

---

## Custom Build Environment

에디터의 [빌드 메뉴](https://docs.unity3d.com/Manual/BuildSettings.html)를 사용하여 프로젝트를 구축할 때 나니노벨은 추가적으로 전처리 및 후처리 절차를 자동으로 실행합니다.

이러한 절차를 실행함으로써 나니노벨의 구성 메뉴(Configuration menus)로부터 할당된 모든 리소스가 빌드에 포함되도록 합니다. (예: 스크립트 문서, 캐릭터 외형, 배경 음악 및 효과음 클립 등)

사용자 지정 빌드 환경(Custom Build Environment; 예: [클라우드 빌드](https://unity3d.com/unity/features/cloud-build))을 사용하거나 사용자 지정 스크립트 또는 명령줄을 통해 빌드를 시작하는 경우, 빌드 전후에 각각 Naninovel.BuildProcessor.PreprocessBuild(BuildPlayerOptions) 및 Naninovel.BuildProcessor.PostprocessBuild() 정적 메서드를 수동으로 호출해야 합니다.

아래는 필요한 나니노벨 처리 메서드를 호출하는 클라우드 빌드 커스텀 빌드 처리 스크립트의 예입니다.

프로세싱 스크립트를 설정하는 방법에 대해서는 공식 서비스 문서의 도움을 받으세요.

```
public static class CustomBuildProcessor
{
	#if UNITY_CLOUD_BUILD
    public static void PreExport (BuildManifestObject manifest)
    {
        var options = new UnityEditor.BuildPlayerOptions();
        var target = manifest.GetValue<string>("target").ToString().ToLower();

        if (target.Contains("windows") && target.Contains("64"))
            options.target = UnityEditor.BuildTarget.StandaloneWindows64;
        else if (target.Contains("windows"))
            options.target = UnityEditor.BuildTarget.StandaloneWindows;
        else if (target.Contains("android"))
            options.target = UnityEditor.BuildTarget.Android;
        else if (target.Contains("webgl"))
            options.target = UnityEditor.BuildTarget.WebGL;
        else throw new System.ArgumentException($"Unhandled target: {target}");

        Naninovel.BuildProcessor.PreprocessBuild(options);
    }
	#endif

    public static void PostExport(string exportPath)
    {
        Naninovel.BuildProcessor.PostprocessBuild();
    }
}
```

![CustomBuildProcessor 이미지](https://subculturegamer.com/wp-content/uploads/2025/02/naninovel-custom-build-environment-02-1024x979.png)

사용자 지정 명령에 어셈블리 정의를 사용할 때 Unity 에디터가 모든 어셈블리를 컴파일하기 전에 에셋 가져오기를 시작하여 클라우드 빌드를 사용할 때 빌드 오류가 발생할 수 있습니다.

이 문제는 빌드를 시작하기 전에 스크립트 에셋을 다시 가져오면(ReImport) 해결할 수 있습니다.

예를 들면 다음과 같습니다.

```
var scriptGuids = AssetDatabase.FindAssets("t:Naninovel.script");
foreach (var scriptGuid in scriptGuids)
{
    var scriptPath = AssetDatabase.GUIDToAssetPath(scriptGuid);
    AssetDatabase.ImportAsset(scriptPath);
}
```

![scriptGuids 이미지](https://subculturegamer.com/wp-content/uploads/2025/02/naninovel-custom-build-environment-03-1024x263.png)

[GameCI](https://game.ci/)와 같은 Github 액션을 사용할 땐, 프로젝트를 빌드하기 전 LFS가 체크아웃되었는지 확인하세요.

```
 - name: checkout
    uses: actions/checkout@v4
    with:
        lfs: 'true'
  - name: checkout LFS
    uses: actions/checkout@v4
  - run: git lfs pull
```

![Image](https://subculturegamer.com/wp-content/uploads/2025/02/naninovel-custom-build-environment-04-1024x293.png)

에디터의 빌드 메뉴와 함께 실행되도록 사용자 지정 빌드 처리기를 사용하는 경우, 리소스 공급자 구성 메뉴에서 ‘빌드 처리 활성화(Enable Build Processing)’ 속성을 비활성화하여 Naninovel의 처리기를 비활성화할 수 있습니다.

해당 속성을 활성화 또는 비활성화한 후에는 Unity 에디터를 다시 시작하여 변경 사항을 적용하십시오.

### 연관글:

[## 나니노벨 Samples](https://subculturegamer.com/naninovel-samples/)[## 나니노벨 Automated Testing](https://subculturegamer.com/naninovel-automated-testing/)[## 나니노벨 Integration Options](https://subculturegamer.com/naninovel-integration-options/)[## 나니노벨 Render Pipelines](https://subculturegamer.com/naninovel-render-pipelines/)[## 나니노벨 State Management](https://subculturegamer.com/naninovel-state-management/)[## 나니노벨 Custom Script Parser](https://subculturegamer.com/naninovel-custom-script-parser/)