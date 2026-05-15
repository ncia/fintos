<?php
include_once('./_common.php');
$it = sql_fetch("select it_brand, it_brand_logo, it_explan from {$g5['shop_item_table']} where it_id = '1776008318'");
echo "BRAND: [" . $it['it_brand'] . "]\n";
echo "LOGO: [" . $it['it_brand_logo'] . "]\n";
echo "EXPLAN SNIPPET: \n" . substr($it['it_explan'], 0, 500) . "\n";
?>
