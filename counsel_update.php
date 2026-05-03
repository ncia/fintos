<?php
include_once('./_common.php');

// 캡차 체크 (상담 신청 폼들은 제외)
$captcha_bypass = array(
    'countdown_counsel', 'mbti_insurance_counsel', 'insurance_age', 
    'insurance_check', 'insurance_analysis', 'insurance_remodeling', 
    'insurance_claim', 'pet_insurance', 'insurance_counsel'
);
if (isset($_POST['source']) && !in_array($_POST['source'], $captcha_bypass)) {
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
$it_id       = isset($_POST['it_id']) ? clean_xss_tags(trim($_POST['it_id'])) : '';
$c_mbti      = isset($_POST['c_mbti']) ? clean_xss_tags(trim($_POST['c_mbti'])) : '';

$c_item_name = isset($_POST['subject']) ? clean_xss_tags(trim($_POST['subject'])) : '';

$c_pet_type  = isset($_POST['c_pet_type']) ? clean_xss_tags(trim($_POST['c_pet_type'])) : '';
$c_pet_name  = isset($_POST['c_pet_name']) ? clean_xss_tags(trim($_POST['c_pet_name'])) : '';
$c_pet_breed = isset($_POST['c_pet_breed']) ? clean_xss_tags(trim($_POST['c_pet_breed'])) : '';
$c_pet_age_y = isset($_POST['c_pet_age_year']) ? clean_xss_tags(trim($_POST['c_pet_age_year'])) : '';
$c_pet_age_m = isset($_POST['c_pet_age_month']) ? clean_xss_tags(trim($_POST['c_pet_age_month'])) : '';
$c_pet_gender = isset($_POST['c_pet_gender']) ? clean_xss_tags(trim($_POST['c_pet_gender'])) : '';
$c_pet_age   = trim($c_pet_age_y . " " . $c_pet_age_m);

// 추가 정보 수집 (펫 정보 등)
$extra_info = [];
if ($c_mbti)                       $extra_info[] = "MBTI유형: " . $c_mbti;
if ($c_pet_type)                   $extra_info[] = "구분: " . $c_pet_type;
if ($c_pet_name)                   $extra_info[] = "반려견이름: " . $c_pet_name;
if ($c_pet_breed)                  $extra_info[] = "품종: " . $c_pet_breed;
if ($c_pet_age)                    $extra_info[] = "나이: " . $c_pet_age;
if ($c_pet_gender)                 $extra_info[] = "성별: " . $c_pet_gender;
if ($c_item_name)                  $extra_info[] = "상품명: " . $c_item_name;

$is_content = implode(" / ", $extra_info);

// --- 60일 지난 오래된 데이터 및 사진 자동 삭제 (청소 로직) ---
$days_limit = 60;
$cleanup_date = date('Y-m-d H:i:s', G5_SERVER_TIME - ($days_limit * 86400));
$cleanup_sql = "SELECT is_file FROM `{$g5['g5_shop_item_table']}_counsel` WHERE is_regdt < '{$cleanup_date}' AND is_file != ''";
$cleanup_res = sql_query($cleanup_sql);
while($row = sql_fetch_array($cleanup_res)) {
    $old_file = G5_DATA_PATH . '/counsel/' . $row['is_file'];
    if (is_file($old_file)) {
        @unlink($old_file); // 물리적 파일 삭제
    }
}
sql_query("DELETE FROM `{$g5['g5_shop_item_table']}_counsel` WHERE is_regdt < '{$cleanup_date}'"); // DB 레코드 삭제
// ---------------------------------------------------------

// 파일 업로드 처리 (펫 사진 - 중/고화질 대응)
$is_file = '';
if (isset($_FILES['c_pet_photo']) && is_uploaded_file($_FILES['c_pet_photo']['tmp_name'])) {
    $upload_dir = G5_DATA_PATH . '/counsel';
    if (!is_dir($upload_dir)) {
        @mkdir($upload_dir, G5_DIR_PERMISSION);
        @chmod($upload_dir, G5_DIR_PERMISSION);
    }
    
    $filename = $_FILES['c_pet_photo']['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    // 허용되는 확장자 체크
    if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif'))) {
        $new_filename = 'pet_' . G5_SERVER_TIME . '_' . rand(100, 999) . '.' . $ext;
        if (move_uploaded_file($_FILES['c_pet_photo']['tmp_name'], $upload_dir . '/' . $new_filename)) {
            $is_file = $new_filename;
        }
    }
}


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

// 구글 시트에 기록할 경로명 (한글로 복구)
$source_ko = $source;
if ($source == 'countdown_counsel')      $source_ko = '카운트다운';
if ($source == 'mbti_insurance_counsel') $source_ko = 'MBTI추천보험';
if ($source == 'insurance_age')          $source_ko = '보험나이알기';
if ($source == 'insurance_check')        $source_ko = '보험통합조회';
if ($source == 'insurance_analysis')     $source_ko = '보험증권분석';
if ($source == 'insurance_remodeling')   $source_ko = '보험리모델링';
if ($source == 'insurance_claim')        $source_ko = '보험금청구예약';
if ($source == 'pet_insurance')          $source_ko = '반려동물보험';
if ($source == 'insurance_counsel')      $source_ko = '상품별보험상담';

if ($source == 'countdown_counsel') {
    $range = "카운트다운!A:I";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로 (한글로 기록)
        $c_name,        // C열: 이름
        $c_hp,          // D열: 연락처
        $c_birth,       // E열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // F열: 성별
        $counsel_time,  // G열: 상담가능시간
        $c_kakaotalk,   // H열: 카카오채널
        $c_mailling     // I열: 문자이메일
    ];
} else if ($source == 'mbti_insurance_counsel') {
    $range = "MBTI상품추천!A:J";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $c_mbti,        // C열: MBTI유형
        $c_name,        // D열: 이름
        $c_hp,          // E열: 연락처
        $c_birth,       // F열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // G열: 성별
        $counsel_time,  // H열: 상담가능시간
        $c_kakaotalk,   // I열: 카카오채널
        $c_mailling     // J열: 문자이메일
    ];
} else if ($source == 'insurance_age') {
    $range = "보험나이알기!A:I";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $c_name,        // C열: 이름
        $c_hp,          // D열: 연락처
        $c_birth,       // E열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // F열: 성별
        $counsel_time,  // G열: 상담가능시간
        $c_kakaotalk,   // H열: 카카오채널
        $c_mailling     // I열: 문자이메일
    ];
} else if ($source == 'insurance_check') {
    $range = "보험통합조회!A:I";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $c_name,        // C열: 이름
        $c_hp,          // D열: 연락처
        $c_birth,       // E열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // F열: 성별
        $counsel_time,  // G열: 상담가능시간
        $c_kakaotalk,   // H열: 카카오채널
        $c_mailling     // I열: 문자이메일
    ];
} else if ($source == 'insurance_analysis') {
    $range = "보험증권분석!A:I";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $c_name,        // C열: 이름
        $c_hp,          // D열: 연락처
        $c_birth,       // E열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // F열: 성별
        $counsel_time,  // G열: 상담가능시간
        $c_kakaotalk,   // H열: 카카오채널
        $c_mailling     // I열: 문자이메일
    ];
} else if ($source == 'insurance_remodeling') {
    $range = "보험리모델링!A:I";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $c_name,        // C열: 이름
        $c_hp,          // D열: 연락처
        $c_birth,       // E열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // F열: 성별
        $counsel_time,  // G열: 상담가능시간
        $c_kakaotalk,   // H열: 카카오채널
        $c_mailling     // I열: 문자이메일
    ];
} else if ($source == 'pet_insurance') {
    $range = "펫보험상담!A:L";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $c_name,        // C열: 보호자이름
        $c_hp,          // D열: 보호자연락처
        $c_pet_type,    // E열: 반려동물구분
        $c_pet_name,    // F열: 반려동물이름
        $c_pet_breed,   // G열: 반려동물품종
        $c_pet_age,     // H열: 반려동물연령
        $c_pet_gender,  // I열: 반려동물성별
        $counsel_time,  // J열: 상담가능시간
        $c_kakaotalk,   // K열: 카카오채널
        $c_mailling     // L열: 문자이메일
    ];
} else if ($source == 'insurance_claim') {
    $range = "보험금청구예약!A:I";
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $c_name,        // C열: 이름
        $c_hp,          // D열: 연락처
        $c_birth,       // E열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // F열: 성별
        $counsel_time,  // G열: 상담가능시간
        $c_kakaotalk,   // H열: 카카오채널
        $c_mailling     // I열: 문자이메일
    ];
} else if ($source == 'insurance_counsel') {
    $range = "상품별보험상담!A:J";
    
    // 폼에서 넘어온 값에서 말머리 제거
    $full_item_name = str_replace('[상품상담]', '', $c_item_name);
    $full_item_name = trim($full_item_name);
    
    $item_url = G5_SHOP_URL . '/item.php?it_id=' . $it_id;
    $item_value = '=HYPERLINK("' . $item_url . '", "' . $full_item_name . '")';
    $values = [
        G5_TIME_YMDHIS, // A열: 날짜
        $source_ko,     // B열: 경로
        $item_value,    // C열: 상품 (가공된 상품명 + 하이퍼링크)
        $c_name,        // D열: 이름
        $c_hp,          // E열: 연락처
        $c_birth,       // F열: 생년월일
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)), // G열: 성별
        $counsel_time,  // H열: 상담가능시간
        $c_kakaotalk,   // I열: 카카오채널
        $c_mailling     // J열: 문자이메일
    ];
} else {
    // 상품 상담 등의 경우 (기본값)
    $range = "회원가입!A:K";
    $values = [
        G5_TIME_YMDHIS, 
        '상담신청 - ' . $source_ko,
        ($member['mb_id'] ? $member['mb_id'] : ''),
        '', // 이메일
        $c_name,
        $c_birth,
        ($c_sex == 'M' ? '남성' : ($c_sex == 'F' || $c_sex == 'W' ? '여성' : $c_sex)),
        $c_hp,
        $is_content, // 주소 대신 상세 내용 저장
        $c_kakaotalk,
        $c_mailling
    ];
}

