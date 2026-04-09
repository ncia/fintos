<?php
error_reporting(0);
ob_start();
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

$pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$numOfRows = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 10;
$sickType = isset($_GET['sickType']) ? (int)$_GET['sickType'] : 1;
$medTp = isset($_GET['medTp']) ? (int)$_GET['medTp'] : 1;
$diseaseType = isset($_GET['diseaseType']) ? $_GET['diseaseType'] : 'SICK_CD';
$searchText = isset($_GET['searchText']) ? trim($_GET['searchText']) : '';

if (!$searchText) {
    echo json_encode(['error' => '검색어를 입력해주세요.']);
    exit;
}

$url = "https://apis.data.go.kr/B551182/diseaseInfoService1/getDissNameCodeList1";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&pageNo=" . $pageNo;
$url .= "&numOfRows=" . $numOfRows;
$url .= "&sickType=" . $sickType;
$url .= "&medTp=" . $medTp;
$url .= "&diseaseType=" . urlencode($diseaseType);
$url .= "&searchText=" . urlencode($searchText);
$url .= "&_type=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    ob_end_clean();
    echo json_encode(['error' => 'API 요청 실패: ' . $error]);
} else {
    ob_end_clean();
    if (strpos($response, '<?xml') !== false || strpos($response, '<OpenAPI_ServiceResponse>') !== false || strpos($response, '<response>') !== false) {
        $xml = @simplexml_load_string($response);
        if ($xml !== false) {
            echo json_encode($xml);
        } else {
            echo json_encode(['error' => '응답 데이터 파싱 실패']);
        }
    } else {
        echo $response;
    }
}
?>
