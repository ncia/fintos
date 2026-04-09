<?php
error_reporting(0);
ob_start();
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

// HIRA 한방 약가 목록 조회 API 프록시
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

$pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$numOfRows = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 10;
$mdsCd = isset($_GET['mdsCd']) ? trim($_GET['mdsCd']) : ''; // 약품코드
$itmNm = isset($_GET['itmNm']) ? trim($_GET['itmNm']) : ''; // 품목명
$adtStaDd = isset($_GET['adtStaDd']) ? trim($_GET['adtStaDd']) : ''; // 적용시작일자

if (!$mdsCd && !$itmNm) {
    echo json_encode(['error' => '검색어(약품코드 또는 품목명)를 입력해주세요.']);
    exit;
}

$url = "https://apis.data.go.kr/B551182/cmdcDgamtInfoService/getCmdcDgamtList";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&pageNo=" . $pageNo;
$url .= "&numOfRows=" . $numOfRows;
if ($mdsCd) $url .= "&mdsCd=" . urlencode($mdsCd);
if ($itmNm) $url .= "&itmNm=" . urlencode($itmNm);
if ($adtStaDd) $url .= "&adtStaDd=" . urlencode($adtStaDd);
$url .= "&_type=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    ob_end_clean();
    echo json_encode(['error' => 'API 요청 실패']);
} else {
    ob_end_clean();
    if (strpos($response, '<?xml') !== false) {
        $xml = @simplexml_load_string($response);
        echo json_encode($xml);
    } else {
        echo $response;
    }
}
?>
