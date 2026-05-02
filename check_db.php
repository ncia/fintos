<?php
include_once('./_common.php');

echo "--- Index Check for g5_member ---\n";
$res = sql_query("SHOW INDEX FROM g5_member");
while($row = sql_fetch_array($res)) {
    echo "Column: " . $row['Column_name'] . " | Unique: " . ($row['Non_unique'] == 0 ? "YES" : "NO") . " | Key_name: " . $row['Key_name'] . "\n";
}

echo "\n--- Column Check for g5_member ---\n";
$res = sql_query("DESC g5_member");
while($row = sql_fetch_array($res)) {
    if (in_array($row['Field'], ['mb_id', 'mb_email', 'mb_hp'])) {
        echo "Field: " . $row['Field'] . " | Type: " . $row['Type'] . " | Key: " . $row['Key'] . "\n";
    }
}
?>
