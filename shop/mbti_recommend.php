<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');

// MBTI 추천 데이터 가져오기 (DB 연동)
$mbr_table = $g5['table_prefix'] . 'shop_mbti_recommend';
$mbq_types = ['E/I', 'S/N', 'T/F', 'J/P'];
$mbti_quiz_data = [];

foreach ($mbq_types as $type) {
    $sql = " SELECT * FROM $mbr_table WHERE mbq_type = '$type' ORDER BY rand() LIMIT 5 ";
    $res = sql_query($sql);
    while($row = sql_fetch_array($res)) {
        $mbti_quiz_data[] = [
            'dim' => str_replace('/', '', $row['mbq_type']),
            'q'   => $row['mbq_question'],
            'a'   => $row['mbq_option_a'],
            'b'   => $row['mbq_option_b']
        ];
    }
}
shuffle($mbti_quiz_data);
?>

<div class="container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600 text-white"><i class="fas fa-user-tag text-warning m-r-10"></i><strong>MBTI별</strong> 상품 추천</h2>
        <p class="text-white opacity-80 m-t-10 m-b-0">나의 MBTI 유형에 맞는 상품은 무엇일까요? 재미로 보는 성향별 상품 추천 서비스입니다.</p>
    </div>

    <div class="text-center m-b-40">
        <div class="m-b-30">
            <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/mbti_intro_visual.png" alt="MBTI 추천 가이드" class="img-fluid rounded-3 shadow-sm border" style="width: 100%; max-width: 800px; height: auto;">
        </div>
        <button id="mbti-start-btn" type="button" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow animate__animated animate__pulse animate__infinite" data-bs-toggle="modal" data-bs-target="#mbtiQuizModal">
            <i class="fas fa-magic m-r-10"></i>MBTI별 추천 보험 테스트
        </button>
    </div>

    <!-- MBTI 선택 영역 -->
    <div id="mbti-selection" class="row g-3 m-b-40">
        <?php
        $mbtis = [
            'INTJ', 'INTP', 'ENTJ', 'ENTP',
            'INFJ', 'INFP', 'ENFJ', 'ENFP',
            'ISTJ', 'ISFJ', 'ESTJ', 'ESFJ',
            'ISTP', 'ISFP', 'ESTP', 'ESFP'
        ];
        $mbti_icons = [
            'INTJ' => 'fa-chess-knight', 'INTP' => 'fa-microscope', 'ENTJ' => 'fa-crown', 'ENTP' => 'fa-lightbulb',
            'INFJ' => 'fa-feather-alt', 'INFP' => 'fa-heart', 'ENFJ' => 'fa-users-cog', 'ENFP' => 'fa-star',
            'ISTJ' => 'fa-clipboard-check', 'ISFJ' => 'fa-user-shield', 'ESTJ' => 'fa-gavel', 'ESFJ' => 'fa-hand-holding-heart',
            'ISTP' => 'fa-tools', 'ISFP' => 'fa-paint-brush', 'ESTP' => 'fa-motorcycle', 'ESFP' => 'fa-music'
        ];
        foreach ($mbtis as $mbti) {
            $color_class = "";
            if (strpos($mbti, 'NT') !== false) $color_class = "btn-outline-primary"; // 분석형
            else if (strpos($mbti, 'NF') !== false) $color_class = "btn-outline-success"; // 외교형
            else if (strpos($mbti, 'SJ') !== false) $color_class = "btn-outline-info"; // 관리자형
            else if (strpos($mbti, 'SP') !== false) $color_class = "btn-outline-warning"; // 탐험가형
        ?>
        <div class="col-6 col-md-3">
            <button type="button" class="btn <?php echo $color_class; ?> w-100 py-3 fw-700 f-s-18 mbti-btn" onclick="selectMBTI('<?php echo $mbti; ?>')">
                <i class="fas <?php echo $mbti_icons[$mbti]; ?> m-r-10"></i><?php echo $mbti; ?>
            </button>
        </div>
        <?php } ?>
    </div>

    <!-- 결과 표시 영역 (기본 숨김) -->
    <div id="mbti-result" class="d-none animate__animated animate__fadeIn">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div id="result-header" class="card-header p-4 text-white text-center border-0">
                <h3 class="mb-1"><span id="res-mbti">INTJ</span> 유형을 위한 추천</h3>
                <p id="res-nickname" class="f-s-20 fw-500 mb-0" style="color: #d0d0d0;"></p>
            </div>
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <div class="mbti-icon-box mx-auto">
                            <i id="res-icon" class="fas fa-chess-knight fa-5x text-primary"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-700 mb-3"><i class="fas fa-quote-left m-r-10 text-muted"></i>나의 금융 성향은?</h4>
                        <p id="res-desc" class="f-s-16 line-h-1-8 text-dark mb-4"></p>
                        
                        <div class="recommend-box p-4 bg-light rounded-3 border-start border-4 border-primary">
                            <h5 class="fw-700 text-primary mb-3"><i class="fas fa-shield-alt m-r-10"></i>추천 상품</h5>
                            <ul id="res-products" class="list-unstyled mb-0">
                                <!-- 추천 리스크가 자바스크립트로 삽입됨 -->
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="text-center m-t-40">
                    <div class="m-b-15">
                        <button type="button" id="mbti-counsel-btn" class="btn btn-primary px-5 shadow-sm" style="border-radius: 8px !important; height: 50px !important; display: inline-flex; align-items: center; justify-content: center; font-weight: 700;" onclick="goToMbtiCounsel()">
                            MBTI 추천 보험 상담하기
                        </button>
                    </div>
                    <button type="button" class="btn btn-secondary px-4 py-2" style="border-radius: 8px !important;" onclick="resetSelection()">
                        <i class="fas fa-redo m-r-10"></i>다른 MBTI 확인하기
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MBTI 퀴즈 모달 -->
<div class="modal fade" id="mbtiQuizModal" tabindex="-1" aria-labelledby="mbtiQuizModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden" style="border-radius: 25px; background: #fdfaf0; border: 8px solid #dcd3bd; box-shadow: inset 0 0 50px rgba(0,0,0,0.05), 0 20px 40px rgba(0,0,0,0.2);">
            
            <!-- 모달 헤더 -->
            <div class="modal-header border-0 px-4 py-3" style="background: #ffc107 !important; color: white;">
                <h5 class="modal-title fw-700" id="mbtiQuizModalLabel"><i class="fas fa-magic m-r-10"></i>MBTI별 추천 보험 테스트</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- 모달 바디 (퀴즈 컨텐츠) -->
            <div class="modal-body p-0 position-relative" style="min-height: 500px;">
                <div id="mbti-quiz-app" class="p-4 text-center h-100">
                    
                    <!-- 초기 화면 -->
                    <div id="mbti-screen-start" class="mbti-quiz-screen">
                        <div class="q-a-label mb-2">MBTI TEST</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_normal.png" alt="보드미" class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-4 shadow-sm bg-white">
                                    <h3 class="fw-700 f-s-20 mb-3 mbti-q-text"><i class="fas fa-brain text-warning m-r-10"></i>나의 MBTI 성향에 딱 맞는<br>상품을 찾아볼까요?</h3>
                                    <div class="f-s-20 fw-700 text-warning">🧐 20개 질문으로 확인!</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-warning px-5 py-3 fw-700 f-s-18 rounded-pill shadow text-white" onclick="startMbtiQuiz()"><i class="fas fa-play m-r-10"></i>테스트 시작!</button>
                        </div>
                    </div>

                    <!-- 문제 화면 -->
                    <div id="mbti-screen-question" class="mbti-quiz-screen d-none">
                        <div class="q-progress mb-2">Q<span id="mbti-q-idx">1</span> / 20</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <video autoplay loop muted playsinline class="bodmi-img active" tabindex="-1">
                                    <source src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_anim.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="bubble-box" style="flex: 1;">
                                <div class="speech-bubble p-4 shadow-sm bg-white d-flex flex-column align-items-center justify-content-center" style="min-height: 250px;">
                                    <h3 class="fw-800 f-s-18 mb-4 mbti-q-text" style="word-break: keep-all;"></h3>
                                    <div class="d-grid gap-3 w-100 mbti-btn-wrap">
                                        <button class="btn btn-outline-warning py-3 fw-600 mbti-btn-a text-start px-4 f-s-15" onclick="handleMbtiAnswer('a')"></button>
                                        <button class="btn btn-outline-primary py-3 fw-600 mbti-btn-b text-start px-4 f-s-15" onclick="handleMbtiAnswer('b')"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- mbti-quiz-app 끝 -->
            </div> <!-- modal-body 끝 -->

            <!-- 퀴즈 진행 프로그래스바 (하단 고정) -->
            <div id="mbti-progress-container" class="px-4 py-3 d-none mt-auto" style="background: rgba(255,255,255,0.4); border-top: 1px solid rgba(0,0,0,0.05);">
                <div class="progress" style="height: 12px; border-radius: 10px; background-color: rgba(0,0,0,0.05);">
                    <div id="mbti-progressbar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%; background-color: #ffc107 !important;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const mbtiData = {
    'INTJ': {
        nickname: '완벽주의 전략가',
        icon: 'fa-chess-knight',
        color: '#4a86e8',
        desc: '치밀한 계획과 전략을 세우는 당신은 보험에서도 보장 범위와 약관을 꼼꼼히 따지는 편입니다. 불필요한 특약은 제외하고 핵심적인 위험을 방어하는 효율적인 구성을 선호합니다.',
        products: ['정밀 분석 기반의 종신보험', '핵심 보장 위주의 실손전환 보험', '장기적인 자산 관리를 위한 연금보험']
    },
    'INTP': {
        nickname: '논리적인 사색가',
        icon: 'fa-microscope',
        color: '#674ea7',
        desc: '아이디어가 풍부하고 객관적인 정보를 중시하는 당신은 보험 상품의 구조와 가성비를 철저히 분석합니다. 표준화된 상품보다는 본인의 논리로 납득할 수 있는 합리적인 상품을 택합니다.',
        products: ['다이렉트 건강보험', 'DIY 조립식 보험', '디지털 전용 간편 생활 보험']
    },
    'ENTJ': {
        nickname: '대담한 통솔자',
        icon: 'fa-crown',
        color: '#3c78d8',
        desc: '효율성을 극대화하고 미래를 내다보는 리더 타입인 당신은 리스크 관리도 비즈니스 전략처럼 접근합니다. 큰 위험에 대비하면서도 자산 가치를 높일 수 있는 상품에 주목합니다.',
        products: ['변액 유니버셜 종신보험', '고액 보장 암/뇌/심 진단비 보험', 'CEO 경영인 정기보험']
    },
    'ENTP': {
        nickname: '뜨거운 논쟁을 즐기는 변론가',
        icon: 'fa-lightbulb',
        color: '#3d85c6',
        desc: '고정관념을 타파하고 새로운 시도를 즐기는 당신은 최신 트렌드가 반영된 독특한 보험이나 신상품에 관심이 많습니다. 복잡한 것보다는 직관적이고 혜택이 뚜렷한 상품을 선호합니다.',
        products: ['미니 보험 (스포츠, 여행 등)', '포인트 적립형 건강증진 보험', '특색 있는 특약 중심의 종합보험']
    },
    'INFJ': {
        nickname: '선의의 옹호자',
        icon: 'fa-feather-alt',
        color: '#6aa84f',
        desc: '가족에 대한 사랑과 책임감이 강한 당신에게 보험은 소중한 사람들을 지키기 위한 가장 따뜻한 약속입니다. 물질적인 가치보다는 평안함과 안정감을 주는 구성을 추구합니다.',
        products: ['무배당 가족 사랑 종신보험', '간병비 지원 치매보험', '사회 공헌형 기부 기능 보험']
    },
    'INFP': {
        nickname: '열정적인 중재자',
        icon: 'fa-heart',
        color: '#274e13',
        desc: '개인적인 가치와 신념을 중요하게 생각하는 당신은 자신의 라이프스타일과 조화를 이루는 보험을 선호합니다. 공격적인 투자보다는 마음 편한 보장을 더 가치 있게 여깁니다.',
        products: ['부담 없는 저해지형 보험', '심리 상담 지원 기능 포함 보험', '반려동물 보험 (펫보험)']
    },
    'ENFJ': {
        nickname: '정의로운 사회운동가',
        icon: 'fa-users-cog',
        color: '#38761d',
        desc: '주변 사람들을 챙기고 공동의 이익을 추구하는 당신은 가족 전체의 보장 균형을 맞추는 데 탁월합니다. 본인뿐만 아니라 사랑하는 사람들과 함께 혜택을 누리는 것을 좋아합니다.',
        products: ['통합 가족 구성 보험', '상속 및 증여 플랜 보험', '다둥이/가족 할인 건강보험']
    },
    'ENFP': {
        nickname: '재기발랄한 활동가',
        icon: 'fa-star',
        color: '#93c47d',
        desc: '자유롭고 창의적인 영혼을 가진 당신은 지루한 서류 작업보다 활동적인 삶을 지원하는 보험에 끌립니다. 야외 활동이나 여행 중 발생할 수 있는 사고에 대비하는 보험이 필수입니다.',
        products: ['레저/여행자 보험', '보험료 반환형 건강보험', '걸음 수 연동 할인 보험']
    },
    'ISTJ': {
        nickname: '청렴결백한 논리주의자',
        icon: 'fa-clipboard-check',
        color: '#45818e',
        desc: '전통과 규칙을 중시하고 신중한 당신은 검증된 우량 보험사의 스테디셀러 상품을 신뢰합니다. 화려한 수식어보다는 통계적으로 확률이 높은 보장에 집중하는 실속파입니다.',
        products: ['비갱신형 암보험', '베스트셀러 실손의료보험', '적립식 장기 저축보험']
    },
    'ISFJ': {
        nickname: '용감한 수호자',
        icon: 'fa-user-shield',
        color: '#76a5af',
        desc: '타인을 보호하고 헌신하는 성향의 당신은 예기치 못한 상황에서도 가족이 흔들리지 않도록 완벽한 방패를 준비하려 합니다. 안전성이 최우선이며 보수적인 관점의 보험 설계를 선호합니다.',
        products: ['생활 밀착형 화재/책임 보험', '자녀를 위한 교육/어린이 보험', '노후 대비 간병 보험']
    },
    'ESTJ': {
        nickname: '엄격한 관리자',
        icon: 'fa-gavel',
        color: '#0b5394',
        desc: '현실적이고 사실에 근거한 판단을 하는 당신은 보험도 데이터와 효율성을 기준으로 관리합니다. 불확실성을 최소화하고 정해진 약속이 확실히 이행되는 상품을 골라냅니다.',
        products: ['확정 금리형 연금보험', '대형사 주력 종합 건강보험', '운전자 및 사고 대비 교통 보험']
    },
    'ESFJ': {
        nickname: '사교적인 외교관',
        icon: 'fa-hand-holding-heart',
        color: '#3d85c6',
        desc: '대인 관계가 원만하고 친절한 당신은 전문가나 주변인의 추천을 경청하며 신뢰를 바탕으로 보험을 선택합니다. 사후 보장뿐만 아니라 평소 건강 관리 서비스가 제공되는 상품을 선호합니다.',
        products: ['헬스케어 서비스 포함 보험', '친절한 상담의 전담 설계사 보험', '상조 및 장례 지원 연계 보험']
    },
    'ISTP': {
        nickname: '만능 재주꾼',
        icon: 'fa-tools',
        color: '#bf9000',
        desc: '손재주가 좋고 상황 적응력이 뛰어난 당신은 보험 또한 실용성을 가장 중요하게 생각합니다. 지금 당장 나에게 발생할 확률이 높은 사고에 즉각적으로 대응할 수 있는 보험을 선호합니다.',
        products: ['상해 및 재해 집중 보험', '수술 및 입원 일당 보험', 'DIY 특약 중심 건강보험']
    },
    'ISFP': {
        nickname: '호기심 많은 예술가',
        icon: 'fa-paint-brush',
        color: '#e69138',
        desc: '현재의 삶을 소중히 여기고 감각적인 만족을 중시하는 당신은 복잡한 미래 설계보다 현재의 라이프스타일을 방해하지 않는 보험을 선호합니다. 가입 과정이 간편하고 접근성이 좋은 것을 좋아합니다.',
        products: ['카카오/토스형 간편 가입 보험', '생활 속 작은 보장 미니보험', '치아 및 시력 등 부분 집중 보험']
    },
    'ESTP': {
        nickname: '모험을 즐기는 사업가',
        icon: 'fa-motorcycle',
        color: '#f1c232',
        desc: '에너지가 넘치고 행동 지향적인 당신은 일상의 활력을 지원하는 보험에 관심이 있습니다. 리스크를 두려워하기보다 리스크가 발생했을 때 빠르게 회복하고 다시 일어설 수 있게 해주는 보험이 적합합니다.',
        products: ['골절 및 스포츠 사고 보험', '고수익 추구형 변액보험', '빠른 보상 지급 체계 보험']
    },
    'ESFP': {
        nickname: '자유로운 영혼의 연예인',
        icon: 'fa-music',
        color: '#f6b26b',
        desc: '사람들과 어울리는 것을 좋아하고 즉흥적인 면이 있는 당신은 보험도 즐거운 경험의 연장선이길 바랍니다. 혜택이 눈에 보이고 참여할 때마다 보상이 주어지는 재미있는 보험에 끌립니다.',
        products: ['리워드 제공형 걷기 보험', '할인 혜택이 풍부한 제휴 보험', '단기 여행 및 페스티벌 전용 보험']
    }
};

