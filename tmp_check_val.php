<?php
include_once('./_common.php');
$row = sql_fetch("select de_bodmi_font_size from {$g5['g5_shop_default_table']}");
echo "VALUE:[" . $row['de_bodmi_font_size'] . "]";
?>
