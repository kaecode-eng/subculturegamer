---
title: "기획서 다음의 기획: 게임 기획자가 바이브 코딩을 배워야 하는 이유"
url: https://subculturegamer.com/game-designer-vibe-coding/
published: 2026-10-04
categories: ["게임 디자인"]
tags: ["생성형 AI", "퀘스트 디자인"]
related_posts:
  - 2026-07-19-game-planning-ai-cross-validation-gpt-claude
  - 2026-08-01-game-design-document-vs-proposal
  - 2026-08-23-game-concept-pitch-guide
  - concentric-development
wiki_refs:
  - wiki/concepts/ai-game-design
  - wiki/concepts/quest-design
  - wiki/concepts/vibe-coding-for-game-design
  - wiki/techniques/concentric-development
  - wiki/series-threads/ai-tools-for-game-development-hub
  - wiki/series-threads/game-planning-documents-and-collaboration
series: ""
series_order: null
---

<figure class="wp-block-image size-large"><img decoding="async" width="1024" height="1024" src="https://subculturegamer.com/wp-content/uploads/2026/10/game-designer-vibe-coding-title-1024x1024.png" alt="game-designer-vibe-coding-title" class="wp-image-24674" srcset="https://subculturegamer.com/wp-content/uploads/2026/10/game-designer-vibe-coding-title-1024x1024.png 1024w, https://subculturegamer.com/wp-content/uploads/2026/10/game-designer-vibe-coding-title-300x300.png 300w, https://subculturegamer.com/wp-content/uploads/2026/10/game-designer-vibe-coding-title-768x768.png 768w, https://subculturegamer.com/wp-content/uploads/2026/10/game-designer-vibe-coding-title.png 1096w" sizes="(max-width: 1024px) 100vw, 1024px" /></figure>



<h2 id="%eb%93%a4%ec%96%b4%ea%b0%80%eb%8a%94-%ea%b8%80" class="wp-block-heading">들어가는 글</h2>



<p class="wp-block-paragraph">최근 회사에서 꽤 인상적인 발표를 하나 봤다.</p>



<p class="wp-block-paragraph">신규 콘텐츠를 설명하는 자리였는데, 담당 기획자가 평소처럼 기획서만 가져온 것이 아니라 간단한 HTML 프로토타입을 함께 만들어왔다.</p>



<p class="wp-block-paragraph">대단한 프로그램은 아니었다. 버튼을 누르면 다음 화면으로 넘어가고, 조건에 따라 몇몇 기능이 켜졌다 꺼지는 정도였다. 몇 번 눌러보면 엉성한 부분도 금방 눈에 들어왔다.</p>



<p class="wp-block-paragraph">그런데 이해는 이상할 만큼 빨랐다.</p>



<p class="wp-block-paragraph">기획서를 여러 장 넘겨가며 “이 조건에서는 여기로 이동하고, 이 경우에는 이 기능이 비활성화됩니다”라는 설명을 듣는 것보다 버튼을 두세 번 눌러보는 편이 훨씬 직관적이었다.</p>



<p class="wp-block-paragraph">무엇보다 그 사람이 무엇을 만들고 싶어 하는지가 눈앞에 보였다.</p>



<p class="wp-block-paragraph">사실 이런 기획자는 예전에도 있었다.</p>



<p class="wp-block-paragraph">그림을 잘 그리는 기획자는 직접 러프를 그렸고, 엔진을 잘 다루는 사람은 간단한 화면이나 기능을 만들어왔다. 코딩 경험이 있는 사람이라면 자신이 생각한 동작을 구현해서 보여주기도 했다.</p>



<p class="wp-block-paragraph">나는 그런 사람들을 볼 때마다 부러운 마음이 있었다.</p>



<p class="wp-block-paragraph">기획서를 아무리 잘 써도 내가 머릿속에서 보고 있는 것을 그대로 전달할 수는 없다. 그런데 어떤 사람들은 거기서 한 발 더 나아갔다. 머릿속의 것을 다른 사람이 직접 보고 만져볼 수 있는 형태까지 만들어냈다.</p>



<p class="wp-block-paragraph">다만 그런 능력에는 늘 별도의 기술이 필요했다.</p>



<p class="wp-block-paragraph">그림을 배워야 했고, 엔진을 익혀야 했고, 코드를 쓸 줄 알아야 했다.</p>



<p class="wp-block-paragraph">최근 AI와 바이브 코딩을 보면서 흥미롭게 느낀 것은 바로 그 지점이었다.</p>



<p class="wp-block-paragraph">그 문턱이 빠르게 낮아지고 있었다.</p>



<p class="wp-block-paragraph">그렇다면 앞으로 게임 기획자가 만드는 것은 어디까지일까?</p>



<p class="wp-block-paragraph">지금까지 기획자의 대표적인 산출물은 기획서였다. 머릿속에 있는 아이디어를 규칙과 구조로 정리하고, 다른 사람이 이해할 수 있도록 문서로 풀어내는 일은 여전히 중요하다.</p>



<p class="wp-block-paragraph">하지만 앞으로도 기획자의 생각을 반드시 문서로만 보여줘야 할까.</p>



<p class="wp-block-paragraph">기획서 옆에 직접 눌러볼 수 있는 프로토타입이 놓일 수도 있다. 반복적으로 데이터를 확인해주는 작은 검사기를 붙일 수도 있고, 복잡한 퀘스트 구조를 한눈에 보여주는 시각화 도구를 만들어 함께 설명할 수도 있다.</p>



<p class="wp-block-paragraph">나는 요즘 AI가 기획자의 일을 대신한다는 이야기보다 이 변화에 더 관심이 간다.</p>