function selectMBTI(mbti) {
    const data = mbtiData[mbti];
    if (!data) return;

    $('#mbti-start-btn').addClass('d-none');
    $('#mbti-selection').addClass('d-none');
    
    // 데이터 삽입
    $('#res-mbti').text(mbti);
    $('#res-nickname').text(data.nickname);
    $('#res-desc').text(data.desc);
    $('#res-icon').attr('class', 'fas ' + data.icon + ' fa-5x');
    $('#result-header').css('background-color', data.color);
    $('.recommend-box').css('border-color', data.color).find('h5').css('color', data.color);

    const listHtml = data.products.map(p => `
        <li class="mb-2 d-flex align-items-start">
            <i class="fas fa-check-circle m-r-10 m-t-5 text-muted f-s-14"></i>
            <span class="fw-600">${p}</span>
        </li>
    `).join('');
    $('#res-products').html(listHtml);

    $('#mbti-result').removeClass('d-none');
    
    // 결과 헤더 영역으로 부드러운 자동 스크롤
    setTimeout(function() {
        $('html, body').animate({
            scrollTop: $("#result-header").offset().top - 0
        }, 600);
    }, 150);
}

const mbtiQuestions = <?php echo json_encode($mbti_quiz_data); ?>;

let mbtiCurrentIdx = 0;
let mbtiAnswers = [];

