---
title: "클로드만 쓰던 게임 기획자가 ChatGPT를 병행하게 된 이유: LLM 교차검증 워크플로우"
url: https://subculturegamer.com/game-planning-ai-cross-validation-gpt-claude/
published: 2026-07-19
categories: ["게임 디자인"]
tags: ["내러티브 디자인", "로어 디자인", "생성형 AI"]
related_posts:
  - ai-game-design-gdc-2026-trends
  - ndc-2026-insights-from-3-session
  - game-narrative-designer-ai-survival-guide
  - 2026-10-04-game-designer-vibe-coding
wiki_refs:
  - wiki/concepts/ai-game-design
  - wiki/concepts/narrative-design
  - wiki/series-threads/ai-tools-for-game-development-hub
series: ""
series_order: null
---

<figure class="wp-block-image size-large"><img decoding="async" width="1024" height="1024" src="https://subculturegamer.com/wp-content/uploads/2026/07/game-planning-ai-cross-validation-gpt-claude-1024x1024.png" alt="Game Planning Ai Cross Validation Gpt Claude" class="wp-image-24508" srcset="https://subculturegamer.com/wp-content/uploads/2026/07/game-planning-ai-cross-validation-gpt-claude-1024x1024.png 1024w, https://subculturegamer.com/wp-content/uploads/2026/07/game-planning-ai-cross-validation-gpt-claude-300x300.png 300w, https://subculturegamer.com/wp-content/uploads/2026/07/game-planning-ai-cross-validation-gpt-claude-768x768.png 768w, https://subculturegamer.com/wp-content/uploads/2026/07/game-planning-ai-cross-validation-gpt-claude.png 1254w" sizes="(max-width: 1024px) 100vw, 1024px" /></figure>



<p class="wp-block-paragraph">새 회사에 입사한 뒤, 가장 먼저 인상적이었던 것 중 하나는 <strong>AI 활용에 대한 회사의 적극적인 지원</strong>이었다.</p>



<p class="wp-block-paragraph">회사에서는 직원들이 Gemini와 Claude를 업무에 활용할 수 있도록 지원하고 있었다. 또한 사내 AI 활용 경험담 등을 공유하거나, 사내 메신저로 AI 관련 방을 따로 마련하는 등, 소통의 창구가 언제든지 열려 있었다.</p>



<p class="wp-block-paragraph">나는 시나리오 라이터로 입사했고, 첫 업무로 새 시나리오를 쓰기 위한 컨셉 기획을 맡았다. 자연스럽게 Claude를 주력 도구로 사용했다. 입사 전부터 Claude Skills, Claude Code 등 다양한 Claude 도구와 작업 환경에 익숙해져 있었고, 특히 다양한 LLM 중에서 Claude가 가장 글쓰기에 최적화되어 있다는 평가를 받고 있었기 때문이다.</p>



<p class="wp-block-paragraph"><strong>하지만 첫 업무를 진행하면서 두 가지 한계에 부딪혔다. 그리고 그 경험은 내가 Claude, 나아가 LLM을 쓰는 방식을 완전히 바꿔 놓았다.</strong></p>



<p class="wp-block-paragraph">이제 AI 활용은 사실상 선택이 아니라 필수가 됐다.</p>



<p class="wp-block-paragraph">필자도 몇 달간의 취업 준비 기간 동안 포트폴리오와 씨름하느라 많은 시간을 소모했는데, 결과적으로는 긴 미취업 기간을 끝낼 수 있었던 건 AI 활용 능력 포트폴리오를 보충한 덕분이었다.</p>



<p class="wp-block-paragraph">그러나 실무 최전선에서조차 어떻게 AI를 사용해야 업무 효율을 높이고 작업물의 질적 향상을 이룰 수 있는지 그 노하우는 여전히 부족했다.</p>



<p class="wp-block-paragraph">이 글은 실무에서 부딪혀 좌절한 필자가 LLM 교차검증이라는 방식을 통해 실무의 벽을 넘어서고 더 나은 결과물을 얻게 되기까지의 일화를 소개한다.</p>



