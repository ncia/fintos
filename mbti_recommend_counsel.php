<?php
include_once('./_common.php');

if (!defined('_EYOOM_')) define('_EYOOM_', true);

$g5['title'] = 'MBTI 추천 보험 상담하기';

// MBTI 정보 매핑
$mbti = isset($_GET['mbti']) ? clean_xss_tags($_GET['mbti']) : '';
$mbti_nickname = '';

$mbti_data = array(
    'INTJ' => '완벽주의 전략가',
    'INTP' => '논리적인 사색가',
    'ENTJ' => '대담한 통솔자',
    'ENTP' => '뜨거운 논쟁을 즐기는 변론가',
    'INFJ' => '선의의 옹호자',
    'INFP' => '열정적인 중재자',
    'ENFJ' => '정의로운 사회운동가',
    'ENFP' => '재기발랄한 활동가',
    'ISTJ' => '청렴결백한 논리주의자',
    'ISFJ' => '용감한 수호자',
    'ESTJ' => '엄격한 관리자',
    'ESFJ' => '사교적인 외교관',
    'ISTP' => '만능 재주꾼',
    'ISFP' => '호기심 많은 예술가',
    'ESTP' => '모험을 즐기는 사업가',
    'ESFP' => '자유로운 영혼의 연예인'
);

$mbti_icons = array(
    'INTJ' => 'fa-chess-knight',
    'INTP' => 'fa-microscope',
    'ENTJ' => 'fa-crown',
    'ENTP' => 'fa-lightbulb',
    'INFJ' => 'fa-feather-alt',
    'INFP' => 'fa-heart',
    'ENFJ' => 'fa-users-cog',
    'ENFP' => 'fa-star',
    'ISTJ' => 'fa-clipboard-check',
    'ISFJ' => 'fa-user-shield',
    'ESTJ' => 'fa-gavel',
    'ESFJ' => 'fa-hand-holding-heart',
    'ISTP' => 'fa-tools',
    'ISFP' => 'fa-paint-brush',
    'ESTP' => 'fa-motorcycle',
    'ESFP' => 'fa-music'
);

if ($mbti && isset($mbti_data[$mbti])) {
    $mbti_nickname = $mbti_data[$mbti];
    $mbti_icon = isset($mbti_icons[$mbti]) ? $mbti_icons[$mbti] : 'fa-heart';
}

include_once(G5_PATH.'/head.php');

$skin_file = G5_PATH . '/theme/eb4_shop_020/skin/member/basic/mbti_recommend_counsel.skin.html.php';

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
