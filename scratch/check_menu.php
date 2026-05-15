<?php
include_once('./common.php');
$result = sql_query("select me_id, me_code, me_name from {$g5['menu_table']} where me_name like '%보장 점검%'");
while($row = sql_fetch_array($result)) {
    echo "Parent Menu: " . $row['me_name'] . " (Code: " . $row['me_code'] . ")\n";
    $parent_code = $row['me_code'];
    
    // Submenus
    $sub_sql = "select me_id, me_name, me_code from {$g5['menu_table']} where me_code like '$parent_code%' and length(me_code) > length('$parent_code') order by me_code asc";
    $sub_result = sql_query($sub_sql);
    while($sub_row = sql_fetch_array($sub_result)) {
        echo "  - Submenu: " . $sub_row['me_name'] . " (ID: " . $sub_row['me_id'] . ", Code: " . $sub_row['me_code'] . ")\n";
    }
}
?>