<p class="wp-block-paragraph">이 글의 사례는 AI를 실무에 활용하는 기획자라면 누구나 한 번쯤 겪을 수도 있을 고민이나 실패라고 생각한다. 이 글이 AI를 실무 최전선에서 활용하는 게임 기획자, 시나리오 라이터, 나아가 모든 AI를 활용하는 분들께 도움이 되길 바란다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">이 글은 2026년 7월 당시 내가 사용하던 서비스와 작업 환경을 기준으로 한 경험담이다. 모델 버전과 요금제, 프롬프트, 작업 종류에 따라 체감은 달라질 수 있다.</p>
</blockquote>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h2 id="%25eb%2591%2590-%25eb%25b2%2588%25ec%259d%2598-%25ec%25a2%258c%25ec%25a0%2588-ai%25eb%25a5%25bc-%25ec%258b%25a4%25eb%25ac%25b4%25ec%2597%2590-%25ec%25a0%2581%25ec%259a%25a9%25ed%2595%2598%25ea%25b8%25b0%25ea%25b9%258c%25ec%25a7%2580%25ec%259d%2598-%25ec%258b%259c%25ed%2596%2589%25ec%25b0%25a9%25ec%2598%25a4" class="wp-block-heading">두 번의 좌절: AI를 실무에 적용하기까지의 시행착오</h2>



<h3 id="%25ec%25b2%25ab-%25eb%25b2%2588%25ec%25a7%25b8-%25ec%25a2%258c%25ec%25a0%2588-%25ec%259e%2590%25eb%25a3%258c%25ec%2599%2580-%25ea%25b0%259c%25eb%25b0%259c-%25ed%259e%2588%25ec%258a%25a4%25ed%2586%25a0%25eb%25a6%25ac%25ea%25b0%2580-%25eb%25b6%2580%25ec%25a1%25b1%25ed%2595%259c-%25eb%25a7%25a5%25eb%259d%25bd%25ec%259d%2598" class="wp-block-heading">첫 번째 좌절: 자료와 개발 히스토리가 부족한 ‘맥락의 단절’</h3>



<p class="wp-block-paragraph">처음 팀에 합류했을 때 맡은 일은 바로 그동안 팀이 축적해 온 기획서를 모두 정독하는 일이었다.</p>



<p class="wp-block-paragraph">방대한 문서를 연달아 읽는 일이 쉽지는 않았지만, 세계관과 설정을 충분히 이해해야 실무에 빠르게 적응할 수 있다고 생각해 꼼꼼히 읽어나갔다.</p>



<p class="wp-block-paragraph">본격적으로 실무를 맡게 되자 문제가 생기기 시작했는데, 바로 필자가 읽었던 문서 가운데 어떤 것은 구기획(레거시)이고, 어떤 것은 최신이었으며, 또 다른 어떤 것은 읽는 사람에 따라 내용을 오해하기 십상인 것이 모두 섞여 있었다는 점이었다.</p>



<p class="wp-block-paragraph">처음에는 문서를 꼼꼼히 읽지 않은 잘못이라고 생각했다. <strong>하지만 시간이 지날수록 진짜 문제는 &#8216;맥락의 단절&#8217;에 있다는 생각이 들었다.</strong></p>



<p class="wp-block-paragraph">나는 그 조직에 이제 막 들어간 신규 입사자다. 아무리 그동안의 문서를 읽는다고 해도, 나보다 먼저 들어와 실무의 최전선에서 일하는 사람만큼의 이해도를 갖추는 건 현실적으로 어렵다.</p>



<p class="wp-block-paragraph">더 큰 문제는, 과거 회의에서 내려진 결론, 다른 기획서가 전제하는 내용, 이미 제작된 콘텐츠의 관성, 오래 함께 일한 팀원들이 암묵적으로 공유하는 판단 기준 등, 입사 전부터 이어져 온 개발 히스토리를 따라갈 수 없다는 점이었다.</p>



<p class="wp-block-paragraph">이러한 점은 Claude도 마찬가지였다. 제 아무리 능력이 뛰어난 AI라고 해도, 모든 기획의 시발점과 개발 도중 사양이 변경되게 된 근본적인 이유를 모두 트래킹할 수는 없다. AI가 부족해서가 아니라, 그러한 &#8216;맥락&#8217;을 모조리 AI가 읽어올 수 있는 형태로 치환해두지 못했던 탓이다. </p>