<p class="wp-block-paragraph"><strong>AI가 기획자가 자신의 생각을 형태로 만드는 범위를 넓히고 있다는 것.</strong></p>



<p class="wp-block-paragraph">이 글에서 이야기하고 싶은 바이브 코딩도 그 연장선에 있다.</p>



<hr class="wp-block-separator has-alpha-channel-opacity"/>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h2 id="%eb%b0%94%ec%9d%b4%eb%b8%8c-%ec%bd%94%eb%94%a9%ec%9d%b4-%ea%b2%8c%ec%9e%84-%ea%b8%b0%ed%9a%8d%ec%9e%90%ec%97%90%ea%b2%8c-%ed%95%84%ec%9a%94%ed%95%9c-%ea%b9%8c%eb%8b%ad" class="wp-block-heading">바이브 코딩이 게임 기획자에게 필요한 까닭</h2>



<h3 id="%eb%b0%94%ec%9d%b4%eb%b8%8c-%ec%bd%94%eb%94%a9%ec%9d%b4%eb%9e%80" class="wp-block-heading">바이브 코딩이란?</h3>



<p class="wp-block-paragraph">안드레 카파시는 자신이 ‘바이브 코딩’이라고 부른 작업 방식을 다음과 같이 설명했다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">“그냥 대화만 해서 키보드를 거의 만지지 않아요. ‘사이드바 패딩을 반으로 줄여줘’ 같은 요청을 하고, 에러 메시지가 나오면 그냥 복사해서 붙여넣기만 하면 보통 그게 해결해줘요. […] 사실상 코딩이 아니라, 그냥 물건을 보고, 말하고, 실행하고, 복사 붙여넣기만 하는 거예요. 그리고 대부분 잘 작동해요.”<br><br><em>— Andrej Karpathy, <a href="https://x.com/karpathy/status/1886192184808149383" target="_blank" rel="noopener nofollow">X 게시물</a> 번역</em></p>
</blockquote>



<p class="wp-block-paragraph"></p>



<p class="wp-block-paragraph">표현만 보면 꽤 과격하다.</p>



<p class="wp-block-paragraph">실제로 같은 글에서 카파시는 더 이상 diff를 제대로 읽지 않는다거나, LLM이 버그를 고치지 못하면 이것저것 바꿔달라고 하다가 문제가 사라지면 넘어간다는 이야기까지 한다.</p>



<p class="wp-block-paragraph">실제 서비스에 들어가는 코드를 이런 방식으로 다루는 것은 당연히 위험하다.</p>



<p class="wp-block-paragraph">하지만 내가 흥미롭게 본 것은 그 과격함 자체가 아니었다.</p>



<p class="wp-block-paragraph">예전에는 프로그램을 만들려면 먼저 코드를 쓸 줄 알아야 했다. 문법을 배우고, 필요한 기능을 찾아보고, 직접 구현한 다음 오류가 나면 원인을 추적해야 했다.</p>



<p class="wp-block-paragraph">바이브 코딩에서는 그 순서가 조금 달라진다.</p>



<p class="wp-block-paragraph">내가 원하는 것을 먼저 말한다.</p>



<p class="wp-block-paragraph">결과를 실행해본다.</p>



<p class="wp-block-paragraph">마음에 들지 않으면 다시 설명하고, 에러가 나면 그것을 보여준 뒤 수정을 요청한다.</p>



<p class="wp-block-paragraph">코드는 여전히 존재한다. 사라진 것은 아니다.</p>



<p class="wp-block-paragraph">다만 사람이 프로그램을 만들기 위해 반드시 모든 코드를 직접 작성해야 했던 문턱은 크게 낮아졌다.</p>



<p class="wp-block-paragraph">프로그래밍 언어를 능숙하게 다루지 못하더라도 무엇을 만들고 싶은지 설명할 수 있고, 나온 결과가 자신의 의도와 같은지 판단할 수 있다면 작은 프로그램이나 프로토타입 정도는 직접 만들어볼 수 있는 환경이 열린 것이다.</p>



<h3 id="%ea%b8%b0%ed%9a%8d%ec%9e%90%eb%8a%94-%ec%9b%90%eb%9e%98%eb%b6%80%ed%84%b0-%ea%b5%ac%ec%a1%b0%eb%a5%bc-%ec%a0%95%ec%9d%98%ed%95%98%eb%8a%94-%ec%82%ac%eb%9e%8c%ec%9d%b4%eb%8b%a4" class="wp-block-heading">기획자는 원래부터 구조를 정의하는 사람이다</h3>



<p class="wp-block-paragraph">게임 기획자가 하는 일을 한마디로 정의하기는 어렵다.</p>



<p class="wp-block-paragraph">전투를 만드는 사람도 있고, 경제 시스템을 설계하는 사람도 있고, 레벨이나 퀘스트, 시나리오를 만드는 사람도 있다.</p>



<p class="wp-block-paragraph">그래도 조금 넓게 보면 공통점이 있다.</p>



<p class="wp-block-paragraph">기획자는 목표를 정하고, 조건을 정하고, 상태가 어떻게 바뀌는지를 설계하고, 그 결과와 예외를 정의한다.</p>



<p class="wp-block-paragraph">전투 시스템을 만든다면 어떤 조건에서 스킬이 발동하고 무엇이 영향을 받는지 정한다.</p>



<p class="wp-block-paragraph">경제 시스템이라면 재화가 어디에서 들어와 어디로 빠져나가는지 설계한다.</p>



