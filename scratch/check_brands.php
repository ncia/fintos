<?php
include_once('./_common.php');
$res = sql_query("select it_id, it_name, it_brand from {$g5['g5_shop_item_table']} where it_brand != '' limit 10");
while($row = sql_fetch_array($res)) {
    echo "ID: {$row['it_id']} | Brand: {$row['it_brand']} | Name: {$row['it_name']}\n";
}
?>
