<?php 
include ("../links/db.php");
if(isset($_POST['submit'])){
    $image=$_FILES['image'];
    $BuldId=$_POST['BuldId'];
    $Name=$_POST['Name'];
    $Sides=$_POST['Sides'];
    $Description=$_POST['Description'];
    $Image_name =$image['name'];
    $Image_path = $image['tmp_name'];
    $Image_error = $image['error'];
    if($Image_error==0)
    {
        $Image_save='../assets/img/'.$Image_name;
        // echo $Image_save;
        move_uploaded_file($Image_path, $Image_save);  
    }else{
        echo '<script>alert("Picture is not uploaded Kindli update");</script>';
    }
    $insert=mysqli_query($conn,"INSERT INTO `product`( `Image`, `Bulid id`, `Name`, `Side`, `Description`) VALUES ('$Image_name','$BuldId','$Name','$Sides', '$Description')");
    if($insert){
        echo '<script>alert("Data is inserted");</script>';
        ?>
               <script>
                   location.replace('create copy 2.php?updat=<?php echo $BuldId?>');
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
</head>
<body>
<div class="container-fluid p-0 page-body-wrapper m-0 w-100">
            <?php include('link/side.php')?>
    <!-- partial:partials/_navbar.html -->
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <?php include ('link/nav.php')?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 p-3">
                    <div class="card text-light bg-dark p-3" >
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input id="Image" name="image" onchange="document.getElementById('log1').src = window.URL.createObjectURL(this.files[0])" type="file" accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Image">Buld Id</label>
                            <input type="number" class="form-control" placeholder="Buld Id" name="BuldId" id="Image">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Sides">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="Name" id="Image">
                        </div>
                        <div class="mb-3">
                            <label for="Description" class="form-label">Textarea</label>
                            <textarea class="form-control" name="Description" id="Description" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 p-3">
                    <div class="card text-light bg-dark p-3" >
                        <div class="form-group mr-3 mt-0">
                          <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%" src="images/file_icon.png" width="120px;" height="130px">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Sides">Sides</label>
                            <select name="Sides" class="form-select" id="Sides">
                                <option value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="4">Four</option>
                            </select>
                        </div>
                        <div class="text-end p-3">
                            <button type="submit" name="submit" id="submit" class="btn btn-dark" style="background-color: black;">Next</button>
                        </div>
                   </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
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
</body>
</html>