<?php
$conn = mysqli_connect('localhost', 'nciame_gnu', 'mcXT@3NDymqcZm@f', 'nciame_gnu');
$res = mysqli_query($conn, 'DESC g5_member');
$fields = [];
while($row = mysqli_fetch_assoc($res)) {
    $fields[] = $row['Field'];
}
echo implode(' ', $fields);
?>
