<?php
include 'common.php';
$hp = '010-2627-7748';
$sql = " select mb_id, mb_name from {$g5['member_table']} where mb_hp = '{$hp}' ";
$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    echo "Duplicate found: ID={$row['mb_id']}, Name={$row['mb_name']}\n";
}
echo "Done.";
?>
