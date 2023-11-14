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
            <div class="row">
                <div class="col-12">
                    <nav class="navbar-nav bg-dark navbar-dark p-0">
                        <div class="navbar-menu-wrapper ">
                            <ul class="navbar-nav w-100">
                                <li class="nav-item w-100">
                                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                        <input type="text" class="form-control" placeholder="Search products">
                                    </form>
                                </li>
                            </ul>                   
                        </div>
                    </nav>
                    <nav class="navbar-nav bg-dark navbar-dark p-0">
                        <div class="navbar-menu-wrapper ">
                            <ul class="navbar-nav w-100">
                                <li class="nav-item w-100">
                                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                        <li class="nav-item mx-3">
                                            <a class="nav-link active" aria-current="page" href="#">New Product</a>
                                        </li>
                                        <li class="nav-item mx-3">
                                            <a class="nav-link" href="#">Best Seller</a>
                                        </li>
                                    </form>
                                </li>
                            </ul>                   
                        </div>
                    </nav>     
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 p-3">
                    <a href="designe.php">
                    <div class="card text-light bg-dark" style="background-image: url('../assets/img/designe_t_shirt_bg.gif');height: 275px;background-size: cover;" >
                       <div class="float-end">
                       <button type="button" class="btn btn-dark btn-icon-text float-end m-2"> Create <i class="mdi mdi-border-color"></i></button>
                       </div>
                       <div class="card-footer position-absolute bottom-0">
                           This is some text within a card body.
                       </div>
                   </div>
                    </a>
                </div>
            </div>
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