<p class="wp-block-paragraph">그 결과, 나와 AI가 협업해서 내놓은 첫 작업물은 겉으로는 그럴싸했지만 우리 팀의 &#8216;암묵적인 기조&#8217;를 사전에 캐칭하지 못했고, 그 결과 전면 재작업하게 되는 사태로 이어졌다.</p>



<p class="wp-block-paragraph"><strong>만약 클로드가 조직 내 모든 기획의 역사를 파악할 수 있었다면 어땠을까?</strong></p>



<p class="wp-block-paragraph">노션이나 컨플루언스 같은 Wiki나 협업툴이 없더라도, 회의록·결정 로그·기획서·콘텐츠 레퍼런스처럼 이미 존재하는 자료부터 검색하고 참조할 수 있는 형태로 남겨야 한다고 생각하게 됐다. ‘무엇이 정해졌는가’만큼 ‘왜 그렇게 정해졌는가’도 중요하다. AI 활용은 모델 선택의 문제이기도 하지만, 그보다 먼저 <strong>우리 팀이 무엇을 알고 있고 그것을 어디에 남기고 있는가</strong>의 문제였다.</p>



<p class="wp-block-paragraph">이 문제는 뒤에서 이야기할 교차검증에도 그대로 이어진다. 모델을 둘 이상 쓰더라도 두 모델에 같은 부실한 전제만 건넨다면, 서로 다른 문장을 내놓을 뿐 결국 같은 빈틈을 반복할 수 있다. 교차검증이 제대로 작동하려면 모델의 다양성보다 먼저, 검토할 수 있는 맥락과 근거가 갖춰져야 한다.</p>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h3 id="%25eb%2591%2590-%25eb%25b2%2588%25ec%25a7%25b8-%25ec%25a2%258c%25ec%25a0%2588-%25ed%2595%2598%25eb%2582%2598%25ec%259d%2598-%25eb%25aa%25a8%25eb%258d%25b8%25ea%25b3%25bc-%25ec%2582%25ac%25ec%259a%25a9%25ec%259e%2590%25ea%25b0%2580-%25ea%25b0%2599%25ec%259d%2580-%25eb%25b0%25a9%25ed%2596%25a5%25ec%259c%25bc%25eb%25a1%259c" class="wp-block-heading">두 번째 좌절: 하나의 모델과 사용자가 같은 방향으로 굳어지는 ‘긍정 편향’</h3>



<p class="wp-block-paragraph">또 하나의 문제는 계속 Claude만을 사용했을 때 생겼다.</p>



<p class="wp-block-paragraph">기획을 하다보니 어느 순간부터 스스로 의심이 들기 시작했다. 이 캐릭터의 동기가 정말 자연스러운가? 이 전개가 게임의 전체적인 방향성과 맞는가? 이 설정은 나한테는 재밌어 보이지만 남들이 보기에도 충분히 흥미를 끌 만한가?</p>



<p class="wp-block-paragraph">의구심이 깊어질수록 내게 정말로 필요했던 건 내 기획을 지지해주고 칭찬해주는 &#8216;서포터&#8217;보다는 아예 내 기획을 뿌리째 무너뜨릴 수도 있을 정도의 날카로운 &#8216;비판자&#8217;였다. 하지만 나는 Claude와 함께 이미 오랜 기획을 같이 해왔고, 내 기획이 곧 Claude의 기획이 된 지 오래였다. 이러한 환경에서는 내가 기획에 의구심을 품는다고 해도 소용이 없었다. Claude는 기획 방향성을 근본부터 뒤집기보다는, 지금까지 이어온 기획의 정합성을 보완하는 식으로 답해오고 있었기 때문이다.</p>



<p class="wp-block-paragraph">물론 그 자체가 잘못은 아니다. 초안을 발전시키는 과정에서는 아무래도 처음부터 의욕을 꺾어버리는 과도한 비판자보다는, 일단 뭐라도 결과물을 만드는 데 보탬이 되는 긍정적인 조력자가 더 유용하다고 볼 수 있기 때문이다.</p>



