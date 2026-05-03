<?php
/**
 * theme file : /theme/THEME_NAME/shop.tail.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if (!$wmode) { ?>
		<?php if(defined('_INDEX_')) { ?>
        </main>
        <?php } else { ?>
			</div><?php /* End .container */ ?>
		</main>
        <?php } ?>

	</div><?php /* End .basic-body */ ?>

	<?php /*----- footer 시작 -----*/ ?>
	<footer class="footer">
		<div class="footer-top">
			<div class="container">
				<div class="footer-nav-wrap">
					<div class="footer-nav">
						<a href="<?php echo get_eyoom_pretty_url('page','provision'); ?>">서비스이용약관</a>
						<a href="<?php echo get_eyoom_pretty_url('page','privacy'); ?>">개인정보처리방침</a>
						<a href="<?php echo get_eyoom_pretty_url('page','noemail'); ?>">이메일무단수집거부</a>
					</div>
					<div class="footer-right-nav">
						<a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a>
						<a href="<?php echo G5_URL; ?>/page/?pid=introduce">회사소개</a>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-cont-info">
			<div class="container">
				<div class="footer-cont-wrap">
					<div class="footer-cont-box">
						<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
						<div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-31px">
							<div class="btn-group">
								<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=biz&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 기업정보 설정</a>
								<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=biz&amp;thema=<?php echo $theme; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
									<i class="fas fa-external-link-alt"></i>
								</a>
								<button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-html="true" data-bs-content="
									<span class='f-s-13r'>
									<strong class='text-indigo'>기업정보 사용가능한 변수</strong><br>
									<div class='margin-hr-10'></div>
									<strong class='text-indigo'>[설정정보]</strong><br>
									회사명 : $bizinfo['bi_company_name']<br>
									사업자등록번호 : $bizinfo['bi_company_bizno']<br>
									대표자명 : $bizinfo['bi_company_ceo']<br>
									대표전화 : $bizinfo['bi_company_tel']<br>
									팩스번호 : $bizinfo['bi_company_fax']<br>
									통신판매업 : $bizinfo['bi_company_sellno']<br>
									부가통신사업자 : $bizinfo['bi_company_bugano']<br>
									정보관리책임자 : $bizinfo['bi_company_infoman']<br>
									정보책임자메일 : $bizinfo['bi_company_infomail']<br>
									우편번호 : $bizinfo['bi_company_zip']<br>
									주소1 : $bizinfo['bi_company_addr1']<br>
									주소2 : $bizinfo['bi_company_addr2']<br>
									주소3 : $bizinfo['bi_company_addr3']<br>
									고객센터1 : $bizinfo['bi_cs_tel1']<br>
									고객센터2 : $bizinfo['bi_cs_tel2']<br>
									고객센터팩스 : $bizinfo['bi_cs_fax']<br>
									고객센터메일 : $bizinfo['bi_cs_email']<br>
									상담시간 : $bizinfo['bi_cs_time']<br>
									휴무안내 : $bizinfo['bi_cs_closed']
									</span>
								"><i class="fas fa-question-circle"></i></button>
							</div>
						</div>
						<?php } ?>
						<div class="footer-text-logo">
							<?php echo $config['cf_title']; ?>
						</div>
						<p>
							<span><?php echo $bizinfo['bi_company_name']; ?></span>
							<span class="footer-divider">|</span>
							<span>대표 : <?php echo $bizinfo['bi_company_ceo']; ?></span>
						</p>
						<p>사업자등록번호 : <?php echo $bizinfo['bi_company_bizno']; ?></p>
						<p>통신판매업 : <?php echo $bizinfo['bi_company_sellno']; ?></p>
						<p>주소 : <?php echo $bizinfo['bi_company_zip']; ?> <?php echo $bizinfo['bi_company_addr1']; ?> <?php echo $bizinfo['bi_company_addr2']; ?> <?php echo $bizinfo['bi_company_addr3']; ?></p>
						<p>
							<span>TEL : <?php echo $bizinfo['bi_cs_tel1']; ?></span>
							<?php if($bizinfo['bi_company_fax']) { ?>
							<span class="footer-divider">|</span>
							<span>FAX : <?php echo $bizinfo['bi_company_fax']; ?></span>
							<?php } ?>
						</p>
						<p>E-mail : <a href="mailto:<?php echo $bizinfo['bi_cs_email']; ?>"><?php echo $bizinfo['bi_cs_email']; ?></a></p>
					</div>
					<div class="footer-cont-box">
						<h5>사이트 이용문의</h5>
						<p>상담시간 : <?php echo $bizinfo['bi_cs_time']; ?></p>
						<p>휴일안내 : <?php echo $bizinfo['bi_cs_closed']; ?></p>
						<p class="footer-tel-num"><strong>T. <?php echo $bizinfo['bi_cs_tel1']; ?></strong></p>
						<?php if($default['de_bank_account']) { ?>
						<h5>입금계좌 안내</h5>
						<div class="footer-bank-account">
							<?php echo get_text($default['de_bank_account'], 1); ?>
						</div>
						<?php } ?>
					</div>
					<div class="footer-cont-box">
						<?php /* EB최신글 - shop020_footer */ ?>
						<?php echo eb_latest('1652605393'); ?>
						
						<div class="footer-btn-box">
							<?php /* EB콘텐츠 - shop020_sns_link */ ?>
							<?php echo eb_contents('1652605585'); ?>
							
							<a href="<?php echo G5_BBS_URL; ?>/qalist.php" class="btn-e btn-e-gray btn-e-brd btn-e-lg">1:1 문의하기</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-copyright">
			<span>Copyright </span>&copy; <strong><?php echo $config['cf_title']; ?></strong>. All Rights Reserved.
		</div>
	</footer>
	<?php /*----- footer 끝 -----*/ ?>
