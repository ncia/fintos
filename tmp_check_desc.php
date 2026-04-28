<?php
include_once('c:/xampp/htdocs/gnu/common.php');
$sql = "DESC g5_member";
$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    echo $row['Field'] . " | " . $row['Type'] . "\n";
}
?>