function startMbtiQuiz() {
    mbtiCurrentIdx = 0;
    mbtiAnswers = [];
    $('.mbti-quiz-screen').addClass('d-none');
    $('#mbti-screen-question').removeClass('d-none');
    $('#mbti-progress-container').removeClass('d-none');
    loadMbtiQuestion();
}

function loadMbtiQuestion() {
    const q = mbtiQuestions[mbtiCurrentIdx];
    $('#mbti-q-idx').text(mbtiCurrentIdx + 1);
    $('.mbti-q-text').text(q.q);
    
    // 버튼 엘리먼트를 새로 생성하여 터치/포커스 상태를 초기화
    const btnA = $(`<button class="btn btn-outline-warning py-3 fw-600 mbti-btn-a text-start px-4 f-s-15" onclick="handleMbtiAnswer('a')">${q.a}</button>`);
    const btnB = $(`<button class="btn btn-outline-primary py-3 fw-600 mbti-btn-b text-start px-4 f-s-15" onclick="handleMbtiAnswer('b')">${q.b}</button>`);
    
    $('.mbti-btn-wrap').empty().append(btnA).append(btnB);
    
    const percent = Math.round((mbtiCurrentIdx / 20) * 100);
    $('#mbti-progressbar').css('width', percent + '%').attr('aria-valuenow', percent);
}

