<?php
/**
 * page file : //theme/eb4_shop_020/page/manual.html.php
 */
if (!defined('_EYOOM_')) exit;
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
@media (min-width: 992px){
    .theme-manual .row > .col-lg-2 {padding-right:0}
    .theme-manual .row > .col-lg-10 {padding-left:0}
}
/* 탭 네비 */
.theme-manual .tab-nav button {display:block;width:100%;margin-bottom:5px;color:#707070;border:0 none;padding:10px}
.theme-manual .tab-nav button:hover {background-color:#dedede}
.theme-manual .tab-nav button.active {color:#fff;background-color:#59595b}
/* 탭 콘텐츠 */
.theme-manual .tab-content {padding:30px;border:2px solid #59595b}
/* 타이틀 */
.theme-manual h3 {position:relative;font-size:20px;line-height:26px;font-weight:bold;border-bottom:1px solid #656565;padding:0 0 10px 15px;margin:0 0 10px}
.theme-manual h3 .title-bar {position:absolute;top:0;left:0;display:inline-block;width:5px;height:26px;background:#6284F3}
/* 테마 설치 */
.install-step {margin-bottom:30px}
.install-step {padding:15px;background:#f8f8f8;box-shadow:0 0 1px rgba(0,0,0,0.35)}
.install-step h5 {margin:0 0 10px;font-size:1rem;position:relative}
.install-step h5 small {display:inline-block;height:48px;padding:7px 9px;margin-right:10px;background:#314b52;color:#fff;font-size:11px;text-align:center;text-transform:uppercase;vertical-align:middle}
.install-step h5 small span {font-size:1.125rem;display:block;margin-top:2px}
.install-step p {line-height:24px;color:#707070;margin:10px 0 0;padding-left:30px;position:relative;word-break:keep-all}
.install-step p span {display:inline-block;position:absolute;left:0;top:0;width:24px;height:24px;line-height:24px;text-align:center;margin-right:5px;color:#fff;background:#cc2300;border-radius:100% !important}
.full-img {box-shadow:0 0 1px rgba(0,0,0,0.8);max-width:600px;margin:0 auto}
@media (min-width:1200px){
    .theme-step-1 , .theme-step-2 {height:550px}
    .theme-step-3 , .theme-step-4 {height:360px}
    .theme-step-5 , .theme-step-6 {height:720px}
}
/* 테마 설명과 설정 */
.theme-setup ul li {position:relative;margin-bottom:10px;padding-left:20px;}
.theme-setup ul li i {position:absolute;left:0;top:3px;color:#ccc}
.theme-setup ul li ul li {margin:5px 0 0;padding:0}
/* 테마 편집모드 */
.theme-editmode h5 {margin:0 0 10px;font-weight:700;font-size:1.125rem}
.theme-editmode h6 {margin:0 0 5px;font-weight:700;font-size:.9375rem;color:#555}
.theme-editmode .editmode-img-box {padding:10px;margin-bottom:10px;border:1px solid #959595}
/* 테마 패치내역 */
.patch-list h5 {margin:0 0 10px;padding:10px;font-size:1rem;border-left:2px solid #999;background:#eee;color:#c0392b}
.patch-list li {position:relative;padding-left:10px}
.patch-list li span {position:absolute;left:0;top:0}
@media (max-width:991px){
    .theme-manual .tab-std .tab-nav-left {padding:0 !important;margin-bottom:10px}
}
</style>

<div class="theme-manual">
    <div class="row">
        <div class="col-lg-2">
            <div class="tab-nav nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-1st-tab" data-bs-toggle="pill" data-bs-target="#v-pills-1st" type="button" role="tab" aria-controls="v-pills-1st" aria-selected="true">테마 다운로드</button>
                <button class="nav-link" id="v-pills-2nd-tab" data-bs-toggle="pill" data-bs-target="#v-pills-2nd" type="button" role="tab" aria-controls="v-pills-2nd" aria-selected="false">테마 설치</button>
                <button class="nav-link" id="v-pills-3rd-tab" data-bs-toggle="pill" data-bs-target="#v-pills-3rd" type="button" role="tab" aria-controls="v-pills-3rd" aria-selected="false">테마 설명과 설정</button>
                <button class="nav-link" id="v-pills-4th-tab" data-bs-toggle="pill" data-bs-target="#v-pills-4th" type="button" role="tab" aria-controls="v-pills-4th" aria-selected="false">테마 편집모드</button>
                <button class="nav-link" id="v-pills-5th-tab" data-bs-toggle="pill" data-bs-target="#v-pills-5th" type="button" role="tab" aria-controls="v-pills-5th" aria-selected="false">테마 패치내역</button>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-1st" role="tabpanel" aria-labelledby="v-pills-1st-tab">
                    <?php /* 테마 다운로드 */ ?>
                    <div class="theme-download">
                        <h3><span class="title-bar"></span> 테마 다운로드와 테마 키 확인(이윰넷에서 구매한 경우)</h3>
                        <p class="m-b-30">이윰넷에서 <strong>유료 테마</strong>를 스킨상점에서 구매하며 구매가 완료됐다면 <strong>마이페이지 &gt; 다운로드 관리 &gt; <span class="text-crimson">테마관리</span></strong>에서 테마키 확인 및 다운로드가 가능합니다.</p>
                        <div class="m-b-50">
                            <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/theme_manage.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/theme_manage.jpg" alt="image" class="img-fluid"></a>
                        </div>

                        <h3><span class="title-bar"></span> 테마 다운로드와 주문번호 확인(sir.kr 콘텐츠몰에서 구매한 경우)</h3>
                        <p class="m-b-30">sir.kr 콘텐츠몰에서 구매를 한 경우 sir.kr에서 테마 다운로드를 받을 수 있으며 주문번호를 확인합니다.<br>주문번호는 테마 설치시 입력 사항 입니다.</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-2nd" role="tabpanel" aria-labelledby="v-pills-2nd-tab">
                    <?php /* 테마 설치 */ ?>
                    <div class="theme-install">
                        <div class="install-box">
                            <div class="sub-page-title" id="install_theme">
                                <h3><span class="title-bar"></span> 유료 테마 설치</h3>
                                <p class="m-b-30">영카트5 + 빌더 + 베이직테마가 설치된 상태에서 구매한 <strong class="text-deep-orange">유료 테마 설치</strong> 과정입니다.</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="install-step theme-step-1">
                                        <h5><small>step <span>01</span></small> 다운로드 파일 확인 및 압축 풀기</h5>
                                        <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img01.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img01.jpg" alt="image" class="img-fluid"></a>
                                        <p><span>1</span> 압축 프로그램을 통해 해당 파일 압축을 풉니다.</p>
                                        <p><span class="bg-orange"><i class="fa fa-exclamation"></i></span> <strong class="text-crimson f-s-20r">[ 중요! ]</strong></p>
                                        <p><i><strong class="text-black">'<strong class="text-crimson">알집</strong>'으로 압축해제시 파일이 정상적으로 해제가 안될 수 있으며, 정상설치가 되지 않아 에러가 발생합니다.<br>반드시 '<strong class="text-crimson">7-zip, 반디집</strong>' 등을 사용해 압축 해제하시기 바랍니다.</strong></i></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="install-step theme-step-2">
                                        <h5><small>step <span>02</span></small> 폴더와 파일 리스트</h5>
                                        <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img02.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img02.jpg" alt="image" class="img-fluid"></a>
                                        <p><span><i class="fa fa-info"></i></span> 디자인된 테마와 데모 사이트 콘텐츠 설정등의 파일 목록 입니다.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="install-step theme-step-3">
                                        <h5><small>step <span>03</span></small> ftp 프로그램을 통해 테마 업로드</h5>
                                        <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img03.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img03.jpg" alt="image" class="img-fluid"></a>
                                        <p><span>1</span> ftp 프로그램(파일질라, 알ftp등)을 통해 서버로 파일 업로드 합니다.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="install-step theme-step-4">
                                        <h5><small>step <span>04</span></small> 테마설치하기</h5>
                                        <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img04.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img04.jpg" alt="image" class="img-fluid"></a>
                                        <p><span>1</span> 사이트 '<strong>관리자 모드 &gt; 테마설정관리 &gt; 테마관리</strong>' 로 이동해 업로드한 테마의 '<strong class="text-crimson">테마설치하기</strong>' 버튼을 클릭합니다.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="install-step theme-step-5">
                                        <h5><small>step <span>05</span></small> 테마키 또는 상품주문번호 입력하기</h5>
                                        <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img05.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img05.jpg" alt="image" class="img-fluid"></a>
                                        <p><span>1</span> 이윰 라이선스를 확인 후 동의 체크합니다.</p>
                                        <p><span>2</span> 구매한 테마키 또는 상품주문번호를 입력 후 '설치하기'를 클릭합니다.<br>(<strong class="text-crimson">이윰넷</strong>에서 구매한 경우 <strong class="text-crimson">테마키</strong>를 <strong class="text-indigo">sir.kr 콘텐츠몰</strong>에서 구매한 경우 <strong class="text-indigo">상품주문번호</strong>를 입력)</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="install-step theme-step-6">
                                        <h5><small>step <span>06</span></small> tmp폴더 삭제</h5>
                                        <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img06.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img06.jpg" alt="image" class="img-fluid"></a>
                                        <p><span>1</span> 테마설치 완료후 업로드한 <strong class="text-crimson">tmp폴더</strong>를 삭제합니다.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="install-step theme-step-7">
                                        <h5><small>step <span>07</span></small> 최초 메인 페이지</h5>
                                        <a class="image-popup-vertical-fit" href="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img07.jpg"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/install_theme_img07.jpg" alt="image" class="img-fluid"></a>

                                        <p><span>1</span> 설치된 테마를 <strong>홈페이지테마적용</strong>을 하면 해당 테마가 출력되며 우측 <strong>미리보기</strong>를 클릭하면 해당 테마를 미리 볼 수 있습니다.</p>
                                        <p><span>2</span> 관리자 로그인 후 <strong class="text-crimson">편집모드</strong>를 활성화 시키면 화면상에서 로고, 메뉴, EB슬라이더, EB콘텐츠, EB최신글 등의 설정을 불러와 설정할 수 있습니다.</p>
                                        <p><span><i class="fa fa-info"></i></span> <strong>[중요]</strong> 최초 설치 후 관리자로 로그인해 <strong class="text-crimson">관리자 모드 &lt; 환경설정 &lt; 기본환경설정</strong>에 접속해 <strong class="text-crimson">확인</strong>을 한번 클릭하기 바랍니다.<br>(모바일 관련 함수 설정을 위함이며 그래야 모바일에서 정상적인 레이아웃 출력됩니다.)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-3rd" role="tabpanel" aria-labelledby="v-pills-3rd-tab">
                <?php /* 테마 설명과 설정 */ ?>
                    <div class="theme-setup">
                        <h3><span class="title-bar"></span> 테마 설명 및 특이사항</h3>
                        <p class="m-b-30">테마에 대한 <strong class="text-crimson">설명</strong>과 <strong class="text-crimson">특이사항</strong> 등을 읽고 테마설치 및 사용에 참고하기 바랍니다.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-minus"></i> 본 테마는 <strong class="text-crimson">쇼핑몰 테마</strong>이며, 쇼핑몰 레이아웃과 동일하게 커뮤니티 레이아웃도 출력됩니다.</li>
                            <li><i class="fas fa-minus"></i> 설치시 상품 등록은 지원하지 않기에 데모사이트와 같이 상품 출력 된 레이아웃은 출력되지 않습니다.(직접 관리자모드에서 상품 입력 해야합니다.)</li>
                            <li><i class="fas fa-minus"></i> 쇼핑몰 설정 및 상품등록등에 관련해서는 sir.kr의 영카트5 매뉴얼(<a href="https://sir.kr/manual/yc5" target="_blank"><u class="text-blue">https://sir.kr/manual/yc5</u></a>)을 참고하시기 바랍니다.</li>
                            <li><i class="fas fa-minus"></i> 쇼핑몰 상품 등록(관리자 - 쇼핑몰관리 - 상품관리 - 상품등록)시 상품 이미지는 <span class="text-crimson">1000x1000픽셀</span> 비율의 이미지를 업로드합니다.</li>
                            <li>
                                <i class="fas fa-minus"></i> <strong>관리자 - 테마설정관리 - 테마환경설정</strong>
                                <p class="li-p-sq"><span class="text-indigo">메인설정</span> : 쇼핑몰 메인 (<span class="text-teal">본 테마의 컨셉은 쇼핑몰이 주입니다. 커뮤니티 메인이 아닌 쇼핑몰 메인으로 설정하여 사용하십시오.</span>)</p>
                                <p class="li-p-sq"><span class="text-indigo">커뮤니티 기능 사용여부</span> : 미사용</p>
                                <p class="li-p-sq">본 테마는 사이드 레이아웃, 비반응형, 박스형, 상단메뉴 스크롤 고정을 지원하지 않습니다.</p>
                            </li>
                            <li>
                                <i class="fas fa-minus"></i> <strong>관리자 - 쇼핑몰관리 - 쇼핑몰설정의 '쇼핑몰 초기화면'</strong>
                                <p class="li-p-sq"><span class="text-indigo">히트상품출력</span> : 스킨(main.10.skin.php:슬라이드형) / 1줄당 이미지 수(8) / 출력할 줄 수(1) / 이미지폭(400) / 이미지높이(0)</p>
                                <p class="li-p-sq"><span class="text-indigo">추천상품출력</span> : 스킨(main.20.skin.php:슬라이드형) / 1줄당 이미지 수(8) / 출력할 줄 수(1) / 이미지폭(400) / 이미지높이(0)</p>
                                <p class="li-p-sq"><span class="text-indigo">최신상품출력</span> : 스킨(main.30.skin.php:슬라이드형) / 1줄당 이미지 수(8) / 출력할 줄 수(1) / 이미지폭(400) / 이미지높이(0)</p>
                                <p class="li-p-sq"><span class="text-indigo">인기상품출력</span> : 스킨(main.40.skin.php:슬라이드형) / 1줄당 이미지 수(8) / 출력할 줄 수(1) / 이미지폭(400) / 이미지높이(0)</p>
                                <p class="li-p-sq"><span class="text-indigo">할인상품출력</span> : 스킨(main.50.skin.php:슬라이드형) / 1줄당 이미지 수(8) / 출력할 줄 수(1) / 이미지폭(400) / 이미지높이(0)</p>
                                <p class="li-p-sq">상품 출력 수는 1줄당 이미지 수와 출력할 줄 수의 곱으로 출력됩니다.</p>
                                <p class="li-p-sq">main.10.skin.php, main.20.skin.php, main.40.skin.php, main.50.skin.php 스킨은 슬라이드형으로 중복 사용시 클래스명 충돌로 오류가 발생하니 중복 사용이 안됩니다.</p>
                            </li>
                            <li>
                                <i class="fas fa-minus"></i> <strong>관리자 - 쇼핑몰관리 - 쇼핑몰설정의 '기타 설정'</strong>
                                <p class="li-p-sq">이미지폭(600) / 이미지높이(0)</p>
                                <p class="li-p-sq">상품 출력 수는 1줄당 이미지 수와 출력할 줄 수의 곱으로 출력되며 정렬은 해당 스킨 파일에서 수정합니다.</p>
                                <p class="li-p-sq">이미지(소) : 폭(400) / 높이(0)</p>
                                <p class="li-p-sq">이미지(중) : 폭(1000) / 높이(0)</p>
                            </li>
                            <li><i class="fas fa-minus"></i> <strong>관리자 - 쇼핑몰현황/기타 - 이벤트관리</strong>에서 이벤트 설정</li>
                            <li><i class="fas fa-minus"></i> 본 테마는 <strong>다크모드</strong>를 지원하며, 다크모드 사용을 원치 않으시면<br>/theme/eb4_shop_020/head.heml.php파일 15라인과<br>/theme/eb4_shop_020/shop/shop.head.html.php파일 25라인의<br>아래 소스를 <strong>no</strong>로 설정하시기 바랍니다.<br><code>$is_darkmode = 'no';</code></li>
                            <li><i class="fas fa-minus"></i> <strong>다크모드</strong> CSS 수정은 /theme/eb4_shop_020/css/dark_mode.css 파일에서 수정 또는 추가하시면 됩니다.</li>
                            <li><i class="fas fa-minus"></i> <strong>다크모드</strong> 사용 시 스마트에디터는 적합하지 않습니다. 아래 링크의 CKEditor를 꼭 적용하여 사용하시기 바랍니다.<br><a href="https://eyoom.net/share/4" target="_blank"><u class="text-blue">https://eyoom.net/share/4</u></a></li>
                            <li><i class="fas fa-minus"></i> 관리자는 상단 <strong>편집모드</strong>를 통해 내용 및 이미지 수정이 가능하며, 상품 등록 후에도 개별상품 설정이 가능합니다.</li>
                            <li><i class="fas fa-minus"></i> 전반적인 이윰빌더의 매뉴얼은 <strong>이윰빌더 매뉴얼</strong>(<a href="https://eyoom.net/page/eb4_manual_eyoom" target="_blank"><u class="text-blue">https://eyoom.net/page/eb4_manual_eyoom</u></a>)을 참고하시기 바랍니다.</li>
                            <li><i class="fas fa-minus"></i> 스타일과 레이아웃 수정은 에디터 프로그램으로 직접 파일을 열어 수정해야 하며 <strong>테마 구조(스킨 포함)</strong>(<a href="https://eyoom.net/page/eb4_manual_02_2" target="_blank"><u class="text-blue">https://eyoom.net/page/eb4_manual_02_2</u></a>)에서 구조를 참고하시기 바랍니다.</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-4th" role="tabpanel" aria-labelledby="v-pills-4th-tab">
                <?php /* 테마 편집모드 */ ?>
                    <div class="theme-editmode">
                        <h3><span class="title-bar"></span> 테마 편집모드</h3>
                        <p class="m-b-30">편집 모드를 통해 로고, 메뉴, 회사정보 입력은 물론 사이트 콘텐츠의 이미지와 텍스트를 보여지는 화면에서 바로 수정이 가능합니다.<br>
                            <strong class="text-crimson">편집모드란?</strong> <a href="https://eyoom.net/page/?pid=eb4_editmode" target="_blank"><i class="fas fa-link"></i> 관련링크 바로가기</a>
                        </p>

                        <div class="row">
                            <div class="col-lg-7 lg-m-b-30">
                                <div class="editmode-img-box">
                                    <img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/manual/theme_main_01.jpg" alt="image" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <h5>공용 레이아웃(헤더,푸터,사이드)</h5>
                                <p class="li-p-sq">로고설정</p>
                                <p class="li-p-sq">메뉴설정</p>
                                <p class="li-p-sq">사이트정보설정</p>
                                <p class="li-p-sq">[EB슬라이더] shop020_top_banner</p>
                                <p class="li-p-sq">[EB최신글] shop020_footer</p>
                                <p class="li-p-sq m-b-30">[EB콘텐츠] shop020_sns_link</p>
                        
                                <h5>메인</h5>
                                <p class="li-p-sq">[EB콘텐츠] shop020_main_categories</p>
                                <p class="li-p-sq">[EB상품추출] shop020_best (<span class="text-crimson">쇼핑몰 메인에서 카테고리별 판매순위 3위까지 상품 추출</span>)</p>
                                <p class="li-p-sq">[EB상품추출] shop020_main (<span class="text-crimson">쇼핑몰 메인에서 카테고리별로 상품 추출</span>)</p>
                                <p class="li-p-sq">[EB슬라이더] shop020_main_1</p>
                                <p class="li-p-sq">[EB슬라이더] shop020_main_2</p>
                                <p class="li-p-sq">[EB슬라이더] shop020_main_3</p>
                                <p class="li-p-sq">[EB슬라이더] shop020_main_4</p>
                                <p class="li-p-sq">[EB슬라이더] shop020_main_5</p>
                                <p class="li-p-sq">[EB슬라이더] shop020_main_6 (<span class="text-crimson">유튜브 동영상 출력 가능</span>)</p>
                                <p class="li-p-sq m-b-30">[EB슬라이더] shop020_countdown</p>
                                
                                <h5>회사소개 페이지</h5>
                                <p class="li-p-sq">[EB콘텐츠] shop020_main_about</p>
                                <p class="li-p-sq">[EB콘텐츠] shop020_main_overview</p>
                                <p class="li-p-sq">[EB콘텐츠] shop020_main_contact</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-5th" role="tabpanel" aria-labelledby="v-pills-5th-tab">
                <?php /* 테마 패치내역 */ ?>
                    <div class="theme-patch">
                        <h3><span class="title-bar"></span> 테마 패치내역</h3>
                        <div class="alert alert-info m-t-30">
                            <p>테마의 <strong>패치내역</strong>을 통해 해당 파일을 업데이트 합니다.</p>
                            <p class="m-b-15">패치시 사용자가 직접 작업 및 수정한 내용에 대해서는 <strong>백업</strong>을 한 후 진행하기 바랍니다.</p>
                            <p class="m-b-15">아래 링크에서 테마 패치내역을 확인하실 수 있습니다.</p>
                            <a href="https://eyoom.net/patch_list_se4/65" target="_blank"><u class="text-blue">https://eyoom.net/patch_list_se4/65</u></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
    $(document).ready(function() {
        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }
        });
        $('.title-tab a').on('click', function(e) {
            e.stopPropagation();
            var scrollTopSpace;
            if (window.innerWidth >= 992) {
                scrollTopSpace = 130;
            } else {
                scrollTopSpace = 130;
            }
            var tabLink = $(this).attr('href');
            var offset = $(tabLink).offset().top;
            $('html, body').animate({scrollTop : offset - scrollTopSpace}, 500);
            return false;
        });
    });
</script>