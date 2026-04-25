<?php
include_once('./_common.php');
if ($is_admin != 'super') exit;

$cols = array(
    'de_bodmi_use' => "tinyint(4) NOT NULL DEFAULT '0'",
    'de_bodmi_title' => "varchar(255) NOT NULL DEFAULT ''",
    'de_bodmi_font_size' => "varchar(10) NOT NULL DEFAULT ''",
    'de_bodmi_font_color' => "varchar(20) NOT NULL DEFAULT ''",
    'de_bodmi_target_date' => "varchar(20) NOT NULL DEFAULT ''"
);

foreach($cols as $col => $type) {
    if(!sql_query(" SELECT $col FROM {$g5['shop_default_table']} ", false)) {
        sql_query(" ALTER TABLE {$g5['shop_default_table']} ADD $col $type ", true);
        echo "Added column $col\n";
    } else {
        echo "Column $col already exists\n";
    }
}
?>
