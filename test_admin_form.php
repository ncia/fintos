<?php
define('_EYOOM_IS_ADMIN_', true);
define('_GNUBOARD_', true);
include_once('./common.php');

$_GET['dir'] = 'theme';
$_GET['pid'] = 'ebslider_itemform';
$_GET['thema'] = 'eb4_shop_020';
$_GET['es_code'] = '1659255375';
$_GET['ei_no'] = '24';
$_GET['w'] = 'u';
$_GET['iw'] = 'u';
$_GET['wmode'] = '1';

$iw = $_GET['iw'];
$wmode = $_GET['wmode'];

// Mock global variables that theme_head or ebslider_itemform might use
$this_theme = $_GET['thema'];

echo "--- Executing ebslider_itemform.php ---\n";
include_once('adm/eyoom_admin/core/theme/ebslider_itemform.php');
echo "\n--- Execution Finished ---\n";
?>
