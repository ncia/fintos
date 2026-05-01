<?php
/**
 * core file : /eyoom/core/member/register_form_update.tail.skin.php
 *
 * /bbs/register_form_update.php 에서 호출
 */
if (!defined('_GNUBOARD_')) exit;

// LOG
file_put_contents(G5_DATA_PATH.'/tail_log.txt', date('Y-m-d H:i:s').' - mb_id: '.$mb_id."\n", FILE_APPEND);

//----------------------------------------------------------
// 회원정보 수정/가입 시 연락처, 생년월일 및 성별 업데이트 (그누보드 코어에서 본인확인이 없는 경우 누락되는 현상 대응)
//----------------------------------------------------------
$mb_hp    = isset($_POST['mb_hp'])    ? clean_xss_tags(trim($_POST['mb_hp']))    : '';
$mb_birth = isset($_POST['mb_birth']) ? clean_xss_tags(trim($_POST['mb_birth'])) : '';
$mb_sex   = isset($_POST['mb_sex'])   ? clean_xss_tags(trim($_POST['mb_sex']))   : '';

$sql_update_common = "";
if ($mb_hp)    $sql_update_common .= " , mb_hp = '{$mb_hp}' ";
if ($mb_birth) $sql_update_common .= " , mb_birth = '{$mb_birth}' ";
if ($mb_sex)   $sql_update_common .= " , mb_sex = '{$mb_sex}' ";

if ($sql_update_common) {
    $sql = "update {$g5['member_table']} set mb_id = mb_id {$sql_update_common} where mb_id = '{$mb_id}' ";
    file_put_contents(G5_DATA_PATH.'/tail_log.txt', date('Y-m-d H:i:s').' - SQL: '.$sql."\n", FILE_APPEND);
    $res = sql_query($sql);
    if (!$res) {
        file_put_contents(G5_DATA_PATH.'/tail_log.txt', date('Y-m-d H:i:s').' - SQL ERROR: '.mysqli_error($g5['connect_db'])."\n", FILE_APPEND);
    } else {
        file_put_contents(G5_DATA_PATH.'/tail_log.txt', date('Y-m-d H:i:s').' - SQL SUCCESS'."\n", FILE_APPEND);
    }
}

//----------------------------------------------------------
// 12지신 자동 캐릭터 설정 로직
//----------------------------------------------------------
$mb_icon_auto = isset($_POST['mb_icon_auto']) ? clean_xss_tags(trim($_POST['mb_icon_auto'])) : '';

$del_mb_icon = isset($_POST['del_mb_icon']) ? 1 : 0;
$del_mb_img  = isset($_POST['del_mb_img'])  ? 1 : 0;
$is_uploading_custom = (!empty($_FILES['mb_icon']['name']) || !empty($_FILES['mb_img']['name']));

