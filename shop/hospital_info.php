<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="hospital-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-hospital-symbol text-primary m-r-10"></i><strong>전국 병원 정보</strong> <span class="text-muted">조회</span></h2>
    </div>

    <!-- 검색 카드 -->
    <div class="hospital-app-card bg-white border-0 shadow overflow-hidden">
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100">
            <div class="row g-3 align-items-end">
                <!-- 지역 선택: 시/도 -->
                <div class="col-lg-2 col-md-4">
                    <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i class="fas fa-map-marker-alt m-r-5 text-secondary"></i>시/도</label>
                    <select id="sidoCd" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="">전국전체</option>
                        <option value="서울특별시">서울특별시</option>
                        <option value="부산광역시">부산광역시</option>
                        <option value="대구광역시">대구광역시</option>
                        <option value="인천광역시">인천광역시</option>
                        <option value="광주광역시">광주광역시</option>
                        <option value="대전광역시">대전광역시</option>
                        <option value="울산광역시">울산광역시</option>
                        <option value="세종특별자치시">세종특별자치시</option>
                        <option value="경기도">경기도</option>
                        <option value="강원도">강원도</option>
                        <option value="충청북도">충청북도</option>
                        <option value="충청남도">충청남도</option>
                        <option value="전라북도">전라북도</option>
                        <option value="전라남도">전라남도</option>
                        <option value="경상북도">경상북도</option>
                        <option value="경상남도">경상남도</option>
                        <option value="제주특별자치도">제주특별자치도</option>
                    </select>
                </div>
                
                <!-- 지역 선택: 시/군/구 -->
                <div class="col-lg-2 col-md-4">
                    <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i class="fas fa-map-marked m-r-5 text-secondary"></i>시/군/구</label>
                    <select id="gugunCd" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="">시/군/구 전체</option>
                    </select>
                </div>

                <!-- 병원 구분 -->
                <div class="col-lg-2 col-md-4">
                    <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i class="fas fa-hospital m-r-5 text-secondary"></i>병원 구분</label>
                    <select id="hospitalType" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="">모든 병원</option>
                        <option value="종합병원">종합병원</option>
                        <option value="병원">병원</option>
                        <option value="요양병원(일반)">요양병원</option>
                        <option value="치과병원">치과병원</option>
                        <option value="한방병원">한방병원</option>
                        <option value="의원">의원</option>
                        <option value="치과의원">치과의원</option>
                        <option value="한의원">한의원</option>
                    </select>
                </div>

                <!-- 검색어 입력 -->
                <div class="col-lg-4 col-md-8">
                    <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i class="fas fa-search m-r-5 text-secondary"></i>병원 이름</label>
                    <input type="text" id="hospitalSearchText" class="form-control border-gray-200 py-2 rounded-3" placeholder="병원 이름을 입력하세요.">
                </div>

                <!-- 검색 버튼 -->
                <div class="col-lg-2 col-md-4">
                    <button type="button" onclick="searchHospitals(1)" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm hover-up f-s-15 fw-bold transition">조회하기</button>
                </div>
            </div>
        </div>

        <!-- 결과 영역 -->
        <div id="hospitalResultArea" class="px-2 px-md-4 pb-4">
            <div class="text-center py-5 my-5">
                <i class="fas fa-search-location fa-4x text-light mb-4 d-block"></i>
                <h5 class="text-dark fw-bold mb-2">어느 지역의 병원을 찾으시나요?</h5>
                <p class="text-secondary f-s-14 mb-0">상단 검색 조건을 선택하고 조회하기 버튼을 눌러주세요.</p>
            </div>
        </div>
    </div>

    <!-- 페이지네이션 -->
    <div id="hospitalPagination" class="m-t-40"></div>
</div>

