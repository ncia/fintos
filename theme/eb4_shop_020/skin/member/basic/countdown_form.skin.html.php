<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/counsel_form.skin.html.php
 */
if (!defined('_GNUBOARD_')) exit;
?>

<style>
/* MDBootstrap Material Design Styles - Refined for Image Match */
.regform-wrapper {
    background: url('<?php echo EYOOM_THEME_URL; ?>/image/insurance_contract_bg.png') no-repeat center center;
    background-size: cover;
    padding: 80px 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Noto Sans KR', sans-serif;
}
.mdb-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
    width: 100%;
    max-width: 800px;
    overflow: visible;
    border: none;
    position: relative;
    z-index: 10;
    pointer-events: auto !important;
}
.mdb-card-header {
    background-color: #007bff;
    padding: 20px;
    text-align: center;
    border-radius: 12px 12px 0 0;
}
.mdb-card-header .title {
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
    letter-spacing: -0.5px;
}
.mdb-card-body {
    padding: 40px 50px;
}
@media (max-width: 767px) {
    .mdb-card-body { padding: 30px 20px; }
    .regform-wrapper { padding: 20px 10px; }
}

/* Material Input Style - Outlined with Blue Focus */
.register-form .input { 
    position: relative; 
    margin-bottom: 25px;
    display: flex !important;
    align-items: center;
    border: 1px solid #007bff !important;
    border-radius: 8px !important;
    height: 45px !important;
    background-color: #fff !important;
    transition: all 0.2s ease;
    box-sizing: border-box !important;
    padding: 0 !important;
}
.register-form .input input, .register-form .input select { 
    background-color: transparent !important;
    border: none !important;
    height: 100% !important;
    padding: 0 20px !important;
    font-size: 15px !important;
    width: 100%;
    outline: none !important;
    flex: 1;
    color: #1f2937;
    pointer-events: auto !important;
    position: relative;
    z-index: 11;
}

/* Gender Buttons Style */
.gender-selector {
    display: flex;
    gap: 12px;
    margin-bottom: 25px;
}
.gender-selector input[type="radio"] {
    display: none;
}
.gender-label {
    flex: 1;
    border: 1px solid #007bff;
    border-radius: 8px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: #fff;
    color: #9ca3af;
    font-size: 15px;
    transition: all 0.2s;
}
.gender-selector input[type="radio"]:checked + .gender-label {
    background: #007bff;
    color: #fff;
    border-color: #007bff;
    font-weight: 500;
}
.gender-label i { 
    margin-right: 10px; 
    font-size: 18px;
}
.required-dot {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 8px;
    height: 8px;
    background-color: #ffd600;
    border-radius: 50%;
    z-index: 5;
}


/* Section Header */
.section-title {
    font-size: 17px;
    font-weight: 700;
    color: #333;
    margin: 10px 0 20px 0;
    padding-bottom: 8px;
    border-bottom: 1px solid #eee;
}

/* Labels above inputs for specific cases */
.field-label {
    font-size: 13px;
    font-weight: 500;
    color: #9ca3af;
    margin-bottom: 10px;
    display: block;
    margin-left: 5px;
}

/* Checkbox Styles */
.checkbox-group { margin-bottom: 25px; }
.checkbox-container {
    display: block;
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    color: #4b5563;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}
.checkmark {
    position: absolute;
    top: 2px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #fff;
    border: 2px solid #007bff;
    border-radius: 4px;
}
.checkbox-container:hover input ~ .checkmark {
    background-color: #f3f4f6;
}
.checkbox-container input:checked ~ .checkmark {
    background-color: #007bff;
}
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}
.checkbox-container input:checked ~ .checkmark:after {
    display: block;
}
.checkbox-container .checkmark:after {
    left: 6px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.submit-btn {
    background: #007bff !important;
    color: #fff !important;
    height: 45px !important;
    border-radius: 8px !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    width: 100%;
    border: none;
    cursor: pointer;
    margin-top: 20px !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}
.submit-btn:hover {
    background: #0069d9 !important;
}
</style>

<div class="regform-wrapper">
    <div class="mdb-card">
        <div class="mdb-card-header">
            <h1 class="title"><i class="fas fa-stopwatch"></i> 카운트다운 상담 신청</h1>
        </div>
        <div class="mdb-card-body">
            <div class="register-form">
                <form name="fcounsel" action="./counsel_update.php" method="post" class="eyoom-form">
                    <input type="hidden" name="source" value="카운트다운">
                    
                    <div class="section-title">개인 정보 입력</div>
                    
                    <div class="input">
                        <input type="text" name="c_name" placeholder="이름" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="text" name="c_hp" placeholder="연락처 (숫자만 입력)" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="text" name="c_birth" placeholder="생년월일 (8자리) 예: 19900101" maxlength="8">
                        <div class="required-dot"></div>
                    </div>

                    <div class="gender-selector">
                        <input type="radio" name="c_sex" id="sex_m" value="M">
                        <label for="sex_m" class="gender-label"><i class="fas fa-mars"></i> 남성</label>
                        
                        <input type="radio" name="c_sex" id="sex_f" value="F">
                        <label for="sex_f" class="gender-label" style="position:relative;"><i class="fas fa-venus"></i> 여성<div class="required-dot"></div></label>
                    </div>

                    <div class="section-title">상담 가능 시간</div>

                    <div class="row" style="margin-left:-5px; margin-right:-5px;">
                        <div class="col-12 ampm-col" style="padding:0 5px;">
                            <div class="input">
                                <select name="c_ampm" required onchange="toggle_time_hour(this);">
                                    <option value="">상담시간구분(오전/오후)</option>
                                    <option value="종일">종일</option>
                                    <option value="오전">오전</option>
                                    <option value="오후">오후</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                        <div class="col-6 counsel-hour-col" style="padding:0 5px; display:none;">
                            <div class="input">
                                <select name="c_time" required>
                                    <option value="">상담시간선택</option>
                                    <?php for($i=1; $i<=12; $i++) { 
                                        $t = sprintf("%02d", $i);
                                    ?>
                                    <option value="<?php echo $t; ?>시"><?php echo $t; ?>시</option>
                                    <?php } ?>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                    </div>

                    <div class="field-label">정보 수신 동의</div>
                    <div class="checkbox-group">
                        <label class="checkbox-container">
                            <input type="checkbox" name="c_agree" value="1" id="c_agree" required checked>
                            <span class="checkmark"></span>
                            (필수) 개인정보 수집 및 활용 동의
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" name="c_kakaotalk" value="1" id="c_kakaotalk" checked>
                            <span class="checkmark"></span>
                            (선택) 카카오톡 핀토스 보험 채널 수신 동의
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" name="c_mailling" value="1" id="c_mailling" checked>
                            <span class="checkmark"></span>
                            (선택) 이메일, 문자메시지 핀토스 수신 동의
                        </label>
                    <button type="submit" class="submit-btn">상담 신청하기</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggle_time_hour(el) {
    var $row = $(el).closest('.row, .time-row');
    var $ampmCol = $row.find('.ampm-col');
    var $hourCol = $row.find('.counsel-hour-col');
    if (el.value === '오전' || el.value === '오후') {
        $ampmCol.removeClass('col-12').addClass('col-6');
        $hourCol.show();
    } else {
        $ampmCol.removeClass('col-6').addClass('col-12');
        $hourCol.hide();
    }
}
</script>
