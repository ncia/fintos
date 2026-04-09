<?php
if (!defined('_EYOOM_')) exit;
?>
<?php /* eb콘텐츠 편집 버튼 */ ?>
<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($ec_master['ec_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:10px;text-align:center">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;thema=<?php echo $theme; ?>&amp;ec_code=<?php echo $ec_master['ec_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;"  class="ae-btn-l"><i class="far fa-edit"></i> EB컨텐츠 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;thema=<?php echo $theme; ?>&amp;ec_code=<?php echo $ec_master['ec_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="far fa-window-maximize"></i>
            </a>
            <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="
            <span class='f-s-13r'>
            <strong class='text-indigo'>좌측 [EB컨텐츠 설정하기 버튼] 클릭 후 아래 설명 참고</strong><br>
            <div class='margin-hr-5'></div>
            <span class='text-indigo'>[설정정보]</span><br>
            1. 컨텐츠 마스터 제목 : shop020_main_about<br>
            2. 스킨선택 : shop020_main_about<br>
            3. 컨텐츠 아이템에서 사용할 링크수 : 1개<br>
            4. 컨텐츠 아이템에서 사용할 이미지수 : 2개<br>
            5. 컨텐츠 아이템에서 사용할 필드수 : 2개<br>
            <span class='text-indigo'>[EB 컨텐츠 - 아이템 관리]</span><br>
            1. EB컨텐츠 아이템 추가 클릭<br>
            2. 텍스트 필드 #1 입력<br>
            3. 텍스트 필드 #2 입력<br>
            4. 설명글 #1 입력<br>
            5. 연결주소 [링크] 입력 (자세히보기 버튼 출력)<br>
            6. 이미지 #1, #2 업로드<br>
            <div class='margin-hr-5'></div>
            이미지 비율 #1(pc) : 800x800 픽셀 / #2(mobile) : 1000x300 이미지 사용.
            </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($ec_master) && $ec_master['ec_state'] == '1') { // 보이기 상태에서만 출력 ? ?>
<style>
.ebc-shop020-ma .main-about-inner .item {position:relative;display:flex;justify-content:space-between;margin-bottom:30px}
.ebc-shop020-ma .main-about-inner .item-image {position:relative;flex:0 0 auto;width:30%}
.ebc-shop020-ma .main-about-inner .item-content {display:flex;flex-wrap:wrap;align-items:center;flex:0 0 auto;width:65%;padding:0 10px}
.ebc-shop020-ma .main-about-inner .item-content h4 {margin:0 0 15px;font-size:36px;font-weight:700}
.ebc-shop020-ma .main-about-inner .item-content h5 {margin:0 0 30px;font-size:1.5rem}
.ebc-shop020-ma .main-about-inner .item-content p {margin-bottom:30px;font-size:1.0625rem}
.ebc-shop020-ma .main-about-inner .item-content .more-btn {position:relative;color:#353535;text-decoration:none;-webkit-transition:0.3s all ease;transition:0.3s ease all;font-size:1.125rem;display:inline-block;text-align:center;width:270px;font-weight:700;padding:14px 0px;border:2px solid #3c3c3e}
.ebc-shop020-ma .main-about-inner .item-content .more-btn:hover {color:#fff}
.ebc-shop020-ma .main-about-inner .item-content .more-btn:focus {color:#fff}
.ebc-shop020-ma .main-about-inner .item-content .more-btn:before {-webkit-transition:0.5s all ease;transition:0.5s all ease;position:absolute;top:0;left:50%;right:50%;bottom:0;opacity:0;content:"";background-color:#3c3c3e;z-index:-2}
.ebc-shop020-ma .main-about-inner .item-content .more-btn:hover:before {-webkit-transition:0.5s all ease;transition:0.5s all ease;left:0;right:0;opacity:1}
.ebc-shop020-ma .main-about-inner .item-content .more-btn:focus:before {transition:0.5s all ease;left:0;right:0;opacity:1}
@media (max-width:991px) {
    .ebc-shop020-ma .main-about-inner .item {display:block;justify-content:inherit}
    .ebc-shop020-ma .main-about-inner .item-image {flex:inherit;width:100%;margin-bottom:30px}
    .ebc-shop020-ma .main-about-inner .item-content {display:block;flex-wrap:inherit;align-items:inherit;flex:inherit;width:100%;padding:0}
}
</style>

<div class="ebcontents ebc-shop020-ma">
    <?php /* ebcontents item */?>
    <?php if (is_array($contents)) { ?>
    <?php foreach ($contents as $k => $item) { ?>
    <div class="main-about-inner">
        <div class="item item-<?php echo $k + 1 ?>">
            <div class="item-image">
                <picture>
                    <source srcset="<?php echo $item['src_1']?>" media="(min-width:992px)">
                    <source srcset="<?php echo $item['src_2']?>" media="(max-width:991px)">
                    <img src="<?php echo $item['src_1']?>" alt="image" class="img-fluid">
                </picture>
            </div>
            <div class="item-content">
                <div class="content-inner">
                    <?php if ($item['ci_subject_1']) { ?>
                    <h4><?php echo $item['ci_subject_1']; ?></h4>
                    <?php } ?>
                    <?php if ($item['ci_subject_2']) { ?>
                    <h5><?php echo $item['ci_subject_2']; ?></h5>
                    <?php } ?>
                    <?php if ($item['ci_text_1']) { ?>
                    <p><?php echo $item['ci_text_1']; ?></p>
                    <?php } ?>
                    <?php if ($item['href_1']) { ?>
                    <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>" class="more-btn">자세히 보기<i class="fas fa-angle-right m-l-7"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php if ($ec_default) { ?>
    <div class="main-about-inner">
        <div class="item">
            <div class="item-image">
                <picture>
                    <source srcset="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" media="(min-width:992px)">
                    <source srcset="<?php echo $ebcontents_skin_url; ?>/image/01m.jpg" media="(max-width:991px)">
                    <img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt="image" class="img-fluid">
                </picture>
            </div>
            <div class="item-content">
                <div class="content-inner">
                    <h4 class="en-font">About The Best Brand</h4>
                    <h5>EYOOM ELECTRONIC의 큰 자부심으로 앞선 미래를 제시합니다.</h5>
                    <p>EYOOM ELECTRONIC은 온라인 가전 제품, 휴대용 전자 제품 전문 쇼핑몰입니다.<br>다년간의 쇼핑몰 노하우를 바탕으로 정품보장, 친절상담, 빠른배송으로 고객님께 최고의 서비스를 제공해 드리고 있습니다.<br>항상 최상의 친절과 믿을수 있는 제품으로 만족한 쇼핑을 제공해 드리도록 하겠습니다.</p>
                    <a href="#" class="more-btn">자세히 보기<i class="fas fa-angle-right m-l-7"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>