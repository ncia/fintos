<?php
/**
 * theme file : /theme/THEME_NAME/shop/index.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="shop-main-section1">
    <div class="container">
        <div class="main-section1-row">
            <div class="main-section1-l">
                <div class="main-section1-l1">
                    <?php /* EB肄섑뀗痢?- shop020_main_categories */ ?>
                    <?php echo eb_contents('1658729735'); ?>
                </div>
                <div class="main-section1-l2">
                    <?php /* EB?щ씪?대뜑 - shop020_main_2 */ ?>
                    <?php echo eb_slider('1652165926'); ?>
                </div>
            </div>
            <div class="main-section1-c">
                <div class="main-section1-c-in">
                    <?php /* EB?щ씪?대뜑 - shop020_main_1 */ ?>
                    <?php echo eb_slider('1650608679'); ?>
                    
                    <?php /* EB?щ씪?대뜑 - shop020_main_3 */ ?>
                    <?php echo eb_slider('1652336831'); ?>
                    
                    <?php /* EB?щ씪?대뜑 - shop020_main_4 */ ?>
                    <?php echo eb_slider('1652165942'); ?>
                </div>
            </div>
            <div class="main-section1-r">
                <div class="main-section1-r1">
                    <?php /* EB?щ씪?대뜑 - shop020_countdown */ ?>
                    <?php echo eb_slider('1652666463'); ?>
                </div>
                <div class="main-section1-r2">
                    <div class="m-b-10">
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#insAgeModal" class="animate-img-hvr2 d-block border-radius-5 overflow-hidden">
                            <img src="<?php echo G5_SHOP_URL; ?>/img/side_banner_ranking.png" class="img-fluid" alt="蹂댄뿕 ?섏씠 ?곷졊??怨꾩궛?섎뒗 踰?>
                        </a>
                        <button type="button" class="btn-e btn-e-dark btn-e-block m-t-10 m-b-20" data-bs-toggle="modal" data-bs-target="#insAgeModal">??蹂댄뿕 ?섏씠 ?뚯븘蹂닿린</button>
                    </div>
                    <?php /* EB?곹뭹異붿텧 - shop020_best */ ?>
                    <?php echo eb_goods('1658911060'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /* ---------- ?쇳븨紐?釉뚮옖???쒖옉 ---------- */ ?>
<?php if ($eyoom['use_brand'] != 'n') { ?>
<div class="shop-main-section2">
    <div class="container">
        <?php echo eb_brand('basic'); ?>
    </div>
</div>
<?php } ?>
<?php /* ---------- ?쇳븨紐?釉뚮옖????---------- */ ?>

<div class="shop-main-section-basic <?php if ($eyoom['use_brand'] == 'n') { ?>border-top-1<?php } ?> border-bottom--1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB?щ씪?대뜑 - shop020_main_5 (1) */ ?>
                <?php echo eb_slider('1658993441'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* EB?곹뭹異붿텧 - shop020_main */ ?>
                <?php echo eb_goods('1652073560'); ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section3">
    <?php /* EB?щ씪?대뜑 - shop020_main_6 */ ?>
    <?php echo eb_slider('1652230190'); ?>
</div>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB?щ씪?대뜑 - shop020_main_5 (2) */ ?>
                <?php echo eb_slider('1659255375'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- ?덊듃?곹뭹 ?쒖옉 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-10px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> ?좏삎蹂??곹뭹吏꾩뿴 ?ㅼ젙</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="?덉갹 ?닿린">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type1_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(1); ?>"><strong>?덊듃 <span>?곹뭹</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(1); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type1_list_skin']);
                    $list->set_type(1);
                    $list->set_view('it_img', true);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- ?덊듃?곹뭹 ??---------- */ ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB?щ씪?대뜑 - shop020_main_5 (3) */ ?>
                <?php echo eb_slider('1659257180'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- 異붿쿇?곹뭹 ?쒖옉 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-10px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> ?좏삎蹂??곹뭹吏꾩뿴 ?ㅼ젙</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="?덉갹 ?닿린">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type2_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(2); ?>"><strong>異붿쿇 <span>?곹뭹</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(2); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type2_list_skin']);
                    $list->set_type(2);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- 異붿쿇?곹뭹 ??---------- */ ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section-basic border-bottom--1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB?щ씪?대뜑 - shop020_main_5 (4) */ ?>
                <?php echo eb_slider('1659312032'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- 理쒖떊?곹뭹 ?쒖옉 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-10px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> ?좏삎蹂??곹뭹吏꾩뿴 ?ㅼ젙</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="?덉갹 ?닿린">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type3_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(3); ?>"><strong>理쒖떊 <span>?곹뭹</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(3); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type3_list_skin']);
                    $list->set_type(3);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- 理쒖떊?곹뭹 ??---------- */ ?>
            </div>
        </div>
    </div>
</div>

<?php /* ---------- ?대깽?몃컯???쒖옉 ---------- */ ?>
<?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxevent.skin.html.php'); // ?대깽???>
<?php /* ---------- ?대깽?몃컯????---------- */ ?>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB?щ씪?대뜑 - shop020_main_5 (5) */ ?>
                <?php echo eb_slider('1659316824'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- ?멸린?곹뭹 ?쒖옉 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> ?좏삎蹂??곹뭹吏꾩뿴 ?ㅼ젙</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="?덉갹 ?닿린">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type4_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(4); ?>"><strong>?멸린 <span>?곹뭹</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(4); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type4_list_skin']);
                    $list->set_type(4);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- ?멸린?곹뭹 ??---------- */ ?>
            </div>
        </div>
    </div>
</div>

<div class="shop-main-section-basic border-bottom-1">
    <div class="container">
        <div class="main-section-basic-row">
            <div class="main-section-basic-l">
                <?php /* EB?щ씪?대뜑 - shop020_main_5 (6) */ ?>
                <?php echo eb_slider('1659316859'); ?>
            </div>
            <div class="main-section-basic-r">
                <?php /* ---------- ?좎씤?곹뭹 ?쒖옉 ---------- */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> ?좏삎蹂??곹뭹吏꾩뿴 ?ㅼ젙</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="?덉갹 ?닿린">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php if($default['de_type5_list_use']) { ?>
                <section>
                    <div class="main-heading">
                        <h2><a href="<?php echo shop_type_url(5); ?>"><strong>?좎씤 <span>?곹뭹</span></strong></a></h2>
                        <a href="<?php echo shop_type_url(5); ?>" class="heading-more-btn"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php
                    $list = new item_list($skin_dir.'/'.$default['de_type5_list_skin']);
                    $list->set_type(5);
                    $list->set_view('it_id', false);
                    $list->set_view('it_name', true);
                    $list->set_view('it_basic', true);
                    $list->set_view('it_cust_price', true);
                    $list->set_view('it_price', true);
                    $list->set_view('it_icon', true);
                    $list->set_view('sns', true);
                    $list->set_view('star', true);
                    echo $list->run();
                    ?>
                </section>
                <?php } ?>
                <?php /* ---------- ?좎씤?곹뭹 ??---------- */ ?>
            </div>
        </div>
    </div>
</div>

<?php if ($main_review == 'yes') { ?>
<div class="shop-main-section4">
    <div class="container">
        <?php /* ---------- 硫붿씤 ?ъ슜?꾧린 ?쒖옉 ---------- */ ?>
        <?php
        $sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
                    from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
                    where a.is_confirm = '1'
                    order by a.is_id desc
                    limit 0,10 ";
        $result = sql_query($sql);
        
        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($i == 0) {
                echo '<div class="main-heading">'.PHP_EOL;
                echo '<h2><a href="'.G5_SHOP_URL.'/itemuselist.php"><strong>?ъ슜??<span>由щ럭</span></strong></a></h2>'.PHP_EOL;
                echo '<a href="'.G5_SHOP_URL.'/itemuselist.php" class="heading-more-btn"><i class="fas fa-plus"></i></a>'.PHP_EOL;
                echo '</div>'.PHP_EOL;
                echo '<div class="review-main">'.PHP_EOL;
                echo '<div class="review-main-in">'.PHP_EOL;
            }
        
            $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'].'#sit_use';
        ?>
            <div class="review-item">
                <div class="review-item-in">
                    <a href="<?php echo $review_href; ?>">
                        <div class="review-img animate-img-hvr2">
                            <div class="review-img-in">
                                <?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 500, 500); ?>
                            </div>
                        </div>
                    </a>
                    <div class="review-cont">
                        <h4 class="ellipsis"><a href="<?php echo $review_href; ?>"><?php echo get_text(cut_str($row['is_subject'], 50)); ?></a></h4>
                        <h5 class="ellipsis"><a href="<?php echo $review_href; ?>"><?php echo $row['it_name']; ?></a></h5>
                        <p class="ellipsis-2"><?php echo get_text(cut_str(strip_tags($row['is_content']), 90), 1); ?></p>
                    </div>
                </div>
            </div>
        <?php
        }
        
        if($i > 0) {
            echo '</div>'.PHP_EOL;
            echo '</div>'.PHP_EOL;
        }
        ?>
        
        <script>
        $('.review-main-in').slick({
            dots: true,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
        </script>
        <?php /* ---------- 硫붿씤 ?ъ슜?꾧린 ??---------- */ ?>
    </div>
</div>
<?php } ?>
