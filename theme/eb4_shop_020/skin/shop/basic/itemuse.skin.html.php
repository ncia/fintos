<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuse.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

// 시간 경과 표시 함수
if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => '년',
            'm' => '개월',
            'w' => '주',
            'd' => '일',
            'h' => '시간',
            'i' => '분',
            's' => '초',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' 전' : '방금 전';
    }
}

// 에디터 라이브러리 로드 확인 및 에디터 생성
include_once(G5_EDITOR_LIB);
if ($config['cf_editor']) {
    $is_dhtml_editor = true;
    $editor_html = editor_html('is_content', '', $is_dhtml_editor);
    $editor_js = '';
    $editor_js .= get_editor_js('is_content', $is_dhtml_editor);
    $editor_js .= chk_editor_js('is_content', $is_dhtml_editor);
}
?>

<style>
.product-use-wrap-main { padding-top: 30px; }

/* 후기 리스트 2열 배치 */
.review-list-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 40px;
}

@media (max-width: 991px) {
    .review-list-container { grid-template-columns: 1fr; }
}

/* 후기 카드 스타일 */
.fintos-review-card {
    background: #fff;
    border: 1px solid #f1f3f5;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    display: flex;
    flex-direction: column;
}

/* 별점 영역 */
.review-star-row { margin-left: auto; display: flex; align-items: center; gap: 2px; }
.review-star-row .fa-star { color: #ffc107; font-size: 18px; }
.review-star-row .fa-star.empty { color: #e9ecef; }

/* 작성자 및 시간 정보 */
.review-meta-row { 
    display: flex; 
    align-items: center; 
    gap: 12px; 
    margin-bottom: 20px;
}

.profile-img-box {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    overflow: hidden;
    background: #f8fafc;
    flex-shrink: 0;
    border: 1px solid #f1f3f5;
}
.profile-img-box img { width: 100%; height: 100%; object-fit: cover; }
.profile-img-box .no-img { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 24px; }

.user-info-text { display: flex; flex-direction: column; gap: 1px; }
.user-name { font-size: 18px; font-weight: 700; color: #1e293b; letter-spacing: -0.5px; }
.time-ago { color: #94a3b8; font-weight: 400; font-size: 13px; }

/* 본문 내용 */
.review-content-row { 
    font-size: 15px; 
    line-height: 1.7; 
    color: #475569;
}
</style>

<div class="product-use-wrap-main">
    
    <?php 
    // 작성 폼 상단 배치
    $item_use_form_skin = dirname(__FILE__).'/itemuseform.skin.html.php';
    if (is_file($item_use_form_skin)) {
        include_once($item_use_form_skin);
    }
    ?>

    <div class="review-list-container m-t-40">
        <?php if ($use_cnt > 0) { ?>
            <?php foreach ($item_use as $k => $info) { ?>
            <?php 
                // 프로필 이미지 경로 확인 (member_image 폴더 대응)
                $mb_id = $info['mb_id'];
                $is_profile = false;
                $profile_img = '';
                
                if ($mb_id) {
                    $dir = substr($mb_id,0,2);
                    // 1. member_image 폴더 확인 (실제 파일 존재 여부 체크)
                    if (is_file(G5_DATA_PATH.'/member_image/'.$dir.'/'.$mb_id.'.gif')) {
                        $profile_img = G5_DATA_URL.'/member_image/'.$dir.'/'.$mb_id.'.gif';
                        $is_profile = true;
                    } 
                    // 2. member 폴더 확인 (기존 경로 대응)
                    else if (is_file(G5_DATA_PATH.'/member/'.$dir.'/'.$mb_id.'.gif')) {
                        $profile_img = G5_DATA_URL.'/member/'.$dir.'/'.$mb_id.'.gif';
                        $is_profile = true;
                    }
                }
            ?>
            <div class="fintos-review-card">
                <!-- 프로필 + 작성자 + 시간 + 별점 -->
                <div class="review-meta-row">
                    <div class="profile-img-box">
                        <?php if ($is_profile) { ?>
                            <img src="<?php echo $profile_img; ?>?v=<?php echo time(); ?>" alt="profile">
                        <?php } else { ?>
                            <div class="no-img"><i class="fas fa-user-circle"></i></div>
                        <?php } ?>
                    </div>
                    <div class="user-info-text">
                        <span class="user-name"><?php echo $info['is_name']; ?></span>
                        <span class="time-ago"><?php echo time_elapsed_string($info['is_time']); ?></span>
                    </div>

                    <!-- 별점 (우측 정렬) -->
                    <div class="review-star-row">
                        <?php 
                        for($i=1; $i<=5; $i++) {
                            $star_class = ($i <= (int)$info['is_star']) ? 'fas fa-star' : 'fas fa-star empty';
                            echo '<i class="'.$star_class.'"></i>';
                        }
                        ?>
                    </div>
                </div>

                <!-- 3. 후기 본문 -->
                <div class="review-content-row">
                    <?php echo $info['is_content']; ?>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
            <div style="text-align:center; padding:50px 0; color:#888; font-size:16px; font-weight:600;">
                <i class="fas fa-info-circle m-r-5"></i> 등록된 상담후기가 없습니다.
            </div>
        <?php } ?>
    </div>

    <div class="m-t-30">
        <?php echo $use_pages; ?>
    </div>
</div>