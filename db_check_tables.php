<?php
define('_GNUBOARD_', true);
include_once('./data/dbconfig.php');

$conn = mysqli_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD, G5_MYSQL_DB);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8');

$output = "=== All Tables ===\n";
$res = mysqli_query($conn, "SHOW TABLES");
while($row = mysqli_fetch_row($res)) {
    $output .= $row[0] . "\n";
}

file_put_contents('tables.txt', $output);
echo "Done! saved to tables.txt\n";
mysqli_close($conn);
?>
