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
            1. 컨텐츠 마스터 제목 : shop020_main_overview<br>
            2. 스킨선택 : shop020_main_overview<br>
            3. 컨텐츠 아이템에서 사용할 링크수 : 1개<br>
            4. 컨텐츠 아이템에서 사용할 이미지수 : 1개<br>
            5. 컨텐츠 아이템에서 사용할 필드수 : 1개<br>
            <span class='text-indigo'>[EB 컨텐츠 - 아이템 관리]</span><br>
            1. EB컨텐츠 아이템 추가 클릭 (아이템 추가 2개 권장)<br>
            2. 텍스트 필드 #1 입력<br>
            3. 설명글 #1 입력<br>
            4. 연결주소 [링크] 입력 (자세히보기 버튼 출력)<br>
            5. 이미지 #1 업로드<br>
            <div class='margin-hr-5'></div>
            이미지 비율 : 1000x300 이미지 사용
            </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($ec_master) && $ec_master['ec_state'] == '1') { // 보이기 상태에서만 출력 ? ?>
<style>
.ebc-shop020-mo .main-overview-in .item {position:relative}
.ebc-shop020-mo .main-overview-in .item-image {margin-bottom:30px}
.ebc-shop020-mo .main-overview-in .item-content h5 {margin:0 0 20px;font-size:1.5rem;font-weight:700}
.ebc-shop020-mo .main-overview-in .item-content p {margin-bottom:30px;font-size:1.0625rem}
.ebc-shop020-mo .main-overview-in .item-content .more-btn {position:relative;color:#353535;text-decoration:none;-webkit-transition:0.3s all ease;transition:0.3s ease all;font-size:1.125rem;display:inline-block;text-align:center;width:270px;font-weight:700;padding:14px 0px;border:2px solid #3c3c3e}
.ebc-shop020-mo .main-overview-in .item-content .more-btn:hover {color:#fff}
.ebc-shop020-mo .main-overview-in .item-content .more-btn:focus {color:#fff}
.ebc-shop020-mo .main-overview-in .item-content .more-btn:before {-webkit-transition:0.5s all ease;transition:0.5s all ease;position:absolute;top:0;left:50%;right:50%;bottom:0;opacity:0;content:"";background-color:#3c3c3e;z-index:-2}
.ebc-shop020-mo .main-overview-in .item-content .more-btn:hover:before {-webkit-transition:0.5s all ease;transition:0.5s all ease;left:0;right:0;opacity:1}
.ebc-shop020-mo .main-overview-in .item-content .more-btn:focus:before {transition:0.5s all ease;left:0;right:0;opacity:1}
@media (max-width:991px) {
    .ebc-shop020-mo .main-overview-in .item {display:block;justify-content:inherit}
    .ebc-shop020-mo .main-overview-in .item-image {flex:inherit;width:100%;margin-bottom:30px}
    .ebc-shop020-mo .main-overview-in .item-content {display:block;flex-wrap:inherit;align-items:inherit;flex:inherit;width:100%;padding:0}
}
</style>

<div class="ebcontents ebc-shop020-mo">
    <?php /* ebcontents item */?>
    <?php if (is_array($contents)) { ?>
    <div class="main-overview-in">
        <div class="row">
            <?php foreach ($contents as $k => $item) { ?>
            <div class="col-lg-6">
                <div class="item item-<?php echo $k + 1 ?>">
                    <div class="item-image">
                        <img src="<?php echo $item['src_1']?>" alt="image" class="img-fluid">
                    </div>
                    <div class="item-content">
                        <div class="content-inner">
                            <?php if ($item['ci_subject_1']) { ?>
                            <h5><?php echo $item['ci_subject_1']; ?></h5>
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
        </div>
    </div>
    <?php } ?>
    <?php if ($ec_default) { ?>
    <div class="main-overview-in">
        <div class="row">
            <div class="col-lg-6">
                <div class="item">
                    <div class="item-image">
                        <img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt="image" class="img-fluid">
                    </div>
                    <div class="item-content">
                        <div class="content-inner">
                            <h5>세계적인 트렌드를 가장 먼저 만날 수 있도록</h5>
                            <p>EYOOM ELECTRONIC은 최고만을 생각합니다.<br>다양한 제품, 빠른 배송, 우수한 품질로 만족시켜 드리겠습니다.<br>이제 글로벌 전자제품 유통 브랜드로써의 도약을 시작하고 있습니다.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="item">
                    <div class="item-image">
                        <img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt="image" class="img-fluid">
                    </div>
                    <div class="item-content">
                        <div class="content-inner">
                            <h5>우수한 제품으로 고객들에게 기쁨을 드릴 수 있도록</h5>
                            <p>대한민국 최고의 전자제품 유통 브랜드로 자리매김 하겠습니다.<br>앞으로도 대한민국 전자제품 유통 대표 브랜드의 자존심을 지켜나가기 위해 최선을 다하겠습니다.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>