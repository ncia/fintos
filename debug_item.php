<?php
include_once('./_common.php');
$row = sql_fetch("select it_explan, it_brand, it_brand_logo from {$g5['shop_item_table']} where it_name like '%삼성 행복종신보험%' limit 1");
echo "BRAND: [" . $row['it_brand'] . "]\n";
echo "LOGO: [" . $row['it_brand_logo'] . "]\n";
echo "EXPLAN: \n" . $row['it_explan'] . "\n";
?>