</div>
<?php /*----- wrapper 끝 -----*/ ?>





<?php /*----- 전체 검색 입력창 시작 -----*/ ?>
<div class="search-full">
	<div class="search-close-btn"></div>
	<fieldset class="search-field">
		<legend>쇼핑몰 전체검색</legend>
		<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
		<input type="hidden" name="sfl" value="wr_subject||wr_content">
		<input type="hidden" name="sop" value="and">
		<label for="mobile_search_input" class="sound_only">검색어 입력 필수</strong></label>
		<input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="mobile_search_input" class="sch_stx" placeholder="상품 검색어 입력">
		<button type="submit" class="search-btn" value="검색"><i class="fas fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
		</form>

		<script>
		function search_submit(f) {
			if (f.q.value.length < 2) {
				alert("검색어는 두글자 이상 입력하십시오.");
				f.q.select();
				f.q.focus();
				return false;
			}
			return true;
		}
		</script>
	</fieldset>
</div>
<?php /*----- 전체 검색 입력창 끝 -----*/ ?>

<?php /*----- 쇼핑몰 회원 사이드바 시작 -----*/ ?>
<button type="button" class="sidebar-shop-trigger sidebar-shop-member-btn mo-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasShopRight" aria-controls="offcanvasShopRight"><i class="fas fa-shopping-cart"></i></button>
<div class="sidebar-shop-member-wrap">
    <button type="button" class="sidebar-shop-trigger sidebar-shop-member-btn pc-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasShopRight" aria-controls="offcanvasShopRight"><i class="fas fa-shopping-cart"></i><span class="direction-icon"><i class="fas fa-outdent"></i></span></button>
    <div class="sidebar-shop-member offcanvas offcanvas-end" tabindex="-1" id="offcanvasShopRight" aria-labelledby="offcanvasShopRightLabel">
		<div class="offcanvas-header">
            <h5 class="offcanvas-title f-s-17r f-w-600" id="offcanvasShopRightLabel"><i class="fas fa-boxes text-gray m-r-7"></i>나의 쇼핑 정보</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="sidebar-shop-member-in">
            <?php /* 아웃로그인 시작 */ ?>
            <div class="shop-member-box">
                <div class="shop-member-box-title">오늘본상품<span class="badge badge-crimson rounded"><?php echo get_view_today_items_count(); ?></span></div>
                <?php include(EYOOM_THEME_SHOP_SKIN_PATH.'/boxtodayview.skin.html.php'); // 오늘 본 상품 ?>
                <div class="shop-member-box-title">장바구니<span class="badge badge-crimson rounded"><?php echo get_boxcart_datas_count(); ?></span></div>
                <?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxcart.skin.html.php'); // 장바구니 ?>
                <div class="shop-member-box-title">관심상품<span class="badge badge-crimson rounded"><?php echo get_wishlist_datas_count(); ?></span></div>
                <?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxwish.skin.html.php'); // 관심상품 ?>
            </div>

            <?php /* 투표 시작 */ ?>
            <?php if ( $eyoom['use_gnu_poll'] == 'y' ) { //그누보드 스킨일 경우 ?>
                <?php echo poll('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
                <?php echo eb_poll($eyoom['poll_skin']); ?>
            <?php } ?>
            <?php /* 투표 끝 */ ?>
        </div>
    </div>
</div>
<?php /*----- 쇼핑몰 회원 사이드바 끝 -----*/ ?>

<?php /* 상담 신청 버튼 */ ?>
<?php if ($config['cf_use_counsel'] == '1') { ?>
<a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="counsel_modal();"<?php } else { ?>href="<?php echo G5_URL; ?>/page/?pid=counsel"<?php } ?> class="counsel-btn"><i class="fas fa-headset"></i><span class="sound-only">상담신청</span></a>
<?php } ?>

