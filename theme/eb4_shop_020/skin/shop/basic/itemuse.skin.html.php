<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuse.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

// 에디터 라이브러리 로드 확인 및 에디터 생성 (폼이 안 보일 때를 대비한 강제 생성)
include_once(G5_EDITOR_LIB);
if ($config['cf_editor']) {
    $is_dhtml_editor = true;
    $editor_html = editor_html('is_content', '', $is_dhtml_editor);
    $editor_js = '';
    $editor_js .= get_editor_js('is_content', $is_dhtml_editor);
    $editor_js .= chk_editor_js('is_content', $is_dhtml_editor);
}
?>

<style>
/* 프리미엄 카드 레이아웃 */
.product-use-card {
    background: #fff;
    border: 1px solid #f1f3f5;
    border-radius: 16px;
    padding: 20px;
    position: relative;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    min-height: 200px;
    margin-bottom: 20px; /* 개별 카드 간격 */
}

.card-star-row { margin-bottom: 12px; }

.card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid #f1f3f5;
    font-size: 13px;
    color: #868e96;
}

.card-more-btn {
    width: 100%;
    margin-top: 15px;
    padding: 10px;
    background: #f8f9fa;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

.card-content-detail {
    display: none;
    padding: 15px;
    background: #fdfdfd;
    border-top: 1px dashed #dee2e6;
    margin-top: 10px;
    font-size: 14px;
}

/* 다크모드 대응 */
.dark-mode .product-use-card {
    background: #1e1e1e;
    border-color: #333;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
}
</style>

<div class="product-use-wrap-main">
    <div>
        <?php if ($use_cnt > 0) { ?>
            <?php foreach ($item_use as $k => $info) { ?>
            <div class="product-use-card">
                <div class="card-star-row">
                    <img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $info['is_star']; ?>.png" alt="별<?php echo $info['is_star']; ?>개" width="80">
                </div>

                <div class="card-meta">
                    <div class="card-user"><i class="far fa-user-circle"></i> <?php echo $info['is_name']; ?></div>
                    <div class="card-date"><i class="far fa-clock m-r-5"></i><?php echo substr($info['is_time'], 0, 10); ?></div>
                </div>

                <button type="button" class="card-more-btn product-use-more">후기 내용 보기 <i class="fas fa-chevron-down m-l-5"></i></button>

                <div id="sit_use_con_<?php echo $k; ?>" class="card-content-detail product-use-cont">
                    <?php echo $info['is_content']; ?>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
    </div>

    <?php echo $use_pages; ?>

    <?php 
    // 작성 폼 강제 로드
    $item_use_form_skin = dirname(__FILE__).'/itemuseform.skin.html.php';
    if (is_file($item_use_form_skin)) {
        include_once($item_use_form_skin);
    }

    // 후기가 없을 경우 폼 아래에 안내 문구 출력
    if ($use_cnt == 0) {
        echo '<div style="text-align:center; padding:30px 0 0 0; color:#888; font-size:16px; font-weight:600;">';
        echo '<i class="fas fa-info-circle m-r-5"></i> 등록된 상담후기가 없습니다.';
        echo '</div>';
    }
    ?>
</div>

<script>
$(function(){
    $(".product-use-more").off('click').on('click', function(){
        var $con = $(this).next(".product-use-cont");
        $con.slideToggle();
        $(this).find("i").toggleClass("fa-chevron-down fa-chevron-up");
    });
});
</script>