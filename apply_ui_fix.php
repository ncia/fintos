<?php
$file = 'c:/xampp/htdocs/gnu/adm/eyoom_admin/theme/eba_basic/skin/shop/configform.html.php';
$content = file_get_contents($file);

// 정규표현식으로 해당 섹션의 끝부분을 찾음
$pattern = '/(<div class="note"><strong>Note:<\/strong> 모바일 캐릭터 배너의 설정을 PC와 별도로 관리합니다\..*?<\/div>\s+<\/div>\s+<\/div>)/s';

if (preg_match($pattern, $content, $matches)) {
    $search = $matches[1];
    $replace = $search . "\n                <div class=\"adm-form-tr\">
                    <div class=\"adm-form-td td-l\">
                        <label class=\"label\">보험상품 전체 카운트다운</label>
                    </div>
                    <div class=\"adm-form-td td-r\">
                        <div class=\"d-flex align-items-center flex-wrap\">
                            <section class=\"m-r-20\">
                                <label class=\"label\">출력 여부</label>
                                <label class=\"checkbox width-80px\">
                                    <input type=\"checkbox\" name=\"de_all_bodmi_use\" id=\"de_all_bodmi_use\" value=\"1\" <?php echo \$default['de_all_bodmi_use']?\"checked\":\"\"; ?>>
                                    <i></i> 출력
                                </label>
                            </section>
                            <section class=\"m-r-20\">
                                <label for=\"de_all_bodmi_title\" class=\"label\">프로모션 문구</label>
                                <label class=\"input width-150px\">
                                    <input type=\"text\" name=\"de_all_bodmi_title\" value=\"<?php echo get_sanitize_input(\$default['de_all_bodmi_title']); ?>\" id=\"de_all_bodmi_title\">
                                </label>
                            </section>
                            <section class=\"m-r-20\">
                                <label for=\"de_all_bodmi_font_size\" class=\"label\">제목 글자 크기</label>
                                <label class=\"select width-100px\">
                                    <select name=\"de_all_bodmi_font_size\" id=\"de_all_bodmi_font_size\">
                                        <?php
                                        \$all_fs_arr = array();
                                        for (\$i=8; \$i<=40; \$i++) \$all_fs_arr[] = (string)\$i;
                                        \$all_current_fs = str_replace('px', '', \$default['de_all_bodmi_font_size']);
                                        \$all_is_in_arr = false;
                                        foreach(\$all_fs_arr as \$all_fs) {
                                            \$all_selected = (\$all_current_fs == \$all_fs) ? 'selected':'';
                                            if(\$all_selected) \$all_is_in_arr = true;
                                            echo \"<option value='{\$all_fs}' {\$all_selected}>{\$all_fs}</option>\";
                                        }
                                        if (!\$all_is_in_arr && \$all_current_fs) {
                                            echo \"<option value='{\$all_current_fs}' selected>{\$all_current_fs}</option>\";
                                        }
                                        ?>
                                        <option value=\"direct\">직접입력</option>
                                    </select><i></i>
                                </label>
                            </section>
                            <section class=\"m-r-20\">
                                <label for=\"de_all_bodmi_font_color\" class=\"label\">글자 색상</label>
                                <label class=\"input width-60px\">
                                    <input type=\"color\" name=\"de_all_bodmi_font_color\" value=\"<?php echo \$default['de_all_bodmi_font_color'] ? \$default['de_all_bodmi_font_color'] : '#000000'; ?>\" id=\"de_all_bodmi_font_color\" style=\"padding:2px; height:34px;\">
                                </label>
                            </section>
                            <section class=\"m-r-20\">
                                <label for=\"de_all_bodmi_target_date\" class=\"label\">설정 날짜</label>
                                <label class=\"input width-150px\">
                                    <i class=\"icon-append far fa-calendar-alt\" id=\"btn_all_target_date\"></i>
                                    <input type=\"text\" name=\"de_all_bodmi_target_date\" value=\"<?php echo substr(get_sanitize_input(\$default['de_all_bodmi_target_date']), 0, 10); ?>\" id=\"de_all_bodmi_target_date\" class=\"datepicker\">
                                </label>
                            </section>
                            <section class=\"m-r-20\">
                                <label for=\"de_all_bodmi_timer_font_size\" class=\"label\">배경 글자 크기</label>
                                <label class=\"select width-100px\">
                                    <select name=\"de_all_bodmi_timer_font_size\" id=\"de_all_bodmi_timer_font_size\">
                                        <?php
                                        \$alltfs_arr = array();
                                        for (\$i=8; \$i<=40; \$i++) \$alltfs_arr[] = (string)\$i;
                                        \$all_current_tfs = str_replace('px', '', \$default['de_all_bodmi_timer_font_size']);
                                        if (!\$all_current_tfs) \$all_current_tfs = '16';
                                        \$all_is_in_tarr = false;
                                        foreach(\$alltfs_arr as \$alltfs) {
                                            \$all_selected = (\$all_current_tfs == \$alltfs) ? 'selected':'';
                                            if(\$all_selected) \$all_is_in_tarr = true;
                                            echo \"<option value='{\$alltfs}' {\$all_selected}>{\$alltfs}</option>\";
                                        }
                                        if (!\$all_is_in_tarr && \$all_current_tfs) {
                                            echo \"<option value='{\$all_current_tfs}' selected>{\$all_current_tfs}</option>\";
                                        }
                                        ?>
                                        <option value=\"direct\">직접입력</option>
                                    </select><i></i>
                                </label>
                            </section>
                            <section>
                                <label for=\"de_all_bodmi_bg_color\" class=\"label\">배경 색상</label>
                                <label class=\"input width-60px\">
                                    <input type=\"color\" name=\"de_all_bodmi_bg_color\" value=\"<?php echo \$default['de_all_bodmi_bg_color'] ? \$default['de_all_bodmi_bg_color'] : '#000000'; ?>\" id=\"de_all_bodmi_bg_color\" style=\"padding:2px; height:34px;\">
                                </label>
                            </section>
                        </div>
                        <div class=\"note\"><strong>Note:</strong> 보험상품 전체에 적용될 카운트다운 배너를 설정합니다.</div>
                    </div>
                </div>";

    if (strpos($content, 'de_all_bodmi_use') === false) {
        $new_content = str_replace($search, $replace, $content);
        file_put_contents($file, $new_content);
        echo "Modified successfully.\n";
    } else {
        echo "Already modified.\n";
    }
} else {
    echo "Pattern not found.\n";
}
?>
