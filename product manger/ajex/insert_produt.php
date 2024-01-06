<?php
include ("../../links/db.php");
$employee_id = $_POST['employee_id'];
$Pading = $_POST['Pading'];
$Width = $_POST['Width'];
$Height = $_POST['Height'];
$Sides = $_POST['Sides'];
$select=mysqli_query($conn,"SELECT * FROM `canvssize` WHERE `bulidid`='$employee_id' AND `Sides`='$Sides'");
if(mysqli_num_rows($select)){

  
echo 0;
}else{
$insertproduct = mysqli_query($conn, "INSERT INTO `canvssize`( `padding`, `Width`, `Height`, `Sides`, `bulidid`) VALUES ('$Pading','$Width','$Height','$Sides','$employee_id')");
if ($insertproduct) {
    echo 1;
}
else{
    echo 2;
}}
?>
