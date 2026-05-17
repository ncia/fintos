<?php
include_once('./common.php');
echo "=== Sliders ===\n";
$res = sql_query("select * from {$g5['eyoom_slider']}");
while($row = sql_fetch_array($res)) {
    echo "es_code: {$row['es_code']}, es_subject: {$row['es_subject']}, es_theme: {$row['es_theme']}\n";
}
echo "=== Active Theme ===\n";
echo "theme: {$theme}\n";
?>
