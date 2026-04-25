<?php
include_once('./_common.php');
$sql = "desc {$g5['shop_default_table']}";
$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
    if(strpos($row['Field'], 'bodmi') !== false) {
        echo $row['Field'] . "\n";
    }
}

$sql = "select * from {$g5['shop_default_table']}";
$row = sql_fetch($sql);
foreach($row as $key => $val) {
    if(strpos($key, 'bodmi') !== false) {
        echo "$key: [$val]\n";
    }
}
?>
