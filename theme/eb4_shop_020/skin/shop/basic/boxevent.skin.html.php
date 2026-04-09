<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/boxevent.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($ev_count > 0) { ?>
<style>
.shop-boxevent-wrap {position:relative;background-color:#1e293c;padding:25px 0}
.boxevent-heading {position:relative;margin:0 0 30px;z-index:1}
.boxevent-heading h2 {position:relative;font-size:1.75rem;color:#fff;border-bottom:1px solid #3a4861;padding-bottom:10px}
.boxevent-heading h2 strong {color:#fff}
.boxevent-heading h2:after {content:"";position:absolute;bottom:-1px;left:0;display:block;width:40px;height:1px;background:#737d8f;z-index:1}
.boxevent-heading h2:before {content:"";position:absolute;bottom:-1px;left:45px;display:block;width:20px;height:1px;background:#737d8f;z-index:1}
.shop-boxevent .boxevent-box {position:relative;min-height:293px;margin-top:30px}
.shop-boxevent .boxevent-box:first-child {margin-top:0}
.shop-boxevent .boxevent-box:after {display:block;visibility:hidden;clear:both;content:""}
.shop-boxevent .boxevent-box-title {position:absolute;overflow:hidden;top:0;left:0;width:400px;height:293px}
.shop-boxevent .boxevent-box-title .box-title-img {position:relative}
.shop-boxevent .boxevent-box-title .box-title-img h5 {position:absolute;top:0;bottom:0;left:0;right:0;padding:20px;text-align:right;font-size:1.5rem;font-weight:700;color:#000;text-shadow:-1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff}
.shop-boxevent .boxevent-box-title .box-title-txt {display:table-cell;vertical-align:middle;width:400px;height:293px;padding:0 30px;color:#fff;text-align:center;font-size:1.0625rem;background:#656565;word-break:keep-all}
.shop-boxevent .boxevent-item-wrap {position:relative;margin-left:420px;height:250px}
.shop-boxevent .boxevent-item {margin-left:-5px;margin-right:-5px}
.shop-boxevent .boxevent-item:after {display:block;visibility:hidden;clear:both;content:""}
.shop-boxevent .boxevent-item-box {float:left;width:25%}
.shop-boxevent .boxevent-item-box-in {position:relative;padding:0 5px 5px}
.shop-boxevent .boxevent-item-box-in .boxevent-item-img {position:relative;overflow:hidden;margin-bottom:10px}
.shop-boxevent .boxevent-item-box-in .boxevent-item-img img {display:block;max-width:100%;height:auto}
.shop-boxevent .boxevent-item-box-in .boxevent-item-desc h5 {position:relative;overflow:hidden;margin:10px 0 5px;font-size:1.0625rem;font-weight:700;line-height:1.4;height:47px;color:#b5b5b5}
.shop-boxevent .boxevent-item-box-in .boxevent-item-desc span {font-size:1.0625rem;color:#f4511e}
.shop-boxevent .boxevent-item-box-in:hover h5 {text-decoration:underline}
.shop-boxevent .boxevent-no-item {text-align:center;height:293px;line-height:293px;color:#959595}
@media (max-width:1199px) {
    .shop-boxevent .boxevent-item-box {width:50%}
    .shop-boxevent .boxevent-item-box-in {padding:0 5px 10px}
}
@media (max-width:991px) {
    .shop-boxevent .boxevent-box-title {position:relative;top:inherit;left:inherit;margin:0 auto 30px}
    .shop-boxevent .boxevent-box-title .box-title-txt {width:280px;height:175px;font-size:.9375rem}
    .shop-boxevent .boxevent-item-wrap {margin-left:0;height:175px}
}
@media (max-width:767px) {
    .shop-boxevent .boxevent-box-title {position:relative;width:auto;height:auto;top:inherit;left:inherit;margin-bottom:20px}
    .shop-boxevent .boxevent-box-title .box-title-txt {display:block;width:auto;height:200px;line-height:200px}
    .shop-boxevent .boxevent-item-wrap {margin-left:0;height:auto}
    .shop-boxevent .boxevent-item {margin-left:-2px;margin-right:-2px}
    .shop-boxevent .boxevent-item-box-in {padding:0 2px 10px}
}
@media (max-width:576px) {
    .shop-boxevent-wrap {padding:30px 0;margin-bottom:30px}
}
</style>

<section id="sev" class="shop-boxevent-wrap">
    <div class="container">
        <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
        <div class="adm-edit-btn btn-edit-mode" style="top:0">
            <div class="btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemevent&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 이벤트 설정</a>
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemevent&amp;thema=<?php echo $theme; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
        <?php } ?>

        <div class="boxevent-heading">
            <h2><strong>이벤트</strong></h2>
        </div>
        <div class="shop-boxevent">
            <?php for ($i=0; $i<$ev_count; $i++) { ?>
            <div class="boxevent-box">
                <div class="boxevent-box-title">
                    <a href="<?php echo $ev_list[$i]['href']; ?>">
                    <?php if (file_exists($ev_list[$i]['event_img'])) { // 이벤트 이미지가 있다면 이미지 출력 ?>
                        <div class="box-title-img animate-img-hvr3">
                            <img src="<?php echo G5_DATA_URL; ?>/event/<?php echo $ev_list[$i]['ev_id']; ?>_m" class="img-fluid" alt="<?php echo $ev_list[$i]['ev_subject']; ?>">
                            <?php if ($ev_list[$i]['ev_subject_strong']) { ?>
                            <h5><?php echo $ev_list[$i]['ev_subject']; ?></h5>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="box-title-txt animate-img-hvr3">
                            <?php if ($ev_list[$i]['ev_subject_strong']) { ?>
                            <strong><?php echo $ev_list[$i]['ev_subject']; ?></strong>
                            <?php } else { ?>
                            <?php echo $ev_list[$i]['ev_subject']; ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    </a>
                    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                    <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                        <div class="btn-group">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventform&thema=<?php echo $theme; ?>&ev_id=<?php echo $ev_list[$i]['ev_id']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> 개별이벤트 설정</a>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventform&thema=<?php echo $theme; ?>&ev_id=<?php echo $ev_list[$i]['ev_id']; ?>&w=u&iw=u" target="_blank" class="ae-btn-r" title="새창 열기">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-html="true" data-bs-content="
                                <span class='f-s-13r'>
                                <strong class='text-crimson'>배너이미지 권장 사이즈</strong> : 이미지 비율 600x440 픽셀 권장
                                <div class='margin-hr-10'></div>
                                <strong class='text-crimson'>이벤트제목</strong> : '강조하기' 설정시 배너이미지 위 이벤트제목이 출력 됨
                                </span>
                            "><i class="fas fa-question-circle"></i></button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
    
                <div class="boxevent-item-wrap">
                    <?php if (is_array($ev_list[$i]['ev_prd'])) { ?>
                    <div class="boxevent-item">
                        <?php foreach ($ev_list[$i]['ev_prd'] as $k => $ev_prd) { ?>
                        <div class="boxevent-item-box">
                            <div class="boxevent-item-box-in">
                                <div class="boxevent-item-img">
                                    <?php echo get_it_image($ev_prd['it_id'], 400, 0, get_text($ev_prd['it_name'])); ?>
                                </div>
                                <div class="boxevent-item-desc">
                                    <a href="<?php echo $ev_prd['item_href']; ?>">
                                        <h5><strong><?php echo get_text(cut_str($ev_prd['it_name'], 30)); ?></strong></h5>
                                    </a>
                                    <span><?php echo $ev_prd['it_price']; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
    
                    <?php if (count((array)$ev_list[$i]['ev_prd']) == 0) { ?>
                    <div class="boxevent-no-item">
                        <i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>