<?php
include_once('./_common.php');
$res = sql_query("show columns from {$g5['eyoom_member']}");
while($row = sql_fetch_array($res)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
?>
