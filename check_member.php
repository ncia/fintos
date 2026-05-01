<?php
include_once('./_common.php');
$row = sql_fetch("select mb_birth, mb_sex, mb_certify from {$g5['member_table']} where mb_id = 'test2' ");
echo "BIRTH:" . $row['mb_birth'] . "\n";
echo "SEX:" . $row['mb_sex'] . "\n";
echo "CERTIFY:" . $row['mb_certify'] . "\n";
?>
