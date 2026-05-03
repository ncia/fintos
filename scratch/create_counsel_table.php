<?php
include_once('./_common.php');

$sql = "CREATE TABLE IF NOT EXISTS `{$g5['g5_shop_item_table']}_counsel` (
  `is_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_source` varchar(50) DEFAULT '',
  `is_name` varchar(50) DEFAULT '',
  `is_hp` varchar(20) DEFAULT '',
  `is_birth` varchar(10) DEFAULT '',
  `is_sex` char(1) DEFAULT '',
  `is_counsel_time` varchar(100) DEFAULT '',
  `is_kakao_agree` char(1) DEFAULT 'N',
  `is_email_sms_agree` char(1) DEFAULT 'N',
  `is_it_id` varchar(20) DEFAULT '',
  `is_subject` varchar(255) DEFAULT '',
  `is_content` text,
  `is_status` varchar(20) DEFAULT '접수',
  `is_ip` varchar(255) DEFAULT '',
  `is_regdt` datetime DEFAULT NULL,
  PRIMARY KEY (`is_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (sql_query($sql)) {
    echo "Table g5_shop_item_counsel created successfully.";
} else {
    echo "Error creating table: " . sql_error();
}
?>
