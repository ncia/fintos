if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 12지신 자동 캐릭터 설정 로직
$mb_icon_auto = isset($_POST['mb_icon_auto']) ? clean_xss_tags(trim($_POST['mb_icon_auto'])) : '';
$mb_birth     = isset($_POST['mb_birth']) ? clean_xss_tags(trim($_POST['mb_birth'])) : '';

// 사용자가 직접 파일을 업로드했는지 확인
$mb_icon_uploaded = (isset($_FILES['mb_icon']['name']) && $_FILES['mb_icon']['name']);
$mb_img_uploaded  = (isset($_FILES['mb_img']['name']) && $_FILES['mb_img']['name']);

// 신규 가입이거나, 수정 시 생년월일이 변경된 경우에만 자동 캐릭터 설정 (직접 업로드 시 제외)
$del_mb_icon = isset($_POST['del_mb_icon']) ? 1 : 0;
$del_mb_img  = isset($_POST['del_mb_img'])  ? 1 : 0;
if ($mb_icon_auto && ($w == '' || (isset($member['mb_birth']) && $member['mb_birth'] != $mb_birth)) && !$mb_icon_uploaded && !$mb_img_uploaded && !$del_mb_icon && !$del_mb_img && preg_match('/^[0-9]+_[a-z]+\.(png|gif)$/', $mb_icon_auto)) {
    $source_path = G5_PATH . '/theme/' . $theme . '/image/join/' . $mb_icon_auto;
    
    if (file_exists($source_path)) {
        // 아이콘/이미지 저장 경로 설정 (아이디 앞 2자리 폴더 구조)
        $mb_dir = substr($mb_id, 0, 2);
        $dest_dir_icon = G5_DATA_PATH . '/member/' . $mb_dir;
        $dest_dir_img  = G5_DATA_PATH . '/member_image/' . $mb_dir;
        
        // 폴더 생성
        if (!is_dir($dest_dir_icon)) {
            @mkdir($dest_dir_icon, G5_DIR_PERMISSION);
            @chmod($dest_dir_icon, G5_DIR_PERMISSION);
        }
        if (!is_dir($dest_dir_img)) {
            @mkdir($dest_dir_img, G5_DIR_PERMISSION);
            @chmod($dest_dir_img, G5_DIR_PERMISSION);
        }
        
        $icon_ext = pathinfo($source_path, PATHINFO_EXTENSION);
        
        // 기존 파일 삭제 (중복 방지)
        foreach (array('gif', 'png', 'jpg', 'jpeg') as $fmt) {
            @unlink($dest_dir_icon . '/' . $mb_id . '.' . $fmt);
            @unlink($dest_dir_img . '/' . $mb_id . '.' . $fmt);
        }

        $dest_path_icon = $dest_dir_icon . '/' . $mb_id . '.' . $icon_ext;
        $dest_path_img  = $dest_dir_img . '/' . $mb_id . '.' . $icon_ext;
        
        @copy($source_path, $dest_path_icon);
        @copy($source_path, $dest_path_img);
        
        if (file_exists($dest_path_icon)) @chmod($dest_path_icon, G5_IMG_PERMISSION);
        if (file_exists($dest_path_img)) @chmod($dest_path_img, G5_IMG_PERMISSION);

        // 이윰빌더용 DB 업데이트 (photo 필드)
        if (isset($g5['eyoom_member'])) {
            sql_query("update {$g5['eyoom_member']} set photo = '{$mb_id}.{$icon_ext}' where mb_id = '{$mb_id}' ");
        }
    }
}

