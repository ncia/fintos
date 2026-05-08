<?php
include_once('./_common.php');
// if (!$is_admin) die('관리자 권한이 필요합니다.');
sql_query("update {$g5['config_table']} set cf_editor = 'summernote'");
echo "설정이 변경되었습니다. cf_editor = 'summernote'";
?>
