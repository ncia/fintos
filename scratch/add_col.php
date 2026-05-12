<?php
include_once('./common.php');
sql_query("ALTER TABLE g5_shop_default ADD de_bodmi_timer_font_size varchar(255) NOT NULL DEFAULT '16' AFTER de_bodmi_font_size", false);
sql_query("ALTER TABLE g5_shop_default ADD de_m_bodmi_timer_font_size varchar(255) NOT NULL DEFAULT '16' AFTER de_m_bodmi_font_size", false);
echo 'DONE';
?>
