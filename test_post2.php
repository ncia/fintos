<?php
include 'common.php';

// Redefine alert to catch it without exiting
function alert_intercept($msg='', $url='', $error=true, $post=false) {
    file_put_contents(G5_DATA_PATH.'/intercept_alert.txt', "ALERT: ".$msg);
    exit; // Still exit to simulate real behavior
}
// But wait, PHP doesn't let me redefine functions.
// I will just modify bbs/register_form_update.php temporarily to log the alert!
?>
