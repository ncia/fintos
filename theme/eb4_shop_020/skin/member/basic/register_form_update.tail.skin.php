if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 12지신 자동 캐릭터 설정 로직
$mb_icon_auto = isset($_POST['mb_icon_auto']) ? clean_xss_tags(trim($_POST['mb_icon_auto'])) : '';

if ($mb_icon_auto && preg_match('/^[0-9]+_[a-z]+\.png$/', $mb_icon_auto)) {
    $source_path = G5_DATA_PATH . '/member_image/te/' . $mb_icon_auto;
    
    if (file_exists($source_path)) {
        // 아이콘/이미지 저장 경로 설정 (아이디 앞 2자리 폴더 구조)
        $dest_dir_icon = G5_DATA_PATH . '/member/' . substr($mb_id, 0, 2);
        $dest_dir_img  = G5_DATA_PATH . '/member_image/' . substr($mb_id, 0, 2);
        
        // 폴더 생성
        if (!is_dir($dest_dir_icon)) {
            @mkdir($dest_dir_icon, G5_DIR_PERMISSION);
            @chmod($dest_dir_icon, G5_DIR_PERMISSION);
        }
        if (!is_dir($dest_dir_img)) {
            @mkdir($dest_dir_img, G5_DIR_PERMISSION);
            @chmod($dest_dir_img, G5_DIR_PERMISSION);
        }
        
        // 파일 확장자 유지 또는 표준 형식 지정
        // 그누보드 표준 아이콘은 보통 gif이나, 최근 테마들은 png를 지원함
        $icon_ext = pathinfo($source_path, PATHINFO_EXTENSION);
        $dest_path_icon = $dest_dir_icon . '/' . $mb_id . '.' . $icon_ext;
        $dest_path_img  = $dest_dir_img . '/' . $mb_id . '.' . $icon_ext;
        
        // 이미지 복사 (기존 업로드 이미지가 없을 때만 실행하거나 강제 설정)
        // 여기서는 자동 설정 요청이므로 복사함
        @copy($source_path, $dest_path_icon);
        @chmod($dest_path_icon, G5_IMG_PERMISSION);
        
        @copy($source_path, $dest_path_img);
        @chmod($dest_path_img, G5_IMG_PERMISSION);
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
?>
