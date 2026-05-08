<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuseform.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<style>
<style>
/* 카운트다운 상담신청 스타일 적용 */
body { background: #fff; margin: 0; padding: 0; font-family: 'Noto Sans KR', sans-serif; }
.shop-product-use-write { background: #fff; }
.mdb-card-body { padding: 40px 50px; }
@media (max-width: 767px) {
    .mdb-card-body { padding: 30px 20px; }
}

/* Material Input Style - Outlined with Blue Focus */
.eyoom-form .input { 
    position: relative; 
    margin-bottom: 25px;
    display: flex !important;
    align-items: center;
    border: 1px solid #007bff !important;
    border-radius: 8px !important;
    height: 45px !important;
    background-color: #fff !important;
    transition: all 0.2s ease;
    box-sizing: border-box !important;
    padding: 0 !important;
}
.eyoom-form .input input { 
    background-color: transparent !important;
    border: none !important;
    height: 100% !important;
    padding: 0 20px !important;
    font-size: 15px !important;
    width: 100%;
    outline: none !important;
    flex: 1;
    color: #1f2937;
}

/* Score Selector Style (Gender Selector Style in Countdown) */
.score-selector {
    display: flex;
    gap: 12px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}
.score-selector input[type="radio"] {
    display: none;
}
.score-label {
    flex: 1;
    min-width: 120px;
    border: 1px solid #007bff;
    border-radius: 8px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: #fff;
    color: #9ca3af;
    font-size: 15px;
    transition: all 0.2s;
}
.score-selector input[type="radio"]:checked + .score-label {
    background: #007bff;
    color: #fff;
    font-weight: 500;
}
.score-label img {
    height: 14px;
    margin-left: 8px;
    filter: grayscale(1) brightness(0.8);
}
.score-selector input[type="radio"]:checked + .score-label img {
    filter: brightness(0) invert(1);
}

.required-dot {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 8px;
    height: 8px;
    background-color: #ffd600;
    border-radius: 50%;
    z-index: 5;
}

.section-title {
    font-size: 17px;
    font-weight: 700;
    color: #333;
    margin: 10px 0 20px 0;
    padding-bottom: 8px;
    border-bottom: 1px solid #eee;
}

.write-edit-wrap {
    border: 1px solid #007bff;
    border-radius: 0px; /* 직각 모서리로 수정 */
    overflow: visible;
    margin-bottom: 25px;
    background: #fff;
}

/* Summernote dropdown clipping fix */
.note-editor .note-dropdown-menu {
    z-index: 1050 !important;
}
.note-editor .note-editing-area {
    border-radius: 0px;
}
.note-editor.note-frame {
    border: none !important;
    border-radius: 0px !important;
}
.note-toolbar {
    background: #f8f9fa !important;
    border-bottom: 1px solid #eee !important;
    border-radius: 0px !important; /* 직각 모서리로 수정 */
}

.submit-btn {
    background: #007bff !important;
    color: #fff !important;
    height: 45px !important;
    border-radius: 8px !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    width: 100%;
    border: none;
    cursor: pointer;
    margin-top: 20px !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}
.submit-btn:hover {
    background: #0069d9 !important;
}

.product-use-write {
    padding-bottom: 0px; /* 여유 공간 제거 */
}
</style>

<?php /* ---------- 상담후기 쓰기 시작 ---------- */ ?>
<div class="shop-product-use-write">
    <div class="mdb-card-body">
        <form name="fitemuse" method="post" action="<?php echo G5_SHOP_URL; ?>/itemuseformupdate.php" onsubmit="return fitemuse_submit(this);" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
        <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">

        <div class="product-use-write">
            <div class="section-title">후기 제목</div>
            <div class="input">
                <input type="text" name="is_subject" value="<?php echo get_text($use['is_subject']); ?>" id="is_subject" required maxlength="250" placeholder="제목을 입력해주세요.">
                <div class="required-dot"></div>
            </div>

            <div class="section-title">상세 내용</div>
            <div class="write-edit-wrap">
                <?php echo $editor_html; ?>
            </div>

            <div class="section-title">평점 선택</div>
            <div class="star-rating-wrapper">
                <div class="star-rating">
                    <i class="far fa-star star" data-value="1"></i>
                    <i class="far fa-star star" data-value="2"></i>
                    <i class="far fa-star star" data-value="3"></i>
                    <i class="far fa-star star" data-value="4"></i>
                    <i class="far fa-star star" data-value="5"></i>
                </div>
                <div class="rating-guide-box">
                    <p class="rating-guide">⭐ 5점과 함께 정성스러운 후기를 작성해 주세요.<br>남겨주신 후기는 소중한 피드백으로 더 만족스러운 경험을 약속드립니다.</p>
                </div>
                <input type="hidden" name="is_score" id="is_score" value="<?php echo $is_score ? $is_score : ''; ?>" required>
            </div>

            <style>
            .star-rating-wrapper {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                margin-bottom: 30px;
                background: #fdfdfd;
                padding: 25px;
                border: 1px solid #eee;
                border-radius: 8px;
            }
            .star-rating {
                display: flex;
                gap: 8px;
                cursor: pointer;
            }
            .star-rating .star {
                font-size: 36px;
                color: #ddd;
                transition: transform 0.2s ease, color 0.2s ease;
            }
            .star-rating .star:hover {
                transform: scale(1.1);
            }
            .star-rating .star.hover,
            .star-rating .star.active {
                color: #ffc107;
            }
            .rating-guide-box {
                margin-top: 5px;
            }
            .rating-guide {
                font-size: 15px;
                color: #333;
                font-weight: 500;
                line-height: 1.5;
                margin: 0;
            }
            </style>

            <script>
            $(document).ready(function() {
                const $stars = $('.star-rating .star');
                const $scoreInput = $('#is_score');
                let currentScore = $scoreInput.val();

                function updateStars(score, type) {
                    $stars.each(function() {
                        const val = $(this).data('value');
                        if (type === 'hover') {
                            $(this).toggleClass('hover', val <= score);
                        } else {
                            $(this).toggleClass('active', val <= score);
                            if (val <= score) {
                                $(this).removeClass('far').addClass('fas');
                            } else {
                                $(this).removeClass('fas').addClass('far');
                            }
                        }
                    });
                }

                // 초기화
                if (currentScore) {
                    updateStars(currentScore, 'active');
                }

                $stars.on('mouseenter', function() {
                    const val = $(this).data('value');
                    updateStars(val, 'hover');
                }).on('mouseleave', function() {
                    $stars.removeClass('hover');
                }).on('click', function() {
                    currentScore = $(this).data('value');
                    $scoreInput.val(currentScore);
                    updateStars(currentScore, 'active');
                });
            });
            </script>

            <div class="text-center">
                <input type="submit" value="작성완료" class="submit-btn">
            </div>
        </div>

        </form>
    </div>
</div>

<script type="text/javascript">
function fitemuse_submit(f) {
    <?php echo $editor_js; ?>

    return true;
}

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
$(document).ready(function(){
    var touchStartTimestamp = 0;
    
    $("input, textarea, select").on('touchstart', function(event) {
        zoomDisable();
        touchStartTimestamp = event.timeStamp;
    });

    $("input, textarea, select").on('touchend', function(event) {
        var touchEndTimestamp = event.timeStamp;
        if (touchEndTimestamp - touchStartTimestamp > 500) {
            setTimeout(zoomEnable, 500);
        } else {
            zoomDisable();
            setTimeout(zoomEnable, 500);
        }
    });

    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }

    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
<?php } ?>

<?php /* 다크모드 JS 시작 */ ?>
const currentMode = localStorage.getItem("mode");

if (currentMode == "dark") {
	document.body.classList.toggle("dark-mode");
	<?php if($editor_html && preg_match('/ckeditor/i', $config['cf_editor'])) { ?>
	CKEDITOR.on('instanceReady', function(e) {
		e.editor.document.getBody().setStyle('background-color', '#000');
		e.editor.document.getBody().setStyle('color', '#858585');
	});
	<?php } ?>
    <?php if($editor_html && preg_match('/summernote/i', $config['cf_editor'])) { ?>
	$(document).ready(function() {
		// Summernote dark mode logic can be added here if needed
	});
	<?php } ?>
}

<?php /* 다크모드 JS 끝 */ ?>
</script>
<?php /* ---------- 상담후기 쓰기 끝 ---------- */ ?>