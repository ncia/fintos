<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-user-tag text-warning m-r-10"></i><strong>MBTI별</strong> <span class="text-muted">상품 추천</span></h2>
        <p class="text-muted m-t-10 m-b-0">나의 MBTI 유형에 맞는 보험은 무엇일까요? 재미로 보는 성향별 보험 추천 서비스입니다.</p>
    </div>

    <div class="text-center m-b-40">
        <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow animate__animated animate__pulse animate__infinite" data-bs-toggle="modal" data-bs-target="#mbtiQuizModal">
            <i class="fas fa-magic m-r-10"></i>나의 MBTI 기반 보험 추천 시작하기
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
        foreach ($mbtis as $mbti) {
            $color_class = "";
            if (strpos($mbti, 'NT') !== false) $color_class = "btn-outline-primary"; // 분석형
            else if (strpos($mbti, 'NF') !== false) $color_class = "btn-outline-success"; // 외교형
            else if (strpos($mbti, 'SJ') !== false) $color_class = "btn-outline-info"; // 관리자형
            else if (strpos($mbti, 'SP') !== false) $color_class = "btn-outline-warning"; // 탐험가형
        ?>
        <div class="col-6 col-md-3">
            <button type="button" class="btn <?php echo $color_class; ?> w-100 py-3 fw-700 f-s-18 mbti-btn" onclick="selectMBTI('<?php echo $mbti; ?>')">
                <?php echo $mbti; ?>
            </button>
        </div>
        <?php } ?>
    </div>

    <!-- 결과 표시 영역 (기본 숨김) -->
    <div id="mbti-result" class="d-none animate__animated animate__fadeIn">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div id="result-header" class="card-header p-4 text-white text-center border-0">
                <h3 class="mb-1"><span id="res-mbti">INTJ</span> 유형을 위한 추천</h3>
                <p id="res-nickname" class="mb-0 opacity-80">전략적인 투자가</p>
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
                            <h5 class="fw-700 text-primary mb-3"><i class="fas fa-shield-alt m-r-10"></i>추천 보험 상품</h5>
                            <ul id="res-products" class="list-unstyled mb-0">
                                <!-- 추천 리스크가 자바스크립트로 삽입됨 -->
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="text-center m-t-40">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" onclick="resetSelection()">
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
            <div class="modal-header border-0 px-4 py-3" style="background: #ff9800; color: white;">
                <h5 class="modal-title fw-700" id="mbtiQuizModalLabel"><i class="fas fa-magic m-r-10"></i>나의 MBTI별 보험 추천 테스트</h5>
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
                                    <h3 class="fw-700 f-s-20 mb-3 mbti-q-text"><i class="fas fa-brain text-warning m-r-10"></i>나의 MBTI 성향에 딱 맞는<br>보험 상품을 찾아볼까요?</h3>
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
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_normal.png" alt="보드미" class="bodmi-img active">
                            </div>
                            <div class="bubble-box" style="flex: 1;">
                                <div class="speech-bubble p-4 shadow-sm bg-white d-flex flex-column align-items-center justify-content-center" style="min-height: 250px;">
                                    <h3 class="fw-800 f-s-18 mb-4 mbti-q-text" style="word-break: keep-all;"></h3>
                                    <div class="d-grid gap-3 w-100">
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
                    <div id="mbti-progressbar" class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
        icon: 'fa-shield-heart',
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
    
    // 상단으로 스크롤
    $('html, body').animate({ scrollTop: $(".main-heading").offset().top - 100 }, 500);
}

