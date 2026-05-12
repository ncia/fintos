<?php
include 'common.php';
$res = sql_query("show columns from g5_shop_default like 'de_all_bodmi%' ");
while($row = sql_fetch_array($res)) {
    print_r($row);
}
?>
