<?php if (!defined('_EYOOM_')) exit; ?>

<style>
/* Absolute Image Sync for Countdown Style */
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
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    overflow: hidden;
    border: none;
}
.mdb-card-header {
    background-color: #007bff;
    padding: 22px;
    text-align: center;
}
.mdb-card-header .title {
    color: #fff;
    font-size: 22px;
    font-weight: 700;
    margin: 0;
}
.mdb-card-body {
    padding: 40px 50px;
}

/* Section Title */
.section-title {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 10px;
}

/* Material Input Style with Yellow Dot */
.register-form .input { 
    position: relative; 
    margin-bottom: 20px;
    display: flex !important;
    align-items: center;
    border: 1px solid #007bff !important;
    border-radius: 8px !important;
    height: 48px !important;
    background-color: #fff !important;
}
.register-form .input input, .register-form .input select { 
    background-color: transparent !important;
    border: none !important;
    height: 100% !important;
    padding: 0 18px !important;
    font-size: 15px !important;
    width: 100%;
    outline: none !important;
    color: #444;
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

/* Gender Selector */
.gender-selector { display: flex; gap: 10px; margin-bottom: 30px; }
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
    color: #666;
    font-size: 15px;
    font-weight: 500;
    transition: all 0.2s;
}
.gender-selector input[type="radio"] { display: none; }
.gender-selector input[type="radio"]:checked + .gender-label {
    background-color: #007bff;
    color: #fff;
}
.gender-label i { margin-right: 8px; }

/* Time Selector */
.time-row { display: flex; gap: 10px; margin-bottom: 30px; }
.time-col { flex: 1; }

/* Consent Section */
.agreement-section { margin-top: 30px; }
.agreement-section h5 { font-size: 14px; color: #999; margin-bottom: 15px; font-weight: 500; }

.checkbox-container {
    display: block;
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    color: #333;
    user-select: none;
}
.checkbox-container input { position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0; }
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #007bff;
    border-radius: 4px;
}
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
    left: 7px;
    top: 3px;
    width: 6px;
    height: 11px;
    border: solid white;
    border-width: 0 3px 3px 0;
    transform: rotate(45deg);
}
.checkbox-container input:checked ~ .checkmark:after { display: block; }

/* Submit Button */
.submit-btn {
    width: 100%;
    height: 55px;
    background-color: #007bff !important;
    color: #fff !important;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    margin-top: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.item-badge { background: #f8f9fa; border: 1px solid #e9ecef; padding: 12px 18px; border-radius: 10px; margin-bottom: 25px; }
.item-badge small { color: #888; font-size: 12px; display: block; margin-bottom: 2px; }
.item-badge strong { color: #007bff; font-size: 16px; font-weight: 600; }

@media (max-width: 767px) {
    .mdb-card-body { padding: 30px 20px; }
}
</style>

<div class="regform-wrapper">
    <div class="mdb-card">
        <div class="mdb-card-header">
            <h1 class="title"><i class="fas fa-stopwatch m-r-10"></i>상품별 보험 상담하기</h1>
        </div>
        <div class="mdb-card-body">
            <div class="register-form">
                <form name="fcounsel" id="fcounsel" action="<?php echo G5_URL; ?>/counsel_update.php" method="post" onsubmit="return fsubmit(this);">
                    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
                    <input type="hidden" name="subject" value="[상품상담] <?php echo $it_name; ?>">

                    <?php if ($it_name) { ?>
                    <div class="item-badge">
                        <strong><?php echo $it_brand; ?> <?php echo $it_name; ?></strong>
                    </div>
                    <?php } ?>

                    <div class="section-title">개인 정보 입력</div>

                    <div class="input">
                        <input type="text" name="mb_name" placeholder="이름" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="tel" name="mb_hp" placeholder="연락처 (숫자만 입력)" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="text" name="mb_birth" placeholder="생년월일 (8자리) 예: 19900101" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="gender-selector">
                        <input type="radio" name="mb_sex" id="male" value="M">
                        <label for="male" class="gender-label"><i class="fas fa-mars"></i> 남성</label>
                        <input type="radio" name="mb_sex" id="female" value="W">
                        <label for="female" class="gender-label" style="position:relative;"><i class="fas fa-venus"></i> 여성<div class="required-dot"></div></label>
                    </div>

                    <div class="section-title">상담 가능 시간</div>

                    <div class="time-row">
                        <div class="time-col">
                            <div class="input">
                                <select name="counsel_time_type">
                                    <option value="">상담시간구분(오전/오후)</option>
                                    <option value="오전">오전</option>
                                    <option value="오후">오후</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                        <div class="time-col">
                            <div class="input">
                                <select name="counsel_time_hour">
                                    <option value="">상담시간선택</option>
                                    <?php for($i=1; $i<=12; $i++) { $h = sprintf("%02d", $i); ?>
                                    <option value="<?php echo $h; ?>시"><?php echo $h; ?>시</option>
                                    <?php } ?>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                    </div>

                    <div class="agreement-section">
                        <h5>정보 수신 동의</h5>
                        
                        <label class="checkbox-container">
                            (필수) 개인정보 수집 및 활용 동의
                            <input type="checkbox" id="agree_priv" name="agree_priv" value="1" checked required>
                            <span class="checkmark"></span>
                        </label>

                        <label class="checkbox-container">
                            (선택) 카카오톡 핀토스 보험 채널 추가 동의
                            <input type="checkbox" id="agree_kakao" name="agree_kakao" value="1" checked>
                            <span class="checkmark"></span>
                        </label>

                        <label class="checkbox-container">
                            (선택) 이메일, 문자메시지 핀토스 수신 동의
                            <input type="checkbox" id="agree_marketing" name="agree_marketing" value="1" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <button type="submit" class="submit-btn">상담 신청하기</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function fsubmit(f) {
    return true;
}
</script>
