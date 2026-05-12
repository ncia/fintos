<?php
include_once('./common.php');
$row = sql_fetch("select cf_eyoom_admin_theme from {$g5['config_table']}");
echo "Admin Theme: " . ($row['cf_eyoom_admin_theme'] ? $row['cf_eyoom_admin_theme'] : 'eba_basic') . "\n";
