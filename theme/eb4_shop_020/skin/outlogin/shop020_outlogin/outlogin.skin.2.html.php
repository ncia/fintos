<?php
/**
 * skin file : /theme/THEME_NAME/skin/outlogin/shop019_outlogin/outlogin.skin.2.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.ol-after {position:relative;display:block;background-color:#fff;border:1px solid #e5e5e5;border-radius:3px;box-shadow: 0 0 4px rgba(0,0,0,0.15)}
.ol-after .profile {position:relative;border-bottom:1px solid #e5e5e5}
.ol-after .profile .cover {position:relative;overflow:hidden;width:100%;height:150px}
.ol-after .profile .photo {position:absolute;overflow:hidden;top:15px;left:50%;margin-left:-35px;z-index:7;width:70px;height:70px;line-height:70px;text-align:center;background-color:#959595;border-radius:50%}
.ol-after .profile .photo img {display:block;max-width:100%;height:auto}
.ol-after .profile .photo .member-img i {color:#fff;font-size:36px;line-height:66px}
.ol-after .profile .info {position:absolute;bottom:10px;left:0;width:100%;text-align:center;z-index:7}
.ol-after .profile .info .name {color:#353535;font-size:1.125rem}
.ol-after .profile .info .name .level-icon {display:inline-block;margin-left:3px}
.ol-after .profile .info .position {color:#959595;font-size:.8125rem}
.ol-after .member-info-wrap {position:relative}
.ol-after .member-info-wrap.community-no {margin-top:25px}
.ol-after .member-info-wrap .member-info {position:relative;padding:20px}
.ol-after .member-info-wrap.community-no .member-info {border:1px solid #e5e5e5}
.ol-after .member-info-btn {position:relative}
.ol-after .member-info-btn .info-btn {display:inline-block;width:52px;height:48px;padding:6px 0;background:#656565;color:#fff;text-align:center;-webkit-transition:all 0.2s ease;-moz-transition:all 0.2s ease;transition:all 0.2s ease}
.ol-after .member-info-btn .info-btn:hover {opacity:0.8}
.ol-after .member-info-btn .info-btn i {font-size:.9375rem;line-height:1.4}
.ol-after .member-info-btn .info-btn span {display:block;line-height:1;font-size:.6875rem}
.ol-after .member-info-btn .info-btn strong {font-weight:400;font-size:.6875rem}
.ol-after .member-info-btn .info-btn.others-btn {padding:0;line-height:48px;font-size:.6875rem;background:#a5a5a5}
.ol-after .member-info-btn .info-btn .alarm-marker .alarm-point {left:inherit;top:-4px;right:3px}
.ol-after .member-info-btn .info-btn .alarm-marker .alarm-effect {left:inherit;top:-14px;right:-7px}
.ol-after .member-info-btn .mypage-btn {background-color:#2d343d;border-color:#2d343d}
.ol-after .member-info-btn .mypage-btn:hover {background-color:#363f4b;border-color:#363f4b}
.ol-after .member-point {margin:10px 0}
.ol-after .member-follow {border-top:1px dotted #e5e5e5;padding-top:10px;margin-top:15px}
.ol-after .member-follow p {padding:3px 0}
.ol-after .member-follow span.badge {padding:4px 10px;min-width:80px;text-align:right}
.ol-after .member-btn {border-bottom:1px solid #eee;margin-bottom:10px;padding-bottom:10px}
.ol-after .member-btn a {margin-top:2px;margin-bottom:2px;width:23%;text-align:center}
.ol-after .member-btn span {width:4px}
.ol-after .member-txt-info a {color:#000}
.ol-after .member-txt-info a:hover {text-decoration:underline}
.scrap-iframe-modal .modal-body {padding:0}
</style>

<div class="ol-after clearfix">
    <div class="profile">
        <div class="cover"></div>
        <div class="photo">
            <a href="#" class="member-img" data-bs-toggle="modal" data-bs-target=".profile-modal"><?php if ( $profile_photo ) { echo $profile_photo; } else {?><span class="ol-user-icon"><i class="fas fa-user-alt"></i></span><?php } ?></a>
        </div>
        <div class="info">
            <div class="name">
                <?php echo $nick; ?>
                <?php if ($eyoom_level['gnu_icon']) { ?>
                <span class="level-icon"><img src="<?php echo $eyoom_level['gnu_icon']; ?>" align="absmiddle" alt="레벨"></span>
                <?php } ?>
                <?php if ($eyoom_level['eyoom_icon']) { ?>
                <span class="level-icon"><img src="<?php echo $eyoom_level['eyoom_icon']; ?>" align="absmiddle" alt="레벨"></span>
                <?php } ?>
            </div>
            <div class="position"><?php if ($is_admin || $is_auth) { ?>관리자 <?php echo $lvinfo['name']; ?><?php } else { ?><?php echo $lvinfo['name']; ?><?php } ?></div>
        </div>
    </div>

    <div class="member-info-wrap">
        <div class="member-info">
            <div class="member-info-btn">
                <div class="widht-70 float-start">
                    <div class="member-txt-point">
                        <p><?php echo $levelset['gnu_name']; ?> - <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="point_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank"<?php } ?>><u class="text-crimson"><?php echo $point; ?></u></a></p>
                    </div>
                    <div class="member-txt-info m-t-4">
                        <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">회원정보수정</a>
                    </div>
                </div>
                <div class="widht-30 float-end">
                    <a href="<?php echo G5_BBS_URL; ?>/logout.php" class="info-btn others-btn">로그아웃</a>
                </div>
                <div class="clearfix"></div>
                <a href="<?php echo G5_SHOP_URL; ?>/mypage.php" class="mypage-btn btn-e btn-e-lg btn-e-dark btn-e-block m-t-20">마이페이지</a>
                <?php if ($is_admin == 'super' || $is_auth) { ?>
                <a href="<?php echo G5_ADMIN_URL; ?>" class="btn-e btn-e-lg btn-e-gray btn-e-block m-t-20">관리자</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>