<?php
include_once('./common.php');
$row = sql_fetch("SELECT * FROM g5_shop_default");
foreach($row as $k=>$v) {
    if(strpos($k, 'target_date') !== false) echo "$k: $v\n";
}
?>
