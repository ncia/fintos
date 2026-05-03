<?php
$file = 'counsel_update.php';
$content = file_get_contents($file);

function print_hex($str) {
    $hex = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $hex .= sprintf("%02X ", ord($str[$i]));
    }
    return trim($hex);
}

// 카운트다운과 보험통합조회 비교
preg_match("/'카운트다운'/", $content, $m1);
preg_match("/'보험통합조회'/", $content, $m2);
preg_match("/'보험나이알기'/", $content, $m3);

echo "Countdown: " . ($m1 ? print_hex($m1[0]) : "Not found") . "\n";
echo "InsAge:    " . ($m3 ? print_hex($m3[0]) : "Not found") . "\n";
echo "InsCheck:  " . ($m2 ? print_hex($m2[0]) : "Not found") . "\n";
?>
