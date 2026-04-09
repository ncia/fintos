<?php
if (!defined('_EYOOM_')) exit;
?>
<?php /* eb콘텐츠 편집 버튼 */ ?>
<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:0;text-align:right;z-index:2">
    <div class="btn-group">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;thema=<?php echo $theme; ?>&amp;ec_code=<?php echo $ec_master['ec_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB컨텐츠 마스터 설정</a>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;thema=<?php echo $theme; ?>&amp;ec_code=<?php echo $ec_master['ec_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
            <i class="fas fa-external-link-alt"></i>
        </a>
        <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-html="true" data-bs-content="
            <span class='f-s-13r'>
            <strong class='text-indigo'>좌측 [EB컨텐츠 설정하기 버튼] 클릭 후 아래 설명 참고</strong><br>
            <div class='margin-hr-5'></div>
            <span class='text-indigo'>[설정정보]</span><br>
            1. 컨텐츠 마스터 제목 : shop020_sns_link<br>
            2. 스킨선택 : shop020_sns_link<br>
            3. 컨텐츠 아이템에서 사용할 링크수 : 1개<br>
            3. 컨텐츠 아이템에서 사용할 필드수 : 1개<br>
            <span class='text-indigo'>[EB 컨텐츠 - 아이템 관리]</span><br>
            1. EB컨텐츠 아이템 추가 클릭<br>
            2. 텍스트 필드 #1 입력 (소셜아이콘 클래스명 입력 - 아래 참고)<br>
            <div class='margin-hr-5'></div>
            페이스북 : <span class='text-crimson'>social_facebook</span><br>
            트위터 : <span class='text-crimson'>social_twitter</span><br>
            구글+ : <span class='text-crimson'>social_google</span><br>
            유튜브 : <span class='text-crimson'>social_youtube</span><br>
            인스타그램 : <span class='text-crimson'>social_instagram</span><br>
            밴드 : <span class='text-crimson'>social_band</span><br>
            카카오스토리 : <span class='text-crimson'>social_kakaostory</span><br>
            핀터레스트 : <span class='text-crimson'>social_pinterest</span><br>
            텀블러 : <span class='text-crimson'>social_tumblr</span><br>
            네이버 : <span class='text-crimson'>social_naver</span><br>
            <div class='margin-hr-5'></div>
            3. 연결주소 [링크] #1 입력<br>
            <div class='margin-hr-5'></div>
            SNS 아이콘 링크 연결 <br>
            </span>
        "><i class="fas fa-question-circle"></i></button>
    </div>
</div>
<?php } ?>

<?php if (isset($ec_master) && $ec_master['ec_state'] == '1') { // 보이기 상태에서만 출력 ? ?>
<style>
.shop020-sl-contents-wrap {position:relative;margin-bottom:10px}
.shop020-sl-contents {position:relative;margin-bottom:0}
</style>

<div class="shop020-sl-contents-wrap">
    <dl class="shop020-sl-contents">
        <?php /* ebcontents item */?>
        <?php if (is_array($contents)) { ?>
        <ul class="social-icons">
        <?php foreach ($contents as $k => $item) { ?>
            <?php if ($item['ci_subject_1']) { ?>
            <li><a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>" class="<?php echo $item['ci_subject_1']; ?>"></a></li>
            <?php } ?>
        <?php } ?>
        </ul>
        <?php } ?>

        <?php if ($ec_default) { ?>
        <ul class="social-icons">
            <li><a href="#" class="social_facebook"></a></li>
            <li><a href="#" class="social_twitter"></a></li>
            <li><a href="#" class="social_google"></a></li>
            <li><a href="#" class="social_kakaostory"></a></li>
            <li><a href="#" class="social_band"></a></li>
            <li><a href="#" class="social_youtube"></a></li>
            <li><a href="#" class="social_instagram"></a></li>
            <li><a href="#" class="social_pinterest"></a></li>
            <li><a href="#" class="social_behance"></a></li>
            <li><a href="#" class="social_tumblr"></a></li>
            <li><a href="#" class="social_kakao"></a></li>
            <li><a href="#" class="social_naver"></a></li>
        </ul>
        <?php } ?>
    </dl>
</div>
<?php } ?>