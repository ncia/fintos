<?php
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['SCRIPT_NAME'] = '/db_check_full.php';
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

define('_GNUBOARD_', true);
include_once('./common.php');

$output = "";

$output .= "=== G5 CONFIG ===\n";
$output .= "cf_editor: " . $config['cf_editor'] . "\n";
$output .= "cf_theme: " . $config['cf_theme'] . "\n\n";

$output .= "=== G5 EYOOM THEME ===\n";
$res_theme = sql_query("select * from {$g5['eyoom_theme']}");
while($row = sql_fetch_array($res_theme)) {
    $output .= "de_theme: {$row['de_theme']}, de_shop_theme: {$row['de_shop_theme']}, de_theme_key: {$row['de_theme_key']}\n";
}

file_put_contents('db_output.txt', $output);
echo "Done! saved to db_output.txt\n";
?>