<p class="wp-block-paragraph"><strong>문제는, 나와 Claude라는 끈끈한 기획 공동체의 작업물을 비판해 줄 객관적인 제3의 시각이 결여되어 있었다는 점이다.</strong></p>



<p class="wp-block-paragraph">나 역시 스멀스멀 올라오는 의심을 Claude의 낙관적인 답변으로 해소하려 했다. AI의 답변을 반증이 아니라 확신을 강화하는 근거로 받아들이면서, 스스로 긍정 편향에 빠진 셈이었다.</p>



<p class="wp-block-paragraph">회사에는 나 말고도 유사한 업무를 하는 동료들이 있고 사수나 상사에게 물어볼 수도 있겠지만, 어느 정도는 나 스스로 정리가 된 채 피드백을 받고 싶었다. 이것이 패착이 됐다.</p>



<p class="wp-block-paragraph">나는 기획이 팀에 공유할 만한 수준에 도달했다고 판단했다. 심지어 기획이 통과될 것이라고 예상하고, 그 기획을 바탕으로 한 후속 작업까지 미리 시작했다. 그러나 회의에서는 세부적인 보완이 아니라 출발점부터 다시 검토해야 한다는 피드백을 받았다. 미리 진행한 후속 작업도 대부분 되돌려야 했다.</p>



<p class="wp-block-paragraph">나는 ‘우물 안 개구리’가 된 기분이었다. </p>



<p class="wp-block-paragraph">내 기획은 출발점부터 다시 검토해야 했지만, 나는 AI가 보완해 준 정합성을 기획 자체의 타당성으로 착각했다. 나의 기획이 Claude의 전제가 되고, Claude의 답변이 다시 나의 확신을 강화하는 순환이 만들어진 시점에서 이미 객관적인 검토는 어려워진 셈이었다.</p>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h2 id="%25eb%25b3%25b4%25ec%2599%2584%25ec%25b1%2585-%25eb%25a0%2588%25eb%2593%259c%25ed%258c%2580-%25ec%259e%2584%25eb%25aa%2585%25ed%2595%2598%25ea%25b8%25b0" class="wp-block-heading">보완책: 레드팀 임명하기</h2>



<h3 id="gemini%25ec%2597%2590%25ea%25b2%258c-claude%25eb%25a5%25bc-%25ea%25b9%258c%25eb%259d%25bc%25ea%25b3%25a0-%25eb%25aa%2585%25eb%25a0%25b9%25ed%2595%2598%25eb%258b%25a4" class="wp-block-heading">Gemini에게 Claude를 까라고 명령하다</h3>



<p class="wp-block-paragraph">기획서를 완전히 엎는 뼈저린 경험 끝에, 나는 이대로는 안 된다고 확신했다.</p>



<p class="wp-block-paragraph">첫 번째 실패를 통해서는 AI가 참조할 수 있는 맥락과 근거를 정리해야 한다는 사실을 배웠다. 두 번째 실패를 통해서는 충분한 맥락을 제공하는 것만으로는 부족하며, 작성자와 검토자의 역할을 분리해야 한다는 사실을 배웠다.</p>



<p class="wp-block-paragraph">결국 실무에서 필요했던 것은 ‘좋은 모델 하나’가 아니라, 동일한 근거를 공유하되 서로 다른 역할을 맡는 검토 구조였다.</p>



<p class="wp-block-paragraph">Claude라는 든든한 우군을 가장 날카롭게 비판하는 제3의 시각이 필요했다. 이는 Claude의 성능이 떨어지거나 그 답변을 믿을 수 없어서가 아니라, 하나의 모델과 사용자가 같은 방향으로 굳어지는 것을 막기 위한 방법이었다.</p>



<p class="wp-block-paragraph">그래서 회사에서 지원하는 Gemini에게 Claude의 기획을 검토시키기 시작했다.</p>



<p class="wp-block-paragraph">당시 회사에서 제공받아 사용할 수 있었던 Gemini 3.5 Flash로 실험을 해보았다. (다만 이 비교는 동급 모델 간의 성능 평가가 아니라, 내가 실제로 접근할 수 있었던 업무 환경 안에서의 체험이라는 점을 먼저 밝혀둔다.)</p>