let mbtiIsProcessing = false;

function handleMbtiAnswer(ans) {
    if (mbtiIsProcessing) return;
    mbtiIsProcessing = true;

    mbtiAnswers.push(ans);
    mbtiCurrentIdx++;
    
    // 버튼 투명도 조절 및 클릭 방지 처리
    $('.mbti-btn-a, .mbti-btn-b').css({
        'opacity': '0.5',
        'pointer-events': 'none'
    });

    // 300ms 후 질문 텍스트 교체
    setTimeout(() => {
        if (mbtiCurrentIdx < 20) {
            loadMbtiQuestion();

            // 모바일에서 터치 잔상 방지를 위해 캐릭터 중앙 터치 시뮬레이션 (포커스 강제 이동)
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                setTimeout(() => {
                    const el = document.querySelector('#mbti-screen-question .bodmi-img.active');
                    if (el) {
                        try {
                            const rect = el.getBoundingClientRect();
                            const x = rect.left + rect.width / 2;
                            const y = rect.top + rect.height / 2;
                            
                            // 의도적으로 현재 포커스된 요소의 포커스를 해제
                            if (document.activeElement) {
                                document.activeElement.blur();
                            }
                            
                            // 1. TouchEvent
                            const touchObj = new Touch({
                                identifier: Date.now(),
                                target: el,
                                clientX: x, clientY: y,
                                pageX: x, pageY: y,
                                radiusX: 5, radiusY: 5,
                                force: 1,
                            });
                            el.dispatchEvent(new TouchEvent('touchstart', { touches: [touchObj], targetTouches: [touchObj], changedTouches: [touchObj], bubbles: true }));
                            
                            // 2. PointerEvent (최신 브라우저 대응)
                            el.dispatchEvent(new PointerEvent('pointerdown', { clientX: x, clientY: y, bubbles: true }));
                            
                            // 3. 포커스 강제 이동
                            el.focus();
                            
                            setTimeout(() => {
                                el.dispatchEvent(new TouchEvent('touchend', { touches: [], targetTouches: [], changedTouches: [touchObj], bubbles: true }));
                                el.dispatchEvent(new PointerEvent('pointerup', { clientX: x, clientY: y, bubbles: true }));
                                el.click();
                            }, 50);
                        } catch(e) {}
                    }
                }, 100);
            }
            
            // 질문 교체 후 버튼 활성화
            setTimeout(() => {
                $('.mbti-btn-a, .mbti-btn-b').css({
                    'opacity': '1',
                    'pointer-events': 'auto'
                });
                mbtiIsProcessing = false;
            }, 500); // 넉넉하게 대기
        } else {
            const resultMbti = calculateResultMbti();
            $('#mbtiQuizModal').modal('hide');
            selectMBTI(resultMbti);
            mbtiIsProcessing = false;
            $('.mbti-btn-a, .mbti-btn-b').css({
                'opacity': '1',
                'pointer-events': 'auto'
            });
        }
    }, 300);
}

