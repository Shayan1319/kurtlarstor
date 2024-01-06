<?php
include("../../links/db.php");
$bid = $_POST['id'];
$side = $_POST['side'];
$select = mysqli_query($conn, "SELECT * FROM `produtimage` WHERE `bulidid`='$bid' AND `Side`='$side' LIMIT 1");
while ($row = mysqli_fetch_array($select)) {
    $data = array(
        'image' => $row['image'],
        'Side' => $row['Side']
    );
    echo json_encode($data);
    exit;
}
?>
