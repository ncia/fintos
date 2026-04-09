<?php
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE/9MrN8spdTlyoMFAq0z9dW3JT/z+6yOJGIHNHzeLD/PVSc+ZQ==';
$url = "http://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemHospList2";
$url .= "?serviceKey=" . urlencode($serviceKey);
$url .= "&pageNo=1&numOfRows=10&_type=json";
$url .= "&yadmNm=" . urlencode("중앙대학교");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo "HTTP CODE: " . $info['http_code'] . "\n";
echo "RESPONSE:\n" . $response . "\n";
?>