function calculateResultMbti() {
    let counts = { E: 0, I: 0, S: 0, N: 0, T: 0, F: 0, J: 0, P: 0 };
    mbtiAnswers.forEach((ans, idx) => {
        const dim = mbtiQuestions[idx].dim;
        if (dim === 'EI') { if (ans === 'a') counts.E++; else counts.I++; }
        else if (dim === 'SN') { if (ans === 'a') counts.S++; else counts.N++; }
        else if (dim === 'TF') { if (ans === 'a') counts.T++; else counts.F++; }
        else if (dim === 'JP') { if (ans === 'a') counts.J++; else counts.P++; }
    });

    let res = "";
    res += counts.E >= 3 ? "E" : "I";
    res += counts.S >= 3 ? "S" : "N";
    res += counts.T >= 3 ? "T" : "F";
    res += counts.J >= 3 ? "J" : "P";
    return res;
}

function resetSelection() {
    $('#mbti-start-btn').removeClass('d-none');
    $('#mbti-result').addClass('d-none');
    $('#mbti-selection').removeClass('d-none');
}
function goToMbtiCounsel() {
    const mbti = $('#res-mbti').text();
    if (mbti) {
        location.href = '<?php echo G5_URL; ?>/mbti_recommend_counsel.php?mbti=' + mbti;
    } else {
        location.href = '<?php echo G5_URL; ?>/mbti_recommend_counsel.php';
    }
}
</script>

