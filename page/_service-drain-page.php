<?php
if (!isset($service_slug, $service_name, $service_keyword, $service_description, $service_intro)) {
    exit;
}

include_once __DIR__ . '/_init.php';
include_once G5_PATH . '/_site.config.php';

$service_signs = isset($service_signs) && is_array($service_signs) ? $service_signs : array();
$service_checks = isset($service_checks) && is_array($service_checks) ? $service_checks : array();
$service_faqs = isset($service_faqs) && is_array($service_faqs) ? $service_faqs : array();
$service_phone = g5site_cfg('phone', '');
$service_tel = g5site_tel_link($service_phone);
$page_title = $service_keyword . ' | 원진하수구';
$page_description = $service_description;
$page_keywords = $service_keyword . ',구리하수구청소,구리 하수구막힘,원진하수구';
$canonical_url = (defined('G5_URL') ? G5_URL : '') . '/page/service-' . $service_slug . '.php';
$page_canonical = $canonical_url;

g5_page_start($service_name);
?>
<div class="page-template page-service">
  <header class="page-hero reveal">
    <div class="page-inner">
      <nav aria-label="현재 위치" class="page-breadcrumb">
        <a href="<?php echo G5_URL; ?>/">홈</a> /
        <span>구리하수구청소</span> /
        <span aria-current="page"><?php echo get_text($service_name); ?></span>
      </nav>
      <p class="page-eyebrow">GURI DRAIN SERVICE</p>
      <h1 class="page-title"><?php echo get_text($service_keyword); ?></h1>
      <p class="page-desc"><?php echo get_text($service_description); ?></p>
      <div class="page-cta__actions">
        <a href="<?php echo htmlspecialchars($service_tel, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">전화상담 <?php echo get_text($service_phone); ?></a>
        <a href="<?php echo G5_URL; ?>/#areas" class="btn btn-outline">구리 지역별 안내</a>
      </div>
    </div>
  </header>

  <main>
    <section class="page-section reveal">
      <div class="page-inner page-inner--narrow">
        <h2 class="page-section__title"><?php echo get_text($service_name); ?>, 원인 확인이 먼저입니다</h2>
        <p class="page-section__desc"><?php echo get_text($service_intro); ?></p>

        <h3 class="page-section__subtitle">이런 증상을 확인하세요</h3>
        <ul class="page-list">
          <?php foreach ($service_signs as $sign) { ?>
          <li><?php echo get_text($sign); ?></li>
          <?php } ?>
        </ul>
      </div>
    </section>

    <section class="page-section page-section--alt reveal">
      <div class="page-inner page-inner--narrow">
        <h2 class="page-section__title">원진하수구 확인 순서</h2>
        <ol class="page-list">
          <?php foreach ($service_checks as $check) { ?>
          <li><?php echo get_text($check); ?></li>
          <?php } ?>
        </ol>
        <p class="page-section__desc">배관 구조와 막힘 정도에 따라 작업 방식과 비용이 달라질 수 있습니다. 전화상담 후 현장에서 정확한 범위를 확인합니다.</p>
      </div>
    </section>

    <?php if ($service_faqs) { ?>
    <section class="page-section reveal">
      <div class="page-inner page-inner--narrow">
        <h2 class="page-section__title"><?php echo get_text($service_name); ?> 자주 묻는 질문</h2>
        <div class="faq-list">
          <?php foreach ($service_faqs as $faq) { ?>
          <article class="faq-item">
            <h3>Q. <?php echo get_text($faq['question']); ?></h3>
            <p>A. <?php echo get_text($faq['answer']); ?></p>
          </article>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php } ?>

    <section class="page-section page-cta page-cta--dark reveal">
      <div class="page-inner page-cta__inner">
        <h2 class="page-cta__title"><?php echo get_text($service_keyword); ?> 전화상담</h2>
        <p class="page-cta__desc">현재 증상과 구리시 내 위치를 알려주시면 확인해야 할 항목을 안내합니다.</p>
        <a href="<?php echo htmlspecialchars($service_tel, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
          <i class="fa fa-phone" aria-hidden="true"></i> <?php echo get_text($service_phone); ?>
        </a>
      </div>
    </section>
  </main>
</div>

<script type="application/ld+json">
<?php
$service_schema = array(
    '@context' => 'https://schema.org',
    '@graph' => array(
        array(
            '@type' => 'Service',
            'name' => $service_keyword,
            'serviceType' => $service_name,
            'areaServed' => '구리시',
            'provider' => array('@type' => 'LocalBusiness', 'name' => '원진하수구', 'telephone' => $service_phone),
            'url' => $canonical_url,
        ),
        array(
            '@type' => 'BreadcrumbList',
            'itemListElement' => array(
                array('@type' => 'ListItem', 'position' => 1, 'name' => '홈', 'item' => (defined('G5_URL') ? G5_URL : '') . '/'),
                array('@type' => 'ListItem', 'position' => 2, 'name' => $service_keyword, 'item' => $canonical_url),
            ),
        ),
    ),
);
if ($service_faqs) {
    $entities = array();
    foreach ($service_faqs as $faq) {
        $entities[] = array(
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => array('@type' => 'Answer', 'text' => $faq['answer']),
        );
    }
    $service_schema['@graph'][] = array('@type' => 'FAQPage', 'mainEntity' => $entities);
}
echo json_encode($service_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
?>
</script>
<?php
g5_page_end();
