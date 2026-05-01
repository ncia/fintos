<?php
include_once('./common.php');

$mb_id = 'test2';
$mb_hp = '010-2627-7784';
$mb_birth = '19900101';
$mb_sex = 'M';

// 1. Current value
$row1 = sql_fetch("select mb_hp, mb_birth, mb_sex from {$g5['member_table']} where mb_id = '{$mb_id}'");
echo "BEFORE UPDATE: HP = {$row1['mb_hp']}, Birth = {$row1['mb_birth']}\n";

// 2. Perform the exact update used in the tail skin
$sql_update_common = "";
if ($mb_hp)    $sql_update_common .= " , mb_hp = '{$mb_hp}' ";
if ($mb_birth) $sql_update_common .= " , mb_birth = '{$mb_birth}' ";
if ($mb_sex)   $sql_update_common .= " , mb_sex = '{$mb_sex}' ";

if ($sql_update_common) {
    $sql = "update {$g5['member_table']} set mb_id = mb_id {$sql_update_common} where mb_id = '{$mb_id}' ";
    echo "SQL: $sql\n";
    $res = sql_query($sql, false);
    if (!$res) {
        echo "SQL ERROR: " . mysqli_error($g5['connect_db']) . "\n";
    } else {
        echo "SQL SUCCESS\n";
    }
}

// 3. Check value again
$row2 = sql_fetch("select mb_hp, mb_birth, mb_sex from {$g5['member_table']} where mb_id = '{$mb_id}'");
echo "AFTER UPDATE: HP = {$row2['mb_hp']}, Birth = {$row2['mb_birth']}\n";
?>