<style>
.mbti-btn {
    border-radius: 12px;
    transition: all 0.2s;
    background: #fff;
}
.mbti-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.08);
}
.mbti-icon-box {
    width: 140px;
    height: 140px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
#res-icon { transition: transform 0.3s; }
.mbti-result:hover #res-icon { transform: scale(1.1); }
.line-h-1-8 { line-height: 1.8; }

/* 다크모드 대응 */
.dark-mode .card { background-color: #2c2c2c !important; }
.dark-mode .mbti-btn { background: #333 !important; color: #eee !important; border-color: #444 !important; }
.dark-mode .mbti-btn:hover { background: #444 !important; }
.dark-mode .text-dark { color: #ddd !important; }
.dark-mode .bg-light { background-color: #383838 !important; color: #eee !important; }
.dark-mode .mbti-icon-box { background: #383838 !important; }

/* 퀴즈 모달 관련 스타일 */
#mbtiQuizModal .modal-content { border: none; }
.quiz-layout { display: flex; align-items: center; justify-content: center; gap: 30px; margin-top: 20px; }
@media (max-width: 767px) {
    .quiz-layout { flex-direction: column; gap: 15px; }
}

.character-box { flex-shrink: 0; }
.bodmi-img.active { width: 220px; height: 220px; object-fit: cover; max-width: 100%; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1)); border-radius: 15px; }

.q-a-label { font-weight: 800; color: #222; font-size: 24px; }
.q-progress { font-weight: 700; color: #222; font-size: 24px; }

.speech-bubble {
    position: relative;
    border-radius: 20px;
    border: 2px solid #ffcc80;
    min-width: 300px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
}
.speech-bubble::before {
    content: '';
    position: absolute;
    left: -15px;
    top: 50%;
    transform: translateY(-50%);
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent;
    border-right: 15px solid #ffcc80;
}
.speech-bubble::after {
    content: '';
    position: absolute;
    left: -12px;
    top: 50%;
    transform: translateY(-50%);
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 14px solid white;
}

@media (max-width: 767px) {
    .speech-bubble::before, .speech-bubble::after { display: none; }
}

.mbti-q-text { min-height: 50px; display: flex; align-items: center; justify-content: center; color: #555555 !important; font-weight: 800; opacity: 1 !important; }
.mbti-btn-a { color: #563d00 !important; border-color: #ffc107 !important; border-width: 2px !important; }
.mbti-btn-b { color: #002752 !important; border-color: #007bff !important; border-width: 2px !important; }
.mbti-btn-a:hover { background-color: #ffc107 !important; color: #fff !important; }
.mbti-btn-b:hover { background-color: #007bff !important; color: #fff !important; }

/* 모바일 색상 강제 지정 */
#mbtiQuizModal .modal-header { background: #ffc107 !important; }
#mbti-progressbar { background-color: #ffc107 !important; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
