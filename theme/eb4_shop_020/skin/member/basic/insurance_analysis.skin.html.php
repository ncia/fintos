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
    pointer-events: auto !important;
    position: relative;
    z-index: 11;
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
    z-index: 12;
    position: relative;
    pointer-events: auto !important;
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
                <form name="fanalysis" action="./counsel_update.php" method="post" onsubmit="return fsubmit(this);" class="eyoom-form">
                    <input type="hidden" name="source" value="insurance_analysis">
                    
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
                        <input type="radio" name="c_sex" id="gender_m" value="M" required>
                        <label for="gender_m" class="gender-label">남성</label>
                        
                        <input type="radio" name="c_sex" id="gender_f" value="F">
                        <label for="gender_f" class="gender-label" style="position:relative;">여성<div class="required-dot"></div></label>
                    </div>

                    <div class="section-title">거주 지역</div>
                    <div class="row" style="margin-left:-5px; margin-right:-5px; margin-bottom:25px;">
                        <div class="col-6" style="padding:0 5px;">
                            <div class="input" style="margin-bottom:0;">
                                <select name="c_sido" id="c_sido" required onchange="updateSigungu(this.value);">
                                    <option value="">시/도 선택</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                        <div class="col-6" style="padding:0 5px;">
                            <div class="input" style="margin-bottom:0;">
                                <select name="c_gugun" id="c_gugun" required>
                                    <option value="">시/군/구 선택</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
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
                                <select name="c_time">
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
                            (필수) 개인정보 수집ㆍ활용 동의
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" name="c_kakaotalk" value="1" id="c_kakaotalk" checked>
                            <span class="checkmark"></span>
                            (선택) 카카오톡 핀토스 보험 채널 수신 동의
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" name="c_mailling" value="1" id="c_mailling" checked>
                            <span class="checkmark"></span>
                            (선택) 마케팅 정보 수신 동의
                        </label>
                    </div>

                    <button type="submit" class="submit-btn">보험증권 분석 신청하기</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function fsubmit(f) {
    if (f.c_ampm.value == '오전' || f.c_ampm.value == '오후') {
        if (f.c_time.value == '') {
            alert('상담 시간을 선택해 주세요.');
            f.c_time.focus();
            return false;
        }
    }
    return true;
}

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

const regionData = {
    "서울특별시": ["종로구", "중구", "용산구", "성동구", "광진구", "동대문구", "중랑구", "성북구", "강북구", "도봉구", "노원구", "은평구", "서대문구", "마포구", "양천구", "강서구", "구로구", "금천구", "영등포구", "동작구", "관악구", "서초구", "강남구", "송파구", "강동구"],
    "부산광역시": ["중구", "서구", "동구", "영도구", "부산진구", "동래구", "남구", "북구", "해운대구", "사하구", "금정구", "강서구", "연제구", "수영구", "사상구", "기장군"],
    "대구광역시": ["중구", "동구", "서구", "남구", "북구", "수성구", "달서구", "달성군", "군위군"],
    "인천광역시": ["중구", "동구", "미추홀구", "연수구", "남동구", "부평구", "계양구", "서구", "강화군", "옹진군"],
    "광주광역시": ["동구", "서구", "남구", "북구", "광산구"],
    "대전광역시": ["동구", "중구", "서구", "유성구", "대덕구"],
    "울산광역시": ["중구", "남구", "동구", "북구", "울주군"],
    "세종특별자치시": ["세종특별자치시"],
    "경기도": ["수원시 장안구", "수원시 권선구", "수원시 팔달구", "수원시 영통구", "성남시 수정구", "성남시 중원구", "성남시 분당구", "의정부시", "안양시 만안구", "안양시 동안구", "부천시", "광명시", "평택시", "동두천시", "안산시 상록구", "안산시 단원구", "고양시 덕양구", "고양시 일산동구", "고양시 일산서구", "과천시", "구리시", "남양주시", "오산시", "시흥시", "군포시", "의왕시", "하남시", "용인시 처인구", "용인시 기흥구", "용인시 수지구", "파주시", "이천시", "안성시", "김포시", "화성시", "광주시", "양주시", "포천시", "여주시", "연천군", "가평군", "양평군"],
    "강원특별자치도": ["춘천시", "원주시", "강릉시", "동해시", "태백시", "속초시", "삼척시", "홍천군", "횡성군", "영월군", "평창군", "정선군", "철원군", "화천군", "양구군", "인제군", "고성군", "양양군"],
    "충청북도": ["청주시 상당구", "청주시 서원구", "청주시 흥덕구", "청주시 청원구", "충주시", "제천시", "보은군", "옥천군", "영동군", "증평군", "진천군", "괴산군", "음성군", "단양군"],
    "충청남도": ["천안시 동남구", "천안시 서북구", "공주시", "보령시", "아산시", "서산시", "논산시", "계룡시", "당진시", "금산군", "부여군", "서천군", "청양군", "홍성군", "예산군", "태안군"],
    "전북특별자치도": ["전주시 완산구", "전주시 덕진구", "군산시", "익산시", "정읍시", "남원시", "김제시", "완주군", "진안군", "무주군", "장수군", "임실군", "순창군", "고창군", "부안군"],
    "전라남도": ["목포시", "여수시", "순천시", "나주시", "광양시", "담양군", "곡성군", "구례군", "고흥군", "보성군", "화순군", "장흥군", "강진군", "해남군", "영암군", "무안군", "함평군", "영광군", "장성군", "완도군", "진도군", "신안군"],
    "경상북도": ["포항시 남구", "포항시 북구", "경주시", "김천시", "안동시", "구미시", "영주시", "영천시", "상주시", "문경시", "경산시", "의성군", "청송군", "영양군", "영덕군", "청도군", "고령군", "성주군", "칠곡군", "예천군", "봉화군", "울진군", "울릉군"],
    "경상남도": ["창원시 의창구", "창원시 성산구", "창원시 마산합포구", "창원시 마산회원구", "창원시 진해구", "진주시", "통영시", "사천시", "김해시", "밀양시", "거제시", "양산시", "의령군", "함안군", "창녕군", "고성군", "남해군", "하동군", "산청군", "함양군", "거창군", "합천군"],
    "제주특별자치도": ["제주시", "서귀포시"]
};

$(document).ready(function() {
    var $sidoSelect = $('#c_sido');
    $.each(regionData, function(sido, guguns) {
        $sidoSelect.append('<option value="' + sido + '">' + sido + '</option>');
    });
});

function updateSigungu(sido) {
    var $gugunSelect = $('#c_gugun');
    $gugunSelect.empty().append('<option value="">시/군/구 선택</option>');
    
    if (sido && regionData[sido]) {
        $.each(regionData[sido], function(i, gugun) {
            $gugunSelect.append('<option value="' + gugun + '">' + gugun + '</option>');
        });
    }
}
</script>
