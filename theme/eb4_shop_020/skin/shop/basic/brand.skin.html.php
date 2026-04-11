<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/brand.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php
// PHP 8 이상의 환경에서도 안전하게 상수를 참조하고 배경 경로를 생성합니다.
$tmp_theme_url = defined('G5_THEME_URL') ? G5_THEME_URL : G5_URL . '/theme/eb4_shop_020';
$random_bg_num = rand(1, 30);
$brand_bg_url = $tmp_theme_url . '/image/brand_bg/bg_' . $random_bg_num . '.png';
?>

<style>
.brand-title {
    position: relative;
    text-align: center;
    margin-bottom: 30px;
    padding: 50px 10px;
    background-color: #f8f9fa; /* 배경 이미지 로딩 전 보일 기본 색상 */
    background-image: url('<?php echo $brand_bg_url; ?>');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 0;
    overflow: hidden;
    color: #fff;
}

.brand-title:before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.15);
    z-index: 1;
}

.brand-title .brand-title-img,
.brand-title h3 {
    position: relative;
    z-index: 2;
}

.brand-title .brand-title-img {
    width: 140px;
    border: 3px solid #fff;
    background: #fff;
    padding: 15px;
    height: auto;
    margin: 0 auto 20px;
    border-radius: 0;
}

.brand-title h3 {
    font-weight: 800;
    font-size: 2.2rem;
    text-shadow: 0 2px 8px rgba(0,0,0,0.5);
    margin: 0;
}

.btn-brand-action {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 3px;
    color: #fff !important;
    font-size: 0.8125rem;
    font-weight: 600;
    transition: all 0.2s ease;
    text-decoration: none !important;
}
.btn-brand-action:hover {
    background: rgba(255,255,255,0.35);
    border-color: rgba(255,255,255,0.5);
}
.btn-brand-action i {
    margin-right: 5px;
    font-size: 0.875rem;
}
</style>

