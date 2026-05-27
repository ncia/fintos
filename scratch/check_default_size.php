<?php
include_once('./_common.php');
$row = sql_fetch("select de_all_bodmi_font_size, de_all_bodmi_timer_font_size from {$g5['g5_shop_default_table']} limit 1");
if (!$row) {
    $row = sql_fetch("select de_all_bodmi_font_size, de_all_bodmi_timer_font_size from g5_shop_default limit 1");
}
echo 'FONT_SIZE: ' . $row['de_all_bodmi_font_size'] . PHP_EOL;
echo 'TIMER_FONT_SIZE: ' . $row['de_all_bodmi_timer_font_size'] . PHP_EOL;
?>
