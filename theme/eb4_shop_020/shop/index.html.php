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
                    <?php /* ---------- 보험 투표 콘텐츠 시작 ---------- */ ?>
                    <?php
                    // 사용자의 현재 IP 가져오기
                    $user_ip = $_SERVER['REMOTE_ADDR'];
                    
                    // 아직 이 IP로 참여하지 않은 질문 중에서 랜덤으로 하나 가져오기
                    $sql_unvoted = " SELECT * FROM g5_fintos_poll 
                                     WHERE poll_ip NOT LIKE '%,{$user_ip},%' 
                                     OR poll_ip IS NULL 
                                     ORDER BY rand() LIMIT 1 ";
                    $random_poll = sql_fetch($sql_unvoted);
                    
                    // 만약 모든 질문에 참여했다면, 그냥 아무거나 하나 보여줌 (결과 보기 위주)
                    if (!$random_poll['id']) {
                        $random_poll = sql_fetch("SELECT * FROM g5_fintos_poll ORDER BY rand() LIMIT 1");
                        $all_voted = true;
                    } else {
                        $all_voted = false;
                    }
                    ?>
                    <style>
                    .fintos-poll-container {
                        background: #f1f3f9;
                        padding: 10px;
                        border-radius: 16px;
                        margin-bottom: 30px;
                        max-width: 800px;
                        margin: 0 auto 30px;
                    }
                    .fintos-poll-box {
                        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
                        border-radius: 12px;
                        padding: 7px 30px;
                        box-shadow: 0 10px 30px rgba(65, 105, 225, 0.15);
                        font-family: 'Pretendard', sans-serif;
                        position: relative;
                        overflow: hidden;
                        max-width: 776px;
                        min-height: 150px;
                        height: auto;
                        margin: 0;
                        display: flex;
                        flex-direction: column;
                        justify-content: flex-start;
                        transition: all 0.4s ease;
                    }
                    .fintos-poll-box::before {
                        content: 'POLL';
                        position: absolute;
                        top: -5px;
                        right: -5px;
                        font-size: 50px;
                        font-weight: 900;
                        color: rgba(65, 105, 225, 0.03);
                        pointer-events: none;
                    }
                    .fintos-poll-header {
                        margin-bottom: 0;
                        text-align: center;
                    }
                    .fintos-poll-header {
                        margin-bottom: 8px;
                    }
                    .fintos-poll-badge {
                        display: inline-block;
                        background: #4169e1;
                        color: #fff;
                        padding: 6px 15px;
                        border-radius: 50px;
                        font-size: 16px;
                        font-weight: 600;
                        margin-bottom: 6px;
                    }
                    .fintos-poll-question {
                        font-size: 18px;
                        font-weight: 800;
                        color: #2d3436;
                        letter-spacing: -0.5px;
                        word-break: keep-all;
                    }
                    .fintos-poll-options {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 12px;
                    }
                    .fintos-poll-option {
                        position: relative;
                        background: #fff;
                        border: 1px solid #e1e4f3;
                        padding: 10px 15px;
                        border-radius: 10px;
                        cursor: pointer;
                        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                        text-align: center;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 48px;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
                    }
                    .fintos-poll-option:hover {
                        border-color: #4169e1;
                        background: #f8faff;
                        transform: translateY(-2px);
                        box-shadow: 0 4px 10px rgba(65, 105, 225, 0.08);
                    }
                    .fintos-poll-option.selected {
                        background: #4169e1;
                        border-color: #4169e1;
                        color: #fff;
                    }
                    .fintos-poll-label {
                        font-size: 16px;
                        font-weight: 700;
                        color: #4169e1;
                        margin-right: 10px;
                        white-space: nowrap;
                    }
                    .fintos-poll-option.selected .fintos-poll-label {
                        color: rgba(255,255,255,0.9);
                    }
                    .fintos-poll-text {
                        font-size: 16px;
                        font-weight: 700;
                        word-break: keep-all;
                        line-height: 1.1;
                    }
                    .fintos-poll-result {
                        display: none;
                        margin-top: 5px;
                        text-align: center;
                        animation: fadeIn 0.4s ease;
                    }
                    @keyframes fadeIn {
                        from { opacity: 0; transform: translateY(5px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .fintos-poll-thanks {
                        font-weight: 600;
                        color: #4169e1;
                        background: #f0f3ff;
                        padding: 6px 20px;
                        border-radius: 8px;
                        display: inline-block;
                        font-size: 13px;
                    }
                    .fintos-poll-result {
                        display: none;
                        text-align: center;
                        animation: fadeIn 0.5s ease;
                    }
                    .fintos-poll-thanks {
                        color: #4169e1;
                        font-weight: 700;
                        font-size: 14px;
                        margin-bottom: 5px;
                    }
                    .fintos-poll-result-btn {
                        background: #4169e1;
                        color: #fff;
                        border: none;
                        padding: 4px 10px;
                        border-radius: 4px;
                        font-size: 11px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.2s;
                        display: inline-block;
                    }
                    .fintos-poll-result-btn:hover {
                        background: #3152b1;
                        transform: translateY(-1px);
                    }
                    /* Toast Style */
                    .fintos-poll-toast {
                        visibility: hidden;
                        min-width: 280px;
                        margin-left: -140px;
                        background-color: rgba(33, 33, 33, 0.95);
                        color: #fff;
                        border-radius: 12px;
                        padding: 20px;
                        position: fixed;
                        z-index: 10000;
                        left: 50%;
                        bottom: 50px;
                        font-size: 14px;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
                        backdrop-filter: blur(5px);
                    }
                    .toast-title {
                        font-weight: 700;
                        margin-bottom: 15px;
                        text-align: center;
                        font-size: 15px;
                        color: #fff;
                    }
                    .toast-item {
                        margin-bottom: 12px;
                    }
                    .toast-label {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 5px;
                        font-size: 13px;
                    }
                    .toast-bar-wrap {
                        background: rgba(255,255,255,0.1);
                        height: 10px;
                        border-radius: 5px;
                        overflow: hidden;
                    }
                    .toast-bar {
                        background: linear-gradient(90deg, #4169e1, #6c5ce7);
                        height: 100%;
                        border-radius: 5px;
                        transition: width 1s ease-in-out;
                    }
                    .fintos-poll-toast.show {
                        visibility: visible;
                        animation: fadein_toast 0.5s, fadeout_toast 0.5s 3.5s;
                    }
                    @keyframes fadein_toast { from {bottom: 0; opacity: 0;} to {bottom: 50px; opacity: 1;} }
                    @keyframes fadeout_toast { from {bottom: 50px; opacity: 1;} to {bottom: 0; opacity: 0;} }
                    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }

                    @media (max-width: 768px) {
                        .fintos-poll-box {
                            height: auto;
                            min-height: 150px;
                        }
                        .fintos-poll-options {
                            grid-template-columns: 1fr;
                        }
                    }
                    </style>

                    <div class="fintos-poll-container">
                        <div class="fintos-poll-box">
                            <div class="fintos-poll-header">
                                <span class="fintos-poll-badge">⚖️ 보험 밸런스 게임에 참여하셨나요?</span>
                                <div class="fintos-poll-question">
                                    Q. <?php echo htmlspecialchars($random_poll['question']); ?>
                                </div>
                            </div>
                            <div class="fintos-poll-options" id="fintos-poll-options" <?php echo $all_voted ? 'style="opacity:0.5; pointer-events:none;"' : ''; ?>>
                                <div class="fintos-poll-option" onclick="handlePoll(this, 'A')">
                                    <span class="fintos-poll-label">🅰️ 선택</span>
                                    <span class="fintos-poll-text"><?php echo htmlspecialchars($random_poll['option_a']); ?></span>
                                </div>
                                <div class="fintos-poll-option" onclick="handlePoll(this, 'B')">
                                    <span class="fintos-poll-label">🅱️ 선택</span>
                                    <span class="fintos-poll-text"><?php echo htmlspecialchars($random_poll['option_b']); ?></span>
                                </div>
                            </div>
                            <div class="fintos-poll-result" id="fintos-poll-result" <?php echo $all_voted ? 'style="display:block;"' : ''; ?>>
                                <div class="fintos-poll-thanks">
                                    <?php if ($all_voted) { ?>
                                        <i class="fas fa-info-circle m-r-5"></i> 이미 모든 질문에 참여하셨습니다!
                                    <?php } else { ?>
                                        <i class="fas fa-check-circle m-r-5"></i> 투표 완료! 소중한 의견 감사합니다.
                                    <?php } ?>
                                </div>
                                <button type="button" class="fintos-poll-result-btn" onclick="showPollResults()">실시간 투표 결과 보기</button>
                            </div>
                        </div>
                    </div>

                    <script>
                    function handlePoll(el, type) {
                        if (document.getElementById('fintos-poll-result').style.display === 'block') return;
                        
                        const pollId = '<?php echo $random_poll['id']; ?>';
                        const options = document.querySelectorAll('.fintos-poll-option');
                        options.forEach(opt => opt.classList.remove('selected'));
                        el.classList.add('selected');

                        // DB에 투표 결과 반영
                        $.post('<?php echo G5_URL; ?>/poll_ajax.php', {
                            mode: 'vote',
                            id: pollId,
                            type: type
                        }, function(data) {
                            if(data.success) {
                                setTimeout(() => {
                                    document.getElementById('fintos-poll-options').style.opacity = '0.5';
                                    document.getElementById('fintos-poll-options').style.pointerEvents = 'none';
                                    document.getElementById('fintos-poll-result').style.display = 'block';
                                }, 300);
                            } else if (data.error === 'already_voted') {
                                alert('이미 이 질문에 투표하셨습니다!');
                                location.reload();
                            }
                        }, 'json');
                    }

                    function showPollResults() {
                        const pollId = '<?php echo $random_poll['id']; ?>';
                        
                        $.post('<?php echo G5_URL; ?>/poll_ajax.php', {
                            mode: 'results',
                            id: pollId
                        }, function(res) {
                            if(res.error) return;

                            const aCount = parseInt(res.count_a);
                            const bCount = parseInt(res.count_b);
                            const total = aCount + bCount;
                            const perA = Math.round((aCount / total) * 100);
                            const perB = 100 - perA;

                            const content = `
                                <div class="toast-title">📊 실시간 투표 현황</div>
                                <div class="toast-item">
                                    <div class="toast-label">
                                        <span>🅰️ 선택</span>
                                        <span>${aCount.toLocaleString()}명 (${perA}%)</span>
                                    </div>
                                    <div class="toast-bar-wrap">
                                        <div class="toast-bar" style="width: ${perA}%"></div>
                                    </div>
                                </div>
                                <div class="toast-item">
                                    <div class="toast-label">
                                        <span>🅱️ 선택</span>
                                        <span>${bCount.toLocaleString()}명 (${perB}%)</span>
                                    </div>
                                    <div class="toast-bar-wrap">
                                        <div class="toast-bar" style="width: ${perB}%"></div>
                                    </div>
                                </div>
                                <div style="text-align:center; font-size:11px; margin-top:10px; color:rgba(255,255,255,0.5);">현재까지 총 ${total.toLocaleString()}명이 참여했습니다.</div>
                            `;

                            let toast = document.getElementById('fintos-poll-toast');
                            if (!toast) {
                                toast = document.createElement('div');
                                toast.id = 'fintos-poll-toast';
                                document.body.appendChild(toast);
                            }
                            toast.innerHTML = content;
                            toast.className = 'fintos-poll-toast show';
                            setTimeout(() => { toast.className = toast.className.replace('show', ''); }, 4000);
                        }, 'json');
                    }
                    </script>
                    <?php /* ---------- 보험 투표 콘텐츠 끝 ---------- */ ?>

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
                        color-scheme: light;
                    }
                    .pc-only { display: block; }
                    .mobile-only { display: none; }
                    @media (max-width:1024px) {
                        .pc-only { display: none; }
                        .mobile-only { display: block; }
                    }
                    .bodmi-wrapper img { filter: none !important; }

                    .bodmi-countdown-box {
                        position: absolute;
                        top: calc(55% + 17px);
                        left: 5%;
                        width: 90%;
                        pointer-events: none;
                    }
                    .bodmi-countdown-container {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 4px 10px;
                        border-radius: 6px;
                        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
                        min-height: 32px;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                        
                        /* 기본 PC 설정 */
                        font-weight: <?php echo $default['de_bodmi_font_weight'] ? $default['de_bodmi_font_weight'] : '700'; ?>;
                        border: 1px solid <?php echo $default['de_bodmi_font_color'] ? $default['de_bodmi_font_color'] : '#007bff'; ?>;
                        color: <?php echo $default['de_bodmi_font_color'] ? $default['de_bodmi_font_color'] : '#007bff'; ?>;
                        background: #fff;
                    }
                    .bodmi-countdown-title {
                        display: flex;
                        align-items: center;
                        gap: 6px;
                        font-size: <?php echo $default['de_bodmi_font_size'] ? str_replace('px', '', $default['de_bodmi_font_size']) : '13'; ?>px;
                        white-space: nowrap;
                    }
                    .bodmi-countdown-title .mo-title { display: none; }
                    
                    .bodmi-countdown-timer {
                        font-size: <?php echo $default['de_bodmi_font_size'] ? str_replace('px', '', $default['de_bodmi_font_size']) : '15'; ?>px;
                        letter-spacing: -0.5px;
                        font-variant-numeric: tabular-nums;
                        white-space: nowrap;
                    }

                    @media (max-width:1024px) {
                        .bodmi-countdown-container {
                            font-weight: <?php echo $default['de_m_bodmi_font_weight'] ? $default['de_m_bodmi_font_weight'] : '700'; ?>;
                            border-color: <?php echo $default['de_m_bodmi_font_color'] ? $default['de_m_bodmi_font_color'] : '#007bff'; ?>;
                            color: <?php echo $default['de_m_bodmi_font_color'] ? $default['de_m_bodmi_font_color'] : '#007bff'; ?>;
                        }
                        .bodmi-countdown-title .pc-title { display: none; }
                        .bodmi-countdown-title .mo-title { display: inline; }
                        
                        .bodmi-countdown-title {
                            font-size: <?php echo $default['de_m_bodmi_font_size'] ? str_replace('px', '', $default['de_m_bodmi_font_size']) : '13'; ?>px;
                        }
                        .bodmi-countdown-timer {
                            font-size: <?php echo $default['de_m_bodmi_font_size'] ? str_replace('px', '', $default['de_m_bodmi_font_size']) : '13'; ?>px;
                        }
                    }

                    </style>
                    <?php 
                    $bodmi_pc_use = $default['de_bodmi_use'];
                    $bodmi_mo_use = $default['de_m_bodmi_use'];
                    
                    if($bodmi_pc_use || $bodmi_mo_use) { 
                    ?>
                    <div class="m-b-10 bodmi-wrapper <?php echo !$bodmi_pc_use ? 'mobile-only':''; ?> <?php echo !$bodmi_mo_use ? 'pc-only':''; ?>">
                        <a href="<?php echo G5_URL; ?>/countdown_counsel.php" class="animate-img-hvr2 d-block border-radius-5 overflow-hidden">
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/cat_banner.png" class="img-fluid bodmi_countdown" alt="보드미의 카운트다운">

                            <div class="bodmi-countdown-box">
                                <div class="bodmi-countdown-container">
                                    <div class="bodmi-countdown-title">
                                        <i class="fas fa-clock"></i> 
                                        <span class="pc-title"><?php echo $default['de_bodmi_title']; ?></span>
                                        <span class="mo-title"><?php echo $default['de_m_bodmi_title']; ?></span>
                                    </div>
                                    <div class="bodmi-countdown-timer" id="bodmi_timer">00일 00시 00분</div>
                                </div>
                            </div>
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
                        const pcTargetDate = '<?php echo substr($default['de_bodmi_target_date'], 0, 10); ?>';
                        const moTargetDate = '<?php echo substr($default['de_m_bodmi_target_date'], 0, 10); ?>';
                        const targetDateStr = (window.innerWidth <= 1024) ? moTargetDate : pcTargetDate;
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

<div class="shop-main-section-basic <?php if ($eyoom['use_brand'] == 'n') { ?>border-top-1<?php } ?> border-bottom--1" style="background:#1a1d21;">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (1) */ ?>
                <?php echo eb_slider('1658993441'); ?>
            </div>
            <div class="main-section-basic-r dark-section-title">
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

<div class="shop-main-section-basic border-bottom-1" style="background:#1a1d21;">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (2) */ ?>
                <?php echo eb_slider('1659255375'); ?>
            </div>
            <div class="main-section-basic-r dark-section-title">
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
                        <h2><a href="<?php echo shop_type_url(1); ?>">🎲 <strong>랜덤 상품 <span>보기</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(1); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list(EYOOM_CORE_PATH.'/shop/list.premium.skin.php');
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

<div class="shop-main-section-basic border-bottom--1" style="background:#1a1d21;">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (4) */ ?>
                <?php echo eb_slider('1659312032'); ?>
            </div>
            <div class="main-section-basic-r dark-section-title">
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
                        <h2><a href="<?php echo shop_type_url(3); ?>">🆕 <strong>최신 상품 <span>보기</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(3); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list(EYOOM_CORE_PATH.'/shop/list.premium.skin.php');
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

<div class="shop-main-section-basic border-bottom-1" style="background:#1a1d21; border-top: 1px solid #30363d;">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (3) */ ?>
                <?php echo eb_slider('1659257180'); ?>
            </div>
            <div class="main-section-basic-r dark-section-title">
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
                        <h2><a href="<?php echo shop_type_url(2); ?>">💝 <strong>추천 상품 <span>보기</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(2); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list(EYOOM_CORE_PATH.'/shop/list.premium.skin.php');
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

<?php /* ---------- 이벤트박스 시작 ---------- */ ?>
<?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxevent.skin.html.php'); // 이벤트 ?>
<?php /* ---------- 이벤트박스 끝 ---------- */ ?>

<div class="shop-main-section-basic border-bottom-1" style="background:#1a1d21;">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB슬라이더 - shop020_main_5 (5) */ ?>
                <?php echo eb_slider('1659316824'); ?>
            </div>
            <div class="main-section-basic-r dark-section-title">
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
                        <h2><a href="<?php echo shop_type_url(4); ?>">🔥 <strong>인기 상품 <span>보기</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(4); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list(EYOOM_CORE_PATH.'/shop/list.premium.skin.php');
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



<?php if ($main_review == 'yes') { ?>
<div class="shop-main-section4">
    <div class="container">
        <style>
        /* 메인 리뷰 카드 스타일 (상담후기 스타일 계승) */
        .review-main {
            background: #f8fafc;
            border-radius: 0px;
            padding: 10px 20px;
            border: 1px solid #f1f5f9;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);
            margin-top: 20px;
        }
        .review-main-in.slick-slider { margin-left: 0 !important; }
        .review-main-in .slick-track { display: flex !important; }
        .review-main-in .slick-slide { height: inherit !important; display: flex !important; }
        .main-review-card {
            background: #fff;
            border: 1px solid #f1f3f5;
            border-radius: 20px;
            padding: 25px;
            margin: 0; /* 마진 제거 (패딩으로 대체) */
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            width: 100%;
            transition: all 0.3s ease;
            text-align: left;
        }
        .main-review-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .main-review-meta { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .main-review-profile { width: 45px; height: 45px; border-radius: 50%; overflow: hidden; background: #f8fafc; border: 1px solid #f1f3f5; flex-shrink: 0; }
        .main-review-profile img { width: 100%; height: 100%; object-fit: cover; }
        .main-review-profile .no-img { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 24px; }
        .main-review-user { display: flex; flex-direction: column; gap: 1px; }
        .main-review-name { font-size: 18px; font-weight: 700; color: #1e293b; letter-spacing: -0.5px; }
        .main-review-time { color: #94a3b8; font-size: 13px; font-weight: 400; }
        .main-review-stars { margin-left: auto; display: flex; gap: 2px; }
        .main-review-stars i { color: #ffc107; font-size: 16px; }
        .main-review-stars i.empty { color: #e9ecef; }
        .main-review-body { font-size: 14px; line-height: 1.6; color: #475569; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; min-height: 90px; margin-bottom: 15px; }
        .main-review-item-name { margin-top: auto; padding-top: 15px; font-size: 12px; color: #94a3b8; font-weight: 600; border-top: 1px solid #f8fafc; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        /* 슬라이더 내부 아이템 간격 확보 */
        .review-item { padding: 10px; box-sizing: border-box; }
        </style>
        <?php
        // 시간 경과 표시 함수 (중복 정의 방지)
        if (!function_exists('time_elapsed_string')) {
            function time_elapsed_string($datetime, $full = false) {
                $now = new DateTime;
                $ago = new DateTime($datetime);
                $diff = $now->diff($ago);
                $diff->w = floor($diff->d / 7);
                $diff->d -= $diff->w * 7;
                $string = array('y' => '년','m' => '개월','w' => '주','d' => '일','h' => '시간','i' => '분','s' => '초');
                foreach ($string as $k => &$v) {
                    if ($diff->$k) { $v = $diff->$k . $v; } else { unset($string[$k]); }
                }
                if (!$full) $string = array_slice($string, 0, 1);
                return $string ? implode(', ', $string) . ' 전' : '방금 전';
            }
        }

        // 이름 마스킹 함수 (예: 양수경 -> 양*경)
        if (!function_exists('get_masked_name')) {
            function get_masked_name($name) {
                $len = mb_strlen($name, 'UTF-8');
                if ($len <= 1) return $name;
                if ($len == 2) return mb_substr($name, 0, 1, 'UTF-8') . '*';
                return mb_substr($name, 0, 1, 'UTF-8') . str_repeat('*', $len - 2) . mb_substr($name, $len - 1, 1, 'UTF-8');
            }
        }

        $sql = " select a.is_id, a.is_subject, a.is_content, a.is_score, a.is_time, a.mb_id, a.is_name, a.it_id, b.it_name
                    from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
                    where a.is_confirm = '1'
                    order by a.is_time desc, a.is_id desc
                    limit 0,16 ";
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
            
            // 이름 마스킹 처리
            $masked_name = get_masked_name($row['is_name']);
            
            // 프로필 이미지 경로 확인
            $mb_id = $row['mb_id'];
            $profile_img = '';
            $is_profile = false;
            if ($mb_id) {
                $dir = substr($mb_id,0,2);
                if (is_file(G5_DATA_PATH.'/member_image/'.$dir.'/'.$mb_id.'.gif')) {
                    $profile_img = G5_DATA_URL.'/member_image/'.$dir.'/'.$mb_id.'.gif';
                    $is_profile = true;
                } else if (is_file(G5_DATA_PATH.'/member/'.$dir.'/'.$mb_id.'.gif')) {
                    $profile_img = G5_DATA_URL.'/member/'.$dir.'/'.$mb_id.'.gif';
                    $is_profile = true;
                }
            }
        ?>
            <div class="review-item">
                <a href="<?php echo $review_href; ?>" class="main-review-card">
                    <div class="main-review-meta">
                        <div class="main-review-profile">
                            <?php if ($is_profile) { ?>
                                <img src="<?php echo $profile_img; ?>?v=<?php echo time(); ?>" alt="profile">
                            <?php } else { ?>
                                <div class="no-img"><i class="fas fa-user-circle"></i></div>
                            <?php } ?>
                        </div>
                        <div class="main-review-user">
                            <span class="main-review-name"><?php echo $masked_name; ?></span>
                            <span class="main-review-time"><?php echo time_elapsed_string($row['is_time']); ?></span>
                        </div>
                        <div class="main-review-stars">
                            <?php 
                            for($s=1; $s<=5; $s++) {
                                $star_class = ($s <= (int)$row['is_score']) ? 'fas fa-star' : 'fas fa-star empty';
                                echo '<i class="'.$star_class.'"></i>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="main-review-body">
                        <?php echo cut_str(strip_tags($row['is_content']), 150); ?>
                    </div>
                    <div class="main-review-item-name">
                        <i class="fas fa-shopping-bag m-r-5"></i> <?php echo $row['it_name']; ?>
                    </div>
                </a>
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
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
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
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
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