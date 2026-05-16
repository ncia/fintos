<?php
include_once('./common.php');
$ec_code = '1658729735';
$sql = "select * from {$g5['eyoom_contents']} where ec_code = '$ec_code'";
$row = sql_fetch($sql);

echo "--- EB Contents Master Info ---\n";
if ($row) {
    foreach($row as $key => $val) {
        echo "$key: $val\n";
    }
} else {
    echo "No contents master found for $ec_code\n";
}
echo "-------------------------------\n";
?>
