<?php
include_once('./_common.php');

if (PHP_SAPI !== 'cli' && !$is_admin) {
    die('접근 권한이 없습니다.');
}

$sql = "UPDATE {$g5['g5_shop_item_table']} 
        SET it_explan = REPLACE(it_explan, 'http://localhost/gnu', '') 
        WHERE it_explan LIKE '%http://localhost/gnu%'";

$result = sql_query($sql);

if ($result) {
    echo "성공적으로 업데이트되었습니다.";
} else {
    echo "업데이트 중 오류가 발생했습니다.";
}
?>
