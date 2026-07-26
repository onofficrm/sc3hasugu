<?php
include_once(dirname(__FILE__).'/_init.php');

$g5_contact_phone = function_exists('g5site_cfg') ? g5site_cfg('phone', '010-0000-0000') : '010-0000-0000';
$g5_contact_tel_display = $g5_contact_phone;
$g5_contact_tel_link = function_exists('g5site_tel_link')
    ? g5site_tel_link($g5_contact_phone)
    : ('tel:' . preg_replace('/[^0-9+]/', '', $g5_contact_phone));
$g5_contact_email = function_exists('g5site_cfg') ? g5site_cfg('email', '') : '';
$g5_contact_address = function_exists('g5site_cfg') ? g5site_cfg('address', '') : '';

g5_page_start('문의하기');
?>
<div class="page-template page-contact">
  <header class="page-hero reveal">
    <div class="page-inner">
      <p class="page-eyebrow">Contact</p>
      <h1 class="page-title">전화상담</h1>
      <p class="page-desc">상담·일정 안내는 전화로만 진행합니다. 증상과 위치를 알려주시면 바로 안내드립니다.</p>
    </div>
  </header>

  <section class="page-section reveal">
    <div class="page-inner">
      <h2 class="page-section__title">연락처</h2>
      <dl class="page-contact-dl">
        <div class="page-contact-dl__row">
          <dt>전화</dt>
          <dd><a href="<?php echo htmlspecialchars($g5_contact_tel_link, ENT_QUOTES, 'UTF-8'); ?>"><?php echo get_text($g5_contact_tel_display); ?></a></dd>
        </div>
        <?php if ($g5_contact_email !== '') { ?>
        <div class="page-contact-dl__row">
          <dt>이메일</dt>
          <dd><a href="mailto:<?php echo get_text($g5_contact_email); ?>"><?php echo get_text($g5_contact_email); ?></a></dd>
        </div>
        <?php } ?>
        <?php if ($g5_contact_address !== '') { ?>
        <div class="page-contact-dl__row">
          <dt>주소</dt>
          <dd><?php echo get_text($g5_contact_address); ?></dd>
        </div>
        <?php } ?>
        <div class="page-contact-dl__row">
          <dt>상담 방식</dt>
          <dd>전화상담 전용</dd>
        </div>
      </dl>
    </div>
  </section>

  <section class="page-section page-cta page-cta--dark reveal">
    <div class="page-inner page-cta__inner">
      <h2 class="page-cta__title">지금 바로 전화상담</h2>
      <p class="page-cta__desc">별도 온라인 접수 없이 전화로만 연결됩니다.</p>
      <div class="page-cta__actions">
        <a href="<?php echo htmlspecialchars($g5_contact_tel_link, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
          <i class="fa fa-phone" aria-hidden="true"></i> <?php echo get_text($g5_contact_tel_display); ?>
        </a>
      </div>
    </div>
  </section>
</div>
<?php
g5_page_end();
