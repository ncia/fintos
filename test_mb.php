<?php
include 'common.php';
$mb = get_member('test2');
echo "Name: {$mb['mb_name']}\n";
echo "Email: {$mb['mb_email']}\n";
echo "HP: {$mb['mb_hp']}\n";
echo "Birth: {$mb['mb_birth']}\n";
echo "Sex: {$mb['mb_sex']}\n";
?>
