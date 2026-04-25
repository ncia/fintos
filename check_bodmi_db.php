<?php
include_once('./_common.php');
$sql = "select de_bodmi_font_color, de_m_bodmi_font_color, de_bodmi_title, de_m_bodmi_title from {$g5['shop_default_table']}";
$row = sql_fetch($sql);
echo "PC COLOR: " . $row['de_bodmi_font_color'] . "\n";
echo "MO COLOR: " . $row['de_m_bodmi_font_color'] . "\n";
echo "PC TITLE: " . $row['de_bodmi_title'] . "\n";
echo "MO TITLE: " . $row['de_m_bodmi_title'] . "\n";
?>
