<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shayan Khan</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- 
Easy Profile Template
http://www.templatemo.com/tm-467-easy-profile
-->
    <!-- stylesheet css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/templatemo-blue.css">
</head>

<body data-spy="scroll" data-target=".navbar-collapse">
<?php 
include ('../links/db.php');
 $selectId=$_GET['id'];
 $select = mysqli_query($conn,"SELECT * FROM `team` where `id`='$selectId'");
while($see=mysqli_fetch_array($select)){
?>
    <!-- preloader section -->
    <div class="preloader">
        <div class="sk-spinner sk-spinner-wordpress">
            <span class="sk-inner-circle"></span>
        </div>
    </div>

    <!-- header section -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <img src="../assets/img/<?php echo$see['Image']?>" class="img-responsive img-circle tm-border" alt="templatemo easy profile">
                    <hr>
                    <h1 style="color: <?php echo $see ['H_color']?>;" class="bold shadow">Hi, I am <?php echo $see['Name']?></h1>
                    <h1 class="white bold shadow"><?php echo $see ['Employee_Designation']?> of Kurtlar Developer</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- about and skills section -->
    <section class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="about">
                    <h3><?php echo $see ['Name']?></h3>
                    <h2><?php echo $see['Employee_Designation']?> of Kurtlar Developer</h2>
                    <p style="text-align: justify;" ><?php echo $see['Objective']?></p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <style>
                    .skills {
                            background: <?php echo $see['bg_color']?>;
                            color: <?php echo $see['T_color']?>;
                        }

                        .skills .progress {
                            border-radius: 0px;
                            height: 4px;
                        }

                        .skills .progress .progress-bar-primary {
                            background: <?php echo $see['H_color']?>;
                        }
                </style>
                <div class="skills">
                    <h2 class="white">Skills</h2>
                        <?php 
                        $select = mysqli_query($conn,"SELECT * FROM `$see[Email]`");
                        while($result=mysqli_fetch_array($select)){
                            ?>
                    
                    <strong><?php echo$result['FName'] ?></strong>
                    <span class="pull-right"><?php echo $result['Expert%']?>%</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo $result['Expert%']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $result['Expert%']?>%;"></div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </section>

    <!-- education and languages -->
    <section class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div style="background: <?php echo $see['bg_color']?>; color: <?php echo$see['T_color']?>" class="education">
                    <h2 class="white">Education</h2>
                    <div class="education-content">
                        <h4 style="color: <?php echo $see['H_color']?>;" class="accent"><?php echo $see['Degree']?> <?php echo $see['Degree_Name_S']?></h4>
                        <div style="color: <?php echo $see['T_color']?>;" class="bold">
                            <h5><?php echo $see['Institute_Address']?></h5><span>|</span>
                            <h5><?php echo $see['Degree_Start_Date']?> / <?php echo $see['Degree_Complition_date']?></h5>
                        </div>
                        <h4 style="color: <?php echo $see['H_color']?>;" class="bold"><?php echo $see['Name_of _Coyrse']?></h4>
                        <div  style="color: <?php echo $see['T_color']?>;"  >
                            <h5><?php echo $see['Institue']?></h5><span></span>
                            <h5><?php echo $see['Duration']?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="languages">
                    <h2>Languages</h2>
                    <?php echo $see['Languages']?>
                </div>
            </div>
        </div>
    </section>

    <!-- contact and experience -->
    <section class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="contact">
                    <h2>Contact</h2>
                    <p><i class="fa fa-map-marker"></i> <?php echo $see['Location']?></p>
                    <p><i class="fa fa-phone"></i><?php echo$see['Mobile_Number']?></p>
                    <p><i class="fa fa-envelope"></i><?php echo$see['Email']?></p>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div style="background: <?php echo $see['bg_color']?>; color: <?php echo$see['T_color']?>" class="experience">
                    <h2 class="white">Experiences</h2>
                    <div class="experience-content">
                        <?php echo $see['Skill']?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <p>Copyright &copy; 2023 Kurtlar Developer</p>
                    <ul class="social-icons">
                        <li>
                            <a href="<?php echo $see['Facebook']?>" class="fa fa-facebook"></a>
                        </li>
                        <li>
                            <a href="<?php echo $see['Email']?>" class="fa fa-google-plus"></a>
                        </li>
                        <li>
                            <a href="<?php echo $see ['Twitter']?>" class="fa fa-twitter"></a>
                        </li>
                        <li>
                            <a href="<?php echo $see ['Github']?>" class="fa fa-github"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<?php }?>
    <!-- javascript js -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>