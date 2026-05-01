<?php
include_once('./_common.php');
$sql = "update {$g5['member_table']} set mb_birth = '19900101', mb_sex = 'M' where mb_id = 'test2' ";
echo "SQL: " . $sql . "\n";
$res = sql_query($sql);
if ($res) echo "SUCCESS\n";
else echo "FAIL\n";
?>
