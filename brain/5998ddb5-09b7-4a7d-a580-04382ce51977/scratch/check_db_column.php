<?php
include_once('./data/dbconfig.php');
$conn = mysqli_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD, G5_MYSQL_DB);
if (!$conn) die("Connect failed: " . mysqli_connect_error());
$res = mysqli_query($conn, "DESC g5_member mb_mailling");
$row = mysqli_fetch_assoc($res);
print_r($row);
mysqli_close($conn);
?>
