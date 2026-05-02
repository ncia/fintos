<?php
include_once('./common.php');

$sql1 = " ALTER TABLE {$g5['member_table']} CHANGE mb_mailling mb_kakao_agree TINYINT(4) NOT NULL DEFAULT '0' ";
$sql2 = " ALTER TABLE {$g5['member_table']} CHANGE mb_mailling_date mb_kakao_agree_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ";

$res1 = sql_query($sql1, false);
$res2 = sql_query($sql2, false);

if ($res1) echo "mb_mailling -> mb_kakao_agree SUCCESS\n";
else echo "mb_mailling -> mb_kakao_agree FAILED or already changed: " . sql_error_info() . "\n";

if ($res2) echo "mb_mailling_date -> mb_kakao_agree_date SUCCESS\n";
else echo "mb_mailling_date -> mb_kakao_agree_date FAILED or already changed: " . sql_error_info() . "\n";
?>
