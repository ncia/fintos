<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');

$quiz_table = G5_TABLE_PREFIX.'shop_quiz';

// ?뺣떟??O??臾몄젣 5媛? X??臾몄젣 5媛?臾댁옉???좏깮
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

// 10臾몄젣 ?욊린
shuffle($quiz_data);
?>

<div class="container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-mortar-board text-primary m-r-10"></i><strong>蹂댄뿕 ?곸떇</strong> <span class="text-muted">?댁쫰</span></h2>
    </div>

    <div class="text-center m-b-30">
        <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow" data-bs-toggle="modal" data-bs-target="#quizModal">
            <i class="fas fa-play-circle m-r-10"></i>?댁쫰 ?쒖옉?섍린
        </button>
    </div>
</div>

<!-- ?댁쫰 紐⑤떖 -->
<div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden" style="border-radius: 25px; background: #eef2ff;">
            
            <!-- 紐⑤떖 ?ㅻ뜑 -->
            <div class="modal-header border-0 px-4 py-3" style="background: #4a86e8; color: white;">
                <h5 class="modal-title fw-700" id="quizModalLabel"><i class="fas fa-graduation-cap m-r-10"></i>蹂댄뿕 ?곸떇 ?댁쫰</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- 紐⑤떖 諛붾뵒 (?댁쫰 而⑦뀗痢? -->
            <div class="modal-body p-0 position-relative" style="min-height: 500px;">
                <div id="quiz-app" class="p-4 text-center h-100">
                    
                    <!-- 珥덇린 ?붾㈃ -->
                    <div id="screen-start" class="quiz-screen">
                        <div class="q-a-label f-s-16 mb-2">Q&A</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_normal.png" alt="蹂대뱶誘? class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-4 shadow-sm bg-white">
                                    <h3 class="fw-700 f-s-20 mb-3 text-dark"><i class="fas fa-lightbulb text-warning m-r-10"></i>吏덈Ц: ?뱀떊? 蹂댄뿕?????br>?쇰쭏???뚭퀬 ?덈굹??</h3>
                                    <div class="f-s-16 text-muted">?앷컖?대낫?몄슂!</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-primary px-5 py-3 fw-700 f-s-18 rounded-pill shadow" onclick="startQuiz()"><i class="fas fa-play m-r-10"></i>?쒖옉?섍린!</button>
                        </div>
                    </div>

                    <!-- 臾몄젣 ?붾㈃ -->
                    <div id="screen-question" class="quiz-screen d-none">
                        <div class="q-progress f-s-16 mb-2">Q<span id="q-idx">1</span> / 10</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_normal.png" alt="蹂대뱶誘? class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-4 shadow-sm bg-white d-flex flex-column align-items-center justify-content-center" style="min-height: 220px;">
                                    <h3 class="fw-700 f-s-18 mb-4 q-text text-dark" style="word-break: keep-all;"></h3>
                                    <div class="d-flex gap-3">
                                        <button class="btn-quiz btn-o" onclick="checkAnswer('O')">
                                            <div class="circle-o">O</div>
                                            <span>留욌떎</span>
                                        </button>
                                        <button class="btn-quiz btn-x" onclick="checkAnswer('X')">
                                            <div class="mark-x">X</div>
                                            <span>?由щ떎</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 寃곌낵 諛??댁꽕 ?붾㈃ (?듯빀) -->
                    <div id="screen-result-item" class="quiz-screen d-none">
                        <div id="result-label" class="q-a-label f-s-16 mb-2">?뺣떟?낅땲??</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img id="result-bodmi" src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_correct.png" alt="蹂대뱶誘? class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-4 shadow-sm bg-white" style="max-width: 400px;">
                                     <h3 id="result-title" class="fw-700 f-s-20 mb-2">異뺥븯?⑸땲??</h3>
                                     <hr class="my-3 opacity-10">
                                     <p class="f-s-15 line-h-1-6 q-exp text-dark" style="word-break: keep-all;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-primary px-5 py-3 fw-700 f-s-18 rounded-pill shadow next-btn" onclick="nextQuestion()">?ㅼ쓬 臾몄젣</button>
                        </div>
                    </div>

                    <!-- 理쒖쥌 ?먯닔 ?붾㈃ -->
                    <div id="screen-final" class="quiz-screen d-none">
                        <div class="q-a-label f-s-16 mb-2">理쒖쥌 寃곌낵</div>
                        <div class="quiz-layout">
                            <div class="character-box">
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/quiz/bodmi_correct.png" alt="蹂대뱶誘? class="bodmi-img active">
                            </div>
                            <div class="bubble-box">
                                <div class="speech-bubble p-5 shadow-sm bg-white">
                                     <h2 class="fw-900 mb-2" style="color: #4a86e8;"><span id="final-score">0</span>??/h2>
                                     <p class="f-s-18 mb-4 text-dark">珥?10臾몄젣 以?<span id="correct-count">0</span>臾몄젣瑜?留욎톬?듬땲??</p>
                                     <div class="result-msg f-s-16 fw-600 text-muted"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-secondary px-5 py-3 fw-700 f-s-18 rounded-pill shadow" onclick="location.reload()">?ㅼ떆 ?꾩쟾?섍린</button>
                        </div>
                    </div>

                <!-- 諛곌꼍 ?μ떇 ??젣??-->
                </div> <!-- quiz-app ??-->
            </div> <!-- modal-body ??-->

            <!-- ?댁쫰 吏꾪뻾 ?꾨줈洹몃옒?ㅻ컮 (?섎떒 怨좎젙) -->
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

$(document).on('click', '[data-bs-target="#quizModal"]', function() {
    var myModal = new bootstrap.Modal(document.getElementById('quizModal'));
    myModal.show();
});

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
        $('#result-label').html('<i class="fas fa-check-circle m-r-5"></i>?뺣떟?낅땲??').addClass('text-success').removeClass('text-danger');
        $('#result-title').text('異뺥븯?⑸땲??').addClass('text-success').removeClass('text-danger');
        $('#result-bodmi').attr('src', themeUrl + '/image/quiz/bodmi_correct.png');
    } else {
        $('#result-label').html('<i class="fas fa-times-circle m-r-5"></i>??몄뒿?덈떎...').addClass('text-danger').removeClass('text-success');
        $('#result-title').text('?꾩돩?뚯슂!').addClass('text-danger').removeClass('text-success');
        $('#result-bodmi').attr('src', themeUrl + '/image/quiz/bodmi_wrong.png');
    }

    if (currentIdx === 9) {
        $('.next-btn').text('理쒖쥌 寃곌낵 ?뺤씤');
    } else {
        $('.next-btn').text('?ㅼ쓬 臾몄젣');
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
    if (score === 100) msg = "蹂댄뿕 ?곸떇 留덉뒪?? ?꾨꼍?⑸땲??";
    else if (score >= 80) msg = "蹂댄뿕??????꾩＜ ???뚭퀬 怨꾩떆?ㅼ슂!";
    else if (score >= 50) msg = "議곌툑留???怨듬??섎㈃ ?꾨Ц媛媛 ?????덉뼱??";
    else msg = "蹂대뱶誘몄? ?④퍡 蹂댄뿕 怨듬?瑜??쒖옉?대킄??";
    
    $('.result-msg').text(msg);
    showScreen('screen-final');
}
</script>

<style>
#quizModal .modal-content { border: none; }
.quiz-layout { display: flex; align-items: center; justify-content: center; gap: 30px; margin-top: 20px; }
@media (max-width: 767px) {
    .quiz-layout { flex-direction: column; }
}

.bodmi-img { width: 220px; height: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1)); }

.q-a-label { font-weight: 800; color: #4a2b2b; }
.q-progress { font-weight: 700; color: #4a2b2b; }

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

/* 踰꾪듉 ?ㅽ???*/
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

/* ?ㅽ겕紐⑤뱶 ???*/
.dark-mode #quizModal .modal-content { background: #1a1a1a !important; }
.dark-mode .speech-bubble { background: #2a2a2a !important; border-color: #444 !important; }
.dark-mode .speech-bubble::after { border-right-color: #2a2a2a !important; }
.dark-mode .speech-bubble::before { border-right-color: #444 !important; }
.dark-mode .text-dark { color: #eee !important; }
.dark-mode .q-a-label, .dark-mode .q-progress { color: #bbb !important; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
