<?php
include_once('./_common.php');
set_session('ss_mb_id', 'test2');
goto_url(G5_BBS_URL.'/register_form.php?w=u&mb_id=test2');
?>
