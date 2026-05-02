<?php
include_once('./common.php');

$sql1 = " ALTER TABLE {$g5['member_table']} ADD mb_mailling TINYINT(4) NOT NULL DEFAULT '0' AFTER mb_kakaotalk ";
$sql2 = " ALTER TABLE {$g5['member_table']} ADD mb_mailling_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER mb_mailling ";

$res1 = sql_query($sql1, false);
$res2 = sql_query($sql2, false);

if ($res1) echo "mb_mailling ADD SUCCESS\n";
else echo "mb_mailling ADD FAILED: " . sql_error_info() . "\n";

if ($res2) echo "mb_mailling_date ADD SUCCESS\n";
else echo "mb_mailling_date ADD FAILED: " . sql_error_info() . "\n";
?>
