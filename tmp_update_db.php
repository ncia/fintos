<?php
include_once('c:/xampp/htdocs/gnu/common.php');

// 1. Add mb_product_title if not exists
$res = sql_query("SHOW COLUMNS FROM g5_member LIKE 'mb_product_title'");
if(sql_num_rows($res) == 0) {
    sql_query("ALTER TABLE g5_member ADD mb_product_title VARCHAR(255) DEFAULT '' AFTER mb_10");
    echo "mb_product_title added.\n";
}

// 2. Delete missing columns
$cols_to_delete = ['mb_marketing_agree', 'mb_marketing_date', 'mb_thirdparty_agree', 'mb_thirdparty_date', 'mb_agree_log'];
foreach($cols_to_delete as $col) {
    $res = sql_query("SHOW COLUMNS FROM g5_member LIKE '$col'");
    if(sql_num_rows($res) > 0) {
        sql_query("ALTER TABLE g5_member DROP COLUMN $col");
        echo "$col dropped.\n";
    }
}
?>
