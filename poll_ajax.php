<?php
include_once('./common.php');

$mode = $_POST['mode'];
$id = (int)$_POST['id'];
$type = $_POST['type']; // 'A' or 'B'

if ($mode == 'vote') {
    if (!$id || !in_array($type, array('A', 'B'))) {
        die(json_encode(array('error' => 'Invalid parameters')));
    }
    
    $user_ip = $_SERVER['REMOTE_ADDR'];
    
    // 중복 투표 체크 (해당 질문의 poll_ip 컬럼 확인)
    $row = sql_fetch(" SELECT poll_ip FROM `g5_fintos_poll` WHERE id = '{$id}' ");
    
    if ($row['poll_ip'] && strpos($row['poll_ip'], ",{$user_ip},") !== false) {
        die(json_encode(array('error' => 'already_voted')));
    }
    
    // IP 기록 및 카운트 업데이트
    $column = ($type == 'A') ? 'count_a' : 'count_b';
    sql_query(" UPDATE `g5_fintos_poll` 
                SET {$column} = {$column} + 1, 
                    poll_ip = CONCAT(IFNULL(poll_ip, ''), ',{$user_ip},') 
                WHERE id = '{$id}' ");
    
    echo json_encode(array('success' => true));
} 
else if ($mode == 'results') {
    $row = sql_fetch("SELECT count_a, count_b FROM `g5_fintos_poll` WHERE id = '{$id}' ");
    if ($row) {
        echo json_encode(array(
            'count_a' => (int)$row['count_a'],
            'count_b' => (int)$row['count_b']
        ));
    } else {
        echo json_encode(array('error' => 'Not found'));
    }
}
?>
