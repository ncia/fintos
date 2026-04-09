<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop020_top_banner/ebslider.skin.html.php
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
                1. 슬라이더마스터 제목 : shop020_top_banner<br>
                2. 슬라이더마스터 스킨 : shop020_top_banner<br>
                3. EB슬라이더 아이템 링크수 : 1개<br>
                <span class='text-indigo'>[EB 슬라이더 - 아이템 관리]</span><br>
                1. EB슬라이더 아이템 추가 클릭<br>
                2. 대표 타이틀 입력<br>
                3. 서브 타이틀 입력 (해당 영역의 배경색으로 적용, 색상 CSS HEX 값 입력, 예)#000000)<br>
                4. 연결주소 [링크] #1 입력
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-shop020-tb-wrap {position:relative;overflow:hidden}
.ebs-shop020-tb {position:relative;overflow:hidden}
.ebs-shop020-tb .ebs-shop020-tb-item {position:relative;outline:none;background-color:#2d343d}
.ebs-shop020-tb .ebs-shop020-tb-item .ebs-shop020-tb-title {text-align:center;padding:8px 0}
.ebs-shop020-tb .ebs-shop020-tb-item .ebs-shop020-tb-title h5 {margin:0;color:#fff;font-size:.9375rem}
.ebs-shop020-tb .ebs-shop020-tb-item .ebs-shop020-tb-title .btn-e {margin-left:15px;border-color:#959595;color:#d5d5d5 !important}
.ebs-shop020-tb-wrap .shop020-tb-close {position:absolute;top:13px;right:15px}
.ebs-shop020-tb-wrap #check_close {visibility:hidden;opacity:0;height:0}
</style>

<div class="ebs-shop020-tb-wrap">
    <div class="ebs-shop020-tb">
    <?php if (is_array($slider)) { ?>
        <?php foreach ($slider as $k => $item) { ?>
        <div class="ebs-shop020-tb-item">
            <div style="background-color:<?php echo $item['ei_subtitle']?> !important">
                <div class="container">
                    <div class="ebs-shop020-tb-title">
                        <h5>
                            <?php echo $item['ei_title']?>
                            <?php if ($item['href_1']) { ?>
                            <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>" class="btn-e btn-e-xs btn-e-brd btn-e-gray">바로가기<i class="fas fa-angle-right m-l-5"></i></a>
                            <?php } ?>
                        </h5>
                    </div>
                </div>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&ei_no=<?php echo $item['ei_no']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn"><i class="far fa-edit"></i> EB슬라이더 아이템 설정</a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    <?php } ?>
    </div>
    <?php if ($es_default) { ?>
    <div class="ebs-shop020-tb">
        <div class="ebs-shop020-tb-item">
            <div class="container">
                <div class="ebs-shop020-tb-title">
                    <h5>EB슬라이더 shop020 TOP BANNER<a href="" class="btn-e btn-e-xs btn-e-brd btn-e-gray">바로가기<i class="fas fa-angle-right m-l-5"></i></a></h5>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$('.ebs-shop020-tb-wrap .ebs-shop020-tb').slick({
    slidesToShow: 1,
    arrows: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 5000,
    fade: true
});
</script>
<?php } ?>