<?php
include('../../links/db.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized and validated the input (for security)
    $padding = $_POST['padding'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $sides = $_POST['sides'];
    $bulidid = $_POST['bulidid'];
$select=mysqli_query($conn,"SELECT * FROM `canvssize` WHERE `bulidid`='$bulidid' AND `Sides`='$sides'");
if(mysqli_num_rows($select)){
    echo "Data Alrady exist";
}else{
    $selet=mysqli_query($conn,"SELECT COUNT(*) AS nofrow FROM `canvssize` WHERE `bulidid`='$bulidid'");
    $conted=mysqli_fetch_array($selet);
    $conun=$conted['nofrow'];
    $selectprodut=mysqli_query($conn,"SELECT `Side` FROM `product` WHERE `Bulid id`='$bulidid'");
    $prodsid=mysqli_fetch_array($selectprodut);
    $productedside=$prodsid['Side'];
    if($conun==$productedside){
        echo "Sides are completed";
    }else{
    // Assuming $conn is your database connection object
    $query = "INSERT INTO `canvssize`(`padding`, `Width`, `Height`, `Sides`, `bulidid`) VALUES ('$padding', '$width', '$height', '$sides', '$bulidid')";

    if (mysqli_query($conn, $query)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
}
}else {
    echo "Invalid request";
}
?>
