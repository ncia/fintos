<?php
include_once('./common.php');

// 테이블 생성
$sql = "CREATE TABLE IF NOT EXISTS `g5_fintos_poll` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `question` varchar(255) NOT NULL,
    `option_a` varchar(255) NOT NULL,
    `option_b` varchar(255) NOT NULL,
    `count_a` int(11) NOT NULL DEFAULT 0,
    `count_b` int(11) NOT NULL DEFAULT 0,
    `poll_ip` longtext,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

sql_query($sql);

// 투표 로그 테이블 생성
$sql_log = "CREATE TABLE IF NOT EXISTS `g5_fintos_poll_log` (
    `lc_id` int(11) NOT NULL AUTO_INCREMENT,
    `poll_id` int(11) NOT NULL,
    `mb_id` varchar(20) NOT NULL,
    `ip` varchar(255) NOT NULL,
    `datetime` datetime NOT NULL,
    PRIMARY KEY (`lc_id`),
    KEY `poll_id` (`poll_id`),
    KEY `mb_id` (`mb_id`),
    KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

sql_query($sql_log);

// 데이터 마이그레이션 (이미 데이터가 있으면 건너뜀)
$row = sql_fetch("SELECT count(*) as cnt FROM `g5_fintos_poll` ");
if ($row['cnt'] == 0) {
    $json_file = G5_PATH . '/insurance_poll_data.json';
    if (file_exists($json_file)) {
        $json_data = file_get_contents($json_file);
        $polls = json_decode($json_data, true);
        
        foreach ($polls as $p) {
            // 초기 가상 투표 데이터 생성
            $ca = rand(50, 500);
            $cb = rand(50, 500);
            
            $q = sql_real_escape_string($p['question']);
            $oa = sql_real_escape_string($p['option_a']);
            $ob = sql_real_escape_string($p['option_b']);
            
            sql_query("INSERT INTO `g5_fintos_poll` SET question='{$q}', option_a='{$oa}', option_b='{$ob}', count_a='{$ca}', count_b='{$cb}' ");
        }
        echo "Migration Success: " . count($polls) . " items inserted.";
    } else {
        echo "Error: JSON file not found.";
    }
} else {
    echo "Table already has data. Skipping migration.";
}
?>
