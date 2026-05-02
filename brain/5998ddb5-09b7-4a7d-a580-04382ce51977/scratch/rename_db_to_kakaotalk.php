<?php
include_once('./common.php');

$sql1 = " ALTER TABLE {$g5['member_table']} CHANGE mb_kakao_agree mb_kakaotalk TINYINT(4) NOT NULL DEFAULT '0' ";
$sql2 = " ALTER TABLE {$g5['member_table']} CHANGE mb_kakao_agree_date mb_kakaotalk_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ";

$res1 = sql_query($sql1, false);
$res2 = sql_query($sql2, false);

if ($res1) echo "mb_kakao_agree -> mb_kakaotalk SUCCESS\n";
else echo "mb_kakao_agree -> mb_kakaotalk FAILED: " . sql_error_info() . "\n";

if ($res2) echo "mb_kakao_agree_date -> mb_kakaotalk_date SUCCESS\n";
else echo "mb_kakao_agree_date -> mb_kakaotalk_date FAILED: " . sql_error_info() . "\n";
?>
