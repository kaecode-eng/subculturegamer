---
title: "Windows에서 sudo 쓰는 방법"
url: https://subculturegamer.com/windows-sudo/
published: 2024-05-05
categories: []
tags: ["일상"]
related_posts: []
wiki_refs: []
series: ""
series_order: null
---

## 들어가는 글

이번에 준비한 글은 ‘windows에서 sudo 명령어 사용하기’이다.

![Windows에서 Sudo 명령어 사용하기 최초 이미지](https://subculturegamer.com/wp-content/uploads/2024/05/image-1.avif)

Windows 11의 ‘설정’ – ‘시스템’ – ‘개발자용’에서 볼 수 있는 sudo 활성화 옵션

오늘 Windows 11로 PC OS를 업데이트하게 되었다.

워드프레스 블로그를 운영하다 보면 결국 ‘기술적 한계’에 부딪히는 순간이 온다.

필자에게는 그게 sudo 명령어였다.

Object Cache(개체 캐시)를 활성화하기 위해 Redis, Memcached를 설정해야 하는데, 설치 방법이 Unix/Linux 활용 방법밖에 없었다.

필자는 개인 PC에서 윈도우 OS를 사용하는데, 이 문제 하나 해결하려고 다른 OS를 설치하고 싶지는 않았다.

방법을 찾아보자 다행히(?) MS에서 공식적으로 sudo 명령어를 지원해준다는 페이지를 발견했다.

그런데 문제가 있었다.

> 뭐? Windows 11에서만 할 수 있다고?
>
> 그렇게 오늘 하루 이거 해결하기 위해 다 썼다

## Windows에서 sudo 사용하기 “결론”

1. (순서 무관) Windows 참가자 프로그램(Windows Insider Program)에 ‘참가’한다.
2. Windows 11 OS를 설치한다. (Windows 10 이하의 경우, Windows 11로 업그레이드해야 한다.)
3. (1번 진행 이후) ‘Windows 업데이트’ – ‘Windows 참가자 프로그램’ – ‘참가자 설정 선택’에서 “Canary 채널” 또는 “Dev 채널”을 선택한다.
4. Windows 11 Insider Preview 빌드 26052 이상으로 “업데이트”한다.
5. Windows 11의 ‘설정’ – ‘시스템’ – ‘개발자용’ 팝업에서 ‘sudo 사용’ 옵션을 활성화한다.

### 결론 3줄 요약

- **“무조건”** 윈도우 11 쓰셔야 합니다. (다른 방법은 다른 데서 찾아보세요.)
- 먼저 **“대안을 찾아보세요.”** 굳이 sudo 쓰지 않고 해결할 수 있는지.
- sudo 옵션 띄울 때까지 **“시간 오래 걸립니다.”** (넉넉잡아 4시간 잡아주세요.)

## 여담

### sudo가 뭐예요?

Super User DO의 줄임말로, ‘슈퍼 사용자로서 명령한다’와 같은 용어이다.

주로 Linux 운영체제에서 사용되는데, 리눅스와 같은 운영체제는 커널(Kernel) 명령어를 흔히 쓰기 때문에 Sudo라는 명령어는 ‘Do 동사’만큼 흔히 쓰게 된다.

굳이 리눅스를 쓰지 않아도 git이나 python 등을 공부하다 보면 지식으로써 한 번쯤은 접하게 되는 명령어다.

코드로 사용하게 되면 아래처럼 사용한다.

#### Install Redis in Windows 11

```
curl -fsSL https://packages.redis.io/gpg | sudo gpg --dearmor -o /usr/share/keyrings/redis-archive-keyring.gpg

echo "deb [signed-by=/usr/share/keyrings/redis-archive-keyring.gpg] https://packages.redis.io/deb $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/redis.list

sudo apt-get update
sudo apt-get install redis
```

### Windows 11을 설치하지 않고 sudo 명령어를 쓸 수는 없나요?

방법이 없지는 않다.

다만 필자는 Microsoft가 제공하는 공식적인 방법을 ‘한글’로 쉽게 전달하고 싶었을 뿐이다.

Windows 11을 설치하지 않고 sudo 명령어를 윈도우에서 사용하는 방법을 안내하는 몇 가지 링크가 있다.

반드시 필자의 방법을 따르지 않아도 되니, 링크를 함께 참고하여 더 편한 방법이 있다면 그쪽을 이용해도 좋다.

#### 참고하면 좋을 사이트

- [How to install Linux on Windows with WSL](https://learn.microsoft.com/en-us/windows/wsl/install)
- [Choco]윈도우에서 sudo 사용하기
- [윈도우10에서 sh, sudo 등 우분투에서 쓰는 명령어 사용하는 방법](https://likecode.tistory.com/234)

## 모르겠고, 자세한 설명 없어요?

위에 적힌대로 진행하다가 막혔거나 상세한 가이드가 필요하다면 이제 여기부터 읽으면 된다.

아래의 방법은 필자가 실제로 ‘시행착오’하면서 경험했던 것을 기술한 것이기에, 아마 필자는 독자분들의 눈높이에서 설명을 드릴 수 있을 듯하다.

위의 ‘결론’을 각 소제목으로 삼아서 상세하게 설명하도록 하겠다.

## Windows에서 sudo 사용하기 상세 가이드

### Windows 11 설치하기

Windows 11을 설치하는 방법 또는 Windows 10 이하의 운영체제에서 11로 업그레이드하는 내용을 이 글에서 설명하지는 않겠다.

그것 하나 만으로도 새롭게 글을 써야 할 정도로 방대한 내용을 전달해야 한다. 이 글의 주제와 맞지 않는다.

Windows 11을 설치를 위한 공식 링크 주소를 확인해 보시라.

[[공식 링크] Microsoft Windows 11 다운로드 주소](https://www.microsoft.com/ko-kr/software-download/windows11)

본격적으로 설치하기에 앞서, Windows 11을 설치하거나 업그레이드하기 위한 요구 사항이 있다.

> **요구 사항에 미달되면 이후 진행 자체가 불가능하니 꼭 먼저 확인해야 한다.**

그래서 Windows 11 설치가 첫 순서에 배치되어 있는 것이다. (여기서 막히면 뒤에도 다 의미가 없다.)

#### Windows 11 시스템 요구 사항 확인하기

- **64bit 프로세서**
  - Intel: i3 시리즈 8세대 이상(i3-8100), i7 시리즈 7세대 이상(i7-7800X)
  - AMD: Ryzen 5 2세대 이상(2600), Ryzen 3 3세대 이상(3100)
- **TPM(신뢰할 수 있는 플랫폼 모듈) 활성화**
- **남은 저장공간 64GB 이상**

현재 PC가 요구사항을 만족하는지 모르겠으면 호환성 검사 앱(프로그램)을 다운로드해서 확인할 수 있다.

[(공식 홈페이지 링크) PC 상태 검사 앱 다운로드](https://aka.ms/GetPCHealthCheckApp)

100% 정확하지는 않으나, 현재 PC가 요구 사항 중 몇 가지를 만족하는지 비교가 가능하다.

보통의 경우 다른 조건은 어렵지 않을테지만, TPM 활성화라는 생소한 기능에서 막힐 것이다.

이것까지 해결하면 Windows 11으로 업그레이드하는 조건은 어렵지 않게 달성할 수 있다.

TPM 활성화?![1741685a 4248 4274 B132 3bac8ccce1f6](https://subculturegamer.com/wp-content/uploads/2024/05/1741685a-4248-4274-b132-3bac8ccce1f6.avif)

AMD 마더보드 기준 TPM 옵션 조정  
(Descrete TPM -> Firmware TPM 으로 변경하면 된다.)

필자의 경우 TPM 활성화가 되어 있지 않아서 Windows 11을 설치하지 못한다고 안내를 받았다.

TPM의 활성화는 PC 부팅 시 Bios 화면에 진입해서 관련 설정을 변경해서 할 수 있다.

상세한 확인 방법은 아래의 링크를 참고하면 된다.

[(링크) Asus 기준 TPM 활성화 방법](https://www.asus.com/kr/support/faq/1046215/)

### Windows 참가자 프로그램 참가하기 & ‘Dev 채널’ 선택하기

Windows 참가자 프로그램이란 일종의 ‘Windows 베타 테스터 참가’를 말한다.

Windows를 남들보다 더 빨리 ‘얼리 액세스’한다고 보면 된다.

이 Sudo 옵션도 얼리 억세스로만 활성화할 수 있으니, Windows 참가자 프로그램 참가는 필수다.

추후 Windows 10 Stable 빌드에 sudo 옵션이 마이그레이션(이전 적용)될 수도 있겠지만, 2024년 5월 기준 아직은 불가능하다.

Windows 참가자 프로그램에 참여한다고 뭔가 대놓고 불이익(?)이 있는 건 아니니 걱정 말고 이어서 진행하자.

![Image 5](https://subculturegamer.com/wp-content/uploads/2024/05/windows에서-sudo-쓰는-방법-1-1024x673.jpg)

빨간 색 화살표에 집중!

‘설정(제어판)’ – ‘업데이트 및 보안’으로 들어가서,

![Image 4](https://subculturegamer.com/wp-content/uploads/2024/05/image-4.avif)

windows 10 기준 제어판 화면  
windows 11로 오면 UI가 다소 달라진다.

‘Windows 참가자 프로그램’을 선택하고 ‘시작’ 버튼을 누른다.

![Image 6](https://subculturegamer.com/wp-content/uploads/2024/05/image-6.webp)

Register for the Windows Insider Program  
Windows 참가자 프로그램이라고도 불리는 위 화면에서 flight(날아오르기) 하면 된다.  
windows에서 sudo 명령어를 쓰는 그 순간까지!

Register for the Windows Insider Program을 진행하기 위해서는 Microsoft 계정을 보유해야 한다.

Start filghting 버튼을 눌러 이어서 Windows 참가자 프로그램을 신청할 수 있다.

위 화면은 영어이지만 Windows 참가자 프로그램은 한국어도 지원하니 조금만 더 견디면 된다.

![Image 5](https://subculturegamer.com/wp-content/uploads/2024/05/image-5.avif)

24년 5월 기준, ‘Canary 채널’, ‘개발자 채널’ 중 어느 쪽을 골라도 된다.  
아직 ‘베타 채널’에서는 빌드를 26000번대로 올릴 수 없다.

위 화면이 중요하다.

마침내 Windows 참가자 프로그램 신청이 정상적으로 끝났다면, ‘참가 채널’을 선택할 수 있게 된다.

총 4가지의 채널이 있는데, 이중에서 Canary 채널과 개발자 채널 둘 중 하나를 고르면 된다.

필자는 ‘개발자 채널’을 골랐는데, 굳이 알파 빌드 성격이 더 강한 Canary 채널을 고르지 않아도 Windows에서 sudo 명령어를 쓸 수 있기 때문이다.

이로써 Windows 11 베타 빌드 업데이트를 위한 모든 준비가 끝났다.

### Windows 11 최신 업데이트하기

![Image 8](https://subculturegamer.com/wp-content/uploads/2024/05/image-8-1024x280.avif)

아시는 분은 아시겠지만, Windows 업데이트는 ‘최신 상태입니다’라는 말을 믿을 수 없다.  
‘업데이트 확인’ 버튼을 누를 때마다 계속 신규 업데이트가 추가된다(…).

Windows에서 sudo 명령어를 쓰기 위한 기나긴 과정에서 이제 거의 클라이막스 단계에 다다랐다.

Windows 참가자 프로그램 신청 자체는 간단하지만, 문제는 이것이 시간을 많이 잡아먹는다는 데 있다.

앞서 Windows 참가자 프로그램이 ‘얼리 액세스’라고 이야기를 했다.

Windows에서 sudo를 사용하는 것 자체가 아직은 베타 한정 기능이므로, 이 기능은 윈도우 기본 업데이트 패키지에 포함되어 있지 않다.

즉, Windows 참가자 프로그램에 신청한 사람에 한해 이 신규 기능이 추가 설치된다.

그런데 이 Windows 업데이트가 시간을 많이 잡아먹는다. 업데이트에 필요한 볼륨이 꽤 크다.

필자가 Windows에서 sudo 명령어 한번 써보겠다고 사용한 시간 중 태반이 Windows 업데이트에 사용되었다.

오늘 가이드를 따라하는 건 난이도가 어렵다기보다는 Windows 업데이트 때문에 시간이 오래걸리는 게 문제다.

아무튼 모든 Windows 업데이트를 마쳤고 베타 빌드 데이터도 다 받으면…

### sudo 사용 옵션 체크하기

이제 다른 모든 방해물(?)은 처리했으니, 제어판에서 sudo 옵션을 활성화해줄 차례다.

sudo 옵션은 ‘강력’하다. super user의 권한을 획득하는 것이니, 그만큼 함부로 다뤄서는 안 될 것이다.

하지만 여기까지 와놓고 이 옵션을 안 쓰는 것도 이상한 일.

이제 제어판에서 sudo 옵션을 활성화하자!

![Image 9](https://subculturegamer.com/wp-content/uploads/2024/05/image-9.avif)

![Image 11](https://subculturegamer.com/wp-content/uploads/2024/05/image-11.avif)

windows에서 sudo 한번 써보겠다고 windows 11로 업그레이드했더니 UI가 낯설다.

‘개발자용’ 화면에 들어와 sudo 사용 버튼을 활성화하게 되면…

![Image 12](https://subculturegamer.com/wp-content/uploads/2024/05/image-12-1024x150.avif)

이제 sudo 사용이 가능하다!

그렇다면 이제 CMD를 실행시켜서 sudo가 잘 먹히는지 테스트해보자!

![Image 13](https://subculturegamer.com/wp-content/uploads/2024/05/image-13.webp)

cmd에서 netstat -ab를 입력하자, 권한 상승을 요구한다.

![Image 15](https://subculturegamer.com/wp-content/uploads/2024/05/image-15.webp)

sudo netstar – ab를 입력하자 ‘권한 상승’을 요구하지 않는다.  
마침내 sudo가 정상 동작한다!

## 글을 마치며

![Image 16](https://subculturegamer.com/wp-content/uploads/2024/05/image-16.avif)

이제 나도 sudo apt install redis를 할 수 있겠지…!

![Image 17](https://subculturegamer.com/wp-content/uploads/2024/05/image-17.webp)

명령을… 찾을 수 없다고…?!

![Image 18](https://subculturegamer.com/wp-content/uploads/2024/05/image-18.avif)

결국 깐다… 우분투…

![Image 19](https://subculturegamer.com/wp-content/uploads/2024/05/windows에서-sudo-쓰는-방법-2.webp)

씁쓸한 결말… 그래도 sudo는 잘 깔았다…

### 연관글:

[## [몬길:Star Dive] 리뷰 – 과감한 서브컬처풍 아트와 가벼운 내러티브 감성](https://subculturegamer.com/mongil-stardive-review/)[## [퀘스트 디자인 4편] – 퀘스트 기획 실무 가이드 I](https://subculturegamer.com/game-quest-design-episode-planning-guide/)[## [퀘스트 디자인 2편] 퀘스트의 4대 기둥: 메인, 서브, 일일, 이벤트](https://subculturegamer.com/types-of-quest-design/)[## 페르소나 3 리로드 일상 콘텐츠 분석: 테마와 제약이 연결되는 JRPG의 생동감](https://subculturegamer.com/persona-3-reload-daily-life-analysis/)[## [게임 기획] 텍스트를 넘어 전장으로: 내러티브 디자이너가 전투를 신경 쓰면 안 되는 걸까?](https://subculturegamer.com/narrative-designer-combat-mechanics/)[## 내가 보려고 쓴 장내기능시험 2종 보통 자동 1분 정리](https://subculturegamer.com/drive-licence-function-test-gangnam/)