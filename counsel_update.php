<?php
include_once('./_common.php');

// 캡차 체크 (카운트다운 폼은 제외)
if (isset($_POST['source']) && $_POST['source'] != '카운트다운') {
    include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
    if (!chk_captcha()) {
        alert('자동등록방지 숫자가 틀렸습니다.');
    }
}

// POST 데이터 정리 (c_ 접두사와 mb_ 접두사 모두 대응)
$source      = isset($_POST['source'])      ? clean_xss_tags(trim($_POST['source']))      : '상담신청';
$c_name      = isset($_POST['c_name'])      ? clean_xss_tags(trim($_POST['c_name']))      : (isset($_POST['mb_name']) ? clean_xss_tags(trim($_POST['mb_name'])) : '');
$c_hp        = isset($_POST['c_hp'])        ? clean_xss_tags(trim($_POST['c_hp']))        : (isset($_POST['mb_hp'])   ? clean_xss_tags(trim($_POST['mb_hp']))   : '');
$c_birth     = isset($_POST['c_birth'])     ? clean_xss_tags(trim($_POST['c_birth']))     : (isset($_POST['mb_birth'])? clean_xss_tags(trim($_POST['mb_birth'])): '');
$c_sex       = isset($_POST['c_sex'])       ? clean_xss_tags(trim($_POST['c_sex']))       : (isset($_POST['mb_sex'])  ? clean_xss_tags(trim($_POST['mb_sex']))  : '');
$c_ampm      = isset($_POST['c_ampm'])      ? clean_xss_tags(trim($_POST['c_ampm']))      : (isset($_POST['counsel_time_type']) ? clean_xss_tags(trim($_POST['counsel_time_type'])) : '');
$c_time      = isset($_POST['c_time'])      ? clean_xss_tags(trim($_POST['c_time']))      : (isset($_POST['counsel_time_hour']) ? clean_xss_tags(trim($_POST['counsel_time_hour'])) : '');
$c_kakaotalk = (isset($_POST['c_kakaotalk']) || isset($_POST['agree_kakao'])) ? 'YES' : 'NO';
$c_mailling  = (isset($_POST['c_mailling']) || isset($_POST['agree_mailling'])) ? 'YES' : 'NO';

// 필수값 체크
if (!$c_name) alert("이름을 입력해 주세요.");
if (!$c_hp)   alert("연락처를 입력해 주세요.");

// 상담 시간 통합
$counsel_time = $c_ampm;
if ($c_time && $c_ampm != '종일') {
    $counsel_time .= ' ' . $c_time;
}

// 구글 스프레드시트 연동
include_once(G5_LIB_PATH.'/google_sheet.lib.php');

$sheet_id = '1t3OElFyO6HlUm7qtf8ASE5PTEk5qAq6IzALsaV4XSA0';

if ($source == '카운트다운') {
    $range = '카운트다운!A:I';
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source,        // B열: 경로
        $c_name,        // C열: 이름
        $c_hp,          // D열: 연락처
        $c_birth,       // E열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // F열: 성별
        $counsel_time,  // G열: 상담가능시간
        $c_kakaotalk,   // H열: 카카오채널
        $c_mailling     // I열: 문자이메일
    ];
} else {
    // 상품 상담 등의 경우 (기본값)
    $range = '회원가입!A:K';
    $values = [
        G5_TIME_YMDHIS, 
        '상담신청 - ' . $source,
        ($member['mb_id'] ? $member['mb_id'] : ''),
        '', // 이메일
        $c_name,
        $c_birth,
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)),
        $c_hp,
        '', // 주소
        $c_kakaotalk,
        $c_mailling
    ];
}

$result = update_google_sheet($sheet_id, $range, $values);

if ($result) {
    alert("상담 신청이 정상적으로 접수되었습니다.", G5_URL);
} else {
    alert("상담 신청은 접수되었으나 시트 업데이트에 실패했습니다. 관리자에게 문의하세요.", G5_URL);
}
?>
