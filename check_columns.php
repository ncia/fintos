<?php
include_once('./_common.php');
$res = sql_query("show columns from {$g5['member_table']}");
while($row = sql_fetch_array($res)) {
    echo $row['Field'] . "\n";
}
?>
