<?php
include ("../../links/db.php");
$bid= $_POST['id'];
$select = mysqli_query($conn, "SELECT * FROM `productcolor` WHERE `bulidid`='$bid'");
$e = 1;
while ($row = mysqli_fetch_array($select)) :
    ?>
    <div class="rounded-circle" style="width: 50px; height: 50px; background-color: <?php echo $row['Color']?>; " ></div>
    <?php
    $e++;
endwhile;
?>
