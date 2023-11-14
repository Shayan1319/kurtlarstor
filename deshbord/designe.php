<!DOCTYPE html>
<html lang="en">
<head>
<?php include('link/links.php') ?>
</head>
<body>
<div class="container-fluid p-0 page-body-wrapper m-0 w-100">
    <?php include('link/side.php')?>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <div class="main-panel">
        <div class="content-wrapper">
            <?php include ('link/nav.php')?>
            <<div class="row">
        <div class="col-md-6 col-sm-2 col-lg-5">
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
                .canvas {
                    border-style: dashed !important;
                    height: 10pc !important;
                    width: 9pc !important;
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
            <div class="bg-dark p-3 rounded text-white">
                <div id="1phptext-propetys">
                    <label for="font-size">Font Size:</label>
                    <input class="form-control" type="number" id="1phpfont-size" min="1" value="16">
                    <label for="font-family">Font Family:</label>
                    <select class="form-select" id="1phpfont-family">
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
                    <select class="form-select" id="1phptext-style">
                        <option value="normal">Normal</option>
                        <option value="italic">Italic</option>
                        <option value="oblique">Oblique</option>
                    </select>
                    <label for="text-decoration">Text Decoration:</label>
                    <select class="form-select" id="1phptext-decoration">
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
                    <input class="form-color" type="color" id="1phptext-color">
                    <br>
                    <label for="text-alignment">Text Alignment:</label>
                    <select class="form-select" id="1phptext-alignment">
                        <option value="left">Left</option>
                        <option value="center">Center</option>
                        <option value="right">Right</option>
                    </select>
                </div>
                <textarea id="1phptext-input" placeholder="Enter text"></textarea>
                <form id="1phpimage-form" enctype="multipart/form-data">
                    <label for="1phpimage-input">Upload Image:</label>
                    <input class="form-control" type="file" id="1phpimage-input" accept="image/*">
                </form>
                <div id="1phpimg-property">
                    <label for="image-size">Image Size:</label>
                    <input class="form-range" type="range" id="1phpimage-size" min="50" max="140" step="1" value="200">
                    <!-- Rotation input for the image -->
                    <label for="image-rotation">Image Rotation:</label>
                    <input class="form-range" type="range" id="1phpimage-rotation" min="0" max="360" step="1" value="0">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-8 col-lg-7 " style="height: 800px;">
            <div class="bg-dark text-white p-3 rounded">
                <div class="d-flex flex-row justify-content-between p-3">
                    <h4 class="card-title mb-1">Open Projects</h4>
                    <p class="text-muted mb-1">Your data status</p>
                </div>
                <div class="canvas-section" style="background-image: url('../assets/img/product/mug.png');">
                    <div class="border canvas border-danger m-auto border-2" id="1phpcanvas"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var canvas = document.getElementById('1phpcanvas');
        var textElement = null;
        var imageElement = null;
        document.getElementById('1phptext-input').addEventListener('input', updateCanvas);
        document.getElementById('1phpfont-size').addEventListener('input', updateCanvas);
        document.getElementById('1phpfont-family').addEventListener('input', updateCanvas);
        document.getElementById('1phptext-style').addEventListener('input', updateCanvas);
        document.getElementById('1phptext-decoration').addEventListener('input', updateCanvas);
        document.getElementById('1phptext-color').addEventListener('input', updateCanvas);
        document.getElementById('1phptext-alignment').addEventListener('input', updateCanvas);
        document.getElementById('1phpimage-input').addEventListener('change', updateCanvas);
        document.getElementById('1phpimage-size').addEventListener('input', updateCanvas);
        document.getElementById('1phpimage-rotation').addEventListener('input', updateCanvas);
        function updateCanvas() {
            // Retrieve input values
            var text = document.getElementById('1phptext-input').value;
            var fontSize = document.getElementById('1phpfont-size').value + 'px';
            var fontFamily = document.getElementById('1phpfont-family').value;
            var textStyle = document.getElementById('1phptext-style').value;
            var textDecoration = document.getElementById('1phptext-decoration').value;
            var textColor = document.getElementById('1phptext-color').value;
            var textAlignment = document.getElementById('1phptext-alignment').value;
            var imageSize = document.getElementById('1phpimage-size').value; // Image size in pixels
            var rotationValue = document.getElementById('1phpimage-rotation').value; // Rotation in degrees
            // Update text element
            if (textElement) {
                textElement.innerHTML = '<p style="font-size:' + fontSize +
                    '; font-family:' + fontFamily +
                    '; font-style:' + textStyle +
                    '; text-decoration:' + textDecoration +
                    '; color:' + textColor +
                    '; text-align:' + textAlignment +
                    ';">' + text + '</p><button class="delete-button"><i class="mdi mdi-delete-forever"></i></button>';
            } else {
                textElement = document.createElement('div');
                textElement.className = 'element text-element';
                textElement.innerHTML = '<p style="font-size:' + fontSize +
                    '; font-family:' + fontFamily +
                    '; font-style:' + textStyle +
                    '; text-decoration:' + textDecoration +
                    '; color:' + textColor +
                    '; text-align:' + textAlignment +
                    ';">' + text + '</p><button class="delete-button"><i class="mdi mdi-delete-forever"></i></button>';
                canvas.appendChild(textElement);
                makeResizableAndDraggable(textElement);
            }
            // Update image element
            var file = document.getElementById('1phpimage-input').files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    if (imageElement) {
                        var img = imageElement.querySelector('img');
                        img.src = event.target.result;
                        img.style.width = imageSize + 'px'; // Set image size in pixels
                        img.style.transform = 'rotate(' + rotationValue + 'deg)'; // Apply rotation
                    } else {
                        imageElement = document.createElement('div');
                        imageElement.className = 'element image-element';
                        imageElement.innerHTML = '<img src="' + event.target.result + '" style="width:' + imageSize + 'px; transform: rotate(' + rotationValue + 'deg);"/><button class="delete-button"><i class="mdi mdi-delete-forever"></i></button>';
                        canvas.appendChild(imageElement);
                        makeResizableAndDraggable(imageElement);
                    }

                    // Add event listener to the delete button of the image element
                    var deleteButton = imageElement.querySelector('.delete-button');
                    deleteButton.addEventListener('click', function() {
                        canvas.removeChild(imageElement);
                        imageElement = null;
                        // Reset the image input field
                        document.getElementById('1phpimage-input').value = "";
                    });
                };
                reader.readAsDataURL(file);
            }
            // Add event listener to the delete button of the text element
            var deleteButton = textElement.querySelector('.delete-button');
            deleteButton.addEventListener('click', function() {
                canvas.removeChild(textElement);
                textElement = null;
                // Clear the text input field
                document.getElementById('1phptext-input').value = "";
            });
        }
        function makeResizableAndDraggable(element) {
            interact(element).draggable({
                restrict: {
                    restriction: canvas,
                    endOnly: true,
                    elementRect: {
                        top: 0,
                        left: 0,
                        bottom: 1,
                        right: 1
                    }
                },
                onmove: function(event) {
                    var target = event.target;
                    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                    target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
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
    </script>
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
</body>
</html>