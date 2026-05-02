<?php
include_once('./common.php');
$sql = " DESC {$g5['member_table']} ";
$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    if (strpos($row['Field'], 'mail') !== false || strpos($row['Field'], 'kakao') !== false) {
        print_r($row);
    }
}
?>