// 구글 스프레드시트 연동
if ($config['cf_googlesheet_use'] && $config['cf_googlesheet_url']) {
    $post_data = array(
        'mb_id'       => $mb_id,
        'mb_name'     => $mb_name,
        'mb_nick'     => $mb_nick,
        'mb_email'    => $mb_email,
        'mb_hp'       => $mb_hp,
        'mb_tel'      => $mb_tel,
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
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // GAS 리다이렉트 대응
    curl_exec($ch);
    curl_close($ch);
}

// 가입정보 메일 알림
if ($config['cf_form_mail_use']) {
    $receive_email = $config['cf_form_mail'] ? $config['cf_form_mail'] : $config['cf_admin_email'];
    $subject = '[' . $config['cf_title'] . '] 신규 회원가입 알림 - ' . $mb_name . '(' . $mb_id . ')';
    
    $content = '<h3>신규 회원가입 정보</h3>';
    $content .= '<table border="1" cellpadding="10" cellspacing="0" style="border-collapse:collapse; width:100%; max-width:600px;">';
    $content .= '<tr><th bgcolor="#f8f9fa" width="30%">아이디</th><td>' . $mb_id . '</td></tr>';
    $content .= '<tr><th bgcolor="#f8f9fa">이름</th><td>' . $mb_name . '</td></tr>';
    $content .= '<tr><th bgcolor="#f8f9fa">닉네임</th><td>' . $mb_nick . '</td></tr>';
    $content .= '<tr><th bgcolor="#f8f9fa">이메일</th><td>' . $mb_email . '</td></tr>';
    $content .= '<tr><th bgcolor="#f8f9fa">연락처</th><td>' . $mb_hp . '</td></tr>';
    $content .= '<tr><th bgcolor="#f8f9fa">주소</th><td>[' . $mb_zip . '] ' . $mb_addr1 . ' ' . $mb_addr2 . '</td></tr>';
    $content .= '<tr><th bgcolor="#f8f9fa">가입일시</th><td>' . G5_TIME_YMDHIS . '</td></tr>';
    $content .= '<tr><th bgcolor="#f8f9fa">IP</th><td>' . $_SERVER['REMOTE_ADDR'] . '</td></tr>';
    $content .= '</table>';
    $content .= '<br><p><a href="' . G5_ADMIN_URL . '/member_form.php?w=u&mb_id=' . $mb_id . '" target="_blank" style="display:inline-block; padding:10px 20px; background:#1266f1; color:#fff; text-decoration:none; border-radius:5px;">관리자에서 회원정보 보기</a></p>';

    include_once(G5_LIB_PATH . '/mailer.lib.php');
    mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $receive_email, $subject, $content, 1);
}

// 회원정보 수정/가입 시 생년월일 및 성별 업데이트 (그누보드 코어에서 본인확인이 없는 경우 누락되는 현상 대응)
$mb_hp    = isset($_POST['mb_hp'])    ? clean_xss_tags(trim($_POST['mb_hp']))    : '';
$mb_birth = isset($_POST['mb_birth']) ? clean_xss_tags(trim($_POST['mb_birth'])) : '';
$mb_sex   = isset($_POST['mb_sex'])   ? clean_xss_tags(trim($_POST['mb_sex']))   : '';

$sql_update_common = "";
if ($mb_hp)    $sql_update_common .= " , mb_hp = '{$mb_hp}' ";
if ($mb_birth) $sql_update_common .= " , mb_birth = '{$mb_birth}' ";
if ($mb_sex)   $sql_update_common .= " , mb_sex = '{$mb_sex}' ";

if ($sql_update_common) {
    sql_query("update {$g5['member_table']} set mb_id = mb_id {$sql_update_common} where mb_id = '{$mb_id}' ");
}

// 아이콘/이미지 업로드 시 확장자 보존 및 처리 (gif, png, jpg)
foreach (array('mb_icon', 'mb_img') as $field) {
    if (isset($_FILES[$field]['name']) && $_FILES[$field]['name']) {
        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if ($ext == 'jpeg') $ext = 'jpg';
        
        if (in_array($ext, array('gif', 'png', 'jpg'))) {
            $mb_dir = ($field == 'mb_icon') ? G5_DATA_PATH . '/member/' . substr($mb_id, 0, 2) : G5_DATA_PATH . '/member_image/' . substr($mb_id, 0, 2);
            
            // 기존 파일들 삭제 (중복 방지 - 업로드한 파일과 다른 확장자 파일들)
            foreach (array('gif', 'png', 'jpg', 'jpeg') as $old_ext) {
                if ($old_ext != $ext) {
                    @unlink($mb_dir . '/' . $mb_id . '.' . $old_ext);
                }
            }
            
            // 코어에서 .gif로 강제 저장했을 수도 있는 파일 확인 및 변경
            $core_file = $mb_dir . '/' . $mb_id . '.gif';
            $target_file = $mb_dir . '/' . $mb_id . '.' . $ext;
            
            if (file_exists($core_file) && $ext != 'gif' && !file_exists($target_file)) {
                @rename($core_file, $target_file);
            }
            
            // 이윰빌더 photo 필드 업데이트
            if (isset($g5['eyoom_member'])) {
                sql_query("update {$g5['eyoom_member']} set photo = '{$mb_id}.{$ext}' where mb_id = '{$mb_id}' ");
            }
        }
    }
}

// 회원 프로필 이미지와 이윰빌더 photo 필드 최종 동기화 (기존 파일 존재 여부 체크)
if (isset($g5['eyoom_member'])) {
    $mb_img_dir = G5_DATA_PATH . '/member_image/' . substr($mb_id, 0, 2);
    foreach (array('gif', 'png', 'jpg') as $ext) {
        if (file_exists($mb_img_dir . '/' . $mb_id . '.' . $ext)) {
            sql_query("update {$g5['eyoom_member']} set photo = '{$mb_id}.{$ext}' where mb_id = '{$mb_id}' ");
            break;
        }
    }
}
?>
