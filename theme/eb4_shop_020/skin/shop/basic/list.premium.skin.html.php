<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/list.premium.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

// 현재 타입에 따른 배너 슬라이더 코드 설정
$es_code_banner = '';
if ($this->type == 1) {
    $es_code_banner = '1659255375'; // 랜덤 상품
} else if ($this->type == 2) {
    $es_code_banner = '1659257180'; // 추천 상품
} else if ($this->type == 3) {
    $es_code_banner = '1659312032'; // 최신 상품
} else if ($this->type == 4) {
    $es_code_banner = '1659316824'; // 인기 상품
}

// 만약 해당 타입에 매핑된 배너 코드가 있다면 상태를 판별
$banner_show_2 = false;
if ($es_code_banner) {
    $es_slider_info = sql_fetch("select es_state from {$g5['eyoom_slider']} where es_code = '{$es_code_banner}'");
    $ei_active_check_info = sql_fetch("select count(*) as cnt from {$g5['eyoom_slider_item']} where es_code = '{$es_code_banner}' and ei_state = '1'");
    $banner_show_2 = ($es_slider_info['es_state'] == '1' && $ei_active_check_info['cnt'] > 0) ? true: false;
}

add_stylesheet('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">', 0);
?>

<style>
.premium-product-list {position:relative}
.premium-product-list .item-list-container {margin-left:-10px;margin-right:-10px}
.premium-product-list .item-list-container:after {content:"";display:block;clear:both}
.premium-product-list .item-list-wrap {padding:10px;width:25%;float:left}
.premium-product-list .item-list {position:relative;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out; border: 1px solid #f0f0f0; padding: 5px; border-radius: 0px; background: #fff;}
.premium-product-list .goods-img {position:relative;overflow:hidden;margin-bottom:10px;background:#fff}
.premium-product-list .goods-img-in {position:relative;overflow:hidden;width:100%}
.premium-product-list .goods-img-in:before {content:"";display:block;padding-top:<?php echo !$banner_show_2 ? '85%' : '75%'; ?>;background:#fff}
.premium-product-list .goods-img-in img {display:block;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}

.premium-product-list .goods-description {position:relative;overflow:hidden;padding:0 0 10px}
.premium-product-list .goods-name {position:relative;overflow:hidden;margin:10px 0 5px;font-size:<?php echo !$banner_show_2 ? '1.25rem' : '1.10rem'; ?>;font-weight:700;line-height:1.4;height:<?php echo !$banner_show_2 ? '55px' : '47px'; ?>;text-align:center}
.premium-product-list .goods-name a {color:#ff8a37;text-decoration:none}
.premium-product-list .goods-name a:hover {text-decoration:underline}
.premium-product-list .goods-info {position:relative;overflow:hidden;min-height:<?php echo !$banner_show_2 ? '42px' : '38px'; ?>;color:#454545;font-size:<?php echo !$banner_show_2 ? '15px' : '14px'; ?>;margin-top:10px;text-align:center;line-height:1.4}

/* Labels */
.premium-product-list .rgba-banner-area {position:absolute;top:5px;right:5px;z-index:10}
.premium-product-list .rgba-banner {height:25px;width:25px;line-height:25px;color:#fff;font-size:.6875rem;text-align:center;font-weight:400;position:relative;text-transform:uppercase;margin-bottom:2px;border-radius:50px;display:block}
.premium-product-list .shop-rgba-dark {background:#363b43}
.premium-product-list .shop-rgba-yellow {background:#ec8b00}
.premium-product-list .shop-rgba-red {background:#ab0000}
.premium-product-list .shop-rgba-green {background:#00897b}

/* Countdown */
.premium-product-list .all-countdown-container {display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; width: 100%; gap: 6px 10px;}

/* SNS Share */
.premium-product-list .goods-share {display:flex; width:fit-content; margin:15px auto 0; justify-content:center; align-items:center; gap:5px; padding:5px; background:#fcfcfc; border:1px solid #f0f0f0; border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.03);}
.premium-product-list .goods-share img {width:30px; height:30px; border-radius:4px; display:block}

@media (max-width:1199px) {
    .premium-product-list .item-list-wrap {width:50%;}
}
@media (max-width:767px) {
    .premium-product-list .item-list-wrap {width:50%; padding:5px 2px}
    .premium-product-list .item-list-container {margin-left:-2px;margin-right:-2px}
    .premium-product-list .goods-share {gap:2px; padding:3px;}
    .premium-product-list .goods-share img {width:24px; height:24px;}
}
</style>

<div class="premium-product-list">
    <div class="item-list-container">
        <?php for ($i=0; $i<count((array)$list); $i++) { 
            $it_href = $list[$i]['href'];
            $it_name = stripslashes($list[$i]['it_name']);
            $it_basic = stripslashes($list[$i]['it_basic']);
            $it_image = get_it_image($list[$i]['it_id'], 400, 300);
            
            $sns_url = G5_SHOP_URL.'/item.php?it_id='.$list[$i]['it_id'];
            $sns_title = get_text($list[$i]['it_name']);
            $data_sns_url = urlencode($sns_url);
            $data_sns_title = urlencode($sns_title);
        ?>
        <div class="item-list-wrap">
            <div class="item-list">
                <div class="goods-img animate-img-hvr">
                    <div class="goods-img-in">
                        <a href="<?php echo $it_href; ?>">
                            <?php echo $it_image; ?>
                        </a>
                        <div class="rgba-banner-area">
                            <?php if ($list[$i]['it_type1']) { ?><span class="rgba-banner shop-rgba-dark">랜덤</span><?php } ?>
                            <?php if ($list[$i]['it_type2']) { ?><span class="rgba-banner shop-rgba-yellow">추천</span><?php } ?>
                            <?php if ($list[$i]['it_type3']) { ?><span class="rgba-banner shop-rgba-red">최신</span><?php } ?>
                            <?php if ($list[$i]['it_type4']) { ?><span class="rgba-banner shop-rgba-green">인기</span><?php } ?>
                        </div>
                    </div>
                </div>

                <div class="goods-description">
                    <?php
                    // 브랜드 와이드 로고 가져오기
                    if ($list[$i]['it_brand']) {
                        $br_info = sql_fetch("select br_code, br_img_wide from {$g5['eyoom_brand']} where br_name = '".sql_real_escape_string($list[$i]['it_brand'])."'");
                        if ($br_info['br_img_wide']) {
                            $br_img_wide_url = G5_DATA_URL.'/brand/wide_logo/'.$br_info['br_img_wide'];
                            $br_href = G5_SHOP_URL.'/brand.php?br_cd='.urlencode($br_info['br_code']);
                            echo '<div style="text-align:center; margin-top:5px;"><a href="'.$br_href.'"><img src="'.$br_img_wide_url.'" style="height:20px; width:auto;"></a></div>';
                        }
                    }
                    ?>
                    <h4 class="goods-name">
                        <a href="<?php echo $it_href; ?>"><?php echo $it_name; ?></a>
                    </h4>

                    <div class="goods-info"><?php echo $it_basic; ?></div>

                    <?php if ($default['de_all_bodmi_use']) { ?>
                    <div class="all-countdown-container" style="background: <?php echo $default['de_all_bodmi_bg_color']; ?>; border: 1px solid <?php echo $default['de_all_bodmi_font_color']; ?>; color: <?php echo $default['de_all_bodmi_font_color']; ?>; padding: 4px 10px; font-size: 12px; margin: 10px 0; border-radius: 4px;">
                        <div class="all-countdown-title" style="display:flex; align-items:center; gap: 5px; font-weight:700;">
                            <i class="fas fa-gift" style="font-size: 11px;"></i> <?php echo $default['de_all_bodmi_title']; ?>
                        </div>
                        <div class="all-countdown-timer" style="font-weight:700;">
                            <?php echo rand(100, 150); ?>일 <?php echo sprintf("%02d", rand(0, 23)); ?>시 <?php echo sprintf("%02d", rand(0, 59)); ?>분
                        </div>
                    </div>
                    <?php } ?>

                    <a href="<?php echo $it_href; ?>#sit_use" class="goods-rating" style="display:flex; justify-content:center; align-items:center; gap:1px; margin-top:8px; line-height:1; text-decoration:none !important;">
                        <div style="color:#ffc107; font-size:14px; display:flex; align-items:center; gap:1px;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <div style="position:relative; display:inline-block; width:14px; height:14px; font-size:14px;">
                                <i class="far fa-star" style="color:rgba(0,0,0,0.1); position:absolute; left:0; top:0;"></i>
                                <div style="width:75%; overflow:hidden; position:absolute; left:0; top:0; white-space:nowrap;">
                                    <i class="fas fa-star" style="color:#ffc107;"></i>
                                </div>
                            </div>
                        </div>
                        <span style="color:#bb3312; font-size:13px; font-weight:700; margin-left:6px; position:relative; top:1px;">평점 4.75</span>
                    </a>

                    <div class="goods-share">
                        <a href="javascript:void(0);" title="공유"><img src="<?php echo G5_URL; ?>/data/icon/share_icon.png"></a>
                        <a href="javascript:void(0);" title="카카오톡 공유"><img src="<?php echo G5_URL; ?>/data/icon/kakaotalk.png"></a>
                        <a href="javascript:void(0);" title="카카오채널"><img src="<?php echo G5_URL; ?>/data/icon/kakao_ch.png"></a>
                        <a href="https://share.naver.com/share?url=<?php echo $data_sns_url; ?>&title=<?php echo $data_sns_title; ?>" target="_blank" title="네이버 블로그"><img src="<?php echo G5_URL; ?>/data/icon/naver_blog.png"></a>
                        <a href="https://band.us/plugin/share?body=<?php echo $data_sns_title; ?>%0A<?php echo $data_sns_url; ?>" target="_blank" title="네이버 밴드"><img src="<?php echo G5_URL; ?>/data/icon/naver_band.png"></a>
                        <a href="javascript:void(0);" title="링크 복사" onclick="copy_goods_url('<?php echo G5_URL; ?>/shop/item.php?it_id=<?php echo $list[$i]['it_id']; ?>'); return false;"><img src="<?php echo G5_URL; ?>/data/icon/link_copy.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
