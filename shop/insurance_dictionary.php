<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="insu-dictionary-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-book-medical text-info m-r-10"></i><strong>보험 용어</strong> <span class="text-muted">사전</span></h2>
    </div>

    <!-- 사전 카드 -->
    <div class="insu-app-card bg-white border-0 shadow overflow-hidden">
        
        <!-- 검색 및 카테고리 섹션 -->
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100 bg-light-gray" style="background-color: #f8f9fa;">
            <!-- 검색창 -->
            <div class="eyoom-form mb-4">
                <div class="input-group shadow-sm border rounded bg-white overflow-hidden dic-search-box">
                    <span class="input-group-text bg-transparent border-0 px-3"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" id="dicSearchInput" class="form-control border-0 py-2 f-s-15" placeholder="궁금하신 보험 용어를 입력하세요 (예: 가재도구, 보험금)" autocomplete="off">
                </div>
            </div>

            <!-- 자음 버튼 (ㄱ ~ 기타) -->
            <div class="dic-alphabet-tabs d-flex flex-wrap justify-content-center gap-1" id="dicAlphabetTabs">
                <button type="button" class="btn btn-primary btn-sm dic-tab-btn px-3 active" data-alphabet="all">전체</button>
                <?php
                $alphabets = array('ㄱ','ㄴ','ㄷ','ㄹ','ㅁ','ㅂ','ㅅ','ㅇ','ㅈ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ','기타');
                foreach($alphabets as $val) {
                    echo '<button type="button" class="btn btn-outline-secondary btn-sm dic-tab-btn px-2" data-alphabet="'.$val.'">'.$val.'</button>';
                }
                ?>
            </div>
        </div>

        <!-- 결과 리스트 영역 -->
        <div class="dic-result-container bg-white p-2 rounded-3 m-4 shadow-sm" style="min-height: 500px;">
            <div class="list-group list-group-flush bg-white" id="dicResultList">
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
    let insuranceData = [];
    let dicSearchTimer = null;

    // 데이터 로드
    function loadDictionaryData() {
        $.getJSON('<?php echo G5_DATA_URL; ?>/insurance_dictionary.json', function(data) {
            insuranceData = data;
            displayTerms(insuranceData);
        }).fail(function(jqxhr, textStatus, error) {
            $('#dicResultList').html('<div class="text-center py-5 text-danger mt-5"><i class="fas fa-exclamation-triangle fa-3x mb-3"></i><div class="f-s-16">데이터 로드 실패: ' + error + '</div></div>');
        });
    }

    // 화면 출력 함수
    function displayTerms(items) {
        const list = $('#dicResultList');
        list.empty();
        
        if (items.length === 0) {
            list.html('<div class="text-center py-5 text-muted mt-5"><i class="far fa-frown fa-3x mb-3"></i><div class="f-s-16">검색 결과가 없습니다.</div></div>');
            return;
        }

        let html = '';
        items.forEach(item => {
            html += `<div class="dic-item">
                        <div class="px-4 py-4 hover-bg transition">
                            <span class="dic-term font-weight-bold f-s-18 mb-2 d-block"><i class="fas fa-angle-right m-r-10 small"></i>${item.term}</span>
                            <p class="dic-def text-muted f-s-15 line-h-1-6 mb-0">${item.definition}</p>
                        </div>
                     </div>`;
        });
        list.html(html);
    }

    // 초성 버튼 클릭 이벤트
    $(document).on('click', '.dic-tab-btn', function() {
        const alphabet = $(this).data('alphabet');
        $('.dic-tab-btn').removeClass('active btn-primary').addClass('btn-outline-secondary');
        $(this).removeClass('btn-outline-secondary').addClass('active btn-primary');
        $('#dicSearchInput').val(''); 

        if (alphabet === 'all') {
            displayTerms(insuranceData);
        } else {
            const filtered = insuranceData.filter(item => item.category === alphabet);
            displayTerms(filtered);
        }
    });

    // 실시간 검색 이벤트
    $('#dicSearchInput').on('input', function() {
        const query = $(this).val().trim().toLowerCase();
        
        clearTimeout(dicSearchTimer);
        dicSearchTimer = setTimeout(function() {
            if (!query) {
                const activeTab = $('.dic-tab-btn.active').data('alphabet');
                if (activeTab === 'all') {
                    displayTerms(insuranceData);
                } else {
                    const filtered = insuranceData.filter(item => item.category === activeTab);
                    displayTerms(filtered);
                }
                return;
            }

            const filtered = insuranceData.filter(item => 
                item.term.toLowerCase().indexOf(query) !== -1 || 
                item.definition.toLowerCase().indexOf(query) !== -1
            );
            displayTerms(filtered);
        }, 300);
    });

    // 초기 로드 실행
    loadDictionaryData();
});
</script>

<style>
.dic-search-box { border-radius: 10px !important; display: flex !important; flex-wrap: nowrap !important; }
.dic-search-box #dicSearchInput { flex: 1 1 auto !important; min-width: 0; }
.insu-app-card { border-radius: 15px; }
.dic-item { border-bottom: 1px solid #f1f5f9; }
.hover-bg:hover { background-color: #f8fbff; }
.dic-tab-btn { min-width: 42px; font-weight: 700; border-radius: 8px; transition: 0.2s; font-size: 0.9rem; margin: 3px; }
.dic-tab-btn.active { box-shadow: 0 4px 6px -1px rgba(13, 110, 253, 0.3); }
.dic-term { padding-left: 0; color: #1e3a8a; }
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
.dark-mode .insu-app-card { background-color: #222 !important; }
.dark-mode .bg-light-gray { background-color: #1a1a1a !important; }
.dark-mode .bg-white { background-color: #2a2a2a !important; }
.dark-mode .dic-item { border-color: #333 !important; }
.dark-mode .dic-item .hover-bg:hover { background-color: #252525 !important; }
.dark-mode .dic-term { color: #6fb1ff !important; }
.dark-mode .dic-def { color: #aaa !important; }
.dark-mode .btn-outline-secondary { color: #999 !important; border-color: #444 !important; }
.dark-mode .input-group { background-color: #333 !important; border-color: #444 !important; }
.dark-mode .input-group-text { color: #888 !important; }
.dark-mode #dicSearchInput { background-color: #333 !important; color: #eee !important; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
