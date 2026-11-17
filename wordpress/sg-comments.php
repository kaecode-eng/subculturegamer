<?php
/**
 * Plugin Name: SG Comments (한국형 댓글 UI)
 * Description: 워드프레스 기본 댓글 폼·목록을 네이버 블로그/티스토리/브런치에 익숙한 형태로 바꾼다.
 * Version: 1.4.2
 *
 * 설치: wp-content/mu-plugins/sg-comments.php 로 업로드하거나,
 *       Code Snippets/WPCode에 "<?php" 줄을 뺀 나머지를 PHP 스니펫으로 붙여넣는다.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const SG_COMMENT_MAXLEN = 1000;

/* ---------------------------------------------------------------
 * 1. 폼 문구·구조
 * ------------------------------------------------------------- */
add_filter( 'comment_form_defaults', function ( $d ) {
	$user = wp_get_current_user();

	$d['title_reply']          = '댓글 쓰기';
	$d['title_reply_to']       = '%s님에게 답글';
	$d['cancel_reply_link']    = '취소';
	$d['label_submit']         = '등록';
	$d['class_submit']         = 'sg-cf-submit';
	// 블록 테마의 core/post-comments-form 이 submit_button 을 덮어쓰므로 우선순위 20에서 다시 지정
	$d['submit_button']        = '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>';
	$d['submit_field']         = '<div class="sg-cf-bar"><span class="sg-cf-count"><b>0</b> / ' . SG_COMMENT_MAXLEN . '</span>%1$s %2$s</div>';
	$d['comment_notes_before'] = '';
	$d['comment_notes_after']  = '';

	// "rejin(으)로 로그인 됨. 자신의 프로필 편집. 로그아웃?" → 아바타 + 닉네임
	if ( $user->exists() ) {
		$d['logged_in_as'] = sprintf(
			'<div class="sg-cf-user">%s<strong>%s</strong><a class="sg-cf-logout" href="%s">로그아웃</a></div>',
			get_avatar( $user->ID, 28 ),
			esc_html( $user->display_name ),
			esc_url( wp_logout_url( get_permalink() ) )
		);
	}

	$d['comment_field'] = sprintf(
		'<p class="comment-form-comment"><label for="comment" class="screen-reader-text">댓글</label>'
		. '<textarea id="comment" name="comment" rows="4" maxlength="%d" required '
		. 'placeholder="글을 읽고 떠오른 생각, 질문, 플레이 경험을 편하게 남겨주세요."></textarea></p>',
		SG_COMMENT_MAXLEN
	);

	// 비로그인: 이름·이메일 한 줄, 웹사이트 칸 제거
	// 설정 → 토론 "이름과 이메일 필수"를 따른다. 해제돼 있으면 둘 다 선택이고, 닉네임을 비우면 WordPress 가 "익명"으로 표시한다.
	$req = (bool) get_option( 'require_name_email' );
	$d['fields']['author'] = sprintf(
		'<p class="comment-form-author"><label for="author" class="screen-reader-text">닉네임</label>'
		. '<input id="author" name="author" type="text" size="30" maxlength="245" autocomplete="nickname" placeholder="%s"%s /></p>',
		$req ? '닉네임' : '닉네임 (선택 · 비우면 익명)',
		$req ? ' required' : ''
	);
	$d['fields']['email']  = sprintf(
		'<p class="comment-form-email"><label for="email" class="screen-reader-text">이메일</label>'
		. '<input id="email" name="email" type="email" size="30" maxlength="100" autocomplete="email" placeholder="%s"%s /></p>',
		$req ? '이메일 (공개되지 않음)' : '이메일 (선택 · 공개되지 않음)',
		$req ? ' required' : ''
	);
	unset( $d['fields']['url'] );
	if ( isset( $d['fields']['cookies'] ) ) {
		$d['fields']['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" />'
			. '<label for="wp-comment-cookies-consent">닉네임·이메일 기억하기</label></p>';
	}
	return $d;
}, 20 );

// 비로그인 시 닉네임/이메일 입력칸을 본문 아래가 아니라 위로(티스토리 방식)
add_filter( 'comment_form_fields', function ( $fields ) {
	if ( ! isset( $fields['comment'] ) ) {
		return $fields;
	}
	$comment = $fields['comment'];
	unset( $fields['comment'] );
	$cookies = $fields['cookies'] ?? null;
	unset( $fields['cookies'] );
	$fields['comment'] = $comment;
	if ( $cookies ) {
		$fields['cookies'] = $cookies;
	}
	return $fields;
} );

/* ---------------------------------------------------------------
 * 2. 댓글 제목: "“긴 글 제목”에 대한 댓글 1개" → "댓글 1"
 * ------------------------------------------------------------- */
add_filter( 'render_block_core/comments-title', function ( $html ) {
	$count = get_comments_number();
	return preg_replace(
		'#(<h\d[^>]*>).*?(</h\d>)#s',
		'$1댓글 <span class="sg-count">' . intval( $count ) . '</span>$2',
		$html,
		1
	);
} );

/* ---------------------------------------------------------------
 * 2-1. 댓글 등록 직후 캐시된 옛 페이지가 보이지 않게 하기
 *    - Cloudflare 가 글 페이지를 최대 10분 캐시하므로, 등록 후 돌아가는 주소에 쿼리를 붙여 캐시를 건너뛴다
 *    - 승인 대기 댓글은 WordPress 가 이미 unapproved/moderation-hash 쿼리를 붙이므로 건드리지 않는다
 *    - 붙인 쿼리는 화면이 뜬 뒤 JS 가 주소창에서 지운다
 * ------------------------------------------------------------- */
add_filter( 'comment_post_redirect', function ( $location, $comment ) {
	if ( ! $comment instanceof WP_Comment || '1' !== (string) $comment->comment_approved ) {
		return $location;
	}
	return add_query_arg( 'sg_new', (int) $comment->comment_ID, $location );
}, 10, 2 );

/* ---------------------------------------------------------------
 * 3. 답글 UX: "답글" → "답글달기", 답글 앞에 @부모댓글작성자
 * ------------------------------------------------------------- */
add_filter( 'comment_reply_link_args', function ( $args ) {
	$args['reply_text'] = '답글달기';
	return $args;
} );

// wpautop(우선순위 30)보다 먼저 붙여서 첫 문단 안에 들어가게 한다
add_filter( 'comment_text', function ( $text, $comment = null ) {
	if ( is_admin() || ! $comment instanceof WP_Comment || ! $comment->comment_parent ) {
		return $text;
	}
	$parent = get_comment( $comment->comment_parent );
	if ( ! $parent ) {
		return $text;
	}
	// 닉네임 없이 쓴 댓글은 comment_author 가 비어 있으므로 표시 이름("익명")을 쓴다
	return '<span class="sg-mention">@' . esc_html( get_comment_author( $parent ) ) . '</span> ' . $text;
}, 10, 2 );

/* ---------------------------------------------------------------
 * 4. 글 좋아요(하트) + 댓글 수 바
 *    - 페이지 캐시(LiteSpeed/Cloudflare)와 무관하도록 숫자·상태는 AJAX(POST)로 받아온다
 *    - 중복 방지: 방문자 IP 해시를 글 메타에 저장(원본 IP는 저장하지 않음)
 * ------------------------------------------------------------- */
const SG_LIKE_MAX_TRACKED = 5000;

function sg_like_visitor_key() {
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
	return substr( wp_hash( 'sg-like|' . $ip ), 0, 16 );
}

function sg_like_count( $post_id ) {
	return (int) get_post_meta( $post_id, '_sg_likes', true );
}

function sg_like_ajax() {
	$post_id = isset( $_POST['post'] ) ? absint( $_POST['post'] ) : 0;
	$post    = $post_id ? get_post( $post_id ) : null;
	if ( ! $post || 'publish' !== $post->post_status || post_password_required( $post ) ) {
		wp_send_json_error( null, 400 );
	}
	$key   = sg_like_visitor_key();
	$keys  = get_post_meta( $post_id, '_sg_like_keys', true );
	$keys  = is_array( $keys ) ? $keys : array();
	$liked = in_array( $key, $keys, true );

	// 'set' 은 원하는 최종 상태를 받는다. 같은 요청이 여러 번 와도 결과가 같아서 연타·늦은 초기화에도 상태가 뒤집히지 않는다.
	// 방문자당 1표(IP 해시)라 연타 잠금은 두지 않는다. 'toggle' 은 이전 버전 호환용.
	$mode = isset( $_POST['mode'] ) ? sanitize_key( wp_unslash( $_POST['mode'] ) ) : 'get';
	if ( 'set' === $mode || 'toggle' === $mode ) {
		$want = 'set' === $mode ? ! empty( $_POST['liked'] ) : ! $liked;
		if ( $want !== $liked ) {
			if ( $want ) {
				$keys[] = $key;
				if ( count( $keys ) > SG_LIKE_MAX_TRACKED ) {
					$keys = array_slice( $keys, -SG_LIKE_MAX_TRACKED );
				}
			} else {
				$keys = array_values( array_diff( $keys, array( $key ) ) );
			}
			$liked = $want;
			update_post_meta( $post_id, '_sg_like_keys', $keys );
			update_post_meta( $post_id, '_sg_likes', max( 0, sg_like_count( $post_id ) + ( $liked ? 1 : -1 ) ) );
		}
	}
	wp_send_json_success( array( 'count' => sg_like_count( $post_id ), 'liked' => $liked ) );
}
add_action( 'wp_ajax_sg_like', 'sg_like_ajax' );
add_action( 'wp_ajax_nopriv_sg_like', 'sg_like_ajax' );

add_filter( 'render_block_core/comments', function ( $html, $parsed = null, $instance = null ) {
	$post_id = ( $instance && ! empty( $instance->context['postId'] ) ) ? (int) $instance->context['postId'] : get_the_ID();
	if ( ! $post_id ) {
		return $html;
	}
	// 같은 댓글 블록에 필터가 두 번 걸려도 바가 한 번만 들어가게 한다
	if ( false !== strpos( $html, 'class="sg-actions"' ) ) {
		return $html;
	}
	$likes    = sg_like_count( $post_id );
	$comments = (int) get_comments_number( $post_id );
	$heart    = '<svg class="sg-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20.5s-7.5-4.6-9.3-9.2C1.5 8.1 3.6 4.5 7.1 4.5c2 0 3.6 1.1 4.9 2.9 1.3-1.8 2.9-2.9 4.9-2.9 3.5 0 5.6 3.6 4.4 6.8-1.8 4.6-9.3 9.2-9.3 9.2z"/></svg>';
	$bubble   = '<svg class="sg-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4C6.8 4 3 7.3 3 11.3c0 2.2 1.1 4.1 2.9 5.5L5.3 20l3.5-1.8c1 .3 2.1.4 3.2.4 5.2 0 9-3.3 9-7.3S17.2 4 12 4z"/><circle cx="8.5" cy="11.3" r=".9"/><circle cx="12" cy="11.3" r=".9"/><circle cx="15.5" cy="11.3" r=".9"/></svg>';
	$bar      = sprintf(
		'<div class="sg-actions">'
		. '<button type="button" class="sg-like" data-post="%1$d" data-title="%7$s" aria-pressed="false">%2$s<span class="sg-like-num">%3$s</span><span class="sg-like-label">좋아요</span></button>'
		. '<a class="sg-cmt" href="#%4$s">%5$s<span>댓글</span><span class="sg-cmt-num">%6$d</span></a>'
		. '</div>',
		$post_id,
		$heart,
		$likes ? number_format_i18n( $likes ) : '',
		$comments ? 'comments' : 'respond',
		$bubble,
		$comments,
		esc_attr( wp_strip_all_tags( get_the_title( $post_id ) ) )
	);
	// 댓글 블록 래퍼 <div class="wp-block-comments"> 바로 안쪽 맨 위에 넣는다
	$out = preg_replace_callback(
		'#^\s*<div[^>]*\bwp-block-comments\b[^>]*>#',
		function ( $m ) use ( $bar ) {
			return $m[0] . $bar;
		},
		$html,
		1,
		$n
	);
	return $n ? $out : $bar . $html;
}, 10, 3 );

/* ---------------------------------------------------------------
 * 5. 스타일·스크립트
 * ------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', function () {
	if ( ! is_singular() || ! comments_open() && ! get_comments_number() ) {
		return;
	}
	$css = <<<CSS
.wp-block-comments{--sg-accent:var(--nv-primary-accent,#5F4B8B);--sg-line:#e3e3e8;--sg-sub:#8a8a93;font-size:15px}
/* 제목 */
.wp-block-comments-title{font-size:18px!important;font-weight:700;margin:0 0 4px!important;padding-bottom:14px;border-bottom:2px solid #222}
.wp-block-comments-title .sg-count{color:var(--sg-accent)}
/* 목록 */
.wp-block-comment-template{list-style:none;margin:0!important;padding:0!important}
.wp-block-comment-template li{margin:0!important;padding:18px 0;border-bottom:1px solid var(--sg-line)}
.wp-block-comment-template li .wp-block-columns{flex-wrap:nowrap!important;gap:12px!important;margin:0!important}
.wp-block-comment-template li .wp-block-column{margin:0!important}
.wp-block-comment-template li .wp-block-column:first-child{flex:0 0 40px!important}
.wp-block-comment-template li .wp-block-column>*{margin-top:0!important;margin-bottom:0!important}
.wp-block-comment-template ol.children{list-style:none;margin:14px 0 0!important;padding:0 0 0 20px!important;border-left:2px solid var(--sg-line)}
.wp-block-comment-template ol.children li{padding:14px 0 0!important;border:0!important}
.wp-block-comment-author-name{font-weight:700;font-size:14px!important}
.wp-block-comment-author-name a{color:inherit;text-decoration:none}
.wp-block-comment-date{font-size:12px!important;color:var(--sg-sub)}
.wp-block-comment-date a{color:inherit;text-decoration:none}
.wp-block-comment-template .wp-block-comment-content{margin:6px 0 8px!important;padding:0!important;line-height:1.7;word-break:keep-all;overflow-wrap:anywhere}
.wp-block-comment-content p{margin:0 0 .4em!important;padding:0!important}
.wp-block-comment-reply-link{margin-top:10px!important}
.wp-block-comment-reply-link a{font-size:13px;color:var(--sg-sub);text-decoration:none}
.wp-block-comment-reply-link a:hover{color:var(--sg-accent);text-decoration:underline}
.sg-mention{display:inline-block;margin-right:2px;padding:0 4px;border-radius:3px;background:#f0eef5;color:var(--sg-accent);font-weight:600}
.bypostauthor>.wp-block-columns .wp-block-comment-author-name::after{content:"작성자";margin-left:6px;padding:0 7px;border:1px solid var(--sg-accent);border-radius:10px;font-size:11px;font-weight:500;color:var(--sg-accent);vertical-align:1px}
/* 좋아요·댓글 바 */
.sg-actions{display:flex;justify-content:space-between;align-items:center;margin:0 0 40px}
.sg-like,.sg-cmt{display:inline-flex;align-items:center;gap:6px;height:44px;padding:0 20px;border:1px solid #d9d9df;border-radius:22px;background:#fff;color:#333;font:inherit;font-size:15px;line-height:1;text-decoration:none!important;cursor:pointer;transition:border-color .15s,color .15s}
.sg-like:hover,.sg-cmt:hover{border-color:var(--sg-accent)}
.sg-ico{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:1.6;stroke-linejoin:round}
.sg-cmt .sg-ico circle{fill:currentColor;stroke:none}
.sg-like-num:empty{display:none}
.sg-like-label{display:none}
.sg-like-num:empty+.sg-like-label{display:inline}
.sg-like[aria-pressed="true"]{color:#e5484d;border-color:#f3b4b6}
.sg-like[aria-pressed="true"] .sg-ico{fill:#e5484d;stroke:#e5484d}
.sg-like.is-pop .sg-ico{animation:sg-pop .35s ease}
@keyframes sg-pop{40%{transform:scale(1.35)}100%{transform:scale(1)}}
.sg-cmt-num{color:var(--sg-accent);font-weight:600}
/* 폼 */
.wp-block-post-comments-form{margin-top:28px}
.wp-block-post-comments-form .comment-reply-title{font-size:16px!important;font-weight:700;margin:0 0 10px!important;display:flex;align-items:center;gap:8px}
.wp-block-post-comments-form .comment-reply-title small a{font-size:13px;font-weight:400;color:var(--sg-sub)}
#commentform{display:flex;flex-wrap:wrap;gap:0;border:1px solid var(--sg-line);border-radius:10px;background:#fff;overflow:hidden;transition:border-color .15s,box-shadow .15s}
#commentform:focus-within{border-color:var(--sg-accent);box-shadow:0 0 0 3px color-mix(in srgb,var(--sg-accent) 15%,transparent)}
#commentform>p,#commentform>div{margin:0!important;width:100%}
#commentform .sg-cf-user,#commentform .logged-in-as{order:-2}
.sg-cf-user{display:flex;align-items:center;gap:8px;padding:14px 16px 0;font-size:14px}
.sg-cf-user img{border-radius:50%}
.sg-cf-logout{margin-left:auto;font-size:12px;color:var(--sg-sub)!important;text-decoration:none!important}
#commentform .comment-form-author,#commentform .comment-form-email{width:50%!important;padding:12px 0 0 16px}
#commentform .comment-form-email{padding-right:16px}
#commentform .comment-form-author input,#commentform .comment-form-email input{width:100%;border:0;border-bottom:1px solid var(--sg-line);border-radius:0;padding:6px 2px;font-size:14px;background:transparent;box-shadow:none;outline:0}
#commentform .comment-form-author input:focus,#commentform .comment-form-email input:focus{border-bottom-color:var(--sg-accent)}
#commentform textarea{display:block;width:100%;min-height:96px;border:0!important;border-radius:0;padding:14px 16px;font:inherit;font-size:15px;line-height:1.6;resize:vertical;box-shadow:none!important;outline:0!important;background:transparent}
#commentform textarea::placeholder,#commentform input::placeholder{color:#b0b0b8}
#commentform .comment-form-cookies-consent{display:flex;align-items:center;gap:6px;padding:0 16px 8px;font-size:12px;color:var(--sg-sub)}
#commentform .comment-form-cookies-consent input{margin:0}
.sg-cf-bar{display:flex;align-items:center;justify-content:flex-end;gap:12px;padding:8px 10px 8px 16px;border-top:1px solid #f0f0f3;background:#fafafb}
.sg-cf-count{font-size:12px;color:var(--sg-sub);margin-right:auto}
.sg-cf-count.is-over{color:#d33}
#commentform .sg-cf-submit{appearance:none;border:0;border-radius:6px;padding:8px 20px;font-size:14px;font-weight:600;line-height:1.4;color:#fff;background:var(--sg-accent);cursor:pointer;transition:opacity .15s}
#commentform .sg-cf-submit:disabled{background:#cfcfd6;cursor:default}
#commentform .sg-cf-submit:not(:disabled):hover{opacity:.88}
@media (max-width:600px){#commentform .comment-form-author,#commentform .comment-form-email{width:100%!important;padding-right:16px}}
CSS;
	wp_register_style( 'sg-comments', false, array(), '1.3.1' );
	wp_enqueue_style( 'sg-comments' );
	wp_add_inline_style( 'sg-comments', $css );

	$js = <<<JS
document.addEventListener('DOMContentLoaded',function(){
  /* 댓글 등록 직후 붙인 캐시 우회 쿼리(sg_new)를 주소창에서 지운다 */
  try{var u=new URL(location.href);if(u.searchParams.has('sg_new')){u.searchParams.delete('sg_new');history.replaceState(history.state,'',u.pathname+(u.search||'')+u.hash);}}catch(e){}
  /* 상대 시간: 캐시된 페이지에서도 정확하도록 브라우저에서 계산 */
  document.querySelectorAll('.wp-block-comment-date time[datetime]').forEach(function(el){
    var t=new Date(el.getAttribute('datetime')),d=(Date.now()-t)/1000,a=el.querySelector('a')||el,s;
    if(isNaN(d))return;
    if(d<60)s='방금 전';else if(d<3600)s=Math.floor(d/60)+'분 전';else if(d<86400)s=Math.floor(d/3600)+'시간 전';
    else if(d<86400*7)s=Math.floor(d/86400)+'일 전';
    else s=t.getFullYear()+'.'+String(t.getMonth()+1).padStart(2,'0')+'.'+String(t.getDate()).padStart(2,'0');
    el.title=t.toLocaleString('ko-KR');a.textContent=s;
  });
  /* 좋아요 */
  var ajax=window.sgComments&&sgComments.ajax;
document.querySelectorAll('.sg-like[data-post]').forEach(function(btn){
var num=btn.querySelector('.sg-like-num');
var server=null; /* 서버가 확인해 준 마지막 상태 */
var want=null; /* 아직 서버에 반영되지 않은, 사용자가 마지막으로 고른 상태 */
var busy=false;
function render(r){btn.setAttribute('aria-pressed',r.liked?'true':'false');btn.setAttribute('aria-label',r.liked?'좋아요 취소':'좋아요');num.textContent=r.count>0?r.count.toLocaleString('ko-KR'):'';}
function post(p){var b=new URLSearchParams(p);b.set('action','sg_like');b.set('post',btn.dataset.post);
return fetch(ajax,{method:'POST',body:b,credentials:'same-origin'}).then(function(r){return r.json()}).then(function(j){return j&&j.success?j.data:null;});}
/* GA4 이벤트: 서버에 실제로 반영된 경우에만 전송 (Site Kit 의 gtag 사용) */
function track(prev,now){
if(!prev||prev.liked===now.liked||typeof window.gtag!=='function')return;
window.gtag('event',now.liked?'post_like':'post_unlike',{
post_id:String(btn.dataset.post),post_title:btn.dataset.title||document.title,like_count:now.count});
}
/* 마지막으로 고른 상태가 서버에 반영될 때까지 한 번에 하나씩 보낸다 (연타해도 마지막 선택이 남는다) */
function sync(){
if(busy||want===null)return;
if(server&&server.liked===want){want=null;render(server);return;}
busy=true;var ok=false;
post({mode:'set',liked:want?'1':'0'}).then(function(d){if(d){ok=true;var prev=server;server=d;track(prev,d);}}).catch(function(){}).then(function(){
busy=false;
if(ok&&want!==null&&server.liked!==want){sync();return;}
want=null;if(server)render(server);
});
}
if(!ajax)return;
/* 처음 상태: 그 전에 이미 눌렀다면 클릭 결과를 우선한다 */
post({mode:'get'}).then(function(d){if(!d||server)return;server=d;if(want===null)render(d);else sync();}).catch(function(){});
btn.addEventListener('click',function(){
var on=btn.getAttribute('aria-pressed')!=='true',n=parseInt((num.textContent||'0').replace(/\D/g,''),10)||0;
want=on;
render({liked:on,count:Math.max(0,n+(on?1:-1))});
if(on){btn.classList.remove('is-pop');void btn.offsetWidth;btn.classList.add('is-pop');}
sync();
});
});
  /* 댓글 폼 */
  var t=document.getElementById('comment'),f=document.getElementById('commentform');
  if(!t||!f)return;
  var c=f.querySelector('.sg-cf-count b'),w=f.querySelector('.sg-cf-count'),b=f.querySelector('.sg-cf-submit'),max=+t.getAttribute('maxlength');
  function u(){var n=t.value.length;if(c)c.textContent=n;if(w)w.classList.toggle('is-over',n>=max);if(b)b.disabled=!t.value.trim();
    t.style.height='auto';t.style.height=Math.max(96,t.scrollHeight)+'px';}
  t.addEventListener('input',u);u();
});
JS;
	wp_register_script( 'sg-comments', false, array(), '1.3.1', true );
	wp_enqueue_script( 'sg-comments' );
	wp_add_inline_script( 'sg-comments', 'window.sgComments=' . wp_json_encode( array( 'ajax' => admin_url( 'admin-ajax.php' ), 'editUrl' => admin_url( 'comment.php?action=editcomment&c=' ) ) ) . ';', 'before' );
	wp_add_inline_script( 'sg-comments', $js );
} );
/* ---------------------------------------------------------------
 * 6. 관리자 통계: 글 목록 ♥ 열(정렬 가능) + 대시보드 상위 글 위젯
 * ------------------------------------------------------------- */
add_filter( 'manage_post_posts_columns', function ( $cols ) {
	$out = array();
	foreach ( $cols as $k => $v ) {
		$out[ $k ] = $v;
		if ( 'comments' === $k ) {
			$out['sg_likes'] = '<span title="좋아요">♥ 좋아요</span>';
		}
	}
	if ( ! isset( $out['sg_likes'] ) ) {
		$out['sg_likes'] = '<span title="좋아요">♥ 좋아요</span>';
	}
	return $out;
} );

add_action( 'manage_post_posts_custom_column', function ( $col, $post_id ) {
	if ( 'sg_likes' === $col ) {
		$n = sg_like_count( $post_id );
		echo $n ? '<strong style="color:#e5484d">♥ ' . esc_html( number_format_i18n( $n ) ) . '</strong>' : '<span style="color:#bbb">0</span>';
	}
}, 10, 2 );

add_filter( 'manage_edit-post_sortable_columns', function ( $cols ) {
	$cols['sg_likes'] = array( 'sg_likes', true ); // 처음 클릭 시 많은 순
	return $cols;
} );

// 좋아요 순 정렬: _sg_likes 메타만 LEFT JOIN 해서 정렬한다(메타가 없는 글은 0으로 취급).
// meta_query(OR + NOT EXISTS) 방식은 다른 메타 값(_edit_lock 등)으로 정렬되는 문제가 있어 쓰지 않는다.
function sg_like_is_sort_query( $q ) {
	return is_admin() && $q->is_main_query() && 'sg_likes' === $q->get( 'orderby' );
}

add_filter( 'posts_clauses', function ( $clauses, $q ) {
	if ( ! sg_like_is_sort_query( $q ) ) {
		return $clauses;
	}
	global $wpdb;
	$order              = 'ASC' === strtoupper( (string) $q->get( 'order' ) ) ? 'ASC' : 'DESC';
	$clauses['join']   .= " LEFT JOIN {$wpdb->postmeta} AS sg_lk ON ( sg_lk.post_id = {$wpdb->posts}.ID AND sg_lk.meta_key = '_sg_likes' )";
	$clauses['orderby'] = "CAST( COALESCE( sg_lk.meta_value, '0' ) AS UNSIGNED ) {$order}, {$wpdb->posts}.post_date DESC";
	return $clauses;
}, 10, 2 );

add_action( 'admin_head-edit.php', function () {
	echo '<style>.column-sg_likes{width:7em;text-align:center!important}</style>';
} );

add_action( 'wp_dashboard_setup', function () {
	wp_add_dashboard_widget( 'sg_likes_top', '♥ 좋아요 많은 글 TOP 10', function () {
		$posts = get_posts( array(
			'post_type'      => 'post',
			'posts_per_page' => 10,
			'meta_key'       => '_sg_likes',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
			'meta_query'     => array( array( 'key' => '_sg_likes', 'value' => 0, 'compare' => '>', 'type' => 'NUMERIC' ) ),
		) );
		if ( ! $posts ) {
			echo '<p>아직 좋아요를 받은 글이 없습니다.</p>';
			return;
		}
		$total = 0;
		echo '<ol style="margin:0;padding-left:1.5em">';
		foreach ( $posts as $p ) {
			$n      = sg_like_count( $p->ID );
			$total += $n;
			printf(
				'<li style="display:flex;gap:8px;margin-bottom:6px"><a href="%s" style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">%s</a><strong style="color:#e5484d">♥ %s</strong></li>',
				esc_url( get_permalink( $p ) ),
				esc_html( get_the_title( $p ) ),
				esc_html( number_format_i18n( $n ) )
			);
		}
		echo '</ol>';
		printf(
			'<p style="margin:10px 0 0;color:#787c82">전체 글 목록에서 보기: <a href="%s">좋아요 많은 순 정렬</a></p>',
			esc_url( admin_url( 'edit.php?orderby=sg_likes&order=desc' ) )
		);
	} );
} );

/* ---------------------------------------------------------------
 * 7. 댓글 ⋮ 메뉴: 링크 복사 · 신고(모든 방문자) / 수정 · 삭제(관리자)
 *    - 페이지 캐시에 관리자 메뉴가 섞이지 않도록 HTML 에는 버튼만 넣고,
 *      관리자 메뉴와 nonce 는 로그인한 사용자에게만 AJAX 로 받아 JS 가 추가한다
 *    - 신고는 방문자 IP 해시로 중복을 막고, SG_REPORT_HIDE_AT 건이 되면 승인 대기로 돌린다
 * ------------------------------------------------------------- */
const SG_REPORT_HIDE_AT = 3;

add_filter( 'render_block_core/comment-author-name', function ( $html, $parsed = null, $instance = null ) {
	$cid = ( $instance && ! empty( $instance->context['commentId'] ) ) ? (int) $instance->context['commentId'] : 0;
	if ( ! $cid ) {
		return $html;
	}
	return $html . sprintf(
		'<div class="sg-cmenu" data-cid="%1$d"><button type="button" class="sg-cmenu-btn" aria-haspopup="true" aria-expanded="false" aria-label="댓글 메뉴">'
		. '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="5" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="12" cy="19" r="1.6"/></svg></button>'
		. '<ul class="sg-cmenu-list" role="menu" hidden>'
		. '<li role="none"><button type="button" role="menuitem" data-act="copy">링크 복사</button></li>'
		. '<li role="none" class="sg-cmenu-report"><button type="button" role="menuitem" data-act="report">신고</button></li>'
		. '</ul></div>',
		$cid
	);
}, 10, 3 );

// 로그인 사용자: 관리 가능 여부와 nonce 를 돌려준다(캐시되지 않는 AJAX)
add_action( 'wp_ajax_sg_cmt_caps', function () {
	wp_send_json_success( array(
		'moderate' => current_user_can( 'moderate_comments' ),
		'nonce'    => current_user_can( 'moderate_comments' ) ? wp_create_nonce( 'sg_cmt_mod' ) : '',
	) );
} );

// 관리자: 휴지통으로 이동
add_action( 'wp_ajax_sg_cmt_trash', function () {
	$cid = isset( $_POST['cid'] ) ? absint( $_POST['cid'] ) : 0;
	if ( ! $cid || ! check_ajax_referer( 'sg_cmt_mod', 'nonce', false ) || ! current_user_can( 'edit_comment', $cid ) ) {
		wp_send_json_error( null, 403 );
	}
	wp_send_json_success( array( 'trashed' => (bool) wp_trash_comment( $cid ) ) );
} );

// 모든 방문자: 신고
function sg_cmt_report_ajax() {
	$cid     = isset( $_POST['cid'] ) ? absint( $_POST['cid'] ) : 0;
	$comment = $cid ? get_comment( $cid ) : null;
	if ( ! $comment || '1' !== (string) $comment->comment_approved ) {
		wp_send_json_error( null, 400 );
	}
	$key = sg_like_visitor_key();

	// 같은 방문자는 1시간에 10건까지만
	$rate = 'sg_report_rate_' . $key;
	$used = (int) get_transient( $rate );
	if ( $used >= 10 ) {
		wp_send_json_error( array( 'message' => '잠시 후 다시 시도해 주세요.' ), 429 );
	}
	set_transient( $rate, $used + 1, HOUR_IN_SECONDS );

	$keys = get_comment_meta( $cid, '_sg_report_keys', true );
	$keys = is_array( $keys ) ? $keys : array();
	if ( in_array( $key, $keys, true ) ) {
		wp_send_json_success( array( 'already' => true ) );
	}
	$keys[] = $key;
	$count  = count( $keys );
	update_comment_meta( $cid, '_sg_report_keys', $keys );
	update_comment_meta( $cid, '_sg_reports', $count );

	if ( 1 === $count ) {
		wp_mail(
			get_option( 'admin_email' ),
			'[' . wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) . '] 댓글 신고 접수',
			sprintf(
				"댓글이 신고됐습니다.\n\n글: %s\n작성자: %s\n내용: %s\n\n관리: %s",
				get_the_title( $comment->comment_post_ID ),
				$comment->comment_author,
				wp_strip_all_tags( $comment->comment_content ),
				admin_url( 'comment.php?action=editcomment&c=' . $cid )
			)
		);
	}
	$hidden = false;
	if ( $count >= SG_REPORT_HIDE_AT ) {
		$hidden = (bool) wp_set_comment_status( $cid, 'hold' );
	}
	wp_send_json_success( array( 'already' => false, 'hidden' => $hidden ) );
}
add_action( 'wp_ajax_sg_cmt_report', 'sg_cmt_report_ajax' );
add_action( 'wp_ajax_nopriv_sg_cmt_report', 'sg_cmt_report_ajax' );

// 관리자 댓글 목록에 "신고" 열
add_filter( 'manage_edit-comments_columns', function ( $cols ) {
	$cols['sg_reports'] = '신고';
	return $cols;
} );
add_action( 'manage_comments_custom_column', function ( $col, $cid ) {
	if ( 'sg_reports' === $col ) {
		$n = (int) get_comment_meta( $cid, '_sg_reports', true );
		echo $n ? '<strong style="color:#d63638">🚩 ' . esc_html( $n ) . '</strong>' : '<span style="color:#bbb">-</span>';
	}
}, 10, 2 );
// 신고 기록 지우기: 관리자 댓글 목록의 행 버튼 + 숨겨진 댓글을 관리자가 다시 승인하면 자동으로 지운다
function sg_cmt_clear_reports( $cid ) {
	delete_comment_meta( $cid, '_sg_reports' );
	delete_comment_meta( $cid, '_sg_report_keys' );
}

add_filter( 'comment_row_actions', function ( $actions, $comment ) {
	if ( (int) get_comment_meta( $comment->comment_ID, '_sg_reports', true ) > 0 && current_user_can( 'edit_comment', $comment->comment_ID ) ) {
		$url = wp_nonce_url(
			admin_url( 'admin-post.php?action=sg_reset_reports&c=' . $comment->comment_ID ),
			'sg_reset_reports_' . $comment->comment_ID
		);
		$actions['sg_reset_reports'] = '<a href="' . esc_url( $url ) . '">신고 기록 지우기</a>';
	}
	return $actions;
}, 10, 2 );

add_action( 'admin_post_sg_reset_reports', function () {
	$cid = isset( $_GET['c'] ) ? absint( $_GET['c'] ) : 0;
	if ( ! $cid || ! current_user_can( 'edit_comment', $cid ) ) {
		wp_die( '권한이 없습니다.', 403 );
	}
	check_admin_referer( 'sg_reset_reports_' . $cid );
	sg_cmt_clear_reports( $cid );
	$back = wp_get_referer() ?: admin_url( 'edit-comments.php' );
	wp_safe_redirect( add_query_arg( 'sg_reports_cleared', 1, remove_query_arg( 'sg_reports_cleared', $back ) ) );
	exit;
} );

add_action( 'admin_notices', function () {
	if ( ! empty( $_GET['sg_reports_cleared'] ) && current_user_can( 'moderate_comments' ) ) {
		echo '<div class="notice notice-success is-dismissible"><p>신고 기록을 지웠습니다.</p></div>';
	}
} );

add_action( 'transition_comment_status', function ( $new, $old, $comment ) {
	if ( 'approved' === $new && 'unapproved' === $old && current_user_can( 'moderate_comments' ) ) {
		sg_cmt_clear_reports( $comment->comment_ID );
	}
}, 10, 3 );

add_action( 'admin_head-edit-comments.php', function () {
	echo '<style>.column-sg_reports{width:5em;text-align:center!important}</style>';
} );

add_action( 'wp_enqueue_scripts', function () {
	if ( ! is_singular() || ! get_comments_number() ) {
		return;
	}
	$css = <<<CSS
.wp-block-comment-template li{position:relative}
.wp-block-comment-template li .wp-block-comment-author-name{padding-right:36px}
.sg-cmenu{position:absolute;top:14px;right:0;z-index:5}
.wp-block-comment-template ol.children .sg-cmenu{top:10px}
.sg-cmenu-btn{display:flex;align-items:center;justify-content:center;width:32px;height:32px;padding:0;border:0;border-radius:50%;background:transparent;color:#a0a0a8;cursor:pointer}
.sg-cmenu-btn:hover,.sg-cmenu-btn[aria-expanded="true"]{background:#f2f2f5;color:#555}
.sg-cmenu-btn svg{width:20px;height:20px;fill:currentColor}
.sg-cmenu-list{position:absolute;top:34px;right:0;min-width:120px;margin:0;padding:6px 0;list-style:none;background:#fff;border:1px solid #e3e3e8;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,.08)}
.sg-cmenu-list[hidden]{display:none}
.sg-cmenu-list li{margin:0!important;padding:0!important;border:0!important}
.sg-cmenu-list button{display:block;width:100%;padding:8px 16px;border:0;background:none;font:inherit;font-size:14px;color:#333;text-align:left;cursor:pointer}
.sg-cmenu-list button:hover,.sg-cmenu-list button:focus-visible{background:#f5f4f8;outline:0}
.sg-cmenu-list [data-act="trash"],.sg-cmenu-list [data-act="report"]{color:#d63638}
.sg-cmenu.is-mod .sg-cmenu-report{display:none}
.sg-toast{position:fixed;left:50%;bottom:32px;z-index:9999;transform:translate(-50%,12px);padding:10px 18px;border-radius:20px;background:rgba(30,30,35,.92);color:#fff;font-size:14px;opacity:0;pointer-events:none;transition:opacity .2s,transform .2s}
.sg-toast.is-on{opacity:1;transform:translate(-50%,0)}
.wp-block-comment-template li.is-removing{opacity:.3;transition:opacity .3s}
CSS;
	wp_register_style( 'sg-comments-menu', false, array( 'sg-comments' ), '1.4.0' );
	wp_enqueue_style( 'sg-comments-menu' );
	wp_add_inline_style( 'sg-comments-menu', $css );

	$js = <<<JS
(function(){
function init(){
  var ajax=window.sgComments&&sgComments.ajax,menus=document.querySelectorAll('.sg-cmenu');
  if(!ajax||!menus.length)return;
  var toastEl,toastT;
  function toast(m){if(!toastEl){toastEl=document.createElement('div');toastEl.className='sg-toast';toastEl.setAttribute('role','status');document.body.appendChild(toastEl);}
    toastEl.textContent=m;toastEl.classList.add('is-on');clearTimeout(toastT);toastT=setTimeout(function(){toastEl.classList.remove('is-on');},2200);}
  function post(p){var b=new URLSearchParams(p);return fetch(ajax,{method:'POST',body:b,credentials:'same-origin'}).then(function(r){return r.json()});}
  function close(m){var b=m.querySelector('.sg-cmenu-btn'),l=m.querySelector('.sg-cmenu-list');b.setAttribute('aria-expanded','false');l.hidden=true;}
  function closeAll(except){menus.forEach(function(m){if(m!==except)close(m);});}
  var nonce='';
  /* 관리자: 로그인 상태일 때만 권한을 물어 수정·삭제를 붙인다 */
  if(document.body.classList.contains('logged-in')){
    post({action:'sg_cmt_caps'}).then(function(j){
      if(!j||!j.success||!j.data.moderate)return;nonce=j.data.nonce;
      menus.forEach(function(m){m.classList.add('is-mod');var l=m.querySelector('.sg-cmenu-list');
        l.insertAdjacentHTML('beforeend','<li role="none"><button type="button" role="menuitem" data-act="edit">수정</button></li><li role="none"><button type="button" role="menuitem" data-act="trash">삭제</button></li>');});
    }).catch(function(){});
  }
  menus.forEach(function(m){
    var btn=m.querySelector('.sg-cmenu-btn'),list=m.querySelector('.sg-cmenu-list'),cid=m.dataset.cid;
    btn.addEventListener('click',function(e){e.stopPropagation();var open=list.hidden;closeAll(m);list.hidden=!open;btn.setAttribute('aria-expanded',open?'true':'false');
      if(open){var f=list.querySelector('button');if(f)f.focus();}});
    list.addEventListener('click',function(e){
      var it=e.target.closest('[data-act]');if(!it)return;close(m);btn.focus();
      var act=it.dataset.act,li=m.closest('li.comment')||document.getElementById('comment-'+cid);
      if(act==='copy'){
        var url=location.origin+location.pathname+'#comment-'+cid;
        (navigator.clipboard?navigator.clipboard.writeText(url):Promise.reject()).then(function(){toast('댓글 링크를 복사했습니다');},function(){window.prompt('아래 링크를 복사하세요',url);});
      }else if(act==='report'){
        if(!window.confirm('이 댓글을 신고할까요?\\n신고 내용은 블로그 운영자에게 전달됩니다.'))return;
        post({action:'sg_cmt_report',cid:cid}).then(function(j){
          if(j&&j.success){toast(j.data.already?'이미 신고한 댓글입니다':'신고가 접수됐습니다');if(j.data.hidden&&li)li.classList.add('is-removing');}
          else toast((j&&j.data&&j.data.message)||'신고를 처리하지 못했습니다');
        }).catch(function(){toast('신고를 처리하지 못했습니다');});
      }else if(act==='edit'){
        location.href=sgComments.editUrl+cid;
      }else if(act==='trash'){
        if(!window.confirm('이 댓글을 삭제할까요?\\n휴지통으로 이동하며, 관리자 화면에서 되돌릴 수 있습니다.'))return;
        post({action:'sg_cmt_trash',cid:cid,nonce:nonce}).then(function(j){
          if(j&&j.success&&j.data.trashed){toast('댓글을 삭제했습니다');if(li){li.classList.add('is-removing');setTimeout(function(){li.remove();},300);}}
          else toast('삭제하지 못했습니다');
        }).catch(function(){toast('삭제하지 못했습니다');});
      }
    });
  });
  document.addEventListener('click',function(e){if(!e.target.closest('.sg-cmenu'))closeAll();});
  document.addEventListener('keydown',function(e){if(e.key==='Escape'){var o=document.querySelector('.sg-cmenu-btn[aria-expanded="true"]');closeAll();if(o)o.focus();}});
}
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
})();
JS;
	wp_register_script( 'sg-comments-menu', false, array( 'sg-comments' ), '1.4.0', true );
	wp_enqueue_script( 'sg-comments-menu' );
	wp_add_inline_script( 'sg-comments-menu', $js );
}, 20 );
