<?php
if (!isset(
    $guide_slug,
    $guide_title,
    $guide_description,
    $guide_answer,
    $guide_intro,
    $guide_causes,
    $guide_actions,
    $guide_checks,
    $guide_faqs
)) {
    exit;
}

include_once __DIR__ . '/_init.php';
include_once G5_PATH . '/_site.config.php';

$guide_published = isset($guide_published) ? (string) $guide_published : '2026-07-26';
$guide_modified = isset($guide_modified) ? (string) $guide_modified : $guide_published;
$guide_phone = g5site_cfg('phone', '');
$guide_tel = g5site_tel_link($guide_phone);
$guide_company = g5site_cfg('company_name', '원진하수구');
$guide_url = (defined('G5_URL') ? G5_URL : '') . '/page/guide-' . $guide_slug . '.php';

$page_title = $guide_title . ' | ' . $guide_company;
$page_description = $guide_description;
$page_keywords = '구리하수구청소,' . $guide_title . ',원진하수구';
$page_canonical = $guide_url;
$page_robots = 'index,follow';

g5_page_start($guide_title);
?>
<div class="page-template page-guide">
  <header class="page-hero reveal">
    <div class="page-inner">
      <nav aria-label="현재 위치" class="page-breadcrumb">
        <a href="<?php echo G5_URL; ?>/">홈</a> /
        <a href="<?php echo G5_URL; ?>/#guide-hub">배관 관리 안내</a> /
        <span aria-current="page"><?php echo get_text($guide_title); ?></span>
      </nav>
      <p class="page-eyebrow">WONJIN DRAIN GUIDE</p>
      <h1 class="page-title"><?php echo get_text($guide_title); ?></h1>
      <p class="page-desc"><?php echo get_text($guide_description); ?></p>
      <p class="page-meta">
        작성·검수: <?php echo get_text($guide_company); ?> ·
        최초 작성 <time datetime="<?php echo get_text($guide_published); ?>"><?php echo get_text($guide_published); ?></time> ·
        최종 수정 <time datetime="<?php echo get_text($guide_modified); ?>"><?php echo get_text($guide_modified); ?></time>
      </p>
    </div>
  </header>

  <main>
    <section class="page-section reveal" aria-labelledby="guide-direct-answer">
      <div class="page-inner page-inner--narrow">
        <div class="base-card">
          <p class="page-eyebrow">핵심 답변</p>
          <h2 id="guide-direct-answer" class="page-section__title"><?php echo get_text($guide_title); ?></h2>
          <p class="page-section__desc"><strong><?php echo get_text($guide_answer); ?></strong></p>
        </div>
      </div>
    </section>

    <section class="page-section page-section--alt reveal">
      <div class="page-inner page-inner--narrow">
        <h2 class="page-section__title">먼저 알아둘 점</h2>
        <p class="page-section__desc"><?php echo get_text($guide_intro); ?></p>

        <h3 class="page-section__subtitle">주요 원인</h3>
        <ul class="page-list">
          <?php foreach ($guide_causes as $cause) { ?>
          <li><?php echo get_text($cause); ?></li>
          <?php } ?>
        </ul>
      </div>
    </section>

    <section class="page-section reveal">
      <div class="page-inner page-inner--narrow">
        <h2 class="page-section__title">지금 할 수 있는 안전한 조치</h2>
        <ol class="page-list">
          <?php foreach ($guide_actions as $action) { ?>
          <li><?php echo get_text($action); ?></li>
          <?php } ?>
        </ol>

        <h3 class="page-section__subtitle">전화상담 전에 확인할 내용</h3>
        <ul class="page-list">
          <?php foreach ($guide_checks as $check) { ?>
          <li><?php echo get_text($check); ?></li>
          <?php } ?>
        </ul>
      </div>
    </section>

    <section class="page-section page-section--alt reveal" aria-labelledby="guide-faq-title">
      <div class="page-inner page-inner--narrow">
        <h2 id="guide-faq-title" class="page-section__title">자주 묻는 질문</h2>
        <div class="faq-list">
          <?php foreach ($guide_faqs as $faq) { ?>
          <article class="faq-item">
            <h3>Q. <?php echo get_text($faq['question']); ?></h3>
            <p>A. <?php echo get_text($faq['answer']); ?></p>
          </article>
          <?php } ?>
        </div>
      </div>
    </section>

    <section class="page-section page-cta page-cta--dark reveal">
      <div class="page-inner page-cta__inner">
        <h2 class="page-cta__title">구리시 하수구 증상 전화상담</h2>
        <p class="page-cta__desc">현재 위치와 발생한 증상을 알려주시면 먼저 확인할 항목을 안내합니다.</p>
        <div class="page-cta__actions">
          <a href="<?php echo htmlspecialchars($guide_tel, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
            <i class="fa fa-phone" aria-hidden="true"></i> <?php echo get_text($guide_phone); ?>
          </a>
          <a href="<?php echo G5_URL; ?>/#areas" class="btn btn-outline">구리 동별 안내</a>
        </div>
      </div>
    </section>
  </main>
</div>

<script type="application/ld+json">
<?php
$faq_entities = array();
foreach ($guide_faqs as $faq) {
    $faq_entities[] = array(
        '@type' => 'Question',
        'name' => $faq['question'],
        'acceptedAnswer' => array('@type' => 'Answer', 'text' => $faq['answer']),
    );
}

$guide_schema = array(
    '@context' => 'https://schema.org',
    '@graph' => array(
        array(
            '@type' => 'Article',
            '@id' => $guide_url . '#article',
            'headline' => $guide_title,
            'description' => $guide_description,
            'datePublished' => $guide_published,
            'dateModified' => $guide_modified,
            'mainEntityOfPage' => array('@type' => 'WebPage', '@id' => $guide_url),
            'author' => array('@type' => 'Organization', 'name' => $guide_company),
            'publisher' => array('@type' => 'Organization', 'name' => $guide_company),
            'about' => array('하수구청소', '배수구 관리', '구리시'),
        ),
        array(
            '@type' => 'FAQPage',
            '@id' => $guide_url . '#faq',
            'mainEntity' => $faq_entities,
        ),
        array(
            '@type' => 'BreadcrumbList',
            '@id' => $guide_url . '#breadcrumb',
            'itemListElement' => array(
                array('@type' => 'ListItem', 'position' => 1, 'name' => '홈', 'item' => (defined('G5_URL') ? G5_URL : '') . '/'),
                array('@type' => 'ListItem', 'position' => 2, 'name' => '배관 관리 안내', 'item' => (defined('G5_URL') ? G5_URL : '') . '/#guide-hub'),
                array('@type' => 'ListItem', 'position' => 3, 'name' => $guide_title, 'item' => $guide_url),
            ),
        ),
    ),
);
echo json_encode($guide_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
?>
</script>
<?php
g5_page_end();
