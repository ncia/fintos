<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="pharmacies-info-container container m-t-30 m-b-50">
    <div class="main-heading m-b-30">
        <h2 class="f-s-24 fw-600"><i class="fas fa-pills text-pink m-r-10"></i><strong>약국 정보</strong> <span class="text-muted">조회</span></h2>
    </div>

    <!-- 하나의 통합된 깔끔한 카드 구조 -->
    <div class="hospital-app-card bg-white border-0 shadow overflow-hidden">
        
        <!-- 검색 섹션: 병원 정보와 동일한 레이아웃 유지 -->
        <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100">
            <div class="row g-4 align-items-end">
                <div class="col-lg-3 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-map-marker-alt m-r-5 text-secondary"></i>지역(시/도)</label>
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
                <div class="col-lg-3 col-md-6">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-map-marked m-r-5 text-secondary"></i>시/군/구</label>
                    <select id="gugunCd" class="form-select border-gray-200 py-2 rounded-3">
                        <option value="">시/군/구 전체</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-8">
                    <label class="form-label f-s-15 fw-bold text-dark w-100 text-center"><i class="fas fa-search m-r-5 text-secondary"></i>약국 이름</label>
                    <input type="text" id="pharmacySearchText" class="form-control border-gray-200 py-2 rounded-3" placeholder="약국 이름을 입력하세요.">
                </div>
                <div class="col-lg-2 col-md-4">
                    <button type="button" id="pharmacySearchBtn" class="btn btn-pink w-100 py-2 rounded-3 shadow-sm hover-up f-s-15 fw-bold transition">조회하기</button>
                </div>
            </div>
        </div>

        <!-- 결과 리스트 영역 -->
        <div id="pharmacyResultArea" class="px-2 px-md-4 pb-4">
            <div class="text-center py-5">
                <div class="p-5">
                    <i class="fas fa-file-medical-alt fa-4x text-light mb-4 d-block"></i>
                    <h5 class="text-dark fw-bold mb-2">우리 동네 약국을 찾아보세요!</h5>
                    <p class="text-secondary f-s-14 mb-0">지역과 요일을 선택하거나 약국명을 입력해 주세요.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 페이지네이션 -->
    <div id="pharmacyPagination" class="m-t-40"></div>
</div>