<p class="wp-block-paragraph">방식은 단순했다. 먼저 Claude를 이용해 컨셉 기획 초안을 만들고, Gemini에게 컨셉 기획을 검토하게 하면서 피드백을 요청하는 것이다. 그러면 Gemini가 답변한 내용(피드백)을 받아서 고스란히 Claude에게 넘겨 그 피드백의 타당성을 검토하는 식이었다.</p>



<p class="wp-block-paragraph">처음에는 이것만으로 충분할 것 같았다. 어느 하나의 LLM이 놓친 것은 다른 LLM이 잡아낼 수 있으리라 생각했다. 두 LLM이 동일한 문제를 지적한다면 우선적으로 검토할 신호가 될 수 있고, 서로 상반된 의견을 낸다면 그 차이가 어디에서 비롯됐는지 내가 직접 판단하면 된다고 생각했다.</p>



<p class="wp-block-paragraph"><strong>하지만 Claude × Gemini의 LLM 교차검증은 내 기대만큼 잘 작동하지 않았다.</strong></p>



<p class="wp-block-paragraph">내 프롬프트와 게임 컨셉 기획이라는 작업에서는 Gemini가 독립적인 반론을 제시하기보다 기존 기획의 장점을 재확인하는 경우가 많았다. 모델 자체의 절대적인 성능 문제라기보다는, 내가 필요로 했던 ‘공격적인 검토자’ 역할과 당시 사용 환경의 궁합이 좋지 않았다고 보는 편이 정확하다.</p>



<p class="wp-block-paragraph">결과적으로 내가 원했던 ‘독립적인 검토자’보다는, 기존 기획의 논리를 한 번 더 반복하는 역할에 가까웠다.</p>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h3 id="gpt%25ea%25b0%2580-%25eb%258b%25a4%25ed%2581%25ac%25ed%2598%25b8%25ec%258a%25a4%25eb%25a1%259c-%25eb%2596%25a0%25ec%2598%25a4%25eb%25a5%25b4%25eb%258b%25a4" class="wp-block-heading">GPT가 다크호스로 떠오르다</h3>



<p class="wp-block-paragraph">이에 필자는 Claude의 맞상대를 Gemini에서 ChatGPT로 바꿔보았다.</p>



<p class="wp-block-paragraph">Claude를 바꾼다는 것은 생각하지 않았다. 당시 주변에서는 Claude를 주로 쓰는 사람이 훨씬 많았고, 회사에서도 Claude가 익숙한 도구였다. 나 역시 처음에는 Claude가 글을 잘 써 준다는 이유로 굳이 다른 선택지를 찾아야 할 필요를 크게 느끼지 못했다.</p>



<p class="wp-block-paragraph">그런데 GPT로 기획을 검토해 보면서 체감이 달라졌다. GPT의 답변이 항상 더 정답에 가까웠던 것은 아니다. 다만 내가 다루던 게임 컨셉 기획과 시나리오 검토에서는, 기존의 Claude나 Gemini는 물론이고 필자조차 캐치하지 못했던 기획의 빈틈이나 논리적 정합성을 GPT는 매끄럽게 잡아냈다.</p>



<p class="wp-block-paragraph">답변의 길이도 분명 체감되는 차이였지만(기존 Claude에 비해 하나의 질문에 대해 많게는 5배 정도 분량의 답변을 해준 적도 있다), 단순히 길어서 좋았다는 뜻은 아니다. 그 분량이 누락된 전제와 대안별 비교와 차이점 검토, 예상되는 반론을 구체적으로 짚는 데 쓰였다는 점이 내게는 중요했다.</p>



<p class="wp-block-paragraph">사용량 한도와 작업의 지속성에서도 GPT가 내 업무 환경에는 더 잘 맞았다. Claude를 쓸 때는 5시간 초기화 시간을 기다리며 마지못해 AI 연관성이 낮은 다른 업무를 해야 하는 경우가 많았다. 그런데 GPT는 적어도 당시 내가 사용하던 ChatGPT Pro 요금제와 GPT-5.6 Sol의 Medium에서는, 긴 문서를 다루거나 여러 번 수정안을 비교할 때 Claude Opus의 사용량 한계보다 덜 부담스럽게 느껴졌다.</p>



