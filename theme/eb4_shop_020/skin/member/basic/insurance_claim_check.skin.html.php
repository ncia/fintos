<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/insurance_claim_check.skin.html.php
 */
if (!defined('_GNUBOARD_')) exit;
?>

<style>
/* 배경 이미지를 완전히 사용하지 않고 세련되고 맑은 순백/연회색 톤으로 마감 */
.claim-check-wrapper {
    background: none !important;
    background-color: transparent !important;
    padding: 60px 0;
    min-height: 75vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Noto Sans KR', sans-serif;
    box-sizing: border-box;
}

/* 1296px 최대 가로 폭 레이아웃에 완벽 밀착되는 깔끔한 순백의 플랫 카드 */
.premium-layout-1296 {
    width: 100%;
    max-width: 1296px;
    background-color: #ffffff;
    border-radius: 0;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03), 0 1px 3px rgba(0, 0, 0, 0.02);
    overflow: hidden;
    box-sizing: border-box;
}

/* 고유 비주얼 테마 - 깨끗하고 정결한 상단 블루 그라데이션 포인트 헤더 */
.layout-header {
    background: linear-gradient(135deg, #0f1e36 0%, #1e40af 100%);
    padding: 60px 40px;
    text-align: center;
    color: #ffffff;
    position: relative;
}
.layout-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 4px;
    background-color: #3b82f6; /* 현대적이고 산뜻한 브랜드 컬러 라인 */
}
.layout-header .header-tag {
    background-color: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.18);
    color: #fde047;
    font-size: 13px;
    font-weight: 700;
    padding: 5px 15px;
    border-radius: 50px;
    display: inline-block;
    margin-bottom: 15px;
    letter-spacing: 0.5px;
}
.layout-header .header-title {
    font-size: 34px;
    font-weight: 800;
    margin: 0 0 12px 0;
    letter-spacing: -1px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.layout-header .header-title span {
    color: #fde047;
}
.layout-header .header-subtitle {
    font-size: 16px;
    font-weight: 300;
    color: rgba(255, 255, 255, 0.85);
    margin: 0;
    word-break: keep-all;
}

.layout-body {
    padding: 60px 80px;
}

/* 1296px 레이아웃에 어울리는 가로 3분할 깔끔한 카드 그리드 */
.board-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 55px;
}
.board-card {
    background-color: #f8fafc;
    border: 1px solid #f1f5f9;
    border-radius: 16px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.board-card:hover {
    transform: translateY(-5px);
    background-color: #ffffff;
    border-color: #3b82f6;
    box-shadow: 0 15px 30px rgba(59, 130, 246, 0.08);
}
.board-icon {
    font-size: 40px; /* 이모지콘 전용 스타일 */
    margin-bottom: 20px;
    display: inline-block;
    transition: transform 0.3s ease;
}
.board-card:hover .board-icon {
    transform: scale(1.15);
}
.board-title {
    font-size: 19px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 12px;
}
.board-desc {
    font-size: 13.5px;
    color: #475569;
    line-height: 1.6;
    margin: 0;
    word-break: keep-all;
}

/* 실행 버튼 영역 */
.cta-wrapper {
    text-align: center;
    position: relative;
}
.premium-app-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: #ffffff !important;
    font-size: 21px;
    font-weight: 800;
    padding: 18px 55px;
    border-radius: 0;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none !important;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.premium-app-btn::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.18) 50%, rgba(255,255,255,0) 100%);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}
.premium-app-btn:hover {
    box-shadow: 0 15px 35px rgba(29, 78, 216, 0.45);
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}
.premium-app-btn:hover::before {
    transform: translateX(100%);
}
.premium-app-btn .btn-emoji {
    font-size: 22px;
    animation: wave 2.5s infinite;
}


/* 신뢰/안심 바 */
.security-band {
    background-color: #f8fafc;
    padding: 20px 40px;
    text-align: center;
    border-top: 1px solid #e2e8f0;
}
.security-info {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: #64748b;
    font-size: 13.5px;
    font-weight: 500;
}
.security-info .security-emoji {
    font-size: 16px;
}

@keyframes floating {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes wave {
    0%, 100% { transform: rotate(0deg); }
    50% { transform: rotate(15deg); }
}

/* 모바일/태블릿 반응형 */
@media (max-width: 1024px) {
    .layout-body {
        padding: 50px 40px;
    }
    .board-grid {
        gap: 20px;
    }
}
@media (max-width: 768px) {
    .layout-header {
        padding: 40px 20px;
    }
    .layout-header .header-title {
        font-size: 28px;
    }
    .layout-body {
        padding: 40px 20px;
    }
    .board-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .premium-app-btn {
        width: 100%;
        padding: 18px 20px;
        font-size: 18px;
    }
}
</style>

<div class="claim-check-wrapper">
    <div class="premium-layout-1296">
        <!-- 웅장한 타이틀 헤더 -->
        <div class="layout-header">
            <span class="header-tag">✨ PREMIUM SERVICE ✨</span>
            <h1 class="header-title">
                🔍 보험금 청구 <span>실시간 조회</span>
            </h1>
            <p class="header-subtitle">접수 완료된 보험금 청구 내역과 진행 상태를 이모지 기반의 명확한 화면에서 편리하게 확인하세요.</p>
        </div>

        <div class="layout-body">
            <!-- 1296px 폭에 딱 어우러지는 3분할 특장점 카드 보드 -->
            <div class="board-grid">
                <div class="board-card">
                    <span class="board-icon">📱</span>
                    <h3 class="board-title">3초 간편 간이인증</h3>
                    <p class="board-desc">아이디와 비밀번호 찾기 없이 간편한 휴대폰 본인 인증만으로 즉시 조회가 안전하게 개시됩니다.</p>
                </div>
                <div class="board-card">
                    <span class="board-icon">⚡</span>
                    <h3 class="board-title">지급 진행 실시간 확인</h3>
                    <p class="board-desc">접수 단계부터 담당자 지정, 서류 심사, 최종 지급 여부까지의 청구 단계를 실시간으로 추적합니다.</p>
                </div>
                <div class="board-card">
                    <span class="board-icon">🏢</span>
                    <h3 class="board-title">모든 보험사 모아보기</h3>
                    <p class="board-desc">여러 군데의 생명보험 및 손해보험사에 접수된 모든 청구 내역들을 한 곳에서 일목요연하게 조회합니다.</p>
                </div>
            </div>

            <!-- 앱 실행 버튼 영역 -->
            <div class="cta-wrapper">
                <a href="https://claimexpert.vercel.app/" class="premium-app-btn" target="_blank">
                    <span class="btn-emoji">🚀</span> 보험금 청구 조회앱 바로가기
                </a>
            </div>
        </div>

        <!-- 하단 안심 보안 밴드 (이모지콘 적용) -->
        <div class="security-band">
            <div class="security-info">
                <span class="security-emoji">🛡️</span>
                <span>입력하시는 모든 조회용 개인정보는 금융 표준 256bit SSL 보안 알고리즘을 거쳐 안전하게 보호 처리됩니다.</span>
            </div>
        </div>
    </div>
</div>
