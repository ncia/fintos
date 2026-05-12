<?php
include_once('./common.php');

if (php_sapi_name() != 'cli') {
    if ($is_admin != 'super') die('Access denied');
}

$sql = "ALTER TABLE `{$g5['g5_shop_default_table']}` 
        DROP COLUMN `de_bodmi_timer_font_size`,
        DROP COLUMN `de_bodmi_bg_color` ";

if (sql_query($sql, false)) {
    echo "Successfully dropped mobile countdown columns.";
} else {
    echo "Failed to drop columns or they don't exist.";
}
?>
