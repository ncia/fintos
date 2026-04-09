<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop020_main_3/ebslider.skin.html.php
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
                1. 슬라이더마스터 제목 : shop020_main_3<br>
                2. 슬라이더마스터 스킨 : shop020_main_3<br>
                3. EB슬라이더 아이템 링크수 : 1개<br>
                4. EB슬라이더 아이템 이미지수 : 1개<br>
                <span class='text-indigo'>[EB 슬라이더 - 아이템 관리]</span><br>
                1. EB슬라이더 아이템 추가 클릭<br>
                2. 대표 타이틀 입력<br>
                3. 서브 타이틀 입력<br>
                4. 설명문구 입력<br>
                5. 연결주소 [링크] #1 입력<br>
                6. 이미지 #1 업로드<br>
                <div class='margin-hr-5'></div>
                이미지 비율 700x320 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-shop020-m3-wrap-<?php echo $es_code; ?> {position:relative;margin-bottom:30px}
.ebs-shop020-m3 .swiper {width:100%;height:100%;margin-left:auto;margin-right:auto}
.ebs-shop020-m3 .swiper-slide {position:relative;text-align:center;font-size:.9375rem;display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center}
.ebs-shop020-m3 .swiper-slide img {display:block;width:100%;height:100%;object-fit:cover}
.ebs-shop020-m3 .swiper-m3 .swiper-cont {position:absolute;top:0;bottom:0;left:0;right:0}
.ebs-shop020-m3 .swiper-m3 .swiper-cont-in {position:absolute;top:0;bottom:0;left:0;right:0;padding:30px 40px;text-align:right;border:1px solid #e5e5e5}
.ebs-shop020-m3 .swiper-m3 .swiper-cont h2 {margin:0;color:#151515;font-size:1.25rem;font-weight:700}
.ebs-shop020-m3 .swiper-m3 .swiper-cont h3 {margin:10px 0 0;color:#151515;font-size:1rem}
.ebs-shop020-m3 .swiper-m3 .swiper-cont p {margin:10px 0 0;color:#757575;font-size:.8125rem}
.ebs-shop020-m3 .swiper-m3 .swiper-cont-in:hover h2 {text-decoration:underline}
.ebs-shop020-m3 .swiper-button-next, .ebs-shop020-m3 .swiper-button-prev {width:20px;height:40px;border:0;-webkit-transition: all .3s ease;-moz-transition: all .3s ease;-o-transition: all .3s ease;-ms-transition: all .3s ease;transition: all .3s ease}
.ebs-shop020-m3 .swiper-button-next {right:10px;z-index:1}
.ebs-shop020-m3 .swiper-button-prev {left:10px;z-index:1}
.ebs-shop020-m3 .swiper-button-next:before, .ebs-shop020-m3 .swiper-button-prev:before {content:"";display:block;position:absolute;top:50%;width:20px;height:20px;margin-top:-10px;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-o-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}
.ebs-shop020-m3 .swiper-button-next:before {right:10px;border-right:1px solid #151515;border-top:1px solid #151515}
.ebs-shop020-m3 .swiper-button-prev:before {left:10px;border-left:1px solid #151515;border-bottom:1px solid #151515}
.ebs-shop020-m3 .swiper-button-next:after, .ebs-shop020-m3 .swiper-button-prev:after {content:"";display:block;position:absolute;top:50%;width:0;height:1px;background:#151515;-webkit-transition:all 0.4s ease-in-out;-moz-transition:all 0.4s ease-in-out;-o-transition:all 0.4s ease-in-out;transition:all 0.4s ease-in-out}
.ebs-shop020-m3 .swiper-button-next:after {right:6px}
.ebs-shop020-m3 .swiper-button-prev:after {left:6px}
.ebs-shop020-m3 .swiper-button-next:hover:after, .ebs-shop020-m3 .swiper-button-prev:hover:after {width:25px}
.ebs-shop020-m3 .swiper-button-next.disabled, .ebs-shop020-m3 .swiper-button-prev.disabled {display:none}
@media (max-width:1199px) {
    .ebs-shop020-m3 .swiper-m3 .swiper-cont h2 {font-size:1.25rem}
    .ebs-shop020-m3 .swiper-m3 .swiper-cont h3 {font-size:1rem}
    .ebs-shop020-m3 .swiper-m3 .swiper-cont p {font-size:.875rem}
}
</style>

<div class="ebs-shop020-m3-wrap-<?php echo $es_code; ?>">
    <?php if (is_array($slider)) { ?>
    <div class="ebs-shop020-m3">
        <div class="swiper swiper-m3">
            <div class="swiper-wrapper">
                <?php foreach ($slider as $k => $item) { ?>
                <div class="swiper-slide animate-img-hvr2">
                    <?php if ($item['href_1']) { ?>
                    <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                    <?php } ?>
                        <img src="<?php echo $item['src_1']?>" alt="">
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
                                <p><?php echo $item['ei_text']?></p>
                                <?php } ?>
                            </div>
                        </div>
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
    </div>
    <?php } ?>
    <?php if ($es_default) { ?>
    <div class="ebs-shop020-m3">
        <div class="swiper swiper-m3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/01.jpg" />
                    <div class="swiper-cont">
                        <div class="swiper-cont-in">
                            <h2>메인3 슬라이드 샘플 1</h2>
                            <h3>최대 30% OFF</h3>
                            <p>Mollis Sem Pellentesque</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/02.jpg" />
                    <div class="swiper-cont">
                        <div class="swiper-cont-in">
                            <h2>메인3 슬라이드 샘플 2</h2>
                            <h3>최대 30% OFF</h3>
                            <p>Mollis Sem Pellentesque</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <?php } ?>
</div>

<script>
var swiper = new Swiper(".ebs-shop020-m3-wrap-<?php echo $es_code; ?> .swiper-m3", {
    loop: true,
    grabCursor: true,
    slidesPerView: 1,
    autoplay: {
        delay: 5000
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        992: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
    },
});
</script>
<?php } ?>