<?php
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');

$searchText = isset($_GET['searchText']) ? trim($_GET['searchText']) : '';
$page = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$limit = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 20;

if (!$searchText) {
    echo json_encode(['error' => '검색어를 입력해주세요.', 'items' => [], 'totalCount' => 0]);
    exit;
}

$jsonFile = G5_DATA_PATH . '/kcd_disease_codes.json';

if (!file_exists($jsonFile)) {
    echo json_encode(['error' => '데이터 파일을 찾을 수 없습니다.', 'items' => [], 'totalCount' => 0]);
    exit;
}

$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

if (!$data) {
    echo json_encode(['error' => '데이터 파싱 오류.', 'items' => [], 'totalCount' => 0]);
    exit;
}

$results = [];
$searchTextLower = strtolower($searchText);

foreach ($data as $item) {
    // Search in code, ko_name, en_name
    if (
        stripos($item['code'], $searchText) !== false ||
        stripos($item['ko_name'], $searchText) !== false ||
        stripos($item['en_name'], $searchText) !== false
    ) {
        $results[] = [
            'sickCd' => $item['code'],
            'sickNm' => $item['ko_name'],
            'sickEngNm' => $item['en_name']
        ];
    }
}

$totalCount = count($results);
$offset = ($page - 1) * $limit;
$paginatedItems = array_slice($results, $offset, $limit);

// Response format matching the previous API's expectations or slightly simplified
echo json_encode([
    'body' => [
        'totalCount' => $totalCount,
        'items' => [
            'item' => $paginatedItems
        ]
    ]
]);
?>
