<?php
include_once('./_common.php');
$sql = "select br_name, br_img_wide from {$g5['eyoom_brand']}";
$res = sql_query($sql);
$data = array();
while($row = sql_fetch_array($res)) {
    $data[] = $row;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
