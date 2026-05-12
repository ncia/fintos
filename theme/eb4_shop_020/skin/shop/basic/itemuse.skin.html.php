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

/* 후기 리스트 4열 배치 */
.review-list-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-top: 40px;
}

@media (max-width: 1200px) {
    .review-list-container { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 991px) {
    .review-list-container { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .review-list-container { grid-template-columns: 1fr; }
}

<?php
// 이름 마스킹 함수 (예: 양수경 -> 양*경, 최고관리자 -> 최***자)
if (!function_exists('get_masked_name')) {
    function get_masked_name($name) {
        $len = mb_strlen($name, 'UTF-8');
        if ($len <= 1) return $name;
        if ($len == 2) return mb_substr($name, 0, 1, 'UTF-8') . '*';
        return mb_substr($name, 0, 1, 'UTF-8') . str_repeat('*', $len - 2) . mb_substr($name, $len - 1, 1, 'UTF-8');
    }
}
?>

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
    min-height: 250px;
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

/* 후기 요약 섹션 */
.review-summary-container {
    display: flex;
    background: #fff;
    border: 1px solid #f1f3f5;
    border-radius: 20px;
    padding: 40px;
    margin: 30px 0;
    align-items: center;
    justify-content: space-around;
    box-shadow: 0 10px 30px rgba(0,0,0,0.02);
}

.score-summary-left { text-align: center; }
.star-big {
    font-size: 52px;
    font-weight: 900;
    color: #1e293b;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    letter-spacing: -1px;
}
.star-big i { color: #ffc107; font-size: 42px; }
.total-reviews-text { color: #64748b; font-size: 18px; font-weight: 500; }

.score-chart-right {
    display: flex;
    gap: 35px;
    align-items: flex-end;
}

.chart-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 80px;
}

.col-count { font-size: 14px; color: #94a3b8; margin-bottom: 10px; font-weight: 600; }
.bar-container {
    width: 14px;
    height: 120px;
    background: #f1f5f9;
    border-radius: 20px;
    position: relative;
    margin-bottom: 15px;
    overflow: hidden;
}
.bar-value {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #ff3b30;
    border-radius: 20px;
    transition: height 1s ease-out;
}
.col-label { font-size: 15px; font-weight: 700; color: #334155; }
.col-desc { font-size: 12px; color: #94a3b8; margin-top: 4px; font-weight: 500; }

@media (max-width: 991px) {
    .review-summary-container { flex-direction: column; gap: 50px; padding: 40px 20px; }
    .score-chart-right { gap: 12px; width: 100%; justify-content: center; }
    .chart-col { width: 18%; }
    .bar-container { height: 100px; }
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

    <?php 
    // 후기 통계 데이터 계산
    $score_stats = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0);
    $total_score = 0;
    $total_count = 0;

    $stats_sql = "SELECT is_score, COUNT(*) as cnt FROM {$g5['g5_shop_item_use_table']} WHERE it_id = '$it_id' AND is_confirm = '1' GROUP BY is_score";
    $stats_res = sql_query($stats_sql);
    while($srow=sql_fetch_array($stats_res)) {
        $score_stats[(int)$srow['is_score']] = (int)$srow['cnt'];
        $total_score += (int)$srow['is_score'] * (int)$srow['cnt'];
        $total_count += (int)$srow['cnt'];
    }
    $avg_score = $total_count > 0 ? round($total_score / $total_count, 2) : 0;
    ?>

    <!-- 후기 통계 요약 섹션 -->
    <div class="review-summary-container">
        <div class="score-summary-left">
            <div class="star-big"><i class="fas fa-star"></i> <?php echo number_format($avg_score, 2); ?></div>
            <div class="total-reviews-text">전체 상품 만족도 (<?php echo number_format($total_count); ?>건)</div>
        </div>
        <div class="score-chart-right">
            <?php
            $labels = array(
                5 => '최고예요',
                4 => '좋아요',
                3 => '괜찮아요',
                2 => '그저 그래요',
                1 => '별로예요'
            );
            for($i=5; $i>=1; $i--) {
                $count = $score_stats[$i];
                $per = $total_count > 0 ? ($count / $total_count) * 100 : 0;
                $active_class = $count > 0 ? 'active' : '';
            ?>
            <div class="chart-col <?php echo $active_class; ?>">
                <span class="col-count" style="<?php echo $count > 0 ? 'color:#1e293b; font-weight:700;' : ''; ?>"><?php echo number_format($count); ?>건</span>
                <div class="bar-container">
                    <div class="bar-value" style="height:<?php echo $per; ?>%; <?php echo $i < 5 ? 'background:#e2e8f0;' : ''; ?>"></div>
                </div>
                <span class="col-label"><?php echo $i; ?>점</span>
                <span class="col-desc">(<?php echo $labels[$i]; ?>)</span>
            </div>
            <?php } ?>
        </div>
    </div>

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
                        <span class="user-name"><?php echo get_masked_name($info['is_name']); ?></span>
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
                <div class="review-content-row" style="flex: 1;">
                    <?php echo $info['is_content']; ?>
                </div>

                <!-- 4. 관리 버튼 (최고관리자 또는 작성자) -->
                <?php if ($is_admin || ($is_member && $mb_id === $info['mb_id'])) { ?>
                <div class="review-manage-btns" style="margin-top:20px; text-align:right;">
                    <a href="<?php echo $info['it_use_edit']; ?>" class="itemuse_update" style="font-size:13px; color:#cbd5e1; margin-right:15px; text-decoration:none; transition:color 0.2s;"><i class="far fa-edit m-r-5"></i>수정</a>
                    <a href="<?php echo $info['it_use_del']; ?>" class="itemuse_delete" style="font-size:13px; color:#cbd5e1; text-decoration:none; transition:color 0.2s;"><i class="far fa-trash-alt m-r-5"></i>삭제</a>
                </div>
                <style>
                .review-manage-btns a:hover { color: #94a3b8 !important; }
                </style>
                <?php } ?>
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