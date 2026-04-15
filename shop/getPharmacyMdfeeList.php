<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="mdfee-info-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-file-invoice-dollar text-info m-r-10"></i><strong>약국 수가 정보</strong> <span class="text-muted">조회</span></h2>
    </div>

    <!-- 검색 카드 -->
    <div class="mdfee-app-card bg-white border-0 shadow overflow-hidden">
        
        <!-- 검색 섹션 -->
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100">
            <div class="row g-3 align-items-end">
                <div class="col-lg-2 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-filter m-r-5 text-secondary"></i>수가 구분</label>
                    <select id="mdfeeTypeChoice" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="pharmacy" selected>약국 수가</option>
                        <option value="cmdc">한방 수가</option>
                        <option value="diagnosis">진료 수가</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-search m-r-5 text-secondary"></i>수가 한글명</label>
                    <input type="text" id="korNm" class="form-control border-gray-200 py-2 rounded-3" placeholder="예: 지도, 관리료">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-barcode m-r-5 text-secondary"></i>수가 코드</label>
                    <input type="text" id="mdfeeCd" class="form-control border-gray-200 py-2 rounded-3" placeholder="예: Z3000030">
                </div>
                <div class="col-lg-3 col-md-8">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-folder-open m-r-5 text-secondary"></i>분류번호</label>
                    <input type="text" id="mdfeeDivNo" class="form-control border-gray-200 py-2 rounded-3" placeholder="예: 약">
                </div>
                <div class="col-lg-2 col-md-4">
                    <button type="button" id="mdfeeSearchBtn" class="btn btn-info w-100 py-2 rounded-3 shadow-sm hover-up f-s-15 fw-bold transition text-white">조회하기</button>
                </div>
            </div>
        </div>

        <!-- 결과 리스트 영역 -->
        <div id="mdfeeResultArea" class="px-2 px-md-4 pb-4">
            <div class="text-center py-5">
                <div class="p-5">
                    <i class="fas fa-file-invoice fa-4x text-light mb-4 d-block"></i>
                    <h5 class="text-dark fw-bold mb-2">약국 수가 정보를 검색해 보세요!</h5>
                    <p class="text-secondary f-s-14 mb-0">수가 한글명, 코드 또는 분류번호를 입력하시거나 조합하여 조회 가능합니다.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 페이지네이션 -->
    <div id="mdfeePagination" class="m-t-40"></div>
</div>

