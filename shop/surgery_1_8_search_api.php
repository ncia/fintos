<?php
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

$json_file = './surgery_1_8_data.json';
if (!file_exists($json_file)) {
    echo json_encode(['error' => '데이터 파일을 찾을 수 없습니다.']);
    exit;
}

$data = json_decode(file_get_contents($json_file), true);

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$code = isset($_GET['code']) ? trim($_GET['code']) : '';
$type = isset($_GET['type']) ? trim($_GET['type']) : '';

$results = [];

foreach ($data as $item) {
    $surgery_name = isset($item['수술 및 시술명']) ? $item['수술 및 시술명'] : (isset($item['수술명']) ? $item['수술명'] : '');
    
    if ($q && strpos($surgery_name, $q) === false) continue;
    if ($code && strpos($item['코드'], $code) === false) continue;
    if ($type && $item['종류'] !== $type) continue;

    $results[] = [
        'name' => $surgery_name,
        'code' => $item['코드'],
        'type' => $item['종류']
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
