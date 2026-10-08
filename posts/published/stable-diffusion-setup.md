---
title: "5분 안에 「스테이블 디퓨전 설치하기」"
url: https://subculturegamer.com/stable-diffusion-setup/
published: 2024-06-21
categories: []
tags: ["일상"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 스테이블 디퓨전 설치에 들어가기에 앞서

![눈 깜짝할 새 「스테이블 디퓨전 설치하기」ㆍ스테이블 디퓨전 시리즈 #1](https://subculturegamer.com/wp-content/uploads/2024/06/눈-깜짝할-새-「스테이블-디퓨전-설치하기」ㆍ스테이블-디퓨전-시리즈-1-7-1024x800.png)

스테이블 디퓨전의 초기 화면 모습.  
이제는 텍스트만으로도 우측의 새싹을 틔울 수 있는 시대가 도래했다.

### AI과 실무가 공존하는 시대

이 글에 들어가기에 앞서, 필자는 한 마디 변명을 하고자 한다.

필자는 현업에 있는 개발자, 디자이너, 아티스트 분들의 창조적인 작업물을 사랑하며, 그분들의 개발 능력을 추호도 의심하지 않는다.

한편으로는, 우리가 모두 조금이라도 ‘덜’ 고생하기 위해서는 꾸준히 새로운 기술을 습득하고 연마하며 실무에 적용해야한다고도 믿는다.

> 필자는  
> ChatGPT 및 Stable Diffusion Web UI, NovelAI 등,  
> 인공지능 기술 전반에 관해 중립적인 입장이다.

쉽게 말하자면, 원활한 실무를 위해 AI를 사용하는 데에는 부분적으로 찬성하는 쪽이다.

노동집약적이고 인간소외적인 이 게임업계에서 조금이라도 ‘덜’ 고생하기 위해서 우리는 기술의 도움을 받을 필요가 있다.

과거의 기술이 낡았고 부족하다는 게 아니다.

시대의 흐름을 거스를 수 없다는 이야기이다.

머지 않아, 우리는 학교에서 AI 기술 교육을 받은 인재들을 만나게 될 것이며, AI 개발자, AI 디자이너, AI 아티스트를 만나 같이 일을 하게 될 것이다.

그래서 현업에 있는 우리는 그들을 멀리하기보다는, 어떻게 하면 ‘공존’할 수 있을지를 고민해야 한다.

AI는 우리의 일자리를 빼앗을 수도 있다. 하지만 조금 다른 각도에서 AI를 바라본다면, 우리는 AI를 통해 ‘조금 더 빨리 퇴근’하거나, ‘조금 더 정확한 레퍼런스’를 전달하거나, ‘조금 더 오류가 적은 코드’를 만들 수도 있다.

![눈 깜짝할 새 「스테이블 디퓨전 설치하기」ㆍ스테이블 디퓨전 시리즈 #1](https://subculturegamer.com/wp-content/uploads/2024/06/image.png)

ChatGPT를 이용해 블로그의 기술 문제를 해결하는 데 활용하는 필자.  
다양한 골칫거리를 해결하기 위해 위 질의 외에도 ChatGPT를 많이 사용해왔고 지금까지 큰 도움을 받았다.

기술은 그 자체로 가치중립적이다.

기술의 발달을 우리가 먼저 거부한다면, 먼 훗날 우리는 기술의 적응을 두려워한 사람들로 기억될 것이다.

우리가 모색해야 할 길은, 우리의 일자리를 지키며 우리가 사랑하는 일을 가능한 한 오래 하는 것이다.

필자는 AI와 우리 현업인들이 모두 공존할 수 있는 길이 분명 존재한다고 믿는다.

그리하여 필자부터 나서서 AI 기술을 배우며 지식을 공유해야겠다는 책임감을 느껴 이번 글을 쓰게 되었다.

## 스테이블 디퓨전 시리즈

### 스테이블 디퓨전 설치 가이드 머리말

필자는 이번 글을 시작으로 몇 편의 ‘스테이블 디퓨전 시리즈’를 작성할 계획이다.

사실 스테이블 디퓨전(Stable Diffusion Web UI) 설치 가이드 글은 널리고 널렸다.

굳이 필자가 스테이블 디퓨전 설치 글을 작성하는 이유는 아래와 같다.

1. 대부분의 글이 쉬운 길을 두고 굳이 멀리 두고 가는 방법만을 재탕하고 있다.
2. 연재글 시리즈는 역시 설치하기 글부터 쓰는 게 순서상 맞다고 생각한다.

필자가 지향하는 글은 남들이 안 쓰는 글을 쓰는 거다.

**굳이 남들처럼 Python 깔고 Git 깔고 git clone으로 복사해서 설치하는 방법을 똑같이 쓰는 게 무슨 의미가 있겠는가.**

그래서 필자가 조금 더 쉽고 간단한 방법을 준비했다.

대신 조건이 있다.

### 스테이블 디퓨전 설치 준비 조건

- OS: Windows 10 이상 운영체제
- GPU: Nvidia GPU (권장사양: VRAM 최소 4GB 이상)
- **아래의 글을 순서대로 읽겠다는 약속.**

## 스테이블 디퓨전 설치

### 스테이블 디퓨전 설치 순서 요약

간단하다. 아래 다섯 가지 절차만 진행하면 된다.

1. 설치 파일 다운로드
2. 설치 파일 압축 해제
3. 설치 파일 업데이트
4. 실행
5. Web UI 인터페이스 정상 접근 여부 확인

### 설치 파일 다운로드

먼저, 받아야 할 파일이 있다.

위 경로에서 설치 파일을 다운로드 받는다.

아래의 파일명을 직접 눌러도 다운로드가 가능하다.

[sd.webui.zip](https://github.com/AUTOMATIC1111/stable-diffusion-webui/releases/download/v1.0.0-pre/sd.webui.zip)

다운로드한 파일의 이름이 **sd.webui.zip**이 맞는지 확인한다.

이 파일을 압축을 풀면, 이 폴더가 이제 스테이블 디퓨전 설치 경로가 된다.

혹시 설치 경로를 다른 드라이브나 폴더로 옮기고 싶다면 미리 준비해두도록 하자.

### 설치 파일 압축 해제

압축 파일의 압축을 해제한다.

만약 압축 프로그램을 설치하지 않은 상태라면 ‘[반디집](https://kr.bandisoft.com/bandizip/dl.php?web)’ 등의 압축 프로그램을 먼저 설치한다.

압축을 해제한 뒤, 압축을 푼 폴더(sd.webui)가 위치한 경로로 이동한다.

![설치 파일 압축 해제](https://subculturegamer.com/wp-content/uploads/2024/06/image-3.png)

폴더를 열었을 때 위처럼 파일과 폴더가 있는지 확인한다.

### 설치 파일 업데이트

![설치 파일 업데이트](https://subculturegamer.com/wp-content/uploads/2024/06/image-6.png)

위 이미지에도 보이지만 설치 파일의 수정한 날짜가 ‘2023-01-25’로 되어 있다.

즉, 오래된 파일이다.

스테이블 디퓨전 설치에 앞서 최신 데이터를 받아오기 위해 설치 파일 업데이트가 필요하다.

update.bat 파일을 실행하자.

![Windows의 PC 보호 - 1](https://subculturegamer.com/wp-content/uploads/2024/06/image-7.png)

![Windows의 PC 보호 - 2](https://subculturegamer.com/wp-content/uploads/2024/06/image-8.png)

위와 같이 Windows의 PC 보호 팝업이 뜰 수 있다.

이 팝업이 뜨는 이유는 MS의 백신이 이 파일이 안전한지 아닌지 검증을 하지 못한다는 의미이다.

Stable-Diffusion 파일이 악성코드나 바이러스이기 때문이 아니니 안심해도 좋다.

(단, 필자가 위에 올린 공식 링크를 통해 받지 않은 파일은 위험할 수 있으니 항상 위 팝업이 뜬다고 안심하면 안 된다.)

![스테이블 디퓨전 설치 이미지](https://subculturegamer.com/wp-content/uploads/2024/06/image-12.png)

아마 사용자마다 다르겠지만 필자처럼 오류 없이 위처럼 뜨면 성공이다.

아무키(엔터 키 등등)를 눌러서 창을 닫아주자.

### 실행

![Image](https://subculturegamer.com/wp-content/uploads/2024/06/image-13.png)

업데이트가 정상적으로 끝났다면, 이제 본격적으로 설치를 진행할 차례다.

이번엔 run.bat 파일을 실행한다.

아까처럼 ‘경고 팝업’이 뜨면 ‘추가 정보’라는 텍스트를 누르면 ‘실행’ 버튼이 생성된다.

실행 버튼을 누르자.

![Image](https://subculturegamer.com/wp-content/uploads/2024/06/image-17.png)

검은 배경에 위처럼 하얀 글씨가 주르륵 뜨면 설치가 잘 되고 있다는 뜻이다.

![Image](https://subculturegamer.com/wp-content/uploads/2024/06/image-21.png)

겁먹을 거 없다. 아무 버튼도, 키도 입력하지 않아도 된다.  
그저 이 모든 과정이 끝나기만을 기다리면 된다.

### Web UI 인터페이스 정상 접근 여부 확인

모든 설치가 완료되면 아래의 화면이 나타난다.

![눈 깜짝할 새 「스테이블 디퓨전 설치하기」ㆍ스테이블 디퓨전 시리즈 #1](https://subculturegamer.com/wp-content/uploads/2024/06/눈-깜짝할-새-「스테이블-디퓨전-설치하기」ㆍ스테이블-디퓨전-시리즈-1-7-1024x800.png)

노파심에 말하는데, 아래의 검은 화면이 무섭거나 복잡해 보인다고 해서 끄지 말자.

사실 위의 ‘이쁜 UI’ 화면은 뒤에서 저 검은 화면 덕택에 돌아가고 있는 것이니까.

자, 이제 설치가 끝났으니 제대로 실행되는지 확인해봐야겠다.

![눈 깜짝할 새 「스테이블 디퓨전 설치하기」ㆍ스테이블 디퓨전 시리즈 #1](https://subculturegamer.com/wp-content/uploads/2024/06/눈-깜짝할-새-「스테이블-디퓨전-설치하기」ㆍ스테이블-디퓨전-시리즈-1-11-1024x211.png)

Prompt(프롬프트)라고 적힌 텍스트 위에, Hello World!를 입력하고 Generate 버튼을 누르자.

![눈 깜짝할 새 「스테이블 디퓨전 설치하기」ㆍ스테이블 디퓨전 시리즈 #1](https://subculturegamer.com/wp-content/uploads/2024/06/눈-깜짝할-새-「스테이블-디퓨전-설치하기」ㆍ스테이블-디퓨전-시리즈-1-13.png)

필자가 생성한 첫 이미지. 조금 기괴한 느낌이 들기는 하지만 어쨌든 이미지 생성 자체는 문제 없이 진행되었다.

필자는 위와 같은 이미지를 얻었는데, 혹시 생성한 이미지가 마음에 안 들면 Generate를 마구마구 눌러서 바꿔봐도 된다.

이제 스테이블 디퓨전 설치가 모두 끝난 것이다!

## 아직 끝나지 않은 이야기

세상 만사 모두 위처럼 깔끔하게 끝나면 참 좋겠다.

스테이블 디퓨전 설치 가이드 도중 누군가는 막힐 수도 있고 어려워서 중도 포기할 수 있다.

세상 일은 어찌 될 지 모르는 법이다.

그래서 몇 가지 추가 내용을 준비했다.

### 또 다른 설치 방법

#### Q. 뭔 소린지 모르겠어요. 다른 방법으로 설치하고 싶어요.

1. 파이썬 [Python 3.10.6](https://www.python.org/ftp/python/3.10.6/python-3.10.6-amd64.exe)을 설치한다.  
   설치 시 옵션을 **Add to PATH**를 반드시 체크한다.
2. 최신 버전의 [git](https://www.git-scm.com/downloads)을 설치한다.
3. 명령어 입력창(git bash)을 실행한다.
4. `git clone https://github.com/AUTOMATIC1111/stable-diffusion-webui`  
   위 내용을 복사 붙여넣기한다.
5. 모든 설치가 끝나면 설치 경로에 있는 `webui-user.bat`를 눌러 실행한다.

#### Q. 실행할 때는 어떻게 해요?

1. sd.webuiwebui 경로로 이동한다.
2. webui-user.bat 파일을 실행한다.

### 팁

#### Q. 설치 경로가 복잡해요. 바탕화면 바로가기는 어떻게 만들죠?

![눈 깜짝할 새 「스테이블 디퓨전 설치하기」ㆍ스테이블 디퓨전 시리즈 #1](https://subculturegamer.com/wp-content/uploads/2024/06/눈-깜짝할-새-「스테이블-디퓨전-설치하기」ㆍ스테이블-디퓨전-시리즈-1-14-1024x687.png)

설치 경로의 webui-user.bat 파일을 바탕화면 바로가기를 만든다.

#### Q. 이거 업데이트 매번 수동으로 해줘야하나요?

webui-user.bat 파일을 수정하면 자동 업데이트 기능을 켜줄 수 있다.

webui-user.bat 파일을 메모장으로 열어서,

```
set COMMANDLINE_ARGS=--autolaunch --update-check
```

위와 같이 커맨드 라인을 수정한다.

### 오류 처리

<https://github.com/AUTOMATIC1111/stable-diffusion-webui/wiki/Troubleshooting>

공식 가이드를 통해 상황에 따른 가이드를 안내받을 수 있다.

필자가 답변할 수 있는 내용이 한계가 있을 수 있어, 위 내용으로 오류 처리의 내용을 대신한다.

### 연관글:

[## [ComfyUI] 서브컬처풍 게임 미소녀 일러스트 만들기 .with illustrious](https://subculturegamer.com/comfyui-subculture-bishojyo-making-with-illust/)[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## AI 시대, 게임 내러티브 기획자는 무엇을 해야 할까](https://subculturegamer.com/game-narrative-designer-ai-survival-guide/)[## 내가 보려고 쓴 장내기능시험 2종 보통 자동 1분 정리](https://subculturegamer.com/drive-licence-function-test-gangnam/)[## Rance X -결전- 한글화 방법](https://subculturegamer.com/rance-x-korean-patch-knowhow/)[## Rance X -결전- 설치 방법](https://subculturegamer.com/rance-x-setup-knowhow/)