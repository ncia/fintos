<?php
include_once('./_common.php');

// 보안을 위해 최고관리자가 로그인된 상태이거나, 직접 파일을 실행해야 합니다.
if ($is_admin != 'super') die('권한이 없습니다.');

// --- [설정 사항] ---
$new_admin_id = 'admin'; // 새 관리자 아이디
$new_admin_pw = 'skycastle77';  // 새 관리자 비밀번호 (원하는 것으로 수정하세요!)
$new_admin_email = 'admin@domain.com'; // 관리자 이메일
// ------------------

// 1. 테이블 완전 초기화 (TRUNCATE)
sql_query(" TRUNCATE TABLE {$g5['member_table']} ");

// 2. 관리자 계정 정보 준비
$mb_password = get_encrypt_string($new_admin_pw); // 그누보드 암호화 방식 적용
$now = G5_TIME_YMDHIS;

// 3. 관리자 계정 삽입 (레벨 10 필수)
$sql = " INSERT INTO {$g5['member_table']}
            SET mb_id = '{$new_admin_id}',
                mb_password = '{$mb_password}',
                mb_name = '최고관리자',
                mb_nick = '최고관리자',
                mb_email = '{$new_admin_email}',
                mb_level = '10',
                mb_hp = '010-0000-0000',
                mb_datetime = '{$now}',
                mb_email_certify = '{$now}',
                mb_today_login = '{$now}',
                mb_login_ip = '{$_SERVER['REMOTE_ADDR']}' ";

sql_query($sql);

echo "<h3>회원 테이블 완전 초기화 및 관리자 재생성 완료</h3>";
echo "아이디: <strong>{$new_admin_id}</strong><br>";
echo "비밀번호: <strong>{$new_admin_pw}</strong> 로 설정되었습니다.<br>";
echo "이제 새로고침 후 다시 로그인해 주세요.";
?>