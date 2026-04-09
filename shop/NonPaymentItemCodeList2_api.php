<?php
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

// 일반 인증키 (Decoding 상태)
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';

// 사용자가 조회를 요청한 비급여 코드 (npayCd 또는 itmCd)
$npayCd = isset($_GET['npayCd']) ? trim($_GET['npayCd']) : (isset($_GET['itmCd']) ? trim($_GET['itmCd']) : '');

// getNonPaymentItemCodeList2 표준 호출 필터링이 불안정하므로, 전체 목록을 가져와 서버측에서 필터링
$url = "http://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemCodeList2";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&pageNo=1&numOfRows=1000&_type=json"; // 전체 목록(약 875건) 수용

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(['error' => 'API 요청 실패']);
} else {
    $data = json_decode($response, true);
    if ($npayCd && isset($data['response']['body']['items']['item'])) {
        $items = $data['response']['body']['items']['item'];
        $filtered_item = null;
        
        foreach ($items as $item) {
            // 상세코드(npayCd) 또는 대분류코드(itmCd)가 일치하는지 확인
            if ((isset($item['npayCd']) && $item['npayCd'] === $npayCd) || 
                (isset($item['itmCd']) && $item['itmCd'] === $npayCd) ||
                (isset($item['sdrdCd']) && $item['sdrdCd'] === $npayCd)) {
                $filtered_item = $item;
                break;
            }
        }
        
        if ($filtered_item) {
            // 규격에 맞게 단일 아이템을 포함한 응답 구성
            $data['response']['body']['items']['item'] = $filtered_item;
            $data['response']['body']['totalCount'] = 1;
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            // 필터링 결과가 없을 경우 (검색어 기반 지능형 매칭 시도 가능하지만 여기서는 빈 결과 반환)
            $data['response']['body']['items']['item'] = null;
            $data['response']['body']['totalCount'] = 0;
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    } else {
        echo $response;
    }
}
?>
