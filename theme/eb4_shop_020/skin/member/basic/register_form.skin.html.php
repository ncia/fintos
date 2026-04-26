<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register_form.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>', 0);
if ($config['cf_cert_use'] && ($config['cf_cert_simple'] || $config['cf_cert_ipin'] || $config['cf_cert_hp']))
    add_javascript('<script src="'.G5_JS_URL.'/certify.js?v='.G5_JS_VER.'"></script>', 0);
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
    max-width: 700px;
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

/* Material Input Style - Outlined with Blue Focus */
.register-form .input { 
    position: relative; 
    margin-top: 0;
    margin-bottom: 25px; /* Increased gap between rows */
    display: flex !important;
    align-items: center; /* Changed from stretch to center for perfect alignment */
    border: 1px solid #007bff !important; /* Changed from #bfdbfe to #007bff */
    border-radius: 8px !important;
    height: 45px !important; /* Reduced from 48px */
    background-color: #fff !important;
    transition: all 0.2s ease;
    box-sizing: border-box !important;
    padding: 0 !important;
}
.register-form .input:focus-within {
    border: 1px solid #3b82f6 !important; /* Focus blue */
    box-shadow: 0 0 0 1px #3b82f6;
}
.required-dot {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 8px;
    height: 8px;
    background-color: #ffd600; /* Bright yellow dot */
    border-radius: 50%;
    z-index: 5;
}
.register-form .input input { 
    background-color: transparent !important;
    border: none !important;
    height: 100% !important;
    padding: 0 20px !important;
    font-size: 15px !important;
    width: 100%;
    outline: none !important;
    flex: 1;
    color: #1f2937;
}

/* Duplication Check Button - Blue Style */
.register-form .input-button .button { 
    background: #007bff !important;
    color: #fff !important;
    height: 35px !important; /* Increased slightly from 33px */
    padding: 0 15px;
    border: none !important;
    border-radius: 6px !important;
    font-size: 13px;
    font-weight: 500;
    margin: -1px 3.9px 0 0 !important; /* Fine-tuned right margin */
    position: relative !important;
    transition: all 0.3s ease;
    white-space: nowrap;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}
.register-form .input-button .button:hover {
    background: #0069d9 !important;
}
.register-form .input-button .button input { display: none; }

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
    border: 1px solid #007bff; /* Changed from #bfdbfe to #007bff */
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
.gender-label i { margin-right: 8px; }

/* Section Header */
.section-title {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin: 20px 0 20px 0; /* Reduced from 25px to 20px */
    padding-bottom: 8px; /* Reduced from 12px to 8px */
    border-bottom: 1px solid #dddddd; /* Light gray */
}

/* Labels above inputs for specific cases */
.field-label {
    font-size: 14px;
    font-weight: 500;
    color: #4b5563;
    margin-bottom: 8px;
    display: block;
}

/* Password Visibility Toggle */
.pass-toggle {
    display: flex;
    align-items: center;
    padding-right: 15px;
    color: #9ca3af;
    cursor: pointer;
    font-size: 18px; /* Added mid-size font */
}

/* Address Search Button */
.address-search-btn {
    background: #007bff !important;
    color: #fff !important;
    height: 45px !important;
    border-radius: 8px !important;
    font-size: 15px !important;
    font-weight: 500 !important;
    width: 100%;
    border: none !important;
}

/* Bottom Actions */
.form-footer {
    margin-top: 0; /* Let previous input's margin-bottom handle the gap */
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.submit-btn {
    background: #007bff !important;
    color: #fff !important;
    height: 45px !important; /* Unified with other buttons */
    border-radius: 8px !important;
    font-size: 15px !important; /* Unified with other buttons */
    font-weight: 700 !important;
    width: 100%;
    border: none;
    cursor: pointer;
}

.field-label {
    font-size: 13px;
    font-weight: 500;
    color: #9ca3af; /* Lighter gray for labels */
    margin-bottom: 8px;
    display: block;
}
.register-box, .eyoom-form fieldset { background: transparent !important; border: none !important; padding: 0 !important; }

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
.field-note {
    font-size: 13px;
    color: #6b7280;
    margin-top: 4px;
    line-height: 1.5;
}

/* Captcha Styling */
.captcha-container { margin-bottom: 25px; }
#captcha { border: none !important; padding: 0 !important; margin: 0 !important; }
#captcha legend { display: none; }
#captcha_img { 
    height: 45px !important; 
    border: 1px solid #007bff !important; 
    border-radius: 8px !important; 
    margin-right: 8px;
    vertical-align: top;
}
#captcha_key {
    height: 45px !important;
    border: 1px solid #007bff !important;
    border-radius: 8px !important;
    padding: 0 12px;
    width: 120px;
    font-size: 16px;
    vertical-align: top;
    outline: none;
}
#captcha_mp3, #captcha_reload {
    height: 45px;
    width: 45px;
    background: #1f2937 !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    margin-left: 4px;
    cursor: pointer;
}


