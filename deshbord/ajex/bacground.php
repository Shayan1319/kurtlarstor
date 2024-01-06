<?php 
include ('../../links/db.php');
$id = $_POST['id'];
$data = array(); // Initialize an array to store data for all sides

$select = mysqli_query($conn, "SELECT * FROM `produtimage` WHERE `colorid`='$id'");

while ($row = mysqli_fetch_array($select)) {
    // Store data for each side in the array
    $dataArray = array(
        'image' => $row['image'],
        'Side' => $row['Side']
    );
    $data[] = $dataArray;
}

// Encode and echo the entire array after the loop
echo json_encode($data);
exit;
?>
