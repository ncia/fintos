<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="surgery-search-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-search-plus text-success m-r-10"></i><strong>1-8종 수술명</strong> <span class="text-muted">검색</span></h2>
    </div>

    <!-- 검색 카드 -->
    <div class="surgery-app-card bg-white border-0 shadow overflow-hidden">
        
        <!-- 검색 섹션 -->
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100">
            <div class="row g-3 align-items-end">
                <div class="col-lg-2 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-filter m-r-5 text-secondary"></i>수술명 구분</label>
                    <select id="surgeryMode" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="all">전체 보기</option>
                        <option value="1-3/1-5">1-3/1-5종 수술</option>
                        <option value="1-7">1-7종 수술</option>
                        <option value="1-8" selected>1-8종 수술</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-search m-r-5 text-secondary"></i>수술명</label>
                    <input type="text" id="surgeryName" class="form-control border-gray-200 py-2 rounded-3" placeholder="예: 암, 이식">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-barcode m-r-5 text-secondary"></i>코드</label>
                    <input type="text" id="surgeryCode" class="form-control border-gray-200 py-2 rounded-3" placeholder="예: A010">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-list m-r-5 text-secondary"></i>종류</label>
                    <select id="typeSelect" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="">전체</option>
                        <option value="1">1종</option>
                        <option value="2">2종</option>
                        <option value="3">3종</option>
                        <option value="4">4종</option>
                        <option value="5">5종</option>
                        <option value="6">6종</option>
                        <option value="7">7종</option>
                        <option value="8">8종</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <button type="button" id="surgerySearchBtn" class="btn btn-success w-100 py-2 rounded-3 shadow-sm hover-up f-s-15 fw-bold transition text-white">조회하기</button>
                </div>
            </div>
        </div>

        <!-- 결과 리스트 영역 -->
        <div id="surgeryResultArea" class="px-2 px-md-4 pb-4">
            <div class="text-center py-5">
                <div class="p-5">
                    <i class="fas fa-notes-medical fa-4x text-light mb-4 d-block"></i>
                    <h5 class="text-dark fw-bold mb-2">1-8종 수술 정보를 검색해 보세요!</h5>
                    <p class="text-secondary f-s-14 mb-0">수술명, 코드, 종류를 입력 및 선택하여 상세 정보를 확인할 수 있습니다.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 페이지네이션 -->
    <div id="surgeryPagination" class="m-t-40"></div>
</div>

