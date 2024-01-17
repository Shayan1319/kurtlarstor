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

            
            $screenshotData = $_POST['screenshot_data'.$side];

            // Check if the screenshot data is not empty
            if (!empty($screenshotData)) {
                // Convert the base64-encoded image data to binary
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $screenshotData));
        
                // Save the screenshot to the destination folder
                $screenshotFileName = 'screenshot_' . $encoded_id . '.png'; // Generate a unique filename
                $screenshotDestination = "../assets/img/desinedbyfreelancer/" . $screenshotFileName;
                file_put_contents($screenshotDestination, $imageData);
        
                // Output the filename of the saved screenshot
                echo "Screenshot saved successfully as: " . $screenshotFileName;
            } else {
                echo "Error: No screenshot data received.";
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
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

</head>
<body >
<div class="container-fluid p-0 page-body-wrapper m-0 w-100">
    <?php include('link/side.php')?>
    <div class="main-panel">
        <div class="content-wrapper">
            <?php include ('link/nav.php')?>
            <form action="" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-5">
                    <nav class="navbar-nav bg-dark navbar-dark p-0">
                    </nav>     
                </div>
                <div class="col-7">
                    <nav class="navbar-nav bg-dark navbar-dark p-0">
                        <select name="" id="" class="show_side form-select m-2" onchange="showSelectedSide()">
                            <?php 
                                $selectside=mysqli_query($conn,"SELECT * FROM `canvssize` WHERE `bulidid`='$id'");
                                while($rowside=mysqli_fetch_array($selectside)){
                                    echo "<option value='".$rowside['Sides']."side'>".$rowside['Sides']."Side"."</option>";
                                }
                            ?>
                        </select>
                    </nav>     
                </div>
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
                    .canvas {
                        border-style: dashed !important;
                    }
                     
                    .checkbox-container {
                        display: flex;
                        align-items: center;
                    }
                    
                    .custom-checkbox {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        border: none;
                        margin-right: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                    }
                    
                    .custom-checkbox input {
                        display: none;
                    }
                    
                    .custom-checkbox .checkmark {
                        width: 30%;
                        height: 30%;
                        background-color: white;
                        border-radius: 50%;
                        display: none;
                    }
                    
                    .custom-checkbox input:checked+.checkmark {
                        display: block;
                    }

                </style>
                <?php 
                    $selectside=mysqli_query($conn,"SELECT * FROM `canvssize` WHERE `bulidid`='$id'");
                    $s=1;
                    while($rowside=mysqli_fetch_array($selectside)){
                ?>
                    <span id="<?php echo $rowside['Sides'].'side'?>">
                    <div class="row">
                        <div class="col-12" >
                        <nav class="navbar-dark bg-dark">
                            <div  class="container-fluid" style="display: none;" id="<?php echo $rowside['Sides']?>text-propetys">
                                <div class="input-group">
                                    <input type="number" hidden class="d-none" style="display: none;" name="text_Pos_X<?php echo $rowside['Sides']?>" id="<?php echo $rowside['Sides']?>text_Pos_X">
                                    <input type="number" hidden class="d-none" style="display: none;" name="text_Pos_Y<?php echo $rowside['Sides']?>" id="<?php echo $rowside['Sides']?>text_Pos_Y">
                                    <label for="font-size">Font Size:</label>
                                    <input class="my-2 form-control" type="number" id="<?php echo $rowside['Sides']?>font-size" name="font-size<?php echo $rowside['Sides']?>" min="1" value="16">
                                    <label for="font-family">Font Family:</label>
                                    <select class="my-2 form-control" id="<?php echo $rowside['Sides']?>font-family" name="font-family<?php echo $rowside['Sides']?>">
                                        <option value="Arial">Arial</option>
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Courier New">Courier New</option>
                                        <option value="Helvetica">Helvetica</option>
                                        <option value="Tahoma">Tahoma</option>
                                        <option value="Verdana">Verdana</option>
                                        <option value="Trebuchet MS">Trebuchet MS</option>
                                        <option value="Georgia, serif">Georgia, serif</option>
                                        <option value="Times New Roman, Times, serif">Times New Roman, Times, serif</option>
                                        <option value="Palatino, serif">Palatino, serif</option>
                                        <option value="Courier New, monospace">Courier New, monospace</option>
                                        <option value="Lucida Console, Monaco, monospace">Lucida Console, Monaco, monospace</option>
                                        <option value="Impact, Charcoal">Impact, Charcoal</option>
                                        <option value="Arial Black">Arial Black</option>
                                        <option value="Geneva">Geneva</option>
                                        <option value="Optima">Optima</option>
                                        <option value="Garamond, serif">Garamond, serif</option>
                                        <option value="Bookman, URW Bookman L, serif">Bookman, URW Bookman L, serif</option>
                                        <option value="Avant Garde">Avant Garde</option>
                                        <option value="Didot, serif">Didot, serif</option>
                                        <option value="Futura">Futura</option>
                                        <option value="Century Gothic">Century Gothic</option>
                                        <option value="Baskerville, Baskerville Old Face, Hoefler Text, Garamond, Times New Roman, serif">Baskerville, Baskerville Old Face, Hoefler Text, Garamond, Times New Roman, serif</option>
                                        <option value="Franklin Gothic Medium, Franklin Gothic">Franklin Gothic Medium, Franklin Gothic</option>
                                        <option value="Copperplate, Copperplate Gothic Light">Copperplate, Copperplate Gothic Light</option>
                                        <option value="Brush Script MT, cursive">Brush Script MT, cursive</option>
                                    </select>                                
                                    <label for="text-style">Text Style:</label>
                                    <select class="my-2 form-select" id="<?php echo $rowside['Sides']?>text-style" name="text-style<?php echo $rowside['Sides']?>">
                                        <option value="normal">Normal</option>
                                        <option value="italic">Italic</option>
                                        <option value="oblique">Oblique</option>
                                    </select>
                                    <label for="text-decoration">Text Decoration:</label>
                                    <select class="my-2 form-select" id="<?php echo $rowside['Sides']?>text-decoration" name="text-decoration<?php echo $rowside['Sides']?>">
                                        <option value="none">None</option>
                                        <option value="underline">Underline</option>
                                        <option value="line-through">Line Through</option>
                                        <option value="line-through">Line-through</option>
                                        <option value="underline overline">Underline Overline</option>
                                        <option value="underline line-through">Underline Line-through</option>
                                        <option value="overline line-through">Overline Line-through</option>
                                        <option value="inherit">Inherit</option>
                                    </select>
                                    <label for="text-color">Text Color:</label>
                                    <input class="my-2 form-color" type="color" id="<?php echo $rowside['Sides']?>text-color" name="text-color<?php echo $rowside['Sides']?>">
                                    <br>
                                    <label for="text-alignment">Text Alignment:</label>
                                    <select class="my-2 form-select" id="<?php echo $rowside['Sides']?>text-alignment" name="text-alignment<?php echo $rowside['Sides']?>">
                                        <option value="left">Left</option>
                                        <option value="center">Center</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>
                            </div>
                        </nav>
                        </div>
                        <div class="col-md-6 col-sm-2 col-lg-5">
                            <div class="bg-dark p-3 rounded text-white">
                                <textarea class="my-2 form-control" id="<?php echo $rowside['Sides']?>text-input" name="text-input<?php echo $rowside['Sides']?>" placeholder="Enter text"></textarea>
                                <input hidden type="text" name="side<?php echo $rowside['Sides']?>" value="<?php echo $rowside['Sides']?>" id="">
                                <label for="<?php echo $rowside['Sides']?>image-input">Upload Image:</label>
                                <input class="my-2 form-control" type="file" id="<?php echo $rowside['Sides']?>image-input" name="image-input<?php echo $rowside['Sides']?>" accept="image/*">                                
                            </div>
                        </div>
                        <?php 
                            $side= $rowside['Sides'];
                            $selectimg = mysqli_query($conn, "SELECT * FROM `produtimage` WHERE `bulidid`='$id' AND `Side`='$side' LIMIT 1");
                            $rowimg = mysqli_fetch_array($selectimg);
                            $img=$rowimg['image'];
                        ?>
                        <div class="col-md-6 col-sm-8 col-lg-7">
                            <div class="bg-dark text-white p-3 rounded">
                                <div class="d-flex flex-row justify-content-between p-3">
                                    <h4 class="card-title mb-1">Open Projects</h4>
                                    <p class="text-muted mb-1"><?php echo $rowside['Sides']?></p>
                                </div>
                                <div class="canvas-section" id="<?php echo $rowside['Sides']?>" style="background-image: url('../assets/img/product/<?php echo $img?>');padding-top: <?php echo $rowside['padding']?>px;">
                                    <div class="border canvas border-danger m-auto border-2" style="height: <?php echo $rowside['Height']."px" ?> !important;width: <?php echo $rowside['Width']."px"?> !important;" id="<?php echo $rowside['Sides']?>canvas"></div>
                                </div>
                            </div>
                            <div class="bg-dark d-block p-3 text-white" style="height: 200px important;" >
                                <div id="<?php echo $rowside['Sides']?>img-property" style="display: none;" >
                                    <label for="image-size">Image Size:</label>
                                    <input class="my-2 form-range" type="range" id="<?php echo $rowside['Sides']?>image-size" name="image-size<?php echo $rowside['Sides']?>" min="50" max="140" step="1" value="200">
                                    <!-- Rotation input for the image -->
                                    <label for="image-rotation">Image Rotation:</label>
                                    <input class="my-2 form-range" type="range" id="<?php echo $rowside['Sides']?>image-rotation" name="image-rotation<?php echo $rowside['Sides']?>" min="0" max="360" step="1" value="0">
                                    <input type="number" class="d-none" style="display: none;" hidden id="<?php echo $rowside['Sides']?>Img_Pos_X" name="Img_Pos_X<?php echo $rowside['Sides']?>">
                                    <input type="number" class="d-none" style="display: none;" hidden id="<?php echo $rowside['Sides']?>Img_Pos_Y" name="Img_Pos_Y<?php echo $rowside['Sides']?>">
                                </div>
                            </div>
                        </div>
                        <!-- Add this hidden input field inside your form -->
                        <input type="hidden" name="screenshot_data<?php echo $rowside['Sides']?>" id="screenshot_data<?php echo $rowside['Sides']?>" value="">

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector('#submit').addEventListener('click', function (event) {
            console.log('Button clicked');
            var canvasSection<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>');
            console.log('Canvas Section:', canvasSection<?php echo $rowside['Sides']?>);

            html2canvas(canvasSection<?php echo $rowside['Sides']?>).then(function (canvas) {
                console.log('Canvas:', canvas);
                var screenshotData<?php echo $rowside['Sides']?> = canvas.toDataURL("image/png");
                console.log('Screenshot Data Value:', screenshotData<?php echo $rowside['Sides']?>);
                document.getElementById('screenshot_data<?php echo $rowside['Sides']?>').value = screenshotData<?php echo $rowside['Sides']?>;
            });
        });
    });
