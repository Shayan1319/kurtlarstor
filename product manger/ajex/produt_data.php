<?php
include("../../links/db.php");

$bid = $_POST['id'];

// Join query to fetch data from both tables with an additional condition
$select = mysqli_query($conn, "SELECT cs.*, pi.Imageid, pi.image FROM `canvssize` cs
                                LEFT JOIN `produtimage` pi ON cs.bulidid = pi.bulidid AND pi.Side = cs.Sides
                                WHERE cs.`bulidid`='$bid'");

$e = 1;

while ($row = mysqli_fetch_array($select)) {
    ?>
    <div class="col-md-6 col-sm-8 col-lg-7 " style="height: 460px;">
        <div class="bg-dark text-white p-3 rounded">
            <div class="d-flex flex-row justify-content-between p-3">
                <h4 class="card-title mb-1">Open Projects</h4>
                <p id="text-muted" class="text-muted mb-1"><?php echo $row['Sides']; ?></p>
            </div>
            <div id="canvas-section" class="canvas-section" style="background-image: url('../assets/img/product/<?php echo $row['image']; ?>');padding-top: <?php echo $row['padding']."px"; ?>;">
                <div class="border canvas border-danger m-auto border-2" id="1phpcanvas"
                     style="width:<?php echo $row['Width']."px"; ?>; height: <?php echo $row['Height']."px"; ?>;"></div>
            </div>
        </div>
    </div>

    <?php
    $e++;
}
?>
