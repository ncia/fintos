<?php
/**
 * core file : /eyoom/core/board/member.php
 *
 * /eyoom/common.php $exchange_file 에서 호출
 */
if (!defined('_EYOOM_')) exit;

//----------------------------------------------------------
// SMS 문자전송 시작
//----------------------------------------------------------

$sms_contents = $default['de_sms_cont1'];
$sms_contents = str_replace("{이름}", $mb_name, $sms_contents);
$sms_contents = str_replace("{회원아이디}", $mb_id, $sms_contents);
$sms_contents = str_replace("{회사명}", $default['de_admin_company_name'], $sms_contents);

// 핸드폰번호에서 숫자만 취한다
$receive_number = preg_replace("/[^0-9]/", "", $mb_hp);  // 수신자번호 (회원님의 핸드폰번호)
$send_number = preg_replace("/[^0-9]/", "", $default['de_admin_company_tel']); // 발신자번호

if ($w == "" && $default['de_sms_use1'] && $receive_number)
{
	if ($config['cf_sms_use'] == 'icode')
	{
		if($config['cf_sms_type'] == 'LMS') {
            include_once(G5_LIB_PATH.'/icode.lms.lib.php');

            $port_setting = get_icode_port_type($config['cf_icode_id'], $config['cf_icode_pw']);

            // SMS 모듈 클래스 생성
            if($port_setting !== false) {
                $SMS = new LMS;
                $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);

                $strDest     = array();
                $strDest[]   = $receive_number;
                $strCallBack = $send_number;
                $strCaller   = iconv_euckr(trim($default['de_admin_company_name']));
                $strSubject  = '';
                $strURL      = '';
                $strData     = iconv_euckr($sms_contents);
                $strDate     = '';
                $nCount      = count($strDest);

                $res = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

                $SMS->Send();
                $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
            }
        } else {
            include_once(G5_LIB_PATH.'/icode.sms.lib.php');

            $SMS = new SMS; // SMS 연결
            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
            $SMS->Add($receive_number, $send_number, $config['cf_icode_id'], iconv_euckr(stripslashes($sms_contents)), "");
            $SMS->Send();
            $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
        }
	}
}
//----------------------------------------------------------
// SMS 문자전송 끝
//----------------------------------------------------------

//----------------------------------------------------------
// 구글 스프레드시트 연동 시작
//----------------------------------------------------------
$google_script_url = "YOUR_GOOGLE_SCRIPT_URL_HERE"; // 나중에 생성된 URL로 교체해 주세요.

if ($w == "" && $google_script_url != "YOUR_GOOGLE_SCRIPT_URL_HERE") {
    $post_data = array(
        "sheet_name"    => "회원가입내역", // 고정 시트명 또는 비워둘 수 있음
        "mb_id"         => $mb_id,
        "mb_name"       => $mb_name,
        "mb_email"      => $mb_email,
        "mb_hp"         => $mb_hp,
        "product_title" => isset($_POST['product_title']) ? $_POST['product_title'] : '',
        "extra_info"    => $_SERVER['REMOTE_ADDR'] // 아이피 등 추가 정보
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $google_script_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // 비동기 처럼 느끼게 하기 위해 타임아웃을 짧게 주거나, 결과를 기다리지 않고 실행할 수 있으나 
    // 여기서는 확실한 기록을 위해 기본 설정을 유지합니다.
    $response = curl_exec($ch);
    curl_close($ch);
}
//----------------------------------------------------------
// 구글 스프레드시트 연동 끝
//----------------------------------------------------------;