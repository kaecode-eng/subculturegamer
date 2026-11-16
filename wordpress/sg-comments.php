<?php
/**
 * Plugin Name: SG Comments (한국형 댓글 UI)
 * Description: 워드프레스 기본 댓글 폼·목록을 네이버 블로그/티스토리/브런치에 익숙한 형태로 바꾼다.
 * Version: 1.0.0
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
	$d['fields']['author'] = '<p class="comment-form-author"><label for="author" class="screen-reader-text">닉네임</label>'
		. '<input id="author" name="author" type="text" size="30" maxlength="245" autocomplete="name" placeholder="닉네임" required /></p>';
	$d['fields']['email']  = '<p class="comment-form-email"><label for="email" class="screen-reader-text">이메일</label>'
		. '<input id="email" name="email" type="email" size="30" maxlength="100" autocomplete="email" placeholder="이메일 (공개되지 않음)" required /></p>';
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
 * 3. 스타일
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
.wp-block-comment-reply-link a{display:inline-block;font-size:12px;color:var(--sg-sub);text-decoration:none;border:1px solid var(--sg-line);border-radius:4px;padding:2px 10px}
.wp-block-comment-reply-link a:hover{color:var(--sg-accent);border-color:var(--sg-accent)}
.bypostauthor>.wp-block-columns .wp-block-comment-author-name::after{content:"작성자";margin-left:6px;padding:1px 6px;border-radius:3px;font-size:11px;font-weight:600;color:#fff;background:var(--sg-accent);vertical-align:1px}
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
	wp_register_style( 'sg-comments', false, array(), '1.0.0' );
	wp_enqueue_style( 'sg-comments' );
	wp_add_inline_style( 'sg-comments', $css );

	$js = <<<JS
document.addEventListener('DOMContentLoaded',function(){
  var t=document.getElementById('comment'),f=document.getElementById('commentform');
  if(!t||!f)return;
  var c=f.querySelector('.sg-cf-count b'),w=f.querySelector('.sg-cf-count'),b=f.querySelector('.sg-cf-submit'),max=+t.getAttribute('maxlength');
  function u(){var n=t.value.length;if(c)c.textContent=n;if(w)w.classList.toggle('is-over',n>=max);if(b)b.disabled=!t.value.trim();
    t.style.height='auto';t.style.height=Math.max(96,t.scrollHeight)+'px';}
  t.addEventListener('input',u);u();
});
JS;
	wp_register_script( 'sg-comments', false, array(), '1.0.0', true );
	wp_enqueue_script( 'sg-comments' );
	wp_add_inline_script( 'sg-comments', $js );
} );
