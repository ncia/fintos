<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null) {
        file_put_contents('last_error.txt', print_r($error, true));
    }
});

$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['REQUEST_URI'] = '/gnu/';
$_SERVER['SCRIPT_NAME'] = '/gnu/index.php';

include_once('./common.php');
include_once(G5_PATH.'/shop/index.php');
