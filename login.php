<?php

// Iinclude a configuration file with the database connection
include('includes/config.php');

// Include functions for application
include('includes/functions.inc.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get email and password from the form as variables
	$email = $_POST['email'];
    $password = trim($_POST['password']);


	// Query records that have usernames and passwords that match those in the users table
	$sql = file_get_contents('sql/attemptLogin.sql');
	$params = array(
		'email' => $email,
	);
	$statement = $database->prepare($sql);
    $statement -> execute($params);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC); 
	// Set $user equal to the first result of $users
    $user = $users[0]; 

	if(!empty($user)) {	
        if(password_verify($password, $user['pwd'])) {
// Set a session variable with a key of userID equal to the userID returned
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['username'] = $user['fName'];


		// Redirect to the index.html file
	    header('location: fr8rhome.php');
    } else {
        echo 'OOPS, email and password do not match';
    }

}    
    echo 'OOPS, email and password do not match, please try again';
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Page Title -->
    <title>Fr8R&trade;</title>
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

       <!-- Form Style Sheet 
    <link rel="stylesheet" href="css/forms.css">-->
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

<!-- Form start  -->
<section id="contact" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Welcome to Fr8r&trade;</h2><br>
                    <div class="container" id="login-logo" style = "text-align:center">
                                <img  src="images/fr8r_logo.png" alt="logo">
                            </div><br>
                    <span class="hr-line mt-4 mb-4"></span>    
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" method = "POST">
                    <div class="row" style="text-align:center">
                        <div class="col-sm-12" id="result"></div> 

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Email : " required id="email" name="email">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password : " id="password" name="password">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-pink btn-large" id="submit_btn">log-in</button>
                        </div><br><br><br>
                        <div class="col-sm-12">
                            <button type="cancel" class="btn btn-pink btn-large" id="cancel_btn">cancel</button>
                        </div>
                    </div>
                        <span class="psw">Forgot <a href="forgotPassword.php">password?</a></span>           
                </form>
            </div>            
        </div>
    </div>
</section>
<!--Form US Ends-->

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









