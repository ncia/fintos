<?php
include_once('./common.php');
sql_query("UPDATE {$g5['config_table']} SET cf_editor = 'smarteditor2'");
echo "DONE\n";
?>
