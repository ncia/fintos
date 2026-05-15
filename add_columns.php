<?php
include_once('./common.php');
if (!$is_admin) exit;

sql_query("ALTER TABLE {$g5['shop_default_table']} ADD COLUMN de_bodmi_font_weight varchar(10) NOT NULL DEFAULT '' AFTER de_bodmi_font_size", false);
sql_query("ALTER TABLE {$g5['shop_default_table']} ADD COLUMN de_all_bodmi_font_weight varchar(10) NOT NULL DEFAULT '' AFTER de_all_bodmi_font_size", false);

echo "Success";
?>
