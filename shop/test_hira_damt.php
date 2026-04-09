<?php
header('Content-Type: application/text; charset=utf-8');
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';
$url = "http://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemHospDamtList";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&yadmNm=" . urlencode("삼성서울병원");
$url .= "&numOfRows=10&_type=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo "Calling URL: $url\n\n";
$response = curl_exec($ch);
echo "Response:\n";
echo $response;
curl_close($ch);
?>
