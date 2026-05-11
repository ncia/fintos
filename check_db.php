<?php
include_once('./common.php');
$row = sql_fetch("select * from {$g5['g5_shop_item_use_table']} order by is_id desc limit 1");
var_dump($row);
?>
