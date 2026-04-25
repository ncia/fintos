<?php
include_once('./_common.php');
$res = sql_query("show columns from {$g5['g5_shop_default_table']} like 'de_bodmi_bg_color'");
if(sql_num_rows($res) == 0) {
    sql_query("alter table {$g5['g5_shop_default_table']} add de_bodmi_bg_color varchar(255) not null default '#000000' AFTER de_bodmi_font_color");
    echo "COLUMN_ADDED";
} else {
    echo "COLUMN_EXISTS";
}
?>
