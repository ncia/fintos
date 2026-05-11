<?php
include_once('./common.php');
$row = sql_fetch("select * from {$g5['g5_shop_item_use_table']} order by is_id desc limit 1");
$file = 'review_debug.txt';
$data = "ID: " . $row['is_id'] . "\n";
$data .= "Subject: " . $row['is_subject'] . "\n";
$data .= "Content: " . $row['is_content'] . "\n";
file_put_contents($file, $data);
echo "Debug file created: $file";
?>
