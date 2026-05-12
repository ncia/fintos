<?php
include_once('./common.php');
$res = sql_query("DESC g5_shop_default");
while($row = sql_fetch_array($res)) {
    if(strpos($row['Field'], 'bodmi') !== false) {
        echo $row['Field'] . "\n";
    }
}