/* Status message colors */
#msg_mb_id, #msg_mb_nick, #msg_mb_email {
    display: block;
    font-size: 12px;
    margin-top: -15px;
    margin-bottom: 15px;
    padding-left: 5px;
}
.msg_error { color: #ef4444; }
.msg_success { color: #10b981; }
</style>

<script src="<?php echo EYOOM_THEME_URL; ?>/js/zxcvbn.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/js/jquery.password.strength.js"></script>

<div class="regform-wrapper">
    <div class="mdb-card">
        <div class="mdb-card-header">
            <h1 class="title"><?php echo $w=='' ? '회원가입 정보입력' : '회원정보 수정'; ?></h1>
        </div>
        <div class="mdb-card-body">
            <div class="register-form">

    <form name="fregisterform" action="<?php echo $register_action_url; ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode; ?>">
    <input type="hidden" name="agree" value="<?php echo $agree; ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2; ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex']) && $w != '') { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex']; ?>"><?php } ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick']; ?>">
    <input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick']; ?>">
    <?php } ?>
    <input type="hidden" name="product_title" value="<?php echo isset($_GET['it_name']) ? clean_xss_tags($_GET['it_name']) : ''; ?>">
    <input type="hidden" name="mb_nick" id="reg_mb_nick" value="<?php echo isset($member['mb_nick']) ? trim(get_text($member['mb_nick'])) : ''; ?>">
    <input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick']) ? trim(get_text($member['mb_nick'])) : ''; ?>">
    <input type="hidden" name="mb_nick_duplicated" id="mb_nick_duplicated" value="y">
    <div class="register-box">
        <div class="section-title" style="margin-top:0;">로그인정보 입력</div>
            <!-- ID Field (Row 1) -->
            <div class="row">
                <section class="col-lg-12">
                    <div class="input input-button">
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id']; ?>" id="reg_mb_id" <?php if ($w!='') { ?>required readonly<?php } ?> minlength="3" maxlength="20" placeholder="아이디">
                        <div class="required-dot"></div>
                        <?php if ($w=='') { ?>
                        <div class="button" onclick="check_duplication('mb_id');">중복 확인</div>
                        <?php } ?>
                        <?php if ($w=='') { ?><input type="hidden" name="mb_id_duplicated" id="mb_id_duplicated"><?php } ?>
                    </div>
                </section>
            </div>

            <!-- Email Field (Row 2) -->
            <div class="row">
                <section class="col-lg-12">
                    <div class="input input-button">
                        <input type="text" name="mb_email" value="<?php echo isset($member['mb_email']) ? trim(get_text($member['mb_email'])) : ''; ?>" id="reg_mb_email" required maxlength="100" placeholder="이메일">
                        <div class="required-dot"></div>
                        <input type="hidden" name="old_email" value="<?php echo isset($member['mb_email']) ? trim(get_text($member['mb_email'])) : ''; ?>">
                        <?php if ($w=='') { ?>
                        <div class="button" onclick="check_duplication('mb_email');">중복 확인</div>
                        <?php } ?>
                        <?php if ($w=='') { ?><input type="hidden" name="mb_email_duplicated" id="mb_email_duplicated"><?php } ?>
                    </div>
                </section>
            </div>

            <!-- Password Fields (Row 3) -->
            <div class="row" style="margin-left:-8px; margin-right:-8px;">
                <section class="col-6" style="padding-left:8px; padding-right:8px;">
                    <div class="input">
                        <input type="password" name="mb_password" id="reg_mb_password" <?php if ($w!='') { ?>required<?php } ?> minlength="4" maxlength="20" placeholder="비밀번호">
                        <div class="required-dot"></div>
                        <div class="pass-toggle" onclick="toggle_pass('reg_mb_password', this)"><i class="far fa-eye"></i></div>
                    </div>
                </section>
                <section class="col-6" style="padding-left:8px; padding-right:8px;">
                    <div class="input">
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" <?php if ($w!='') { ?>required<?php } ?> minlength="4" maxlength="20" placeholder="비밀번호 확인">
                        <div class="required-dot"></div>
                        <div class="pass-toggle" onclick="toggle_pass('reg_mb_password_re', this)"><i class="far fa-eye"></i></div>
                    </div>
                </section>
                <div class="col-12" id="pass_meter_container" style="display:none; padding-left:8px; padding-right:8px;">
                    <div id="pass_meter">
                        <div class="progress progress-e progress-xxs" style="height:4px; margin-top:-10px; margin-bottom:15px; background:#f3f4f6; border-radius:2px;">
                            <div class="progress-bar progress-bar-e" style="height:100%; width:0%; transition:all 0.3s;"></div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="section-title">개인정보 입력</div>

            <!-- Name Field -->
            <div class="row">
                <section class="col-lg-12">
                    <div class="input">
                        <input type="text" name="mb_name" id="reg_mb_name" value="<?php echo $member['mb_name']; ?>" <?php if ($w!='') { ?>required readonly<?php } ?> placeholder="이름">
                        <div class="required-dot"></div>
                    </div>
                </section>
            </div>

            <!-- Birth Date Field -->
            <div class="row">
                <section class="col-lg-12">
                    <div class="input">
                        <input type="text" name="mb_birth" id="reg_mb_birth" value="<?php echo $member['mb_birth']; ?>" maxlength="8" placeholder="생년월일(8자리) 예: 19900101">
                        <div class="required-dot"></div>
                    </div>
                </section>
            </div>

            <!-- Gender Field -->
            <div class="gender-selector">
                <input type="radio" name="mb_sex" id="sex_m" value="M" <?php echo $member['mb_sex']=='M'?'checked':''; ?>>
                <label for="sex_m" class="gender-label"><i class="fas fa-mars"></i> 남성</label>
                
                <input type="radio" name="mb_sex" id="sex_f" value="F" <?php echo $member['mb_sex']=='F'?'checked':''; ?>>
                <label for="sex_f" class="gender-label" style="position:relative;"><i class="fas fa-venus"></i> 여성<div class="required-dot"></div></label>
            </div>

            <!-- Phone Field -->
            <div class="row">
                <section class="col-lg-12">
                    <div class="input">
                        <input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']); ?>" id="reg_mb_hp" maxlength="20" placeholder="연락처 숫자만 입력해주세요">
                        <div class="required-dot"></div>
                    </div>
                </section>
            </div>

            <!-- Address Section -->
            <div class="row" style="margin-left:-8px; margin-right:-8px;">
                <div class="col-6" style="padding-left:8px; padding-right:8px;">
                    <div class="input" style="border: 1px solid #007bff !important;">
                        <input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" size="5" maxlength="6" placeholder="우편번호">
                    </div>
                </div>
                <div class="col-6" style="padding-left:8px; padding-right:8px; position:relative;">
                    <button type="button" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');" class="btn-e address-search-btn">주소 검색</button>
                    <div class="required-dot" style="top:5px; right:12px;"></div>
                </div>
            </div>
            <div class="row" style="margin-left:-8px; margin-right:-8px;">
                <div class="col-12" style="position:relative; padding-left:8px; padding-right:8px;">
                    <div class="input">
                        <input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']); ?>" id="reg_mb_addr1" placeholder="기본주소">
                    </div>
                    <!-- Postcode Layer -->
                    <div id="postcode_layer" style="display:none;position:absolute;top:0;left:8px;width:calc(100% - 16px);height:500px;z-index:100;background:#fff;border:1px solid #007bff;border-radius:8px;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);">
                        <div style="position:relative;width:100%;height:100%;display:flex;flex-direction:column;">
                            <!-- Header for close button to prevent overlapping with Kakao UI -->
                            <div style="height:35px; background:#f8fafc; border-bottom:1px solid #e2e8f0; display:flex; align-items:center; justify-content:flex-end; padding:0 12px;">
                                <div style="cursor:pointer; font-size:14px; color:#4b5563; font-weight:500;" onclick="closeDaumPostcode()">
                                    <i class="fas fa-times" style="margin-right:4px;"></i> 닫기
                                </div>
                            </div>
                            <div id="postcode_embed" style="width:100%; flex:1;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input">
                        <input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']); ?>" id="reg_mb_addr2" placeholder="상세주소">
                    </div>
                </div>
            </div>
            <input type="hidden" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']); ?>" id="reg_mb_addr3">
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $member['mb_addr_jibeon']; ?>">

            <div class="section-title">기타 개인설정</div>

            <!-- Mailing Service -->
            <div class="field-label" style="margin-left:5px;">메일링서비스</div>
            <div class="checkbox-group">
                <label class="checkbox-container">
                    <input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling']) ? 'checked' : ''; ?>>
                    <span class="checkmark"></span>
                    정보 메일을 받겠습니다.
                </label>
            </div>

            <!-- Info Disclosure -->
            <div class="field-label" style="margin-left:5px;">정보공개</div>
            <div class="checkbox-group">
                <label class="checkbox-container">
                    <input type="checkbox" name="mb_open" value="1" <?php if ($w=='' || $member['mb_open']) { ?>checked<?php } ?> id="reg_mb_open">
                    <span class="checkmark"></span>
                    다른분들이 나의 정보를 볼 수 있도록 합니다.
                </label>
                <div class="field-note">Note: 정보공개를 바꾸시면 앞으로 <?php echo (int) $config['cf_open_modify']; ?>일 이내에는 변경이 안됩니다.</div>
            </div>

            <!-- Captcha Section -->
            <div class="field-label" style="margin-left:5px;">자동등록방지</div>
            <div class="captcha-container">
                <?php echo captcha_html(); ?>
                <div class="field-note">자동등록방지 숫자를 순서대로 입력하세요.</div>
            </div>

        <div class="form-footer">
            <button type="submit" id="btn_submit" class="submit-btn"><?php echo $w=='' ? '회원가입' : '정보수정'; ?></button>
            <?php if ($w=='u') { ?>
            <button type="button" class="btn-e btn-e-lg btn-e-gray" style="width:100%; background:#f3f4f6; border:none; height:50px; border-radius:8px; color:#6b7280; margin-top:10px;" onclick="member_leave();">회원탈퇴</button>
            <?php } ?>
        </div>
    </div>
    </form>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(function() {
    $("#reg_zip_find").css("display", "inline-block");
    var pageTypeParam = "pageType=register";

	<?php if($config['cf_cert_use'] && $config['cf_cert_simple']) { ?>
	// 이니시스 간편인증
	var url = "<?php echo G5_INICERT_URL; ?>/ini_request.php";
	var type = "";    
    var params = "";
    var request_url = "";

	$(".win_sa_cert").click(function() {
        if(!cert_confirm()) return false;
        type = $(this).data("type");
        params = "?directAgency=" + type + "&" + pageTypeParam;
        request_url = url + params;
        call_sa(request_url);
    });
    <?php } ?>

    <?php if ($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
    // 아이핀인증
    var params = "";
    $("#win_ipin_cert").click(function() {
        if(!cert_confirm()) return false;
        params = "?" + pageTypeParam;
        var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php"+params;
        certify_win_open('kcb-ipin', url);
        return;
    });
    <?php } ?>

    <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
    // 휴대폰인증
    var params = "";
    $("#win_hp_cert").click(function() {
        if(!cert_confirm()) return false;
        params = "?" + pageTypeParam;
        <?php     
        switch($config['cf_cert_hp']) {
            case 'kcb':                    
                $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                $cert_type = 'kcb-hp';
                break;
            case 'kcp':
                $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                $cert_type = 'kcp-hp';
                break;
            case 'lg':
                $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                $cert_type = 'lg-hp';
                break;
            default:
                echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                echo 'return false;';
                break;
        }
        ?>            
        certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>"+params);
        return;
    });
    <?php } ?>
});