const mbtiQuestions = [
    { id: 1, dim: 'EI', q: '보험 가입을 알아볼 때 당신의 스타일은?', a: '지인이나 담당 설계사에게 바로 연락해서 물어본다.', b: '인터넷 검색이나 커뮤니티를 통해 조용히 정보를 찾는다.' },
    { id: 2, dim: 'EI', q: '설계사와 대면 상담을 하게 되었다. 당신의 반응은?', a: '궁금한 점을 적극적으로 묻고 대화를 주도한다.', b: '설계사의 설명을 주로 듣고 나중에 혼자 꼼꼼히 고민한다.' },
    { id: 3, dim: 'EI', q: '정말 괜찮은 신규 보험 상품 소식을 들었다면?', a: '주변 사람들에게 "이거 괜찮다던데 어때?" 하고 공유한다.', b: '내게 정말 필요한지 상품 안내장을 꼼꼼히 읽어본다.' },
    { id: 4, dim: 'EI', q: '가입한 보험에 대해 궁금한 점이 생겼을 때?', a: '바로 고객센터로 전화를 걸어 상담원에게 직접 묻는다.', b: '보험사 앱이나 홈페이지에 들어가서 FAQ나 약관을 뒤져본다.' },
    { id: 5, dim: 'EI', q: '보험사에서 주최하는 재무 설계 세미나가 있다면?', a: '유익할 것 같아 참석해서 정보도 얻고 사람들과 교류한다.', b: '굳이 참석하지 않고 요약된 자료나 브로슈어만 받아보고 싶다.' },
    { id: 6, dim: 'SN', q: '보험 가입 시 가장 중요하게 보는 것은?', a: '정확한 보장 금액, 특약의 세부 조건, 매월 나가는 납입료.', b: '이 보험이 내 미래의 위험을 어떻게 막아주는지에 대한 큰 그림.' },
    { id: 7, dim: 'SN', q: '수술비 특약을 고를 때 당신의 생각은?', a: '1~5종 수술비가 각각 구체적으로 얼마씩 나오는지 따져본다.', b: '웬만한 수술은 다 커버가 되는 든든하고 포괄적인 특약이면 충분하다.' },
    { id: 8, dim: 'SN', q: '두꺼운 보험 약관을 받아보았다.', a: '보상하지 않는 손해나 구체적인 면책 조항을 찾아 읽어본다.', b: '내용이 너무 길고 복잡해서 전체적인 핵심 요약본만 훑어본다.' },
    { id: 9, dim: 'SN', q: '상품의 장점에 대한 설명을 들을 때 더 와닿는 것은?', a: '구체적인 질병 발병 통계 수치나 실제 보험금 지급 사례.', b: '"가족의 안심", "든든한 노후" 같은 직관적인 느낌이나 비전.' },
    { id: 10, dim: 'SN', q: '미래의 위험을 대비하는 방식은?', a: '현재 유행하는 질병이나 내 가족력을 바탕으로 실질적인 대비를 한다.', b: '혹시 모를 만약의 큰 사고나 희귀 질환까지 상상하며 폭넓게 대비한다.' },
    { id: 11, dim: 'TF', q: '여러 보험 상품 중 하나를 최종 결정할 때 기준은?', a: '가성비, 환급률, 객관적인 보장 범위의 우수성.', b: '나와 내 가족의 평화를 지켜줄 수 있다는 심리적인 안도감.' },
    { id: 12, dim: 'TF', q: '아는 지인이 보험 가입을 권유한다면?', a: '친분은 친분이고, 내게 필요한지 냉정하게 따보고 거절할 수 있다.', b: '지인의 실적이 걱정되거나 관계가 서먹해질까 봐 섣불리 거절하기 어렵다.' },
    { id: 13, dim: 'TF', q: '보험금을 청구했는데 생각보다 적게 나왔을 때 반응은?', a: '지급 기준과 약관을 다시 확인하고 계산이 합당한지 분석한다.', b: '억울하고 속상한 마음이 먼저 들고, 내 편이 되어주지 않는 느낌에 서운하다.' },
    { id: 14, dim: 'TF', q: '암보험 등 큰 병을 대비하는 주된 이유는?', a: '치료 기간 동안 발생하는 소득 상실과 병원비를 계산해보니 필요해서.', b: '내가 아플 때 남은 가족들이 경제적으로 고통받는 것을 원치 않아서.' },
    { id: 15, dim: 'TF', q: '담당 보험설계사에게 바라는 점은?', a: '전문적인 지식으로 군더더기 없이 정확한 팩트와 장단점만 짚어주면 좋겠다.', b: '내 상황에 깊이 공감해주고 인간적으로 따뜻하게 관리해주면 좋겠다.' },
    { id: 16, dim: 'JP', q: '보험료 납입에 대한 당신의 선호도는?', a: '매월 정해진 날짜에 정확하게 자동이체되는 것이 마음 편하다.', b: '여유가 있을 때 더 내거나, 상황에 따라 유예하는 등 유연했으면 좋겠다.' },
    { id: 17, dim: 'JP', q: '내 보험들을 관리하는 방식은?', a: '보장 내역, 납입 기간, 만기일 등을 앱이나 엑셀에 체계적으로 정리해둔다.', b: '대략적으로 어떤 보험이 있는지만 알고 세부 내용은 청구할 일이 생길 때 찾아본다.' },
    { id: 18, dim: 'JP', q: '새로운 보험에 가입하려고 마음먹었다면?', a: '가입 예산을 미리 정해두고 계획대로 빠르게 알아보고 가입을 마무리한다.', b: '천천히 여러 개를 둘러보고, 백 퍼센트 마음에 드는 것이 나올 때까지 결정을 미룬다.' },
    { id: 19, dim: 'JP', q: '여유 자금이 생겨 비상금을 둔다면 보험과 관련해서는?', a: '갱신되어 오를 보험료나 혹시 모를 미납에 대비해 철저히 예비비로 둔다.', b: '당장 필요한 다른 곳에 쓰고, 보험료 문제는 그때 가서 다시 생각한다.' },
    { id: 20, dim: 'JP', q: '갱신형 보험의 보험료가 크게 올랐다는 통보를 받았다면?', a: '즉시 전체 보장 분석을 다시 하고, 해지할지 유지할지 명확하게 결론을 내린다.', b: '일단 이번 달은 그냥 내고, 다음 달에 어떻게 할지 천천히 생각해본다.' }
];

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
    $('.mbti-btn-a').text(q.a);
    $('.mbti-btn-b').text(q.b);
    
    const percent = Math.round((mbtiCurrentIdx / 20) * 100);
    $('#mbti-progressbar').css('width', percent + '%').attr('aria-valuenow', percent);
}

function handleMbtiAnswer(ans) {
    mbtiAnswers.push(ans);
    mbtiCurrentIdx++;
    
    if (mbtiCurrentIdx < 20) {
        loadMbtiQuestion();
    } else {
        const resultMbti = calculateResultMbti();
        $('#mbtiQuizModal').modal('hide');
        selectMBTI(resultMbti);
    }
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
    $('#mbti-result').addClass('d-none');
    $('#mbti-selection').removeClass('d-none');
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
img.bodmi-img.active { width: 220px; max-width: 100%; height: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1)); }

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
.mbti-btn-a:hover, .mbti-btn-b:hover { color: #fff !important; background-color: inherit; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
