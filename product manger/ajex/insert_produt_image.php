<?php
include ("../../links/db.php");
$employee_id = $_POST['employee_id'];
$colorid = $_POST['colorid'];
$Sides = $_POST['Sides'];
$select=mysqli_query($conn,"SELECT * FROM `produtimage` WHERE `colorid`='$colorid' AND `Side`='$Sides'");
if(mysqli_num_rows($select)){
echo 0;
}else{
    $selet=mysqli_query($conn,"SELECT COUNT(*) AS nofrow FROM `produtimage` WHERE `colorid`='$colorid'");
    $conted=mysqli_fetch_array($selet);
    $conun=$conted['nofrow'];
    $selectprodut=mysqli_query($conn,"SELECT `Side` FROM `product` WHERE `Bulid id`='$employee_id'");
    $prodsid=mysqli_fetch_array($selectprodut);
    $productedside=$prodsid['Side'];
    if($conun==$productedside){
        echo 2;
    }else{
$targetDirectory = "../../assets/img/product/";
$targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
$fileName = basename($_FILES["file"]["name"]);

if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
    // File uploaded successfully, proceed to insert into the database
   
}else {
    echo 0.1;
}
$insertproduct = mysqli_query($conn, "INSERT INTO `produtimage`(`bulidid`, `colorid`, `image`, `Side`) VALUES ('$employee_id','$colorid','$fileName','$Sides')");
if ($insertproduct) {
    echo 1;
}
else{
    echo 2;
}
}

}
?>
