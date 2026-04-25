<?php
include_once('./_common.php');
$sql = "desc g5_shop_default";
$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
    echo $row['Field'] . "\n";
}
?>
