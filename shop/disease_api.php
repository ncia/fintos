<?php
include_once('./_common.php');

// 에러 출력 방지 및 버퍼 초기화
error_reporting(0);
ob_start();

header('Content-Type: application/json; charset=utf-8');

$searchText = isset($_GET['searchText']) ? trim($_GET['searchText']) : '';
$page = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
$limit = isset($_GET['numOfRows']) ? (int)$_GET['numOfRows'] : 20;

if (!$searchText) {
    ob_end_clean();
    echo json_encode(['error' => '검색어를 입력해주세요.', 'items' => [], 'totalCount' => 0]);
    exit;
}

$jsonFile = G5_DATA_PATH . '/kcd_disease_codes.json';

if (!file_exists($jsonFile)) {
    ob_end_clean();
    echo json_encode(['error' => '데이터 파일을 찾을 수 없습니다.', 'items' => [], 'totalCount' => 0]);
    exit;
}

$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

if (!$data) {
    ob_end_clean();
    echo json_encode(['error' => '데이터 파싱 오류.', 'items' => [], 'totalCount' => 0]);
    exit;
}

$results = [];
$searchTextUpper = mb_strtoupper($searchText, 'UTF-8');

foreach ($data as $item) {
    $code = isset($item['code']) ? $item['code'] : '';
    $ko_name = isset($item['ko_name']) ? $item['ko_name'] : '';
    $en_name = isset($item['en_name']) ? $item['en_name'] : '';

    $score = 0;

    // 1. 코드가 입력값으로 시작하는 경우 (가장 높은 우선순위)
    if (mb_stripos($code, $searchText, 0, 'UTF-8') === 0) {
        $score = 10;
    }
    // 2. 상병명이 입력값으로 시작하는 경우
    else if (mb_stripos($ko_name, $searchText, 0, 'UTF-8') === 0 || mb_stripos($en_name, $searchText, 0, 'UTF-8') === 0) {
        $score = 5;
    }
    // 3. 상병명에 입력값이 포함된 경우
    else if (mb_stripos($ko_name, $searchText, 0, 'UTF-8') !== false || mb_stripos($en_name, $searchText, 0, 'UTF-8') !== false) {
        $score = 1;
    }

    if ($score > 0) {
        $results[] = [
            'sickCd' => $code,
            'sickNm' => $ko_name,
            'sickEngNm' => $en_name,
            'score' => $score
        ];
    }
}

// 우선순위 점수(score) 내림차순, 점수가 같으면 코드(sickCd) 오름차순 정렬
usort($results, function($a, $b) {
    if ($a['score'] === $b['score']) {
        return strcmp($a['sickCd'], $b['sickCd']);
    }
    return $b['score'] - $a['score'];
});

$totalCount = count($results);
$offset = ($page - 1) * $limit;
$paginatedItems = array_slice($results, $offset, $limit);

// 출력 버퍼 비우고 JSON 출력
ob_end_clean();
echo json_encode([
    'body' => [
        'totalCount' => $totalCount,
        'items' => [
            'item' => $paginatedItems
        ]
    ]
]);
?>