$result = update_google_sheet($sheet_id, $range, $values);

// 데이터베이스 저장
$is_kakao_db = $c_kakaotalk == 'YES' ? 'Y' : 'N';
$is_email_db = $c_mailling == 'YES' ? 'Y' : 'N';

// DB 저장 시에도 한글 경로명($source_ko) 사용
$sql = "INSERT INTO `{$g5['g5_shop_item_table']}_counsel` SET 
            is_source = '{$source_ko}',
            is_item = '" . sql_real_escape_string($c_item_name) . "',
            is_name = '{$c_name}',
            is_hp = '{$c_hp}',
            is_birth = '{$c_birth}',
            is_sex = '{$c_sex}',
            is_counsel_time = '{$counsel_time}',
            is_kakao_agree = '{$is_kakao_db}',
            is_email_sms_agree = '{$is_email_db}',
            is_it_id = '{$it_id}',
            is_file = '{$is_file}',
            is_content = '" . sql_real_escape_string($is_content) . "',
            is_ip = '{$_SERVER['REMOTE_ADDR']}',
            is_regdt = '".G5_TIME_YMDHIS."' ";
sql_query($sql);

if ($result) {
    alert("상담 신청이 정상적으로 접수되었습니다.", G5_URL);
} else {
    alert("상담 신청은 접수되었으나 시트 업데이트에 실패했습니다. 관리자에게 문의하세요.", G5_URL);
}
?>