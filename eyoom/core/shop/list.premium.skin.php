<?php
/**
 * core file : /eyoom/core/shop/list.premium.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * item_list 클래스내에서 실행되는 파일로 글로벌 선언이 필요함
 */
global $skin_dir, $shop;

/**
 * 스킨 디렉토리 정의 (이윰 코어 쇼핑몰 경로)
 */
$skin_dir = EYOOM_CORE_PATH . '/shop';

/**
 * 상품리스트 공통 데이터 처리
 */
include_once($skin_dir.'/list.skin.php');

/**
 * 테마 스킨 출력
 */
if (file_exists(EYOOM_THEME_SHOP_SKIN_PATH.'/list.premium.skin.html.php')) {
    include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/list.premium.skin.html.php');
} else {
    echo "Skin file not found in theme path: " . EYOOM_THEME_SHOP_SKIN_PATH;
}
