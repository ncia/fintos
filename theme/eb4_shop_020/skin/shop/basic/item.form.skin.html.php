<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/item.form.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 브레드크럼 영역의 경계선 제거
 */
?>
<style>
.shop-list-nav { border: none !important; }
#sit_btn_cart, #sit_btn_cart i { color: #fff !important; }
</style>
<?php

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fotorama/fotorama.css" type="text/css" media="screen">',0);
?>

<form name="fitem" method="post" action="<?php echo $action_url; ?>" onsubmit="return fitem_submit(this);">
<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>">
<input type="hidden" name="sw_direct">
<input type="hidden" name="url">

<div class="shop-product">
    <?php if ($is_admin) { ?>
    <div class="text-end m-b-10">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;w=u&amp;it_id=<?php echo $it_id; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-crimson btn-edit-mode">상품 관리</a>
    </div>
    <?php }?>

    <?php /* 상품명을 강조하는 상단 프리미엄 헤더 블록 */ ?>
    <div class="shop-item-title-block" style="background: #0d1116; padding: 25px 0; margin-bottom: 0; border-bottom: 1px solid #1a202c;">
        <div class="container" style="max-width: 100%; padding: 0 40px;">
            <h1 style="color: #fff; font-size: 24px; font-weight: 800; margin: 0; text-align: center; letter-spacing: -1px;">
                <?php echo stripslashes($it['it_name']); ?>
            </h1>
        </div>
    </div>

    <?php /* 첨부 이미지 스타일의 풀와이드 비주얼 영역 (이미지 + 내비게이션) */ ?>
    <?php /* 첨부 이미지 스타일의 풀와이드 비주얼 영역 (3개 이미지 동시 출력 슬라이더) */ ?>
    <style>
    /* 기존 테마 고유 디자인 유지 및 슬라이더 보호 */
    .item-visual-area-full { width: 100%; margin-bottom: 40px; border-top: 1px solid #1a202c; border-bottom: 1px solid #1a202c; background: #0d1116; clear: both; }
    .item-multi-slider { max-width: 1260px; width: 100%; height: 420px; overflow: hidden; margin: 0 auto; position: relative; background: #0d1116; }
    .slick-items .slick-list { margin: 0 -5px !important; }
    .slick-items .slick-slide { padding: 0 5px; outline: none; background: #0d1116; }
    .slick-items img { width: 420px; height: 420px; object-fit: contain; display: block; background: #fff; margin: 0 auto; }

    /* 브랜드 섹션 스타일 */
    .item-brand-area { margin-bottom: 20px; }
    </style>

    <div class="item-visual-area-full">
        <?php if ($it['it_brand']) { 
            // 브랜드 정보 가져오기
            $br = sql_fetch("select * from {$g5['eyoom_brand']} where br_name = '{$it['it_brand']}' limit 1");
            if ($br['br_code']) {
                $br_cd = $br['br_code'];
                if ($br['br_img']) {
                    $br['img_url'] = G5_DATA_URL.'/brand/'.$br['br_img'];
                } else {
                    $br['img_url'] = G5_URL.'/data/brand/'.rawurlencode($br['br_name']).'.png';
                }
                
                // 브랜드 상세 스킨 (shop/basic/brand.skin.html.php) 인클루드
                // 이 스킨 내부에서 eb_brand('basic')를 호출하여 하단 캐러셀까지 출력함
                include (EYOOM_THEME_SHOP_SKIN_PATH.'/brand.skin.html.php');
            } ?>
        <?php } ?>

        <div class="item-multi-slider">
            <div class="slick-items">
                <?php 
                $final_images = array();
                
                // 로직 안정화: 배열 체크 및 정규식 추출
                if (isset($big_img) && is_array($big_img)) {
                    foreach ($big_img as $bimg) {
                        if (isset($bimg['image']) && preg_match('/src="([^"]+)"/', $bimg['image'], $match)) {
                            $final_images[] = $match[1];
                        }
                    }
                }

                $final_images = array_unique($final_images);

                if (empty($final_images)) {
                    // 이미지가 없는 경우 슬라이더 영역을 감추거나 기본 이미지를 넣을 수 있으나, 
                    // 사용자 요청에 따라 가상 이미지는 제거함.
                }
                
                // 슬라이더 안정 구동을 위한 리스트 최적화
                $display_list = $final_images;
                if (!empty($display_list) && count($display_list) < 3) {
                    $display_list = array_merge($display_list, $display_list);
                }
                
                if (!empty($display_list)) {
                    foreach ($display_list as $img_url) {
                    ?>
                    <div>
                        <img src="<?php echo $img_url; ?>" alt="상품 이미지">
                    </div>
                    <?php 
                    } 
                }
                ?>
            </div>
        </div>

        <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
        <script>
        $(document).ready(function(){
            var $target = $('.slick-items');
            if ($target.length > 0) {
                var imgCount = $target.find('img').length;
                $target.slick({
                    slidesToShow: imgCount >= 3 ? 3 : imgCount,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    arrows: false,
                    dots: false,
                    infinite: true,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            }
        });
        </script>

        <?php /* 2. 첨부 이미지 스타일의 풀와이드 내비게이션 바 */ ?>
        <div class="item-navigator-all-v15" style="width: 100%;">
            <?php /* 1단: 이전상품 / 다음상품 */ ?>
            <div style="background: #0d1116; border-bottom: 1px solid #1a202c; display: flex; align-items: stretch; height: 55px;">
                <a href="<?php echo $prev_href ? $prev_href : 'javascript:void(0);'; ?>" style="width: 65px; display: flex; align-items: center; justify-content: center; border-right: 1px solid #1a202c; color: #fff; text-decoration: none;">
                    <i class="fas fa-chevron-left" style="font-size: 18px;"></i>
                </a>
                <div style="flex: 1; display: flex; justify-content: space-between; align-items: center; padding: 0 40px;">
                    <a href="<?php echo $prev_href ? $prev_href : 'javascript:void(0);'; ?>" style="color: #fff; text-decoration: none; font-size: 16px; font-weight: 600; letter-spacing: -0.5px;">이전상품</a>
                    <a href="<?php echo $next_href ? $next_href : 'javascript:void(0);'; ?>" style="color: #fff; text-decoration: none; font-size: 16px; font-weight: 600; letter-spacing: -0.5px;">다음 상품</a>
                </div>
                <a href="<?php echo $next_href ? $next_href : 'javascript:void(0);'; ?>" style="width: 65px; display: flex; align-items: center; justify-content: center; border-left: 1px solid #1a202c; color: #fff; text-decoration: none;">
                    <i class="fas fa-chevron-right" style="font-size: 18px;"></i>
                </a>
            </div>
            
            <?php /* 2단: 아이콘 정보 */ ?>
            <div style="background: #0d1116; display: flex; justify-content: space-between; align-items: center; padding: 0 40px; height: 55px;">
                <div style="display: flex; gap: 25px; align-items: center;">
                    <span style="color: #cbd5e0; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="far fa-comment-dots"></i> <?php echo $item_use_count; ?>
                    </span>
                    <span style="color: #2d3748; display: inline-block; width: 1px; height: 16px; background: #2d3748;"></span>
                    <span style="color: #cbd5e0; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="far fa-heart"></i> <?php echo get_wishlist_count_by_item($it['it_id']); ?>
                    </span>
                </div>
                <div>
                    <a href="javascript:void(0);" onclick="jQuery('.item-share-dropdown').toggle();" style="color: #cbd5e0; text-decoration: none; display: flex; align-items: center; justify-content: center; width: 65px; border-left: 1px solid #1a202c; height: 55px; margin-right: -40px;">
                        <i class="fas fa-share-alt" style="font-size: 18px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

        <div class="col-lg-12">
            <?php /* ---------- 상품 요약정보 및 구매 시작 ---------- */ ?>
            <div class="sit-ov-height">
                <div id="sit_ov" class="shop-product-form 2017_renewal_itemform">
                    <div id="btn_buy_back"></div>
                    <div class="buy-btn-wr"><button type="button" class="buy-op-btn">구매하기 <i class="fas fa-credit-card"></i></button></div>
                    <div class="scroll-no">

                        <?php if ($is_orderable) { ?>
                        <p class="sound_only">
                            상품 선택옵션 <?php echo $option_count; ?> 개, 추가옵션 <?php echo $supply_count; ?> 개
                        </p>
                        <?php } ?>

                    </div>
                    
                    <div class="scroll-show">
                        <div id="scroll_show_close"><i class="fas fa-times"></i><span class="sound_only">창닫기</span></div>

                        <?php /* 선택옵션 시작 */ ?>
                        <?php if ($optitem) { ?>
                        <div class="sit_option eyoom-form">
                            <h3>선택옵션</h3>
                            <?php if ($option_count > 1) { ?>
                            <?php for($i=0; $i<$option_count; $i++) { ?>
                            <div class="get_item_options">
                                <label for="it_option_<?php echo $optitem[$i]['seq']; ?>"><?php echo $optitem[$i]['subject']; ?></label>
                                <div class="select m-b-10">
                                    <select id="it_option_<?php echo $optitem[$i]['seq']; ?>" class="it_option" <?php echo $optitem[$i]['disabled']; ?>>
                                        <option value="">선택</option>
                                        <?php foreach ($optitem[$i]['select'] as $k => $select) { ?>
                                        <option value="<?php echo $select['opt_val']; ?>"><?php echo $select['opt_val']; ?></option>
                                        <?php } ?>
                                    </select><i></i>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } else { ?>
                            <div class="get_item_options">
                                <label for="it_option_1"><?php echo $optitem['subject']; ?></label>
                                <div class="select m-b-10">
                                    <select id="it_option_1" class="it_option">
                                        <option value="">선택</option>
                                        <?php foreach ($optitem['select'] as $k => $select) { ?>
                                        <option value="<?php echo $select['io_id']; ?>,<?php echo $select['io_price']; ?>,<?php echo $select['io_stock_qty']; ?>"><?php echo $select['io_id']; ?><?php echo $select['price']; ?><?php echo $select['soldout']; ?></option>
                                        <?php } ?>
                                    </select><i></i>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <?php /* 선택옵션 끝 */ ?>

                        <?php /* 추가옵션 시작 */ ?>
                        <?php if($supitem) { ?>
                        <div class="sit_option eyoom-form">
                            <h3>추가옵션</h3>
                            <?php for($i=0; $i<$supply_count; $i++) { ?>
                            <div class="get_item_supply">
                                <label for="it_supply_<?php echo $supitem[$i]['seq']; ?>"><?php echo $supitem[$i]['subject']; ?></label>
                                <div class="select m-b-10">
                                    <select id="it_supply_<?php echo $supitem[$i]['seq']; ?>" class="it_supply">
                                        <option value="">선택</option>
                                        <?php if (isset($supitem[$i]['select']) && is_array($supitem[$i]['select'])) { ?>
                                            <?php foreach ($supitem[$i]['select'] as $k => $select) { ?>
                                            <?php echo $select['opt_val']; ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select><i></i>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <?php /* 추가옵션 끝 */ ?>

                        <?php if ($is_orderable) { ?>
                        <?php /* 선택된 옵션 시작 */ ?>

                        <?php /* 선택된 옵션 끝 */ ?>

                        <?php /* 총 구매액 */ ?>

                        <?php } ?>

                        <?php if($is_soldout) { ?>
                        <p id="sit_ov_soldout">상품의 재고가 부족하여 구매할 수 없습니다.</p>
                        <?php } ?>

                        <div id="sit_ov_btn" style="display: flex; justify-content: center; align-items: center; gap: 8px; flex-wrap: wrap; width: 100%; margin: 30px 0 0 0;">
                            <?php if ($is_orderable) { ?>
                            <button type="submit" onclick="document.pressed=this.value;" value="바로구매" id="sit_btn_buy"><i class="fas fa-credit-card" style="margin-right:7px;"></i>바로구매</button>
                            <button type="submit" onclick="document.pressed=this.value;" value="장바구니" id="sit_btn_cart"><i class="fas fa-shopping-cart" style="margin-right:7px;"></i>장바구니</button>
                            <?php } ?>
                            <?php if(!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
                            <a href="javascript:popup_stocksms('<?php echo $it['it_id']; ?>');" id="sit_btn_alm"><i class="far fa-bell" aria-hidden="true"></i> 재입고알림</a>
                            <?php } ?>
                             <button type="button" onclick="item_wish(document.fitem, '<?php echo $it['it_id']; ?>');" id="sit_btn_wish"><i class="fas fa-heart" style="margin-right:7px;"></i>관심상품</button>
                            <?php if ($naverpay_button_js) { ?>
                            <div class="itemform-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
                            <?php } ?>
                        </div>

                        <script>
                        // 상품보관
                        function item_wish(f, it_id) {
                            f.url.value = "<?php echo G5_SHOP_URL; ?>/wishupdate.php?it_id="+it_id;
                            f.action = "<?php echo G5_SHOP_URL; ?>/wishupdate.php";
                            f.submit();
                        }

                        // 추천메일
                        function popup_item_recommend(it_id) {
                            if (!g5_is_member)
                            {
                                if (confirm("회원만 추천하실 수 있습니다."))
                                    document.location.href = "<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo urlencode(shop_item_url($it_id)); ?>";
                            } else {
                                url = "./itemrecommend.php?it_id=" + it_id;
                                opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
                                popup_window(url, "itemrecommend", opt);
                            }
                        }

                        // 재입고SMS 알림
                        function popup_stocksms(it_id) {
                            url = "<?php echo G5_SHOP_URL; ?>/itemstocksms.php?it_id=" + it_id;
                            opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
                            popup_window(url, "itemstocksms", opt);
                        }
                        </script>
                    </div>
                </div>
            </div>
            <?php /* ---------- 상품 요약정보 및 구매 끝 ---------- */ ?>
        </div>
    </div>
</div>
</form>

<?php /* ---------- 상품이미지 크게 보기 모달 시작 ---------- */ ?>
<div class="modal fade shop-img-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="fotorama" data-nav="thumbs" data-max-width="100%" data-loop="true">
                    <?php foreach ($big_img as $k => $bimg) { ?>
                    <?php echo $bimg['image']; ?>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" aria-label="Close" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>
<?php /* ---------- 상품이미지 크게 보기 모달 끝 ---------- */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fotorama/fotorama.js"></script>
<?php if ($item_view == 'zoom') { // 상품이미지 미리보기 종류 - zoom ?>
<?php if (!G5_IS_MOBILE) { // PC버전의 경우에만 줌적용 ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/elevatezoom-plus/jquery.ez-plus.js"></script>
<?php } ?>
<script>
$(document).ready(function(){
    <?php if (!G5_IS_MOBILE) { // PC버전의 경우에만 줌적용 ?>
    $('.elevaterzoom_item img').ezPlus({
        zoomWindowWidth: 526,
        zoomWindowHeight: 526,
        easing: true
    });
    <?php } ?>
    $(function(){
        // 상품이미지 첫번째 링크
        $(".product-img-big a:first").addClass("visible");
        // 상품이미지 미리보기 (썸네일에 마우스 오버시)
        $(".product-thumb .thumb-img").bind("mouseover focus", function(){
            var idx = $(".product-thumb .thumb-img").index($(this));
            $(".product-img-big a.visible").removeClass("visible");
            $(".product-img-big a:eq("+idx+")").addClass("visible");
        });
    });
});
</script>
<?php } ?>
<script>
$(window).load(function(){
    /* 기존 테마의 중복 슬라이더 호출을 비활성화하여 레이아웃 충돌 방지 */
});
</script>

<script>
$(function(){
    // 상품이미지 첫번째 링크
    $("#sit_pvi_big a:first").addClass("visible");

    // 상품이미지 미리보기 (썸네일에 마우스 오버시)
    $("#sit_pvi .img_thumb").bind("mouseover focus", function(){
        var idx = $("#sit_pvi .img_thumb").index($(this));
        $("#sit_pvi_big a.visible").removeClass("visible");
        $("#sit_pvi_big a:eq("+idx+")").addClass("visible");
    });

    // 상품이미지 크게보기
    $(".popup_item_image").click(function() {
        var url = $(this).attr("href");
        var top = 10;
        var left = 10;
        var opt = 'scrollbars=yes,top='+top+',left='+left;
        popup_window(url, "largeimage", opt);

        return false;
    });
});

function fsubmit_check(f)
{
    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }

    return true;
}

// 바로구매, 장바구니 폼 전송
function fitem_submit(f)
{
    f.action = "<?php echo $action_url; ?>";
    f.target = "";

    if (document.pressed == "장바구니") {
        f.sw_direct.value = 0;
    } else { // 바로구매
        f.sw_direct.value = 1;
    }

    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }

    return true;
}

// 스크롤시 구매하기 버튼 항상 출력
$(function(){
    var sitOvHeight = $('#sit_ov').height();
    var stickyHeaderTop = $('#sit_ov_btn').offset().top+$('#sit_ov').height()+50;
    
    $(window).scroll(function(){
        if( $(window).scrollTop() > stickyHeaderTop ) {
                $('#sit_ov').addClass("fixed");
                $('#sit_ov').removeClass("static");
                $('.sit-ov-height').height(sitOvHeight);
        } else {
                $('#sit_ov').removeClass("fixed");
                $('#sit_ov').addClass("static");
                $('.sit-ov-height').css('height','auto');
        }
    });
    
    $('.buy-op-btn').click(function() {
        $('.scroll-show').toggleClass('scroll-show-popup');
        $('#btn_buy_back').toggle();
    });

    $('#scroll_show_close, #btn_buy_back').click(function() {
        $('.scroll-show').removeClass('scroll-show-popup');
        $('#btn_buy_back').hide();
    });
});
</script>
<?php /* 2017 리뉴얼한 테마 적용 스크립트입니다. 기존 스크립트를 오버라이드 합니다. */ ?>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>