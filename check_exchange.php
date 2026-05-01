<?php
include_once('./_common.php');
$pathinfo = array('dirname' => 'bbs', 'basename' => 'register_form.php', 'filename' => 'register_form', 'extension' => 'php');
$exchange_file = $eb->exchange_file($pathinfo);
echo "EXCHANGE_FILE:" . $exchange_file . "\n";
?>
