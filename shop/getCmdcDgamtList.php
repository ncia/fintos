<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="cmdc-dgamt-info-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-leaf text-success m-r-10"></i><strong>한방 약가 정보</strong> <span class="text-muted">조회</span></h2>
    </div>

    <!-- 검색 카드 -->
    <div class="dgamt-app-card bg-white border-0 shadow overflow-hidden">
        
        <!-- 검색 섹션 -->
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100">
            <div class="row g-3 align-items-end">
                <div class="col-lg-2 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-filter m-r-5 text-secondary"></i>구분</label>
                    <select id="drugType" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="dgamt">일반 약가</option>
                        <option value="cmdc" selected>한방 약가</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-search m-r-5 text-secondary"></i>품목명</label>
                    <input type="text" id="itmNm" class="form-control border-gray-200 py-2 rounded-3" placeholder="예: 치자엑스산">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-barcode m-r-5 text-secondary"></i>약품코드</label>
                    <input type="text" id="mdsCd" class="form-control border-gray-200 py-2 rounded-3" placeholder="예: 65">
                </div>
                <div class="col-lg-3 col-md-6">
                    <button type="button" id="cmdcSearchBtn" class="btn btn-success w-100 py-2 rounded-3 shadow-sm hover-up f-s-15 fw-bold transition">조회하기</button>
                </div>
            </div>
        </div>

        <!-- 결과 리스트 영역 -->
        <div id="cmdcResultArea" class="px-2 px-md-4 pb-4">
            <div class="text-center py-5">
                <div class="p-5">
                    <i class="fas fa-mortar-pestle fa-4x text-light mb-4 d-block"></i>
                    <h5 class="text-dark fw-bold mb-2">한방 약가 목록을 검색해 보세요!</h5>
                    <p class="text-secondary f-s-14 mb-0">품목명 또는 약품코드를 입력하여 조회하실 수 있습니다.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 페이지네이션 -->
    <div id="cmdcPagination" class="m-t-40"></div>
</div>