// 사용자가 명시적으로 이미지를 삭제했거나 커스텀 이미지를 업로드하는 경우에는 자동 설정을 건너뜁니다.
if ($mb_icon_auto && !$del_mb_icon && !$del_mb_img && !$is_uploading_custom && preg_match('/^[0-9]+_[a-z]+\.(png|gif)$/', $mb_icon_auto)) {
    $source_path = G5_PATH . '/theme/' . $theme . '/image/join/' . $mb_icon_auto;
    
    if (file_exists($source_path)) {
        $mb_dir = substr($mb_id, 0, 2);
        $dest_dir_icon = G5_DATA_PATH . '/member/' . $mb_dir;
        $dest_dir_img  = G5_DATA_PATH . '/member_image/' . $mb_dir;
        
        if (!is_dir($dest_dir_icon)) {
            @mkdir($dest_dir_icon, G5_DIR_PERMISSION);
            @chmod($dest_dir_icon, G5_DIR_PERMISSION);
        }
        if (!is_dir($dest_dir_img)) {
            @mkdir($dest_dir_img, G5_DIR_PERMISSION);
            @chmod($dest_dir_img, G5_DIR_PERMISSION);
        }
        
        $icon_ext = pathinfo($source_path, PATHINFO_EXTENSION);
        $formats = array('gif', 'png');
        
        foreach ($formats as $fmt) {
            $dest_path_icon = $dest_dir_icon . '/' . $mb_id . '.' . $fmt;
            $dest_path_img  = $dest_dir_img . '/' . $mb_id . '.' . $fmt;
            
            if ($icon_ext == $fmt) {
                @copy($source_path, $dest_path_icon);
                @copy($source_path, $dest_path_img);
            } else {
                if (function_exists('imagecreatefrompng') && $icon_ext == 'png' && $fmt == 'gif') {
                    $im = @imagecreatefrompng($source_path);
                    if ($im) {
                        @imagegif($im, $dest_path_icon);
                        @imagegif($im, $dest_path_img);
                        @imagedestroy($im);
                    }
                }
            }
            if (file_exists($dest_path_icon)) @chmod($dest_path_icon, G5_IMG_PERMISSION);
            if (file_exists($dest_path_img)) @chmod($dest_path_img, G5_IMG_PERMISSION);
        }

        if (isset($g5['eyoom_member'])) {
            sql_query("update {$g5['eyoom_member']} set photo = '{$mb_id}.{$icon_ext}' where mb_id = '{$mb_id}' ");
        }
    }
}

//----------------------------------------------------------
// SMS 문자전송 시작
//----------------------------------------------------------
$sms_contents = $default['de_sms_cont1'];
$sms_contents = str_replace("{이름}", $mb_name, $sms_contents);
$sms_contents = str_replace("{회원아이디}", $mb_id, $sms_contents);
$sms_contents = str_replace("{회사명}", $default['de_admin_company_name'], $sms_contents);

$receive_number = preg_replace("/[^0-9]/", "", $mb_hp);
$send_number = preg_replace("/[^0-9]/", "", $default['de_admin_company_tel']);

if ($w == "" && $default['de_sms_use1'] && $receive_number) {
    if ($config['cf_sms_use'] == 'icode') {
        if($config['cf_sms_type'] == 'LMS') {
            include_once(G5_LIB_PATH.'/icode.lms.lib.php');
            $port_setting = get_icode_port_type($config['cf_icode_id'], $config['cf_icode_pw']);
            if($port_setting !== false) {
                $SMS = new LMS;
                $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);
                $strDest = array($receive_number);
                $strCallBack = $send_number;
                $strCaller = iconv_euckr(trim($default['de_admin_company_name']));
                $strData = iconv_euckr($sms_contents);
                $SMS->Add($strDest, $strCallBack, $strCaller, '', '', $strData, '', 1);
                $SMS->Send();
                $SMS->Init();
            }
        } else {
            include_once(G5_LIB_PATH.'/icode.sms.lib.php');
            $SMS = new SMS;
            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
            $SMS->Add($receive_number, $send_number, $config['cf_icode_id'], iconv_euckr(stripslashes($sms_contents)), "");
            $SMS->Send();
            $SMS->Init();
        }
    }
}

//----------------------------------------------------------
// 구글 스프레드시트 연동 시작
//----------------------------------------------------------
// 테마 스킨의 설정을 우선 참조하거나 직접 설정
if ($config['cf_googlesheet_use'] && $config['cf_googlesheet_url']) {
    $post_data = array(
        'mb_id'       => $mb_id,
        'mb_name'     => $mb_name,
        'mb_nick'     => $mb_nick,
        'mb_email'    => $mb_email,
        'mb_hp'       => $mb_hp,
        'mb_datetime' => G5_TIME_YMDHIS,
        'mb_ip'       => $_SERVER['REMOTE_ADDR'],
        'mb_addr'     => '[' . $mb_zip . '] ' . $mb_addr1 . ' ' . $mb_addr2 . ' (' . $mb_addr_jibeon . ')',
        'referer'     => $_SESSION['ss_referer'] ?? '',
        'user_agent'  => $_SERVER['HTTP_USER_AGENT']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $config['cf_googlesheet_url']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    curl_close($ch);
}
?>