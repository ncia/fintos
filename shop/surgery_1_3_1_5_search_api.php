<?php
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

$json_file = './surgery_1_3_1_5_data.json';
if (!file_exists($json_file)) {
    echo json_encode(['error' => '데이터 파일을 찾을 수 없습니다.']);
    exit;
}

$data = json_decode(file_get_contents($json_file), true);

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$type_3 = isset($_GET['type_3']) ? trim($_GET['type_3']) : '';
$type_5 = isset($_GET['type_5']) ? trim($_GET['type_5']) : '';
$mode = isset($_GET['mode']) ? trim($_GET['mode']) : ''; // '1-3' or '1-5'

$results = [];

foreach ($data as $item) {
    if ($q && strpos($item['name'], $q) === false) continue;
    if ($type_3 && $item['type_1_3'] !== $type_3) continue;
    if ($type_5 && $item['type_1_5'] !== $type_5) continue;

    $results[] = [
        'name' => $item['name'],
        'type_1_3' => $item['type_1_3'],
        'type_1_5' => $item['type_1_5']
    ];
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;
$total = count($results);
$paged_results = array_slice($results, $offset, $limit);

echo json_encode([
    'total' => $total,
    'items' => $paged_results
]);
?>
