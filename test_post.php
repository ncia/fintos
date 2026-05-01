<?php
include 'common.php';

// Set session
set_session('ss_mb_id', 'test2');

// Mock POST
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
    'mb_hp' => '010-2627-7748',
    'mb_birth' => '19900101',
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
include 'bbs/register_form_update.php';
$out = ob_get_clean();

echo "Finished.\n";
if (file_exists(G5_DATA_PATH.'/update_log.txt')) {
    echo file_get_contents(G5_DATA_PATH.'/update_log.txt');
}
?>
