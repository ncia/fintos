<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
?>

<div class="non-benefit-container container m-t-30 m-b-50">
  <div class="main-heading m-b-30">
    <h2 class="f-s-24 fw-600"><i class="fas fa-hand-holding-usd text-danger m-r-10"></i><strong>병원 비급여 항목</strong></h2>
  </div>

  <div class="hospital-app-card bg-white border-0 shadow overflow-hidden">
    <div class="px-3 px-md-4 pb-4 pt-4 b-b-gray-100">
      <div class="row g-3 align-items-end">
        <div class="col-lg-2 col-md-4">
          <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i
              class="fas fa-map-marker-alt m-r-5 text-secondary"></i>시/도</label>
          <select id="sidoCd" class="form-select border-gray-200 py-2 rounded-3">
            <option value="">전국전체</option>
            <option value="11">서울특별시</option>
            <option value="21">부산광역시</option>
            <option value="22">대구광역시</option>
            <option value="23">인천광역시</option>
            <option value="24">광주광역시</option>
            <option value="25">대전광역시</option>
            <option value="26">울산광역시</option>
            <option value="29">세종특별자치시</option>
            <option value="31">경기도</option>
            <option value="32">강원도</option>
            <option value="33">충청북도</option>
            <option value="34">충청남도</option>
            <option value="35">전라북도</option>
            <option value="36">전라남도</option>
            <option value="37">경상북도</option>
            <option value="38">경상남도</option>
            <option value="39">제주특별자치도</option>
          </select>
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i
              class="fas fa-hospital m-r-5 text-secondary"></i>병원 구분</label>
          <select id="clCd" class="form-select border-gray-200 py-2 rounded-3">
            <option value="">병원구분 전체</option>
            <option value="01">상급종합병원</option>
            <option value="11">종합병원</option>
            <option value="21">병원</option>
            <option value="31">의원</option>
            <option value="41">치과병원</option>
            <option value="51">치과의원</option>
            <option value="61">조산원</option>
            <option value="71">보건소</option>
            <option value="81">약국</option>
            <option value="91">한방병원</option>
          </select>
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i
              class="fas fa-tags m-r-5 text-secondary"></i>중분류</label>
          <select id="npayMdivCd" class="form-select border-gray-200 py-2 rounded-3">
            <option value="">중분류 전체</option>
            <option value="01">상급병실료</option>
            <option value="02">제증명수수료</option>
            <option value="03">검사료</option>
            <option value="04">처치 및 수술료</option>
            <option value="05">치과분야</option>
            <option value="06">MRI진단료</option>
            <option value="07">초음파검사료</option>
            <option value="08">선택진료료</option>
            <option value="09">한방분야</option>
          </select>
        </div>
        <div class="col-lg-4 col-md-8">
          <label class="form-label f-s-14 fw-bold text-dark w-100 text-center"><i
              class="fas fa-search m-r-5 text-secondary"></i>병원 이름</label>
          <input type="text" id="hospitalSearchText" class="form-control border-gray-200 py-2 rounded-3"
            placeholder="병원 이름을 입력하세요.">
        </div>
        <div class="col-lg-2 col-md-4">
          <button type="button" id="medicalSearchBtn"
            class="btn btn-primary w-100 py-2 rounded-3 shadow-sm hover-up f-s-15 fw-bold transition">조회하기</button>
        </div>
      </div>
    </div>

    <div id="resultInfo" class="px-4 py-3 b-b-gray-100 bg-light-soft d-none">
      <span class="f-s-14 text-secondary"><i class="far fa-file-alt m-r-5"></i> 검색 결과: 총 <span id="totalCount"
          class="fw-bold text-primary">0</span>건</span>
    </div>

    <div id="medicalResultArea" class="px-2 px-md-4 pb-4">
      <div class="text-center py-5 my-5">
        <i class="fas fa-search-location fa-4x text-light mb-4"></i>
        <h5 class="text-dark fw-bold mb-2">원하시는 조건으로 조회를 시작하세요!</h5>
        <p class="text-secondary f-s-14 mb-0">상단 지역, 병원 구분 또는 키워드를 입력해 주세요.</p>
      </div>
    </div>
  </div>
  <div id="medicalPagination" class="m-t-40"></div>