<p class="wp-block-paragraph">이미지 생성 기능도 유용했다. 캐릭터 기획서를 작성할 때 이미지를 생성할 수 있다는 점은 컸다. 캐릭터의 인상, 의상, 구도, 연출 의도를 아티스트와 공유할 때 말로만 설명하면 해석이 크게 갈릴 수 있다. 실제로 기존 컨셉아트와 포즈 레퍼런스를 바탕으로 캐릭터의 자세를 시각화해 보니, 기획자가 의도한 방향을 훨씬 빠르게 만들어낼 수 있었다. 기존에는 핀터레스트에서 내가 원하는 이미지를 최대한 공들여서 찾았는데 그런 수고를 덜 수 있었다.</p>



<p class="wp-block-paragraph">(이때 생성한 이미지는 최종 컨셉아트를 대신하는 결과물이 아니라, 회사가 허용한 환경에서 기획 의도와 포즈를 전달하기 위한 내부 커뮤니케이션용 레퍼런스로 활용했다.)</p>



<p class="wp-block-paragraph">그렇게 두 모델의 역할은 자연스럽게 재배치됐다. 지금은 GPT를 먼저 사용해 기획을 확장하고 초안을 만들며, Claude에게는 그 기획의 다른 가능성이나 보완점을 찾게 하는 편이다. 처음 LLM 교차검증을 시험 삼아 해봤을 때는 이러한 결과로 이어지게 될 거라고는 전혀 생각지도 못했다.</p>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h2 id="%25eb%2582%25b4%25ea%25b0%2580-%25ec%25a7%2580%25ea%25b8%2588-%25ec%2593%25b0%25eb%258a%2594-llm-%25ea%25b5%2590%25ec%25b0%25a8%25ea%25b2%2580%25ec%25a6%259d-%25eb%25b0%25a9%25ec%258b%259d" class="wp-block-heading">내가 지금 쓰는 LLM 교차검증 방식</h2>



<p class="wp-block-paragraph">LLM 교차검증은 거창한 방법이 아니다. 오히려 누구나 따라할 수 있을 정도로 아주 간단하다. (물론 가장 큰 허들은 최소한 두 개의 LLM을 구독하고 있어야 한다는 점이다.)</p>



<p class="wp-block-paragraph">핵심은 한 모델에게 ‘작성 주체’와 ‘판단 주체’를 모두 맡기지 않는 것이다.</p>



<p class="wp-block-paragraph">실제 업무 자료를 AI에 입력할 때는 회사가 허용한 도구와 계정, 보안 정책을 우선했다. 이 글에서 소개하는 사례와 프롬프트는 내부 설정이나 실제 지시 사항이 드러나지 않도록 일반적인 형태로 다시 작성했다.</p>



<hr class="wp-block-separator has-alpha-channel-opacity is-style-dots"/>



<h4 id="0-%25eb%2591%2590-llm%25ec%2597%2590-%25eb%258f%2599%25ec%259d%25bc%25ed%2595%259c-%25eb%25a7%25a5%25eb%259d%25bd%25ea%25b3%25bc-%25ed%258c%2590%25eb%258b%25a8-%25ea%25b8%25b0%25ec%25a4%2580%25ec%259d%2584-%25ec%25a0%259c%25ea%25b3%25b5%25ed%2595%259c%25eb%258b%25a4" class="wp-block-heading">0. 두 LLM에 동일한 맥락과 판단 기준을 제공한다</h4>



<p class="wp-block-paragraph">교차검증을 시작하기 전에 최신 기획서, 확정된 설정, 변경된 사양, 관련 결정의 근거를 정리해 두 모델에 동일하게 제공한다. 자료마다 최신 여부와 확정 여부를 구분하고, 서로 충돌하는 내용이 있다면 임의로 판단하지 말고 먼저 알려 달라고 요청한다.</p>



