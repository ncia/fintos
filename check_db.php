<?php
include 'common.php';
$row = sql_fetch("select * from g5_shop_default");
if ($row) {
    echo "Found row:\n";
    print_r($row);
} else {
    echo "No row found in g5_shop_default\n";
    $tables = sql_query("show tables like '%shop_default%'");
    while($t = sql_fetch_array($tables)) {
        print_r($t);
    }
}
?>
