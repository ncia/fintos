<?php
/**
 * theme file : /theme/THEME_NAME/head.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 로고 타입 : 'image' || 'text'
 */
$logo = 'image';

/**
  * 다크모드 사용 : 'yes' || 'no'
  */
$is_darkmode = 'yes';

/**
 * 상품 이미지 미리보기 종류 : 'zoom' || 'slider'
 */
$item_view = 'zoom';
?>

<?php if (!$wmode) { ?>
<?php /*----- wrapper 시작 -----*/ ?>
<div class="wrapper">
    <h1 id="hd-h1"><?php echo $g5['title'] ?></h1>
    <div class="to-content"><a href="#container">본문 바로가기</a></div>
    <?php
    // 팝업창
    if (defined('_INDEX_') && $newwin_contents) { // index에서만 실행
        echo $newwin_contents;
    }
    ?>

    <?php /*----- header 시작 -----*/ ?>
    <header class="header-wrap <?php if(!defined('_INDEX_')) { ?>page-header-wrap<?php } ?>">
        <?php /* EB슬라이더 - shop020_top_banner */ ?>
        <?php echo eb_slider('1650710257'); ?>
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="top-header-mobile-btn">
                        <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft">
                            <span class="sr-only">메뉴 버튼</span>
                            <span class="fas fa-bars"></span>
                        </button>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <ul class="top-header-nav list-unstyled thn-start">
                            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
                            <?php if ($is_admin) { // 관리자일 경우 ?>
                            <li>
                                <div class="eyoom-form">
                                    <input type="hidden" name="edit_mode" id="edit_mode" value="<?php echo $eyoom_default['edit_mode']; ?>">
                                    <label class="toggle">
                                        <input type="checkbox" id="btn_edit_mode" <?php echo $eyoom_default['edit_mode'] == 'on' ? 'checked':''; ?>><i></i><span><span class="fas fa-sliders-h m-r-5"></span>편집모드</span>
                                    </label>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-lg-6 clearfix">
                        <ul class="top-header-nav list-unstyled thn-end">
                            <?php if ($is_member) {  ?>
                                <?php if ($is_admin) {  ?>
                            <li><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li>
                                <?php }  ?>
                            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                            <?php } else {  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                            <li class="visible-xs visible-sm"><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                            <?php }  ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    추가메뉴
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="d-block d-lg-none">장바구니</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php" class="d-block d-lg-none">위시리스트</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문/배송조회</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a>
                                    <?php if ($is_member) { // 회원일 경우 ?>
                                    <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">회원정보수정</a>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-title">
            <div class="container position-relative">
                <?php /* ----- 사이트 로고 시작 ----- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:left;margin-left:12px">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=logo&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 로고 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=logo&amp;thema=<?php echo $theme; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                <a href="<?php echo G5_URL; ?>" class="title-logo">
                <?php if ($logo == 'text') { ?>
                    <h1><?php echo $config['cf_title']; ?></h1>
                <?php } else if ($logo == 'image') { ?>
                    <?php if (!G5_IS_MOBILE) { ?>
                    <?php if (file_exists($top_logo) && !is_dir($top_logo)) { ?>
                    <img src="<?php echo $logo_src['top']; ?>" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } else { ?>
                    <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.svg" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } ?>
                    <?php } else { ?>
                    <?php if (file_exists($top_mobile_logo) && !is_dir($top_mobile_logo)) { ?>
                    <img src="<?php echo $logo_src['mobile_top']; ?>" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } else { ?>
                    <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.svg" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
                </a>
                <?php /* ----- 사이트 로고 끝 ----- */ ?>
                
                <div class="header-title-search d-none d-lg-block">
                    <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);" class="eyoom-form">
                    <input type="hidden" name="sfl" value="wr_subject||wr_content">
                    <input type="hidden" name="sop" value="and">
                    <label for="search_input" class="sound_only">검색어 입력 필수</strong></label>
                    <div class="input input-button">
                        <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="search_input" class="sch_stx" placeholder="상품 검색어 입력">
                        <div class="button"><input type="submit"><i class="fas fa-search"></i></div>
                    </div>
                    </form>
                </div>
                
                <div class="header-title-btn-wrap d-none d-lg-block">
                    <?php if ($is_member) {  ?>
                    <div class="header-title-btn btn-group">
                        <a href="#" class="dropdown-toggle"  id="dropdownMemberButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/main/person.svg" alt="image">
                            <h6><?php echo cut_str(get_text($member['mb_nick']), 5, ''); ?><span class="text-gray">님</span></h6>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <?php /* 아웃로그인 */ ?>
                            <?php echo eb_outlogin($eyoom['outlogin_skin']); ?>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="header-title-btn btn-group">
                        <a href="#" class="dropdown-toggle"  id="dropdownLoginButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/main/person.svg" alt="image">
                            <h6>로그인</h6>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLoginButton">
                            <?php /* 아웃로그인 */ ?>
                            <?php echo eb_outlogin($eyoom['outlogin_skin']); ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="header-title-btn">
                        <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">
                            <span class="badge badge-gray rounded"><?php echo get_wishlist_datas_count(); ?></span>
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/main/heart.svg" alt="image">
                            <h6>위시리스트</h6>
                        </a>
                    </div>
                    <div class="header-title-btn">
                        <a href="<?php echo G5_SHOP_URL; ?>/cart.php">
                            <span class="badge badge-gray rounded"><?php echo get_boxcart_datas_count(); ?></span>
                            <img src="<?php echo EYOOM_THEME_URL; ?>/image/main/cart.svg" alt="image">
                            <h6>장바구니</h6>
                        </a>
                    </div>
                </div>
        
                <div class="header-title-mobile-btn">
                    <button type="button" class="navbar-toggler search-toggle mobile-search-btn">
                        <span class="sr-only">검색 버튼</span>
                        <span class="fas fa-search"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="header-nav nav-wrap">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="sidebar-left offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-controls="offcanvasLeftLabel">
                        <div class="sidebar-left-content">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title f-s-16r" id="offcanvasLeftLabel"><i class="fas fa-bars m-r-10 text-gray"></i>NAVIGATION</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <?php /* ---------- 모바일용 컨텐츠 시작 // 991픽셀 이하에서만 출력 ---------- */ ?>
                            <div class="sidebar-member-menu">
                                <?php if ($eyoom['use_shop_index'] == 'n') { ?>
                                <a href="<?php echo G5_URL; ?>" class="btn-e btn-e-md btn-e-crimson btn-e-block m-t-10 m-b-10">
                                    커뮤니티<i class="far fa-caret-square-right m-l-5"></i>
                                </a>
                                <?php } ?>
                                <div class="m-t-10 m-b-10">
                                    <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="sidebar-member-btn-box">
                                        <div class="sidebar-member-btn">
                                            장바구니
                                        </div>
                                    </a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php" class="sidebar-member-btn-box">
                                        <div class="sidebar-member-btn float-end">
                                            위시리스트
                                        </div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="m-t-10 m-b-10">
                                    <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="sidebar-member-btn-box">
                                        <div class="sidebar-member-btn">
                                            주문/배송조회
                                        </div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php /* ---------- 모바일용 컨텐츠 끝 ---------- */ ?>
                            <ul class="navbar-nav">
                                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                                <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
                                    <div class="btn-group">
                                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_list&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 메뉴 설정</a>
                                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_list&amp;thema=<?php echo $theme; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                                <li id="nav_category" class="nav-category dropdown">
                                    <a href="#" class="nav-category-link"><i class="fas fa-bars nav-icon-pre m-r-20 hidden-xs hidden-sm"></i>CATEGORY</a>
                                    <ul class="dropdown-menu">
                                        <?php if (isset($menu) && is_array($menu)) { ?>
                                        <?php foreach ($menu as $key => $menu_1) { ?>
                                        <li class="item-vertical <?php if (isset($menu_1['active']) && $menu_1['active']) echo 'active'; ?> <?php if (isset($menu_1['submenu']) && $menu_1['submenu']) echo 'dropdown'; ?>">
                                            <a href="<?php echo $menu_1['me_link']; ?>" target="_<?php echo $menu_1['me_target']; ?>" class="dropdown-toggle disabled">
                                                <?php if ($menu_1['me_icon']) { ?><i class="<?php echo $menu_1['me_icon']; ?> nav-cate-icon margin-right-5"></i><?php } ?>
                                                <?php echo $menu_1['me_name']?>
                                            </a>
                                            <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { ?>
                                            <a href="#" class="cate-dropdown-open hidden-lg hidden-md" data-bs-toggle="dropdown"></a>
                                            <?php } ?>
                                            <?php $index2 = $size2 = 0; ?>
                                            <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { $size2 = count($menu_1['submenu']); ?>
                                            <?php foreach ($menu_1['submenu'] as $subkey => $menu_2) { ?>
                                            <?php if ($index2 == 0) { ?>
                                            <ul class="dropdown-menu">
                                            <?php } ?>
                                                <li class="dropdown-submenu <?php if (isset($menu_2['active']) && $menu_2['active']) echo 'active';?>">
                                                    <a href="<?php echo $menu_2['me_link']; ?>" target="_<?php echo $menu_2['me_target']; ?>">
                                                        <?php if (isset($menu_2['me_icon']) && $menu_2['me_icon']) { ?>
                                                        <i class="<?php echo $menu_2['me_icon']; ?> margin-right-5"></i>
                                                        <?php } ?>
                                                        <?php echo $menu_2['me_name']; ?>
                                                        <?php if ($menu_2['new']) { ?>
                                                        <i class="far fa-check-circle text-crimson m-l-5"></i>
                                                        <?php } ?>
                                                        <?php if (isset($menu_2['sub']) && $menu_2['sub'] == 'on') { ?>
                                                        <i class="fas fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fas fa-angle-down sub-caret hidden-md hidden-lg"></i>
                                                        <?php } ?>
                                                    </a>
                                                    <?php $index3 = $size3 = 0; ?>
                                                    <?php if (isset($menu_2['subsub']) && is_array($menu_2['subsub'])) { $size3 = count($menu_2['subsub']); ?>
                                                    <?php foreach ($menu_2['subsub'] as $ssubkey => $menu_3) { ?>
                                                    <?php if ($index3 == 0) { ?>
                                                    <ul class="dropdown-menu">
                                                    <?php } ?>
                                                        <li class="dropdown-submenu <?php if (isset($menu_3['active']) && $menu_3['active']) echo 'active';?>">
                                                            <a href="<?php echo $menu_3['me_link']; ?>" target="_<?php echo $menu_3['me_target']; ?>">
                                                                <span class="submenu-marker"></span>
                                                                <?php if (isset($menu_3['me_icon']) && $menu_3['me_icon']) { ?>
                                                                <i class="<?php echo $menu_3['me_icon']; ?> margin-right-5"></i>
                                                                <?php } ?>
                                                                <?php echo $menu_3['me_name']; ?>
                                                                <?php if ($menu_3['new']) { ?>
                                                                <i class="far fa-check-circle text-crimson m-l-5"></i>
                                                                <?php } ?>
                                                                <?php if (isset($menu_3['sub']) && $menu_3['sub'] == 'on') { ?>
                                                                <i class="fas fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fas fa-angle-down sub-caret hidden-md hidden-lg"></i>
                                                                <?php } ?>
                                                            </a>
                                                        </li>
                                                    <?php if ($index3 == $size3 - 1) { ?>
                                                    </ul>
                                                    <?php } ?>
                                                    <?php $index3++; } ?>
                                                    <?php } ?>
                                                </li>
                                            <?php if ($index2 == $size2 - 1) { ?>
                                            </ul>
                                            <?php } ?>
                                            <?php $index2++; } ?>
                                            <?php } ?>
                                        </li>
                                        <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-link"><i class="fas fa-graduation-cap m-r-5 text-success"></i>보험 지식</a>
                                    <a href="#" class="cate-dropdown-open dorpdown-toggle" data-bs-toggle="dropdown"></a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL ?>/insurance_dictionary.php" class="dropdown-item nav-link"><i class="fas fa-spell-check m-r-5 text-info"></i>보험 용어 사전</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL ?>/healthcare_dictionary.php" class="dropdown-item nav-link"><i class="fas fa-file-medical m-r-5 text-primary"></i>의료 용어 사전</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL ?>/insurance_quiz.php" class="dropdown-item nav-link"><i class="fas fa-tasks m-r-5 text-primary"></i>보험 상식 퀴즈</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-link"><i class="fas fa-hand-holding-heart m-r-5 text-crimson"></i>보험 케어</a>
                                    <a href="#" class="cate-dropdown-open dorpdown-toggle" data-bs-toggle="dropdown"></a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=claim" class="dropdown-item nav-link"><i class="fas fa-calendar-plus m-r-5 text-blue"></i>보험금 청구 예약</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=claim_review" class="dropdown-item nav-link"><i class="fas fa-comment-dots m-r-5 text-teal"></i>보험금 청구 후기</a>
                                            </li>
                                        </ul>
                                    </div>

                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-link"><i class="fas fa-shield-alt m-r-5 text-primary"></i>보험 상품</a>
                                    <a href="#" class="cate-dropdown-open dorpdown-toggle" data-bs-toggle="dropdown"></a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo shop_type_url(3); ?>" class="dropdown-item nav-link"><i class="fas fa-star m-r-5 text-orange"></i>최신 상품</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo shop_type_url(4); ?>" class="dropdown-item nav-link"><i class="fas fa-fire m-r-5 text-red"></i>인기 상품</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo shop_type_url(2); ?>" class="dropdown-item nav-link"><i class="fas fa-thumbs-up m-r-5 text-blue"></i>추천 상품</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo shop_type_url(1); ?>" class="dropdown-item nav-link"><i class="fas fa-bolt m-r-5 text-warning"></i>히트 상품</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo shop_type_url(5); ?>" class="dropdown-item nav-link"><i class="fas fa-percent m-r-5 text-success"></i>할인 상품</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-link"><i class="fas fa-file-signature m-r-5 text-warning"></i>보험 관리</a>
                                    <a href="#" class="cate-dropdown-open dorpdown-toggle" data-bs-toggle="dropdown"></a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=remodeling" class="dropdown-item nav-link"><i class="fas fa-tools m-r-5 text-orange"></i>보험 리모델링</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_URL; ?>/shop/content.php?co_id=policy_analysis" class="dropdown-item nav-link"><i class="fas fa-chart-line m-r-5 text-primary"></i>보험증권 분석</a>
                                            </li>
                                        </ul>
                                    </div>

                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-link"><i class="fas fa-file-medical-alt m-r-5 text-info"></i>보장 점검</a>
                                    <a href="#" class="cate-dropdown-open dorpdown-toggle" data-bs-toggle="dropdown"></a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL; ?>/pharmacy_info.php" class="dropdown-item nav-link"><i class="fas fa-pills m-r-5 text-pink"></i>약국 정보 조회</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL; ?>/hospital_info.php" class="dropdown-item nav-link"><i class="fas fa-hospital m-r-5 text-warning"></i>병원 정보 조회</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL; ?>/disease_code.php" class="dropdown-item nav-link"><i class="fas fa-search m-r-5 text-primary"></i>상병 코드 조회</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL; ?>/getPharmacyMdfeeList.php" class="dropdown-item nav-link"><i class="fas fa-file-invoice-dollar m-r-5 text-info"></i>수가 정보 조회</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL; ?>/surgery_1_3_1_5_search.php" class="dropdown-item nav-link"><i class="fas fa-search-plus m-r-5 text-success"></i>종 수술명 검색</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_URL; ?>/shop/content.php?co_id=myinsurance" class="dropdown-item nav-link"><i class="fas fa-user-shield m-r-5 text-success"></i>보험 통합 조회</a>
                                            </li>

                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL; ?>/NonPaymentItemHospList2.php" class="dropdown-item nav-link"><i class="fas fa-hand-holding-usd m-r-5 text-danger"></i>병원 비급여 항목</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-link"><i class="fas fa-life-ring m-r-5 text-secondary"></i>고객지원</a>
                                    <a href="#" class="cate-dropdown-open dorpdown-toggle" data-bs-toggle="dropdown"></a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="dropdown-item nav-link"><i class="fas fa-bell m-r-5 text-info"></i>공지사항</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_BBS_URL ?>/qalist.php" class="dropdown-item nav-link"><i class="fas fa-comment-dots m-r-5 text-success"></i>1:1문의</a>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_BBS_URL ?>/faq.php" class="dropdown-item nav-link"><i class="fas fa-question-circle m-r-5 text-warning"></i>FAQ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-social-btns" style="margin-left: 140px; display: flex; align-items: center; gap: 5px;">
                                    <a href="https://blog.naver.com/fintos" target="_blank" class="nav-link" style="padding: 10px 5px !important;">
                                        <img src="<?php echo EYOOM_THEME_URL; ?>/image/main/naver_blog_icon.png" width="28" height="28" style="border-radius: 4px; vertical-align: middle;">
                                    </a>
                                    <a href="http://pf.kakao.com/_YOUR_KAKAO_ID" target="_blank" class="nav-link" style="padding: 10px 5px !important;">
                                        <img src="<?php echo EYOOM_THEME_URL; ?>/image/main/kakao_icon.png" width="28" height="28" style="border-radius: 4px; vertical-align: middle;">
                                    </a>
                                </li>
                                <?php if ($is_darkmode == 'yes') { ?>
                                <li class="darkmode-menu">
                                    <a href="javascript:void(0);" class="nav-link dark-mode-btn">
                                        <?php if($modeStyle == 'light') { ?>
                                        <i class="fas fa-moon"></i><span>다크모드</span>
                                        <?php } else { ?>
                                        <i class="fas fa-sun text-amber"></i><span>라이트모드</span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <?php /*----- header 끝 -----*/ ?>

    <?php if(!defined('_INDEX_')) { // 메인이 아닐때 ?>
    <?php /*----- page title 시작 -----*/ ?>
    <div class="page-title-wrap">
        <div class="container">
        <?php if (!defined('_EYOOM_MYPAGE_')) { ?>
            <h2>
                <?php if (!$it_id) { ?>
                <i class="fas fa-arrow-alt-circle-right m-r-10"></i><?php echo $subinfo['title']; ?>
                <?php } else { ?>
                <i class="fas fa-arrow-alt-circle-right m-r-10"></i><?php echo $subinfo['title']; ?>
                <?php } ?>
            </h2>
            <?php if (!$it_id) { ?>
            <div class="sub-breadcrumb-wrap">
                <ul class="sub-breadcrumb hidden-xs">
                    <?php echo $subinfo['path']; ?>
                </ul>
            </div>
            <?php } ?>
        <?php } else { ?>
            <h2><i class="fas fa-arrow-alt-circle-right"></i> 마이페이지</h2>
        <?php } ?>
        </div>
    </div>
    <?php /*----- page title 끝 -----*/ ?>
    <?php } ?>

    <div class="basic-body <?php if(!defined('_INDEX_')) { ?>page-body<?php } ?>">
        <?php if(defined('_INDEX_')) { ?>
        <main class="basic-body-main">
        <?php } else { ?>
        <div class="container">
            <main class="basic-body-main">
        <?php } ?>
<?php } // !$wmode ?>