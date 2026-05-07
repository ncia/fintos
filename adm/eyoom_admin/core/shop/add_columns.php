<?php
include_once('./common.php');

$columns = [
    'it_explan_example' => 'text NOT NULL',
    'it_mobile_explan_example' => 'text NOT NULL',
    'it_explan_recommend' => 'text NOT NULL',
    'it_mobile_explan_recommend' => 'text NOT NULL',
    'it_explan_guide' => 'text NOT NULL',
    'it_mobile_explan_guide' => 'text NOT NULL'
];

foreach ($columns as $column => $type) {
    $res = sql_query("SHOW COLUMNS FROM {$g5['g5_shop_item_table']} LIKE '{$column}'");
    if (sql_num_rows($res) == 0) {
        sql_query("ALTER TABLE {$g5['g5_shop_item_table']} ADD `{$column}` {$type}");
        echo "Column {$column} added.\n";
    } else {
        echo "Column {$column} already exists.\n";
    }
}
?>
