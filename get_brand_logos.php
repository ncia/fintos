<?php
include_once('./_common.php');
$res = sql_query("select br_name, br_img_wide from {$g5['eyoom_brand']} where br_img_wide != ''");
$brand_logos = array();
while($row = sql_fetch_array($res)) {
    $brand_logos[$row['br_name']] = G5_DATA_URL.'/brand/wide_logo/'.$row['br_img_wide'];
}
echo json_encode($brand_logos, JSON_UNESCAPED_UNICODE);
?>
