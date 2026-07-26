<?php
/**
 * 404 안내 페이지
 * URL: /page/404.php
 * Apache 연결 예: ErrorDocument 404 /page/404.php (서버 환경에 맞게 설정)
 */
include_once dirname(__FILE__) . '/_init.php';

if (!function_exists('g5site_cfg') && is_file(G5_PATH . '/_site.config.php')) {
    include_once G5_PATH . '/_site.config.php';
}

$err_site_name = function_exists('g5site_cfg') ? g5site_cfg('site_name', '본 사이트') : '본 사이트';
$err_phone     = function_exists('g5site_cfg') ? g5site_cfg('phone', '010-0000-0000') : '010-0000-0000';
$err_tel_link  = function_exists('g5site_tel_link') ? g5site_tel_link($err_phone) : 'tel:' . preg_replace('/[^0-9+]/', '', $err_phone);
$err_home      = defined('G5_URL') ? G5_URL : '/';

http_response_code(404);

$page_title       = '페이지를 찾을 수 없습니다';
$page_description = '요청하신 페이지를 찾을 수 없습니다. ' . $err_site_name;
$page_robots      = 'noindex,nofollow';

g5_page_start('페이지를 찾을 수 없습니다');
?>
<div class="page-template page-404">
    <header class="page-hero reveal">
        <div class="page-inner">
            <p class="page-eyebrow">404</p>
            <h1 class="page-title">페이지를 찾을 수 없습니다</h1>
            <p class="page-lead">주소가 변경되었거나 삭제되었을 수 있습니다.</p>
            <p class="page-desc">아래 버튼으로 홈으로 돌아가거나 전화상담해 주세요.</p>
        </div>
    </header>

    <section class="page-section reveal">
        <div class="page-inner page-inner--narrow">
            <div class="page-actions page-actions--stack">
                <a href="<?php echo htmlspecialchars($err_home, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">홈으로 이동</a>
                <a href="<?php echo htmlspecialchars($err_tel_link, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-secondary">전화상담</a>
            </div>
        </div>
    </section>
</div>
<?php
g5_page_end();
