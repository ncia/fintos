<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="disease-code-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-search text-primary m-r-10"></i><strong>상병 코드</strong> <span class="text-muted">조회</span></h2>
    </div>

    <!-- 검색 및 결과 카드 -->
    <div class="disease-app-card bg-white border-0 shadow overflow-hidden">
        
        <!-- 검색 섹션 -->
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100">
            <div class="row g-3 align-items-end">
                <div class="col-md-10">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-search m-r-5 text-secondary"></i>상병 코드 또는 상병명</label>
                    <input type="text" id="diseaseSearchText" class="form-control border-gray-200 py-2 rounded-3" placeholder="상병 코드 또는 상병명을 입력하세요 (예: J06, 감기)">
                </div>
                <div class="col-md-2">
                    <button type="button" id="diseaseSearchBtn" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm hover-up f-s-15 fw-bold transition">조회하기</button>
                </div>
            </div>
        </div>

        <!-- 결과 리스트 영역 -->
        <div id="diseaseResultArea" class="px-2 px-md-4 pb-4">
            <div class="text-center py-5">
                <div class="p-5">
                    <i class="fas fa-notes-medical fa-4x text-light mb-4 d-block"></i>
                    <h5 class="text-dark fw-bold mb-2">상병 코드를 검색해 보세요!</h5>
                    <p class="text-secondary f-s-14 mb-0">상병 코드(예: J06) 또는 상병명(예: 감기)을 입력해 주세요.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 페이지네이션 -->
    <div id="diseasePagination" class="m-t-40"></div>
</div>

<script>
$(document).ready(function() {
    let diseaseSearchTimer = null;

    function searchDiseaseCode(page = 1) {
        const searchText = $('#diseaseSearchText').val().trim();
        if (!searchText) {
            $('#diseaseResultArea').html('<div class="text-center py-5 my-5"><i class="fas fa-info-circle fa-4x text-light mb-4"></i><h5 class="fw-bold text-dark">검색어를 입력해 주세요.</h5></div>');
            $('#diseasePagination').empty();
            return;
        }

        let diseaseType = 'SICK_NM';
        if (/^[a-zA-Z]/.test(searchText)) {
            diseaseType = 'SICK_CD';
        }

        $('#diseaseResultArea').html('<div class="text-center py-5 my-5"><div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Loading...</span></div><p class="m-t-20 text-muted f-s-15">상병 코드를 조회 중입니다...</p></div>');

        $.ajax({
            url: '<?php echo G5_SHOP_URL; ?>/disease_api.php',
            type: 'GET',
            cache: false,
            data: {
                diseaseType: diseaseType,
                searchText: searchText,
                pageNo: page,
                numOfRows: 20,
                sickType: '1',
                medTp: '1'
            },
            dataType: 'json',
            success: function(res) {
                renderResults(res, page);
            },
            error: function(xhr, status, error) {
                $('#diseaseResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4"><i class="fas fa-exclamation-circle fa-2x m-b-15 d-block"></i> 일시적인 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.</div>');
            }
        });
    }

    function renderResults(res, page) {
        let totalCount = 0;
        let itemsData = null;

        if (res && res.response && res.response.body) {
            totalCount = parseInt(res.response.body.totalCount || 0);
            if (res.response.body.items) {
                itemsData = res.response.body.items.item;
            }
        } else if (res && res.body) {
            totalCount = parseInt(res.body.totalCount || 0);
            if (res.body.items) {
                itemsData = res.body.items.item;
            }
        }

        if (totalCount === 0 || !itemsData) {
            $('#diseaseResultArea').html('<div class="text-center py-5 my-5"><i class="fas fa-search-minus fa-4x text-light mb-4"></i><h5 class="fw-bold text-dark">일치하는 결과가 없습니다.</h5><p class="text-muted">검색어를 변경하여 다시 찾아보세요.</p></div>');
            $('#diseasePagination').empty();
            return;
        }

        let items = Array.isArray(itemsData) ? itemsData : [itemsData];

        let html = '<div class="table-responsive"><table class="table table-hover disease-table mb-0">';
        html += '<thead class="bg-gray-50"><tr class="text-center"><th width="15%">상병코드</th><th width="45%">상병명</th><th width="40%">상병명(영문)</th></tr></thead>';
        html += '<tbody class="f-s-16">';
        
        items.forEach(function(item) {
            const sickCd = typeof item.sickCd === 'object' ? '' : (item.sickCd || '');
            const sickNm = typeof item.sickNm === 'object' ? '' : (item.sickNm || '');
            const sickEnm = typeof item.sickEngNm === 'object' ? '' : (item.sickEngNm || '');

            html += '<tr>';
            html += '<td class="text-center fw-bold text-primary font-monospace">' + sickCd + '</td>';
            html += '<td class="text-start px-4">' + sickNm + '</td>';
            html += '<td class="text-start px-4 text-secondary">' + sickEnm + '</td>';
            html += '</tr>';
        });
        
        html += '</tbody></table></div>';
        
        $('#diseaseResultArea').html(html);
        renderPagination(totalCount, page);
        
        if (page > 1) {
            $('html, body').animate({scrollTop: $(".disease-app-card").offset().top - 20}, 300);
        }
    }

    function renderPagination(totalCount, page) {
        const totalPages = Math.ceil(totalCount / 20);
        if (totalPages <= 1) {
            $('#diseasePagination').empty();
            return;
        }
        
        let paginationHtml = '<ul class="pagination pagination-modern justify-content-center">';
        const startPage = Math.max(1, page - 2);
        const endPage = Math.min(totalPages, page + 2);

        if (page > 1) {
            paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${page - 1}"><i class="fas fa-chevron-left f-s-12"></i></a></li>`;
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationHtml += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
        }

        if (page < totalPages) {
            paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${page + 1}"><i class="fas fa-chevron-right f-s-12"></i></a></li>`;
        }
        
        paginationHtml += '</ul>';
        $('#diseasePagination').html(paginationHtml);
    }

    $('#diseaseSearchBtn').on('click', function() {
        searchDiseaseCode(1);
    });

    $('#diseaseSearchText').on('keypress', function(e) {
        if (e.which === 13) {
            searchDiseaseCode(1);
        }
    });

    $(document).on('click', '#diseasePagination .page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page) searchDiseaseCode(page);
    });

    // 실시간 검색 (선택 사항 - 모달에 있던 로직)
    /*
    $('#diseaseSearchText').on('input', function() {
        clearTimeout(diseaseSearchTimer);
        diseaseSearchTimer = setTimeout(function() {
            searchDiseaseCode(1);
        }, 500);
    });
    */
});
</script>

