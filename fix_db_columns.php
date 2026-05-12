<?php
include 'common.php';

// 컬럼 추가 SQL
$sql_add_columns = "
ALTER TABLE `g5_shop_default` 
ADD COLUMN `de_all_bodmi_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_m_bodmi_target_date`,
ADD COLUMN `de_all_bodmi_title` varchar(255) NOT NULL DEFAULT '' AFTER `de_all_bodmi_use`,
ADD COLUMN `de_all_bodmi_font_size` varchar(10) NOT NULL DEFAULT '' AFTER `de_all_bodmi_title`,
ADD COLUMN `de_all_bodmi_font_color` varchar(20) NOT NULL DEFAULT '' AFTER `de_all_bodmi_font_size`,
ADD COLUMN `de_all_bodmi_bg_color` varchar(20) NOT NULL DEFAULT '' AFTER `de_all_bodmi_font_color`,
ADD COLUMN `de_all_bodmi_timer_font_size` varchar(10) NOT NULL DEFAULT '' AFTER `de_all_bodmi_bg_color`,
ADD COLUMN `de_all_bodmi_target_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `de_all_bodmi_timer_font_size`
";

echo "Adding columns...\n";
if (sql_query($sql_add_columns, false)) {
    echo "Columns added successfully.\n";
} else {
    echo "Error adding columns: " . sql_error_msg() . "\n";
    // 이미 존재할 수도 있으니 개별적으로 시도
    $cols = array(
        'de_all_bodmi_use' => "tinyint(4) NOT NULL DEFAULT '0'",
        'de_all_bodmi_title' => "varchar(255) NOT NULL DEFAULT ''",
        'de_all_bodmi_font_size' => "varchar(10) NOT NULL DEFAULT ''",
        'de_all_bodmi_font_color' => "varchar(20) NOT NULL DEFAULT ''",
        'de_all_bodmi_bg_color' => "varchar(20) NOT NULL DEFAULT ''",
        'de_all_bodmi_timer_font_size' => "varchar(10) NOT NULL DEFAULT ''",
        'de_all_bodmi_target_date' => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'"
    );
    foreach($cols as $col => $type) {
        sql_query("ALTER TABLE `g5_shop_default` ADD COLUMN `$col` $type", false);
    }
}

// 값 초기화
echo "Initializing values...\n";
$sql_init = "
UPDATE `g5_shop_default` SET
de_all_bodmi_use = '1',
de_all_bodmi_title = '상담신청 사은품',
de_all_bodmi_font_size = '14',
de_all_bodmi_font_color = '#0288d1',
de_all_bodmi_bg_color = '#e1f5fe',
de_all_bodmi_timer_font_size = '15',
de_all_bodmi_target_date = '2026-09-30 23:59:59'
";
if (sql_query($sql_init)) {
    echo "Values initialized successfully.\n";
} else {
    echo "Error initializing values: " . sql_error_msg() . "\n";
}

echo "Done.\n";
?>
