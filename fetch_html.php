<?php
$html = file_get_contents('http://localhost/gnu/');
file_put_contents('main_html.txt', $html);
?>
