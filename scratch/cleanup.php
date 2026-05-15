<?php
$files = [
    'check_brand_db.php',
    'check_brand_images.php',
    'delete_unused_brands.php',
    'find_unused_brands.php',
    'find_unused_brands_fast.php'
];

foreach ($files as $file) {
    $path = 'C:/xampp/htdocs/gnu/scratch/' . $file;
    if (file_exists($path)) {
        unlink($path);
    }
}
?>