<?php /* Side Nav Mobile Toggler */ ?>
<button type="button" class="navbar-mobile-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft"><i class="fas fa-bars"></i></button>

<?php /* Back To Top */ ?>
<div class="eb-backtotop">
	<svg class="backtotop-progress" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
		<span class="progress-count"></span>
	</svg>
</div>
<?php } // !$wmode ?>

<form name="fitem_for_list" method="post" action="" onsubmit="return fitem_for_list_submit(this);">
<input type="hidden" name="url">
<input type="hidden" name="it_id">
</form>

<?php
include_once(EYOOM_THEME_PATH . '/misc.html.php');
?>

<?php
if ($is_member && $eyoomer['onoff_push'] == 'on') {
    include_once(EYOOM_THEME_PATH . '/skin/push/basic/push.skin.html.php');
}
?>

<script src="<?php echo EYOOM_THEME_URL; ?>/js/shop_app.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script>
/* 네브바 모바일 및 아코디언 메뉴 스크립트 */
$(document).ready(function() {
    $('.navbar-nav .dropdown-toggle, .navbar-nav .dorpdown-toggle, .navbar-nav .cate-dropdown-open').removeAttr('data-bs-toggle');

    $('.navbar-nav .dropdown > a, .navbar-nav .dropdown > .cate-dropdown-open').on('click', function(e) {
        var $el = $(this);
        var $parent = $el.parent('.dropdown');
        var $menu = $parent.children('.dropdown-menu');
        
        if ($menu.length > 0) {
            e.preventDefault();
            if ($menu.is(':visible')) {
                $menu.slideUp(250);
                $parent.removeClass('show');
                $parent.find('> .cate-dropdown-open').removeClass('show');
                $parent.find('> a i.fa-angle-up, > a i.fa-angle-down').removeClass('fa-angle-up').addClass('fa-angle-down');
            } else {
                $parent.siblings('.dropdown').children('.dropdown-menu').slideUp(250);
                $parent.siblings('.dropdown').removeClass('show');
                $parent.siblings('.dropdown').find('> .cate-dropdown-open').removeClass('show');
                $parent.siblings('.dropdown').find('> a i.fa-angle-up, > a i.fa-angle-down').removeClass('fa-angle-up').addClass('fa-angle-down');
                $menu.slideDown(250);
                $parent.addClass('show');
                $parent.find('> .cate-dropdown-open').addClass('show');
                $parent.find('> a i.fa-angle-down, > a i.fa-angle-up').removeClass('fa-angle-down').addClass('fa-angle-up');
            }
        }
    });

    $('.navbar-nav .dropdown-submenu > a').on('click', function(e) {
        var $parent = $(this).parent('.dropdown-submenu');
        var $menu = $parent.children('.dropdown-menu');
        
        if ($menu.length > 0) {
            e.preventDefault();
            e.stopPropagation();
            if ($menu.is(':visible')) {
                $menu.slideUp(250);
                $parent.removeClass('show');
                $parent.find('> .cate-dropdown-open').removeClass('show');
                $parent.find('> a i.fa-angle-up, > a i.fa-angle-down').removeClass('fa-angle-up').addClass('fa-angle-down');
            } else {
                $parent.siblings('.dropdown-submenu').children('.dropdown-menu').slideUp(250);
                $parent.siblings('.dropdown-submenu').removeClass('show');
                $parent.siblings('.dropdown-submenu').find('> .cate-dropdown-open').removeClass('show');
                $parent.siblings('.dropdown-submenu').find('> a i.fa-angle-up, > a i.fa-angle-down').removeClass('fa-angle-up').addClass('fa-angle-down');
                $menu.slideDown(250);
                $parent.addClass('show');
                $parent.find('> .cate-dropdown-open').addClass('show');
                $parent.find('> a i.fa-angle-down, > a i.fa-angle-up').removeClass('fa-angle-down').addClass('fa-angle-up');
            }
        }
    });
});

