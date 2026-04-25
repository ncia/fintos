<?php
include_once('./common.php');
$sql = "ALTER TABLE `{$g5['g5_shop_default_table']}` 
        ADD `de_bodmi_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_type5_img_height`,
        ADD `de_bodmi_title` varchar(255) NOT NULL DEFAULT '' AFTER `de_bodmi_use`,
        ADD `de_bodmi_font_size` varchar(20) NOT NULL DEFAULT '' AFTER `de_bodmi_title`,
        ADD `de_bodmi_font_color` varchar(20) NOT NULL DEFAULT '' AFTER `de_bodmi_font_size`,
        ADD `de_bodmi_target_date` varchar(20) NOT NULL DEFAULT '' AFTER `de_bodmi_font_color`";
sql_query($sql);
echo "Database columns added successfully.";
?>
