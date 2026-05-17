<?php
include_once('./common.php');
include_once(G5_LIB_PATH.'/eyoom.lib.php');

$es_code = '1659255375';
$es_master = sql_fetch("select * from {$g5['eyoom_slider']} where es_code = '$es_code'");
$this_theme = $es_master['es_theme'];
$theme = $this_theme; // Skin expects $theme

// Get items
$sql = "select * from {$g5['eyoom_slider_item']} where es_code = '{$es_code}' order by ei_sort asc";
$result = sql_query($sql);
$slider = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $slider[$i] = $row;
}

$is_admin = 'super'; // Simulate admin
define('G5_IS_MOBILE', false);

echo "--- Rendered Link for HIT ITEMS ---\n";
foreach ($slider as $item) {
    $admin_url = G5_ADMIN_URL . "/?dir=theme&pid=ebslider_itemform&thema=" . $theme . "&es_code=" . $es_code . "&ei_no=" . $item['ei_no'] . "&w=u&iw=u&wmode=1";
    echo "Item No: " . $item['ei_no'] . "\n";
    echo "Generated Admin URL: " . $admin_url . "\n";
}
?>
