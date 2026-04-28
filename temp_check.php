<?php
include_once('./common.php');
$sql = "select cf_image_extension from {$g5['config_table']}";
$row = sql_fetch($sql);
echo "CF_IMAGE_EXTENSION: " . $row['cf_image_extension'] . "\n";
echo "IMAGEWEBP_EXISTS: " . (function_exists('imagewebp') ? 'YES' : 'NO') . "\n";
?>
