<?php
include_once('./common.php');
sql_query("ALTER TABLE g5_shop_default DROP de_bodmi_timer_font_size", false);
sql_query("ALTER TABLE g5_shop_default DROP de_m_bodmi_timer_font_size", false);
echo 'DONE';
?>
