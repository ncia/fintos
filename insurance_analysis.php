<?php
include_once('./_common.php');

if (!defined('_EYOOM_')) define('_EYOOM_', true);

$g5['title'] = '보험증권 분석';

include_once(G5_PATH.'/head.php');

$skin_file = G5_PATH . '/theme/eb4_shop_020/skin/member/basic/insurance_analysis.skin.html.php';

if (file_exists($skin_file)) {
    include_once($skin_file);
} else {
    echo "<div style='padding:100px 20px; text-align:center; background:#f8f9fa;'>
            <h3 style='color:#dc3545;'>스킨 파일을 찾을 수 없습니다.</h3>
            <p style='color:#6c757d;'>확인된 경로: " . $skin_file . "</p>
          </div>";
}

include_once(G5_PATH.'/tail.php');
?>
