<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuseform.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<style>
/* 통합 스타일 시트 - Pretendard 적용 */
.shop-product-use-write { background: #fff; font-family: 'Pretendard', 'Apple SD Gothic Neo', sans-serif; }
.mdb-card-body { padding: 15px 20px !important; position: relative; }

/* 상담후기 안내 문구 스타일 */
.rating-guide-box { margin-bottom: 5px; text-align: center; }
.rating-guide-box .guide-title { 
    font-family: 'Pretendard', 'Apple SD Gothic Neo', sans-serif !important;
    font-size: 18px !important; 
    font-weight: 700 !important; 
    color: #666 !important; 
    line-height: 1.6 !important; 
    margin: 0 !important; 
    letter-spacing: -0.5px !important; 
}
.rating-guide-box .guide-desc { 
    font-family: 'Pretendard', 'Apple SD Gothic Neo', sans-serif !important;
    font-size: 18px !important; 
    color: #666 !important; 
    font-weight: 700 !important; 
    margin: 5px 0 0 !important;
    line-height: 1.4 !important;
}

/* 에디터 자동 확장 */
.note-editor.note-frame .note-editing-area .note-editable { height: auto !important; min-height: 135px !important; padding: 10px !important; }
.note-editor.note-frame { margin-bottom: 10px !important; }

/* 별점 영역 */
.star-rating-wrapper { 
    background: #fdfdfd; border: 1px solid #f1f3f5; 
    margin-bottom: 15px !important; padding: 10px !important; 
    border-radius: 16px; text-align: center; 
    display: flex; flex-direction: column; align-items: center;
}
.star-rating { display: flex; gap: 8px; cursor: pointer; justify-content: center; margin-bottom: 10px !important; }
.star-rating .star { font-size: 28px !important; color: #ddd; transition: transform 0.2s ease, color 0.2s ease; }
.star-rating .star:hover { transform: scale(1.1); }
.star-rating .star.active { color: #ffc107; }

/* 버튼 */
.shop-product-use-write .submit-btn { 
    background: #007bff !important; color: #fff !important; 
    height: 45px !important; width: 25% !important; border-radius: 8px !important;
    font-size: 16px !important; font-weight: 700 !important; 
    border: none; cursor: pointer; margin-top: 10px !important; margin-bottom: 20px !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}
.shop-product-use-write .submit-btn:hover { background: #0069d9 !important; }

/* 게스트 오버레이 */
.guest-overlay { 
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
    background: rgba(255,255,255,0.6); z-index: 100; 
    display: flex; align-items: center; justify-content: center; backdrop-filter: blur(2px);
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
    width: 50%;
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
    <div class="mdb-card-body" style="position: relative;">
        <?php if (!$is_member) { ?>
        <div class="guest-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.6); z-index: 100; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(2px);">
            <div style="text-align: center; background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #f1f3f5; max-width: 320px; width: 90%;">
                <div style="font-size: 40px; margin-bottom: 15px;">🔒</div>
                <p style="color: #111; font-weight: 800; font-size: 17px; margin-bottom: 8px; letter-spacing: -0.5px;">회원 전용 서비스입니다</p>
                <p style="color: #666; font-size: 14px; margin-bottom: 20px; line-height: 1.5;">상담후기를 작성하시려면<br>로그인이 필요합니다.</p>
                <a href="<?php echo G5_BBS_URL; ?>/login.php" class="btn-e btn-e-md btn-e-blue" style="width: 100%; font-weight: 700; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">로그인 페이지로 이동</a>
            </div>
        </div>
        <?php } ?>
        <form name="fitemuse" method="post" action="<?php echo G5_SHOP_URL; ?>/itemuseformupdate.php" onsubmit="return fitemuse_submit(this);" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
        <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">

        <div class="product-use-write">
            <?php /* 별점 선택 (최상단으로 이동 및 제목 삭제) */ ?>
            <div class="star-rating-wrapper" style="background: #fdfdfd; border: 1px solid #f1f3f5; margin-bottom: 30px; padding: 20px 20px; border-radius: 16px; text-align: center; align-items: center;">
                <div class="star-rating" style="justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-star star active" data-value="1"></i>
                    <i class="fas fa-star star active" data-value="2"></i>
                    <i class="fas fa-star star active" data-value="3"></i>
                    <i class="fas fa-star star active" data-value="4"></i>
                    <i class="fas fa-star star active" data-value="5"></i>
                </div>
                <div class="rating-guide-box">
                    <p class="guide-title">⭐ <span style="color:#ff3b30;">별점</span> 5점과 함께 정성스러운 후기를 작성해 주세요.</p>
                    <p class="guide-desc">❤️ 남겨주신 후기는 소중한 피드백으로 🙏 더 만족스러운 경험을 약속드립니다.</p>
                </div>
                <input type="hidden" name="is_score" id="is_score" value="5" required>
            </div>

            
            <div class="write-edit-wrap">
                <?php echo $editor_html; ?>
            </div>



            <script>
            $(document).ready(function() {
                const $stars = $('.star-rating .star');
                const $scoreInput = $('#is_score');
                let currentScore = $scoreInput.val() || 5;

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

                // 초기화 (기본 5점 설정)
                updateStars(5, 'active');

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
    <?php if (!$is_member) { ?>
    alert("회원만 작성 가능합니다. 로그인 후 이용해주세요.");
    location.href = "<?php echo G5_BBS_URL; ?>/login.php";
    return false;
    <?php } ?>
    <?php echo $editor_js; ?>
    
    // 글자수 체크 추가
    var content = f.is_content.value;
    var text = content.replace(/<[^>]*>?/gm, '').replace(/&nbsp;/gi, ' ').trim();
    
    if (text.length < 20) {
        alert("상담후기 내용은 최소 20자 이상 작성해 주셔야 합니다. (현재 " + text.length + "자)");
        return false;
    }
    if (text.length > 1000) {
        alert("상담후기 내용은 최대 1000자까지 작성 가능합니다. (현재 " + text.length + "자)");
        return false;
    }

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

<?php /* 에디터 초기 높이 강제 설정 및 다크모드 대응 */ ?>
if (currentMode == "dark") {
    document.body.classList.toggle("dark-mode");
    <?php if($editor_html && preg_match('/ckeditor/i', $config['cf_editor'])) { ?>
    CKEDITOR.on('instanceReady', function(e) {
        e.editor.document.getBody().setStyle('background-color', '#000');
        e.editor.document.getBody().setStyle('color', '#858585');
    });
    <?php } ?>
}

<?php /* 다크모드 JS 끝 */ ?>
</script>
<?php /* ---------- 상담후기 쓰기 끝 ---------- */ ?>