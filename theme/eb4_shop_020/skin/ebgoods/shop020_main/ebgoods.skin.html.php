<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebgoods/shop20_main/ebgoods.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
global $default;

// 좌측 배너 1658993441 활성화 상태 판별
$es_1658993441 = sql_fetch("select es_state from {$g5['eyoom_slider']} where es_code = '1658993441'");
$ei_active_check_1 = sql_fetch("select count(*) as cnt from {$g5['eyoom_slider_item']} where es_code = '1658993441' and ei_state = '1'");
$banner_show_1 = ($es_1658993441['es_state'] == '1' && $ei_active_check_1['cnt'] > 0) ? true: false;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($eg_master['eg_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:-25px;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB상품 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($eg_master) && $eg_master['eg_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebg-shop020-m-wrap {position:relative}
.ebg-shop020-m-header {position:relative;border-bottom:1px solid #e5e5e5;padding-bottom:10px;margin-bottom:10px}
.ebg-shop020-m-header:after {content:"";display:block;clear:both}
.ebg-shop020-m-title {float:left;font-size:1.25rem;color:#151515;font-weight:700}
.ebg-shop020-m-tabs {float:right}
.ebg-shop020-m-tabs li {margin-left:20px}
.ebg-shop020-m-tabs li a {position:relative;display:inline-block;line-height:2.0;color:#000}
.ebg-shop020-m-tabs li a:before {content:"";position:absolute;bottom:0;left:0;width:0;height:1px;background-color:#555;-webkit-transition:all .3s ease;transition:all .3s ease}
.ebg-shop020-m-tabs li a:hover:before, .ebg-shop020-m-tabs li a.active:before {width:100%}
.ebg-shop020-m-tabs li a.active {font-weight:700}
.ebg-shop020-m {margin-left:-10px;margin-right:-10px}
.ebg-shop020-m:after {content:"";display:block;clear:both}
.ebg-shop020-m .ebgoods-item-wrap {padding:10px;width:25%;float:left}
.ebg-shop020-m .ebgoods-item {position:relative;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out; border: 1px solid #f0f0f0; padding: 5px; border-radius: 0px; background: #fff;}
.ebg-shop020-m .goods-img {position:relative;overflow:hidden;margin-bottom:10px;background:#fff}
.ebg-shop020-m .goods-img-in {position:relative;overflow:hidden;width:100%}
.ebg-shop020-m .goods-img-in:before {content:"";display:block;padding-top:<?php echo !$banner_show_1 ? '85%' : '75%'; ?>;background:#fff}
.ebg-shop020-m .goods-img-in img {display:block;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}
.ebg-shop020-m .goods-description .goods-description-in {position:relative;overflow:hidden;padding:0 0 10px}
.ebg-shop020-m .goods-description .goods-name {position:relative;overflow:hidden;margin:10px 0 5px;font-size:<?php echo !$banner_show_1 ? '1.25rem' : '1.10rem'; ?>;font-weight:700;line-height:1.4;height:<?php echo !$banner_show_1 ? '55px' : '47px'; ?>;text-align:center}
.ebg-shop020-m .goods-description .goods-name a {color:#ff8a37}
.ebg-shop020-m .goods-description .goods-name a:hover {text-decoration:underline}
.ebg-shop020-m .goods-description .title-price {font-size:1.0625rem;font-weight:700;color:#ab0000;margin-right:7px}
.ebg-shop020-m .goods-description .line-through {font-size:.875rem;color:#959595;text-decoration:line-through;font-weight:400;white-space:nowrap}
.ebg-shop020-m .goods-description .goods-id {color:#757575;display:block;font-size:.8125rem;margin-top:10px}
.ebg-shop020-m .goods-description .goods-info {position:relative;overflow:hidden;min-height:<?php echo !$banner_show_1 ? '42px' : '38px'; ?>;color:#454545;font-size:<?php echo !$banner_show_1 ? '15px' : '14px'; ?>;margin-top:10px;text-align:center}
.ebg-shop020-m .goods-description .goods-sns {position:relative;height:30px;margin-top:10px}
.ebg-shop020-m .goods-description .goods-sns ul {position:absolute;top:0;right:0;margin:0;padding:0;list-style:none}
.ebg-shop020-m .goods-description .goods-sns ul:after {content:"";display:block;clear:both}
.ebg-shop020-m .goods-description .goods-sns ul li {float:left;margin-left:1px}
.ebg-shop020-m .goods-description .goods-sns ul li a {display:block;width:30px;height:30px;line-height:30px;text-align:center;background:#b5b5b5;color:#fff;font-size:.75rem}
.ebg-shop020-m .goods-description .goods-sns ul li:hover .wish-icon {background:#ab0000}
.ebg-shop020-m .goods-description .goods-sns ul li:hover .facebook-icon {background:#39558f}
.ebg-shop020-m .goods-description .goods-sns ul li:hover .twitter-icon {background:#4698e0}
.ebg-shop020-m .goods-description-bottom {position:relative;overflow:hidden;padding:10px 0;border-top:1px solid #e5e5e5;font-size:.8125rem}
.ebg-shop020-m .shop-rgba-red {background:#ab0000}
.ebg-shop020-m .shop-rgba-yellow {background:#ec8b00}
.ebg-shop020-m .shop-rgba-green {background:#00897b}
.ebg-shop020-m .shop-rgba-purple {background:#8e24aa}
.ebg-shop020-m .shop-rgba-orange {background:#f4511e}
.ebg-shop020-m .shop-rgba-dark {background:#363b43}
.ebg-shop020-m .shop-rgba-default {background:#A6A6A6}
.ebg-shop020-m .rgba-banner-area {position:absolute;top:5px;right:5px}
.ebg-shop020-m .rgba-banner {height:25px;width:25px;line-height:25px;color:#fff;font-size:.6875rem;text-align:center;font-weight:400;position:relative;text-transform:uppercase;margin-bottom:2px;border-radius:50%}
.ebg-shop020-m .ebgoods-item:hover .goods-name a {text-decoration:underline}

/* SNS Share */
.ebg-shop020-m .goods-share {display:flex; width:fit-content; margin:15px auto 0; justify-content:center; align-items:center; gap:5px; padding:5px; background:#fcfcfc; border:1px solid #f0f0f0; border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.03);}
.ebg-shop020-m .goods-share img {width:30px; height:30px; border-radius:4px; display:block}

@media (max-width:1199px) {
    .ebg-shop020-m {margin-left:-5px;margin-right:-5px}
    .ebg-shop020-m .ebgoods-item-wrap {width:50%;padding:5px}
}
@media (max-width:991px) {
    .ebg-shop020-m .ebgoods-item-wrap {width:50%}
}
@media (max-width:767px) {
    .ebg-shop020-m-wrap {margin-bottom:30px}
    .ebg-shop020-m-title {float:left;width:100%;margin-bottom:15px}
    .ebg-shop020-m-tabs {float:left;width:100%}
    .ebg-shop020-m-tabs li {margin-left:0;margin-right:20px}
    .ebg-shop020-m {margin-left:-2px;margin-right:-2px}
    .ebg-shop020-m .ebgoods-item-wrap {padding:5px 2px}
    .ebg-shop020-m .goods-share {gap:2px; padding:3px;}
    .ebg-shop020-m .goods-share img {width:24px; height:24px;}
}
</style>

<div class="ebg-shop020-m-wrap">
    <div class="ebg-shop020-m-header">
        <div class="ebg-shop020-m-title">
            <span class="m-r-7">🛍️</span>
            <?php if ($eg_master['eg_link']) { ?>
            <a href="<?php echo $eg_master['eg_link']; ?>" target="<?php echo $eg_master['eg_target']; ?>"><strong><?php echo $eg_master['eg_subject']; ?></strong></a>
            <?php } else { ?>
            <?php echo $eg_master['eg_subject']; ?>
            <?php } ?>
        </div>
        <ul class="nav ebg-shop020-m-tabs">
            <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
            <li><a href="#basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>" data-bs-toggle="tab" <?php if ($eb_goods['gi_link']) { ?>data-href="<?php echo $eb_goods['gi_link']; ?>" target="<?php echo $eb_goods['gi_target']; ?>"<?php } ?> class="<?php if ($k==0) { ?>active<?php } else if ($eg_count == ($k+1)) { ?>last<?php }?> <?php if ($eb_goods['gi_link']) { ?>cursor-pointer<?php } ?>"><?php echo $eb_goods['gi_title']; ?></a></li>
            <?php }} ?>
        </ul>
    </div>
    <div class="tab-content">
        <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>">
            <div class="ebg-shop020-m">
                <?php if (count((array)$eb_goods['list']) > 0) { foreach ($eb_goods['list'] as $i => $data) { 
                    $sns_url = G5_SHOP_URL.'/item.php?it_id='.$data['it_id'];
                    $sns_title = get_text($data['it_name']);
                    $data['sns_url'] = urlencode($sns_url);
                    $data['sns_title'] = urlencode($sns_title);
                ?>
                <div class="ebgoods-item-wrap">
                    <div class="ebgoods-item">
                        <?php if ($eb_goods['gi_view_img'] == 'y') { ?>
                        <a href="<?php echo $data['href']; ?>">
                            <div class="goods-img animate-img-hvr">
                                <div class="goods-img-in">
                                    <?php if($data['it_image']) { ?>
                                    <?php echo $data['it_image']; ?>
                                    <?php } ?>
                                    <?php if ($eb_goods['gi_view_it_icon']) { ?>
                                    <?php echo str_replace(array('히트', '신상'), array('랜덤', '최신'), $data['it_icon']); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                        <?php } ?>

                        <div class="goods-description">
                            <div class="goods-description-in">
                                <?php
                                // 브랜드 와이드 로고 가져오기
                                if ($data['it_brand']) {
                                    $br_info = sql_fetch("select br_code, br_img_wide from {$g5['eyoom_brand']} where br_name = '".sql_real_escape_string($data['it_brand'])."'");
                                    if ($br_info['br_img_wide']) {
                                        $br_img_wide_url = G5_DATA_URL.'/brand/wide_logo/'.$br_info['br_img_wide'];
                                        $br_href = G5_SHOP_URL.'/brand.php?br_cd='.urlencode($br_info['br_code']);
                                        echo '<div style="text-align:center; margin-top:5px;"><a href="'.$br_href.'"><img src="'.$br_img_wide_url.'" style="height:20px; width:auto;"></a></div>';
                                    }
                                }
                                ?>
                                <h4 class="goods-name">
                                    <a href="<?php echo $data['href']; ?>">
                                        <?php echo $data['it_name']?>
                                    </a>
                                </h4>

                                <?php /* 가격 정보 숨김 */ ?>

                                <?php if ($eb_goods['gi_view_it_id'] == 'y') { ?>
                                <span class="goods-id"><?php echo stripslashes($data['it_id']); ?></span>
                                <?php } ?>

                                <?php if ($eb_goods['gi_view_it_basic'] == 'y') { ?>
                                <div class="goods-info"><?php echo $data['it_basic']?></div>
                                <?php } ?>

                                <?php if ($default['de_all_bodmi_use']) { ?>
                                <div class="all-countdown-container" style="background: <?php echo $default['de_all_bodmi_bg_color']; ?>; border: 1px solid <?php echo $default['de_all_bodmi_font_color']; ?>; color: <?php echo $default['de_all_bodmi_font_color']; ?>; padding: 4px 10px; font-size: 12px; margin: 10px 0; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                    <div class="all-countdown-title" style="gap: 5px;">
                                        <i class="fas fa-gift" style="font-size: 11px;"></i> <?php echo $default['de_all_bodmi_title']; ?>
                                    </div>
                                    <div class="all-countdown-timer">
                                        <!-- JS -->
                                    </div>
                                </div>
                                <?php } ?>

                                <?php if (in_array($data['it_id'], array('1776008318', '1778489229', '1775931123', '1774196980', '1775880472'))) { ?>
                                <a href="<?php echo $data['href']; ?>#sit_use" class="goods-rating" style="display:flex; justify-content:center; align-items:center; gap:1px; margin-top:8px; line-height:1; text-decoration:none !important;">
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
                                <?php } ?>

                                <div class="goods-share">
                                    <a href="javascript:void(0);" title="공유"><img src="<?php echo G5_URL; ?>/data/icon/share_icon.png"></a>
                                    <a href="javascript:void(0);" title="카카오톡 공유"><img src="<?php echo G5_URL; ?>/data/icon/kakaotalk.png"></a>
                                    <a href="javascript:void(0);" title="카카오채널"><img src="<?php echo G5_URL; ?>/data/icon/kakao_ch.png"></a>
                                    <a href="https://share.naver.com/share?url=<?php echo $data['sns_url']; ?>&title=<?php echo $data['sns_title']; ?>" target="_blank" title="네이버 블로그"><img src="<?php echo G5_URL; ?>/data/icon/naver_blog.png"></a>
                                    <a href="https://band.us/plugin/share?body=<?php echo $data['sns_title']; ?>%0A<?php echo $data['sns_url']; ?>" target="_blank" title="네이버 밴드"><img src="<?php echo G5_URL; ?>/data/icon/naver_band.png"></a>
                                    <a href="javascript:void(0);" title="링크 복사" onclick="copy_goods_url('<?php echo G5_URL; ?>/shop/item.php?it_id=<?php echo $data['it_id']; ?>'); return false;"><img src="<?php echo G5_URL; ?>/data/icon/link_copy.png"></a>
                                </div>

                                <?php if ($eb_goods['gi_view_sns'] == 'y') { ?>
                                <div class="goods-sns">
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $data['sns_url']; ?>&amp;p=<?php echo $data['sns_title']; ?>" target="_blank" class="facebook-icon" title="페이스북"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/share?url=<?php echo $data['sns_url']; ?>&amp;text=<?php echo $data['sns_title']; ?>" target="_blank" class="twitter-icon" title="트위터"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>

                            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                            <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                                <div class="btn-group">
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $data['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> 개별상품 설정</a>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $data['it_id']; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if(0) { // 상품분류 숨김 처리 ?>
                        <div class="goods-description-bottom">
                            <span class="text-gray">상품분류 : <span class="text-black"><?php echo $data['ca_name']; ?></span></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php }} ?>
                
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="top:40px">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;gi_no=<?php echo $eb_goods['gi_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> EB상품 아이템 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;gi_no=<?php echo $eb_goods['gi_no']; ?>&amp;w=u&amp;iw=u" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>

                <?php if (count((array)$eb_goods['list']) == 0) { ?>
                <p class="text-center text-gray m-t-50 m-b-50"><i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
                <?php } ?>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>

<script>
$(function() {
    $('.ebg-shop020-m-tabs li a').on('mouseenter', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('.ebg-shop020-m-tabs li a').click(function(e) {
        return true;
    });

    $('.ebg-shop020-m-tabs li a').on('click', function(e) {
        var dataHref = $(this).attr('data-href');
        if (dataHref) {
            window.location.href = dataHref;
        }
    });
});



function copy_goods_url(url) {
    var t = document.createElement("textarea");
    document.body.appendChild(t);
    t.value = url;
    t.select();
    document.execCommand('copy');
    document.body.removeChild(t);
    alert('상품 주소가 복사되었습니다.');
}
</script>
<?php } ?>