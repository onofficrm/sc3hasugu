<?php
if (!defined('_GNUBOARD_')) exit;
include_once(G5_PATH.'/section/_helpers.php');

$phone = function_exists('g5site_cfg') ? g5site_cfg('phone', '') : '';
$tel = function_exists('g5site_tel_link') ? g5site_tel_link($phone) : ('tel:' . preg_replace('/[^0-9+]/', '', $phone));
?>
<section class="section section-hero" id="section-hero">
  <div class="section-inner section-hero__inner">
    <div class="section-hero__content reveal">
      <p class="section-eyebrow">Welcome</p>
      <h2 class="section-title">하수구·싱크대·변기 막힘<br>지금 바로 전화상담</h2>
      <p class="section-desc">별도 온라인 접수 없이 전화로만 안내드립니다. 증상과 위치를 말씀해 주세요.</p>
      <div class="section-actions">
        <a href="<?php echo htmlspecialchars($tel, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">전화상담</a>
        <a href="#section-service" class="btn btn-outline">서비스 보기</a>
      </div>
    </div>
    <div class="section-hero__visual reveal">
      <?php g5_sample_main_media('hero.jpg', '메인 비주얼', 'section-hero__img', 'hero'); ?>
    </div>
  </div>
</section>
