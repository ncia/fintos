<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop020_main_5/ebslider.skin.html.php
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
                1. 슬라이더마스터 제목 : shop020_main_5<br>
                2. 슬라이더마스터 스킨 : shop020_main_5<br>
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
                PC 화면용 이미지 비율 440x920 픽셀 사이즈 권장<br>
                모바일 화면용 이미지 비율 600x400 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-shop020-m5-wrap-<?php echo $es_code; ?> {position:relative;margin-bottom:20px}
.ebs-shop020-m5 .swiper {width:100%;height:100%;margin-left:auto;margin-right:auto}
.ebs-shop020-m5 .swiper-slide {text-align:center;font-size:.9375rem;display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center}
.ebs-shop020-m5 .swiper-slide img {display:block;width:100%;height:100%;object-fit:cover}
.ebs-shop020-m5 .swiper-slide .overlay {position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%,rgba(0, 0, 0, 0.7) 90%);z-index:2}
.ebs-shop020-m5 .swiper-m5 .swiper-cont {position:absolute;top:70%;left:20px;right:20px;text-align:center;transform:translateY(-50%);z-index:3}
.ebs-shop020-m5 .swiper-m5 .swiper-cont h2 {font-weight:700;color:#fff;font-size:1.125rem;line-height:1.4}
.ebs-shop020-m5 .swiper-m5 .swiper-cont h3 {color:#fff;font-size:1rem;line-height:1.4;margin-top:10px}
.ebs-shop020-m5 .swiper-m5 .swiper-cont h4 {color:#fff;font-size:.875rem;line-height:1.4;margin-top:10px}
.ebs-shop020-m5 .swiper-button-next, .ebs-shop020-m5 .swiper-button-prev {opacity:0;width:30px;height:30px;top:32px;background:RGBA(0, 0, 0, 0.5);border-radius:3px;z-index:1;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.ebs-shop020-m5 .swiper-button-next {right:5px}
.ebs-shop020-m5 .swiper-button-prev {left:inherit;right:50px}
.ebs-shop020-m5:hover .swiper-button-next {right:10px;opacity:1}
.ebs-shop020-m5:hover .swiper-button-prev {right:42px;opacity:1}
.ebs-shop020-m5 .swiper-button-next:hover, .ebs-shop020-m5 .swiper-button-prev:hover {background:RGBA(0, 0, 0, 0.7)}
.ebs-shop020-m5 .swiper-button-next:before, .ebs-shop020-m5 .swiper-button-prev:before {content:"";display:block;position:absolute;top:50%;width:10px;height:10px;margin-top:-5px;-webkit-transform:rotate(45deg);transform:rotate(45deg);transition:all 0.3s linear}
.ebs-shop020-m5 .swiper-button-next:after, .ebs-shop020-m5 .swiper-button-prev:after {display:none}
.ebs-shop020-m5 .swiper-button-next:before {right:12px;border-right:1px solid #eee;border-top:1px solid #eee}
.ebs-shop020-m5 .swiper-button-prev:before {left:12px;border-left:1px solid #eee;border-bottom:1px solid #eee}
.ebs-shop020-m5 .swiper-pagination-bullet {color:#fff;font-size:0;line-height:0;width:30px;height:2px;border-radius:0;background-color:#fff;opacity:0.45}
.ebs-shop020-m5 .swiper-pagination-bullet-active {background-color:#fff;opacity:1}
@media (max-width:767px) {
    .ebs-shop020-m5 {max-width:600px;margin:0 auto 30px}
    .ebs-shop020-m5 .swiper-side .swiper-cont h2 {font-size:1.25rem}
    .ebs-shop020-m5 .swiper-side .swiper-cont h3 {font-size:.9375rem}
    .ebs-shop020-m5 .swiper-side .swiper-cont h4 {font-size:.9375rem}
}
</style>

<div class="ebs-shop020-m5-wrap-<?php echo $es_code; ?>">
    <?php if (is_array($slider)) { ?>
    <div class="ebs-shop020-m5">
        <div class="swiper swiper-m5">
            <div class="swiper-wrapper">
                <?php foreach ($slider as $k => $item) { ?>
                <div class="swiper-slide animate-img-hvr3">
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
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php } ?>
    <?php if ($es_default) { ?>
    <div class="ebs-shop020-m5">
        <div class="swiper swiper-m5">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <picture>
                        <source srcset="<?php echo $ebslider_skin_url; ?>/image/01.jpg" media="(min-width:768px)">
                        <source srcset="<?php echo $ebslider_skin_url; ?>/image/01_m.jpg" media="(max-width:767px)">
                        <img src="<?php echo $ebslider_skin_url; ?>/image/01.jpg" alt="">
                    </picture>
                    <div class="swiper-cont">
                        <h2>사이드 슬라이드 샘플 1</h2>
                        <h3>30% SALE</h3>
                        <h4>Ultricies Purus Aenean</h4>
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
                        <h2>사이드 슬라이드 샘플 2</h2>
                        <h3>20% SALE</h3>
                        <h4>Ligula Tortor Justo</h4>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php } ?>
</div>

<script>
var swiper = new Swiper(".ebs-shop020-m5-wrap-<?php echo $es_code; ?> .swiper-m5", {
    loop: true,
    grabCursor: true,
    autoplay: {
        delay: 5000
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
});
</script>
<?php } ?>