<style>
.disease-app-card { border-radius: 12px; }
.b-b-gray-100 { border-bottom: 1px solid #f1f5f9; }
.bg-gray-50 { background-color: #f8fafc; }
.disease-table th { padding: 20px 10px; font-size: 15px; color: #64748b; font-weight: 700; border-bottom: 2px solid #f1f5f9; white-space: nowrap; }
.disease-table td { vertical-align: middle; padding: 18px 15px; border-bottom: 1px solid #f1f5f9; word-break: keep-all; overflow-wrap: break-word; }
.disease-table tbody tr:hover { background-color: #f0f7ff; }
.disease-table tbody tr:last-child td { border-bottom: 0; }
.f-s-12 { font-size: 12px; }
.f-s-14 { font-size: 14px; }
.f-s-15 { font-size: 15px; }
.f-s-16 { font-size: 16px; }
.f-s-24 { font-size: 24px; }
.fw-600 { font-weight: 600; }
.m-r-5 { margin-right: 5px; }
.m-r-10 { margin-right: 10px; }
.m-b-30 { margin-bottom: 30px; }
.m-b-50 { margin-bottom: 50px; }
.m-t-20 { margin-top: 20px; }
.m-t-30 { margin-top: 30px; }
.m-t-40 { margin-top: 40px; }
.hover-up:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
.pagination-modern .page-link { border: 1px solid #eaeff5; margin: 0 5px; min-width: 40px; text-align: center; border-radius: 8px; color: #475569; font-weight: 600; padding: 10px; transition: all 0.2s; box-shadow: none; }
.pagination-modern .page-item.active .page-link { background-color: #2563eb; color: #fff; border-color: #2563eb; }
.pagination-modern .page-link:hover:not(.active) { background-color: #f1f5f9; border-color: #e2e8f0; }
.alert-soft-danger { background-color: #fef2f2; border: 1px solid #fee2e2; color: #991b1b; border-radius: 12px; }
.text-light { color: #f1f5f9 !important; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
