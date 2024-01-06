<?php
include ("../../links/db.php");
$bid=$_POST['id'];
$select=mysqli_query($conn,"SELECT * FROM `produtimage` WHERE `colorid`='$bid'");
$e=1;
while($row=mysqli_fetch_array($select)){
    ?>
        <div class="col-md-6 col-sm-8 col-lg-6 " style="height: 800px;">
            <div class="bg-dark text-white p-3 rounded">
                <div class="d-flex flex-row justify-content-between p-3">
                    <h4 class="card-title mb-1">Open Projects</h4>
                    <p class="text-muted mb-1"><?php echo $row['Side']?></p>
                </div>
                <div class="canvas-section" style="background-image: url('../assets/img/product/<?php echo $row['image']?>');">
                    
                </div>
            </div>
        </div>
    <?php
$e++;
}
?>