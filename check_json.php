<?php
$jsonFile = 'c:/xampp/htdocs/gnu/data/kcd_disease_codes.json';
$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);
if ($data === null) {
    echo "JSON Error: " . json_last_error_msg() . "\n";
} else {
    echo "JSON OK. Count: " . count($data) . "\n";
}
?>