<!-- 병원 상세 정보 모달 -->
<div class="modal fade" id="hospitalDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h5 class="modal-title fw-600"><i class="fas fa-hospital-alt m-r-10"></i><span id="detailHospitalTitle">병원 정보</span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light-soft">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="bg-white rounded-3 shadow-sm mb-4 overflow-hidden">
                            <table class="table detail-modal-table mb-0">
                                <colgroup><col width="25%"><col width="25%"><col width="25%"><col width="25%"></colgroup>
                                <tbody>
                                    <tr><th class="bg-gray-50 border-end">병원 이름</th><td colspan="3" id="detail_BPLC_NM" class="fw-bold text-primary">-</td></tr>
                                    <tr><th class="bg-gray-50 border-end">병원 구분</th><td id="detail_BZSTAT_SE_NM" class="border-end">-</td><th class="bg-gray-50 border-end">상태</th><td id="detail_SALS_STTS_NM">-</td></tr>
                                    <tr><th class="bg-gray-50 border-end">병상수</th><td id="detail_BD_NUM" class="border-end">-</td><th class="bg-gray-50 border-end">입원실수</th><td id="detail_SICK_ROOM_NUM">-</td></tr>
                                    <tr><th class="bg-gray-50 border-end">의료인수</th><td id="detail_MEDI_PERS_NUM" class="border-end">-</td><th class="bg-gray-50 border-end">전화번호</th><td id="detail_TELNO" class="font-monospace">-</td></tr>
                                    <tr><th class="bg-gray-50 border-end">진료과목 코드</th><td id="detail_TREAT_SBJT_CD" class="border-end small">-</td><th class="bg-gray-50 border-end text-center">진료과목 내용</th><td id="detail_TREAT_SBJT_NAME_CONT" class="small">-</td></tr>
                                    <tr><th class="bg-gray-50 border-end">주소</th><td colspan="3" id="detail_ROAD_NM_ADDR">-</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="rounded-3 overflow-hidden border shadow-sm" style="height:350px; background-color:#e9ecef;">
                            <div id="hospitalMap" class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                <div class="text-center"><i class="fas fa-map-marked-alt fa-3x mb-3 opacity-25"></i><p>지도를 불러오는 중입니다.</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const areaData = {
        '서울특별시': ['강남구', '강동구', '강북구', '강서구', '관악구', '광진구', '구로구', '금천구', '노원구', '도봉구', '동대문구', '동작구', '마포구', '서대문구', '서초구', '성동구', '성북구', '송파구', '양천구', '영등포구', '용산구', '은평구', '종로구', '중구', '중랑구'],
        '부산광역시': ['강서구', '금정구', '기장군', '남구', '동구', '동래구', '부산진구', '북구', '사상구', '사하구', '서구', '수영구', '연제구', '영도구', '중구', '해운대구'],
        '인천광역시': ['강화군', '계양구', '미추홀구', '남동구', '동구', '부평구', '서구', '연수구', '옹진군', '중구'],
        '대구광역시': ['남구', '달서구', '달성군', '동구', '북구', '서구', '수성구', '중구', '군위군'],
        '광주광역시': ['광산구', '남구', '동구', '북구', '서구'],
        '대전광역시': ['대덕구', '동구', '서구', '유성구', '중구'],
        '울산광역시': ['남구', '동구', '북구', '울주군', '중구'],
        '세종특별자치시': ['세종특별자치시'],
        '경기도': ['가평군', '고양시', '과천시', '광명시', '광주시', '구리시', '군포시', '김포시', '남양주시', '동두천시', '부천시', '성남시', '수원시', '시흥시', '안산시', '안성시', '안양시', '양주시', '양평군', '여주시', '연천군', '오산시', '용인시', '의왕시', '의정부시', '이천시', '파주시', '평택시', '포천시', '하남시', '화성시'],
        '강원도': ['강릉시', '고성군', '동해시', '삼척시', '속초시', '양구군', '양양군', '영월군', '원주시', '인제군', '정선군', '철원군', '춘천시', '태백시', '평창군', '홍천군', '화천군', '횡성군'],
        '충청북도': ['괴산군', '단양군', '보은군', '영동군', '옥천군', '음성군', '제천시', '증평군', '진천군', '청주시', '충주시'],
        '충청남도': ['계룡시', '공주시', '금산군', '논산시', '당진시', '보령시', '부여군', '서산시', '서천군', '아산시', '예산군', '천안시', '청양군', '태안군', '홍성군'],
        '전라북도': ['고창군', '군산시', '김제시', '남원시', '무주군', '부안군', '순창군', '완주군', '익산시', '임실군', '장수군', '전주시', '정읍시', '진안군'],
        '전라남도': ['강진군', '고흥군', '곡성군', '광양시', '구례군', '나주시', '담양군', '목포시', '무안군', '보성군', '순천시', '신안군', '여수시', '영광군', '영암군', '완도군', '장성군', '장흥군', '진도군', '함평군', '해남군', '화순군'],
        '경상북도': ['경산시', '경주시', '고령군', '구미시', '김천시', '문경시', '봉화군', '상주시', '성주군', '안동시', '영덕군', '영양군', '영주시', '영천시', '예천군', '울릉군', '울진군', '의성군', '청도군', '청송군', '칠곡군', '포항시'],
        '경상남도': ['거제시', '거창군', '고성군', '김해시', '남해군', '밀양시', '사천시', '산청군', '양산시', '의령군', '진주시', '창녕군', '창원시', '통영시', '하동군', '함안군', '함양군', '합천군'],
        '제주특별자치도': ['서귀포시', '제주시']
    };

    $('#sidoCd').on('change', function() {
        const sido = $(this).val();
        const $gugun = $('#gugunCd');
        $gugun.empty().append('<option value="">시/군/구 전체</option>');
        if (sido && areaData[sido]) { areaData[sido].forEach(function(gugun) { $gugun.append(`<option value="${gugun}">${gugun}</option>`); }); }
    });

    window.searchHospitals = function(page = 1) {
        const searchText = $('#hospitalSearchText').val();
        const sidoCd = $('#sidoCd').val();
        const gugunCd = $('#gugunCd').val();
        const hospitalType = $('#hospitalType').val();
        $('#hospitalResultArea').html('<div class="text-center py-5 my-5"><div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div><p class="m-t-20 text-muted f-s-15">전국 데이터를 분석 중입니다...</p></div>');
        $.ajax({
            url: '<?php echo G5_SHOP_URL; ?>/hospital_api.php',
            type: 'GET',
            data: { searchText: searchText, sidoCd: sidoCd, gugunCd: gugunCd, hospitalType: hospitalType, pageNo: page, numOfRows: 20 },
            success: function(data) { renderResults(data, page); },
            error: function() { $('#hospitalResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4">일시적인 오류가 발생했습니다.</div>'); }
        });
    };

    function renderResults(data, page) {
        let totalCount = 0; let items = [];
        if (data && data.response && data.response.body) {
            totalCount = data.response.body.totalCount || 0;
            if (data.response.body.items && data.response.body.items.item) { items = data.response.body.items.item; if (!Array.isArray(items)) items = [items]; }
        }
        if (totalCount === 0 || items.length === 0) {
            $('#hospitalResultArea').html('<div class="text-center py-5 my-5"><i class="fas fa-search-minus fa-4x text-light mb-4"></i><h5 class="fw-bold text-dark">일치하는 결과가 없습니다.</h5></div>');
            $('#hospitalPagination').empty();
            return;
        }

        let html = '<div class="table-responsive"><table class="table table-hover hospital-table mb-0">';
        html += '<thead class="bg-gray-50"><tr class="text-center"><th width="22%">병원 이름</th><th width="12%">구분</th><th width="40%">주소</th><th width="16%">전화번호</th><th width="10%">상태</th></tr></thead>';
        html += '<tbody class="f-s-16">';
        items.forEach(function(item) {
            const addr = item.ROAD_NM_ADDR || item.SITE_WHOL_ADDR || '-';
            const statusColor = (item.SALS_STTS_NM === '정상 영업') ? '#2e7d32' : '#757575';
            html += `<tr class="hospital-detail-trigger cursor-pointer" data-item='${JSON.stringify(item).replace(/'/g, "&apos;")}'>
                        <td class="fw-bold text-dark">${item.BPLC_NM}</td>
                        <td class="text-center"><span class="badge bg-light text-primary border">${item.BZSTAT_SE_NM}</span></td>
                        <td class="text-secondary">${addr}</td>
                        <td class="text-center font-monospace">${item.TELNO || '-'}</td>
                        <td class="text-center fw-600" style="color:${statusColor}">${item.SALS_STTS_NM}</td>
                    </tr>`;
        });
        html += '</tbody></table></div>';
        $('#hospitalResultArea').html(html);
        renderPagination(totalCount, page);
    }

    function renderPagination(totalCount, page) {
        const totalPages = Math.ceil(totalCount / 20);
        if (totalPages <= 1) { $('#hospitalPagination').empty(); return; }
        let html = '<ul class="pagination pagination-modern justify-content-center">';
        for (let i = Math.max(1, page - 2); i <= Math.min(totalPages, page + 2); i++) {
            html += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
        }
        html += '</ul>';
        $('#hospitalPagination').html(html);
    }

    $(document).on('click', '.hospital-detail-trigger', function() {
        const item = $(this).data('item');
        $('#detailHospitalTitle').text(item.BPLC_NM + ' 병원 정보');
        $('#detail_BPLC_NM').text(item.BPLC_NM || '-');
        $('#detail_BZSTAT_SE_NM').text(item.BZSTAT_SE_NM || '-');
        $('#detail_SALS_STTS_NM').text(item.SALS_STTS_NM || '-');
        $('#detail_BD_NUM').text((item.SCKBD_CNT || '0') + ' 개');
        $('#detail_SICK_ROOM_NUM').text((item.HSPTLZRM_CNT || '0') + ' 실');
        $('#detail_MEDI_PERS_NUM').text((item.HCWKR_CNT || '0') + ' 명');
        $('#detail_TELNO').text(item.TELNO || '-');
        $('#detail_TREAT_SBJT_CD').html((item.MDEXM_SBJCT_CN || '-').replace(/,/g, '<br>'));
        $('#detail_TREAT_SBJT_NAME_CONT').text(item.MDEXM_SBJCT_CN_NM || '-');
        $('#detail_ROAD_NM_ADDR').text(item.ROAD_NM_ADDR || item.SITE_WHOL_ADDR || '-');
        
        const mapAddr = item.ROAD_NM_ADDR || item.SITE_WHOL_ADDR || '';
        if (mapAddr && mapAddr !== '-') {
            const mapUrl = 'https://maps.google.com/maps?q=' + encodeURIComponent(mapAddr) + '&t=&z=16&ie=UTF8&iwloc=&output=embed';
            $('#hospitalMap').html('<iframe width="100%" height="100%" frameborder="0" style="border:0" src="' + mapUrl + '" allowfullscreen></iframe>');
        } else {
            $('#hospitalMap').html('<div class="text-center p-5"><i class="fas fa-exclamation-triangle fa-2x mb-2 text-warning"></i><p>주소 정보가 없어 지도를 표시할 수 없습니다.</p></div>');
        }
        $('#hospitalDetailModal').modal('show');
    });

    $(document).on('click', '#hospitalPagination .page-link', function(e) { e.preventDefault(); searchHospitals($(this).data('page')); });
    $('#hospitalSearchText').on('keypress', function(e) { if (e.which === 13) searchHospitals(1); });
});
</script>

