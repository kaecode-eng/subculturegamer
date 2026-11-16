# WordPress 커스텀 코드

subculturegamer.com(Neve FSE 테마)에 직접 올리는 코드 모음.

## sg-comments.php — 한국형 댓글 UI + 글 좋아요

### 설치·업데이트

1. cPanel 파일 관리자에서 `wp-content/mu-plugins/sg-comments.php`로 업로드(폴더가 없으면 생성). 활성화 절차 없이 바로 적용된다.
   - 또는 Code Snippets/WPCode에 첫 줄 `<?php`를 뺀 나머지를 PHP 스니펫으로 붙여넣는다. 두 방법을 동시에 쓰면 함수 중복으로 사이트가 멈추니 하나만 쓴다.
2. LiteSpeed 캐시 전체 비우기 → Cloudflare 캐시 비우기.
3. 글 하나를 열어 하트 클릭 → 새로고침 후에도 숫자가 유지되는지 확인.

### 좋아요 숫자의 기준

| 어디서 보나 | 정확도 | 용도 |
|---|---|---|
| 관리자 **글 → 모든 글**의 ♥ 열, **대시보드 TOP 10** 위젯 | 정확(광고 차단기 영향 없음) | **공식 숫자.** 글별 누적 좋아요 |
| GA4 `post_like` / `post_unlike` 이벤트 | 차단기 사용자만큼 적게 잡힘 | 조회수 대비 비율, 유입 경로별 반응 같은 **경향 분석** |

- 두 숫자가 다른 게 정상이다. 개수는 관리자 화면, 비율·경향은 GA로 본다.
- 같은 IP(회사·같은 와이파이)는 1명으로 센다. 원본 IP는 저장하지 않는다(해시만 저장).
- 데이터 위치: 글 메타 `_sg_likes`(개수), `_sg_like_keys`(중복 방지용 해시).

### GA4 설정 (최초 1회)

1. 관리 → 데이터 표시 → 맞춤 정의 → **맞춤 측정기준 만들기**
   - 이름 `글 제목`, 범위 이벤트, 매개변수 `post_title`
   - (선택) 이름 `글 ID`, 범위 이벤트, 매개변수 `post_id`
   - 등록 이후 데이터부터 적용되고, 보고서에 나타나기까지 24~48시간 걸린다.
2. 확인: 보고서 → 실시간 → 이벤트에 `post_like`가 보이면 정상.
3. 분석: 탐색 → 자유 형식. 행 `글 제목`, 값 `이벤트 수`, 열 `이벤트 이름`(`page_view`, `post_like`) → 글별 좋아요율 = post_like ÷ page_view.

### GA 누락 줄이기: Cloudflare Google tag gateway (선택)

GA 스크립트를 자기 도메인 경로로 불러와 차단기 누락을 줄인다. 좋아요뿐 아니라 조회수·유입 경로 데이터 전체에 적용된다. 강한 차단기(uBlock Origin 등)는 여전히 일부 막는다.

1. Cloudflare 대시보드 → `subculturegamer.com` 존 → **Google tag gateway** 페이지(Engagement 메뉴 쪽)
   - 계정 권한이 Super Administrator / Administrator / Zaraz Admin(도메인 범위 사용자는 Domain Administrator)이어야 한다.
2. **Turn on and configure Google tag gateway** 켜기
3. Google 태그 ID 입력: 현재 사이트 태그는 `GT-PBSCH8B`(Site Kit이 삽입). GA4 관리 → 데이터 스트림 → 태그 설정에서 확인 가능.
4. 측정 경로 입력: 사이트에서 쓰지 않는 경로로 지정(예: `/sgm/`). 기존 글·페이지 슬러그와 겹치면 안 된다.
5. 확인: 글을 열고 브라우저 개발자 도구 → Network에서 GA 요청이 `subculturegamer.com/<측정 경로>/...`로 나가는지, GA4 실시간 보고서에 방문이 잡히는지 확인.

주의: 설정은 존 전체(모든 서브도메인)에 적용된다. Google Tag Manager/Google 태그 관리 화면(관리 → Google tag gateway)에서 Cloudflare 계정을 연결해 켜는 방법도 있다.

참고 문서
- Cloudflare: https://developers.cloudflare.com/google-tag-gateway/
- Google: https://support.google.com/analytics/answer/16061406
