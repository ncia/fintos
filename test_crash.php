<?php
include_once('./common.php');
$_POST['w'] = 'u';
$_POST['mb_id'] = 'test2';
// We don't need all post vars, just enough to not trigger alerts immediately
$_POST['mb_name'] = '유영만';
$_POST['mb_nick'] = '유영만';
$_POST['mb_email'] = 'test2@domain.com';

try {
    include './bbs/register_form_update.php';
} catch (Error $e) {
    echo "CAUGHT ERROR: " . $e->getMessage() . " in " . $e->getFile() . " line " . $e->getLine();
}
?>
