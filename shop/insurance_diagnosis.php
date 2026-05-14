<?php
include_once('./_common.php');
include_once(G5_SHOP_PATH.'/shop.head.php');

// 디자인을 위한 CSS 추가
?>
<style>
:root {
    --fintos-blue: #2563eb;
    --fintos-light-blue: #eff6ff;
    --fintos-text-dark: #1e293b;
    --fintos-text-gray: #64748b;
}

.cancer-analysis-container {
    max-width: 900px;
    margin: 40px auto 80px;
}

.analysis-hero {
    text-align: center;
    margin-bottom: 50px;
}

.analysis-hero h1 {
    font-size: 32px;
    font-weight: 800;
    color: var(--fintos-text-dark);
    margin-bottom: 15px;
    letter-spacing: -0.5px;
}

.analysis-hero p {
    font-size: 17px;
    color: var(--fintos-text-gray);
    line-height: 1.6;
}

.analysis-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #f1f5f9;
}

/* 업로드 영역 */
.upload-zone {
    padding: 60px 40px;
    text-align: center;
    border: 2px dashed #e2e8f0;
    margin: 30px;
    border-radius: 20px;
    background-color: #fbfcfe;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-zone:hover {
    border-color: var(--fintos-blue);
    background-color: var(--fintos-light-blue);
}

.upload-zone i {
    font-size: 56px;
    color: var(--fintos-blue);
    margin-bottom: 20px;
}

.upload-zone h3 {
    font-size: 20px;
    font-weight: 700;
    color: var(--fintos-text-dark);
    margin-bottom: 8px;
}

.upload-zone p {
    color: var(--fintos-text-gray);
    font-size: 15px;
}

/* 로딩 상태 */
.analysis-loading {
    display: none;
    padding: 80px 40px;
    text-align: center;
}

.spinner-container {
    position: relative;
    width: 80px;
    height: 80px;
    margin: 0 auto 30px;
}

.analysis-loading h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--fintos-text-dark);
}

/* 가이드 섹션 */
.guide-section {
    margin-top: 40px;
    padding: 0 10px;
}

.guide-section h4 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    color: var(--fintos-text-dark);
}

.guide-section h4 i {
    color: #f59e0b;
    margin-right: 10px;
}

.guide-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.guide-item {
    background: #f8fafc;
    padding: 20px;
    border-radius: 16px;
    border: 1px solid #f1f5f9;
}

.guide-item span {
    display: inline-block;
    width: 28px;
    height: 28px;
    background: var(--fintos-blue);
    color: white;
    border-radius: 50%;
    text-align: center;
    line-height: 28px;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 15px;
}

.guide-item h5 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 10px;
}

.guide-item p {
    font-size: 14px;
    color: var(--fintos-text-gray);
    line-height: 1.5;
}

/* 결과 프리뷰 (초기엔 숨김) */
.analysis-result {
    display: none;
    padding: 40px;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.result-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 30px;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 20px;
}

.result-title h2 {
    font-size: 24px;
    font-weight: 800;
    color: var(--fintos-text-dark);
}

.coverage-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.coverage-card {
    background: #f8fafc;
    padding: 25px;
    border-radius: 20px;
    text-align: center;
}

.coverage-card label {
    display: block;
    color: var(--fintos-text-gray);
    font-size: 14px;
    margin-bottom: 10px;
}

.coverage-card .amount {
    font-size: 24px;
    font-weight: 800;
    color: var(--fintos-blue);
}

