<?php
include_once('./common.php');
$row = sql_fetch("SELECT * FROM g5_shop_default");
foreach($row as $k=>$v) {
    if(strpos($k, 'bodmi') !== false) echo "$k: $v\n";
}
?>
