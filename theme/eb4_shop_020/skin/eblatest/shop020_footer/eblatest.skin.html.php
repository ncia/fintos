<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/shop020_footer/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($el_master['el_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB최신글 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($el_master) && $el_master['el_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.shop020-lf {position:relative;font-size:.9375rem}
.shop020-lf .shop020-lf-title {font-size:1.0625rem;font-weight:700;color:#757575;margin:0 0 15px}
.shop020-lf .shop020-lf-title a {color:#757575}
.shop020-lf ul {margin:0}
.shop020-lf li {position:relative;padding:0}
.shop020-lf li:after {content:"";display:block;clear:both}
.shop020-lf .lf-subj {position:relative;width:70%;padding-right:10px;padding-left:0;display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;float:left;color:#757575}
.shop020-lf .lf-new-icon {position:relative;display:inline-block;width:18px;height:14px;background-color:#cc2300;margin-right:2px}
.shop020-lf .lf-new-icon:before {content:"";position:absolute;top:4px;left:5px;width:2px;height:6px;background-color:#fff}
.shop020-lf .lf-new-icon:after {content:"";position:absolute;top:4px;right:5px;width:2px;height:6px;background-color:#fff}
.shop020-lf .lf-new-icon b {position:absolute;top:3px;left:8px;width:2px;height:8px;background-color:#fff;transform:rotate(-60deg)}
.shop020-lf .lf-date {position:relative;display:block;white-space:nowrap;word-wrap:normal;overflow:hidden;width:30%;float:left;text-align:right;color:#757575}
.shop020-lf a:hover .lf-subj {text-decoration:underline}
</style>

<div class="shop020-lf">
    <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
    <h5 class="shop020-lf-title">
        <?php if ($eb_latest['li_link']) { ?>
        <a href="<?php echo $eb_latest['li_link']; ?>" target="<?php echo $eb_latest['el_target']; ?>"><?php echo $eb_latest['li_title']; ?></a>
        <?php } else { ?>
        <?php echo $eb_latest['li_title']; ?>
        <?php } ?>
    </h5>
    <ul class="list-unstyled">
        <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $data) { ?>
        <li>
            <a href="<?php echo $data['href']; ?>">
                <div class="lf-subj">
                    <?php if ($data['new']) { ?>
                    <span class="lf-new-icon"><b></b></span>
                    <?php } ?>
                    <?php echo $data['wr_subject']; ?>
                </div>
                <?php if ($eb_latest['li_use_date'] == 'y') { ?>
                <div class="lf-date"><i class="far fa-clock m-r-5"></i><?php echo $eb_latest['li_date_type'] == '1' ? $eb->date_time("{$eb_latest['li_date_kind']}",$data['wr_datetime']):  $eb->date_format("{$eb_latest['li_date_kind']}",$data['wr_datetime']); ?></div>
                <?php } ?>
                <div class="clearfix"></div>
            </a>
        </li>
        <?php }} else { ?>
        <li class="text-center m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</li>
        <?php } ?>
    </ul>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;li_no=<?php echo $eb_latest['li_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn"><i class="far fa-edit"></i> EB최신글 아이템 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;li_no=<?php echo $eb_latest['li_no']; ?>&amp;w=u&amp;iw=u&amp" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <?php } ?>
    <?php }} ?>

    <?php if ($el_default) { ?>
    <p class="text-center m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
    <?php } ?>
</div>
<?php } ?>