function item_wish_for_list(it_id) {
    var f = document.fitem_for_list;
    f.url.value = "<?php echo G5_SHOP_URL; ?>/wishupdate.php?it_id="+it_id;
    f.it_id.value = it_id;
    f.action = "<?php echo G5_SHOP_URL; ?>/wishupdate.php";
    f.submit();
}

<?php if ($is_admin == 'super') { ?>
$(document).ready(function() {
    var edit_mode = "<?php echo $eyoom_default['edit_mode']; ?>";
    if (edit_mode == 'on') {
        $(".btn-edit-mode").show();
    } else {
        $(".btn-edit-mode").hide();
    }

    $("#btn_edit_mode").click(function() {
        var edit_mode = $("#edit_mode").val();
        if (edit_mode == 'on') {
            $(".btn-edit-mode").hide();
            $("#edit_mode").val('');
        } else {
            $(".btn-edit-mode").show();
            $("#edit_mode").val('on');
        }

        $.post("<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=theme_editmode&smode=1", { edit_mode: edit_mode });
    });
});
<?php } ?>
</script>

<?php if ($is_darkmode == 'yes') { ?>
<script>
<?php /* 다크모드 JS 시작 */ ?>
const darkModeBtn = document.querySelector(".dark-mode-btn");
const currentMode = localStorage.getItem("mode");

if (currentMode == "dark") {
	document.body.classList.toggle("dark-mode");
	<?php if($editor_html && preg_match('/ckeditor/i', $config['cf_editor'])) { ?>
	CKEDITOR.on('instanceReady', function(e) {
		e.editor.document.getBody().setStyle('background-color', '#000');
		e.editor.document.getBody().setStyle('color', '#858585');
	});
	<?php } ?>
	<?php if($editor_html && preg_match('/smarteditor2/i', $config['cf_editor'])) { ?>
	$(document).ready(function() {
		$('.smarteditor2').next().attr('class', 'se2_iframe');
		$(".se2_iframe").on("load", function() {
			var iframeHead = $('.se2_iframe').contents().find('head');
			iframeHead.find('#se2_eyoom_css').attr('href', 'css/smart_editor2_eyoom_dark.css');
			iframeHead.find('#se2_eyoom_css').attr('class', 'se2_eyoom_dark_css');
		});
	});
	<?php } ?>
}

darkModeBtn.addEventListener("click", function() {
	document.body.classList.toggle("dark-mode");
	let mode = "light";
	let cssLink = document.getElementById("mode_css");
	if (document.body.classList.contains("dark-mode")) {
		mode = "dark";
		cssLink.href = "<?php echo EYOOM_THEME_URL; ?>/css/dark_mode.css?ver=<?php echo G5_CSS_VER; ?>";
		darkModeBtn.innerHTML = "<i class='fas fa-sun text-amber'></i><span>라이트모드</span>";
	} else {
		cssLink.href = "<?php echo EYOOM_THEME_URL; ?>/css/light_mode.css?ver=<?php echo G5_CSS_VER; ?>";
		darkModeBtn.innerHTML = "<i class='fas fa-moon'></i><span>다크모드</span>";
	}
	localStorage.setItem("mode", mode);
	set_cookie('mode', mode, 8760);
});
<?php /* 다크모드 JS 끝 */ ?>
</script>
<?php } ?>