// 인증체크
function cert_confirm()
{
    var val = document.fregisterform.cert_type.value;
    var type;

    switch(val) {
        case "simple":
            type = "간편인증";
            break;
        case "ipin":
            type = "아이핀";
            break;
        case "hp":
            type = "휴대폰";
            break;
        default:
            return true;
    }

    if(confirm("이미 "+type+"으로 본인확인을 완료하셨습니다.\n\n이전 인증을 취소하고 다시 인증하시겠습니까?"))
        return true;
    else
        return false;
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
    // 회원아이디 검사
    if (f.w.value == "") {
        var msg = reg_mb_id_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.mb_id.select();
            return false;
        }
    }
    <?php if ($w=='') { ?>
    if (f.mb_id_duplicated.value != 'y') {
        Swal.fire({
            title: "중요!",
            text: "아이디 중복검사를 하셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.mb_id.select();
        return false;
    }
    <?php } ?>

    if (f.w.value == "") {
        if (f.mb_password.value.length < 4) {
            Swal.fire({
                title: "중요!",
                text: "비밀번호를 4글자 이상 입력하십시오.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        Swal.fire({
            title: "중요!",
            text: "비밀번호가 같지 않습니다.",
            confirmButtonColor: "#ab0000",
            type: "error",
            confirmButtonText: "확인"
        });
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 4) {
            Swal.fire({
                title: "중요!",
                text: "비밀번호를 4글자 이상 입력하십시오.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.mb_password_re.focus();
            return false;
        }
    }

    // 비밀번호 강도체크
    var pass_strength = $("#pass_meter").attr("class");
    if (!pass_strength || pass_strength == 'security_0' || pass_strength == 'security_1') {
        Swal.fire({
            title: "중요!",
            text: "비밀번호의 강도는 '보통' 이상이여야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.mb_password.focus();
        return false;
    }

    // 이름 검사
    if (f.w.value=="") {
        if (f.mb_name.value.length < 1) {
            Swal.fire({
                title: "중요!",
                text: "이름을 입력하십시오.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.mb_name.focus();
            return false;
        }

        /*
        var pattern = /([^가-힣\x20])/i;
        if (pattern.test(f.mb_name.value)) {
            swal({
                title: "중요!",
                text: "이름은 한글로 입력하십시오.",
                confirmButtonColor: "#FDAB29",
                type: "warning",
                confirmButtonText: "확인"
            });
            f.mb_name.select();
            return false;
        }
        */
    }

    <?php if ($w=='' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
    // 본인확인 체크
    if (f.cert_no.value=="") {
        Swal.fire({
            title: "중요!",
            text: "회원가입을 위해서는 본인확인을 해주셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        return false;
    }
    <?php } ?>

    // 닉네임 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
        var msg = reg_mb_nick_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.reg_mb_nick.select();
            return false;
        }
    }
    <?php if ($w=='') { ?>
    if (f.mb_nick_duplicated.value != 'y') {
        Swal.fire({
            title: "중요!",
            text: "닉네임 중복검사를 하셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.reg_mb_nick.select();
        return false;
    }
    <?php } ?>


    // E-mail 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        var msg = reg_mb_email_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.reg_mb_email.select();
            return false;
        }
    }

    <?php if ($w=='') { ?>
    if (f.mb_email_duplicated.value != 'y') {
        Swal.fire({
            title: "중요!",
            text: "이메일 중복검사를 하셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.reg_mb_email.select();
        return false;
    }
    <?php } ?>

    <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) { ?>
    // 휴대폰번호 체크
    var msg = reg_mb_hp_check();
    if (msg) {
        Swal.fire({
            title: "중요!",
            text: msg,
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.reg_mb_hp.select();
        return false;
    }
    <?php } ?>

    if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
        if (f.mb_id.value == f.mb_recommend.value) {
            Swal.fire({
                title: "중요!",
                text: "본인을 추천할 수 없습니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.mb_recommend.focus();
            return false;
        }

        var msg = reg_mb_recommend_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.mb_recommend.select();
            return false;
        }
    }

    <?php chk_captcha_js(); ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function check_duplication(target) {
    switch(target) {
        case 'mb_id':
            var mb_id = $('#reg_mb_id').val();
            if (!mb_id) {
                alert('아이디를 입력해 주세요.');
                return false;
            }
            var msg = reg_mb_id_check();
            if (msg) {
                Swal.fire({
                    title: "중요!",
                    text: msg,
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_id").focus();
                $("#reg_mb_id").select();
                return false;
            } else {
                Swal.fire({
                    title: "OK!",
                    text: "사용가능한 아이디입니다.",
                    confirmButtonColor: "#00897b",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_id").attr('readonly','true');
                $("#mb_id_duplicated").val('y');
                $("#reg_mb_id").css('background','#f5f5f5');
            }
            break;
        case 'mb_nick':
            var mb_nick = $('#reg_mb_nick').val();
            if (!mb_nick) {
                alert('닉네임을 입력해 주세요.');
                return false;
            }
            var msg = reg_mb_nick_check();
            if (msg) {
                Swal.fire({
                    title: "중요!",
                    text: msg,
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_nick").focus();
                $("#reg_mb_nick").select();
                return false;
            } else {
                Swal.fire({
                    title: "OK!",
                    text: "사용가능한 닉네임입니다.",
                    confirmButtonColor: "#00897b",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_nick").attr('readonly','true');
                $("#mb_nick_duplicated").val('y');
                $("#reg_mb_nick").css('background','#f5f5f5');
            }
            break;
        case 'mb_email':
            var mb_email = $('#reg_mb_email').val();
            if (!mb_email) {
                alert('이메일을 입력해 주세요.');
                return false;
            }
            var msg = reg_mb_email_check();
            if (msg) {
                Swal.fire({
                    title: "중요!",
                    text: msg,
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_email").focus();
                $("#reg_mb_email").select();
                return false;
            } else {
                Swal.fire({
                    title: "OK!",
                    text: "사용가능한 이메일입니다.",
                    confirmButtonColor: "#00897b",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_email").attr('readonly','true');
                $("#mb_email_duplicated").val('y');
                $("#reg_mb_email").css('background','#f5f5f5');
            }
            break;
    }
}
<?php if ($w=='u') { ?>
function member_leave() {  // 회원 탈퇴 tto
    Swal.fire({
        title: "중요!",
        html: "<div class='alert alert-warning'>회원 탈퇴를 하시면 모든 포인트와 경험치가 삭제되며, 복구할 수 없습니다.</div><span>정말로 회원 탈퇴를 하시겠습니까?</span>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ab0000",
        confirmButtonText: "탈퇴",
        cancelButtonText: "취소"
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = '<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php';
        }
    });
}
<?php } ?>

function toggle_pass(id, el) {
    var input = document.getElementById(id);
    var icon = el.querySelector('i');
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// 암호강도체크 간소화 연동
$(function() {
    $("#reg_mb_password").keyup(function() {
        var score = 0;
        var val = this.value;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        
        var percent = (score + 1) * 20;
        var colors = ['#ef4444', '#f59e0b', '#fbbf24', '#10b981', '#059669'];
        $("#pass_meter_container").show();
        $("#pass_meter .progress-bar").css({
            'width': percent + '%',
            'background-color': colors[score]
        });
    });

    $("#reg_mb_name").on('keyup change', function() {
        $("#reg_mb_nick").val($(this).val());
    });
});


<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
$(document).ready(function(){
    var touchStartTimestamp = 0;
    
    $("input, textarea, select").on('touchstart', function(event) {
        zoomDisable();
        touchStartTimestamp = event.timeStamp;
    });

    $("input, textarea, select").on('touchend', function(event) {
        var touchEndTimestamp = event.timeStamp;
        if (touchEndTimestamp - touchStartTimestamp > 500) {
            setTimeout(zoomEnable, 500);
        } else {
            zoomDisable();
            setTimeout(zoomEnable, 500);
        }
    });

    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }

    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
<?php } ?>
</script>
<script src="https://t1.kakaocdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
function closeDaumPostcode() {
    document.getElementById('postcode_layer').style.display = 'none';
}

function win_zip(frm_name, zip, addr1, addr2, addr3, jibeon) {
    var element_layer = document.getElementById('postcode_embed');
    var layer_parent = document.getElementById('postcode_layer');
    
    new daum.Postcode({
        oncomplete: function(data) {
            var fullAddr = ''; // 최종 주소 변수
            var extraAddr = ''; // 조합형 주소 변수

            if (data.userSelectedType === 'R') {
                fullAddr = data.roadAddress;
            } else {
                fullAddr = data.jibunAddress;
            }

            if(data.userSelectedType === 'R'){
                if(data.bname !== ''){
                    extraAddr += data.bname;
                }
                if(data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
            }

            var f = document.forms[frm_name];
            f[zip].value = data.zonecode;
            f[addr1].value = fullAddr;
            f[addr3].value = extraAddr;
            f[jibeon].value = data.jibunAddress;

            // 레이어 닫기
            closeDaumPostcode();
            
            // 상세주소 포커스
            f[addr2].focus();
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 5
    }).embed(element_layer);

    layer_parent.style.display = 'block';
}
</script>