<p class="wp-block-paragraph">퀘스트를 만든다면 언제 시작되고, 무엇을 해야 완료되며, 그 결과 게임의 상태가 어떻게 바뀌는지를 정의한다.</p>



<p class="wp-block-paragraph">글을 쓰는 일이 중심처럼 보이는 내러티브 기획도 크게 다르지 않다.</p>



<p class="wp-block-paragraph">하나의 퀘스트가 정상적으로 작동하려면 계속 조건을 확인해야 한다.</p>



<p class="wp-block-paragraph">이전 퀘스트를 완료했는가.</p>



<p class="wp-block-paragraph">특정 NPC와 대화했는가.</p>



<p class="wp-block-paragraph">어떤 선택지를 골랐는가.</p>



<p class="wp-block-paragraph">필요한 플래그가 활성화됐는가.</p>



<p class="wp-block-paragraph">그 결과 어떤 대사와 퀘스트가 새로 열리는가.</p>



<p class="wp-block-paragraph">게임 속 이야기는 좋은 문장을 쓴다고 저절로 작동하지 않는다.</p>



<p class="wp-block-paragraph">조건과 상태, 분기와 결과가 서로 맞물려야 비로소 플레이어가 하나의 이야기로 경험할 수 있다.<br></p>



<figure class="wp-block-image aligncenter size-large"><img decoding="async" width="672" height="1024" src="https://subculturegamer.com/wp-content/uploads/2026/10/image-1-672x1024.png" alt="game-designer-vibe-coding-1" class="wp-image-24673" srcset="https://subculturegamer.com/wp-content/uploads/2026/10/image-1-672x1024.png 672w, https://subculturegamer.com/wp-content/uploads/2026/10/image-1-197x300.png 197w, https://subculturegamer.com/wp-content/uploads/2026/10/image-1-768x1169.png 768w, https://subculturegamer.com/wp-content/uploads/2026/10/image-1.png 788w" sizes="(max-width: 672px) 100vw, 672px" /><figcaption class="wp-element-caption">류용호, &#8216;기획자의 시대가 온다&#8217;, 좋은습관연구소, 2026년 9월 1일</figcaption></figure>



<p class="wp-block-paragraph">최근 읽은 《<a href="https://product.kyobobook.co.kr/detail/S000221075149" target="_blank" rel="noopener nofollow">기획자의 시대가 온다</a>》에는 이런 문장이 나온다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">“흐름을 그리기 전에 입력과 출력부터 정의하는 것입니다. […] 진짜 프로젝트를 살리는 것은 예외를 다루는 방식입니다.”</p>



<p class="wp-block-paragraph"><em>— 위 책, 본문 &#8216;그림과 코드의 간극&#8217; 中</em></p>
</blockquote>



<p class="wp-block-paragraph">읽다 보니 내가 기획서를 쓸 때 반복해온 생각과 크게 다르지 않았다.</p>



<p class="wp-block-paragraph">무엇이 들어오는지 정한다.</p>



<p class="wp-block-paragraph">어떤 조건에서 무엇이 바뀌는지 정한다.</p>



<p class="wp-block-paragraph">정상적인 흐름뿐 아니라 예외를 생각한다.</p>



<p class="wp-block-paragraph">그리고 원하는 결과가 나오도록 구조를 만든다.</p>



<p class="wp-block-paragraph">바이브 코딩이 게임 기획자에게 완전히 새로운 사고방식을 요구하는 것은 아니다.</p>



<p class="wp-block-paragraph">오히려 기획자가 평소 문서 안에서 해오던 구조적인 사고를, 작동하는 형태로 옮길 수 있게 해주는 도구에 더 가깝다.</p>



<p class="wp-block-paragraph">예전에는 그 구조를 기획서나 플로우차트로 설명했다면, 이제는 필요할 때 직접 움직이게 만들어볼 수도 있다.</p>



<h3 id="%eb%82%b4%eb%9f%ac%ed%8b%b0%eb%b8%8c-%ea%b8%b0%ed%9a%8d%ec%9e%90%ec%99%80-%eb%b0%94%ec%9d%b4%eb%b8%8c-%ec%bd%94%eb%94%a9" class="wp-block-heading">내러티브 기획자와 바이브 코딩</h3>



<p class="wp-block-paragraph">기능 구현이나 구조 설계라는 말을 들으면 바이브 코딩은 시스템 기획자나 데이터를 많이 다루는 직군에게 더 필요한 기술처럼 느껴질 수도 있다.</p>



<p class="wp-block-paragraph">하지만 내러티브 기획에도 의외로 반복적인 검증 작업이 많다.</p>



<p class="wp-block-paragraph">대사 데이터에서 값이나 태그가 빠진 곳을 찾아야 할 수도 있다.</p>



<p class="wp-block-paragraph">특정 퀘스트에서 사용하는 플래그가 실제로 어디에서 생성되고 어디에서 참조되는지 확인해야 할 수도 있다.</p>



<p class="wp-block-paragraph">조건과 분기가 많아진 퀘스트의 전체 흐름을 한눈에 보고 싶을 때도 있다.</p>



<p class="wp-block-paragraph">물론 이런 일이 생길 때마다 LLM에 데이터를 붙여넣고 “문제가 있는지 찾아줘”라고 물어볼 수도 있다.</p>



<p class="wp-block-paragraph">한두 번이라면 그게 가장 빠르다.</p>



<p class="wp-block-paragraph">문제는 같은 일을 계속 반복할 때다.</p>



<p class="wp-block-paragraph">매번 파일을 열고, 필요한 범위를 골라 복사하고, 프롬프트를 쓰고, 나온 결과를 다시 확인한다.</p>



