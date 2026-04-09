<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop020_main_1/ebslider.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($es_master['es_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_form&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&w=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB슬라이더 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_form&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="
                <span class='f-s-13r'>
                <strong class='text-indigo'>좌측 [EB슬라이더 마스터 설정 버튼] 클릭 후 아래 설명 참고</strong><br>
                <div class='margin-hr-5'></div>
                <span class='text-indigo'>[설정정보]</span><br>
                1. 슬라이더마스터 제목 : shop020_main_1<br>
                2. 슬라이더마스터 스킨 : shop020_main_1<br>
                3. EB슬라이더 아이템 링크수 : 1개<br>
                4. EB슬라이더 아이템 이미지수 : 2개<br>
                <span class='text-indigo'>[EB 슬라이더 - 아이템 관리]</span><br>
                1. EB슬라이더 아이템 추가 클릭<br>
                2. 대표 타이틀 입력<br>
                3. 서브 타이틀 입력<br>
                4. 설명문구 입력<br>
                5. 연결주소 [링크] #1 입력<br>
                6. 이미지 #1 업로드 (PC 화면용 이미지)<br>
                7. 이미지 #2 업로드 (모바일 화면용 이미지)<br>
                <div class='margin-hr-5'></div>
                PC 화면용 이미지 비율 1000x500 픽셀 사이즈 권장<br>
                모바일 화면용 이미지 비율 800x800 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-shop020-m1-wrap-<?php echo $es_code; ?> {position:relative;margin-bottom:30px}
.ebs-shop020-m1 {position:relative;overflow:hidden}
.ebs-shop020-m1 .swiper {width:100%;height:100%;margin-left:auto;margin-right:auto}
.ebs-shop020-m1 .swiper-slide {text-align:center;font-size:.9375rem}
.ebs-shop020-m1 .swiper-slide img {display:block;width:100%;height:100%;object-fit:cover}
.ebs-shop020-m1 .swiper-m1 .swiper-cont  {position:absolute;top:0;bottom:0;left:0;width:300px;padding:20px;background:rgba(255,255,255,0.5);word-break:keep-all;box-shadow:5px 0 3px -2px rgba(0,0,0,0.1)}
.ebs-shop020-m1 .swiper-m1 .swiper-cont-in {position:absolute;top:50%;left:50%;width:260px;text-align:left;transform:translate(-50%,-50%)}
.ebs-shop020-m1 .swiper-m1 .swiper-cont  h2 {color:#151515;font-size:1.625rem;font-weight:700;width:100%}
.ebs-shop020-m1 .swiper-m1 .swiper-cont  h3 {color:#151515;margin-top:20px;font-size:1.25rem}
.ebs-shop020-m1 .swiper-m1 .swiper-cont  h4 {margin-top:20px;font-size:1rem;color:#757575}
.ebs-shop020-m1 .swiper-thumbs-wrap {position:absolute;bottom:10px;left:50%;min-width:200px;max-width:200px;transform:translateX(-50%);z-index:2}
.ebs-shop020-m1 .swiper-thumbs-wrap.disabled {display:none}
.ebs-shop020-m1 .swiper-thumbs {height:20%;box-sizing:border-box;padding:10px 0}
.ebs-shop020-m1 .swiper-thumbs .swiper-wrapper.justify-content-center {justify-content:center}
.ebs-shop020-m1 .swiper-thumbs .swiper-slide {width:33.33333%;height:100%;opacity:0.6}
.ebs-shop020-m1 .swiper-thumbs .swiper-slide:last-child {margin-right:0 !important}
.ebs-shop020-m1 .swiper-thumbs .swiper-slide img {display:block;width:100%;height:100%;object-fit:cover}
.ebs-shop020-m1 .swiper-thumbs .swiper-slide-thumb-active {opacity: 1}
.ebs-shop020-m1 .swiper-thumbs .swiper-slide .swiper-thumb-img {border:1px solid rgba(0,0,0,0.5);cursor:pointer}
.ebs-shop020-m1 .swiper-progress-bar {position:absolute;top:-7px;left:0;display:block;width:0;height:1px;background-color:#0078ff;transition:none}
.ebs-shop020-m1 .swiper-slide-thumb-active .swiper-progress-bar {transition-property:width;transition-timing-function:linear;width:100%}
.ebs-shop020-m1 .swiper-button-next, .ebs-shop020-m1 .swiper-button-prev {opacity:0;width:30px;height:30px;top:10px;margin-top:0;background:RGBA(0, 0, 0, 0.5);border-radius:3px;z-index:1;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.ebs-shop020-m1 .swiper-button-next {right:5px}
.ebs-shop020-m1 .swiper-button-prev {left:inherit;right:47px}
.ebs-shop020-m1 .swiper-m1:hover .swiper-button-next {right:10px;opacity:1}
.ebs-shop020-m1 .swiper-m1:hover .swiper-button-prev {right:42px;opacity:1}
.ebs-shop020-m1 .swiper-m1 .swiper-button-next:hover, .ebs-shop020-m1 .swiper-m1 .swiper-button-prev:hover {background:RGBA(0, 0, 0, 0.7)}
.ebs-shop020-m1 .swiper-m1 .swiper-button-next:before, .ebs-shop020-m1 .swiper-m1 .swiper-button-prev:before {content:"";display:block;position:absolute;top:50%;width:10px;height:10px;margin-top:-5px;-webkit-transform:rotate(45deg);transform:rotate(45deg);transition:all 0.3s linear}
.ebs-shop020-m1 .swiper-m1 .swiper-button-next:before {right:12px;border-right:1px solid #eee;border-top:1px solid #eee}
.ebs-shop020-m1 .swiper-m1 .swiper-button-prev:before {left:12px;border-left:1px solid #eee;border-bottom:1px solid #eee}
.ebs-shop020-m1 .swiper-m1 .swiper-button-next:after, .ebs-shop020-m1 .swiper-m1 .swiper-button-prev:after {display:none}
@media (max-width:1399px) {
    .ebs-shop020-m1 .swiper-m1 .swiper-cont {width:250px;padding:15px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont-in {width:220px}
}
@media (max-width:1199px) {
    .ebs-shop020-m1 .swiper-m1 .swiper-cont {width:300px;padding:20px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont-in {width:260px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h2 {font-size:35px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h3 {font-size:1.125rem}
}
@media (max-width:991px) {
    .ebs-shop020-m1 .swiper-m1 .swiper-cont {width:250px;padding:15px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont-in {width:220px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h2 {font-size:28px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h3 {font-size:1.125rem;margin-top:10px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h4 {margin-top:10px}
}
@media (max-width:767px) {
    .ebs-shop020-m1 .swiper-m1 .swiper-cont {position:absolute;top:inherit;bottom:0;left:0;right:0;width:100%;height:50%;padding:20px}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont-in {position:relative;top:inherit;left:inherit;transform:inherit;width:100%;margin:0 auto}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h2 {font-size:1.25rem}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h3 {font-size:1rem}
    .ebs-shop020-m1 .swiper-m1 .swiper-cont h4 {font-size:.8125rem}
}
</style>

<div class="ebs-shop020-m1-wrap-<?php echo $es_code; ?>">
    <?php if (is_array($slider)) { ?>
    <div class="ebs-shop020-m1">
        <div id="ebs_shop020_m1" class="swiper swiper-m1">
            <div class="swiper-wrapper">
                <?php foreach ($slider as $k => $item) { ?>
                <div class="swiper-slide">
                    <?php if ($item['href_1']) { ?>
                    <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                    <?php } ?>
                        <picture>
                            <source srcset="<?php echo $item['src_1']?>" media="(min-width:768px)">
                            <source srcset="<?php echo $item['src_2']?>" media="(max-width:767px)">
                            <img src="<?php echo $item['src_1']?>" alt="">
                        </picture>
                        <?php if ($item['ei_title'] || $item['ei_subtitle'] || $item['ei_text']) { ?>
                        <div class="swiper-cont">
                            <div class="swiper-cont-in">
                                <?php if ($item['ei_title']) { ?>
                                <h2><?php echo $item['ei_title']?></h2>
                                <?php } ?>
                                <?php if ($item['ei_subtitle']) { ?>
                                <h3><?php echo $item['ei_subtitle']?></h3>
                                <?php } ?>
                                <?php if ($item['ei_text']) { ?>
                                <h4><?php echo stripslashes($item['ei_text']); ?></h4>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="overlay"></div>
                        <?php } ?>
                    <?php if ($item['href_1']) { ?>
                    </a>
                    <?php } ?>

                    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                    <div class="adm-edit-btn btn-edit-mode" style="top:40px;z-index:3">
                        <div class="btn-group">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&ei_no=<?php echo $item['ei_no']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn"><i class="far fa-edit"></i> EB슬라이더 아이템 설정</a>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&ei_no=<?php echo $item['ei_no']; ?>&w=u&iw=u" target="_blank" class="ae-btn-r" title="새창 열기">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="swiper-thumbs-wrap">
            <div thumbsSlider="" id="ebs_shop020_m1_thumbs" class="swiper swiper-thumbs">
                <div class="swiper-wrapper">
                    <?php foreach ($slider as $k => $item) { ?>
                    <div class="swiper-slide swiper-pagination-progress">
                        <div class="swiper-progress-bar-wrap">
                            <div class="swiper-progress-bar"></div>
                        </div>
                        <div class="swiper-thumb-img">
                            <img src="<?php echo $item['src_2']?>" alt="">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if ($es_default) { ?>
    <div class="ebs-shop020-m1">
        <div id="ebs_shop020_m1" class="swiper swiper-m1">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <picture>
                        <source srcset="<?php echo $ebslider_skin_url; ?>/image/01.jpg" media="(min-width:768px)">
                        <source srcset="<?php echo $ebslider_skin_url; ?>/image/01_m.jpg" media="(max-width:767px)">
                        <img src="<?php echo $ebslider_skin_url; ?>/image/01.jpg" alt="">
                    </picture>
                    <div class="swiper-cont">
                        <div class="swiper-cont-in">
                            <h2>메인 슬라이더 샘플 1</h2>
                            <h3>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</h3>
                            <h4>Mollis Sem</h4>
                        </div>
                    </div>
                    <div class="overlay"></div>
                </div>
                <div class="swiper-slide">
                    <picture>
                        <source srcset="<?php echo $ebslider_skin_url; ?>/image/02.jpg" media="(min-width:768px)">
                        <source srcset="<?php echo $ebslider_skin_url; ?>/image/02_m.jpg" media="(max-width:767px)">
                        <img src="<?php echo $ebslider_skin_url; ?>/image/02.jpg" alt="">
                    </picture>
                    <div class="swiper-cont">
                        <div class="swiper-cont-in">
                            <h2>메인 슬라이더 샘플 2</h2>
                            <h3>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</h3>
                            <h4>Mollis Sem</h4>
                        </div>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="swiper-thumbs-wrap">
            <div thumbsSlider="" id="ebs_shop020_m1_thumbs" class="swiper swiper-thumbs">
                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-pagination-progress">
                        <div class="swiper-progress-bar-wrap">
                            <div class="swiper-progress-bar"></div>
                        </div>
                        <div class="swiper-thumb-img">
                            <img src="<?php echo $ebslider_skin_url; ?>/image/01_m.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide swiper-pagination-progress">
                        <div class="swiper-progress-bar-wrap">
                            <div class="swiper-progress-bar"></div>
                        </div>
                        <div class="swiper-thumb-img">
                            <img src="<?php echo $ebslider_skin_url; ?>/image/02_m.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script>
var ebs_shop020_m1_thumbs = new Swiper("#ebs_shop020_m1_thumbs", {
    loop: false,
    spaceBetween: 10,
    slidesPerView: 3,
    freeMode: true,
    on: {
        'afterInit': function (swiper) {
            swiper.el.querySelectorAll('.swiper-progress-bar')
            .forEach($progress => $progress.style.transitionDuration = `5000ms`)
        }
    }
});
var ebs_shop020_m1 = new Swiper("#ebs_shop020_m1", {
    loop: true,
    effect: 'fade',
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: ebs_shop020_m1_thumbs,
    },
});
// 썸네일 이미지가 1개일 경우는 썸네일 영역 숨김
if($("#ebs_shop020_m1_thumbs .swiper-slide").length == 1) {
    $('.swiper-thumbs-wrap, .swiper-button-next, .swiper-button-prev').addClass( "disabled" );
}
// 썸네일 이미지가 2개 이하일 경우 클래스 추가
if($("#ebs_shop020_m1_thumbs .swiper-slide").length < 3) {
    $('.ebs-shop020-m1 .swiper-thumbs .swiper-wrapper').addClass( "justify-content-center" );
}
</script>
<?php } ?>