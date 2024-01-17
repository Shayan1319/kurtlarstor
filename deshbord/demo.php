<?php
include('../links/db.php');
$encoded_id = $_GET['k'];
$id = base64_decode($encoded_id);
?>
<?php
// Your existing code...

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Iterate over each side to handle file uploads
    $selectside = mysqli_query($conn, "SELECT * FROM `canvssize` WHERE `bulidid`='$id'");
    while ($rowside = mysqli_fetch_array($selectside)) {
        $side = $rowside['Sides'];

        // Construct the input file name dynamically
        $inputFileName = 'image-input' . $side;

        // Check if the file input is set
        if (isset($_FILES[$inputFileName])) {
            $imageForm = $_FILES[$inputFileName];
            
            // Check if there is no error with the file upload
            if ($imageForm['error'] == 0) {
                $fileName = $imageForm['name'];
                $tempFilePath = $imageForm['tmp_name'];

                // Construct the destination path
                $destination = "../assets/img/desinerimg/" . $fileName;

                // Move the uploaded file to the destination folder
                move_uploaded_file($tempFilePath, $destination);

                // Now you can use $destination for further processing or database storage
                echo "File uploaded successfully to: " . $destination;
            } else {
                // Handle the file upload error
                echo "Error uploading file: " . $imageForm['error'];
            }
        }
    }

    // Your existing code...
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('link/links.php') ?>
<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
</head>
<body >
<!-- Inside your HTML form -->
<form action="" enctype="multipart/form-data" method="post">
    <!-- Your existing code... -->

    <?php
    $selectside = mysqli_query($conn, "SELECT * FROM `canvssize` WHERE `bulidid`='$id'");
    while ($rowside = mysqli_fetch_array($selectside)) {
        // Each file input should have a unique name based on the side
        $inputName = 'image-input' . $rowside['Sides'];
    ?>
        <input class="my-2 form-control" type="file" id="<?php echo $rowside['Sides'] ?>image-input" name="<?php echo $inputName ?>" accept="image/*">
    <?php
    }
    ?>

    <!-- Your existing code... -->

    <button type="submit" name="submit" class="btn text-white" style="background-color:black;">Submit</button>
</form>

        <!-- container-scroller -->
        <!-- plugins:js -->

<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="assets/js/dashboard.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
showSelectedSide();
$(document).ready(function() {
    $(".color-checkbox").change(function() {
        var id = $(this).val();
        $.ajax({
            url: "ajex/bacground.php",
            type: "POST",
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                console.log("AJAX Request Successful");
                console.log(data);

                if (data.length > 0) {
                    // Loop through each item in the array
                    for (var i = 0; i < data.length; i++) {
                        var imagePath = "../assets/img/product/" + data[i].image;
                        console.log("Image Path: ", imagePath);
                        var side = data[i].Side;
                        $("#" + side).css("background-image", "url('" + imagePath + "')");
                    }
                } else {
                    console.log("Empty or invalid data received from the server.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Request Error");
                console.error(xhr);
            }
        });
    });
});

</script>

</body>
</html>