<div class="shop-list">
    <div class="brand-title">
        <?php if ($br['img_url']) { ?>
        <div class="brand-title-img">
            <img src="<?php echo $br['img_url']; ?>" class="img-fluid" alt="">
        </div>
        <?php } ?>
        <h3><?php echo $br['br_name']; ?></h3>
        <?php 
            $brand_desc = array(
                '1773820528' => "삼성생명은 국내 점유율 1위의 압도적 위상을 가진 리딩 컴퍼니입니다. 최근에는 사망 보장과 노후 연금을 동시에 잡은 '밸런스 종신보험'과 맞춤형 건강 보장을 제공하는 '다사랑 시리즈'를 통해 고객의 평생 자산과 건강을 통합 관리하고 있습니다.", // 삼성생명
                '4d640311ba' => "KB라이프는 KB금융그룹의 프리미엄 가치를 기반으로 시니어 라이프 케어를 선도하는 혁신 보험사입니다. 주력인 '백년약속 종신보험'과 '변액보험' 시리즈를 통해 업계 최고 수준의 자산 운용 능력과 생애 주기별 맞춤 보장 솔루션을 제공합니다.", // KB라이프
                '2189e19c87' => "DB생명은 탄탄한 재무 건전성을 바탕으로 보장성 보험 중심의 성장을 추구하는 중견 생보사입니다. 주력인 '백년친구 700 종신보험'과 '실속N 건강보험' 시리즈를 통해 사망 보장과 주요 질병 치료비를 실속 있게 제공하며 고객의 신뢰를 쌓고 있습니다.", // DB생명
                'e5c1466280' => "흥국생명은 탄탄한 자산 운용력을 갖춘 중견 보험사로, 수익성 중심의 건강보험 시장에서 두각을 나타내고 있습니다. 주력인 '다사랑통합보험'과 '다채로운종신보험' 시리즈를 통해 고객의 생애 주기에 맞춘 정교한 보장 솔루션을 제공하는 것이 특징입니다.", // 흥국생명
                '8ed431617b' => "한화생명은 국내 최초의 생보사로서 업계 '빅3'의 탄탄한 위상을 자랑합니다. 현재는 보장 금액이 매년 늘어나는 'H종신보험'과 암치료 전 과정을 보장하는 '시그니처 암보험'을 주력으로 내세워, 고객의 건강과 자산을 지키는 금융 혁신을 선도하고 있습니다.", // 한화생명
                'c0670ee0d7' => "라이나생명은 외국계 생보사 중 압도적 수익성과 자본력을 보유한 텔레마케팅 강자입니다. 주력인 '다이나믹건강OK보험'과 '치아보험' 시리즈를 통해 유병자도 가입 쉬운 초개인화 설계를 제공하며, 민원 최저 수준의 고객 신뢰를 유지하고 있습니다.", // 라이나생명
                'bb3515f0d8' => "신한라이프는 업계 최고 수준의 자본 건전성을 바탕으로 '빅3'를 위협하는 리딩 컴퍼니입니다. 최근에는 장수 리스크를 대비한 '신한톤틴연금보험'과 필요한 보장만 골라 담는 '신한통합건강보험' 시리즈를 통해 고객 맞춤형 밸런스 케어를 선도하고 있습니다.", // 신한라이프
                'b9f0805d99' => "하나생명은 하나금융그룹의 신뢰를 바탕으로 디지털 전환과 보장성 보험 강화에 집중하는 생보사입니다. 주력인 '내맘같은 건강보험' 시리즈는 12대 질병 납입면제 등 파격적인 혜택과 맞춤형 설계를 통해 합리적인 보험료로 실속 있는 보장을 제공합니다.", // 하나생명
                'af55bd5385' => "NH농협생명은 전국적인 농협 네트워크를 기반으로 업계 최고 수준의 자본 건전성을 자랑합니다. 최근에는 '트루라이프NH종신보험'과 '치료비안심해2NH건강보험'을 주력으로, 사망 보장부터 실손 의료비까지 생애 주기별 맞춤 보장을 강화하고 있습니다.", // NH농협생명
                '331cd1a541' => "교보생명은 국내 ‘빅3’ 생보사로서 내실 경영과 고객 중심의 ‘평생든든서비스’를 지향합니다. 주력 상품인 ‘교보실속있는종신보험’과 ‘교보더든든한의료비보장보험’ 등을 통해 합리적인 보험료로 생애 주기별 맞춤형 보장을 제공하는 것이 특징입니다.", // 교보생명
                '0b54c92b6a' => "동양생명은 '수호천사' 브랜드로 친숙한 중견 보험사로, 최근 우리금융그룹 편입을 통해 신뢰도를 높였습니다. 주력인 '수호천사5배더행복한종신보험'과 '우리WON하는 건강보험' 시리즈를 통해 맞춤형 보장과 내실 경영을 실현하고 있습니다.", // 동양생명
                'df3d53215c' => "메트라이프는 글로벌 네트워크를 기반으로 한 변액 및 달러보험의 명가입니다. 2026년 변액보험 장기 수익률 1위를 기록했으며, 체증형 구조의 '모두의 종신보험'과 '360종합보장' 시리즈를 통해 자산 가치 보존과 정교한 헬스케어 솔루션을 제공합니다.", // 메트라이프 (MetLife)
                '0af3edfefd' => "ABL생명은 글로벌 금융 노하우를 갖춘 국내 2호 생보사로, 최근 변액보험과 보장성 상품에서 강세를 보입니다. 주력인 '더나은종신보험'과 'DIY건강보험' 시리즈를 통해 저렴한 보험료로 사망 보장과 맞춤형 질병 진단비를 실속 있게 제공합니다.", // ABL생명
                '59ffbe2aef' => "AIA생명은 글로벌 네트워크를 보유한 외국계 생보사로, 최근 디지털 전환과 보장성 보험 강화에 집중하고 있습니다. 주력인 '글로벌 파워 달러 연금'과 '슈퍼암보험' 시리즈를 통해 안정적인 자산 운용과 폭넓은 중대 질병 보장을 제공하는 것이 특징입니다.", // AIA생명
                'e1bdfdd485' => "미래에셋생명은 변액보험 브랜드 1위이자 국내 '투자형 보험'을 선도하는 자산관리 명가입니다. 글로벌 자산 배분 노하우를 녹인 '변액유니버셜종신'과 '보장성 상품' 시리즈를 통해 수익성과 안정성을 동시에 제공하며 업계 독보적인 입지를 다지고 있습니다.", // 미래에셋생명
                'be53180510' => "IM라이프는 DGB금융그룹 산하 생보사로 2026년 브랜드 통합을 통해 위상을 높였습니다. 주력인 'iM변액연금' 시리즈는 차별화된 자산 운용으로 업계 최상위 수익률을 기록하며 안정적인 노후 자산 형성을 돕는 것이 특징입니다.", // IM라이프
                'fe9cf69a1e' => "KDB생명은 산업은행 계열의 공신력을 바탕으로 내실 경영을 강화하는 중견 생보사입니다. 주력인 '더블찬스'와 '버팀목' 시리즈는 확정금리형 종신보험과 유병자 간편 가입을 통해 안정적인 자산 형성과 노후 보장을 제공하는 것이 특징입니다.", // KDB생명
                '936177aeac' => "푸본현대생명은 대만 푸본금융그룹의 자본력을 바탕으로 퇴직연금과 방카슈랑스 분야에서 강점을 가진 중견 생보사입니다. 주력인 'MAX종신보험'과 '제로(ZERO) 건강보험' 시리즈를 통해 실속 있는 보장과 안정적인 자산 관리 솔루션을 제공하고 있습니다.", // 푸본현대생명
                '635e34ac09' => "카디프생명은 글로벌 BNP파리바 그룹 소속으로 국내 신용보험 시장을 선도합니다. 주력인 '대출안심' 시리즈는 사고 시 대출금을 대신 갚아주는차별화된 보장을 제공하며, 지수연동형 및 AI 기반 변액보험으로 스마트한 자산 관리를 돕습니다.", // 카디프생명
                '1773820549' => "삼성화재는 국내 손해보험업계 부동의 1위이자 글로벌 수준의 재무 건전성을 갖춘 리딩 컴퍼니입니다. 주력인 '마이플러스 건강보험'과 '애니카 자동차보험' 시리즈를 통해 업계 최고 수준의 보상 서비스와 맞춤형 통합 보장 솔루션을 제공합니다.", // 삼성화재
                '1773820614' => "KB손해보험은 2026년 브랜드평판 1위를 기록한 손보업계 리딩 컴퍼니입니다. 주력인 '금쪽같은 자녀보험'과 '희망플러스 건강보험' 시리즈를 통해 업계 최고 수준의 보장 한도와 고객 맞춤형 디지털 헬스케어 서비스를 제공하는 것이 특징입니다.", // KB손보
                '4a89508576' => "DB손해보험은 국내 손보업계 '빅3'이자 탁월한 수익성을 갖춘 리딩 컴퍼니입니다. 주력인 '참좋은훼밀리종합보험'과 '아이러브건강보험' 시리즈를 통해 업계 최초의 신담보를 지속 출시하며 생애 주기에 맞춘 실속 있는 통합 보장을 실현하고 있습니다.", // DB손보
                '6a6858a707' => "흥국화재는 탄탄한 자산 운용력을 갖춘 중견 손보사로 가성비 중심 보장성 보험 시장에서 두각을 나타냅니다. 주력인 '흥Good 건강보험'과 '맘편한 자녀보험' 시리즈를 통해 업계 최고 수준의 진단비와 독창적인 수술비 보장을 제공하는 것이 특징입니다.", // 흥국화재
                'c959e7dd98' => "한화손해보험은 '여성 보험의 명가'로 자리매김하며 차별화된 시장 지위를 확보한 주요 손보사입니다. 주력인 '시그니처 여성 건강보험'과 '세이프투게더' 시리즈를 통해 여성 특화 보장과 실속 있는 일상 위험 케어를 제공하며 고객의 신뢰를 얻고 있습니다.", // 한화손보
                '74d33aa11c' => "라이나손보는 글로벌 처브그룹 소속으로, 2026년 브랜드 통합을 통해 디지털 손보 시장의 강자로 도약 중입니다. 주력인 '생활안심'과 '미니보험' 시리즈를 통해 일상 속 핵심 위험을 초저가로 보장하며, 라이나생명과의 결합 시너지를 극대화하고 있습니다.", // 라이나손보
                '328d1aed85' => "하나손보는 디지털 혁신과 장기보험 체질 개선에 집중하는 하나금융지주 계열사입니다. 주력인 '3N5 간편건강보험'은 2026 브랜드 대상을 수상했으며, 업계 최다 136대 수술비와 통합 치료비를 비갱신으로 제공해 실손 보장 공백을 정교하게 보충합니다.", // 하나손보
                '5b0c247415' => "NH농협손보는 농협금융 산하의 견고한 위상을 가진 보험사로, 특히 농작물재해보험 분야에서 독보적입니다. 주력인 '가성비굿'과 '헤아림' 시리즈를 통해 저렴한 보험료로 3대 질병을 즉시 보장하며 실속을 중시하는 고객층의 지지를 얻고 있습니다.", // 농협손보
                '291c5463d6' => "현대해상은 국내 손해보험업계 '빅2'이자 어린이보험 시장 1위의 리딩 컴퍼니입니다. 주력인 '굿앤굿어린이종합보험'과 '퍼펙트플러스종합보험' 시리즈를 통해 영유아부터 성인까지 생애 전반의 핵심 위험을 정교하게 보장하며 고객 신뢰를 얻고 있습니다.", // 현대해상
                '3223c3cc88' => "롯데손보는 보장성 보험 중심의 체질 개선으로 기업 가치를 높이는 중견 손보사입니다. 주력인 '렛:스마일 건강보험'과 '렛:클릭' 시리즈를 통해 본인부담 급여 의료비 정액 지원과 간편한 미니보험 등 고객 친화적 혁신 보장을 제공하고 있습니다.", // 롯데손보
                'ee33913e6a' => "메리츠화재는 압도적 수익성을 바탕으로 손보업계 순이익 1위를 다투는 리딩 컴퍼니입니다. 주력인 '내맘같은 건강보험'과 '펫퍼민트' 시리즈를 통해 최고 수준의 보장 한도와 파격적인 가입 조건을 제시하며 실속형 보험 시장을 선도하고 있습니다.", // 메리츠화재
                '0036410956' => "AIG손보는 글로벌 네트워크를 보유한 국내 최초 외국계 손보사입니다. 주력인 '꼭 필요한 상해보험' 시리즈를 통해 사고 시 부위별·중증도별로 진단비를 중복 보장하며, 보장성 보험 중심의 내실 경영을 바탕으로 차별화된 입지를 구축하고 있습니다.", // AIG손보
                '4346241a83' => "처브라이프는 글로벌 처브그룹의 일원으로, 2026년 '라이나' 브랜드 통합을 통해 시너지를 내는 생보사입니다. 주력인 'Chubb 종신보험' 시리즈는 사망 보장은 물론 특약을 통해 암, 질병 등 생애 전반을 유연하게 설계할 수 있는 것이 특징입니다.", // 처브라이프 (요청된 코드)
            );
            $brand_nums = array(
                '1773820528' => array('1588-3114', '1588-3115', '02-311-4500', '고객센터 전화', '조회하기', '다운로드'), // 삼성생명
            );

            if (isset($brand_desc[$br_cd])) {
                $default_nums = array('대표번호', '전용번호', '상담전화', '접수안내', '조회하기', '다운로드');
                $c_nums = isset($brand_nums[$br_cd]) ? $brand_nums[$br_cd] : $default_nums;
                
                // 브랜드별 텍스트 박스 너비 오프셋 개별 설정
                $box_offset = ($br_cd == '1773820549') ? '60px' : '70px';
        ?>
        <div style="background: rgba(0,0,0,0.1); padding: 25px; border-radius: 0; margin: 20px auto 0; position: relative; z-index: 10; width: calc(100% - <?php echo $box_offset; ?>); text-align: left;">
            <p style="color: #fff; font-size: 1rem; line-height: 1.7; text-shadow: 0 1px 4px rgba(0,0,0,0.5); word-break: keep-all; margin-bottom: 15px;">
                <?php echo $brand_desc[$br_cd]; ?>
            </p>
            <div style="color: #fff; margin-top: 20px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.2); font-size: 1rem; width: 100%; text-shadow: 0 1px 4px rgba(0,0,0,0.5); display: flex; justify-content: space-around; align-items: flex-start; opacity: 0.9; text-align: center;">
                <div>
                    <span>고객센터</span>
                    <div style="font-size: 1rem; margin-top: 5px; font-weight: bold; color: #fff;"><?php echo $c_nums[0]; ?></div>
                </div>
                <div>
                    <span>모니터링</span>
                    <div style="font-size: 1rem; margin-top: 5px; font-weight: bold; color: #fff;"><?php echo $c_nums[1]; ?></div>
                </div>
                <div>
                    <span>전산헬프</span>
                    <div style="font-size: 1rem; margin-top: 5px; font-weight: bold; color: #fff;"><?php echo $c_nums[2]; ?></div>
                </div>
                <div>
                    <span>청구팩스</span>
                    <div style="font-size: 1rem; margin-top: 5px; font-weight: bold; color: #fff;"><?php echo $c_nums[3]; ?></div>
                </div>
                <div>
                    <span>보험약관</span>
                    <div style="margin-top: 5px;">
                        <a href="javascript:void(0);" class="btn-brand-action">
                            <i class="fas fa-search"></i><?php echo $c_nums[4]; ?>
                        </a>
                    </div>
                </div>
                <div>
                    <span>청구서류</span>
                    <div style="margin-top: 5px;">
                        <a href="javascript:void(0);" class="btn-brand-action">
                            <i class="fas fa-download"></i><?php echo $c_nums[5]; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    
    <?php if ($eyoom['use_brand'] != 'n') { //쇼핑몰 브랜드 시작 ?>
    <div class="brand-list">
        <?php echo eb_brand('basic'); ?>
    </div>
    <?php } ?>

    <?php if (!isset($it['it_id'])) { // 상품 상세페이지가 아닐 때만 비디오와 상품 목록 출력 ?>
        <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
            <?php 
                // 브랜드별 유튜브 영상 ID 매핑
                $brand_videos = array(
                    '1773820528' => 'Nmm7fS8C1iQ', // 삼성생명
                    '4d640311ba' => 'nv_pIz4YMis', // KB라이프
                    '2189e19c87' => 'pLknVXzORbc', // DB생명
                    'e5c1466280' => 'PJxLcH5DOoU', // 흥국생명
                    '8ed431617b' => '9UMtH0hqc8Q', // 한화생명
                    'c0670ee0d7' => 'oPTm7U1kF8A', // 라이나생명
                    'bb3515f0d8' => 'Zym8wQ0-DSA', // 신한라이프
                    'b9f0805d99' => '_Kg_Gc5230Y', // 하나생명
                    'af55bd5385' => '5vq_Q8KaW14', // 농협생명
                    '331cd1a541' => 'tRqGBMO7JMw', // 교보생명
                    '0b54c92b6a' => 'MR8xt8LgJ2c', // 동양생명
                    'df3d53215c' => 'Z5Tmp4vU-Q0', // 메트라이프
                    '4346241a83' => '2ScbTnjw5I8', // 처브라이프
                    '0af3edfefd' => 'S5uynfNx64M', // ABL생명
                    '59ffbe2aef' => 'L2u11Ww_a-Y', // AIA생명
                    'e1bdfdd485' => 'cZVt4qXJB7w', // 미래에셋생명
                    'be53180510' => 'yvYAdKuyKys', // IM라이프
                    'fe9cf69a1e' => 'TfXTOz3VjhI', // KDB생명
                    '936177aeac' => 'vSIUSq8LKjY', // 푸본현대생명
                    '635e34ac09' => 'BUnm0ZF5qD4', // 카디프생명
                    '1773820549' => '0o21ItOuVr0', // 삼성화재
                    '1773820614' => '5WLY4SjYkS8', // KB손보
                    '4a89508576' => 'piWdsrurrMM', // DB손보
                    '6a6858a707' => '6NwYhASHmEk', // 흥국화재 (현재 흥국화재 영상)
                    'c959e7dd98' => 'bFHjT4EYKlk', // 한화손보 (현재 롯데손보 영상?)
                    '74d33aa11c' => 'uYOvrsI-B34', // 라이나손보
                    '328d1aed85' => 'SIiBd_e2tHo', // 하나손보
                    '5b0c247415' => 'QP4ehRhFXGA', // 농협손보
                    '291c5463d6' => '6PILqm6vqHU', // 현대해상
                    '3223c3cc88' => 'EOaXBCrxOR8', // 롯데손보
                    'ee33913e6a' => 'wIbvTqLCaHk', // 메리츠화재
                    '0036410956' => 'zaZjvgv6q78', // AIG손보
                );
                
                // 해당 브랜드 코드에 맞는 영상 ID 설정 (없으면 기본값 사용)
                $youtube_id = isset($brand_videos[$br_cd]) ? $brand_videos[$br_cd] : 'h0I-MAteA1g';
            ?>
            <iframe 
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>?autoplay=1&mute=1&loop=1&playlist=<?php echo $youtube_id; ?>" 
                title="YouTube video player" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
            </iframe>
        </div>
    </div>

    <div id="product_list" class="product-list">
        <?php echo $item_list; ?>
    </div>

    <?php } ?>
</div>