<p class="wp-block-paragraph">어느 순간 AI에게 일을 시키는 과정 자체가 또 하나의 반복 업무가 된다.</p>



<p class="wp-block-paragraph">그럴 때는 처음에 조금 시간을 들여 자신의 업무 방식에 맞는 작은 도구를 하나 만들어두는 편이 나을 수도 있다.</p>



<p class="wp-block-paragraph">파일을 넣으면 누락된 데이터를 찾아주는 검사기.</p>



<p class="wp-block-paragraph">플래그를 검색하면 어디에서 생성되고 사용되는지 보여주는 도구.</p>



<p class="wp-block-paragraph">퀘스트 데이터를 읽어 전체 흐름을 노드로 펼쳐주는 도구.</p>



<p class="wp-block-paragraph">바이브 코딩의 장점은 꼭 거창한 프로그램을 만드는 데 있지 않다.</p>



<p class="wp-block-paragraph">사람이 반복하기에는 귀찮고, 자주 발생하고, 그러다 보니 실수하기 쉬운 일을 하나씩 떼어내는 것.</p>



<p class="wp-block-paragraph">그 정도로도 충분히 쓸모가 있다.</p>



<hr class="wp-block-separator has-alpha-channel-opacity"/>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h2 id="%ea%b8%b0%ed%9a%8d%ec%84%9c-%eb%8b%a4%ec%9d%8c%ec%9d%98-%ea%b8%b0%ed%9a%8d" class="wp-block-heading">기획서 다음의 기획</h2>



<h3 id="%ea%b8%b0%ed%9a%8d%ec%84%9c%eb%a5%bc-%ec%93%b0%eb%8a%94-%ea%b2%83%ec%97%90%ec%84%9c-%ec%a7%81%ec%a0%91-%eb%b3%b4%ec%97%ac%ec%a3%bc%eb%8a%94-%ea%b2%83%ec%9c%bc%eb%a1%9c" class="wp-block-heading">기획서를 쓰는 것에서, 직접 보여주는 것으로</h3>



<p class="wp-block-paragraph">앞에서 이야기한 HTML 프로토타입이 인상적이었던 이유도 여기에 있다.</p>



<p class="wp-block-paragraph">기획서와 프로토타입은 비슷한 것을 설명하는 것처럼 보여도 전달하는 방식이 다르다.</p>



<p class="wp-block-paragraph">기획서는 규칙을 설명하는 데 강하다.</p>



<p class="wp-block-paragraph">어떤 조건에서 기능이 동작하고, 어떤 예외가 있으며, 어떤 데이터를 필요로 하는지 기록하기 좋다.</p>



<p class="wp-block-paragraph">반면 프로토타입은 사용자가 그 규칙을 실제로 경험하게 만든다.</p>



<p class="wp-block-paragraph">“이 버튼을 누르면 다음 단계로 넘어갑니다”라고 듣는 것과 버튼을 눌러 다음 화면을 보는 것은 받아들이는 감각이 다르다.</p>



<p class="wp-block-paragraph">그러다 문득 기획자의 산출물을 꼭 ‘기획서’라고만 불러야 할까 싶었다.</p>



<p class="wp-block-paragraph">돌이켜보면 우리가 기획서를 쓰는 이유도 기획서라는 형식 자체가 필요해서라기보다, 아직 존재하지 않는 것을 다른 사람에게 설명해야 하기 때문일 것이다.</p>



<p class="wp-block-paragraph">그렇다면 중요한 것은 문서의 형태보다, 머릿속에 있던 것을 다른 사람이 이해하고 검증할 수 있는 상태까지 끌어내는 일이 아닐까.</p>



<p class="wp-block-paragraph">오랫동안 그 목적을 달성하기에 가장 쉽고 저렴한 수단이 문서였고, 그래서 우리는 기획서를 써왔다.</p>



<p class="wp-block-paragraph">이제는 그 옆에 다른 선택지가 하나씩 생기고 있다.</p>



<h3 id="%ec%9e%91%ec%9d%80-%ed%94%84%eb%a1%9c%ed%86%a0%ed%83%80%ec%9e%85%ec%9c%bc%eb%a1%9c-%eb%a8%bc%ec%a0%80-%ea%b2%80%ec%a6%9d%ed%95%98%ea%b8%b0" class="wp-block-heading">작은 프로토타입으로 먼저 검증하기</h3>



<p class="wp-block-paragraph">게임 개발의 흐름을 아주 단순하게 줄이면 대략 이런 모습일 것이다.</p>



<p class="wp-block-paragraph"><strong>아이디어 → 기획서 작성 → 리뷰 → 개발 전달 → 구현 → 빌드 확인</strong></p>



<p class="wp-block-paragraph">익숙한 과정이다.</p>



<p class="wp-block-paragraph">문제는 실제로 어떻게 작동하는지 보기까지 시간이 필요하다는 데 있다.</p>



<p class="wp-block-paragraph">문서에서는 문제가 없어 보였던 기능도 막상 구현해보면 예상하지 못했던 문제가 튀어나온다.</p>



<p class="wp-block-paragraph">조건이 꼬일 수 있다.</p>



<p class="wp-block-paragraph">예외 처리를 빠뜨렸을 수도 있다.</p>



<p class="wp-block-paragraph">화면 흐름이 번거롭거나, 사용해보니 기능 자체가 너무 복잡할 수도 있다.</p>



<p class="wp-block-paragraph">오류가 있다는 사실보다 더 아쉬운 것은 그런 문제를 본 개발이 끝난 뒤에야 발견하는 경우다.</p>



<p class="wp-block-paragraph">바이브 코딩을 이용한 프로토타이핑은 이 확인 시점을 조금 앞으로 당길 수 있다.</p>



