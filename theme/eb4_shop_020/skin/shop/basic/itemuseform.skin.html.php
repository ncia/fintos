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
    padding-bottom: 150px; /* 색상 선택창 등 드롭다운을 위한 여유 공간 */
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
            <div class="score-selector">
                <input type="radio" name="is_score" value="5" id="is_score5" <?php echo ($is_score==5)?'checked="checked"':''; ?>>
                <label for="is_score5" class="score-label">매우만족 <img src="<?php echo G5_URL; ?>/shop/img/s_star5.png" alt="5"></label>

                <input type="radio" name="is_score" value="4" id="is_score4" <?php echo ($is_score==4)?'checked="checked"':''; ?>>
                <label for="is_score4" class="score-label">만족 <img src="<?php echo G5_URL; ?>/shop/img/s_star4.png" alt="4"></label>

                <input type="radio" name="is_score" value="3" id="is_score3" <?php echo ($is_score==3)?'checked="checked"':''; ?>>
                <label for="is_score3" class="score-label">보통 <img src="<?php echo G5_URL; ?>/shop/img/s_star3.png" alt="3"></label>

                <input type="radio" name="is_score" value="2" id="is_score2" <?php echo ($is_score==2)?'checked="checked"':''; ?>>
                <label for="is_score2" class="score-label">불만 <img src="<?php echo G5_URL; ?>/shop/img/s_star2.png" alt="2"></label>

                <input type="radio" name="is_score" value="1" id="is_score1" <?php echo ($is_score==1)?'checked="checked"':''; ?>>
                <label for="is_score1" class="score-label">매우불만 <img src="<?php echo G5_URL; ?>/shop/img/s_star1.png" alt="1"></label>
            </div>

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