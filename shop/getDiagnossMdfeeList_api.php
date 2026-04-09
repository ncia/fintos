<?php
error_reporting(0);
ob_start();
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

// HIRA 진료 수가 정보 조회 API 프록시 (심사평가원_수가기준정보조회서비스)
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

$pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$numOfRows = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 10; 
$mdfeeCd = isset($_GET['mdfeeCd']) ? trim($_GET['mdfeeCd']) : ''; // 수가코드
$mdfeeDivNo = isset($_GET['mdfeeDivNo']) ? trim($_GET['mdfeeDivNo']) : ''; // 분류번호
$korNm = isset($_GET['korNm']) ? trim($_GET['korNm']) : ''; // 수가 한글명

if (!$mdfeeCd && !$mdfeeDivNo && !$korNm) {
    echo json_encode(['error' => '검색어(수가코드, 분류번호, 한글명 중 하나 이상)를 입력해주세요.']);
    exit;
}

$baseUrl = "https://apis.data.go.kr/B551182/mdfeeCrtrInfoService/getDiagnossMdfeeList";
$queryParams = '?' . urlencode('serviceKey') . '=' . urlencode($serviceKey);
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode($pageNo);
$queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode($numOfRows);
if ($mdfeeCd) $queryParams .= '&' . urlencode('mdfeeCd') . '=' . urlencode($mdfeeCd);
if ($mdfeeDivNo) $queryParams .= '&' . urlencode('mdfeeDivNo') . '=' . urlencode($mdfeeDivNo);
if ($korNm) $queryParams .= '&' . urlencode('korNm') . '=' . urlencode($korNm);
$queryParams .= '&' . urlencode('_type') . '=' . urlencode('json');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
]);
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    $errorMsg = curl_error($ch);
    ob_end_clean();
    echo json_encode(['error' => 'API 요청 실패 (' . $errorMsg . ')']);
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