<p class="wp-block-paragraph"><strong>아이디어 → 작은 프로토타입 → 직접 검증 → 수정 → 팀 리뷰 → 본 개발</strong></p>



<p class="wp-block-paragraph">기획자가 실제 게임에 들어갈 시스템을 직접 만들자는 이야기는 아니다.</p>



<p class="wp-block-paragraph">본격적인 구현에 들어가기 전에 내가 정의한 것이 정말 내가 생각한 대로 움직이는지 가장 싼 형태로 한번 시험해보자는 것이다.</p>



<p class="wp-block-paragraph">《기획자의 시대가 온다》에서도 비슷한 이야기를 한다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">“완성된 시스템을 기다리지 말고, 작은 프로토타입이나 작은 데이터 샘플로 확인부터 하는 것입니다.”<br><br><em>— <em>위 책, </em>본문 &#8216;그림과 코드의 간극&#8217; 中</em></p>
</blockquote>



<p class="wp-block-paragraph">직접 프로토타입을 만들어보면 여기에서 한 가지를 더 발견하게 된다.</p>



<p class="wp-block-paragraph">프로토타입이 보여주는 것은 단순한 오류만이 아니다.</p>



<p class="wp-block-paragraph">머릿속이나 문서 안에서는 그럴듯했던 기획 자체의 복잡성도 함께 드러난다.</p>



<p class="wp-block-paragraph">문장 몇 줄로 쓸 때는 단순해 보였던 기능이 실제로 눌러보니 너무 많은 단계를 요구할 수도 있다.</p>



<p class="wp-block-paragraph">플로우차트에서는 깔끔했던 구조가 실제 화면에서는 사람이 따라가기 어려울 수도 있다.</p>



<p class="wp-block-paragraph">그리고 내가 생각한 조건을 전부 화면에 펼쳐놓는 순간, “내가 이렇게까지 복잡하게 만들고 있었나?” 싶은 장면을 만나기도 한다.</p>



<p class="wp-block-paragraph">프로토타입이 복잡성을 없애주는 것은 아니다.</p>



<p class="wp-block-paragraph">오히려 문서 안에 숨어 있던 복잡성을 눈앞에 펼쳐 보일 때가 있다.</p>



<p class="wp-block-paragraph">그래서 빠르게 만드는 것만큼 빠르게 고치고, 필요하다면 버릴 수 있다는 점이 중요하다.</p>



<p class="wp-block-paragraph">기획이 틀렸다면 가능한 한 싼 단계에서 틀렸다는 것을 아는 편이 낫다.</p>



<h3 id="%ea%b8%b0%ed%9a%8d%ec%84%9c%ea%b0%80-%ec%82%ac%eb%9d%bc%ec%a7%80%eb%8a%94-%ea%b2%83%ec%9d%80-%ec%95%84%eb%8b%88%eb%8b%a4" class="wp-block-heading">기획서가 사라지는 것은 아니다</h3>



<p class="wp-block-paragraph">그렇다고 앞으로 기획서를 쓰지 않게 될 것이라고 생각하지는 않는다.</p>



<p class="wp-block-paragraph">프로토타입과 기획서는 잘하는 일이 다르다.</p>



<p class="wp-block-paragraph">프로토타입은 사용 흐름과 인터랙션을 빠르게 보여주는 데 좋다.</p>



<p class="wp-block-paragraph">반면 상세한 규칙과 예외 조건, 데이터 구조와 정책, 변경 이력을 남기는 일에는 여전히 문서가 훨씬 편하다.</p>



<p class="wp-block-paragraph">프로토타입에서 버튼 하나가 잘 작동한다고 해서 그 기능에 존재하는 모든 조건과 예외를 설명할 수 있는 것도 아니다.</p>



<p class="wp-block-paragraph">몇 달 뒤 왜 그런 결정을 했는지 찾아봐야 할 때도 있고, 구현된 결과가 처음 합의했던 내용과 얼마나 다른지 비교해야 할 때도 있다.</p>



<p class="wp-block-paragraph">그럴 때 기록은 반드시 필요하다.</p>



<p class="wp-block-paragraph">그래서 프로토타입과 기획서는 서로를 대체하는 관계라기보다 역할을 나눠 갖는 관계에 가깝다.</p>



<p class="wp-block-paragraph">다만 앞으로는 둘의 비중이 조금 달라질 수 있다고 생각한다.</p>



<p class="wp-block-paragraph">초기 리뷰에서 긴 문서를 처음부터 끝까지 읽는 대신, 작은 프로토타입을 먼저 눌러본 뒤 필요한 규칙을 문서에서 확인하는 편이 더 좋은 경우도 있을 것이다.</p>



<p class="wp-block-paragraph">아이디어를 설명하기에 문서보다 좋은 방법이 있다면 굳이 문서만을 고집할 이유도 없다.</p>



<p class="wp-block-paragraph"><strong>기획서가 사라지는 것이 아니다. 기획서만이 기획자의 유일한 산출물이 아니게 되는 것이다.</strong></p>



<h3 id="%ec%a7%81%ec%a0%91-%eb%a7%8c%eb%93%9c%eb%8a%94-%ea%b2%83%ea%b3%bc-%ed%98%bc%ec%9e%90-%eb%a7%8c%eb%93%9c%eb%8a%94-%ea%b2%83%ec%9d%80-%eb%8b%a4%eb%a5%b4%eb%8b%a4" class="wp-block-heading">직접 만드는 것과 혼자 만드는 것은 다르다</h3>



<p class="wp-block-paragraph">여기에는 분명한 경계도 있다.</p>



