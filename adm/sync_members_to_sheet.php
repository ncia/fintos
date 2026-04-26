<?php
include_once('./_common.php');
if ($is_admin != 'super') die('최고관리자만 접근 가능합니다.');
// 1. 기존 회원 전체 추출
$sql = " select * from {$g5['member_table']} where mb_id <> '{$config['cf_admin']}' order by mb_datetime asc ";
$result = sql_query($sql);
$data = array();
while($row = sql_fetch_array($result)) {
    $data[] = array(
        $row['mb_datetime'],
        $row['mb_id'],
        $row['mb_name'],
        $row['mb_email'],
        $row['mb_hp'],
        $row['mb_addr1'] . ' ' . $row['mb_addr2'],
        '', // 유입경로 (기존회원은 알 수 없음)
        $row['mb_ip']
    );
}
// 2. 구글로 전송
$post_data = array(
    'action' => 'sync_all',
    'data'   => $data
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $config['cf_googlesheet_url']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);
echo "<h3>전체 동기화 결과</h3>";
echo "총 " . count($data) . "명의 정보를 전송했습니다.<br>";
echo "구글 응답: " . $response;
?>