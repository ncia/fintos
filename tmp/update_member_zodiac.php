<?php
include_once('c:/xampp/htdocs/gnu/common.php');

$mb_name = '권수진';
$res = sql_query("select * from g5_member where mb_name = '{$mb_name}' order by mb_datetime desc");

while ($row = sql_fetch_array($res)) {
    echo "ID: " . $row['mb_id'] . " | Name: " . $row['mb_name'] . " | Birth: " . $row['mb_birth'] . " | Email: " . $row['mb_email'] . "\n";
    
    // 만약 생년월일이 비어있다면 사용자가 언급한 19840910을 수동으로 적용할까요?
    // 아니면 mb_birth 필드를 업데이트하고 이미지를 복사합니다.
    
    $birth = preg_replace('/[^0-9]/', '', $row['mb_birth']);
    
    // 사용자가 방금 언급한 19840910 예시가 권수진 회원의 것이라면 강제 적용
    if (!$birth || $birth == '') {
        $birth = '19840910';
        sql_query("update g5_member set mb_birth = '{$birth}' where mb_id = '{$row['mb_id']}'");
        echo "Updated empty birth to 19840910 for ID: " . $row['mb_id'] . "\n";
    }

    $year = (int)substr($birth, 0, 4);
    $index = ($year - 4) % 12;
    if ($index < 0) $index += 12;
    
    $zodiacFiles = ['0_mouse.png', '1_cow.png', '2_tiger.png', '3_rabbit.png', '4_dragon.png', '5_snake.png', '6_horse.png', '7_sheep.png', '8_monkey.png', '9_cock.png', '10_dog.png', '11_pig.png'];
    $zodiacFile = $zodiacFiles[$index];
    $source_path = G5_DATA_PATH . '/member_image/te/' . $zodiacFile;
    
    if (file_exists($source_path)) {
        $dest_dir_icon = G5_DATA_PATH . '/member/' . substr($row['mb_id'], 0, 2);
        $dest_dir_img  = G5_DATA_PATH . '/member_image/' . substr($row['mb_id'], 0, 2);
        
        if (!is_dir($dest_dir_icon)) @mkdir($dest_dir_icon, G5_DIR_PERMISSION);
        if (!is_dir($dest_dir_img))  @mkdir($dest_dir_img, G5_DIR_PERMISSION);
        
        $dest_path_icon = $dest_dir_icon . '/' . $row['mb_id'] . '.png';
        $dest_path_img  = $dest_dir_img . '/' . $row['mb_id'] . '.png';
        
        copy($source_path, $dest_path_icon);
        copy($source_path, $dest_path_img);
        
        echo "Successfully updated Zodiac Image for " . $row['mb_id'] . " (" . $birth . ")\n";
    }
}
?>
