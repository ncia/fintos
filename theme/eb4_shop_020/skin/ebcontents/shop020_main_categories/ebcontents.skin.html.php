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
            1. 컨텐츠 마스터 제목 : shop020_main_categries<br>
            2. 스킨선택 : shop020_main_categries<br>
            3. 컨텐츠 아이템에서 사용할 링크수 : 9개<br>
            4. 컨텐츠 아이템에서 사용할 이미지수 : 9개<br>
            5. 컨텐츠 아이템에서 사용할 필드수 : 9개<br>
            <span class='text-indigo'>[EB 컨텐츠 - 아이템 관리]</span><br>
            1. EB컨텐츠 아이템 추가 클릭<br>
            2. 텍스트 필드 #1 ~ #9 입력<br>
            3. 연결주소 [링크] #1 ~ #9 입력<br>
            4. 이미지 #1 ~ #9 업로드 (카테고리 아이콘 이미지)<br>
            <div class='margin-hr-5'></div>
            이미지 비율 : 80x80 픽셀 이미지 사용<br>
            png 배경 투명 아이콘 이미지 권장<br>
            <span class='text-crimson'>주요 카테고리 9개만 선별하여 입력하세요.</span>
            </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($ec_master) && $ec_master['ec_state'] == '1') { // 보이기 상태에서만 출력 ? ?>
<style>
.ebc-shop020-mc-wrap {position:relative;margin-bottom:20px}
.ebc-shop020-mc {margin-left:-4px;margin-right:-4px}
.ebc-shop020-mc .ebc-shop020-mc-item {position:relative}
.ebc-shop020-mc .ebc-shop020-mc-item:after {content:"";display:block;clear:both}
.ebc-shop020-mc .ebc-shop020-mc-box {float:left;width:33.33333%;padding:4px}
.ebc-shop020-mc .ebc-shop020-mc-box-in {position:relative;background:#fff;border:1px solid #e5e5e5;height:80px;padding:10px 0 0;-webkit-transition:all .3s ease;transition:all .3s ease}
.ebc-shop020-mc .ebc-shop020-mc-box-in:hover {border-color:#959595}
.ebc-shop020-mc .ebc-shop020-mc-box .ebc-shop020-mc-img {width:40px;height:40px;margin:0 auto 5px}
.ebc-shop020-mc .ebc-shop020-mc-box img {display:block;max-width:100%;height:auto;margin:0 auto}
.ebc-shop020-mc .ebc-shop020-mc-box h3 {text-align:center;font-size:.6875rem;color:#000}
.ebc-shop020-mc .ebc-shop020-mc-box-in:hover h3 {text-decoration:underline}

/* 다크모드 설정 */
body.dark-mode .ebc-shop020-mc .ebc-shop020-mc-box-in {background-color: #161b22;border-color: #333;}
body.dark-mode .ebc-shop020-mc .ebc-shop020-mc-box img {filter: invert(1);}
body.dark-mode .ebc-shop020-mc .ebc-shop020-mc-box h3 {color: #fff;}

@media (max-width:576px) {
    .ebc-shop020-mc-wrap {margin:0 0 30px}
}
</style>

<div class="ebcontents ebc-shop020-mc-wrap">
    <?php /* ebcontents master */?>
    <?php if ($ec_master['ec_subject_1']) { ?>
    <div class="headline-short">
        <h6 class="m-b-20 f-s-15r"><?php echo $ec_master['ec_subject_1']; ?></h6>
    </div>
    <?php } ?>
    <?php /* ebcontents item */?>
    <?php if (is_array($contents)) { ?>
    <div class="ebc-shop020-mc">
        <div class="ebc-shop020-mc-item">
            <?php foreach ($contents as $k => $item) { ?>
            <?php if($item['src_1']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_1']) { ?>
                <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_1']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_1']; ?></h3>
                    </div>
                <?php if ($item['href_1']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_2']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_2']) { ?>
                <a href="<?php echo $item['href_2']; ?>" target="<?php echo $item['target_2']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_2']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_2']; ?></h3>
                    </div>
                <?php if ($item['href_2']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_3']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_3']) { ?>
                <a href="<?php echo $item['href_3']; ?>" target="<?php echo $item['target_3']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_3']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_3']; ?></h3>
                    </div>
                <?php if ($item['href_3']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_4']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_4']) { ?>
                <a href="<?php echo $item['href_4']; ?>" target="<?php echo $item['target_4']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_4']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_4']; ?></h3>
                    </div>
                <?php if ($item['href_4']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_5']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_5']) { ?>
                <a href="<?php echo $item['href_5']; ?>" target="<?php echo $item['target_5']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_5']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_5']; ?></h3>
                    </div>
                <?php if ($item['href_5']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_6']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_6']) { ?>
                <a href="<?php echo $item['href_6']; ?>" target="<?php echo $item['target_6']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_6']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_6']; ?></h3>
                    </div>
                <?php if ($item['href_6']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_7']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_7']) { ?>
                <a href="<?php echo $item['href_7']; ?>" target="<?php echo $item['target_7']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_7']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_7']; ?></h3>
                    </div>
                <?php if ($item['href_7']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_8']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_8']) { ?>
                <a href="<?php echo $item['href_8']; ?>" target="<?php echo $item['target_8']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_8']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_8']; ?></h3>
                    </div>
                <?php if ($item['href_8']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if($item['src_9']) { ?>
            <div class="ebc-shop020-mc-box">
                <?php if ($item['href_9']) { ?>
                <a href="<?php echo $item['href_9']; ?>" target="<?php echo $item['target_9']; ?>">
                <?php } ?>
                    <div class="ebc-shop020-mc-box-in">
                        <div class="ebc-shop020-mc-img">
                            <img src="<?php echo $item['src_9']?>" alt="">
                        </div>
                        <h3><?php echo $item['ci_subject_9']; ?></h3>
                    </div>
                <?php if ($item['href_9']) { ?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if ($ec_default) { ?>
    <div class="ebc-shop020-mc">
        <div class="ebc-shop020-mc-item">
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리1</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리2</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리3</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리4</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리5</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리6</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리7</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리8</h3>
                </div>
            </div>
            <div class="ebc-shop020-mc-box">
                <div class="ebc-shop020-mc-box-in">
                    <div class="ebc-shop020-mc-img"><img src="<?php echo $ebcontents_skin_url; ?>/image/01.jpg" alt=""></div>
                    <h3>카테고리9</h3>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>