<h4 id="1-gpt%25ec%2599%2580-claude%25ec%2597%2590%25ea%25b2%258c-%25ea%25b0%2581%25ea%25b0%2581-%25ea%25b8%25b0%25ed%259a%258d-%25ec%25b4%2588%25ec%2595%2588%25ec%259d%2584-%25ec%25a0%259c%25ea%25b3%25b5%25ed%2595%259c%25eb%258b%25a4" class="wp-block-heading">1. GPT와 Claude에게 각각 기획 초안을 제공한다.</h4>



<p class="wp-block-paragraph">컨셉의 핵심, 반드시 지켜야 할 조건, 고민 중인 선택지를 함께 주고 여러 안을 요청한다. 이 단계에서는 충분히 넓게 생각하게 둔다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">나는 이번에 캐릭터 컨셉 기획서를 작성했어. 이 캐릭터가 남성향 서브컬처 소비자에게 매력적으로 보일 수 있게 다양한 아이디어를 제시해주고, 그중에서 네가 생각했을 때 가장 핵심인 것을 우선순위를 바탕으로 제안해 줘. 이 기획에서 반드시 유지해야 하는 확정 조건은 다음과 같아. 이 조건을 지키면서 캐릭터의 매력을 강화할 아이디어를 제안해줘. 다만 확정 조건 자체가 타깃 매력이나 세계관 정합성을 크게 해칠 가능성이 있다면, 조건을 임의로 바꾸지는 말고 별도의 위험 요소로 지적해줘.</p>
</blockquote>



<h4 id="2-claudegpt%25ec%2597%2590%25ea%25b2%258c-%25ea%25b0%2581%25ea%25b0%2581-%25ec%2583%2581%25eb%258c%2580%25eb%25b0%25a9%25ec%259d%2598-%25eb%25b9%2584%25ed%258c%2590%25ec%259e%2590-%25ec%2597%25ad%25ed%2595%25a0%25ec%259d%2584-%25eb%25a7%25a1%25ea%25b8%25b4%25eb%258b%25a4" class="wp-block-heading">2. Claude/GPT에게 각각 상대방의 &#8216;비판자&#8217; 역할을 맡긴다.</h4>



<p class="wp-block-paragraph">GPT의 답변을 Claude에게, Claude의 답변을 GPT에게 전달한 뒤, 단순히 붙여넣고 끝내는 게 아니라 “이 기획이 실패할 수 있는 이유, 설정과 충돌할 가능성, 플레이어가 납득하지 못할 부분, 빠진 대안”을 찾게 한다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">(GPT의 피드백과 컨셉 기획서 초안을 붙여넣으며) 이것은 내가 지금 기획하고 있는 캐릭터 컨셉 기획서와 GPT의 피드백이야. 이 기획을 보고 GPT가 제안한 기획안 가운데 타당한 부분과 굳이 반영하지 않아도 되는 부분을 구분해서 알려줘. 그리고 이 기획이 주 타깃층에게 납득되기 어려운 부분이 있거나 실패할 만한 부분이 있다면 그 부분은 반드시 알려줘.</p>
</blockquote>



<h4 id="3-%25ec%2583%2581%25eb%258c%2580-llm%25ec%259d%2598-%25eb%25b9%2584%25ed%258c%2590%25ec%259d%2584-%25eb%25b0%2598%25ec%2598%2581%25ed%2595%25b4-%25eb%258b%25a4%25ec%258b%259c-%25eb%25ac%25bb%25eb%258a%2594%25eb%258b%25a4" class="wp-block-heading">3. 상대 LLM의 비판을 반영해 다시 묻는다.</h4>



<p class="wp-block-paragraph">상대 모델의 의견을 곧바로 정답으로 받아들이지는 않는다. 먼저 작성 모델에게 각 지적의 타당성과 반론을 검토하게 한다. 이후 두 모델의 의견과 근거를 비교해 어떤 지적을 수용할지는 내가 결정한다.</p>



<blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
<p class="wp-block-paragraph">(클로드의 답변을 붙여넣으며) Claude가 다음과 같은 피드백을 제시했어. 각 지적을 ‘적극 수용·부분 수용·기각’으로 분류하고 판단 근거를 설명해줘. 단, 최종 결정에 필요한 정보가 부족하다면 임의로 결론 내리지 말고 추가로 확인해야 할 내용을 알려줘.</p>
</blockquote>



