<?php
if (!defined('_GNUBOARD_')) {
    exit;
}

if (!function_exists('g5site_cfg')) {
    if (is_file(G5_PATH . '/_site.config.php')) {
        include_once G5_PATH . '/_site.config.php';
    }
}

$cmp_phone = g5site_cfg('phone', '010-0000-0000');
$cmp_tel_link = g5site_tel_link($cmp_phone);
?>

<aside id="siteDock" class="site-dock cmp-floating is-all-pages" aria-label="하단 빠른 메뉴">
    <a href="<?php echo htmlspecialchars($cmp_tel_link, ENT_QUOTES, 'UTF-8'); ?>" class="site-dock__btn site-dock__btn--tel cmp-floating__btn cmp-floating__btn--tel">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <span>전화상담</span>
    </a>
    <button type="button" id="top_btn" class="site-dock__btn site-dock__btn--top cmp-floating__btn cmp-floating__btn--top" title="상단으로">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
        <span class="sound_only">상단으로</span>
    </button>
</aside>
