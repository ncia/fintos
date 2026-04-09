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
            1. 컨텐츠 마스터 제목 : shop020_main_contact<br>
            2. 스킨선택 : shop020_main_contact<br>
            3. 컨텐츠 아이템에서 사용할 링크수 : 0개<br>
            4. 컨텐츠 아이템에서 사용할 이미지수 : 0개<br>
            5. 컨텐츠 아이템에서 사용할 필드수 : 0개<br>
            <span class='text-indigo'>[EB 컨텐츠 - 아이템 관리]</span><br>
            1. EB컨텐츠 아이템 추가 클릭<br>
            2. 설명글 #1 입력(구글지도 iframe)<br>
            <div class='margin-hr-5'></div>
            구글지도는 설명글 #1에 구글지도 iframe을 입력<br>
            ifrmae에 width 값은 100%로 변경
            </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($ec_master) && $ec_master['ec_state'] == '1') { // 보이기 상태에서만 출력 ? ?>
<style>
.ebc-shop020-mc {position:relative}
.ebc-shop020-mc .contact-map {border:1px solid #757575;padding:5px 5px 0}
.ebc-shop020-mc .contact-info {margin-top:20px}
.ebc-shop020-mc .contact-info dl {display:flex;margin:0}
.ebc-shop020-mc .contact-info dl dt {flex:0 0 auto;width:20%;padding:15px 20px;border-bottom:1px solid #757575}
.ebc-shop020-mc .contact-info dl dt h6 {margin:0;font-size:1rem;font-weight:700}
.ebc-shop020-mc .contact-info dl dd {flex:0 0 auto;width:80%;padding:15px 20px;font-size:1rem;color:#757575;border-bottom:1px solid #d5d5d5}
@media (max-width:991px){
    .ebc-shop020-mc .contact-info dl dt {width:35%}
    .ebc-shop020-mc .contact-info dl dd {width:65%}
}
@media (max-width:767px){
    .ebc-shop020-mc .contact-info dl {display:block}
    .ebc-shop020-mc .contact-info dl dt {flex:inherit;width:100%;border-bottom:1px solid #d5d5d5}
    .ebc-shop020-mc .contact-info dl dd {flex:inherit;width:100%;border-bottom:1px solid #757575}
    .ebc-shop020-mc .contact-info dl dt h6, .ebc-shop020-mc .contact-info dl dd {font-size:.9375rem}
}
</style>
<div class="ebcontents ebc-shop020-mc">
    <div class="ebcontents-wrap">
        <div class="item">
            <?php /* ebcontents item */?>
            <?php if (is_array($contents)) { ?>
                <?php foreach ($contents as $k => $item) { ?>
                <?php /* 지도 */ ?>
                <?php if ($item['ci_text_1']) { ?>
                <div class="contact-map"><?php echo $item['ci_text_1']; ?></div>
                <?php } ?>
                <?php } ?>
            <?php } ?>

            <?php if ($ec_default) { ?>
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12648.77860160617!2d126.96583158747414!3d37.57403390000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca2eb421c44ad%3A0xe955a50c118085f8!2z6rSR7ZmU66y46rSR7J6l!5e0!3m2!1sko!2skr!4v1653275791844!5m2!1sko!2skr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <?php } ?>
        </div>
	        
        <div class="item">
            <?php /* 회사정보 */ ?>
            <div class="contact-info">
                <dl>
                    <dt><h6>회사명</h6></dt>
                    <dd><?php echo $bizinfo['bi_company_name'] ?></dd>
                </dl>
                <dl>
                    <dt><h6>대표이사</h6></dt>
                    <dd><?php echo $bizinfo['bi_company_ceo'] ?></dd>
                </dl>
                <dl>
                    <dt><h6>주소</h6></dt>
                    <dd><?php echo $bizinfo['bi_company_addr1'] ?> <?php echo $bizinfo['bi_company_addr2'] ?> <?php echo $bizinfo['bi_company_addr3'] ?></dd>
                </dl>
                <dl>
                    <dt><h6>사업자등록번호</h6></dt>
                    <dd><?php echo $bizinfo['bi_company_bizno'] ?></dd>
                </dl>
                <dl>
                    <dt><h6>통신판매업신고번호</h6></dt>
                    <dd><?php echo $bizinfo['bi_company_sellno'] ?></dd>
                </dl>
                <dl>
                    <dt><h6>대표전화</h6></dt>
                    <dd><?php echo $bizinfo['bi_company_tel'] ?></dd>
                </dl>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <p class="color-red m-t-20"><i class="fas fa-exclamation-circle"></i> 하단 기업 정보 설정에서 내용 입력(편집모드 on 일때 보임)</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>