<style>
.hospital-app-card { border-radius: 12px; }
.b-b-gray-100 { border-bottom: 1px solid #f1f5f9; }
.hospital-table th { padding: 15px; font-size: 14px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
.hospital-table td { padding: 15px; vertical-align: middle; }
.hover-up:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
.pagination-modern .page-link { border: 1px solid #eaeff5; margin: 0 5px; min-width: 40px; text-align: center; border-radius: 8px; color: #475569; font-weight: 600; padding: 10px; transition: all 0.2s; }
.pagination-modern .page-item.active .page-link { background-color: #2563eb; color: #fff; border-color: #2563eb; }
.alert-soft-danger { background-color: #fef2f2; border: 1px solid #fee2e2; color: #991b1b; border-radius: 12px; }
.text-light { color: #f1f5f9 !important; }
.bg-light-soft { background-color: #fcfdfe; }
.detail-modal-table th { background-color: #f8fafc; font-size: 14px; font-weight: 600; color: #475569; vertical-align: middle; text-align: center; border: 1px solid #eef2f6; height: 50px; }
.detail-modal-table td { font-size: 14px; color: #334155; vertical-align: middle; padding: 12px 15px !important; border: 1px solid #eef2f6; }
.cursor-pointer { cursor: pointer !important; }
</style>

<?php include_once(G5_PATH.'/tail.php'); ?>
