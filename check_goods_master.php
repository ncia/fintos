<?php
include_once('./common.php');
$eg_code = '1652073560';
$sql = "select * from {$g5['eyoom_goods']} where eg_code = '$eg_code'";
$row = sql_fetch($sql);

echo "--- EB Goods Master Info ---\n";
if ($row) {
    foreach($row as $key => $val) {
        echo "$key: $val\n";
    }
} else {
    echo "No goods master found for $eg_code\n";
}
echo "----------------------------\n";
?>
