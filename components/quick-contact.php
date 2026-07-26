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

<aside class="cmp-quick-contact" aria-label="빠른 전화상담">
    <div class="cmp-quick-contact__inner">
        <p class="cmp-quick-contact__title">전화상담</p>
        <p class="cmp-quick-contact__desc">지금 바로 전화로 연락해 주세요.</p>
        <div class="cmp-quick-contact__actions">
            <a href="<?php echo htmlspecialchars($cmp_tel_link, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary cmp-quick-contact__btn">
                <i class="fa fa-phone" aria-hidden="true"></i> <?php echo htmlspecialchars($cmp_phone, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </div>
    </div>
</aside>
