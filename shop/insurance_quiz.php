<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');

$quiz_table = G5_TABLE_PREFIX.'shop_quiz';

// 정답이 O인 문제 5개, X인 문제 5개 무작위 선택
$sql_o = " SELECT * FROM $quiz_table WHERE qz_answer = 'O' ORDER BY rand() LIMIT 5 ";
$res_o = sql_query($sql_o);
$quiz_data = [];
while($row = sql_fetch_array($res_o)) {
    $quiz_data[] = $row;
}

$sql_x = " SELECT * FROM $quiz_table WHERE qz_answer = 'X' ORDER BY rand() LIMIT 5 ";
$res_x = sql_query($sql_x);
while($row = sql_fetch_array($res_x)) {
    $quiz_data[] = $row;
}

// 10문제 섞기
shuffle($quiz_data);
?>

<div class="container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-mortar-board text-primary m-r-10"></i><strong>보험 상식</strong> <span class="text-muted">퀴즈</span></h2>
    </div>

    <div class="text-center m-b-20 px-3">
        <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/quiz_intro.jpg" alt="보험 상식 퀴즈" style="width: 100%; max-width: 450px; height: auto; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
    </div>

    <div class="text-center m-b-30">
        <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow" data-bs-toggle="modal" data-bs-target="#quizModal">
            <i class="fas fa-play-circle m-r-10"></i>퀴즈 시작하기
        </button>
    </div>
</div>

<!-- 퀴즈 모달 -->
<div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden" style="border-radius: 25px; background: url('<?php echo EYOOM_THEME_URL; ?>/image/quiz/quiz_bg_clean.png') no-repeat center center; background-size: cover; border: 8px solid #5d4037; box-shadow: inset 0 0 50px rgba(0,0,0,0.5);">
            
            <!-- 모달 헤더 -->
            <div class="modal-header border-0 px-4 py-3" style="background: #4a86e8; color: white;">
                <h5 class="modal-title fw-700" id="quizModalLabel"><i class="fas fa-graduation-cap m-r-10"></i>보험 상식 퀴즈</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- 모달 바디 (퀴즈 컨텐츠) -->
            <div class="modal-body p-0 position-relative" style="min-height: 500px;">
                <div id="quiz-app" class="p-4 text-center h-100" style="width: 100%; margin: 0 auto;">
                    
                    <!-- 초기 화면 -->
                    <div id="screen-start" class="quiz-screen">
                        <div class="q-a-label mb-2">Q&A</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_normal.png" alt="보드미" class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-4 shadow-sm bg-white">
                                    <h3 class="fw-700 f-s-20 mb-3 text-dark"><i class="fas fa-lightbulb text-warning m-r-10"></i>질문: 당신은 보험에 대해<br>얼마나 알고 있나요?</h3>
                                    <div class="f-s-20 fw-700 text-primary">🤔 도전해보세요!</div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 68px;">
                            <button class="btn btn-primary px-5 py-3 fw-700 f-s-18 rounded-pill shadow" onclick="startQuiz()"><i class="fas fa-play m-r-10"></i>시작하기!</button>
                        </div>
                    </div>

                    <!-- 문제 화면 -->
                    <div id="screen-question" class="quiz-screen d-none">
                        <div class="q-progress mb-2">Q<span id="q-idx">1</span> / 10</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_normal.png" alt="보드미" class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-4 shadow-sm bg-white d-flex flex-column align-items-center justify-content-center" style="min-height: 220px;">
                                    <h3 class="fw-700 f-s-18 mb-4 q-text text-dark" style="word-break: keep-all;"></h3>
                                    <div class="d-flex gap-3">
                                        <button class="btn-quiz btn-o" onclick="checkAnswer('O')">
                                            <div class="circle-o">O</div>
                                            <span>맞다</span>
                                        </button>
                                        <button class="btn-quiz btn-x" onclick="checkAnswer('X')">
                                            <div class="mark-x">X</div>
                                            <span>틀리다</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 결과 및 해설 화면 (통합) -->
                    <div id="screen-result-item" class="quiz-screen d-none">
                        <div id="result-label" class="q-a-label mb-2">정답입니다!</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img id="result-bodmi" src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_correct.png" alt="보드미" class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-4 shadow-sm bg-white" style="max-width: 400px;">
                                     <h3 id="result-title" class="fw-700 f-s-20 mb-2">축하합니다!</h3>
                                     <hr class="my-3 opacity-10">
                                     <p class="f-s-15 line-h-1-6 q-exp text-dark" style="word-break: keep-all;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-primary px-5 py-3 fw-700 f-s-18 rounded-pill shadow next-btn" onclick="nextQuestion()">다음 문제</button>
                        </div>
                    </div>

                    <!-- 최종 점수 화면 -->
                    <div id="screen-final" class="quiz-screen d-none">
                        <div class="q-a-label mb-2">최종 결과</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_explain.png" alt="보드미" class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-5 shadow-sm bg-white">
                                     <h2 class="fw-900 mb-2" style="color: #4a86e8;"><span id="final-score">0</span>점</h2>
                                     <p class="f-s-18 mb-4 text-dark">총 10문제 중 <span id="correct-count">0</span>문제를 맞췄습니다!</p>
                                     <div class="result-msg f-s-16 fw-600 text-muted"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-secondary px-5 py-3 fw-700 f-s-18 rounded-pill shadow" onclick="location.reload()">다시 도전하기</button>
                        </div>
                    </div>

                <!-- 배경 장식 삭제됨 -->
                </div> <!-- quiz-app 끝 -->
            </div> <!-- modal-body 끝 -->

            <!-- 퀴즈 진행 프로그래스바 (하단 고정) -->
            <div id="quiz-progress-container" class="px-4 py-3 d-none mt-auto" style="background: rgba(255,255,255,0.4); border-top: 1px solid rgba(0,0,0,0.05);">
                <div class="progress" style="height: 12px; border-radius: 10px; background-color: rgba(0,0,0,0.05);">
                    <div id="quiz-progressbar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const quizData = <?php echo json_encode($quiz_data); ?>;
