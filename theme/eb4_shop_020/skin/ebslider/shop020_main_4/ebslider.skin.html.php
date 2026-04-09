<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop020_main_4/ebslider.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
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
                1. 슬라이더마스터 제목 : shop020_main_4<br>
                2. 슬라이더마스터 스킨 : shop020_main_4<br>
                3. EB슬라이더 아이템 링크수 : 1개<br>
                4. EB슬라이더 아이템 이미지수 : 1개<br>
                <span class='text-indigo'>[EB 슬라이더 - 아이템 관리]</span><br>
                1. EB슬라이더 아이템 추가 클릭<br>
                2. 대표 타이틀 입력<br>
                3. 서브 타이틀 입력<br>
                4. 설명문구 입력<br>
                5. 연결주소 [링크] #1 입력<br>
                6. 아이콘 이미지 #1 업로드<br>
                <div class='margin-hr-5'></div>
                아이콘 이미지 비율 45x45 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-shop020-m4-wrap-<?php echo $es_code; ?> {position:relative;overflow:hidden;height:55px}
.ebs-shop020-m4-wrap-<?php echo $es_code; ?> .slick-dotted.slick-slider {margin-bottom:0}
.ebs-shop020-m4-in {position:relative}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item {position:relative;outline:none;height:55px;border-bottom:1px solid #e5e5e5}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item:after {content:"";width:45px;height:1px;background-color:#151515;position:absolute;bottom:-1px;left:0}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .ebs-shop020-m4-img {position:absolute;top:0;left:0;width:45px;height:45px}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .ebs-shop020-m4-img img {display:block;max-width:100%;height:auto}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .ebs-shop020-m4-cont {position:relative;padding:0 200px 0 65px;text-align:left}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .ebs-shop020-m4-cont h5 {position:relative;overflow:hidden;height:22px;margin:0;color:#151515;font-size:1.0625rem;font-weight:700}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .ebs-shop020-m4-cont p {position:relative;overflow:hidden;height:20px;margin:5px 0 0;color:#757575;font-size:.875rem}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .btn-e {position:absolute;top:5px;right:5px;background-color:#1e293c;border-color:#1e293c}
.ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .btn-e span {margin-right:7px}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-dots {bottom:-15px;z-index:2}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-dots li {width:30px;height:2px}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-dots li button:before {content:"";color:#151515;font-size:0;line-height:0;width:30px;height:2px;background:#151515;opacity:0.45}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-dots li.slick-active button:before {opacity:0.85}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-next, .ebs-shop020-m4-in .ebs-shop020-m4 .slick-prev {opacity:0;width:50px;height:50px;top:50%;background:RGBA(0, 0, 0, 0.5);border-radius:50%;z-index:1;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-next {right:0}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-prev {left:0}
.ebs-shop020-m4-in .ebs-shop020-m4:hover .slick-next {right:10px;opacity:1}
.ebs-shop020-m4-in .ebs-shop020-m4:hover .slick-prev {left:10px;opacity:1}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-next:hover, .ebs-shop020-m4-in .ebs-shop020-m4 .slick-prev:hover {background:RGBA(0, 0, 0, 0.7)}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-next:before, .ebs-shop020-m4-in .ebs-shop020-m4 .slick-prev:before {content:"";display:block;position:absolute;top:50%;width:14px;height:14px;margin-top:-7px;-webkit-transform:rotate(45deg);transform:rotate(45deg);transition:all 0.3s linear}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-next:before {right:20px;border-right:1px solid #eee;border-top:1px solid #eee}
.ebs-shop020-m4-in .ebs-shop020-m4 .slick-prev:before {left:20px;border-left:1px solid #eee;border-bottom:1px solid #eee}
@media (max-width:767px) {
    .ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .btn-e {padding:8px 15px}
    .ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .btn-e span {display:none}
}
@media (max-width:576px) {
    .ebs-shop020-m4-in .ebs-shop020-m4 .ebs-shop020-m4-item .ebs-shop020-m4-cont {padding:0 50px}
}
</style>

<div class="ebs-shop020-m4-wrap-<?php echo $es_code; ?>">
    <?php if (is_array($slider)) { ?>
    <div class="ebs-shop020-m4-in">
        <div class="ebs-shop020-m4">
            <?php foreach ($slider as $k => $item) { ?>
            <div class="ebs-shop020-m4-item">
                <div class="ebs-shop020-m4-img">
                    <img src="<?php echo $item['src_1']?>" alt="">
                </div>
                <?php if ($item['ei_subtitle'] || $item['ei_title']) { ?>
                <div class="ebs-shop020-m4-cont">
                    <h5><?php echo $item['ei_title']?></h5>
                    <p><?php echo $item['ei_subtitle']?></p>
                </div>
                <?php } ?>
                <?php if ($item['href_1']) { ?>
                <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>" class="btn-e btn-e-lg btn-e-dark"><span>바로 가기</span><i class="fas fa-caret-right"></i></a>
                <?php } ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
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
    </div>
    <?php } ?>
    <?php if ($es_default) { ?>
    <div class="ebs-shop020-m4-in">
        <div class="ebs-shop020-m4">
            <div class="ebs-shop020-m4-item">
                <div class="ebs-shop020-m4-img">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/01.jpg" alt="">
                </div>
                <div class="ebs-shop020-m4-cont">
                    <h5>메인4 슬라이드 샘플 1</h5>
                    <p>Lorem Pharetra Parturient</p>
                </div>
                <a href="" class="btn-e btn-e-lg btn-e-dark"><span>바로 가기</span><i class="fas fa-caret-right"></i></a>
            </div>
            <div class="ebs-shop020-m4-item">
                <div class="ebs-shop020-m4-img">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/02.jpg" alt="">
                </div>
                <div class="ebs-shop020-m4-cont">
                    <h5>메인4 슬라이드 샘플 2</h5>
                    <p>Lorem Pharetra Parturient</p>
                </div>
                <a href="" class="btn-e btn-e-lg btn-e-dark"><span>바로 가기</span><i class="fas fa-caret-right"></i></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(document).ready(function() {
    $('.ebs-shop020-m4-wrap-<?php echo $es_code; ?> .ebs-shop020-m4').slick({
        slidesToShow: 1,
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false
                }
            }
        ]
    });
});
</script>
<?php } ?>