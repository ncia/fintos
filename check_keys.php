<?php
$d = json_decode(file_get_contents('c:/xampp/htdocs/gnu/data/kcd_disease_codes.json'), true);
$missing = 0;
foreach($d as $i) {
    if(!isset($i['code']) || !isset($i['ko_name']) || !isset($i['en_name'])) {
        $missing++;
    }
}
echo "Missing keys in $missing items\n";
?>
