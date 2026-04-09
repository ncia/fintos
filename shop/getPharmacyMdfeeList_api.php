<?php
error_reporting(0);
ob_start();
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

// HIRA 약국 수가 정보 조회 API 프록시 (제공된 샘플 코드 기준)
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

$pageNo = isset($_GET['pageNo']) ? trim($_GET['pageNo']) : '1';
$numOfRows = isset($_GET['numOfRows']) ? trim($_GET['numOfRows']) : '10'; // 프론트엔드에서 넘어오는 변수명
$mdfeeCd = isset($_GET['mdfeeCd']) ? trim($_GET['mdfeeCd']) : ''; // 수가코드
$mdfeeDivNo = isset($_GET['mdfeeDivNo']) ? trim($_GET['mdfeeDivNo']) : ''; // 분류번호
$korNm = isset($_GET['korNm']) ? trim($_GET['korNm']) : ''; // 수가 한글명

if (!$mdfeeCd && !$mdfeeDivNo && !$korNm) {
    echo json_encode(['error' => '검색어를 입력해주세요.']);
    exit;
}

$baseUrl = 'http://apis.data.go.kr/B551182/mdfeeCrtrInfoService/getPharmacyMdfeeList';
$queryParams = '?' . urlencode('serviceKey') . '=' . urlencode($serviceKey); // 서비스키도 urlencode 적용
$queryParams .= '&' . urlencode('numOfRow') . '=' . urlencode($numOfRows); // API 사양: numOfRow (단수)
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode($pageNo);
if ($mdfeeCd) $queryParams .= '&' . urlencode('mdfeeCd') . '=' . urlencode($mdfeeCd);
if ($mdfeeDivNo) $queryParams .= '&' . urlencode('mdfeeDivNo') . '=' . urlencode($mdfeeDivNo);
if ($korNm) $queryParams .= '&' . urlencode('korNm') . '=' . urlencode($korNm);
$queryParams .= '&' . urlencode('_type') . '=' . urlencode('json');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // SSL 검증 비활성화
curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 타임아웃 30초로 연장
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
]); // 표준 헤더 추가
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    $errorMsg = curl_error($ch);
    ob_end_clean();
    echo json_encode(['error' => 'API 요청 실패 (' . $errorMsg . ')']);
} else {
    ob_end_clean();
    // 만약 JSON 요청에도 XML이 오면 변환
    if (strpos($response, '<?xml') !== false) {
        $xml = @simplexml_load_string($response);
        echo json_encode($xml);
    } else {
        echo $response;
    }
}
?>
