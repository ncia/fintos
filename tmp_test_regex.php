<?php
$reg_mb_email = "ncia77@daum.net";
if (preg_match("/[^\.0-9a-z_@-]+/i", $reg_mb_email)) {
    echo "Fail";
} else {
    echo "Pass";
}
?>
