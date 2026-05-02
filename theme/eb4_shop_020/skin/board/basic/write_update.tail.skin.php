<?php
if (!defined('_GNUBOARD_')) exit;

/**
 * 보험금 청구 게시판(claim) 데이터 구글 시트 연동
 */
if ($bo_table == 'claim') {
    include_once(G5_LIB_PATH.'/google_sheet.lib.php');

    $sheet_id = '1t3OElFyO6HlUm7qtf8ASE5PTEk5qAq6IzALsaV4XSA0';
    $range = '회원가입!A:K';

    // 게시판 필드 매핑
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        '보험금 청구', // B열: 출처
        ($member['mb_id'] ? $member['mb_id'] : '비회원'), // C열: 아이디
        ($member['mb_email'] ? $member['mb_email'] : ''), // D열: 이메일
        $wr_name, // E열: 이름
        '', // F열: 생년월일
        '', // G열: 성별
        (isset($_POST['wr_1']) ? $_POST['wr_1'] : ''), // H열: 연락처
        (isset($_POST['wr_2']) ? $_POST['wr_2'] : ''), // I열: 주소
        '', // J열: 카카오 채널
        ''  // K열: 문자 이메일
    ];

    update_google_sheet($sheet_id, $range, $values);
}
?>
