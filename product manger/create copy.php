<?php
include ('../links/db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('link/links.php') ?>
</head>
<style>
    /* CSS styles remain unchanged */
    .element {
        position: absolute;
        cursor: move;
    }
    .text-element,
    .image-element {
        resize: both;
        overflow: hidden;
    }
    .delete-button {
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
    }
    .canvas-section {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 360px !important;
    }
</style>
<body>
<div class="container-fluid p-0 page-body-wrapper m-0 w-100">
  <?php include('link/side.php')?>
    <div class="main-panel">
        <div class="content-wrapper">
            <?php include ('link/nav.php')?>
            <form action="" id="formdata" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 col-md-4 p-3">
                        <div class="card text-light bg-dark p-3" >
                            <label class="form-label" for="Image">Pading Top</label>
                            <input type="number" class="form-control" placeholder="Padding" name="Padding" id="Padding">
                            <label class="form-label" for="Image">Width</label>
                            <input type="number" class="form-control" placeholder="Width" name="Width" id="Width">
                            <label class="form-label" for="Image">Height</label>
                            <input type="number" class="form-control" placeholder="Height" name="Height" id="Height">
                            <label class="form-label" for="Sides">Sides</label>
                            <select name="Sides" class="form-select" id="Sides">
                                <option value="">Select</option>
                                <option value="Top">Top</option>
                                <option value="Bottom">Bottom</option>
                                <option value="Left">Three</option>
                                <option value="Right">Right</option>
                            </select>
                            <div class="text-end p-3">
                                <button type="submit" name="submit" id="save" class="btn btn-dark" style="background-color: black;">ADD</button>
                                <input style="background-color: black;" type="button" onclick="backToSection2()" class="btn text-white shadow float-right" value="Next">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 col-lg-7 " style="height: 460px;">
                        <div class="bg-dark text-white p-3 rounded">
                            <div class="d-flex flex-row justify-content-between p-3">
                                <h4 class="card-title mb-1">Open Projects</h4>
                                <p id="text-muted" class="text-muted mb-1">Your data status</p>
                            </div>
                            <div id="canvas-section" class="canvas-section">
                                <div class="border canvas border-danger m-auto border-2" id="1phpcanvas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 table-responsive">
                        <div id="from-data" class="row w-100">
                        
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 table-responsive">
                        <div id="table-data" class="row w-100">
                        
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updateCanvasStyles() {
    var padding = $("#Padding").val() + "px";
    var width = $("#Width").val() + "px";
    var height = $("#Height").val() + "px";

    console.log("Padding:", padding);
    console.log("Width:", width);
    console.log("Height:", height);

    // Set padding-top for canvas-section
    $("#canvas-section").css("padding-top", padding);

    // Set width and height for 1phpcanvas
    $("#1phpcanvas").css({
        "width": width,
        "height": height
    });
}

// Attach the function to input change events
$("#Padding, #Width, #Height").on("input", updateCanvasStyles);

</script>
<script>
    function backToSection2() {
        <?php $CNIC = $_GET['updat'];?>
        location.replace('create.php');
            }
            
    $(document).ready(function ($) {
        $("#save").on("click", function () {
            var padding = $("#Padding").val();
            var width = $("#Width").val();
            var height = $("#Height").val();
            var sides = $("#Sides").val();
            var bulidid = "<?php echo $_GET['updat']; ?>";

            // Assuming you have a PHP script named insert_data.php to handle the database insertion
            $.ajax({
                url: "ajex/insert_canvs_size.php",
                type: "POST",
                data: {
                    padding: padding,
                    width: width,
                    height: height,
                    sides: sides,
                    bulidid: bulidid
                },
                success: function (data) {
                    // Handle the response from the server
                    alert(data);
                    loadTable();
                        $("#formdata")[0].reset(); 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    alert("An error occurred during the AJAX request.");
                }
            });
        });
        
        function loadTable() {
            var see = "<?php echo $_GET['updat'];?>";
            $.ajax({
                url: "ajex/produt_data.php",
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
        $("#Sides").change(function() {
            var employee_id = "<?php echo $_GET['updat']; ?>";
            var side = $(this).val();
            $.ajax({
                url: "ajex/canvs.php",
                type: "POST",
                data: { side: side, id: employee_id },
                dataType: 'json',
                success: function(data) {
                    console.log("AJAX Request Successful");
                    console.log(data);
                    if (data) {
                        var imagePath = "../assets/img/product/" + data.image;
                        console.log("Image Path: ", imagePath);
                        $("#canvas-section").css("background-image", "url('" + imagePath + "')");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Request Error");
                    console.error(xhr.responseText);
                }
            });
        });

    });
</script>

</body>
</html>