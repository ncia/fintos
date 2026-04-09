<?php
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

$pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$numOfRows = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 10;
$searchText = isset($_GET['searchText']) ? trim($_GET['searchText']) : '';
$sidoCd = isset($_GET['sidoCd']) ? trim($_GET['sidoCd']) : '';
$gugunCd = isset($_GET['gugunCd']) ? trim($_GET['gugunCd']) : '';
$hospitalType = isset($_GET['hospitalType']) ? trim($_GET['hospitalType']) : '';

// 기본 URL (지방행정인허가데이터_병원)
$url = "https://apis.data.go.kr/1741000/hospitals/info";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&pageNo=" . $pageNo;
$url .= "&numOfRows=" . $numOfRows;
$url .= "&cond%5BSALS_STTS_CD%3A%3AEQ%5D=01"; // 영업중 필터

if ($searchText) {
    // 병원명 검색 (BPLC_NM)
    $url .= "&cond%5BBPLC_NM%3A%3ALIKE%5D=" . urlencode($searchText);
}

if ($sidoCd) {
    // 주소 검색 (ROAD_NM_ADDR)
    $url .= "&cond%5BROAD_NM_ADDR%3A%3ALIKE%5D=" . urlencode($sidoCd);
}

if ($gugunCd) {
    // 시군구 검색 (ROAD_NM_ADDR)
    $url .= "&cond%5BROAD_NM_ADDR%3A%3ALIKE%5D=" . urlencode($gugunCd);
}

if ($hospitalType) {
    // 구분 값 매핑 (사용자 친화적 명칭 -> API 원본 명칭)
    $hospitalTypeMap = [
        '요양병원(노인)' => '요양병원(노인병원)',
        '요양병원(일반)' => '요양병원(일반요양병원)'
    ];
    $qType = isset($hospitalTypeMap[$hospitalType]) ? $hospitalTypeMap[$hospitalType] : $hospitalType;
    
    // 업태구분명 검색 (BZSTAT_SE_NM)
    $url .= "&cond%5BBZSTAT_SE_NM%3A%3AEQ%5D=" . urlencode($qType);
}

$url .= "&_type=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(['error' => 'API 요청 실패: ' . $error]);
} else {
    // 응답 데이터의 명칭도 요청하신 줄임말로 변경하여 사용자에게 표시
    $response = str_replace('요양병원(노인병원)', '요양병원(노인)', $response);
    $response = str_replace('요양병원(일반요양병원)', '요양병원(일반)', $response);
    $response = str_replace('영업/정상', '정상 영업', $response);
    echo $response;
}
?>
