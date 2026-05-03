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

    // DB에 브랜드가 없더라도 상품명에 특정 키워드가 있으면 브랜드를 강제로 지정 (디비 외의 방법)
    if (!$it_brand) {
        if (strpos($it_name, '삼성 밸런스') !== false || strpos($it_name, '다사랑') !== false) {
            $it_brand = '삼성생명';
        } else if (strpos($it_name, 'KB') !== false) {
            $it_brand = 'KB라이프';
        }
        // 필요에 따라 추가 키워드 매핑 가능
    }
}

include_once(G5_PATH.'/head.php');

$member_skin_path = EYOOM_THEME_PATH.'/skin/member/basic';
$member_skin_url = EYOOM_THEME_URL.'/skin/member/basic';

include_once($member_skin_path.'/insurance_counsel.skin.html.php');

include_once(G5_PATH.'/tail.php');
?>
