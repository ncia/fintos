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
    max-width: 800px;
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
                <form name="fcounsel" action="./counsel_update.php" method="post" onsubmit="return fsubmit(this);" class="eyoom-form">
                    <input type="hidden" name="source" value="insurance_counsel">
                    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
                    <input type="hidden" name="subject" value="[상품상담] <?php echo ($it_brand ? $it_brand . ' ' : '') . $it_name; ?>">

                    <?php if ($it_name) { ?>
                    <div class="item-badge">
                        <strong><?php echo ($it_brand ? $it_brand . ' ' : '') . $it_name; ?></strong>
                    </div>
                    <?php } ?>

                    <div class="section-title">개인 정보 입력</div>

                    <div class="input">
                        <input type="text" name="c_name" placeholder="이름" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="tel" name="c_hp" placeholder="연락처 (숫자만 입력)" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="input">
                        <input type="text" name="c_birth" placeholder="생년월일 (8자리) 예: 19900101" required>
                        <div class="required-dot"></div>
                    </div>

                    <div class="gender-selector">
                        <input type="radio" name="c_sex" id="male" value="M">
                        <label for="male" class="gender-label"><i class="fas fa-mars"></i> 남성</label>
                        <input type="radio" name="c_sex" id="female" value="F">
                        <label for="female" class="gender-label" style="position:relative;"><i class="fas fa-venus"></i> 여성<div class="required-dot"></div></label>
                    </div>

                    <div class="section-title">거주 지역</div>
                    <div class="time-row">
                        <div class="time-col">
                            <div class="input" style="margin-bottom:0;">
                                <select name="c_sido" id="c_sido" required onchange="updateSigungu(this.value);">
                                    <option value="">시/도 선택</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                        <div class="time-col">
                            <div class="input" style="margin-bottom:0;">
                                <select name="c_gugun" id="c_gugun" required>
                                    <option value="">시/군/구 선택</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                    </div>

                    <div class="section-title">상담 가능 시간</div>

                    <div class="time-row">
                        <div class="time-col ampm-col">
                            <div class="input">
                                <select name="c_ampm" onchange="toggle_time_hour(this);">
                                    <option value="">상담시간구분(오전/오후)</option>
                                    <option value="종일">종일</option>
                                    <option value="오전">오전</option>
                                    <option value="오후">오후</option>
                                </select>
                                <div class="required-dot"></div>
                            </div>
                        </div>
                        <div class="time-col counsel-hour-col" style="display:none;">
                            <div class="input">
                                <select name="c_time">
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
                            (필수) 개인정보 수집ㆍ활용 동의
                            <input type="checkbox" id="c_agree" name="c_agree" value="1" checked required>
                            <span class="checkmark"></span>
                        </label>

                        <label class="checkbox-container">
                            (선택) 카카오톡 핀토스 보험 채널 추가 동의
                            <input type="checkbox" id="c_kakaotalk" name="c_kakaotalk" value="1" checked>
                            <span class="checkmark"></span>
                        </label>

                        <label class="checkbox-container">
                            (선택) 마케팅 정보 수신 동의
                            <input type="checkbox" id="c_mailling" name="c_mailling" value="1" checked>
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
        $hourCol.show();
    } else {
        $hourCol.hide();
    }
}
</script>

<script>
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