<!-- 약국 상세 정보 모달 -->
<div class="modal fade" id="pharmacyDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-pink text-white border-0 py-3">
                <h5 class="modal-title fw-600"><i class="fas fa-pills m-r-10"></i><span id="detailPharmacyTitle">약국 정보</span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light-soft">
                <div class="row g-4">
                    <!-- 상세 정보 테이블 -->
                    <div class="col-lg-12">
                        <div class="bg-white rounded-3 shadow-sm mb-4 overflow-hidden">
                            <table class="table detail-modal-table mb-0">
                                <colgroup>
                                    <col width="25%"><col width="75%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th class="bg-gray-50">약국 이름</th>
                                        <td id="detail_dutyName" class="fw-bold text-pink">-</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gray-50">전화번호</th>
                                        <td id="detail_dutyTel1" class="font-monospace">-</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gray-50">주소</th>
                                        <td id="detail_dutyAddr">-</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gray-50">영업 시간</th>
                                        <td id="detail_operatingHours" class="f-s-15">
                                            <div id="dutyTimeList" class="lh-18">
                                                <!-- 요약된 시간 정보 -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- 구글맵 공간 -->
                    <div class="col-lg-12">
                        <div class="rounded-3 overflow-hidden border shadow-sm" style="height:350px; background-color:#e9ecef;">
                            <div id="pharmacyMap" class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                <div class="text-center">
                                    <i class="fas fa-map-marked-alt fa-3x mb-3 opacity-25"></i>
                                    <p>지도를 불러오는 중입니다.</p>
                                </div>
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
    let currentPage = 1;

    const areaData = {
        '서울특별시': ['강남구', '강동구', '강북구', '강서구', '관악구', '광진구', '구로구', '금천구', '노원구', '도봉구', '동대문구', '동작구', '마포구', '서대문구', '서초구', '성동구', '성북구', '송파구', '양천구', '영등포구', '용산구', '은평구', '종로구', '중구', '중랑구'],
        '부산광역시': ['강서구', '금정구', '기장군', '남구', '동구', '동래구', '부산진구', '북구', '사상구', '사하구', '서구', '수영구', '연제구', '영도구', '중구', '해운대구'],
        '대구광역시': ['남구', '달서구', '달성군', '동구', '북구', '서구', '수성구', '중구', '군위군'],
        '인천광역시': ['강화군', '계양구', '미추홀구', '남동구', '동구', '부평구', '서구', '연수구', '옹진군', '중구'],
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
        
        if (sido && areaData[sido]) {
            areaData[sido].forEach(function(gugun) {
                $gugun.append(`<option value="${gugun}">${gugun}</option>`);
            });
        }
    });

    function searchPharmacies(page = 1) {
        const searchText = $('#pharmacySearchText').val();
        const sidoCd = $('#sidoCd').val();
        const gugunCd = $('#gugunCd').val();
        
        $('#pharmacyResultArea').html('<div class="text-center py-5 my-5"><div class="spinner-border text-pink" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Loading...</span></div><p class="m-t-20 text-muted f-s-15">전국 약국 데이터를 조회 중입니다...</p></div>');
        
        $.ajax({
            url: '<?php echo G5_SHOP_URL; ?>/pharmacy_api.php',
            type: 'GET',
            data: {
                searchText: searchText,
                sidoCd: sidoCd,
                gugunCd: gugunCd,
                pageNo: page,
                numOfRows: 10
            },
            dataType: 'json',
            success: function(data) {
                renderResults(data, page);
            },
            error: function(xhr, status, error) {
                $('#pharmacyResultArea').html('<div class="alert alert-soft-danger text-center m-5 p-4"><i class="fas fa-exclamation-circle fa-2x m-b-15 d-block"></i> 일시적인 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.</div>');
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
            $('#pharmacyResultArea').html('<div class="text-center py-5 my-5"><i class="fas fa-search-minus fa-4x text-light mb-4"></i><h5 class="fw-bold text-dark">일치하는 약국이 없습니다.</h5><p class="text-muted">검색어 혹은 조건을 변경하여 다시 찾아보세요.</p></div>');
            $('#pharmacyPagination').empty();
            return;
        }

        let html = '<div class="table-responsive"><table class="table table-hover hospital-table mb-0">';
        html += '<thead class="bg-gray-50"><tr class="text-center"><th width="30%">약국 이름</th><th width="45%">주소</th><th width="15%">전화번호</th><th width="10%">상세</th></tr></thead>';
        html += '<tbody class="f-s-16">';
        
        items.forEach(function(item) {
            const addr = item.dutyAddr || '-';
            
            html += '<tr class="pharmacy-detail-trigger cursor-pointer" data-item=\'' + JSON.stringify(item).replace(/'/g, "&apos;") + '\'>';
            html += '<td class="fw-500 px-4 text-pink pharmacy-name-cell">' + (item.dutyName || '-') + '</td>';
            html += '<td class="text-secondary px-4">' + addr + '</td>';
            html += '<td class="text-center font-monospace">' + (item.dutyTel1 || '-') + '</td>';
            html += '<td class="text-center"><button class="btn btn-xs btn-outline-pink rounded-pill">보기</button></td>';
            html += '</tr>';
        });
        
        html += '</tbody></table></div>';
        
        $('#pharmacyResultArea').html(html);
        renderPagination(totalCount, page);
        
        if (page > 1) {
            $('html, body').animate({scrollTop: $(".hospital-app-card").offset().top - 20}, 300);
        }
    }

    function renderPagination(totalCount, page) {
        const totalPages = Math.ceil(totalCount / 10);
        if (totalPages <= 1) {
            $('#pharmacyPagination').empty();
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
        $('#pharmacyPagination').html(paginationHtml);
    }

    $('#pharmacySearchBtn').on('click', function() {
        searchPharmacies(1);
    });

    $('#pharmacySearchText').on('keypress', function(e) {
        if (e.which === 13) searchPharmacies(1);
    });

    $(document).on('click', '.pharmacy-detail-trigger', function() {
        const item = $(this).data('item');
        
        $('#detailPharmacyTitle').text(item.dutyName);
        $('#detail_dutyName').text(item.dutyName || '-');
        $('#detail_dutyTel1').text(item.dutyTel1 || '-');
        $('#detail_dutyAddr').text(item.dutyAddr || '-');
        
        // 시간 정보 요약 로직
        const days = ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일', '공휴일'];
        let times = [];
        for(let i=1; i<=8; i++) {
            const s = item['dutyTime' + i + 's'] || '';
            const e = item['dutyTime' + i + 'c'] || '';
            times.push({s, e});
        }

        let timeHtml = '';
        
        // 1. 평일 (월~금) 체크
        const weekday1 = times[0];
        let isWeekdaySame = true;
        for(let i=1; i<5; i++) {
            if(times[i].s !== weekday1.s || times[i].e !== weekday1.e) {
                isWeekdaySame = false;
                break;
            }
        }

        if(isWeekdaySame && weekday1.s && weekday1.e) {
            timeHtml += `<div class="mb-2"><span class="badge bg-secondary me-2 f-s-14">월요일 ~ 금요일</span>: <strong class="f-s-15 text-dark-blue">${weekday1.s} ~ ${weekday1.e}시 까지</strong></div>`;
        } else {
            // 평일 중 다른 시간이 있으면 개별 표시
            for(let i=0; i<5; i++) {
                if(times[i].s && times[i].e) {
                    timeHtml += `<div class="mb-1"><span class="badge bg-secondary me-2 f-s-14">${days[i]}</span>: <span class="f-s-15">${times[i].s} ~ ${times[i].e}시 까지</span></div>`;
                }
            }
        }

        // 2. 토요일
        if(times[5].s && times[5].e) {
            timeHtml += `<div class="mb-2"><span class="badge bg-primary me-2 f-s-14">토요일</span>: <strong class="f-s-15 text-dark-blue">${times[5].s} ~ ${times[5].e}시 까지</strong></div>`;
        }

        // 3. 일요일 및 공휴일
        for(let i=6; i<8; i++) {
            if(times[i].s && times[i].e) {
                const label = (i === 6) ? '일요일' : '공휴일';
                const badgeClass = 'bg-danger';
                timeHtml += `<div class="mb-1"><span class="badge ${badgeClass} me-2 f-s-14">${label}</span>: <span class="f-s-15">${times[i].s} ~ ${times[i].e}시 까지</span></div>`;
            }
        }

        $('#dutyTimeList').html(timeHtml || '<div class="text-muted">진료 시간 정보가 없습니다.</div>');
        
        const mapAddr = item.dutyAddr || '';
        if (mapAddr && mapAddr !== '-') {
            const mapUrl = 'https://maps.google.com/maps?q=' + encodeURIComponent(mapAddr) + '&t=&z=16&ie=UTF8&iwloc=&output=embed';
            $('#pharmacyMap').html('<iframe width="100%" height="100%" frameborder="0" style="border:0" src="' + mapUrl + '" allowfullscreen></iframe>');
        } else {
            $('#pharmacyMap').html('<div class="text-center p-5"><i class="fas fa-exclamation-triangle fa-2x mb-2 text-warning"></i><p>주 정보가 없어 지도를 표시할 수 없습니다.</p></div>');
        }
        
        $('#pharmacyDetailModal').modal('show');
    });

    $(document).on('click', '#pharmacyPagination .page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page) searchPharmacies(page);
    });
});
</script>

<style>
.text-pink { color: #f43f5e !important; }
.btn-pink { background-color: #f43f5e; color: #fff; border: 0; transition: 0.2s; }
.btn-pink:hover { background-color: #e11d48; color: #fff; }
.btn-outline-pink { border: 1px solid #f43f5e; color: #f43f5e; background: transparent; }
.btn-outline-pink:hover { background-color: #f43f5e; color: #fff; }
.spinner-border.text-pink { color: #f43f5e !important; }
.bg-pink { background-color: #f43f5e !important; }
.bg-orange { background-color: #f97316 !important; color: #fff; }

.hospital-app-card { border-radius: 0; }
.b-b-gray-100 { border-bottom: 1px solid #f1f5f9; }
.bg-gray-50 { background-color: #f8fafc; }
.hospital-table th { padding: 20px 10px; font-size: 15px; color: #64748b; font-weight: 700; border-bottom: 2px solid #f1f5f9; white-space: nowrap; }
.hospital-table td { vertical-align: middle; padding: 18px 15px; border-bottom: 1px solid #f1f5f9; word-break: keep-all; overflow-wrap: break-word; }
.cursor-pointer { cursor: pointer !important; }
.pharmacy-name-cell { color: #e11d48; }
.hospital-table tr:hover .pharmacy-name-cell { text-decoration: underline; color: #be123c; }
.hospital-table tbody tr:hover { background-color: #fff1f2; }
.hospital-table tbody tr:last-child td { border-bottom: 0; }

/* 페이지네이션 공통 스타일 (이전 수정사항 반영) */
.pagination-modern .page-link { border: 1px solid #eaeff5; margin: 0 5px; min-width: 40px; text-align: center; border-radius: 8px; color: #475569; font-weight: 600; padding: 10px; transition: all 0.2s; box-shadow: none; }
.pagination-modern .page-item.active .page-link { background-color: #f43f5e; color: #fff; border-color: #f43f5e; }
.pagination-modern .page-link:hover:not(.active) { background-color: #fff1f2; border-color: #fecdd3; }
.pagination-modern .page-link:focus { box-shadow: none; outline: none; }

/* 폰트 및 공통 */
.f-s-12 { font-size: 12px; }
.f-s-13 { font-size: 13px; }
.f-s-14 { font-size: 14px; }
.f-s-15 { font-size: 15px; }
.f-s-16 { font-size: 16px; }
.f-s-24 { font-size: 24px; }
.fw-500 { font-weight: 500; }
.fw-600 { font-weight: 600; }
.m-r-5 { margin-right: 5px; }
.m-r-10 { margin-right: 10px; }
.m-b-30 { margin-bottom: 30px; }
.m-b-50 { margin-bottom: 50px; }
.m-t-20 { margin-top: 20px; }
.m-t-40 { margin-top: 40px; }
.hover-up:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
.bg-light-soft { background-color: #fcfdfe; }
.detail-modal-table th { background-color: #f8fafc; font-size: 14px; font-weight: 600; color: #475569; vertical-align: middle; text-align: center; }
.detail-modal-table td { font-size: 14px; color: #334155; vertical-align: middle; }
</style>

<?php
include_once(G5_PATH.'/tail.php');
?>
