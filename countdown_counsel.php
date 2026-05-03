<?php
include_once('./_common.php');

// 이윰빌더 테마 환경 상수를 활성화합니다.
if (!defined('_EYOOM_')) define('_EYOOM_', true);

$g5['title'] = '상담 신청';

// 전체 레이아웃을 포함하는 head.php를 사용합니다.
include_once(G5_PATH.'/head.php');

// 테마의 스킨 경로 설정 (명시적 경로 지정)
$skin_file = G5_PATH . '/theme/eb4_shop_020/skin/member/basic/countdown_counsel.skin.html.php';

if (file_exists($skin_file)) {
    include_once($skin_file);
} else {
    echo "<div style='padding:100px 20px; text-align:center; background:#f8f9fa;'>
            <h3 style='color:#dc3545;'>스킨 파일을 찾을 수 없습니다.</h3>
            <p style='color:#6c757d;'>확인된 경로: " . $skin_file . "</p>
          </div>";
}

// 전체 레이아웃을 마무리하는 tail.php를 사용합니다.
include_once(G5_PATH.'/tail.php');
?>
