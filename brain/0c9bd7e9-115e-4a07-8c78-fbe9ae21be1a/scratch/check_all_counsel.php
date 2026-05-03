<?php
include_once(__DIR__ . '/../../../_common.php');

$sql = "SELECT is_name, is_file, is_regdt, is_source FROM g5_shop_item_counsel ORDER BY is_regdt DESC LIMIT 20";
$result = sql_query($sql);

echo "is_name | is_file | is_regdt | is_source\n";
echo "----------------------------------------\n";

if ($result) {
    while($row = sql_fetch_array($result)) {
        echo "{$row['is_name']} | {$row['is_file']} | {$row['is_regdt']} | {$row['is_source']}\n";
    }
}
?>
