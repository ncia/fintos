<?php
include_once('./common.php');

$mb_id = 'test2';
$new_hp = '010-2627-7784';

echo "--- DB Update Test ---\n";
echo "Target ID: $mb_id\n";

// Current state
$row_before = sql_fetch("SELECT mb_hp FROM {$g5['member_table']} WHERE mb_id = '$mb_id'");
echo "Current HP: " . ($row_before['mb_hp'] ?? 'NULL') . "\n";

// Update
$sql = "UPDATE {$g5['member_table']} SET mb_hp = '$new_hp' WHERE mb_id = '$mb_id'";
echo "Executing: $sql\n";
sql_query($sql);

// Verify
$row_after = sql_fetch("SELECT mb_hp FROM {$g5['member_table']} WHERE mb_id = '$mb_id'");
echo "Updated HP: " . ($row_after['mb_hp'] ?? 'NULL') . "\n";

if ($row_after['mb_hp'] === $new_hp) {
    echo "SUCCESS: Database updated correctly.\n";
} else {
    echo "FAILURE: Database not updated.\n";
}
?>
