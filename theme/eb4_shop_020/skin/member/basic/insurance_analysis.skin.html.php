<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/insurance_analysis.skin.html.php
 */
if (!defined('_GNUBOARD_')) exit;
?>

<style>
/* MDBootstrap Material Design Styles */
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
    max-width: 600px;
    overflow: visible;
    border: none;
    position: relative;
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

/* Material Input Style */
.register-form .input { 
    position: relative; 
    margin-bottom: 20px;
    display: flex !important;
    align-items: center;
    border: 1px solid #007bff !important;
    border-radius: 8px !important;
    height: 48px !important;
    background-color: #fff !important;
    transition: all 0.2s ease;
    box-sizing: border-box !important;
    padding: 0 !important;
}
.register-form .input input, .register-form .input select { 
    background-color: transparent !important;
    border: none !important;
    height: 100% !important;
    padding: 0 15px !important;
    font-size: 15px !important;
    width: 100%;
    outline: none !important;
    flex: 1;
    color: #1f2937;
}

/* Section Header */
.section-title {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin: 20px 0 15px 0;
    padding-bottom: 5px;
    border-bottom: 1px solid #eee;
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

/* Gender Selector Buttons */
.gender-selector {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
}
.gender-selector input[type="radio"] {
    display: none;
}
.gender-label {
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
.gender-selector input[type="radio"]:checked + .gender-label {
    background: #007bff;
    color: #fff;
    border-color: #007bff;
    font-weight: 500;
}

/* Checkbox Styles */
.checkbox-group { margin-bottom: 25px; }
.checkbox-container {
    display: block;
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 14px;
    color: #4b5563;
    user-select: none;
}
.checkbox-container input { position: absolute; opacity: 0; cursor: pointer; }
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #fff;
    border: 2px solid #007bff;
    border-radius: 4px;
}
.checkbox-container input:checked ~ .checkmark { background-color: #007bff; }
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}
.checkbox-container input:checked ~ .checkmark:after { display: block; }
.checkbox-container .checkmark:after {
    left: 5px;
    top: 1px;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.submit-btn {
    background: #007bff !important;
    color: #fff !important;
    height: 50px !important;
    border-radius: 8px !important;
    font-size: 17px !important;
    font-weight: 700 !important;
    width: 100%;
    border: none;
    cursor: pointer;
    margin-top: 20px !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}
.submit-btn:hover { background: #0069d9 !important; }

</style>

<div class="regform-wrapper">
    <div class="mdb-card">
        <div class="mdb-card-header">
            <h1 class="title"><i class="fas fa-search-plus m-r-10"></i>보험증권 분석</h1>
        </div>
        <div class="mdb-card-body">
            <div class="register-form">
                <form name="fanalysis" action="./counsel_update.php" method="post" class="eyoom-form">
                    
                    <div class="section-title">개인 정보 입력</div>
                    
                    <div class="input">
                        <input type="text" name="c_name" placeholder="이름" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="text" name="c_hp" placeholder="연락처" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="text" name="c_birth" placeholder="생년월일 (예: 19900101)" required maxlength="8">
                        <div class="required-dot"></div>
                    </div>

                    <div class="gender-selector">
                        <input type="radio" name="c_gender" id="gender_m" value="남성" required>
                        <label for="gender_m" class="gender-label">남성</label>
                        
                        <input type="radio" name="c_gender" id="gender_f" value="여성">
                        <label for="gender_f" class="gender-label" style="position:relative;">여성<div class="required-dot"></div></label>
                    </div>

                    <div class="section-title">상담 가능 시간</div>

                    <div class="row" style="margin-left:-5px; margin-right:-5px;">
                        <div class="col-6" style="padding:0 5px;">
                            <div class="input">
                                <select name="c_ampm" required>
                                    <option value="">상담시간구분(오전/오후)</option>
                                    <option value="오전">오전</option>
                                    <option value="오후">오후</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                        <div class="col-6" style="padding:0 5px;">
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

                    <div class="section-title" style="margin-top:10px; font-size:14px; color:#9ca3af;">정보 수신 동의</div>
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
                    </div>

                    <button type="submit" class="submit-btn">보험증권 분석 신청하기</button>
                </form>
            </div>
        </div>
    </div>
</div>
