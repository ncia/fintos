<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$reg_mb_email = isset($_POST['reg_mb_email']) ? trim($_POST['reg_mb_email']) : '';

set_session('ss_check_mb_id', '');

if ($msg = empty_mb_id($reg_mb_email))     die($msg);
if ($msg = valid_mb_id($reg_mb_email))     die($msg);
if ($msg = count_mb_id($reg_mb_email))     die($msg);
if ($msg = exist_mb_id($reg_mb_email))     die($msg);
if ($msg = reserve_mb_id($reg_mb_email))   die($msg);

set_session('ss_check_mb_id', $reg_mb_email);