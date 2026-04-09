<?php
error_reporting(0);
ob_start();
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

// HIRA 비급여 항목 병원 목록 조회 API 프록시 (심사평가원_비급여진료비정보서비스)
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

$pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$numOfRows = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 10;
$yadmNm = isset($_GET['yadmNm']) ? trim($_GET['yadmNm']) : '';
$sidoCd = isset($_GET['sidoCd']) ? trim($_GET['sidoCd']) : '';
if ($sidoCd && strlen($sidoCd) == 2) $sidoCd .= '0000'; // 11 -> 110000
$clCd = isset($_GET['clCd']) ? trim($_GET['clCd']) : '';
$npayMdivCd = isset($_GET['npayMdivCd']) ? trim($_GET['npayMdivCd']) : '';

// 기본 URL (비급여항목병원목록요약 - 2016.03 이후 데이터)
$baseUrl = "https://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemHospList2";
$queryParams = '?' . urlencode('serviceKey') . '=' . urlencode($serviceKey);
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode($pageNo);
$queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode($numOfRows);
$queryParams .= '&' . urlencode('_type') . '=' . urlencode('json');

if ($yadmNm) $queryParams .= '&' . urlencode('yadmNm') . '=' . urlencode($yadmNm);
if ($sidoCd) $queryParams .= '&' . urlencode('sidoCd') . '=' . urlencode($sidoCd);
if ($clCd) $queryParams .= '&' . urlencode('clCd') . '=' . urlencode($clCd);
if ($npayMdivCd) $queryParams .= '&' . urlencode('npayMdivCd') . '=' . urlencode($npayMdivCd);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    ob_end_clean();
    echo json_encode(['error' => '심평원 서버 응답 지연 (Timeout)', 'detail' => $error]);
} else {
    ob_end_clean();
    echo $response;
}
?>
