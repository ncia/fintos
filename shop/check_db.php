<?php
include_once('./_common.php');
$sql = "DESCRIBE g5_shop_quiz";
$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
?>
