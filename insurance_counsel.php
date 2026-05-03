<?php
include_once('./_common.php');

if (!defined('_EYOOM_')) define('_EYOOM_', true);

$g5['title'] = '상품별 보험 상담하기';

// 상품 정보가 넘어온 경우 (it_id)
$it_id = isset($_REQUEST['it_id']) ? clean_xss_tags($_REQUEST['it_id']) : '';
$it_name = '';
$it_brand = '';
if ($it_id) {
    $it = sql_fetch("select it_name, it_brand from {$g5['g5_shop_item_table']} where it_id = '$it_id'");
    $it_name = $it['it_name'];
    $it_brand = $it['it_brand'];
}

include_once(G5_PATH.'/head.php');

$member_skin_path = EYOOM_THEME_PATH.'/skin/member/basic';
$member_skin_url = EYOOM_THEME_URL.'/skin/member/basic';

include_once($member_skin_path.'/insurance_counsel.skin.html.php');

include_once(G5_PATH.'/tail.php');
?>
