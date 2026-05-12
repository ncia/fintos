<?php
include_once('./common.php');
$res = sql_query("SHOW COLUMNS FROM g5_shop_default");
while($row = sql_fetch_array($res)) {
    echo $row['Field'] . "\n";
}
?>
