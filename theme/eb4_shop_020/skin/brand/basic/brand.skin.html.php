<?php
/**
 * skin file : /theme/THEME_NAME/skin/brand/basic/brand.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
if ($eyoom['use_brand'] == 'n') return;
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
?>

<?php
// 랜덤 배경 이미지 선택 (1~40)
$rand_bg_idx = rand(1, 40);
$brand_hero_bg = EYOOM_THEME_URL . '/image/brand_bg/bg_' . $rand_bg_idx . '.png';
?>

<style>
.brand-hero {
    position: relative;
    width: 100%;
    height: 250px;
    background-image: url('<?php echo $brand_hero_bg; ?>');
    background-size: cover;
    background-position: center;
    border-radius: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-bottom: 40px;
}
.brand-hero .hero-logo-box {
    width: 110px;
    height: 110px;
    background: #fff;
    padding: 12px;
    border-radius: 0;
    border: 3px solid #4a5568;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.brand-hero .hero-logo-box img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 0;
}
.brand-hero h2.hero-title {
    color: #fff;
    font-size: 1.75rem;
    font-weight: 800;
    text-shadow: 0 2px 10px rgba(0,0,0,0.7);
    margin: 0;
}

.brand-wrap {position:relative;overflow:hidden;padding:20px 0 0;min-height:160px; background: rgba(255,255,255,0.05); border-radius: 0; margin-bottom: 0;}
.brand-box .category-list {margin:0px auto; padding: 0 40px;} /* 좌우 여백 확보 */
.brand-box .category-item {outline:none; text-align:center; padding: 10px 0 0; transition: all 0.3s ease;}
.brand-box .category-img {position:relative;width:85px;height:85px;margin:0 auto; padding: 5px; background: transparent;}
.brand-box .category-img img {border-radius: 0;} /* 이미지 가공 */
.brand-box .category-title {font-size:.9375rem;text-align:center;height:22px;line-height:22px; margin-bottom: 8px; color: #cbd5e0;} /* 옅은 회색으로 텍스트 색상 조절 */
.brand-box .category-item a {display:block;position:relative; text-decoration: none;}
.brand-box .category-item:hover .category-title {color:#fff; text-decoration:none;}
.brand-box .category-item:hover .category-img {transform: scale(1.05);}

/* 브랜드 캐러셀 바로 다음 섹션의 상단 여백 제거 */
.shop-main-section2 + .shop-main-section-basic .main-section-basic-l,
.shop-main-section2 + .shop-main-section-basic .main-section-basic-r {
    padding-top: 0 !important;
}

/* Slick Arrows Styling */
.brand-box .category-list button.slick-arrow {
    position: absolute;
    top: 50%;
    margin-top: -15px;
    z-index: 10;
    width: 30px;
    height: 30px;
    border: 0;
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}
.brand-box .category-list button.slick-arrow:before,
.brand-box .category-list button.slick-arrow:after { display: none !important; } /* 중첩된 기본 화살표 제거 */
.brand-box .category-list button.slick-prev { left: 0; }
.brand-box .category-list button.slick-next { right: 0; }
.brand-box .category-list button.slick-arrow:hover { background: rgba(255, 255, 255, 0.4); }
.brand-box .category-list button.slick-arrow i { font-size: 0.8rem; font-family: "Font Awesome 5 Free"; font-weight: 900; }


@media (max-width:1199px) {
    .brand-wrap {min-height:150px; padding-top:20px}
    .brand-box .category-img {width:70px;height:70px;}
}
</style>

<?php if ($br['br_name']) { ?>
<div class="brand-hero">
    <div class="hero-logo-box">
        <img src="<?php echo $br['img_url']?>" alt="<?php echo $br['br_name']; ?>" onerror="this.src='<?php echo G5_URL; ?>/data/brand/<?php echo rawurlencode($br['br_name']); ?>.png';">
    </div>
    <h2 class="hero-title"><?php echo $br['br_name']; ?></h2>
</div>
<?php } ?>

<div class="brand-wrap">
    <div class="brand-box">
        <div class="category-list">
            <?php for ($i=0; $i<count((array)$list); $i++) { ?>
            <div class="category-item <?php echo $list[$i]['br_code'] == $br_cd ? 'active': ''; ?>">
                <a href="<?php echo G5_SHOP_URL; ?>/brand.php?br_cd=<?php echo urlencode($list[$i]['br_code']); ?>">
                    <div class="category-title ellipsis"><?php echo $list[$i]['br_name']; ?></div>
                    <div class="category-img">
                        <img src="<?php echo $list[$i]['img_url']?>" class="img-fluid" alt="<?php echo $list[$i]['br_name']; ?>" onerror="this.src='<?php echo G5_URL; ?>/data/brand/<?php echo rawurlencode($list[$i]['br_name']); ?>.png'; this.onerror=function(){this.style.display='none'};">
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php if (count((array)$list) == 0) { ?>
        <div class="text-center p-t-30 p-b-50" style="color:#94a3b8;"><i class="fas fa-exclamation-circle"></i> 출력할 브랜드가 없습니다.</div>
        <?php } ?>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(function() {
    $('.category-list').slick({
        infinite: true,
        slidesToShow: 8,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 800,
        arrows: true,
        dots: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
</script>