<?php
include_once('./common.php');
$res = sql_query("SHOW COLUMNS FROM g5_shop_default LIKE 'de_bodmi_timer_font_size'");
if(sql_num_rows($res)) echo 'EXISTS';
else echo 'MISSING';
?>
