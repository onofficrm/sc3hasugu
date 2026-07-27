<?php
/**
 * 구리시 동별 하수구막힘 랜딩 — 빌더 홈 렌더 + 막힘 전용 콘텐츠 주입
 *
 * 호출 전 설정:
 *   $local_dong_slug
 *   $local_page_url (선택)
 */
if (!isset($local_dong_slug)) {
    exit;
}

if (!defined('_GNUBOARD_')) {
    include_once dirname(__FILE__) . '/../common.php';
}

if (!defined('_GNUBOARD_')) {
    exit;
}

if (is_file(G5_PATH . '/_site.config.php')) {
    include_once G5_PATH . '/_site.config.php';
}

$local_dong_slug = preg_replace('/[^a-z0-9-]/', '', strtolower((string) $local_dong_slug));
$local_dong_name = '';
$local_area_profile = array();

if (function_exists('g5site_public_profile')) {
    $public_profile = g5site_public_profile();
    $profile_areas = isset($public_profile['localAreas']) && is_array($public_profile['localAreas'])
        ? $public_profile['localAreas']
        : array();
    foreach ($profile_areas as $profile_area) {
        if (isset($profile_area['slug'], $profile_area['name'])
            && (string) $profile_area['slug'] === $local_dong_slug) {
            $local_dong_name = trim(strip_tags((string) $profile_area['name']));
            $local_area_profile = $profile_area;
            break;
        }
    }
}

if ($local_dong_slug === '' || $local_dong_name === '') {
    http_response_code(404);
    exit('등록되지 않은 지역입니다.');
}

$project_id = function_exists('g5site_cfg') ? g5site_cfg('home_builder_bridge_id', 'gangdong-drain') : 'gangdong-drain';
$project_id = preg_replace('/[^a-z0-9_-]/i', '', (string) $project_id);
if ($project_id === '') {
    $project_id = 'gangdong-drain';
}

if (!is_file(G5_PLUGIN_PATH . '/onoff-builder-bridge/bootstrap.php')) {
    header('Location: /?dong=' . rawurlencode($local_dong_name));
    exit;
}

include_once G5_PLUGIN_PATH . '/onoff-builder-bridge/bootstrap.php';

if (!function_exists('onoff_builder_project_exists') || !onoff_builder_project_exists($project_id)) {
    header('Location: /?dong=' . rawurlencode($local_dong_name));
    exit;
}

$meta = function_exists('onoff_builder_get_import') ? onoff_builder_get_import($project_id) : null;
$entry = function_exists('onoff_builder_resolve_import_entry')
    ? onoff_builder_resolve_import_entry($project_id, $meta ? $meta : array())
    : 'index.html';
$index_file = function_exists('onoff_builder_resolve_import_index_file')
    ? onoff_builder_resolve_import_index_file($project_id, $entry)
    : '';

if ($index_file === '' || !is_file($index_file)) {
    header('Location: /?dong=' . rawurlencode($local_dong_name));
    exit;
}

$html = @file_get_contents($index_file);
if ($html === false || $html === '') {
    header('Location: /?dong=' . rawurlencode($local_dong_name));
    exit;
}

if (function_exists('onoff_builder_remove_base_tags')) {
    $html = onoff_builder_remove_base_tags($html);
}
if (function_exists('onoff_builder_rewrite_asset_paths')) {
    $html = onoff_builder_rewrite_asset_paths($html, $project_id, $entry);
}

$site_name = function_exists('g5site_cfg') ? g5site_cfg('site_name', '원진하수구') : '원진하수구';
$clean_url = !empty($local_area_profile['url'])
    ? (string) $local_area_profile['url']
    : '/page/local-' . $local_dong_slug . '.php';
$clog_url = isset($local_page_url) && $local_page_url !== ''
    ? (string) $local_page_url
    : (!empty($local_area_profile['clog_url'])
        ? (string) $local_area_profile['clog_url']
        : '/page/clog-' . $local_dong_slug . '.php');

$page_title = !empty($local_area_profile['clog_meta_title'])
    ? (string) $local_area_profile['clog_meta_title'] . ' | ' . $site_name
    : $local_dong_name . ' 하수구막힘 | ' . $site_name;
$page_desc = !empty($local_area_profile['clog_meta_description'])
    ? (string) $local_area_profile['clog_meta_description']
    : $local_dong_name . ' 하수구막힘과 싱크대·변기·배수구 역류·넘침 전화상담.';
$canonical = (defined('G5_URL') ? G5_URL : '') . $clog_url;

$clog_profile = $local_area_profile;
$clog_profile['label'] = $local_dong_name . ' 하수구막힘';
$clog_profile['focus'] = 'clog';
$clog_profile['clean_url'] = $clean_url;
$clog_profile['clog_url'] = $clog_url;
$clog_profile['guide_title'] = !empty($local_area_profile['clog_guide_title'])
    ? (string) $local_area_profile['clog_guide_title']
    : $local_dong_name . ' 하수구막힘, 역류·넘침 전에 확인할 점';
$clog_profile['guide_body'] = !empty($local_area_profile['clog_guide_body'])
    ? (string) $local_area_profile['clog_guide_body']
    : $local_dong_name . '에서 물이 안 내려가거나 역류·넘침이 보이면 사용을 줄이고 막힌 위치와 발생 시점을 확인하세요.';
if (!empty($local_area_profile['clog_issues']) && is_array($local_area_profile['clog_issues'])) {
    $clog_profile['issues'] = $local_area_profile['clog_issues'];
}
if (!empty($local_area_profile['clog_faq']) && is_array($local_area_profile['clog_faq'])) {
    $clog_profile['faq'] = $local_area_profile['clog_faq'];
}

if (function_exists('onoff_builder_inject_site_profile')) {
    $html = onoff_builder_inject_site_profile($html, $project_id, array(
        'activeArea' => $local_dong_name,
        'activeAreaDetails' => $clog_profile,
        'pageFocus' => 'clog',
        'seoTitle' => $page_title,
        'seoDescription' => $page_desc,
        'mainKeyword' => $local_dong_name . ' 하수구막힘',
        'secondaryKeywords' => array(
            $local_dong_name . ' 하수구청소',
            $local_dong_name . ' 싱크대 막힘',
            $local_dong_name . ' 변기 막힘',
            $local_dong_name . ' 배수구 막힘',
            $local_dong_name . ' 하수구 역류',
        ),
        'canonical' => $canonical,
    ));
}

header('Content-Type: text/html; charset=utf-8');
echo $html;
exit;
