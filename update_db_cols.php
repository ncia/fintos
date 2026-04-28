<?php
$conn = mysqli_connect('localhost', 'nciame_gnu', 'mcXT@3NDymqcZm@f', 'nciame_gnu');
mysqli_query($conn, "SET SESSION sql_mode = ''");

$cols = [
    'product_title' => 'varchar(255) NOT NULL DEFAULT ""',
    'mb_promotion_agree' => 'tinyint(4) NOT NULL DEFAULT "0"'
];

foreach ($cols as $col => $type) {
    $res = mysqli_query($conn, "SHOW COLUMNS FROM g5_member LIKE '$col'");
    if (mysqli_num_rows($res) == 0) {
        mysqli_query($conn, "ALTER TABLE g5_member ADD `$col` $type AFTER mb_memo");
        echo "Added $col\n";
    } else {
        echo "$col already exists\n";
    }
}
?>