.btn-reset {
    background: #f1f5f9;
    color: var(--fintos-text-dark);
    border: none;
    padding: 12px 25px;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.btn-reset:hover {
    background: #e2e8f0;
}

@media (max-width: 768px) {
    .guide-grid, .coverage-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="cancer-analysis-container">
    <div class="analysis-hero">
        <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill f-s-13">보험 관리 서비스</span>
        <h1>AI 보험진단 분석 서비스</h1>
        <p>보험 가입제안서 PDF를 업로드하시면<br>복잡한 보험 담보 내용을 AI가 분석하여 한눈에 요약해 드립니다.</p>
    </div>

    <div class="analysis-card">
        <!-- 업로드 단계 -->
        <div id="stepUpload" class="px-3">
            <div class="upload-zone" id="dropZone">
                <input type="file" id="fileInput" accept="application/pdf" style="display: none;">
                <i class="fas fa-file-medical"></i>
                <h3>가입제안서 PDF 업로드</h3>
                <p>파일을 이곳에 끌어다 놓거나 클릭하여 선택하세요.</p>
                <p class="mt-2 text-muted f-s-13">(국내 주요 보험사 제안서 지원 예정)</p>
            </div>
        </div>

        <!-- 로딩 단계 -->
        <div id="stepLoading" class="analysis-loading">
            <div class="spinner-container">
                <div class="spinner-border text-primary" style="width: 80px; height: 80px; border-width: 5px;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <h3>AI가 보험을 진단 중입니다...</h3>
            <p class="text-muted mt-2">잠시만 기다려 주세요. 담보 내용을 정밀하게 추출하고 있습니다.</p>
        </div>

        <!-- 결과 단계 -->
        <div id="stepResult" class="analysis-result">
            <div class="result-header">
                <div class="result-title">
                    <p class="text-primary fw-bold mb-1">분석 완료</p>
                    <h2>보험 보장 진단 요약</h2>
                </div>
                <button class="btn-reset" onclick="resetAnalysis()">다른 파일 분석하기</button>
            </div>

            <div class="coverage-grid">
                <div class="coverage-card">
                    <label>진단비 총액</label>
                    <div class="amount">8,500만원</div>
                </div>
                <div class="coverage-card">
                    <label>수술비 보장</label>
                    <div class="amount">3,200만원</div>
                </div>
                <div class="coverage-card">
                    <label>입원/치료비</label>
                    <div class="amount">1,500만원</div>
                </div>
            </div>

            <div class="alert alert-light border-0 bg-light p-4 rounded-4 f-s-14">
                <p class="mb-2"><strong><i class="fas fa-info-circle text-primary me-2"></i> 분석 안내</strong></p>
                <ul class="mb-0 text-secondary ps-3">
                    <li>현재 표시된 데이터는 테스트용 예시 데이터입니다.</li>
                    <li>실제 PDF 분석 기능이 연동되면 업로드하신 제안서의 내용이 표시됩니다.</li>
                    <li>AI 분석 결과는 참고용이며, 정확한 보장 내용은 해당 보험사의 약관을 확인하시기 바랍니다.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="guide-section">
        <h4><i class="fas fa-lightbulb"></i> PDF 파일은 어떻게 준비하나요?</h4>
        <div class="guide-grid">
            <div class="guide-item">
                <span>1</span>
                <h5>보험사 앱/웹 접속</h5>
                <p>가입하신 보험사의 공식 앱 또는 홈페이지에 접속하여 로그인을 진행합니다.</p>
            </div>
            <div class="guide-item">
                <span>2</span>
                <h5>가입제안서/증권 조회</h5>
                <p>계약 조회 메뉴에서 '가입제안서' 또는 '보험증권'을 선택하고 PDF로 저장합니다.</p>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const dropZone = $('#dropZone');
    const fileInput = $('#fileInput');

    dropZone.on('click', function() {
        fileInput.click();
    });

    fileInput.on('change', function(e) {
        if (this.files.length > 0) {
            handleFile(this.files[0]);
        }
    });

    dropZone.on('dragover', function(e) {
        e.preventDefault();
        $(this).css('border-color', '#2563eb').css('background-color', '#eff6ff');
    });

    dropZone.on('dragleave', function(e) {
        e.preventDefault();
        $(this).css('border-color', '#e2e8f0').css('background-color', '#fbfcfe');
    });

    dropZone.on('drop', function(e) {
        e.preventDefault();
        $(this).css('border-color', '#e2e8f0').css('background-color', '#fbfcfe');
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            handleFile(files[0]);
        }
    });

    function handleFile(file) {
        if (file.type !== 'application/pdf') {
            alert('PDF 파일만 업로드 가능합니다.');
            return;
        }

        // 분석 시뮬레이션
        $('#stepUpload').hide();
        $('#stepLoading').fadeIn();

        setTimeout(function() {
            $('#stepLoading').hide();
            $('#stepResult').fadeIn();
        }, 3000);
    }
});

function resetAnalysis() {
    $('#stepResult').hide();
    $('#stepUpload').fadeIn();
    $('#fileInput').val('');
}
</script>

<?php
include_once(G5_SHOP_PATH.'/shop.tail.php');
?>
