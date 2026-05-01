<?php
include 'common.php';
$res = sql_query("SHOW COLUMNS FROM g5_member LIKE 'product_title'");
$row = sql_fetch_array($res);
if ($row) {
    echo "EXISTS";
} else {
    echo "MISSING";
}
// Try running the update query
$sql = " update {$g5['member_table']} set product_title = 'test' where mb_id = 'test2' ";
$res = sql_query($sql, false);
if (!$res) {
    echo "\nSQL_ERROR: " . mysqli_error($g5['connect_db']);
}
?>
