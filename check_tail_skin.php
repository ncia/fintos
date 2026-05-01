<?php
include_once('./_common.php');
echo "MEMBER_SKIN_PATH: " . $member_skin_path . "\n";
if (file_exists($member_skin_path.'/register_form_update.tail.skin.php')) {
    echo "FILE EXISTS!\n";
} else {
    echo "FILE NOT FOUND!\n";
}
?>
