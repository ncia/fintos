<?php
$serviceKey = 'DrTPTFfO2biRkh9JYhIIF7mipPdPVD5BR7jWE%2F9MrN8spdTlyoMFAq0z9dW3JT%2Fz%2B6yOJGIHNHzeLD%2FPVSc%2BZQ%3D%3D';

// Test 1: Sido Name
$url1 = "https://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemHospList2?serviceKey=$serviceKey&pageNo=1&numOfRows=1&sidoCd=" . urlencode('서울특별시') . "&_type=xml";

// Test 2: Sido Code
$url2 = "https://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemHospList2?serviceKey=$serviceKey&pageNo=1&numOfRows=1&sidoCd=110000&_type=xml";

// Test 3: Sido Name with sgguCdNm
$url3 = "https://apis.data.go.kr/B551182/nonPaymentDamtInfoService/getNonPaymentItemHospList2?serviceKey=$serviceKey&pageNo=1&numOfRows=1&sidoCd=110000&sgguCdNm=" . urlencode('강남구') . "&_type=xml";

function test($url, $label) {
    echo "Testing $label: $url\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    echo substr($res, 0, 500) . "\n\n";
}

test($url1, "Sido Name");
test($url2, "Sido Code");
test($url3, "Sido Code + Sggu Name");