<h4 id="4-%25ec%25b5%259c%25ec%25a2%2585-%25ea%25b2%25b0%25ec%25a0%2595%25ec%259d%2580-%25eb%2582%25b4%25ea%25b0%2580-%25ed%2595%259c%25eb%258b%25a4" class="wp-block-heading">4. 최종 결정은 내가 한다.</h4>



<p class="wp-block-paragraph">이러한 LLM끼리의 핑퐁도 어느 정도 반복되면 점차 조정안에 다다른다. 이때 가장 중요한 건, 조율된 안을 그대로 복붙해서 기획서에 반영하는 게 아니라, 그 조율이 내가 원래 의도했던 기획 방향에 맞게 나왔는지 검토하는 일이다.</p>



<hr class="wp-block-separator has-alpha-channel-opacity is-style-dots"/>



<p class="wp-block-paragraph">이 과정을 거친 뒤 만든 기획안은 이전보다 팀원들의 호응이 좋았고, 나 역시 기획이 깊어졌다고 느꼈다.</p>



<p class="wp-block-paragraph">입사 후 한 달이 채 되지 않는 기간 동안, 내 주변의 네 명의 기획자가 GPT를 병행하거나 Claude에서 GPT로 주 사용 LLM을 옮겼다. 물론 이것만으로 업계 전체의 흐름을 말할 수는 없다. 다만 비슷한 문제의식을 공유하는 사람이 나만은 아니라는 신호처럼 느껴졌다.</p>



<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>



<h2 id="%25eb%25a7%2588%25ec%25b9%2598%25eb%25a9%25b0-%25eb%25aa%25a8%25eb%258d%25b8%25ec%259d%2598-%25ec%259a%25b0%25ec%2597%25b4%25eb%25b3%25b4%25eb%258b%25a4-%25ec%25a4%2591%25ec%259a%2594%25ed%2595%259c-%25ea%25b2%2583" class="wp-block-heading">마치며: 모델의 우열보다 중요한 것</h2>



<p class="wp-block-paragraph">이 글은 GPT가 Claude보다 우월하다고 말하려는 글은 아니다. 나 역시 Claude를 계속 사용하고 있고, Claude의 의견이 기획을 보완해 준 순간도 많았다. Gemini 역시 회사가 제공하는 접근성 좋은 도구이며, 다른 작업에서는 더 잘 맞을 수 있다.</p>



<p class="wp-block-paragraph">다만 ‘글을 잘 써 주는 AI 하나’를 믿고 그 답변을 계속 다듬는 방식은 생각보다 위험할 수 있다. AI는 초안을 빠르게 만들고 가능성을 넓혀 주지만, 동시에 내가 이미 믿고 있는 방향을 더 그럴듯하게 포장해 줄 수도 있기 때문이다.</p>



<p class="wp-block-paragraph">그래서 앞으로 AI를 실무에 활용하는 사람에게 필요한 것은 최고의 모델 하나를 찾는 일보다, <strong>서로 다른 AI와 자신의 판단이 충돌할 수 있는 구조를 만드는 일이라고 생각한다.</strong></p>



<p class="wp-block-paragraph">내게는 GPT와 Claude의 조합이 그 구조가 됐다. 다만 중요한 것은 특정 모델의 조합이 아니다. 하나의 AI가 작성과 판단을 모두 독점하지 않게 하고, 서로 다른 답변이 충돌할 여지를 남겨두는 것이 핵심이다.</p>



<p class="wp-block-paragraph"><strong>좋은 AI 활용은 정답을 빨리 받는 일이 아니라, 내 기획이 틀릴 수 있는 이유를 더 자주 확인하는 일에 가깝다.</strong></p>



<figure class="wp-block-pullquote"><blockquote><p>AI는 기획자를 대신해 주지 않는다. 대신 기획자가 자기 기획을 더 자주 의심하고, 더 나은 근거로 결정하게 만드는 검토 파트너가 될 수 있다.</p></blockquote></figure>
