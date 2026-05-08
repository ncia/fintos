<?php
$host = 'localhost';
$user = 'nciame_gnu';
$pass = 'mcXT@3NDymqcZm@f';
$db   = 'nciame_gnu';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("UPDATE g5_config SET cf_editor = 'summernote'");
    $stmt->execute();
    echo "Success: cf_editor updated to 'summernote'";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
