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
$cmp_site_name = g5site_cfg('site_name', '샘플 사이트');
?>

<div id="cmpPopupBanner" class="cmp-popup" role="dialog" aria-modal="true" aria-labelledby="cmpPopupTitle" aria-hidden="true" hidden>
    <div class="cmp-popup__backdrop" aria-hidden="true"></div>
    <div class="cmp-popup__panel">
        <button type="button" class="cmp-popup__close" aria-label="팝업 닫기">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <p class="cmp-popup__badge">안내</p>
        <h2 id="cmpPopupTitle" class="cmp-popup__title"><?php echo htmlspecialchars($cmp_site_name, ENT_QUOTES, 'UTF-8'); ?></h2>
        <p class="cmp-popup__desc">하수구·싱크대·변기 막힘은 전화상담으로 바로 안내드립니다.</p>
        <div class="cmp-popup__actions">
            <a href="<?php echo htmlspecialchars($cmp_tel_link, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary cmp-popup__cta">전화상담</a>
            <button type="button" class="btn btn-outline cmp-popup__close-btn">닫기</button>
        </div>
        <label class="cmp-popup__today">
            <input type="checkbox" id="cmpPopupToday" value="1">
            <span>오늘 하루 보지 않기</span>
        </label>
    </div>
</div>
