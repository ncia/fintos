<?php
$data = file_get_contents('c:\xampp\htdocs\gnu\test_post_out.html');
$data = mb_convert_encoding($data, 'UTF-8', 'UTF-16LE');
if (preg_match('/alert\("([^"]+)"\)/', $data, $m)) {
    echo "ALERT FOUND: " . $m[1] . "\n";
} else if (preg_match("/alert\('([^']+)'\)/", $data, $m)) {
    echo "ALERT FOUND: " . $m[1] . "\n";
} else {
    echo "NO ALERT MATCH\n";
}
?>
