<?php
/**
 * 지역 SEO 사이트 복제 템플릿
 *
 * 사용법:
 * 1. 이 파일을 `_site.clone.config.php` 로 복사
 * 2. [사이트마다 변경] 블록만 지역·키워드에 맞게 수정
 * 3. [공통 유지] 블록의 전화번호는 전 사이트 동일하게 유지
 *
 * React 재빌드 없이 홈 CTA·SEO 메타·지역 목록에 반영됩니다.
 */
if (!defined('_GNUBOARD_')) {
    exit;
}

return array(
    /* =========================================================
     * [공통 유지] — 복사 사이트 전부 동일
     * 홈 히어로·헤더·하단바·CTA에 크게 표시되고 tel: 링크로 연결됩니다.
     * ========================================================= */
    'phone' => '010-4265-2634',
    'ceo_name' => '',
    'business_no' => '',
    'email' => '',
    'builder_project_id' => 'gangdong-drain',

    /* =========================================================
     * [사이트마다 변경] — 지역 SEO용
     * ========================================================= */
    'region_name' => '구리시',
    'region_short' => '구리',
    'region_initial' => '원',
    'company_name' => '원진하수구',
    'address' => '',

    'site_name' => '원진하수구',
    'site_desc' => '구리시 하수구청소와 싱크대·변기·배수구 막힘 전화상담',
    'seo_title' => '구리하수구청소 | 원진하수구',
    'seo_description' => '구리시 동별 하수구청소와 배관 막힘 전화상담 안내',
    'main_keyword' => '구리하수구청소',
    'sub_keywords' => array(
        '구리 하수구막힘',
        '구리 싱크대막힘',
        '구리 변기막힘',
        '구리 배수구청소',
    ),
    'footer_desc' => '원진하수구 — 구리시 하수구청소 전화상담',

    /* 지역 선택·동별 랜딩. 고정 URL이 없으면 /page/local.php?area=slug 사용 */
    'local_areas' => array(
        array('slug' => 'galmae', 'name' => '갈매동', 'label' => '갈매동 하수구청소', 'url' => '/page/local-galmae.php'),
        array('slug' => 'inchang', 'name' => '인창동', 'label' => '인창동 하수구청소', 'url' => '/page/local-inchang.php'),
        array('slug' => 'sutaek', 'name' => '수택동', 'label' => '수택동 하수구청소', 'url' => '/page/local-sutaek.php'),
    ),
    'area_spots' => array(
        '갈매역 인근', '구리역 인근', '구리전통시장',
    ),

    /* 실제 확인된 후기만 추가합니다. */
    'reviews' => array(),
);
