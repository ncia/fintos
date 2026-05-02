<?php
/**
 * theme file : /theme/THEME_NAME/shop/index.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="shop-main-section1">
    <div class="container">
        <div class="main-section1-row">
            <div class="main-section1-l">
                <div class="main-section1-l1">
                    <?php /* EB콘텐츠 - shop020_main_categories */ ?>
                    <?php echo eb_contents('1658729735'); ?>
                </div>
                <div class="main-section1-l2">
                    <?php /* EB슬라이더 - shop020_main_2 */ ?>
                    <?php echo eb_slider('1652165926'); ?>
                </div>
            </div>
            <div class="main-section1-c">
                <div class="main-section1-c-in">
                    <?php /* EB슬라이더 - shop020_main_1 */ ?>
                    <?php echo eb_slider('1650608679'); ?>
                    
                    <?php /* EB슬라이더 - shop020_main_3 */ ?>
                    <?php echo eb_slider('1652336831'); ?>
                    
                    <?php /* EB슬라이더 - shop020_main_4 */ ?>
                    <?php echo eb_slider('1652165942'); ?>
                </div>
            </div>
            <div class="main-section1-r">
                <div class="main-section1-r1">
                    <style>
                    .bodmi-wrapper { 
                        position: relative; 
                        color-scheme: light; /* 다크 모드 반전 방지 */
                    }
                    .bodmi-wrapper img { filter: none !important; }
                    .bodmi-bubble-text {
                        position: absolute;
                        top: 28%;
                        left: 33%;
                        transform: translate(-50%, -50%);
                        font-size: <?php echo $default['de_bodmi_font_size'] ? str_replace('px', '', $default['de_bodmi_font_size']) : '13.5'; ?>px;
                        font-weight: 800;
                        color: <?php echo $default['de_bodmi_font_color'] ? $default['de_bodmi_font_color'] : '#555'; ?>;

                        text-align: center;
                        width: 50%;
                        pointer-events: none;
                        line-height: 1.2;
                        letter-spacing: -0.5px;
                        word-break: keep-all;
                    }
                    .bodmi-countdown-clock {
                        position: absolute;
                        top: 55%;
                        left: 34%;
                        transform: translate(-50%, 0);
                        background-color: <?php echo $default['de_bodmi_bg_color'] ? $default['de_bodmi_bg_color'] : '#000'; ?>;
                        color: #fff;
                        padding: 4px 10px;
                        border-radius: 5px;
                        font-size: <?php echo $default['de_bodmi_timer_font_size'] ? str_replace('px', '', $default['de_bodmi_timer_font_size']) : '16'; ?>px;
                        font-weight: 800;
                        pointer-events: none;
                        white-space: nowrap;
                    }
                    @media (max-width:1024px) {
                        .bodmi-bubble-text {
                            font-size: <?php echo $default['de_m_bodmi_font_size'] ? str_replace('px', '', $default['de_m_bodmi_font_size']) : '13.5'; ?>px !important;
                            color: <?php echo $default['de_m_bodmi_font_color'] ? $default['de_m_bodmi_font_color'] : '#555'; ?> !important;
                        }
                        .bodmi-countdown-clock {
                            background-color: <?php echo $default['de_m_bodmi_bg_color'] ? $default['de_m_bodmi_bg_color'] : '#000'; ?> !important;
                            font-size: <?php echo $default['de_m_bodmi_timer_font_size'] ? str_replace('px', '', $default['de_m_bodmi_timer_font_size']) : '16'; ?>px !important;
                        }
                    }

                    </style>
                    <?php 
                    $bodmi_use = G5_IS_MOBILE ? $default['de_m_bodmi_use'] : $default['de_bodmi_use'];
                    if($bodmi_use) { 
                        $bodmi_title = G5_IS_MOBILE ? $default['de_m_bodmi_title'] : $default['de_bodmi_title'];

                    ?>
                    <div class="m-b-10 bodmi-wrapper">
                        <a href="<?php echo G5_URL; ?>/countdown_form.php" class="animate-img-hvr2 d-block border-radius-5 overflow-hidden">
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/cat_banner.png" class="img-fluid bodmi_countdown" alt="보드미의 카운트다운">
                            <div class="bodmi-bubble-text"><?php echo $bodmi_title; ?></div>
                            <div class="bodmi-countdown-clock" id="bodmi_timer">00일 00시 00분</div>
                        </a>
                    </div>
                    <?php } ?>

                    <script>
                    let serverTimeOffset = 0;

                    function syncServerTime() {
                        $.ajax({
                            url: '<?php echo G5_SHOP_URL; ?>/get_server_time.php',
                            type: 'GET',
                            success: function(data) {
                                const serverTime = parseInt(data) * 1000;
                                const clientTime = new Date().getTime();
                                serverTimeOffset = serverTime - clientTime;
                                updateBodmiCountdown();
                            }
                        });
                    }

                    function updateBodmiCountdown() {
                        const targetDateStr = '<?php 
                            $target_date = G5_IS_MOBILE ? $default['de_m_bodmi_target_date'] : $default['de_bodmi_target_date'];
                            echo $target_date ? substr($target_date, 0, 10) : '2026-05-01'; 
                        ?>';
                        const targetDate = new Date(targetDateStr.replace(/-/g, '/') + ' 00:00:00').getTime();
                        const now = new Date().getTime() + serverTimeOffset;
                        const diff = targetDate - now;

                        const timerEl = document.getElementById('bodmi_timer');
                        if (!timerEl) return;

                        if (diff <= 0) {
                            timerEl.innerHTML = "D-Day";
                            return;
                        }

                        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        
                        const dStr = days.toString().padStart(2, '0');
                        const hStr = hours.toString().padStart(2, '0');
                        const mStr = minutes.toString().padStart(2, '0');

                        timerEl.innerHTML = `${dStr}일 ${hStr}시 ${mStr}분`;
                    }

                    $(document).ready(function() {
                        syncServerTime();
                        setInterval(updateBodmiCountdown, 1000); // 1초마다 화면 업데이트
                        setInterval(syncServerTime, 1000 * 60); // 1분마다 서버 시간 동기화
                    });
                    </script>

                    <div class="m-b-10">
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#insAgeModal" class="animate-img-hvr2 d-block border-radius-5 overflow-hidden">
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/banner_ins_age.png" class="img-fluid" alt="내 보험 나이 알아보기">
                        </a>
                    </div>
                    
                    <div class="m-b-10">
                        <a href="<?php echo G5_URL; ?>/pet_insurance.php" class="animate-img-hvr2 d-block border-radius-5 overflow-hidden">
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/banner_ins_pet.png" class="img-fluid" alt="펫 보험 가입 상담하기">
                        </a>
                    </div>
                </div>
                <div class="main-section1-r2">
                    <?php /* EB슬라이더 - shop020_countdown */ ?>
                    <?php echo eb_slider('1652666463'); ?>

                    <?php /* EB상품추출 - shop020_best */ ?>
                    <?php echo eb_goods('1658911060'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /* ---------- 쇼핑몰 브랜드 시작 ---------- */ ?>
<?php if ($eyoom['use_brand'] != 'n') { ?>
<div class="shop-main-section2">
    <div class="container">
        <?php echo eb_brand('basic'); ?>
    </div>
</div>
<?php } ?>
<?php /* ---------- 쇼핑몰 브랜드 끝 ---------- */ ?>

<div class="shop-main-section-basic <?php if ($eyoom['use_brand'] == 'n') { ?>border-top-1<?php } ?> border-bottom--1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (1) */ ?>
                <?php echo eb_slider('1658993441'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* EB상품추출 - shop020_main */ ?>
                <?php echo eb_goods('1652073560'); ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section3">
    <?php /* EB슬라이더 - shop020_main_6 */ ?>
    <?php echo eb_slider('1652230190'); ?>
</div>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (2) */ ?>
                <?php echo eb_slider('1659255375'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- 히트상품 시작 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-10px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type1_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(1); ?>"><strong>히트 <span>상품</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(1); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type1_list_skin']);
                    $list->set_type(1);
                    $list->set_view('it_img', true);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- 히트상품 끝 ---------- */ ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (3) */ ?>
                <?php echo eb_slider('1659257180'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- 추천상품 시작 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-10px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type2_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(2); ?>"><strong>추천 <span>상품</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(2); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type2_list_skin']);
                    $list->set_type(2);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- 추천상품 끝 ---------- */ ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section-basic border-bottom--1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (4) */ ?>
                <?php echo eb_slider('1659312032'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- 최신상품 시작 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-10px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type3_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(3); ?>"><strong>최신 <span>상품</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(3); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type3_list_skin']);
                    $list->set_type(3);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- 최신상품 끝 ---------- */ ?>
            </div>
        </div>
    </div>
</div>

<?php /* ---------- 이벤트박스 시작 ---------- */ ?>
<?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxevent.skin.html.php'); // 이벤트 ?>
<?php /* ---------- 이벤트박스 끝 ---------- */ ?>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (5) */ ?>
                <?php echo eb_slider('1659316824'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- 인기상품 시작 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type4_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(4); ?>"><strong>인기 <span>상품</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(4); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type4_list_skin']);
                    $list->set_type(4);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- 인기상품 끝 ---------- */ ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (6) */ ?>
                <?php echo eb_slider('1659316859'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- 할인상품 시작 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type5_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(5); ?>"><strong>할인 <span>상품</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(5); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type5_list_skin']);
                    $list->set_type(5);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- 할인상품 끝 ---------- */ ?>
            </div>
        </div>
    </div>
</div>

<?php if ($main_review == 'yes') { ?>
<div class="shop-main-section4">
    <div class="container">
        <?php /* ---------- 메인 사용후기 시작 ---------- */ ?>
        <?php
        $sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
                    from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
                    where a.is_confirm = '1'
                    order by a.is_id desc
                    limit 0,10 ";
        $result = sql_query($sql);
        
        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($i == 0) {
                echo '<div class="main-heading">'.PHP_EOL;
                echo '<h2><a href="'.G5_SHOP_URL.'/itemuselist.php"><strong>사용자 <span>리뷰</span></strong></a></h2>'.PHP_EOL;
                echo '<a href="'.G5_SHOP_URL.'/itemuselist.php" class="heading-more-btn"><i class="fas fa-plus"></i></a>'.PHP_EOL;
                echo '</div>'.PHP_EOL;
                echo '<div class="review-main">'.PHP_EOL;
                echo '<div class="review-main-in">'.PHP_EOL;
            }
        
            $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'].'#sit_use';
        ?>
            <div class="review-item">
                <div class="review-item-in">
                    <a href="<?php echo $review_href; ?>">
                        <div class="review-img animate-img-hvr2">
                            <div class="review-img-in">
                                <?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 500, 500); ?>
                            </div>
                        </div>
                    </a>
                    <div class="review-cont">
                        <h4 class="ellipsis"><a href="<?php echo $review_href; ?>"><?php echo get_text(cut_str($row['is_subject'], 50)); ?></a></h4>
                        <h5 class="ellipsis"><a href="<?php echo $review_href; ?>"><?php echo $row['it_name']; ?></a></h5>
                        <p class="ellipsis-2"><?php echo get_text(cut_str(strip_tags($row['is_content']), 90), 1); ?></p>
                    </div>
                </div>
            </div>
        <?php
        }
        
        if($i > 0) {
            echo '</div>'.PHP_EOL;
            echo '</div>'.PHP_EOL;
        }
        ?>
        
        <script>
        $('.review-main-in').slick({
            dots: true,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
        </script>
        <?php /* ---------- 메인 사용후기 끝 ---------- */ ?>
    </div>
</div>
<?php } ?>

<!-- 보험 나이 계산기 모달 시작 -->
<div class="modal fade" id="insAgeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden" style="border-radius:12px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);">
            <div class="modal-header text-white p-4" style="background-color: #007bff; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title f-s-20r f-w-700"><i class="fas fa-calculator m-r-10"></i>보험 나이 계산기</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white">
                <style>
                    /* Modal Specific MDB Styles */
                    #insAgeForm .label-title { font-size: 15px; font-weight: 700; color: #333; margin-bottom: 10px; display: block; }
                    #insAgeForm .input-group-custom { 
                        position: relative; 
                        margin-bottom: 20px;
                        display: flex;
                        align-items: center;
                        border: 1px solid #007bff;
                        border-radius: 8px;
                        height: 48px;
                        background-color: #fff;
                    }
                    #insAgeForm .input-group-custom input { 
                        border: none !important;
                        height: 100%;
                        padding: 0 15px 0 45px;
                        font-size: 15px;
                        width: 100%;
                        outline: none;
                        background: transparent;
                        color: #1f2937;
                    }
                    #insAgeForm .input-group-custom i {
                        position: absolute;
                        left: 15px;
                        color: #007bff;
                        font-size: 18px;
                    }
                    #insAgeForm .gender-selector-modal { display: flex; gap: 10px; margin-bottom: 25px; }
                    #insAgeForm .gender-selector-modal input { display: none; }
                    #insAgeForm .gender-label-modal {
                        flex: 1;
                        border: 1px solid #007bff;
                        border-radius: 8px;
                        height: 48px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        background: #fff;
                        color: #9ca3af;
                        font-size: 15px;
                        transition: all 0.2s;
                    }
                    #insAgeForm .gender-selector-modal input:checked + .gender-label-modal {
                        background: #007bff;
                        color: #fff;
                    }
                    #insAgeForm .gender-label-modal i { margin-right: 8px; font-size: 16px; }
                    .btn-mdb-primary {
                        background: #007bff !important;
                        color: #fff !important;
                        height: 50px;
                        border-radius: 8px;
                        font-size: 16px;
                        font-weight: 700;
                        width: 100%;
                        border: none;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                        transition: all 0.2s;
                    }
                    .btn-mdb-primary:hover { background: #0069d9 !important; transform: translateY(-1px); }
                </style>

                <form id="insAgeForm">
                    <div class="m-b-20">
                        <label class="label-title">이름</label>
                        <div class="input-group-custom">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" id="ins_name" value="<?php echo $is_member ? $member['mb_nick'] : ''; ?>" placeholder="이름을 입력하세요">
                        </div>
                    </div>
                    <div class="m-b-20" id="gender_group">
                        <label class="label-title">성별</label>
                        <div class="gender-selector-modal">
                            <input type="radio" name="gender" id="modal_sex_m" value="M">
                            <label for="modal_sex_m" class="gender-label-modal"><i class="fas fa-mars"></i> 남성</label>
                            
                            <input type="radio" name="gender" id="modal_sex_f" value="F">
                            <label for="modal_sex_f" class="gender-label-modal"><i class="fas fa-venus"></i> 여성</label>
                        </div>
                    </div>
                    <div class="m-b-25">
                        <label class="label-title">생년월일 (8자리)</label>
                        <div class="input-group-custom">
                            <i class="far fa-calendar-alt"></i>
                            <input type="text" name="birth" id="ins_birth" placeholder="예: 19810125" maxlength="8">
                        </div>
                    </div>
                    <button type="button" onclick="calculateInsAge()" class="btn-mdb-primary">보험 나이 조회</button>
                </form>
                
                <div id="ins_result" class="m-t-20 p-4 border-radius-10 bg-white" style="display:none; border:1px solid #e0e6ed; box-shadow:0 10px 15px -3px rgba(0,0,0,0.05); position: relative;">
                    <div class="text-start">
                        <p class="f-s-16r m-b-10 text-dark f-w-700" id="res_msg1" style="color: #007bff !important;"></p>
                        <p class="f-s-16r m-b-20 text-dark" id="res_msg2"></p>
                    </div>
                    
                    <div class="text-center m-b-20">
                        <video autoplay loop muted playsinline style="width: 220px; height: 220px; object-fit: cover; border-radius: 15px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));">
                            <source src="<?php echo EYOOM_THEME_URL; ?>/image/calculate/bodmi_calculate.mp4" type="video/mp4">
                        </video>
                    </div>
                    
                    <div class="text-start m-b-20 f-s-15r text-dark" id="res_msg3" style="line-height:1.6; color: #4b5563;"></div>
                    
                    <button type="button" onclick="location.href='<?php echo G5_URL; ?>/insurance_age.php';" class="btn-mdb-primary">보험 가입 상담</button>
                    <div class="text-center m-t-15">
                        <a href="javascript:void(0);" onclick="resetInsAge();" class="text-gray f-s-13r underline f-w-700">다시 계산하기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculateInsAge() {
    const nameInput = document.getElementById('ins_name').value.trim();
    const name = nameInput || '고객';
    const gender = document.querySelector('input[name="gender"]:checked');
    const birthStr = document.getElementById('ins_birth').value.trim();
    
    if (!gender) {
        alert('성별을 선택해주세요.');
        return;
    }
    
    if (!/^\d{8}$/.test(birthStr)) {
        alert('생년월일 8자리를 입력해주세요. (예: 19810125)');
        return;
    }
    
    const year = parseInt(birthStr.substr(0,4));
    const month = parseInt(birthStr.substr(4,2));
    const day = parseInt(birthStr.substr(6,2));
    
    if (month < 1 || month > 12 || day < 1 || day > 31) {
        alert('올바른 생년월일을 입력해주세요.');
        return;
    }
    
    const birthDate = new Date(year, month - 1, day);
    const today = new Date();
    
    if (birthDate > today) {
        alert('생년월일이 오늘보다 이전이어야 합니다.');
        return;
    }
    
    // 만 나이 계산
    let realAge = today.getFullYear() - birthDate.getFullYear();
    const todayMD = (today.getMonth() + 1) * 100 + today.getDate();
    const birthMD = month * 100 + day;
    if (todayMD < birthMD) {
        realAge--;
    }
    
    // 보험나이 기준 월수 차이 계산
    let diffMonths = (today.getFullYear() - birthDate.getFullYear()) * 12 + (today.getMonth() - birthDate.getMonth());
    if (today.getDate() < birthDate.getDate()) {
        diffMonths--;
    }
    
    const remainMonths = diffMonths % 12;
    let insAge = realAge;
    // 만 나이에서 잔여 월수가 6개월 이상이면 +1세
    if (remainMonths >= 6) {
        insAge = realAge + 1;
    }
    
    // 기준 생일 (가장 최근 생일)
    let lastBirthday = new Date(today.getFullYear(), month - 1, day);
    if (lastBirthday > today) {
        lastBirthday.setFullYear(today.getFullYear() - 1);
    }
    
    // 보험 나이는 생일로부터 6개월(상령일)이 지나면 올라감
    // 다음 나이 상승일 (상령일) = 가장 최근 생일 + 6개월
    let sangDate = new Date(lastBirthday.getFullYear(), lastBirthday.getMonth() + 6, lastBirthday.getDate());
    
    // 이미 올해 상령일이 지났다면, 다음 상령일은 내년 생일로부터 6개월 후
    if (sangDate <= today) {
        sangDate = new Date(lastBirthday.getFullYear() + 1, lastBirthday.getMonth() + 6, lastBirthday.getDate());
    }
    
    // 상령일까지 남은 일수 계산
    const diffTime = sangDate.getTime() - today.getTime();
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    document.getElementById('res_msg1').innerHTML = `✅ ${name}님의 보험 나이는 오늘 기준 <strong>${insAge}세</strong>입니다.`;
    document.getElementById('res_msg2').innerHTML = `✅ 보험 나이 <strong>${insAge + 1}세</strong>가 되는 날까지 <span style="color:#FF4343; font-weight:bold;">${diffDays}일</span> 남았습니다.`;
    document.getElementById('res_msg3').innerHTML = `☑️ 보험료 인상전 <span style="color:#FF4343; font-weight:bold;">${diffDays}일</span>😨지금 바로 <span style="color:#6546FF; font-weight:bold;">보험전문가</span>와 상담하세요!<br>☑️ 상담만 받아도 내 보험 나이에 맞춘 <span style="color:#6546FF; font-weight:bold;">베스트 플랜</span>을 드립니다.<br>☑️ 가입하시면 🐱<span style="color:#FE8FFC; font-weight:bold;">보드미</span>가 드리는 <span style="color:#6546FF; font-weight:bold;">최대 3만원</span> 🎁선물까지🎉`;
    document.getElementById('insAgeForm').style.display = 'none';
    document.getElementById('ins_result').style.display = 'block';
}

function resetInsAge() {
    document.getElementById('insAgeForm').style.display = 'block';
    document.getElementById('ins_result').style.display = 'none';
}

// 생년월일 입력 시 숫만 입력되도록 처리
document.getElementById('ins_birth').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
<!-- 보험 나이 계산기 모달 끝 -->