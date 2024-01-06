<?php
include('../links/db.php');
$encoded_id = $_GET['k'];
$id = base64_decode($encoded_id);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['Description']; // Corrected variable name
    $tags = $_POST['tags']; // Corrected variable name
    $data = date('Y-m-d');

    $insert = mysqli_query($conn, "INSERT INTO `designedproduct`(`bulidid`, `Session id`, `Title`, `Description`, `Date`) VALUES ('$id','1','$title','$description','$data')");

    if ($insert) {
        $select = mysqli_query($conn, "SELECT `iddesign` FROM `designedproduct` WHERE `Session id` = '1' AND `bulidid`='$id' ORDER BY `iddesign` DESC LIMIT 1");
        if (mysqli_num_rows($select) > 0) {
            $data = mysqli_fetch_array($select);
            $iddesign = $data['iddesign'];
            if ($iddesign) {
                if (!empty($_POST['tags'])) {
                    $tags = $_POST['tags'];
                    foreach ($tags as $tag) {
                        $sanitizedTag = mysqli_real_escape_string($conn, $tag);
                        $tagQuery = "INSERT INTO `tag`(`bildid`, `produt id`, `SessionId`, `tag`) VALUES ('$id','$iddesign','1','$sanitizedTag')";
                        $result = mysqli_query($conn, $tagQuery);
                        if ($result) {
                            ?>
                                <script>
                                    location.replace('designe.php?k=<?php echo $encoded_id ?>&b=<?php echo $iddesign ?>');
                                </script>
                            <?php
                        }
                    }
                }                
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('link/links.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
</head>
<style>
    .form-data label span {
        color: red;
    }

    .tag {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 5px;
    }

    .closeBtn {
        margin-left: 5px;
        color: red;
        border: none;
        padding: 2px 2px;
        border-radius: 50%;
        cursor: pointer;
    }
</style>
<body>
<div class="container-fluid p-0 page-body-wrapper m-0 w-100">
    <?php include('link/side.php') ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <?php include('link/nav.php') ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                        <div class="bg-dark text-white p-3 rounded">
                            <div class="checkbox-container">
                                <div class="form-data">
                                    <label for="">Title<span>*</span></label>
                                    <input type="text" required name="title" id="" class="form-control">
                                </div>
                                <div class="form-data">
                                    <label for="">Description<span>*</span></label>
                                    <textarea required name="Description" id="" cols="20" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6">
                        <div class="bg-dark text-white p-3 rounded">
                            <div class="checkbox-container">
                                <div class="form-data">
                                    <label for="">Tag<span>*</span></label>
                                    <input class="form-control" type="text" name="" id="tagInput" placeholder="Enter tags" onkeydown="handleKeyDown(event)">
                                    <div id="tagContainer">
                                    </div>
                                </div>
                                <div class="form-data text-end">
                                    <button type="submit" name="submit" style="background-color: black;" class="btn mt-4 text-white">Submit</button>
                                </div>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var tagInput = document.getElementById('tagInput'); // Define tagInput in the global scope
    var tagContainer = document.getElementById('tagContainer'); // Define tagContainer in the global scope

    function handleKeyDown() {
        if (event.key === ' ' || event.key === 'Spacebar') {
            event.preventDefault();
            createTag(tagInput.value.trim());
        }
    }

    function createTag(tagValue) {
        var existingTags = document.querySelectorAll('.tag');

        if (existingTags.length < 9 && tagValue !== '') {
            var tagElement = document.createElement('span');
            tagElement.className = 'tag';

            var inputElement = document.createElement('input');
            inputElement.type = 'text';
            inputElement.readOnly = true;
            inputElement.name = 'tags[]';
            inputElement.value = tagValue;
            inputElement.className = 'tag btn';

            var closeButton = document.createElement('button');
            closeButton.className = 'closeBtn btn';
            closeButton.innerHTML = '✕';
            closeButton.onclick = function () {
                removeTag(tagElement);
            };

            tagElement.appendChild(inputElement);
            tagElement.appendChild(closeButton);
            tagContainer.appendChild(tagElement);
            tagInput.value = '';
        } else {
            alert('You can only add up to 9 tags.');
        }
    }

    function removeTag(tag) {
        tagContainer.removeChild(tag);
    }
</script>

</body>
</html>
