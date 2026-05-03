<?php
include_once(__DIR__ . '/../../../_common.php');

$sql = "SELECT is_name, is_file, is_regdt FROM g5_shop_item_counsel WHERE is_source = '반려동물보험' ORDER BY is_regdt DESC";
$result = sql_query($sql);

echo "is_name | is_file | is_regdt\n";
echo "------------------------------\n";

if ($result) {
    while($row = sql_fetch_array($result)) {
        echo "{$row['is_name']} | {$row['is_file']} | {$row['is_regdt']}\n";
    }
} else {
    echo "Query failed.\n";
}
?>
