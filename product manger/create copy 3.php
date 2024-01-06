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
        padding-top: 80px;
    }
    @media (max-width: 380px) {
        .canvas-section {
            padding-top: 90px !important;
        }
    }
    @media (max-width: 330px) {
        .canvas-section {
            padding-top: 110px !important;
        }
        .canvas {
            border-style: dashed !important;
            height: 8pc !important;
            width: 7pc !important;
        }
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
                    <div class="col-sm-12 col-md-6 col-lg-6 p-3">
                        <div class="card text-light bg-dark p-3" >
                            <label class="form-label" for="Image">Image</label>
                            <input type="file" class="form-color" placeholder="" name="Image" id="file" accept="image/*">
                            <label class="form-label" for="Sides">Side</label>
                            <select name="Sides" class="form-select" id="Sides">
                                <option value="">Select</option>
                                <option value="Top">Top</option>
                                <option value="Bottom">Bottom</option>
                                <option value="Left">Three</option>
                                <option value="Right">Right</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 p-3">
                        <div class="card text-light bg-dark p-3" >
                            <div class="text-end p-3">
                                <button type="submit" class="btn btn-dark" style="background-color: black;">Submit</button>
                                <input style="background-color: black;" type="button" onclick="backToSection2()" class="btn text-white shadow float-right" value="Next">
                                <input style="background-color: black;" type="button" onclick="backToSectioncolor()" class="btn text-white shadow float-right" value="Add More Color">
                            </div>
                        </div>
                    </div>
                    <div id="table-data" class="row w-100">
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
    function backToSection2() {
        <?php $CNIC = $_GET['updat'];?>
        location.replace('create copy.php?updat=<?php echo $CNIC?>');
            }
            function backToSectioncolor() {
        <?php $CNIC = $_GET['updat'];?>
        location.replace('create copy 2.php?updat=<?php echo $CNIC?>');
            }
    $(document).ready(function ($) {
        function loadTable() {
        var colorid = "<?php echo $_GET['colorid'];?>";
        $.ajax({
            url: "ajex/bgimage.php",
            type: "POST",
            data: { id: colorid },
            success: function (data) {
                console.log("AJAX Success:", data);
                $("#table-data").html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", textStatus, errorThrown);
            }
        });
    }
    loadTable();
    $("button[type='submit']").on("click", function (e) {
        e.preventDefault();
        var employee_id = "<?php echo $_GET['updat']; ?>";
        var colorid = "<?php echo $_GET['colorid']; ?>";
        var Sides = $("#Sides").val();
        var formData = new FormData();
        formData.append('employee_id', employee_id);
        formData.append('colorid', colorid);
        formData.append('Sides', Sides);
        formData.append('file', $('#file')[0].files[0]);
        $.ajax({
            url: "ajex/insert_produt_image.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                alert(data);
                if (data == 0.1) {
                    alert("Can't Save Image");
                } else if (data == 1) {
                    loadTable();
                    $("#formdata")[0].reset();
                } else if (data == 0) {
                    alert("Can't Save Record. Record Already exists");
                } else if (data == 2) {
                    alert("Can't Save Record");
                } else {
                    alert("Can't Save Record. Please check the server response.");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", textStatus, errorThrown);
            }
        });
    });
});

</script>
</body>
</html>
