<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/list.10.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
global $default;
?>

<style>
.product-list-10 {margin-left:-10px;margin-right:-10px;font-size:.9375rem}
.product-list-10:after {content:"";display:block;clear:both}
.product-list-10 .item-list-wrap {padding:10px;width:25%;float:left}
/* 다크 테마 적용 */
.product-list-10 .item-list {position:relative;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out; border: 1px solid #333; padding: 5px; border-radius: 0px; background: #151b26; color: #fff;}
.product-list-10 .product-img {position:relative;overflow:hidden;margin-bottom:10px;background:#fff}
.product-list-10 .product-img-in {position:relative;overflow:hidden;width:100%}
.product-list-10 .product-img-in:before {content:"";display:block;padding-top:75%;background:#fff}
.product-list-10 .product-img-in img {display:block;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}

/* 아이콘 라벨 스타일 추가 */
.product-list-10 .rgba-banner-area {position:absolute;top:5px;right:5px;z-index:2}
.product-list-10 .rgba-banner {height:25px;width:25px;line-height:25px;color:#fff !important;font-size:.6875rem;text-align:center;font-weight:400;position:relative;text-transform:uppercase;margin-bottom:2px;border-radius:50%;display:block}
.product-list-10 .shop-rgba-red {background:#ab0000}
.product-list-10 .shop-rgba-yellow {background:#ec8b00}
.product-list-10 .shop-rgba-green {background:#00897b}
.product-list-10 .shop-rgba-purple {background:#8e24aa}
.product-list-10 .shop-rgba-orange {background:#f4511e}
.product-list-10 .shop-rgba-dark {background:#363b43}
.product-list-10 .shop-rgba-default {background:#A6A6A6}

.product-list-10 .product-description .product-description-in {position:relative;overflow:hidden;padding:0 0 10px}
.product-list-10 .product-description .product-name {position:relative;overflow:hidden;margin:10px 0 5px;font-size:1.10rem;font-weight:700;line-height:1.4;height:47px;text-align:center}
.product-list-10 .product-description .product-name a {color:#ff8a37}
.product-list-10 .product-description .product-name a:hover {text-decoration:underline}
.product-list-10 .product-description .title-price {font-size:1.0625rem;font-weight:700;color:#ab0000;margin-right:7px}
.product-list-10 .product-description .line-through {font-size:.875rem;color:#959595;text-decoration:line-through;font-weight:400;white-space:nowrap}
.product-list-10 .product-description .product-id {color:#757575;display:block;font-size:.8125rem;margin-top:10px}
.product-list-10 .product-description .product-info {position:relative;overflow:hidden;min-height:38px;color:#959595;font-size:14px;margin-top:10px;text-align:center}
.product-list-10 .product-description .product-sns {position:relative;height:30px;margin-top:10px}
.product-list-10 .product-description .product-sns ul {position:absolute;top:0;right:0;margin:0;padding:0;list-style:none}
.product-list-10 .product-description .product-sns ul:after {content:"";display:block;clear:both}
.product-list-10 .product-description .product-sns ul li {float:left;margin-left:1px}
.product-list-10 .product-description .product-sns ul li a {display:block;width:30px;height:30px;line-height:30px;text-align:center;background:#b5b5b5;color:#fff;font-size:.75rem}

.product-list-10 .product-description-bottom {position:relative;overflow:hidden;padding:10px 0;border-top:1px solid #333;font-size:.8125rem}
.product-list-10 .item-list:hover .product-name a {text-decoration:underline}

/* Product Share */
.product-list-10 .product-share {display:flex; width:fit-content; margin:15px auto 0; justify-content:center; align-items:center; gap:5px; padding:5px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.03);}
.product-list-10 .product-share img {width:30px; height:30px; border-radius:4px; display:block}

@media (max-width:1199px) {
    .product-list-10 {margin-left:-5px;margin-right:-5px}
    .product-list-10 .item-list-wrap {width:50%;padding:5px}
}
@media (max-width:991px) {
    .product-list-10 .item-list-wrap {width:50%}
}
@media (max-width:767px) {
    .product-list-10 {margin-left:-2px;margin-right:-2px}
    .product-list-10 .item-list-wrap {padding:5px 2px}
    .product-list-10 .product-share {gap:2px; padding:3px;}
    .product-list-10 .product-share img {width:24px; height:24px;}
}
</style>

<div class="product-list-10">
    <?php for ($i=0; $i<count((array)$list); $i++) { 
        $sns_url = G5_SHOP_URL.'/item.php?it_id='.$list[$i]['it_id'];
        $sns_title = get_text($list[$i]['it_name']);
        $list[$i]['sns_url'] = urlencode($sns_url);
        $list[$i]['sns_title'] = urlencode($sns_title);
    ?>
    <div class="item-list-wrap">
        <div class="item-list">
            <?php if ($this->view_it_img) { ?>
            <a href="<?php echo $list[$i]['href']; ?>">
                <div class="product-img animate-img-hvr">
                    <div class="product-img-in">
                        <?php if($list[$i]['it_image']) { ?>
                        <?php echo $list[$i]['it_image']; ?>
                        <?php } ?>
                        <?php if ($this->view_it_icon) { ?>
                        <?php echo str_replace(array('히트', '신상'), array('랜덤', '최신'), $list[$i]['it_icon']); ?>
                        <?php } ?>
                    </div>
                </div>
            </a>
            <?php } ?>

            <div class="product-description">
                <div class="product-description-in">
                    <?php
                    // 브랜드 와이드 로고 가져오기
                    if ($list[$i]['it_brand']) {
                        $br_info = sql_fetch("select br_code, br_img_wide from {$g5['eyoom_brand']} where br_name = '".sql_real_escape_string($list[$i]['it_brand'])."'");
                        if ($br_info['br_img_wide']) {
                            $br_img_wide_url = G5_DATA_URL.'/brand/wide_logo/'.$br_info['br_img_wide'];
                            $br_href = G5_SHOP_URL.'/brand.php?br_cd='.urlencode($br_info['br_code']);
                            echo '<div class="brand-logo-wrap"><a href="'.$br_href.'"><img src="'.$br_img_wide_url.'" class="brand-logo-img"></a></div>';
                        }
                    }
                    ?>
                    <h4 class="product-name">
                        <a href="<?php echo $list[$i]['href']; ?>">
                            <?php if ($this->view_it_name) { echo stripslashes($list[$i]['it_name']); } ?>
                        </a>
                    </h4>

                    <?php /* 가격 정보 숨김 */ ?>

                    <?php if ($this->view_it_id) { ?>
                    <span class="product-id"><?php echo stripslashes($list[$i]['it_id']); ?></span>
                    <?php } ?>

                    <?php if ($this->view_it_basic) { ?>
                    <div class="product-info"><?php echo stripslashes($list[$i]['it_basic']); ?></div>
                    <?php } ?>

                    <?php if ($default['de_all_bodmi_use']) { ?>
                    <div class="all-countdown-container" style="background: <?php echo $default['de_all_bodmi_bg_color']; ?>; border: 1px solid <?php echo $default['de_all_bodmi_font_color']; ?>; color: <?php echo $default['de_all_bodmi_font_color']; ?>; padding: 4px 10px; font-size: 12px; margin: 10px 0; border-radius: 4px;">
                        <div class="all-countdown-title" style="gap: 5px;">
                            <i class="fas fa-gift" style="font-size: 11px;"></i> <?php echo $default['de_all_bodmi_title']; ?>
                        </div>
                        <div class="all-countdown-timer">
                            <!-- JS -->
                        </div>
                    </div>
                    <?php } ?>

                    <?php if (in_array($list[$i]['it_id'], array('1776008318', '1778489229', '1775931123', '1774196980', '1775880472'))) { ?>
                    <a href="<?php echo $list[$i]['href']; ?>#sit_use" class="product-rating" style="display:flex; justify-content:center; align-items:center; gap:1px; margin-top:8px; line-height:1; text-decoration:none !important;">
                        <div style="color:#ffc107; font-size:14px; display:flex; align-items:center; gap:1px;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <div style="position:relative; display:inline-block; width:14px; height:14px; font-size:14px;">
                                <i class="far fa-star" style="color:rgba(255,255,255,0.1); position:absolute; left:0; top:0;"></i>
                                <div style="width:75%; overflow:hidden; position:absolute; left:0; top:0; white-space:nowrap;">
                                    <i class="fas fa-star" style="color:#ffc107;"></i>
                                </div>
                            </div>
                        </div>
                        <span style="color:#bb3312; font-size:13px; font-weight:700; margin-left:6px; position:relative; top:1px;">평점 4.75</span>
                    </a>
                    <?php } ?>

                    <div class="product-share">
                        <a href="javascript:void(0);" title="공유"><img src="<?php echo G5_URL; ?>/data/icon/share_icon.png"></a>
                        <a href="javascript:void(0);" title="카카오톡 공유"><img src="<?php echo G5_URL; ?>/data/icon/kakaotalk.png"></a>
                        <a href="javascript:void(0);" title="카카오채널"><img src="<?php echo G5_URL; ?>/data/icon/kakao_ch.png"></a>
                        <a href="https://share.naver.com/share?url=<?php echo $list[$i]['sns_url']; ?>&title=<?php echo $list[$i]['sns_title']; ?>" target="_blank" title="네이버 블로그"><img src="<?php echo G5_URL; ?>/data/icon/naver_blog.png"></a>
                        <a href="https://band.us/plugin/share?body=<?php echo $list[$i]['sns_title']; ?>%0A<?php echo $list[$i]['sns_url']; ?>" target="_blank" title="네이버 밴드"><img src="<?php echo G5_URL; ?>/data/icon/naver_band.png"></a>
                        <a href="javascript:void(0);" title="링크 복사" onclick="copy_goods_url('<?php echo G5_URL; ?>/shop/item.php?it_id=<?php echo $list[$i]['it_id']; ?>'); return false;"><img src="<?php echo G5_URL; ?>/data/icon/link_copy.png"></a>
                    </div>
                </div>

                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> 개별상품 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (count((array)$list) == 0) { ?>
    <p class="text-center text-gray m-t-100 m-b-100"><i class="fa fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
    <?php } ?>
</div>

<script>
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