<!-- 수가 상세 정보 모달 -->
<div class="modal fade" id="mdfeeDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-info text-white border-0 py-3">
                <h5 class="modal-title fw-600"><i class="fas fa-file-invoice-dollar m-r-10"></i>수가 상세 정보</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light-soft">
                <div class="bg-white rounded-3 shadow-sm overflow-hidden scale-up">
                    <table class="table detail-modal-table mb-0">
                        <colgroup>
                            <col width="35%"><col width="65%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="bg-gray-50 border-bottom-0">수가 한글명</th>
                                <td id="modal_korNm" class="fw-bold text-info border-bottom-0">-</td>
                            </tr>
                            <tr>
                                <th class="bg-gray-50 border-bottom-0">수가 영문명</th>
                                <td id="modal_engNm" class="text-secondary border-bottom-0">-</td>
                            </tr>
                            <tr>
                                <th class="bg-gray-50 border-bottom-0">수가 코드</th>
                                <td id="modal_mdfeeCd" class="font-monospace fw-600 text-dark-blue border-bottom-0">-</td>
                            </tr>
                            <tr>
                                <th class="bg-gray-50 border-bottom-0">분류번호</th>
                                <td id="modal_mdfeeDivNo" class="border-bottom-0">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 py-2">
                <button type="button" class="btn btn-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // 구분 변경 시 페이지 이동
    $('#mdfeeTypeChoice').on('change', function() {
        const val = $(this).val();
        if (val === 'cmdc') {
            location.href = '<?php echo G5_SHOP_URL; ?>/getCmdcMdfeeList.php';
        } else if (val === 'diagnosis') {
            location.href = '<?php echo G5_SHOP_URL; ?>/getDiagnossMdfeeList.php';
        }
    });

    function searchMdfee(page = 1) {
        const korNm = $('#korNm').val().trim();
        const mdfeeCd = $('#mdfeeCd').val().trim().toUpperCase();
        const mdfeeDivNo = $('#mdfeeDivNo').val().trim();
        const mdfeeType = $('#mdfeeTypeChoice').val();

        if (!mdfeeType) {
            alert('수가 구분을 선택하세요.');
            return;
        }

        if (!korNm && !mdfeeCd && !mdfeeDivNo) {
            alert('하나 이상의 검색 조건을 입력하세요.');
            return;
        }

        $('#mdfeeResultArea').html('<div class="text-center py-5 my-5"><div class="spinner-border text-info" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Loading...</span></div><p class="m-t-20 text-muted f-s-15">데이터를 조회 중입니다...</p></div>');

        $.ajax({
            url: '<?php echo G5_SHOP_URL; ?>/getPharmacyMdfeeList_api.php',
            type: 'GET',
            data: {
                korNm: korNm,
                mdfeeCd: mdfeeCd,
                mdfeeDivNo: mdfeeDivNo,
                pageNo: page,
                numOfRows: 20
            },
            dataType: 'json',
            success: function(data) {
                if (data && data.error) {
                    $('#mdfeeResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4"><i class="fas fa-exclamation-triangle fa-2x m-b-15 d-block"></i> API 오류: ' + data.error + '</div>');
                    return;
                }
                renderResults(data, page);
            },
            error: function() {
                $('#mdfeeResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4"><i class="fas fa-exclamation-circle fa-2x m-b-15 d-block"></i> 일시적인 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.</div>');
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
        } else if (data && data.body) { // alternative path
            totalCount = parseInt(data.body.totalCount) || 0;
            if (data.body.items && data.body.items.item) {
                items = data.body.items.item;
                if (!Array.isArray(items)) items = [items];
            }
        }

        if (totalCount === 0 || items.length === 0) {
            $('#mdfeeResultArea').html('<div class="text-center py-5 my-5"><i class="fas fa-search-minus fa-4x text-light mb-4"></i><h5 class="fw-bold text-dark">일치하는 수가 정보가 없습니다.</h5><p class="text-muted">검색 조건을 변경하여 다시 찾아보세요.</p></div>');
            $('#mdfeePagination').empty();
            return;
        }

        let html = '<div class="table-responsive"><table class="table table-hover mdfee-table mb-0">';
        html += '<thead class="bg-gray-50"><tr class="text-center"><th width="15%">수가 코드</th><th width="15%">분류번호</th><th width="60%">수가 한글명</th><th width="10%">상세</th></tr></thead>';
        html += '<tbody class="f-s-16">';
        
        items.forEach(function(item) {
            const displayName = item.korNm || item.itmNm || item.korName || '-';
            const displayCode = item.mdfeeCd || '-';
            const displayDiv = item.mdfeeDivNo || '-';
            const itemData = JSON.stringify(item).replace(/'/g, "&apos;");
            
            html += '<tr>';
            html += '<td class="text-center font-monospace fw-600 text-info">' + displayCode + '</td>';
            html += '<td class="text-center">' + displayDiv + '</td>';
            html += '<td class="text-start px-4">' + displayName + '</td>';
            html += `<td class="text-center"><button class="btn btn-xs btn-outline-info rounded-pill detail-btn" data-item='${itemData}'>보기</button></td>`;
            html += '</tr>';
        });
        
        html += '</tbody></table></div>';
        
        $('#mdfeeResultArea').html(html);
        renderPagination(totalCount, page);
        
        if (page > 1) {
            $('html, body').animate({scrollTop: $(".mdfee-app-card").offset().top - 20}, 300);
        }
    }

    function renderPagination(totalCount, page) {
        const totalPages = Math.ceil(totalCount / 20);
        if (totalPages <= 1) {
            $('#mdfeePagination').empty();
            return;
        }
        let paginationHtml = '<ul class="pagination pagination-modern justify-content-center">';
        for (let i = Math.max(1, page - 2); i <= Math.min(totalPages, page + 2); i++) {
            paginationHtml += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
        }
        paginationHtml += '</ul>';
        $('#mdfeePagination').html(paginationHtml);
    }

    $('#mdfeeSearchBtn').on('click', function() { searchMdfee(1); });
    $('#korNm, #mdfeeCd, #mdfeeDivNo').on('keypress', function(e) { if (e.which === 13) searchMdfee(1); });
    $(document).on('click', '#mdfeePagination .page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page) searchMdfee(page);
    });

    $(document).on('click', '.detail-btn', function() {
        const item = $(this).data('item');
        $('#modal_korNm').text(item.korNm || item.itmNm || item.korName || '-');
        $('#modal_engNm').text(item.engNm || '-');
        $('#modal_mdfeeCd').text(item.mdfeeCd || '-');
        $('#modal_mdfeeDivNo').text(item.mdfeeDivNo || '-');
        $('#mdfeeDetailModal').modal('show');
    });
});
</script>

<style>
.mdfee-app-card { border-radius: 15px; }
.b-b-gray-100 { border-bottom: 1px solid #f1f5f9; }
.bg-gray-50 { background-color: #f8fafc; }
.mdfee-table th { padding: 20px 10px; font-size: 15px; color: #64748b; font-weight: 700; border-bottom: 2px solid #f1f5f9; white-space: nowrap; }
.mdfee-table td { vertical-align: middle; padding: 18px 15px; border-bottom: 1px solid #f1f5f9; word-break: keep-all; }
.mdfee-table tbody tr:hover { background-color: #f0fbff; }
.btn-outline-info { border-color: #0dcaf0; color: #0dcaf0; }
.btn-outline-info:hover { background-color: #0dcaf0; color: #fff; }
.pagination-modern .page-link { border: 1px solid #eaeff5; margin: 0 5px; min-width: 40px; text-align: center; border-radius: 8px; color: #475569; font-weight: 600; padding: 10px; transition: all 0.2s; }
.pagination-modern .page-item.active .page-link { background-color: #0dcaf0; color: #fff; border-color: #0dcaf0; }
.f-s-14 { font-size: 14px; }
.f-s-15 { font-size: 15px; }
.f-s-16 { font-size: 16px; }
.f-s-24 { font-size: 24px; }
.fw-500 { font-weight: 500; }
.fw-600 { font-weight: 600; }
.text-light { color: #f1f5f9 !important; }
.bg-light-soft { background-color: #fcfdfe; }
.detail-modal-table th { background-color: #f8fafc; font-size: 14px; font-weight: 700; color: #475569; vertical-align: middle; text-align: center; border-bottom: 1px solid #f1f5f9; padding: 15px 10px; }
.detail-modal-table td { font-size: 15px; color: #334155; vertical-align: middle; padding: 15px 20px; border-bottom: 1px solid #f1f5f9; }
.text-dark-blue { color: #1e293b; }
.scale-up { transition: all 0.2s ease-in-out; }
.scale-up:hover { transform: scale(1.01); }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
