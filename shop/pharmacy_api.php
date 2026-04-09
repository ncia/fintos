<?php
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

// 일반 인증키 (Decoding 상태)
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

$pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$numOfRows = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 10;
$searchText = isset($_GET['searchText']) ? trim($_GET['searchText']) : '';
$sidoCd = isset($_GET['sidoCd']) ? trim($_GET['sidoCd']) : '';
$gugunCd = isset($_GET['gugunCd']) ? trim($_GET['gugunCd']) : '';
$dayOfWeek = isset($_GET['dayOfWeek']) ? trim($_GET['dayOfWeek']) : '';

// 1:Mon ... 7:Sun, 8:Holiday
// API 파라미터 구성
$url = "http://apis.data.go.kr/B552657/ErmctInsttInfoInqireService/getParmacyListInfoInqire";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&pageNo=" . $pageNo;
$url .= "&numOfRows=" . $numOfRows;

if ($sidoCd) {
    $url .= "&Q0=" . urlencode($sidoCd); // 시도
}
if ($gugunCd) {
    $url .= "&Q1=" . urlencode($gugunCd); // 시군구
}
if ($searchText) {
    $url .= "&QN=" . urlencode($searchText); // 기관명
}
if ($dayOfWeek) {
    $url .= "&QT=" . urlencode($dayOfWeek); // 진료요일
}

$url .= "&ORD=NAME"; // 기본 정렬

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(['error' => 'API 요청 실패: ' . $error]);
} else {
    try {
        // XML to JSON 변환
        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($xml === false) {
            echo json_encode(['error' => 'XML 파싱 실패', 'response' => $response]);
            exit;
        }

        $json = json_encode($xml);
        $array = json_decode($json, true);

        // 일관된 포맷을 위해 정리
        $result = [
            'response' => [
                'header' => $array['header'] ?? [],
                'body' => [
                    'items' => [
                        'item' => $array['body']['items']['item'] ?? []
                    ],
                    'numOfRows' => $array['body']['numOfRows'] ?? 0,
                    'pageNo' => $array['body']['pageNo'] ?? 0,
                    'totalCount' => $array['body']['totalCount'] ?? 0
                ]
            ]
        ];

        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => '데이터 처리 중 오류 발생: ' . $e->getMessage()]);
    }
}
?>