<script>
$(document).ready(function() {
    // 구분 변경 시 페이지 이동
    $('#drugType').on('change', function() {
        if ($(this).val() === 'dgamt') {
            location.href = '<?php echo G5_SHOP_URL; ?>/getDgamtList.php';
        }
    });

    function searchCmdcPrice(page = 1) {
        const itmNm = $('#itmNm').val().trim();
        const mdsCd = $('#mdsCd').val().trim();

        if (!itmNm && !mdsCd) {
            alert('하나 이상의 검색 조건을 입력하세요.');
            return;
        }

        $('#cmdcResultArea').html('<div class="text-center py-5 my-5"><div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Loading...</span></div><p class="m-t-20 text-muted f-s-15">데이터를 조회 중입니다...</p></div>');

        $.ajax({
            url: '<?php echo G5_SHOP_URL; ?>/getCmdcDgamtList_api.php',
            type: 'GET',
            data: {
                itmNm: itmNm,
                mdsCd: mdsCd,
                pageNo: page,
                numOfRows: 10
            },
            dataType: 'json',
            success: function(data) {
                renderResults(data, page);
            },
            error: function() {
                $('#cmdcResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4"><i class="fas fa-exclamation-circle fa-2x m-b-15 d-block"></i> 일시적인 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.</div>');
            }
        });
    }

    function renderResults(data, page) {
        let totalCount = 0;
        let items = [];

        if (data && data.response && data.response.body) {
            totalCount = parseInt(data.response.body.totalCount) || 0;
            if (data.response.body.items && data.response.body.items.item) {
                items = data.response.body.items.item;
                if (!Array.isArray(items)) items = [items];
            }
        }

        if (totalCount === 0 || items.length === 0) {
            $('#cmdcResultArea').html('<div class="text-center py-5 my-5"><i class="fas fa-search-minus fa-4x text-light mb-4"></i><h5 class="fw-bold text-dark">일치하는 정보가 없습니다.</h5><p class="text-muted">검색 조건을 변경하여 다시 찾아보세요.</p></div>');
            $('#cmdcPagination').empty();
            return;
        }

        let html = '<div class="table-responsive"><table class="table table-hover dgamt-table mb-0">';
        html += '<thead class="bg-gray-50"><tr class="text-center"><th width="35%">품목명</th><th width="15%">약품코드</th><th width="15%">상한가</th><th width="15%">적용시작일</th><th width="10%">정보</th></tr></thead>';
        html += '<tbody class="f-s-16">';
        
        items.forEach(function(item) {
            const amtFormatted = (item.amt) ? parseInt(item.amt).toLocaleString() + '원' : '-';
            const dateStr = item.adtStaDd || '-';
            const formattedDate = dateStr.length === 8 ? dateStr.substring(0,4)+'.'+dateStr.substring(4,6)+'.'+dateStr.substring(6,8) : dateStr;

            html += '<tr>';
            html += '<td class="fw-bold px-4 text-success">' + (item.itmNm || '-') + '</td>';
            html += '<td class="text-center font-monospace">' + (item.mdsCd || '-') + '</td>';
            html += '<td class="text-end fw-600 text-dark">' + amtFormatted + '</td>';
            html += '<td class="text-center text-secondary">' + formattedDate + '</td>';
            html += `<td class="text-center"><button class="btn btn-xs btn-outline-success rounded-pill" onclick="alert('규격: ${item.unit || "-"}\\n성분명: ${item.cpntNm || "-"}')">상세</button></td>`;
            html += '</tr>';
        });
        
        html += '</tbody></table></div>';
        
        $('#cmdcResultArea').html(html);
        renderPagination(totalCount, page);
    }

    function renderPagination(totalCount, page) {
        const totalPages = Math.ceil(totalCount / 10);
        if (totalPages <= 1) {
            $('#cmdcPagination').empty();
            return;
        }
        let paginationHtml = '<ul class="pagination pagination-modern justify-content-center">';
        for (let i = Math.max(1, page - 2); i <= Math.min(totalPages, page + 2); i++) {
            paginationHtml += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
        }
        paginationHtml += '</ul>';
        $('#cmdcPagination').html(paginationHtml);
    }

    $('#cmdcSearchBtn').on('click', function() { searchCmdcPrice(1); });
    $('#itmNm, #mdsCd').on('keypress', function(e) { if (e.which === 13) searchCmdcPrice(1); });
    $(document).on('click', '#cmdcPagination .page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page) searchCmdcPrice(page);
    });
});
</script>

<style>
.dgamt-app-card { border-radius: 15px; }
.b-b-gray-100 { border-bottom: 1px solid #f1f5f9; }
.bg-gray-50 { background-color: #f8fafc; }
.dgamt-table th { padding: 20px 10px; font-size: 15px; color: #64748b; font-weight: 700; border-bottom: 2px solid #f1f5f9; white-space: nowrap; }
.dgamt-table td { vertical-align: middle; padding: 18px 15px; border-bottom: 1px solid #f1f5f9; word-break: keep-all; }
.dgamt-table tbody tr:hover { background-color: #f0fff4; }
.btn-xs { padding: 0.1rem 0.5rem; font-size: 0.75rem; }
.pagination-modern .page-link { border: 1px solid #eaeff5; margin: 0 5px; min-width: 40px; text-align: center; border-radius: 8px; color: #475569; font-weight: 600; padding: 10px; transition: all 0.2s; }
.pagination-modern .page-item.active .page-link { background-color: #198754; color: #fff; border-color: #198754; }
.hover-up:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
.f-s-15 { font-size: 15px; }
.f-s-16 { font-size: 16px; }
.f-s-24 { font-size: 24px; }
.fw-600 { font-weight: 600; }
.text-light { color: #f1f5f9 !important; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
