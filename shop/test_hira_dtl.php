<?php
header('Content-Type: text/plain; charset=utf-8');
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';
$url = "http://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemHospDtlList";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&yadmNm=" . urlencode("중앙대학교병원");
$url .= "&numOfRows=1&_type=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
echo "RESPONSE:\n" . $response;
curl_close($ch);
?>