<p class="wp-block-paragraph">몇 번 버튼을 눌러볼 수 있는 HTML 프로토타입과 실제 게임에 들어가는 시스템은 전혀 다른 물건이다.</p>



<p class="wp-block-paragraph">실제 개발에서는 성능과 안정성, 기존 시스템과의 연동, 데이터 구조, 확장성, 유지보수처럼 프로토타입 단계에서는 대충 넘어갈 수 있었던 문제들이 중요해진다.</p>



<p class="wp-block-paragraph">AI가 만들어준 코드 역시 마찬가지다.</p>



<p class="wp-block-paragraph">실행된다고 해서 잘 만들어진 코드라는 뜻은 아니다.</p>



<p class="wp-block-paragraph">자신이 제대로 검증하지 못하는 코드를 그대로 프로젝트에 넣는 것은 위험하다. 회사 내부의 기획서나 미공개 데이터를 외부 AI 서비스에 입력할 수 있는지도 조직의 정책부터 확인해야 한다.</p>



<p class="wp-block-paragraph">개인이 만든 작은 도구가 늘어나는 것도 무조건 좋은 일만은 아니다.</p>



<p class="wp-block-paragraph">반복 업무를 줄이려고 만든 프로그램을 만든 사람만 이해하고 수정할 수 있다면, 문제를 해결한 게 아니라 다른 형태의 사일로를 만든 것일지도 모른다.</p>



<p class="wp-block-paragraph">만든 사람이 떠났다고 아무도 손대지 못하는 도구라면, 결국 다른 방식으로 일을 한 사람에게 묶어둔 셈이다.</p>



<p class="wp-block-paragraph">결국 중요한 질문은 “기획자가 어디까지 만들 수 있는가”가 아니다.</p>



<p class="wp-block-paragraph">《기획자의 시대가 온다》에서는 이렇게 표현한다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">“이 경계에서 가장 중요한 질문이 ‘어디까지 직접 하고 어디서 협업할 것인가’입니다.”<br>“어디까지 직접 하느냐는 능력의 문제가 아니라 목적의 문제입니다.”<br><br><em>— 위 책, 본문 &#8216;어디까지 직접 하고, 어디서 협업할 것인가&#8217; 中</em></p>
</blockquote>



<p class="wp-block-paragraph">나는 이 표현이 꽤 마음에 들었다.</p>



<p class="wp-block-paragraph">기획자가 무언가를 만드는 이유는 개발자의 일을 대신하기 위해서가 아니다.</p>



<p class="wp-block-paragraph">내가 생각한 것을 더 빨리 확인하고, 다른 사람에게 더 정확하게 보여주고, 조금 더 구체적인 상태에서 대화를 시작하기 위해서다.</p>



<p class="wp-block-paragraph">이건 개발자와의 협업에만 해당되는 이야기도 아니다.</p>



<p class="wp-block-paragraph">아트를 글로 설명하다 보면 “조금 어둡지만 음침하지 않았으면 좋겠다”거나 “동양 판타지이지만 지나치게 전통적으로 보이지 않았으면 한다”는 식의 문장을 쓰게 된다.</p>



<p class="wp-block-paragraph">쓴 사람의 머릿속에는 꽤 구체적인 그림이 있다.</p>



<p class="wp-block-paragraph">문제는 그 글을 읽은 사람이 같은 그림을 보고 있다는 보장이 없다는 것이다.</p>



<p class="wp-block-paragraph">예전에는 비슷한 레퍼런스를 여러 장 찾아 붙이거나 직접 러프를 그렸다. 이제는 생성형 AI로 대략적인 분위기를 만들어,</p>



<p class="wp-block-paragraph">“최종 결과물이 이 이미지여야 한다는 뜻은 아니지만, 내가 생각하는 방향은 이쪽에 가깝다.”</p>



<p class="wp-block-paragraph">라고 보여줄 수도 있다.</p>



<p class="wp-block-paragraph">여기에서도 AI 이미지 자체가 결과물일 필요는 없다.</p>



<p class="wp-block-paragraph">서로 다른 머릿속에 있던 것을 조금 더 구체적인 상태에서 이야기할 수 있게 만들어주는 것만으로 역할은 충분하다.</p>



<p class="wp-block-paragraph">도구가 늘어난다고 모든 것을 혼자 해야 하는 것은 아니다.</p>



<p class="wp-block-paragraph">오히려 무엇을 만들고, 어디서 멈추고, 언제 다른 사람과 함께 만들어갈지 판단하는 일이 더 중요해진다.</p>



<hr class="wp-block-separator has-alpha-channel-opacity"/>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h2 id="%ea%b8%80%ec%9d%84-%eb%a7%88%ec%b9%98%eb%a9%b0" class="wp-block-heading">글을 마치며</h2>



<h3 id="%eb%82%b4-%ec%8b%9c%ea%b0%84%ec%9d%84-%eb%90%98%ec%b0%be%eb%8a%94-%ec%9d%bc" class="wp-block-heading">내 시간을 되찾는 일</h3>



<p class="wp-block-paragraph">《기획자의 시대가 온다》에서 가장 오래 기억에 남은 문장은 이것이었다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">“내 일상과 업무에서 반복적으로 시간을 잡아먹는 것, ‘누군가가 해주면 좋겠는데’ 결국 내가 끝까지 떠안는 것, 그 불편함의 꼭짓점을 하나씩 찔러보는 것부터 시작하는 것입니다. 바로 ‘생활코딩’입니다. 생활코딩은 결국 ‘코드를 배우는 일’이 아니라 ‘내 시간을 되찾는 일’입니다.”<br><br><em>— 본문 &#8216;거창한 프로젝트는 필요 없다&#8217; 中</em></p>
</blockquote>



