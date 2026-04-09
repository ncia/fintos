<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="healthcare-dictionary-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-file-medical text-primary m-r-10"></i><strong>의료 용어</strong> <span class="text-muted">사전</span></h2>
    </div>

    <!-- 사전 카드 -->
    <div class="healthcare-app-card bg-white border-0 shadow overflow-hidden">
        
        <!-- 검색 및 카테고리 섹션 -->
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100 bg-light-gray" style="background-color: #f8f9fa;">
            <!-- 검색창 -->
            <div class="eyoom-form mb-4">
                <div class="input-group shadow-sm border rounded bg-white overflow-hidden healthcare-search-box">
                    <span class="input-group-text bg-transparent border-0 px-3"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" id="healthcareSearchInput" class="form-control border-0 py-2 f-s-15" placeholder="궁금하신 의료 용어를 입력하세요 (예: 심근경색, MRI)" autocomplete="off">
                </div>
            </div>

            <!-- 색인 버튼 (ㄱ ~ ㅎ, A ~ Z) -->
            <div class="healthcare-alphabet-tabs d-flex flex-wrap justify-content-center gap-1" id="healthcareAlphabetTabs">
                <button type="button" class="btn btn-primary btn-sm healthcare-tab-btn px-3 active" data-alphabet="all">전체</button>
                <div class="w-100 mb-2"></div> <!-- 줄바꿈 -->
                <?php
                $korean_alphabets = array('ㄱ','ㄴ','ㄷ','ㄹ','ㅁ','ㅂ','ㅅ','ㅇ','ㅈ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ');
                foreach($korean_alphabets as $val) {
                    echo '<button type="button" class="btn btn-outline-secondary btn-sm healthcare-tab-btn px-2" data-alphabet="'.$val.'">'.$val.'</button>';
                }
                ?>
                <div class="w-100 mb-2"></div> <!-- 줄바꿈 -->
                <?php
                $english_alphabets = range('A', 'Z');
                foreach($english_alphabets as $val) {
                    echo '<button type="button" class="btn btn-outline-secondary btn-sm healthcare-tab-btn px-2" data-alphabet="'.$val.'">'.$val.'</button>';
                }
                ?>
            </div>
        </div>

        <!-- 결과 리스트 영역 -->
        <div class="healthcare-result-container bg-white p-2 rounded-3 m-4 shadow-sm" style="min-height: 500px;">
            <div class="list-group list-group-flush bg-white" id="healthcareResultList">
                <div class="text-center py-5 text-muted mt-5">
                    <i class="fas fa-spinner fa-spin fa-3x mb-3"></i>
                    <div class="f-s-16">데이터를 불러오는 중입니다...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let healthcareData = [];
    let searchTimer = null;

    // 데이터 로드
    function loadHealthcareData() {
        $.getJSON('<?php echo G5_DATA_URL; ?>/healthcare_dictionary.json', function(data) {
            healthcareData = data;
            displayHealthcareTerms(healthcareData);
        }).fail(function(jqxhr, textStatus, error) {
            $('#healthcareResultList').html('<div class="text-center py-5 text-danger mt-5"><i class="fas fa-exclamation-triangle fa-3x mb-3"></i><div class="f-s-16">의료 사전 데이터를 찾을 수 없거나 형식이 올바르지 않습니다.</div></div>');
        });
    }

    // 한글 초성 추출 함수
    function getConstantVowel(kor) {
        const re = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
        if (!re.test(kor)) return kor.substring(0,1).toUpperCase();
        const f = ['ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'];
        const ga = 44032;
        let uni = kor.charCodeAt(0);
        uni = uni - ga;
        let fn = parseInt(uni / 588);
        return f[fn];
    }

    // 화면 출력 함수
    function displayHealthcareTerms(items) {
        const list = $('#healthcareResultList');
        list.empty();
        
        if (items.length === 0) {
            list.html('<div class="text-center py-5 text-muted mt-5"><i class="far fa-frown fa-3x mb-3"></i><div class="f-s-16">검색 결과가 없습니다.</div></div>');
            return;
        }

        let html = '';
        items.forEach(item => {
            html += `<div class="healthcare-item">
                        <div class="px-4 py-4 hover-bg transition">
                            <span class="healthcare-term font-weight-bold f-s-18 mb-2 d-block"><i class="fas fa-notes-medical m-r-10 small text-primary"></i>${item.term}</span>
                            <p class="healthcare-def text-muted f-s-15 line-h-1-6 mb-0">${item.definition}</p>
                        </div>
                     </div>`;
        });
        list.html(html);
    }

    // 색인 버튼 클릭 이벤트
    $(document).on('click', '.healthcare-tab-btn', function() {
        const alphabet = $(this).data('alphabet');
        $('.healthcare-tab-btn').removeClass('active btn-primary').addClass('btn-outline-secondary');
        $(this).removeClass('btn-outline-secondary').addClass('active btn-primary');
        $('#healthcareSearchInput').val(''); 

        if (alphabet === 'all') {
            displayHealthcareTerms(healthcareData);
        } else {
            const filtered = healthcareData.filter(item => {
                const firstChar = item.term.substring(0, 1);
                const initialChar = getConstantVowel(firstChar);
                return initialChar === alphabet;
            });
            displayHealthcareTerms(filtered);
        }
    });

    // 실시간 검색 이벤트
    $('#healthcareSearchInput').on('input', function() {
        const query = $(this).val().trim().toLowerCase();
        
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            if (!query) {
                const activeTab = $('.healthcare-tab-btn.active').data('alphabet');
                if (activeTab === 'all') {
                    displayHealthcareTerms(healthcareData);
                } else {
                    const filtered = healthcareData.filter(item => {
                        const initialChar = getConstantVowel(item.term.substring(0, 1));
                        return initialChar === activeTab;
                    });
                    displayHealthcareTerms(filtered);
                }
                return;
            }

            const filtered = healthcareData.filter(item => 
                item.term.toLowerCase().indexOf(query) !== -1 || 
                item.definition.toLowerCase().indexOf(query) !== -1
            );
            displayHealthcareTerms(filtered);
        }, 300);
    });

    // 초기 로드 실행
    loadHealthcareData();
});
</script>

