<?php
include_once('./common.php');
$es_code = '1659316859';
$sql = "select * from {$g5['eyoom_slider']} where es_code = '$es_code'";
$row = sql_fetch($sql);

echo "--- Slider Master Info for $es_code ---\n";
if ($row) {
    foreach($row as $key => $val) {
        echo "$key: $val\n";
    }
} else {
    echo "No master found for $es_code\n";
}
echo "--------------------------------------\n";
?>