const themeUrl = "<?php echo EYOOM_THEME_URL; ?>";
let currentIdx = 0;
let score = 0;
let correctCount = 0;

function showScreen(screenId) {
    $('.quiz-screen').addClass('d-none');
    $('#' + screenId).removeClass('d-none');
}

/* Bootstrap의 data-bs-toggle 속성으로 자동으로 작동하므로 별도의 JS 제어는 필요하지 않습니다. */

function startQuiz() {
    currentIdx = 0;
    score = 0;
    correctCount = 0;
    $('#quiz-progress-container').removeClass('d-none');
    loadQuestion();
    showScreen('screen-question');
}

function loadQuestion() {
    const q = quizData[currentIdx];
    $('#q-idx').text(currentIdx + 1);
    $('.q-text').text(q.qz_question);
    $('.q-exp').text(q.qz_explanation);
    updateProgressBar();
}

function updateProgressBar() {
    const percent = Math.round((currentIdx / 10) * 100);
    $('#quiz-progressbar').css('width', percent + '%').attr('aria-valuenow', percent);
}

function checkAnswer(userAns) {
    const q = quizData[currentIdx];
    const isCorrect = (userAns === q.qz_answer);
    
    if (isCorrect) {
        score += 10;
        correctCount++;
        $('#result-label').html('<i class="fas fa-check-circle m-r-5"></i>정답입니다!').addClass('text-success').removeClass('text-danger');
        $('#result-title').text('축하합니다!').addClass('text-success').removeClass('text-danger');
        $('#result-bodmi').attr('src', themeUrl + '/image/quiz/bodmi_correct.png');
    } else {
        $('#result-label').html('<i class="fas fa-times-circle m-r-5"></i>틀렸습니다...').addClass('text-danger').removeClass('text-success');
        $('#result-title').text('아쉬워요!').addClass('text-danger').removeClass('text-success');
        $('#result-bodmi').attr('src', themeUrl + '/image/quiz/bodmi_wrong.png');
    }

    if (currentIdx === 9) {
        $('.next-btn').text('최종 결과 확인');
    } else {
        $('.next-btn').text('다음 문제');
    }

    showScreen('screen-result-item');
}

function nextQuestion() {
    currentIdx++;
    if (currentIdx < 10) {
        loadQuestion();
        showScreen('screen-question');
    } else {
        showFinalResult();
    }
}

function showFinalResult() {
    $('#quiz-progressbar').css('width', '100%').attr('aria-valuenow', 100);
    
    $('#final-score').text(score);
    $('#correct-count').text(correctCount);
    
    let msg = "";
    if (score === 100) msg = "보험 상식 마스터! 완벽합니다!";
    else if (score >= 80) msg = "보험에 대해 아주 잘 알고 계시네요!";
    else if (score >= 50) msg = "조금만 더 공부하면 전문가가 될 수 있어요!";
    else msg = "보드미와 함께 보험 공부를 시작해봐요!";
    
    $('.result-msg').text(msg);
    showScreen('screen-final');
}
</script>

<style>
#quizModal .modal-content { border: none; }
.quiz-layout { display: flex; align-items: center; justify-content: center; gap: 30px; margin: 50px auto 0; width: 100%; max-width: 800px; padding: 0; position: relative; left: -45px; }
@media (max-width: 767px) {
    .quiz-layout { flex-direction: column; }
}

.bodmi-img { width: 310px; height: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1)); }

.q-a-label { font-weight: 800; color: #ffffff; font-size: 28px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3); }
.q-progress { font-weight: 700; color: #ffffff; font-size: 28px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3); }

.speech-bubble {
    position: relative;
    border-radius: 20px;
    border: 2px solid #aec6f5;
    min-width: 320px;
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
    border-right: 15px solid #aec6f5;
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

/* 버튼 스타일 */
.btn-quiz {
    border: none;
    border-radius: 12px;
    padding: 12px 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    transition: all 0.2s;
    min-width: 120px;
}
.btn-o { background: #2ecc71; color: white; }
.btn-x { background: #e74c3c; color: white; }
.btn-quiz:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.circle-o, .mark-x { font-size: 32px; font-weight: 900; }

.line-h-1-6 { line-height: 1.6; }
.f-s-15 { font-size: 15px; }
.f-s-18 { font-size: 18px; }
.fw-700 { font-weight: 700; }
.fw-900 { font-weight: 900; }

/* 다크모드 대응 */
.dark-mode #quizModal .modal-content { background: url('<?php echo EYOOM_THEME_URL; ?>/image/quiz/quiz_bg_clean.png') no-repeat center center !important; background-size: cover !important; border-color: #3e2723 !important; }
.dark-mode .q-a-label, .dark-mode .q-progress { color: #ffffff !important; }
.dark-mode .speech-bubble { background: #fff !important; border-color: #aec6f5 !important; }
.dark-mode .speech-bubble::after { border-right-color: #fff !important; }
.dark-mode .speech-bubble::before { border-right-color: #aec6f5 !important; }
.dark-mode .text-dark { color: #212529 !important; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