<script>
$(document).ready(function() {
    function searchSurgery(page = 1) {
        const q = $('#surgeryName').val().trim();
        const code = $('#surgeryCode').val().trim();
        const type = $('#typeSelect').val();

        $('#surgeryResultArea').html('<div class="text-center py-5 my-5"><div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Loading...</span></div><p class="m-t-20 text-muted f-s-15">데이터를 조회 중입니다...</p></div>');

        $.ajax({
            url: '<?php echo G5_SHOP_URL; ?>/surgery_1_8_search_api.php',
            type: 'GET',
            data: {
                q: q,
                code: code,
                type: type,
                page: page
            },
            dataType: 'json',
            success: function(data) {
                if (data && data.error) {
                    $('#surgeryResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4">' + data.error + '</div>');
                    return;
                }
                renderResults(data, page);
            },
            error: function() {
                $('#surgeryResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4">오류가 발생했습니다.</div>');
            }
        });
    }

    function renderResults(data, page) {
        const total = data.total || 0;
        const items = data.items || [];

        if (total === 0) {
            $('#surgeryResultArea').html('<div class="text-center py-5 my-5"><i class="fas fa-search-minus fa-4x text-light mb-4"></i><h5 class="fw-bold text-dark">일치하는 수술 정보가 없습니다.</h5><p class="text-muted">검색 조건을 변경해 보세요.</p></div>');
            $('#surgeryPagination').empty();
            return;
        }

        let html = '<div class="table-responsive"><table class="table table-hover surgery-table mb-0">';
        html += '<thead class="bg-gray-50"><tr class="text-center"><th>수술명</th><th>코드</th><th>종류</th></tr></thead>';
        html += '<tbody class="f-s-16">';
        
        items.forEach(function(item) {
            html += '<tr>';
            html += '<td class="px-4 fw-600">' + item.name + '</td>';
            html += '<td class="text-center"><span class="fw-bold text-secondary">' + item.code + '</span></td>';
            html += '<td class="text-center"><span class="badge ' + getBadgeClass(item.type) + '">' + item.type + '종</span></td>';
            html += '</tr>';
        });
        
        html += '</tbody></table></div>';
        
        $('#surgeryResultArea').html(html);
        renderPagination(total, page);
    }

    function getBadgeClass(type) {
        if (type == '1') return 'badge-type-1';
        if (type == '2') return 'badge-type-2';
        if (type == '3') return 'badge-type-3';
        if (type == '4') return 'badge-type-4';
        if (type == '5') return 'badge-type-5';
        if (type == '6') return 'bg-warning text-dark';
        if (type == '7') return 'bg-danger text-white';
        if (type == '8') return 'bg-dark text-white';
        return 'badge-type-none';
    }

    function renderPagination(total, page) {
        const totalPages = Math.ceil(total / 20);
        if (totalPages <= 1) {
            $('#surgeryPagination').empty();
            return;
        }
        let html = '<ul class="pagination pagination-modern justify-content-center">';
        for (let i = Math.max(1, page - 2); i <= Math.min(totalPages, page + 2); i++) {
            html += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
        }
        html += '</ul>';
        $('#surgeryPagination').html(html);
    }

    $('#surgerySearchBtn').on('click', function() { searchSurgery(1); });
    $('#surgeryName, #surgeryCode').on('keypress', function(e) { if (e.which === 13) searchSurgery(1); });
    $(document).on('click', '#surgeryPagination .page-link', function(e) {
        e.preventDefault();
        searchSurgery($(this).data('page'));
    });
    
    $('#surgeryMode').on('change', function() {
        if ($(this).val() === '1-7') {
            window.location.href = '<?php echo G5_SHOP_URL; ?>/surgery_1_7_search.php';
        } else if ($(this).val() !== '1-8') {
            window.location.href = '<?php echo G5_SHOP_URL; ?>/surgery_1_3_1_5_search.php';
        }
    });

    // 초기 검색 실행
    searchSurgery(1);
});
</script>

<style>
.surgery-app-card { border-radius: 15px; }
.b-b-gray-100 { border-bottom: 1px solid #f1f5f9; }
.bg-gray-50 { background-color: #f8fafc; }
.surgery-table th { padding: 20px 10px; font-size: 15px; color: #64748b; font-weight: 700; border-bottom: 2px solid #f1f5f9; }
.surgery-table td { vertical-align: middle; padding: 18px 15px; border-bottom: 1px solid #f1f5f9; }
.surgery-table tbody tr:hover { background-color: #f0fbff; }
.pagination-modern .page-link { border: 1px solid #eaeff5; margin: 0 5px; min-width: 40px; text-align: center; border-radius: 8px; color: #475569; font-weight: 600; padding: 10px; transition: all 0.2s; }
.pagination-modern .page-item.active .page-link { background-color: #198754; color: #fff; border-color: #198754; }
.f-s-14 { font-size: 14px; }
.f-s-15 { font-size: 15px; }
.f-s-16 { font-size: 16px; }
.f-s-24 { font-size: 24px; }
.fw-600 { font-weight: 600; }
.text-light { color: #f1f5f9 !important; }
.badge { font-weight: 600; font-size: 13px; padding: 0.6em 1em; border-radius: 50px; }
.badge-type-1 { background-color: #e0f2fe; color: #0369a1; }
.badge-type-2 { background-color: #dcfce7; color: #15803d; }
.badge-type-3 { background-color: #fef9c3; color: #a16207; }
.badge-type-4 { background-color: #ffedd5; color: #c2410c; }
.badge-type-5 { background-color: #fee2e2; color: #b91c1c; }
.badge-type-none { background-color: #f1f5f9; color: #475569; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
