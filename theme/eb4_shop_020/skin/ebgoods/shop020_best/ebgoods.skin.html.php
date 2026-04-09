<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebgoods/shop20_best/ebgoods.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($eg_master['eg_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:-15px;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB상품 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="
                <span class='f-s-13r'>
                <strong class='text-indigo'>좌측 [EB상품 마스터 설정 버튼] 클릭 후 아래 설명 참고</strong><br>
                <div class='margin-hr-5'></div>
                <span class='text-indigo'>[설정정보]</span><br>
                1. 상품마스터 제목 : <strong>상품</strong> 판매 순위<br>
                2. 상품마스터 스킨 : shop020_best<br>
                <span class='text-indigo'>[EB상품 - 아이템 관리]</span><br>
                1. EB상품 아이템 추가 클릭<br>
                2. 타이틀 입력<br>
                3. 카테고리 선택<br>
                4. 출력상품수 : 3개<br>
                5. 출력방식 : 판매많은순 선택<br>
                6. 이미지 사이즈 : 100x100<br>
                6. 상품명 출력 여부, 판매가 출력 여부만 사용으로 설정
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($eg_master) && $eg_master['eg_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebg-shop020-b-wrap {position:relative}
.ebg-shop020-b-header {position:relative;margin-bottom:10px}
.ebg-shop020-b-header:after {content:"";display:block;clear:both}
.ebg-shop020-b-title {position:relative;font-size:1.125rem;color:#151515;font-weight:700;border-bottom:1px solid #353535;padding-bottom:5px;margin-bottom:5px}
.ebg-shop020-b-tabs {position:relative}
.ebg-shop020-b-tabs li {margin-right:10px}
.ebg-shop020-b-tabs li:last-child {margin-right:0}
.ebg-shop020-b-tabs li a {position:relative;display:inline-block;line-height:2.0;color:#757575}
.ebg-shop020-b-tabs li a:before {content:"";position:absolute;bottom:0;left:0;width:0;height:1px;background-color:#353535;-webkit-transition:all .3s ease;transition:all .3s ease}
.ebg-shop020-b-tabs li a:hover:before, .ebg-shop020-b-tabs li a.active:before {width:100%}
.ebg-shop020-b-tabs li a.active {color:#000}
.ebg-shop020-b {position:relative}
.ebg-shop020-b:after {content:"";display:block;clear:both}
.ebg-shop020-b .ebgoods-item-wrap {padding:0}
.ebg-shop020-b .ebgoods-item {position:relative;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.ebg-shop020-b .goods-img {position:absolute;top:0;left:0;width:50px;height:50px;margin-bottom:10px;background:#fff}
.ebg-shop020-b .goods-img .badge {position:absolute;top:-4px;left:-4px;z-index:1}
.ebg-shop020-b .goods-img-in {position:relative;overflow:hidden;width:100%}
.ebg-shop020-b .goods-img-in:before {content:"";display:block;padding-top:100%;background:#fff}
.ebg-shop020-b .goods-img-in img {display:block;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}
.ebg-shop020-b .goods-description {position:relative;margin-left:60px}
.ebg-shop020-b .goods-description .goods-description-in {position:relative;overflow:hidden;padding:0 0 10px}
.ebg-shop020-b .goods-description .goods-name {position:relative;overflow:hidden;margin:0 0 5px;font-size:.9375rem;font-weight:700}
.ebg-shop020-b .goods-description .goods-name a {color:#000}
.ebg-shop020-b .goods-description .goods-name a:hover {text-decoration:underline}
.ebg-shop020-b .goods-description .title-price {font-size:.9375rem;color:#ab0000;margin-right:7px}
.ebg-shop020-b .goods-description .line-through {font-size:.9375rem;color:#959595;text-decoration:line-through;font-weight:400;white-space:nowrap}
.ebg-shop020-b .goods-description .goods-id {color:#757575;display:block;font-size:.8125rem;margin-top:10px}
.ebg-shop020-b .goods-description .goods-info {position:relative;overflow:hidden;height:38px;color:#959595;font-size:.8125rem;margin-top:10px}
.ebg-shop020-b .goods-description .goods-sns {position:relative;height:30px;margin-top:10px}
.ebg-shop020-b .goods-description .goods-sns ul {position:absolute;top:0;right:0;margin:0;padding:0;list-style:none}
.ebg-shop020-b .goods-description .goods-sns ul:after {content:"";display:block;clear:both}
.ebg-shop020-b .goods-description .goods-sns ul li {float:left;margin-left:1px}
.ebg-shop020-b .goods-description .goods-sns ul li a {display:block;width:30px;height:30px;line-height:30px;text-align:center;background:#b5b5b5;color:#fff;font-size:.75rem}
.ebg-shop020-b .goods-description .goods-sns ul li:hover .wish-icon {background:#ab0000}
.ebg-shop020-b .goods-description .goods-sns ul li:hover .facebook-icon {background:#39558f}
.ebg-shop020-b .goods-description .goods-sns ul li:hover .twitter-icon {background:#4698e0}
.ebg-shop020-b .goods-description-bottom {position:relative;overflow:hidden;padding:10px 0;border-top:1px solid #e5e5e5;font-size:.8125rem}
.ebg-shop020-b .ebgoods-item:hover .goods-name a {text-decoration:underline}
@media (max-width:576px) {
    .ebg-shop020-b-wrap {margin:0 0 30px}
}
</style>

<div class="ebg-shop020-b-wrap">
    <div class="ebg-shop020-b-header">
        <div class="ebg-shop020-b-title">
            <?php if ($eg_master['eg_link']) { ?>
            <a href="<?php echo $eg_master['eg_link']; ?>" target="<?php echo $eg_master['eg_target']; ?>"><strong><?php echo $eg_master['eg_subject']; ?></strong></a>
            <?php } else { ?>
            <?php echo $eg_master['eg_subject']; ?>
            <?php } ?>
        </div>
        <ul class="nav ebg-shop020-b-tabs">
            <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
            <li><a href="#basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>" data-bs-toggle="tab" <?php if ($eb_goods['gi_link']) { ?>data-href="<?php echo $eb_goods['gi_link']; ?>" target="<?php echo $eb_goods['gi_target']; ?>"<?php } ?> class="<?php if ($k==0) { ?>active<?php } else if ($eg_count == ($k+1)) { ?>last<?php }?> <?php if ($eb_goods['gi_link']) { ?>cursor-pointer<?php } ?>"><?php echo $eb_goods['gi_title']; ?></a></li>
            <?php }} ?>
        </ul>
    </div>
    <div class="tab-content">
        <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>">
            <div class="ebg-shop020-b">
                <?php if (count((array)$eb_goods['list']) > 0) { foreach ($eb_goods['list'] as $i => $data) { ?>
                <div class="ebgoods-item-wrap">
                    <div class="ebgoods-item">
                        <?php if ($eb_goods['gi_view_img'] == 'y') { ?>
                        <a href="<?php echo $data['href']; ?>">
                            <div class="goods-img">
                                <div class="goods-img-in">
                                    <?php if($data['it_image']) { ?>
                                    <?php echo $data['it_image']; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                        <?php } ?>

                        <div class="goods-description">
                            <div class="goods-description-in">
                                <h4 class="goods-name ellipsis">
                                    <span class="<?php if($i==0) { ?>text-crimson<?php } else { ?>text-gray<?php } ?>"><?php echo ($i+1); ?>.</span>
                                    <a href="<?php echo $data['href']; ?>">
                                        <?php echo $data['it_name']?>
                                    </a>
                                </h4>

                                <div class="goods-price">
                                    <?php if ($eb_goods['gi_view_it_price'] == 'y') { ?>
                                    <span class="title-price">₩ <?php echo preg_replace('/원/','',display_price(get_price($data), $data['it_tel_inq'])); ?></span>
                                    <?php } ?>
                                    <?php if ($eb_goods['gi_view_it_cust_price'] == 'y' && $data['it_cust_price']) { ?>
                                    <span class="title-price line-through">₩ <?php echo number_format($data['it_cust_price']); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
                
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;gi_no=<?php echo $eb_goods['gi_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> EB상품 아이템 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;gi_no=<?php echo $eb_goods['gi_no']; ?>&amp;w=u&amp;iw=u" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>

                <?php if (count((array)$eb_goods['list']) == 0) { ?>
                <p class="text-center text-gray f-s-13r m-t-50 m-b-50"><i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
                <?php } ?>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>

<script>
$(function() {
    $('.ebg-shop020-b-tabs li a').on('mouseenter', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('.ebg-shop020-b-tabs li a').click(function(e) {
        return true;
    });

    $('.ebg-shop020-b-tabs li a').on('click', function(e) {
        var dataHref = $(this).attr('data-href');
        if (dataHref) {
            window.location.href = dataHref;
        }
    });
});
</script>
<?php } ?>