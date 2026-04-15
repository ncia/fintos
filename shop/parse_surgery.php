<?php
$html = file_get_contents('C:\xampp\htdocs\gnu\shop\surgery_raw.html');
preg_match_all('/<tr>(.*?)<\/tr>/s', $html, $matches);
print('Total rows found: ' . count($matches[0]) . PHP_EOL);

$data = [];
foreach ($matches[0] as $row) {
    preg_match_all('/<td.*?>(.*?)<\/td>/s', $row, $tds);
    if (count($tds[1]) >= 3) {
        $name = strip_tags(trim($tds[1][0]));
        $type_1_3 = strip_tags(trim($tds[1][1]));
        $type_1_5 = strip_tags(trim($tds[1][2]));
        
        if (!empty($name) && $name != '검색결과가 없습니다.') {
            $data[] = [
                'name' => $name,
                'type_1_3' => $type_1_3,
                'type_1_5' => $type_1_5
            ];
        }
    }
}

print('Parsed records: ' . count($data) . PHP_EOL);
if (count($data) > 0) {
    file_put_contents('C:\xampp\htdocs\gnu\shop\surgery_data_new.json', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
