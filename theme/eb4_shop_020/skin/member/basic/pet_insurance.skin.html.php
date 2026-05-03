<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/pet_insurance.skin.html.php
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

/* Custom File Input */
.file-input-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}
.file-input-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    cursor: pointer;
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

/* Labels */
.field-label {
    font-size: 13px;
    font-weight: 500;
    color: #9ca3af;
    margin-bottom: 8px;
    display: block;
    margin-left: 5px;
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

/* Profile/Pet Image Styles */
.profile-img-wrapper {
    text-align: center;
    margin: 20px 0 30px;
}
.profile-img-container {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 15px;
    border: 3px solid #007bff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
.profile-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.profile-img-container i {
    font-size: 50px;
    color: #dee2e6;
}
.profile-img-btns {
    display: flex;
    justify-content: center;
    gap: 10px;
}
.btn-img-change {
    background: #007bff !important;
    color: #fff !important;
    padding: 8px 18px !important;
    border-radius: 8px !important;
    cursor: pointer;
    font-size: 13px !important;
    font-weight: 700 !important;
    border: none;
    display: inline-block;
}
.btn-img-delete {
    background: #f1f3f5 !important;
    color: #495057 !important;
    padding: 8px 18px !important;
    border-radius: 8px !important;
    cursor: pointer;
    font-size: 13px !important;
    font-weight: 700 !important;
    border: none;
    display: inline-block;
}

/* Gender/Pet Type Selector Buttons */
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
.gender-label i { 
    margin-right: 10px; 
    font-size: 18px;
}

</style>

<div class="regform-wrapper">
    <div class="mdb-card">
        <div class="mdb-card-header">
            <h1 class="title"><i class="fas fa-paw"></i> 펫보험 상담 신청</h1>
        </div>
        <div class="mdb-card-body">
            <div class="register-form">
                <form name="fpet" action="./counsel_update.php" method="post" enctype="multipart/form-data" class="eyoom-form">
                    
                    <div class="section-title">보호자 정보</div>
                    
                    <div class="input">
                        <input type="text" name="c_name" placeholder="보호자 이름" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="text" name="c_hp" placeholder="보호자 연락처" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="section-title">반려동물 정보</div>

                    <div class="gender-selector">
                        <input type="radio" name="c_pet_type" id="pet_dog" value="강아지" required>
                        <label for="pet_dog" class="gender-label"><i class="fas fa-dog"></i> 강아지</label>
                        
                        <input type="radio" name="c_pet_type" id="pet_cat" value="고양이">
                        <label for="pet_cat" class="gender-label" style="position:relative;"><i class="fas fa-cat"></i> 고양이<div class="required-dot"></div></label>
                    </div>

                    <div class="input">
                        <input type="text" name="c_pet_name" placeholder="반려동물 이름" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="field-label">반려동물 사진 (선택)</div>
                    <div class="profile-img-wrapper">
                        <div class="profile-img-container" id="pet-img-preview">
                            <i class="fas fa-paw"></i>
                        </div>
                        <div class="profile-img-btns">
                            <label for="c_pet_photo" class="btn-img-change">이미지 변경</label>
                            <input type="file" name="c_pet_photo" id="c_pet_photo" style="display:none;" onchange="previewPetImage(this)">
                            <button type="button" class="btn-img-delete" onclick="deletePetImage()">이미지 삭제</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="input">
                                <input type="text" name="c_pet_breed" placeholder="반려동물 품종" required>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:-5px; margin-right:-5px;">
                        <div class="col-6" style="padding:0 5px;">
                            <div class="input">
                                <select name="c_pet_age_year" required>
                                    <option value="">년 선택</option>
                                    <?php for($i=0; $i<=25; $i++) { ?>
                                    <option value="<?php echo $i; ?>년"><?php echo $i; ?>년</option>
                                    <?php } ?>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                        <div class="col-6" style="padding:0 5px;">
                            <div class="input">
                                <select name="c_pet_age_month" required>
                                    <option value="">월 선택</option>
                                    <?php for($i=1; $i<=12; $i++) { ?>
                                    <option value="<?php echo $i; ?>개월"><?php echo $i; ?>개월</option>
                                    <?php } ?>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                    </div>

                    <div class="gender-selector">
                        <input type="radio" name="c_pet_gender" id="pet_sex_m" value="남아" required>
                        <label for="pet_sex_m" class="gender-label"><i class="fas fa-mars"></i> 남아</label>
                        
                        <input type="radio" name="c_pet_gender" id="pet_sex_f" value="여아">
                        <label for="pet_sex_f" class="gender-label" style="position:relative;"><i class="fas fa-venus"></i> 여아<div class="required-dot"></div></label>
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
                    </div>

                    <button type="submit" class="submit-btn">펫보험 상담 신청하기</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewPetImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var container = document.getElementById('pet-img-preview');
            container.innerHTML = '<img src="' + e.target.result + '" alt="반려동물 사진 미리보기">';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function deletePetImage() {
    var input = document.getElementById('c_pet_photo');
    var container = document.getElementById('pet-img-preview');
    
    input.value = ""; // 파일 입력 초기화
    container.innerHTML = '<i class="fas fa-paw"></i>'; // 기본 아이콘으로 복구
}
</script>
