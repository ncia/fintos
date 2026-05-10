<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/item.info.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($default['de_rel_list_use']) { ?>
<?php /* ---------- 관련상품 시작 ---------- */ ?>
<section id="sit_rel">
    <h2>관련상품</h2>
    <?php echo $rel_list; ?>
</section>
<?php /* ---------- 관련상품 끝 ---------- */ ?>
<?php } ?>

<?php /* ---------- 상품 정보 시작 ---------- */ ?>
<section id="sit_inf">
    <h2 class="h-hidden">상품 정보</h2>
    <?php echo $shop->pg_anchor('sit_inf'); ?>


    <?php if ($it['it_explan']) { // 상품 상세설명 ?>
    <h3 class="h-hidden">상품 상세설명</h3>
    <div id="sit_inf_explan">
        <?php echo conv_content($it['it_explan'], 1); ?>
    </div>
    <?php } ?>

    <?php if ($it['it_info_use'] == 1) { ?>
    <?php if ($it['it_info_value'] && is_array($item_info)) { ?>
    <h3 class="h-hidden">상품 정보 고시</h3>
    <div class="table-list-eb item-info-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="width-180px">항목</th>
                    <th>내용</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ii_info as $key => $ii) { ?>
                <tr>
                    <th scope="row"><?php echo $ii['title']; ?></th>
                    <td><?php echo $ii['value']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } else if ($is_admin) { ?>
    <p>상품 정보 고시 정보가 올바르게 저장되지 않았습니다.<br>config.php 파일의 G5_ESCAPE_FUNCTION 설정을 addslashes 로<br>변경하신 후 관리자 &gt; 상품정보 수정에서 상품 정보를 다시 저장해주세요. </p>
    <?php } ?>
    <?php } ?>

</section>
<?php /* ---------- 상품 정보 끝 ---------- */ ?>

<?php if ($it['it_explan_example'] || (G5_IS_MOBILE && $it['it_mobile_explan_example']) || $default['de_baesong_content']) { ?>
<?php /* ---------- 가입예시 시작 ---------- */ ?>
<section id="sit_dvr">
    <h2 class="h-hidden">가입예시</h2>
    <?php echo $shop->pg_anchor('sit_dvr'); ?>

    <?php
    if (G5_IS_MOBILE && $it['it_mobile_explan_example']) echo conv_content($it['it_mobile_explan_example'], 1);
    else if ($it['it_explan_example']) echo conv_content($it['it_explan_example'], 1);
    else echo '<p>가입예시 입력전입니다.</p>';
    ?>
</section>
<?php /* ---------- 가입예시 끝 ---------- */ ?>
<?php } ?>

<?php /* ---------- 추천대상 시작 ---------- */ ?>
<section id="sit_qa">
    <h2 class="h-hidden">추천대상</h2>
    <?php echo $shop->pg_anchor('sit_qa'); ?>


    <?php if ($it['it_mobile_explan_recommend'] || $it['it_explan_recommend']) { ?>
    <div class="fintos-recommend-container">
        <?php
        if (G5_IS_MOBILE && $it['it_mobile_explan_recommend']) echo conv_content($it['it_mobile_explan_recommend'], 1);
        else if ($it['it_explan_recommend']) echo conv_content($it['it_explan_recommend'], 1);
        ?>
    </div>
    <?php } else { ?>
    <p class="m-t-20">추천대상 입력전입니다.</p>
    <?php } ?>

    <div id="itemqa"><?php include_once($shop_skin_path.'/itemqa.php'); ?></div>
</section>
<?php /* ---------- 추천대상 끝 ---------- */ ?>

<?php if ($it['it_explan_guide'] || (G5_IS_MOBILE && $it['it_mobile_explan_guide']) || $default['de_change_content']) { ?>
<?php /* ---------- 가입안내 시작 ---------- */ ?>
<section id="sit_ex">
    <h2 class="h-hidden">가입안내</h2>
    <?php echo $shop->pg_anchor('sit_ex'); ?>

    <?php if ($it['it_mobile_explan_guide'] || $it['it_explan_guide']) { ?>
    <div class="fintos-guide-container">
        <?php
        if (G5_IS_MOBILE && $it['it_mobile_explan_guide']) echo conv_content($it['it_mobile_explan_guide'], 1);
        else echo conv_content($it['it_explan_guide'], 1);
        ?>
    </div>
    <?php } else { ?>
    <p class="m-t-20">가입안내 입력전입니다.</p>
    <?php } ?>
</section>
<?php /* ---------- 가입안내 끝 ---------- */ ?>
<?php } ?>

<?php /* ---------- 상담후기 시작 ---------- */ ?>
<section id="sit_use">
    <h2 class="h-hidden">상담후기</h2>
    <?php echo $shop->pg_anchor('sit_use'); ?>

    <div id="itemuse"><?php include_once($shop_skin_path.'/itemuse.php'); ?></div>
</section>
<?php /* ---------- 상담후기 끝 ---------- */ ?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
$('.pg-anchor-in a').on('click', function(e) {
    e.stopPropagation();
    var scrollTopSpace;
    if (window.innerWidth >= 992) {
        scrollTopSpace = 90;
    } else {
        scrollTopSpace = 70;
    }
    var tabLink = $(this).attr('href');
    var offset = $(tabLink).offset().top;
    $('html, body').animate({scrollTop : offset - scrollTopSpace}, 500);
    return false;
});

$(window).on("load", function() {
    $("#sit_inf_explan").viewimageresize2();
});
</script>