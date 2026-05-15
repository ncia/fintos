<?php
$host = '127.0.0.1';
$user = 'nciame_gnu';
$pass = 'mcXT@3NDymqcZm@f';
$db   = 'nciame_gnu';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$res = mysqli_query($conn, "SELECT de_bodmi_font_weight, de_all_bodmi_font_weight FROM g5_shop_default LIMIT 1");
if ($row = mysqli_fetch_assoc($res)) {
    echo "PC_FONT_WEIGHT: " . ($row['de_bodmi_font_weight'] ? $row['de_bodmi_font_weight'] : "미설정") . "\n";
    echo "ALL_FONT_WEIGHT: " . ($row['de_all_bodmi_font_weight'] ? $row['de_all_bodmi_font_weight'] : "미설정") . "\n";
} else {
    echo "No data found in g5_shop_default table.";
}

mysqli_close($conn);
?>