</div>

<!-- 병원 상세 정보 모달 (병원 정보 조회와 연동) -->
<div class="modal fade" id="hospitalDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-primary text-white border-0 py-3">
        <h5 class="modal-title fw-600"><i class="fas fa-hospital-alt m-r-10"></i><span id="detailHospitalTitle">병원
            정보</span></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 bg-light-soft">
        <div class="row g-4">
          <div class="col-lg-12">
            <div class="bg-white rounded-3 shadow-sm mb-4 overflow-hidden">
              <table class="table detail-modal-table mb-0">
                <colgroup>
                  <col width="18%">
                  <col width="32%">
                  <col width="18%">
                  <col width="32%">
                </colgroup>
                <tbody>
                  <tr>
                    <th class="bg-gray-50 border-end">병원 이름</th>
                    <td colspan="3" id="d_yadmNm" class="fw-bold text-primary f-s-16">-</td>
                  </tr>
                  <tr>
                    <th class="bg-gray-50 border-end">병원 구분</th>
                    <td id="d_clCdNm" class="border-end">-</td>
                    <th class="bg-gray-50 border-end">상태</th>
                    <td id="d_status">-</td>
                  </tr>
                  <tr>
                    <th class="bg-gray-50 border-end">병상수</th>
                    <td id="d_beds" class="border-end">-</td>
                    <th class="bg-gray-50 border-end">입원실수</th>
                    <td id="d_rooms">-</td>
                  </tr>
                  <tr>
                    <th class="bg-gray-50 border-end">의료인수</th>
                    <td id="d_doctors" class="border-end">-</td>
                    <th class="bg-gray-50 border-end">전화번호</th>
                    <td id="d_telno" class="font-monospace">-</td>
                  </tr>
                  <tr>
                    <th class="bg-gray-50 border-end">진료과목 코드</th>
                    <td id="d_subjects_cd" class="border-end f-s-13 lh-16">-</td>
                    <th class="bg-gray-50 border-end text-center">진료과목 내용</th>
                    <td id="d_subjects_nm" class="f-s-13 lh-16">-</td>
                  </tr>
                  <tr>
                    <th class="bg-gray-50 border-end">주소</th>
                    <td colspan="3" id="d_addr">-</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="rounded-3 overflow-hidden border shadow-sm" style="height:350px; background-color:#e9ecef;">
              <div id="hospMap" class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                <div class="text-center"><i class="fas fa-map-marked-alt fa-3x mb-3 opacity-25"></i>
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
  // 시/도 변경 로직 및 지역 검색 강화 취소
  // $('#sidoCd').on('change', function() { ... });

  // 선택 박스 변경 시 자동 검색 기능을 제거하고 버튼 클릭 시에만 검색되도록 유지
  // $('#clCd, #npayMdivCd').on('change', function() {
  //     searchMedicalExp(1);
  // });

  function searchMedicalExp(page = 1) {
    const yadmNm = $('#hospitalSearchText').val().trim();
    const sidoCd = $('#sidoCd').val();
    const clCd = $('#clCd').val();
    const npayMdivCd = $('#npayMdivCd').val();

    $('#medicalResultArea').html(
      '<div class="text-center py-5 my-5"><div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div><p class="m-t-20 text-muted f-s-15">데이터를 안전하게 조회 중입니다...</p></div>'
    );
    $.ajax({
      url: '<?php echo G5_SHOP_URL; ?>/NonPaymentItemHospList2_api.php',
      type: 'GET',
      data: {
        yadmNm: yadmNm,
        sidoCd: sidoCd,
        clCd: clCd,
        npayMdivCd: npayMdivCd,
        pageNo: page,
        numOfRows: 10
      },
      dataType: 'json',
      success: function(data) {
        renderResults(data, page);
      },
      error: function(xhr) {
        $('#medicalResultArea').html(
          '<div class="alert alert-soft-danger text-center m-5 p-4">서버 통신 오류가 발생했습니다.</div>');
      }
    });
  }

  function renderResults(data, page) {
    const selectedMdiv = $('#npayMdivCd').val();
    let totalCount = 0;
    let items = [];
    const body = data.body || (data.response ? data.response.body : null);
    if (body) {
      totalCount = parseInt(body.totalCount || 0);
      if (body.items && body.items.item) {
        items = body.items.item;
        if (!Array.isArray(items)) items = [items];

        // 선택된 조건에 따른 엄격한 필터링 (API 필터가 불확실할 경우 대비)
        if (selectedMdiv) {
          items = items.filter(item => {
            let match = true;
            if (selectedMdiv) {
              const mCode = item.npayMdivCd || item.divCd1 || '';
              if (mCode && mCode !== selectedMdiv) match = false;
            }
            return match;
          });
        }
      }
    }
    if (totalCount === 0 || items.length === 0) {
      $('#resultInfo').addClass('d-none');
      $('#medicalResultArea').html(
        '<div class="text-center py-5 my-5"><h5 class="fw-bold text-dark">조회된 정보가 없습니다.</h5></div>');
      $('#medicalPagination').empty();
      return;
    }
    $('#resultInfo').removeClass('d-none');
    $('#totalCount').text(totalCount.toLocaleString());

    items.sort((a, b) => {
      const nameA = a.yadmNm || a.YADM_NM || '';
      const nameB = b.yadmNm || b.YADM_NM || '';
      if (nameA !== nameB) return nameA.localeCompare(nameB, 'ko');
      const catA = a.npayMdivCdNm || a.divCd1Nm || '';
      const catB = b.npayMdivCdNm || b.divCd1Nm || '';
      return catA.localeCompare(catB, 'ko');
    });

    const grouped = {};
    items.forEach(item => {
      const hName = item.yadmNm || item.YADM_NM || '-';
      let mCat = item.npayMdivCdNm || item.divCd1Nm || '';
      if (!mCat || mCat === '-') {
        const rawName = item.itmCdNm || item.itm_nm || '';
        mCat = rawName.indexOf('/') > -1 ? rawName.split('/')[0] : '기타 비급여';
      }
      const type = item.clCdNm || '-';
      const loc = item.sgguCdNm || '';
      const addr = item.addr || item.ADDR || '-';
      const telno = item.telno || item.TELNO || '-';

      if (!grouped[hName]) {
        grouped[hName] = {
          info: {
            type,
            loc,
            addr,
            telno
          },
          cats: {}
        };
      }
      if (!grouped[hName].cats[mCat]) {
        grouped[hName].cats[mCat] = [];
      }
      grouped[hName].cats[mCat].push(item);
    });

    let html = '<div class="table-responsive"><table class="table hospital-table mb-0">';
    html +=
      '<thead class="bg-gray-50"><tr class="text-center"><th>병원 이름</th><th>중분류</th><th>항목명</th><th>비급여 코드</th><th>비용</th><th>기준일자</th></tr></thead>';
    html += '<tbody class="f-s-16">';

    Object.keys(grouped).forEach(hName => {
      const hospital = grouped[hName];
      const cats = Object.keys(hospital.cats);
      let totalRows = 0;
      cats.forEach(mCat => {
        totalRows += hospital.cats[mCat].length;
      });

      cats.forEach((mCat, catIdx) => {
        const subItems = hospital.cats[mCat];
        subItems.forEach((item, itemIdx) => {
          html += '<tr>';
          if (catIdx === 0 && itemIdx === 0) {
            const hInfo = JSON.stringify(hospital.info).replace(/'/g, "&apos;");
            html += `<td rowspan="${totalRows}" class="hospital-col bg-light-soft text-center border-end">
                                    <div class="fw-500 text-dark f-s-16 mb-1 hospital-trigger-link cursor-pointer" data-name="${hName}" data-info='${hInfo}'>${hName}</div>
                                    <div class="text-secondary small">(${hospital.info.loc}, ${hospital.info.type})</div>
                                 </td>`;
          }
          if (itemIdx === 0) {
            html +=
              `<td rowspan="${subItems.length}" class="text-center border-end fw-500 bg-white">${mCat}</td>`;
          }

          const rawDate = String(item.adtFrDd || item.adtStaDd || item.invtDt || item.lastUpdtDt || item
            .aplStartDt || item.aplEndDt || '');
          let date = '-';
          if (rawDate && rawDate.length === 8 && !rawDate.startsWith('9999')) {
            date = `${rawDate.substring(0, 4)}.${rawDate.substring(4, 6)}.${rawDate.substring(6, 8)}`;
          }

          const price = formatPrice(item);
          html += `<td class="px-4 fw-500">${item.npayKorNm || item.itmCdNm || '-'}</td>`;
          html +=
            `<td class="text-center font-monospace small"><span class="code-badge-style">${item.npayCd || item.itmCd || '-'}</span></td>`;
          html += `<td class="text-center fw-500 text-primary f-s-16">${price}</td>`;
          html += `<td class="text-center text-secondary small fw-500">${date}</td>`;
          html += '</tr>';
        });
      });
    });
    html += '</tbody></table></div>';
    $('#medicalResultArea').html(html);
    renderPagination(totalCount, page);
  }

  function formatPrice(item) {
    const getVal = (obj, keys) => {
      for (let key of keys)
        if (obj[key] !== undefined && obj[key] !== null && obj[key] !== '' && typeof obj[key] !== 'object')
          return obj[key];
      return 0;
    };
    const minVal = getVal(item, ['minPrc', 'curAmt', 'itmPrcMin', 'prcMin', 'minAmt', 'min_amt']);
    const maxVal = getVal(item, ['maxPrc', 'curAmt', 'itmPrcMax', 'prcMax', 'maxAmt', 'max_amt']);
    const min = parseInt(minVal) || 0;
    const max = parseInt(maxVal) || 0;
    if (min === 0 && max === 0) return '-';
    if (min === max || max === 0) return min.toLocaleString();
    return min.toLocaleString() + ' ~ ' + max.toLocaleString();
  }

  function renderPagination(totalCount, page) {
    const totalPages = Math.ceil(totalCount / 10);
    if (totalPages <= 1) {
      $('#medicalPagination').empty();
      return;
    }
    let html = '<ul class="pagination pagination-modern justify-content-center">';
    for (let i = Math.max(1, page - 2); i <= Math.min(totalPages, page + 2); i++) {
      html +=
        `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
    }
    html += '</ul>';
    $('#medicalPagination').html(html);
  }

  $('#medicalSearchBtn').on('click', function() {
    searchMedicalExp(1);
  });
  $('#hospitalSearchText').on('keypress', function(e) {
    if (e.which === 13) searchMedicalExp(1);
  });
  $(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    searchMedicalExp($(this).data('page'));
  });

  function renderHospMap(addr) {
    if (addr && addr !== '-') {
      const mapUrl = 'https://maps.google.com/maps?q=' + encodeURIComponent(addr) +
        '&t=&z=16&ie=UTF8&iwloc=&output=embed';
      $('#hospMap').html('<iframe width="100%" height="100%" frameborder="0" style="border:0" src="' + mapUrl +
        '" allowfullscreen></iframe>');
    } else {
      $('#hospMap').html(
        '<div class="text-center p-5"><i class="fas fa-exclamation-triangle fa-2x mb-2 text-warning"></i><p>주소 정보가 없어 지도를 표시할 수 없습니다.</p></div>'
      );
    }
  }

  $(document).on('click', '.hospital-trigger-link', function() {
    const name = $(this).data('name');
    const info = $(this).data('info');

    $('#detailHospitalTitle').text(name + ' 병원 정보');
    $('#d_yadmNm').text(name);
    $('#d_clCdNm').text(info.type || '-');
    $('#d_telno').text(info.telno || '-');
    $('#d_addr').text(info.addr || '-');
    $('#d_status, #d_beds, #d_rooms, #d_doctors, #d_subjects_cd, #d_subjects_nm').text('조회 중...');

    // 기본 주소로 먼저 지도 표시
    renderHospMap(info.addr);

    $.ajax({
      url: '<?php echo G5_SHOP_URL; ?>/hospital_api.php',
      type: 'GET',
      data: {
        searchText: name
      },
      dataType: 'json',
      success: function(res) {
        let found = null;
        if (res && res.response && res.response.body && res.response.body.items) {
          const results = res.response.body.items.item;
          found = Array.isArray(results) ? results[0] : results;
        }

        if (found) {
          const bestAddr = found.ROAD_NM_ADDR || found.SITE_WHOL_ADDR || info.addr || '-';
          $('#d_status').text(found.SALS_STTS_NM || '정상 영업');
          $('#d_beds').text((found.SCKBD_CNT || '0') + ' 개');
          $('#d_rooms').text((found.HSPTLZRM_CNT || '0') + ' 실');
          $('#d_doctors').text((found.HCWKR_CNT || '0') + ' 명');
          $('#d_telno').text(found.TELNO || info.telno || '-');
          $('#d_addr').text(bestAddr);
          $('#d_subjects_cd').html((found.MDEXM_SBJCT_CN || '-').replace(/,/g, '<br>'));
          $('#d_subjects_nm').text(found.MDEXM_SBJCT_CN_NM || '-');

          // 더 정확한 주소가 있다면 지도 갱신
          if (bestAddr !== '-' && bestAddr !== info.addr) {
            renderHospMap(bestAddr);
          }
        } else {
          $('#d_status, #d_beds, #d_rooms, #d_doctors, #d_subjects_cd, #d_subjects_nm').text('-');
        }
      },
      error: function() {
        $('#d_status, #d_beds, #d_rooms, #d_doctors, #d_subjects_cd, #d_subjects_nm').text('조회 실패');
      }
    });

    $('#hospitalDetailModal').modal('show');
  });
});
</script>

<style>
.hospital-app-card {
  border-radius: 0;
}

.b-b-gray-100 {
  border-bottom: 1px solid #f1f5f9;
}

.bg-gray-50 {
  background-color: #f8fafc;
}

.bg-light-soft {
  background-color: #fcfdfe;
}

.hospital-table th {
  padding: 20px 10px;
  font-size: 15px;
  color: #64748b;
  font-weight: 700;
  border-bottom: 2px solid #f1f5f9;
}

.hospital-table td {
  vertical-align: middle;
  padding: 18px 15px;
  border-bottom: 1px solid #f1f5f9;
}

.hospital-table td:hover {
  background-color: #f0f7ff !important;
  cursor: pointer;
}

.f-s-14 {
  font-size: 14px;
}

.f-s-15 {
  font-size: 15px;
}

.f-s-16 {
  font-size: 16px;
}

.f-s-24 {
  font-size: 24px;
}

.fw-500 {
  font-weight: 500;
}

.fw-600 {
  font-weight: 600;
}

.m-r-5 {
  margin-right: 5px;
}

.m-r-10 {
  margin-right: 10px;
}

.m-b-30 {
  margin-bottom: 30px;
}

.m-b-50 {
  margin-bottom: 50px;
}

.m-t-20 {
  margin-top: 20px;
}

.m-t-40 {
  margin-top: 40px;
}

.hover-up:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.pagination-modern .page-link {
  border: 1px solid #eaeff5;
  margin: 0 5px;
  border-radius: 8px;
  color: #475569;
  font-weight: 600;
  padding: 10px 15px;
  transition: all 0.2s;
}

.pagination-modern .page-item.active .page-link {
  background-color: #2563eb;
  color: #fff;
  border-color: #2563eb;
}

.border-end {
  border-right: 1px solid #f1f5f9 !important;
}

.code-badge-style {
  display: inline-block;
  padding: 3px 10px;
  background-color: #fff;
  border: 1.5px solid #ffc107;
  color: #d63384;
  border-radius: 6px;
  font-weight: 600;
  font-size: 13px;
  letter-spacing: -0.2px;
}

.hospital-trigger-link:hover {
  text-decoration: underline;
  color: #2563eb !important;
}

.detail-modal-table th {
  background-color: #f8fafc;
  font-size: 14px;
  font-weight: 600;
  color: #475569;
  vertical-align: middle;
  text-align: center;
  min-height: 50px;
  border: 1px solid #eef2f6;
}

.detail-modal-table td {
  font-size: 14px;
  color: #334155;
  vertical-align: middle;
  padding: 12px 15px !important;
  border: 1px solid #eef2f6;
}

.lh-16 {
  line-height: 1.6 !important;
}

.cursor-pointer {
  cursor: pointer !important;
}
</style>

<?php include_once(G5_PATH.'/tail.php'); ?>