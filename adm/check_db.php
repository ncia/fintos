<?php
include_once('./_common.php');
if ($is_admin != 'super') exit;

$sql = "desc {$g5['shop_default_table']}";
$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
