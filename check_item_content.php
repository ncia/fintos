<?php
include_once('./_common.php');
$it_id = '1776008318';
$it = sql_fetch("select it_explan_example from {$g5['g5_shop_item_table']} where it_id = '$it_id'");
echo "--- it_explan_example ---\n";
echo $it['it_explan_example'];
?>
