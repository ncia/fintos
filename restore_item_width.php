<?php
include_once('./_common.php');

if (PHP_SAPI !== 'cli' && !$is_admin) {
    die('접근 권한이 없습니다.');
}

$it_id = '1776008318';
$old_content = '<div class="insurance-guide" style="font-family:\'Malgun Gothic\', dotum, sans-serif; max-width:800px; color:#333; line-height:1.6;">
    <h3 style="padding-left:10px; margin-bottom:20px;">삼성 행복종신보험 가입 설계 예시 (월 보험료 기준)</h3>
    
    <table style="width:100%; border-collapse:collapse; margin-bottom:20px; font-size:14px; border-top:2px solid #ddd;">
        <thead>
            <tr style="background-color:#f8f9fa;">
                <th style="border:1px solid #ddd; padding:12px; text-align:center;">구분</th>
                <th style="border:1px solid #ddd; padding:12px; text-align:center;">20대 (25세)</th>
                <th style="border:1px solid #ddd; padding:12px; text-align:center;">30대 (35세)</th>
                <th style="border:1px solid #ddd; padding:12px; text-align:center;">40대 (45세)</th>
                <th style="border:1px solid #ddd; padding:12px; text-align:center;">50대 (55세)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; font-weight:bold; background-color:#fcfcfc;">남성</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 142,000원</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 185,000원</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 248,000원</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 352,000원</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; font-weight:bold; background-color:#fcfcfc;">여성</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 128,000원</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 163,000원</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 215,000원</td>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; color:#e53935; font-weight:bold;">약 298,000원</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; font-weight:bold; background-color:#fcfcfc;">설계 기준</td>
                <td colspan="4" style="border:1px solid #ddd; padding:12px; text-align:center;">주계약 1억 원 / 20년납</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd; padding:12px; text-align:center; font-weight:bold; background-color:#fcfcfc;">보장 내용</td>
                <td colspan="4" style="border:1px solid #ddd; padding:12px; text-align:center;">사망보험금 1억 원</td>
            </tr>
        </tbody>
    </table>

    <p style="font-size:13px; color:#666; background-color:#f9f9f9; padding:10px;">
        해당 설계 기준은 [주계약 1억 원, 20년납, 종신 만기, 표준체] 가입 예시입니다. 개별 건강 고지 사항에 따라 보험료 할증이나 가입 제한이 있을 수 있으며, 납입 기간 및 만기 설정에 따라 월 납입액은 변동될 수 있습니다.
    </p>

    <div class="notice-section" style="margin-top:30px; border:1px dashed #bbb; padding:20px;">
        <h4 style="margin-top:0; color:#0054a6;">💡 가입 시 참고사항</h4>
        <ul style="padding-left:20px; margin-bottom:0; font-size:14px;">
            <li style="margin-bottom:10px;"><strong>해약환급금 미지급형:</strong> 위 예시는 일반적인 해약환급금 미지급형(무해지환급형) 등을 선택할 경우 보험료가 더 저렴해질 수 있습니다.</li>
            <li style="margin-bottom:10px;"><strong>특약 구성:</strong> 상기 금액은 \'주계약(사망 보장)\'에 집중된 수치이며, 암·뇌·심장 등 진단비 특약을 추가할 경우 보험료는 상승합니다.</li>
            <li style="margin-bottom:0;"><strong>건강체 할인:</strong> 흡연 여부, 혈압, BMI 등 삼성생명이 정한 건강 상태 기준을 충족할 경우 <strong>보험료 할인</strong> 혜택을 받을 수 있으니 상담 시 확인이 필요합니다.</li>
        </ul>
    </div>
</div>';

$sql = "UPDATE {$g5['g5_shop_item_table']} SET it_explan_example = '" . addslashes($old_content) . "' WHERE it_id = '$it_id'";
$result = sql_query($sql);

if ($result) {
    echo "성공적으로 복구되었습니다.";
} else {
    echo "복구 중 오류가 발생했습니다.";
}
?>
