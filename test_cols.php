<?php
include 'common.php';
$cols = ['mb_marketing_agree', 'mb_thirdparty_agree', 'mb_promotion_agree'];
foreach($cols as $c) {
    $res = sql_query("SHOW COLUMNS FROM g5_member LIKE '$c'");
    if(!sql_fetch_array($res)) {
        echo "MISSING: $c\n";
    } else {
        echo "EXISTS: $c\n";
    }
}
echo "Done.";
?>