<style>
.healthcare-search-box { border-radius: 10px !important; display: flex !important; flex-wrap: nowrap !important; }
.healthcare-search-box #healthcareSearchInput { flex: 1 1 auto !important; min-width: 0; }
.healthcare-app-card { border-radius: 15px; }
.healthcare-item { border-bottom: 1px solid #f1f5f9; }
.hover-bg:hover { background-color: #f0f7ff; }
.healthcare-tab-btn { min-width: 42px; font-weight: 700; border-radius: 8px; transition: 0.2s; font-size: 0.9rem; margin: 3px; }
.healthcare-tab-btn.active { box-shadow: 0 4px 6px -1px rgba(13, 110, 253, 0.3); }
.healthcare-term { padding-left: 0; color: #0d6efd; }
.line-h-1-6 { line-height: 1.6; }
.f-s-15 { font-size: 15px; }
.f-s-16 { font-size: 16px; }
.f-s-18 { font-size: 18px; }
.f-s-24 { font-size: 24px; }
.fw-600 { font-weight: 600; }
.m-r-10 { margin-right: 10px; }
.m-b-30 { margin-bottom: 30px; }
.m-b-50 { margin-bottom: 50px; }
.m-t-30 { margin-top: 30px; }
.transition { transition: all 0.2s ease-in-out; }

/* 다크모드 대응 */
.dark-mode .healthcare-app-card { background-color: #222 !important; }
.dark-mode .bg-light-gray { background-color: #1a1a1a !important; }
.dark-mode .bg-white { background-color: #2a2a2a !important; }
.dark-mode .healthcare-item { border-color: #333 !important; }
.dark-mode .healthcare-item .hover-bg:hover { background-color: #252525 !important; }
.dark-mode .healthcare-term { color: #6fb1ff !important; }
.dark-mode .healthcare-def { color: #aaa !important; }
.dark-mode .btn-outline-secondary { color: #999 !important; border-color: #444 !important; }
.dark-mode .input-group { background-color: #333 !important; border-color: #444 !important; }
.dark-mode .input-group-text { color: #888 !important; }
.dark-mode #healthcareSearchInput { background-color: #333 !important; color: #eee !important; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
