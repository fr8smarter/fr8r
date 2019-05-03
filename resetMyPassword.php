<?php 
//error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Include Config file
include('includes/dbConnect.php');

//Include Functions file
include('includes/functions.inc.php');
//initialize errrors array
$errors = [];

$email = get('email');

$users = verifyUserEmail($email, $database);
$verify = $users[0];

if (empty($verify)) {
    $errors[] = 'Your email is not a valid Fr8R&trade; email,<br><br> <a href ="forgotPassword.php"><strong>click here</strong><a/> to start over';
}

// If form submitted

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['pwd'] != $_POST['confirmPW']) {
        $errors[] = 'Your Passwords do not Match';
    } else { 
        $pwd = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT);
    } 
    if(empty($errors))	{
        // update password
    updatePassword($database, $email, $pwd);

    header('location:logout.php');
    } else {
        echo "<br><br><br><br>";
       
        foreach ($errors as $error): ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h4 class="font-weight-600 m-0"><?php echo $error ?></h4>
                </div>
            </div>
        </div> <br>
        <?php endforeach;?>

        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h4 class="font-weight-600 m-0"> Please Try again. </H4>
                </div>
            </div>
        </div> 

        <?php
    }

    };

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Page Title -->
    <title>Fr8r&trade; Reset Password</title>
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.ico">
    <!-- Animate -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Fancy Box -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <!-- Cube Portfolio -->
    <link rel="stylesheet" href="css/cubeportfolio.min.css">
    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="revolution/css/navigation.css">
    <!-- Style Sheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gradient.css">

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="90">

<!--start loader-->
<div class="loader">
    <div class="cssload-loader">
        <div class="cssload-inner cssload-one"></div>
        <div class="cssload-inner cssload-two"></div>
        <div class="cssload-inner cssload-three"></div>
    </div>
</div>
<!--loader end-->

<!--header start-->
<?php include('includes/appHeader.php'); ?>
<!--header end-->


<!-- Contact US -->
<section id="contact" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5"><br><br><br>
                    <h2 class="font-weight-600 m-0">Welcome to Fr8r &trade;</h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4">Update Password</p>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" method = "POST">
                    <div class="row" style="text-align:center">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Choose a Password : " required id="pwd" name="pwd">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Confirm Password : " required id="confirmPW" name="confirmPW">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-large btn-pink w-100" id="submit_btn">submit request</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
<!--Contact US Ends-->

<!--Footer Begins-->
<?php include('includes/appFooter.php'); ?>
<!--Footer ends-->


<!-- start scroll to top -->
<a class="scroll-top-arrow" href="#home"><i class="ti ti-angle-up"></i></a>
<!-- end scroll to top  -->


<!-- Optional JavaScript -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.appear.js"></script>
<!-- isotop gallery -->
<script src="js/isotope.pkgd.min.js"></script>
<!-- cube portfolio gallery -->
<script src="js/jquery.cubeportfolio.min.js"></script>
<!-- owl carousel slider -->
<script src="js/owl.carousel.min.js"></script>
<!-- parallax Background -->
<script src="js/parallaxie.min.js"></script>
<!-- fancybox popup -->
<script src="js/jquery.fancybox.min.js"></script>
<!-- REVOLUTION JS FILES -->
<script src="revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="revolution/js/jquery.themepunch.revolution.min.js"></script>
<!-- SLIDER REVOLUTION EXTENSIONS -->
<script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
<!-- map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBceNl50o3BU6LrsIGJxSL9tKKvqBKIeVs"></script>
<script src="js/map.js"></script>
<!-- custom script -->
<script src="js/script.js"></script>
</body>
</html>