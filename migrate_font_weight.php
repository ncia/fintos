<?php
include_once('./common.php');

$table = $g5['g5_shop_default_table'];

// Check if columns exist
$res = sql_query("SHOW COLUMNS FROM `$table` LIKE 'de_bodmi_font_weight'");
if (sql_num_rows($res) == 0) {
    sql_query("ALTER TABLE `$table` ADD `de_bodmi_font_weight` VARCHAR(10) NOT NULL DEFAULT '' AFTER `de_bodmi_font_size` ");
    echo "de_bodmi_font_weight added\n";
} else {
    echo "de_bodmi_font_weight already exists\n";
}

$res = sql_query("SHOW COLUMNS FROM `$table` LIKE 'de_all_bodmi_font_weight'");
if (sql_num_rows($res) == 0) {
    sql_query("ALTER TABLE `$table` ADD `de_all_bodmi_font_weight` VARCHAR(10) NOT NULL DEFAULT '' AFTER `de_all_bodmi_font_size` ");
    echo "de_all_bodmi_font_weight added\n";
} else {
    echo "de_all_bodmi_font_weight already exists\n";
}
?>
