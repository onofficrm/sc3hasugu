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
$cmp_desc = g5site_cfg('footer_desc', '지금 바로 전화상담 하세요.');
?>

<section class="cmp-bottom-cta" aria-labelledby="cmpBottomCtaTitle">
    <div class="cmp-bottom-cta__inner">
        <h2 id="cmpBottomCtaTitle" class="cmp-bottom-cta__title">전화상담이 필요하신가요?</h2>
        <p class="cmp-bottom-cta__desc"><?php echo htmlspecialchars($cmp_desc, ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="cmp-bottom-cta__actions">
            <a href="<?php echo htmlspecialchars($cmp_tel_link, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary cmp-bottom-cta__btn">
                <i class="fa fa-phone" aria-hidden="true"></i> 전화상담
            </a>
        </div>
    </div>
</section>
