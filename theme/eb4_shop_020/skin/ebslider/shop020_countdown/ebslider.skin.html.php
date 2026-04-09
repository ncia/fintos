<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop020_countdown/ebslider.skin.html.php
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
                1. 슬라이더마스터 제목 : shop020_countdown<br>
                2. 슬라이더마스터 스킨 : shop020_countdown<br>
                3. EB슬라이더 아이템 링크수 : 1개<br>
                4. EB슬라이더 아이템 이미지수 : 1개<br>
                <span class='text-indigo'>[EB 슬라이더 - 아이템 관리]</span><br>
                1. EB슬라이더 아이템 추가 클릭<br>
                2. 대표 타이틀 입력<br>
                3. 서브 타이틀 입력 (상품명 입력)<br>
                4. 설명문구 입력 (상품가격 입력)<br>
                5. 연결주소 [링크] #1 입력<br>
                6. 이미지 #1 업로드<br>
                7. <span class='text-crimson'>노출방식을 기간제방식으로 노출기간을 설정하면 종료일을 기준으로 카운트다운 출력</span><br>
                <div class='margin-hr-5'></div>
                이미지 비율 360x360 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-shop020-cd-wrap-<?php echo $es_code; ?> {position:relative;margin-bottom:20px}
.ebs-shop020-cd-in {position:relative;overflow:hidden;border:1px solid #e5e5e5}
.ebs-shop020-cd-in .hot-label {position:absolute;top:-40px;left:-40px;width:80px;height:80px;padding-top:58px;text-align:center;background:#ab0000;color:#fff;font-style:italic;font-size:.75rem;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);z-index:1}
.ebs-shop020-cd .swiper {width:100%;height:100%;margin-left:auto;margin-right:auto}
.ebs-shop020-cd .swiper-slide {position:relative;outline:none;padding:30px 20px;height:410px}
.ebs-shop020-cd .swiper-slide h2 {margin:0 0 10px;font-size:1.25rem;font-weight:700}
.ebs-shop020-cd .swiper-slide .ebs-shop020-cd-img {max-width:180px;margin:0 auto}
.ebs-shop020-cd .swiper-slide .ebs-shop020-cd-img img {display:block;max-width:100%;height:auto}
.ebs-shop020-cd .swiper-slide h3 {margin:15px 0 0;font-size:1.0625rem;font-weight:700}
.ebs-shop020-cd .swiper-slide:hover h3 {text-decoration:underline;color:#000}
.ebs-shop020-cd .swiper-slide p {margin:5px 0 0;font-size:.9375rem;color:#757575}
.ebs-shop020-cd .swiper-slide p strong {color:#ab0000}
.ebs-shop020-cd .swiper-slide .shop020-countdown {display:block;margin:10px 0 0;color:#000;font-size:1.125rem}
.ebs-shop020-cd .swiper-slide .shop020-countdown strong {font-weight:700}
.ebs-shop020-cd .swiper-slide .shop020-countdown b {font-weight:700}
.ebs-shop020-cd .swiper-slide .shop020-countdown i {display:block;font-style:normal;color:#151515;font-size:.9375rem;font-weight:400}
.ebs-shop020-cd .swiper-button-next, .ebs-shop020-cd .swiper-button-prev {opacity:0;width:30px;height:30px;top:10px;margin-top:0;background:RGBA(0, 0, 0, 0.5);border-radius:3px;z-index:1;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.ebs-shop020-cd .swiper-button-next {right:5px}
.ebs-shop020-cd .swiper-button-prev {left:inherit;right:50px}
.ebs-shop020-cd:hover .swiper-button-next {right:10px;opacity:1}
.ebs-shop020-cd:hover .swiper-button-prev {right:42px;opacity:1}
.ebs-shop020-cd .swiper-button-next:hover, .ebs-shop020-cd .swiper-button-prev:hover {background:RGBA(0, 0, 0, 0.7)}
.ebs-shop020-cd .swiper-button-next:before, .ebs-shop020-cd .swiper-button-prev:before {content:"";display:block;position:absolute;top:50%;width:10px;height:10px;margin-top:-5px;-webkit-transform:rotate(45deg);transform:rotate(45deg);transition:all 0.3s linear}
.ebs-shop020-cd .swiper-button-next:after, .ebs-shop020-cd .swiper-button-prev:after {display:none}
.ebs-shop020-cd .swiper-button-next:before {right:12px;border-right:1px solid #eee;border-top:1px solid #eee}
.ebs-shop020-cd .swiper-button-prev:before {left:12px;border-left:1px solid #eee;border-bottom:1px solid #eee}
.ebs-shop020-cd .swiper-pagination-bullet {color:#fff;font-size:0;line-height:0;width:30px;height:2px;border-radius:0;background-color:#454545;opacity:0.45}
.ebs-shop020-cd .swiper-pagination-bullet-active {background-color:#151515;opacity:1}
</style>

<div class="ebs-shop020-cd-wrap-<?php echo $es_code; ?>">
    <?php if (is_array($slider)) { ?>
    <div class="ebs-shop020-cd-in">
        <div class="hot-label">HOT</div>
        <div class="ebs-shop020-cd">
            <div class="swiper swiper-cd">
                <div class="swiper-wrapper">
                    <?php foreach ($slider as $k => $item) { ?>
                    <div class="swiper-slide">
                        <h2 class="ellipsis"><?php echo $item['ei_title']?></h2>
                        <?php if ($item['href_1']) { ?>
                        <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                        <?php } ?>
                        <div class="ebs-shop020-cd-img animate-img-hvr3">
                            <img src="<?php echo $item['src_1']?>" alt="">
                        </div>
                        <?php if ($item['href_1']) { ?>
                        </a>
                        <?php } ?>
                        <?php if ($item['ei_subtitle']) { ?>
                        <?php if ($item['href_1']) { ?>
                        <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                        <?php } ?>
                        <h3 class="ellipsis"><?php echo $item['ei_subtitle']?></h3>
                        <?php if ($item['href_1']) { ?>
                        </a>
                        <?php } ?>
                        <?php } ?>
                        <?php if ($item['ei_text']) { ?>
                        <p><?php echo stripslashes($item['ei_text']); ?></p>
                        <?php } ?>
                        <?php if($item['ei_end']) { ?>
                        <span class="shop020-countdown" data-countdown="<?php echo date('Y-m-d',strtotime($item['ei_end'])); ?>"></span>
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
    </div>
    <?php } ?>
    <?php if ($es_default) { ?>
    <div class="ebs-shop020-cd-in">
        <div class="ebs-shop020-cd">
            <div class="swiper swiper-cd">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <h2 class="ellipsis">TIME SALE</h2>
                        <div class="ebs-shop020-cd-img animate-img-hvr3">
                            <img src="<?php echo $ebslider_skin_url; ?>/image/01.jpg" alt="">
                        </div>
                        <h3 class="ellipsis">메인 카운트다운 1</h3>
                        <span class="shop020-countdown" data-countdown="2027-03-20"></span>
                    </div>
                    <div class="swiper-slide">
                        <h2 class="ellipsis">TIME SALE</h2>
                        <div class="ebs-shop020-cd-img animate-img-hvr3">
                            <img src="<?php echo $ebslider_skin_url; ?>/image/02.jpg" alt="">
                        </div>
                        <h3 class="ellipsis">메인 카운트다운 2</h3>
                        <span class="shop020-countdown" data-countdown="2027-08-05"></span>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
</div>
    <?php } ?>
</div>

<script src="<?php echo $ebslider_skin_url; ?>/jquery-countdown/jquery.countdown.min.js"></script>
<script>
var swiper = new Swiper(".ebs-shop020-cd-wrap-<?php echo $es_code; ?> .swiper-cd", {
    loop: true,
    autoplay: {
        delay: 5000
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

$(function() {
    $('.shop020-countdown').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, {elapse: true}).on('update.countdown', function(event) {
            if (event.elapsed) {
                $this.html('<strong>종료</strong>');
            } else {
                $this.html(event.strftime('<strong><i>남은기간 :</i> <b>%D일</b> %H:%M:%S</strong>'));
            }
        });
    });
});
</script>
<?php } ?>