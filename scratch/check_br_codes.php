<?php
include_once('./common.php');
$result = sql_query("select br_name, br_code from {$g5['eyoom_brand']}");
while($row = sql_fetch_array($result)) {
    echo $row['br_name'] . ': ' . $row['br_code'] . "\n";
}
?>
