<?php 
include ("../links/db.php");
if(isset($_POST['submit'])){
    $BuldId=$_GET['updat'];
    $Name=$_POST['Name'];
    $color=$_POST['Color'];
    $insert=mysqli_query($conn,"INSERT INTO `productcolor`(`Color`, `Colorname`, `bulidid`) VALUES ('$color','$Name','$BuldId')");
    if($insert){
        echo '<script>alert("Data is inserted");</script>';
        $select = mysqli_query($conn, "SELECT * FROM `productcolor` ORDER BY `productcolor`.`IdColor` DESC LIMIT 1");
        $row = mysqli_fetch_assoc($select);
        $colorid = $row['IdColor'];
        ?>
        <script>
            location.replace('create copy 3.php?updat=<?php echo $BuldId?>&colorid=<?php echo $colorid?>');
        </script>
        <?php
    }
    else{
        echo '<script>alert("Data is not inserted");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('link/links.php') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid p-0 page-body-wrapper m-0 w-100">
            <?php include('link/side.php')?>
    <!-- partial:partials/_navbar.html -->
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <?php include ('link/nav.php')?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 p-3">
                        <div class="card text-light bg-dark p-3" >
                            <label class="form-label" for="Image">Color</label>
                            <input type="color" class="form-color" placeholder="Color" name="Color" id="Image">
                            <label class="form-label" for="Sides">Color Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="Name" id="Image">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 p-3">
                        <div class="card text-light bg-dark p-3" >
                            <div class="text-end p-3">
                                <button type="submit" name="submit" class="btn btn-dark" style="background-color: black;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 p-3">
                        <div class="card text-light bg-dark p-3" >
                            <div id="table-data" class="p-3">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<script src="assets/js/dashboard.js"></script>
<script>
     $(document).ready(function ($) {
        function loadTable() {
            var see = "<?php echo $_GET['updat'];?>";
            $.ajax({
                url: "ajex/produt_color.php",
                type: "POST",
                data: { id: see },
                success: function (data) {
                    $("#table-data").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error:", textStatus, errorThrown);
                }
            });
        }
        loadTable();
    });
</script>
</body>
</html>