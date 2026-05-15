<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = '127.0.0.1';
$user = 'nciame_gnu';
$pass = 'mcXT@3NDymqcZm@f';
$db   = 'nciame_gnu';

echo "Connecting to $host...\n";
$conn = mysqli_connect($host, $user, $pass, $db, 3306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully.\n";

$table = 'g5_shop_default';

$queries = [
    "ALTER TABLE `$table` ADD `de_bodmi_font_weight` VARCHAR(10) NOT NULL DEFAULT '' AFTER `de_bodmi_font_size` ",
    "ALTER TABLE `$table` ADD `de_all_bodmi_font_weight` VARCHAR(10) NOT NULL DEFAULT '' AFTER `de_all_bodmi_font_size` "
];

foreach ($queries as $q) {
    if (mysqli_query($conn, $q)) {
        echo "Query success: $q\n";
    } else {
        echo "Error: " . mysqli_error($conn) . "\n";
    }
}

mysqli_close($conn);
?>
