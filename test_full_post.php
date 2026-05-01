<?php
include_once('./common.php');
include_once('./lib/outlogin.lib.php');

// Mock captcha to always pass

// 1. Force Login as test2
$mb_id = 'test2';
$mb = get_member($mb_id);
set_session('ss_mb_id', $mb_id);
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

$_POST = [
    'w' => 'u',
    'mb_id' => 'test2',
    'mb_password' => '',
    'mb_password_re' => '',
    'mb_name' => '유영만',
    'mb_nick' => '유영만',
    'mb_nick_default' => '유영만',
    'mb_email' => 'test2@domain.com',
    'old_email' => 'test2@domain.com',
    'mb_hp' => '010-2627-7788',
    'mb_birth' => '19901010',
    'mb_sex' => 'M',
    'mb_zip1' => '18150',
    'mb_zip2' => '',
    'mb_addr1' => '경기 오산시',
    'mb_addr2' => '',
    'mb_addr3' => '',
    'mb_addr_jibeon' => '',
    'product_title' => '',
    'mb_mailling' => '1',
    'mb_sms' => '1',
    'mb_open' => '1',
    'mb_marketing_agree' => '0',
    'mb_thirdparty_agree' => '0',
    'mb_promotion_agree' => '0',
    'mb_nick_duplicated' => 'y',
];

ob_start();
include './bbs/register_form_update.php';
$out = ob_get_clean();

$row = sql_fetch("select mb_hp, mb_birth from {$g5['member_table']} where mb_id = 'test2'");
echo "\nFINAL DB STATE -> HP: {$row['mb_hp']}, Birth: {$row['mb_birth']}\n";
?>
