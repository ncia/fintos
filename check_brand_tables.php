<?php
include_once('./_common.php');
$res = sql_query("SHOW TABLES LIKE '%brand%'");
while($row = sql_fetch_array($res)) {
    echo $row[0] . "\n";
}
?>
