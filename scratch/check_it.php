<?php
include_once('./_common.php');
$it_id = '1775931123';
$it = sql_fetch("select it_name, it_brand from {$g5['g5_shop_item_table']} where it_id = '$it_id'");
print_r($it);
?>