<p class="wp-block-paragraph">‘내 시간을 되찾는 일.’</p>



<p class="wp-block-paragraph">이 표현이 특히 마음에 남았다.</p>



<p class="wp-block-paragraph">나 역시 팀 리더를 맡았을 때 야근을 밥 먹듯이 하고, 주말에도 출근하며 일했던 시기가 있었다.</p>



<p class="wp-block-paragraph">당시에는 해야 할 일이 너무 많아서 눈앞에 있는 것을 하나씩 처리하기에도 급급했다.</p>



<p class="wp-block-paragraph">그런데 지금 돌아보면 그 시간을 모두 게임을 더 재미있게 만드는 데 사용했던 것은 아니었다.</p>



<p class="wp-block-paragraph">팀을 관리해야 했다.</p>



<p class="wp-block-paragraph">방향을 정리해야 했다.</p>



<p class="wp-block-paragraph">오래된 문서를 최신 상태로 유지해야 했고, 여러 곳에 흩어진 논의의 히스토리를 다시 찾아 정리해야 했다.</p>



<p class="wp-block-paragraph">예전에 왜 이런 결정을 했는지 찾아서 다른 사람에게 설명하는 데에도 적지 않은 시간을 썼다.</p>



<p class="wp-block-paragraph">물론 그런 일들이 필요하지 않았던 것은 아니다.</p>



<p class="wp-block-paragraph">누군가는 해야 했다.</p>



<p class="wp-block-paragraph">문제는 그 ‘누군가’가 계속 나였다는 것이다.</p>



<p class="wp-block-paragraph">다른 사람에게 맡기고 싶어도 왜 이런 구조가 만들어졌는지, 예전에 어떤 논의를 했는지, 지금 무엇을 유지해야 하는지를 가장 많이 알고 있는 사람이 나인 경우가 많았다.</p>



<p class="wp-block-paragraph">결국 가장 많은 맥락을 가진 사람이 가장 많은 반복 업무까지 떠안게 된다.</p>



<p class="wp-block-paragraph">바이브 코딩이 이런 문제를 모두 해결해줄 거라고 생각하지는 않는다.</p>



<p class="wp-block-paragraph">다만 예전에는 “사람이 직접 해야 하는 일”이라고 당연하게 받아들였던 것 중 일부를 다른 방식으로 해결해볼 수 있는 선택지는 생겼다.</p>



<p class="wp-block-paragraph">매번 손으로 확인하던 데이터를 대신 검사해주는 도구일 수도 있다.</p>



<p class="wp-block-paragraph">여러 문서에 흩어진 내용을 한곳에 모아주는 작은 페이지일 수도 있다.</p>



<p class="wp-block-paragraph">매번 30분씩 걸리던 일을 버튼 한 번으로 줄일 수 있다면 그것만으로도 충분하다.</p>



<p class="wp-block-paragraph">그렇게 하루의 10분, 30분을 하나씩 되찾을 수 있다면 언젠가는 그 시간을 내가 정말 하고 싶었던 창조적인 일에 다시 사용할 수 있을 것이다.</p>



<h3 id="%ec%bd%94%eb%94%a9%ec%9d%b4%eb%9d%bc%eb%8a%94-%eb%ac%b8%ed%84%b1%ec%9d%84-%eb%84%98%ec%96%b4%eb%b3%b4%ea%b8%b0" class="wp-block-heading">코딩이라는 문턱을 넘어보기</h3>



<figure class="wp-block-image aligncenter size-full"><img decoding="async" width="547" height="495" src="https://subculturegamer.com/wp-content/uploads/2026/10/image.png" alt="game-designer-vibe-coding-2" class="wp-image-24671" srcset="https://subculturegamer.com/wp-content/uploads/2026/10/image.png 547w, https://subculturegamer.com/wp-content/uploads/2026/10/image-300x271.png 300w" sizes="(max-width: 547px) 100vw, 547px" /><figcaption class="wp-element-caption">국내 유명 콘솔 IP를 기반으로 창작 퀘스트를 노드 형태로 구현하기 위한 Claude Code RND</figcaption></figure>



<p class="wp-block-paragraph">나 역시 예전에 Claude Code를 이용해 노드 기반의 퀘스트 기획 도구를 만들어본 적이 있다.</p>



<p class="wp-block-paragraph">시작은 단순한 불편이었다.</p>



<p class="wp-block-paragraph">퀘스트를 기획할 때는 엑셀이나 스프레드시트에 데이터를 직접 입력한 뒤 엔진에서 결과를 확인하는 경우가 많다.</p>



<p class="wp-block-paragraph">전체 흐름을 설명해야 할 때는 별도의 플로우차트를 만들거나 손으로 그림을 그리기도 한다.</p>



<p class="wp-block-paragraph">퀘스트가 단순할 때는 큰 문제가 없다.</p>



<p class="wp-block-paragraph">하지만 조건과 분기가 늘어나면 얘기가 달라진다.</p>



<p class="wp-block-paragraph">스프레드시트만 보고 전체 흐름을 파악하기가 어려워지고, 다른 부서에 “여기에서 갈라졌다가 왜 다시 이곳에서 합쳐지는지” 설명하는 일도 점점 번거로워진다.</p>



<p class="wp-block-paragraph">그래서 이런 생각을 했다.</p>



<p class="wp-block-paragraph">데이터를 입력하면서 동시에 전체 퀘스트의 흐름을 노드로 볼 수 있다면 어떨까.</p>



