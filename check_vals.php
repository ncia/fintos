<?php
include_once('./_common.php');
$sql = "select * from g5_shop_default";
$row = sql_fetch($sql);
echo "DE_BODMI_FONT_COLOR: [" . $row['de_bodmi_font_color'] . "]\n";
echo "DE_M_BODMI_FONT_COLOR: [" . $row['de_m_bodmi_font_color'] . "]\n";
echo "DE_BODMI_TITLE: [" . $row['de_bodmi_title'] . "]\n";
echo "DE_M_BODMI_TITLE: [" . $row['de_m_bodmi_title'] . "]\n";
?>