</script>

<script>
    var canvas<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>canvas');
    var textElement<?php echo $rowside['Sides']?> = null;
    var imageElement<?php echo $rowside['Sides']?> = null;

    document.getElementById('<?php echo $rowside['Sides']?>text-input').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>font-size').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>font-family').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>text-style').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>text-decoration').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>text-color').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>text-alignment').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>image-input').addEventListener('change', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>image-size').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);
    document.getElementById('<?php echo $rowside['Sides']?>image-rotation').addEventListener('input', updateCanvas<?php echo $rowside['Sides']?>);

    function updateCanvas<?php echo $rowside['Sides']?>() {
        // Retrieve input values
        var text<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>text-input').value;
        var fontSize<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>font-size').value + 'px';
        var fontFamily<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>font-family').value;
        var textStyle<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>text-style').value;
        var textDecoration<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>text-decoration').value;
        var textColor<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>text-color').value;
        var textAlignment<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>text-alignment').value;
        var imageSize<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>image-size').value; // Image size in pixels
        var rotationValue<?php echo $rowside['Sides']?> = document.getElementById('<?php echo $rowside['Sides']?>image-rotation').value; // Rotation in degrees
        if (textElement<?php echo $rowside['Sides']?>) {
            document.getElementById('<?php echo $rowside['Sides']?>text-propetys').style.display = "block";
            var paragraph = textElement<?php echo $rowside['Sides']?>.querySelector('p');
            paragraph.style.fontSize = fontSize<?php echo $rowside['Sides']?>;
            paragraph.style.fontFamily = fontFamily<?php echo $rowside['Sides']?>;
            paragraph.style.fontStyle = textStyle<?php echo $rowside['Sides']?>;
            paragraph.style.textDecoration = textDecoration<?php echo $rowside['Sides']?>;
            paragraph.style.color = textColor<?php echo $rowside['Sides']?>;
            paragraph.style.textAlign = textAlignment<?php echo $rowside['Sides']?>;
            paragraph.innerHTML = text<?php echo $rowside['Sides']?> + '<br><button class="delete-button"><i class="mdi mdi-delete-forever"></i></button>';
        } else {
            document.getElementById('<?php echo $rowside['Sides']?>text-propetys').style.display = "block";
            textElement<?php echo $rowside['Sides']?> = document.createElement('div');
            textElement<?php echo $rowside['Sides']?>.className = 'element text-element';
            textElement<?php echo $rowside['Sides']?>.innerHTML = '<p style="font-size:' + fontSize<?php echo $rowside['Sides']?> +
                '; font-family:' + fontFamily<?php echo $rowside['Sides']?> +
                '; font-style:' + textStyle<?php echo $rowside['Sides']?> +
                '; text-decoration:' + textDecoration<?php echo $rowside['Sides']?> +
                '; color:' + textColor<?php echo $rowside['Sides']?> +
                '; text-align:' + textAlignment<?php echo $rowside['Sides']?> +
                ';">' + text<?php echo $rowside['Sides']?> + '<br><button class="delete-button"><i class="mdi mdi-delete-forever"></i></button></p>';
            canvas<?php echo $rowside['Sides']?>.appendChild(textElement<?php echo $rowside['Sides']?>);
            makeResizableAndDraggable<?php echo $rowside['Sides']?>(textElement<?php echo $rowside['Sides']?>);
        }

        // Update image element
        var file = document.getElementById('<?php echo $rowside['Sides']?>image-input').files[0];
        if (file) {
            document.getElementById('<?php echo $rowside['Sides']?>img-property').style.display = "block";
            var reader = new FileReader();
            reader.onload = function (event) {
                if (imageElement<?php echo $rowside['Sides']?>) {
                    var img = imageElement<?php echo $rowside['Sides']?>.querySelector('img');
                    img.src = event.target.result;
                    img.style.width = imageSize<?php echo $rowside['Sides']?> + 'px'; // Set image size in pixels
                    img.style.transform = 'rotate(' + rotationValue<?php echo $rowside['Sides']?> + 'deg)'; // Apply rotation
                } else {
                    imageElement<?php echo $rowside['Sides']?> = document.createElement('div');
                    imageElement<?php echo $rowside['Sides']?>.className = 'element image-element';
                    imageElement<?php echo $rowside['Sides']?>.innerHTML = '<img src="' + event.target.result + '" style="width:' + imageSize<?php echo $rowside['Sides']?> + 'px; transform: rotate(' + rotationValue<?php echo $rowside['Sides']?> + 'deg);"/><button id="delete-img" class="delete-button"><i class="mdi mdi-delete-forever"></i></button>';
                    canvas<?php echo $rowside['Sides']?>.appendChild(imageElement<?php echo $rowside['Sides']?>);
                    makeResizableAndDraggable<?php echo $rowside['Sides']?>(imageElement<?php echo $rowside['Sides']?>);
                    // Add event listener to the delete button of the image element
                    var deleteButton = imageElement<?php echo $rowside['Sides']?>.querySelector('.delete-button');
                    deleteButton.addEventListener('click', function () {
                        document.getElementById('<?php echo $rowside['Sides']?>img-property').style.display = "none";
                        canvas<?php echo $rowside['Sides']?>.removeChild(imageElement<?php echo $rowside['Sides']?>);
                        imageElement<?php echo $rowside['Sides']?> = null;
                        // Reset the image input field
                        document.getElementById('<?php echo $rowside['Sides']?>image-input').value = "";
                    });
                }
            };
            reader.readAsDataURL(file);
        } else {
            // No file selected, so clear image-related elements
            document.getElementById('<?php echo $rowside['Sides']?>img-property').style.display = "none";
            if (imageElement<?php echo $rowside['Sides']?>) {
                canvas<?php echo $rowside['Sides']?>.removeChild(imageElement<?php echo $rowside['Sides']?>);
                imageElement<?php echo $rowside['Sides']?> = null;
            }
        }

        // Add event listener to the delete button of the text element
        var deleteButton = textElement<?php echo $rowside['Sides']?>.querySelector('.delete-button');
        deleteButton.addEventListener('click', function () {
            document.getElementById('<?php echo $rowside['Sides']?>text-propetys').style.display = "none";
            canvas<?php echo $rowside['Sides']?>.removeChild(textElement<?php echo $rowside['Sides']?>);
            textElement<?php echo $rowside['Sides']?> = null;
            // Clear the text input field
            document.getElementById('<?php echo $rowside['Sides']?>text-input').value = "";
        });
    }

    function makeResizableAndDraggable<?php echo $rowside['Sides']?>(element) {
        interact(element).draggable({
            restrict: {
                restriction: canvas<?php echo $rowside['Sides']?>,
                endOnly: true,
                elementRect: {
                    top: 0,
                    left: 0,
                    bottom: 1,
                    right: 1
                }
            },
            onmove: function (event) {
                var target<?php echo $rowside['Sides']?> = event.target;
                var x<?php echo $rowside['Sides']?> = (parseFloat(target<?php echo $rowside['Sides']?>.getAttribute('data-x')) || 0) + event.dx;
                var y<?php echo $rowside['Sides']?> = (parseFloat(target<?php echo $rowside['Sides']?>.getAttribute('data-y')) || 0) + event.dy;

                target<?php echo $rowside['Sides']?>.style.transform = 'translate(' + x<?php echo $rowside['Sides']?> + 'px, ' + y<?php echo $rowside['Sides']?> + 'px)';
                target<?php echo $rowside['Sides']?>.setAttribute('data-x', x<?php echo $rowside['Sides']?>);
                target<?php echo $rowside['Sides']?>.setAttribute('data-y', y<?php echo $rowside['Sides']?>);
                // Check if the element is an image or text
                if (target<?php echo $rowside['Sides']?>.classList.contains('image-element')) {
                // Update the input fields with the new position values for the image
                document.getElementById('<?php echo $rowside['Sides']?>Img_Pos_X').value = x<?php echo $rowside['Sides']?>;
                document.getElementById('<?php echo $rowside['Sides']?>Img_Pos_Y').value = y<?php echo $rowside['Sides']?>;
                } else if (target<?php echo $rowside['Sides']?>.classList.contains('text-element')) {
                    // Update the input fields with the new position values for the text
                    document.getElementById('<?php echo $rowside['Sides']?>text_Pos_X').value = x<?php echo $rowside['Sides']?>;
                    document.getElementById('<?php echo $rowside['Sides']?>text_Pos_Y').value = y<?php echo $rowside['Sides']?>;
                }
            }
        }).resizable({
            edges: {
                left: true,
                right: true,
                bottom: true,
                top: true
            },
            restrictEdges: {
                outer: 'parent'
            },
            restrictSize: {
                min: {
                    width: 50,
                    height: 50
                }
            }
        });
    }

    function showSelectedSide() {
        var selectedSide = document.getElementsByClassName('show_side')[0].value;
        var div = <?php echo json_encode($rowside["Sides"]."side"); ?>;
        var allSides = document.querySelectorAll('[id$="side"]');
        allSides.forEach(function (side) {
            side.style.display = "none";
        });

        // Show the selected side
        if (selectedSide) {
            document.getElementById(selectedSide).style.display = "block";
        }
    }
</script>

                    </div>
                    </span>
                <?php $s++; }?>
                <div class="col-sm-12 col-md-5"></div>
                <div class="col-sm-12 col-lg-7 float-end">
                    <div class="bg-dark text-white p-3 rounded">
                        <div class="checkbox-container">
                        <?php 
                                $seletcolor = mysqli_query($conn, "SELECT * FROM `productcolor` WHERE `bulidid`='$id'");
                                while ($rowcolor = mysqli_fetch_array($seletcolor)) {
                            ?>
                                <label class="custom-checkbox" style="background-color: <?php echo $rowcolor['Color']; ?>">
                                    <input value="<?php echo $rowcolor['IdColor']; ?>" id="<?php echo $rowcolor['IdColor'] . "colorid"; ?>" name="Color[]" type="checkbox" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                        <?php    } ?>
                            
                        </div>
                        <div class="text-end">
                            <button type="submit" name="submit" id="submit" class="btn text-white" style="background-color:black;" >Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
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