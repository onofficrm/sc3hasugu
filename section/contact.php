<?php
if (!defined('_GNUBOARD_')) exit;

$g5_contact_phone = function_exists('g5site_cfg') ? g5site_cfg('phone', '010-0000-0000') : '010-0000-0000';
$g5_contact_tel_display = $g5_contact_phone;
$g5_contact_tel_link = function_exists('g5site_tel_link')
    ? g5site_tel_link($g5_contact_phone)
    : ('tel:' . preg_replace('/[^0-9+]/', '', $g5_contact_phone));
?>
<section class="section section-contact section--dark" id="section-contact">
  <div class="section-inner">
    <div class="section-head reveal">
      <p class="section-eyebrow">Contact</p>
      <h2 class="section-title">지금 바로 전화상담</h2>
      <p class="section-desc">별도 온라인 접수 없이 전화로 바로 연결됩니다. 증상과 위치를 알려주세요.</p>
    </div>
    <div class="section-content reveal">
      <div class="contact-cta">
        <a href="<?php echo htmlspecialchars($g5_contact_tel_link, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary contact-cta__tel">
          <i class="fa fa-phone" aria-hidden="true"></i>
          <?php echo get_text($g5_contact_tel_display); ?>
        </a>
      </div>
      <ul class="contact-info">
        <li><strong>상담 방식</strong> 전화상담 전용</li>
        <li><strong>응답</strong> 통화 중 바로 안내</li>
      </ul>
    </div>
  </div>
</section>
