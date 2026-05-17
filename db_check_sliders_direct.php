<?php
define('_GNUBOARD_', true);
include_once('./data/dbconfig.php');

$conn = mysqli_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD, G5_MYSQL_DB);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8');

echo "=== Sliders ===\n";
$res = mysqli_query($conn, "select * from g5_eyoom_slider");
while($row = mysqli_fetch_assoc($res)) {
    echo "es_code: {$row['es_code']}, es_subject: {$row['es_subject']}, es_theme: {$row['es_theme']}\n";
}

echo "\n=== Eyoom Config (Active Theme) ===\n";
$res2 = mysqli_query($conn, "select * from g5_eyoom_config limit 1");
$eyoom_config = mysqli_fetch_assoc($res2);
print_r($eyoom_config);

echo "\n=== Eyoom Slider Items for HIT ITEMS ===\n";
$res3 = mysqli_query($conn, "select * from g5_eyoom_slider_item");
while($row = mysqli_fetch_assoc($res3)) {
    echo "ei_no: {$row['ei_no']}, es_code: {$row['es_code']}, ei_theme: {$row['ei_theme']}, ei_state: {$row['ei_state']}, ei_title: {$row['ei_title']}\n";
}
mysqli_close($conn);
?>