<p class="wp-block-paragraph">스프레드시트와 데이터를 주고받을 수 있고, 내부 데이터는 JSON으로 저장해 버전 관리와 diff, merge까지 할 수 있으면 더 좋겠다고 생각했다.</p>



<p class="wp-block-paragraph">문제는 만들기 시작한 뒤부터였다.</p>



<p class="wp-block-paragraph">노드는 어떻게 연결할지, 내용이 길어진 노드는 어디까지 보여줄지, 화면에 노드가 많아졌을 때 어떻게 이동할지.</p>



<p class="wp-block-paragraph">처음에는 퀘스트 기획을 편하게 하려고 만들기 시작했는데, 어느 순간부터 퀘스트보다 노드 기반의 툴을 어떻게 써야 덜 불편한가를 더 오래 고민하고 있었다.</p>



<p class="wp-block-paragraph">그리고 예상하지 못했던 사실도 하나 발견했다.</p>



<p class="wp-block-paragraph">나는 처음에 노드로 시각화하면 복잡한 퀘스트도 훨씬 단순하고 직관적으로 보일 거라고 생각했다.</p>



<p class="wp-block-paragraph">어느 정도는 맞았다.</p>



<p class="wp-block-paragraph">어떤 퀘스트가 어디에서 갈라지고 다시 어디에서 합쳐지는지 한눈에 보기 쉬웠고, 다른 사람에게 설명하는 데에도 스프레드시트보다 훨씬 편했다.</p>



<p class="wp-block-paragraph">하지만 내가 기획하고 있던 디테일을 하나씩 화면에 넣기 시작하자 이야기가 달라졌다.</p>



<p class="wp-block-paragraph">조건과 예외, 데이터와 부가 정보를 모두 보여주려고 하니 노드 역시 빠르게 복잡해졌다.</p>



<p class="wp-block-paragraph">시각화했는데도 복잡했다.</p>



<p class="wp-block-paragraph">처음에는 툴이 잘못된 줄 알았다.</p>



<p class="wp-block-paragraph">그런데 곰곰이 보다 보니 꼭 툴만의 문제는 아니었다.</p>



<p class="wp-block-paragraph">내가 만든 구조 자체가 복잡했던 것이다.</p>



<p class="wp-block-paragraph">시각화한다고 해서 복잡한 기획이 자동으로 단순해지는 것은 아니었다.</p>



<p class="wp-block-paragraph">오히려 내가 만든 구조가 얼마나 복잡한지를 더 솔직하게 보여줄 때도 있었다.</p>



<p class="wp-block-paragraph">그러다 보니 다시 기획의 문제로 돌아왔다.</p>



<p class="wp-block-paragraph">이 화면을 보는 사람에게 지금 정말 필요한 정보는 무엇인지.</p>



<p class="wp-block-paragraph">어떤 조건은 반드시 보여줘야 하고, 어떤 조건은 숨겨도 되는지.</p>



<p class="wp-block-paragraph">지금 협업 부서와 논의해야 할 것은 무엇이고, 어떤 내용은 과감하게 생략해도 되는지.</p>



<p class="wp-block-paragraph">툴을 만들면서 오히려 <strong>무엇을 보여주지 않을 것인지 정하는 것 역시 기획이라는 사실</strong>을 다시 생각하게 됐다.</p>



<p class="wp-block-paragraph">이 경험 이후 내가 바이브 코딩을 보는 시선도 조금 달라졌다.</p>



<p class="wp-block-paragraph">처음에는 단순히 기획자가 작은 프로그램을 직접 만들 수 있게 해주는 도구라고 생각했다.</p>



<p class="wp-block-paragraph">지금은 조금 다르게 생각한다.</p>



<p class="wp-block-paragraph">무언가를 만들어보면 내 생각을 검증하는 방식이 달라진다.</p>



<p class="wp-block-paragraph">문서에서는 별문제 없어 보였던 구조를 실제 형태로 펼쳐볼 수 있고, 복잡하다면 복잡하다는 사실을 더 빨리 알아차릴 수 있다.</p>



<p class="wp-block-paragraph">다른 사람에게 무엇을 보여줘야 하는지도 다시 생각하게 된다.</p>



<p class="wp-block-paragraph">그리고 내가 계속 반복하면서 시간을 빼앗기던 문제 중 일부는 작은 도구로 떼어낼 수도 있다.</p>



<p class="wp-block-paragraph">기획자가 반드시 프로그래머가 될 필요는 없다.</p>



<p class="wp-block-paragraph">AI가 기획자를 개발자로 만들어주는 것도 아니다.</p>



<p class="wp-block-paragraph">다만 그동안 머릿속이나 문서 안에서만 다뤘던 것을 실제 형태로 만들어보고, 조금 더 일찍 확인하고, 조금 더 구체적인 상태에서 다른 사람과 이야기할 수 있는 방법이 하나 더 생겼다.</p>



<p class="wp-block-paragraph">앞으로 좋은 기획자를 가르는 기준이 얼마나 많은 것을 혼자 만들 수 있느냐는 아닐 것이다.</p>



<p class="wp-block-paragraph">무엇을 직접 만들어볼 것인지.</p>



<p class="wp-block-paragraph">무엇을 보여줄 것인지.</p>



<p class="wp-block-paragraph">무엇은 과감히 생략할 것인지.</p>



<p class="wp-block-paragraph">그리고 어디에서 다른 사람과 함께 만들어갈 것인지.</p>



<p class="wp-block-paragraph">어쩌면 그것이 기획서 다음에 우리가 해야 할 또 다른 기획일지도 모른다.</p>



<p class="wp-block-paragraph"></p>

