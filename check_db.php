<?php
include_once('./common.php');
$res = sql_query("DESC {$g5['g5_shop_default_table']}");
while($row = sql_fetch_array($res)) {
    echo $row['Field'] . "\n";
}
?>
