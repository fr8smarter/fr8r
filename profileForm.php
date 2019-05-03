<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

//Set UserID
$userID = $_SESSION['userID'];

// Initially set $book to null;


//Get countries
$countries = getCountries($database);
//Get states
$states = getStatesUS($database);

$errors = [];
// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isValidZipCode($_POST['zip']) == 'no') {
        $errors[] = 'Please Enter a valid zip code';
    } else {
         $zip = $_POST['zip'];
    }

	$fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];   
    $address1= $_POST['address1'];  
    $address2 = $_POST['address2'];  
    $city= $_POST['city'];  
    $stateID = $_POST['stateID'];  
    $countryID = $_POST['countryID'];
   
    if(empty($errors)){

    updateUser($database,
        $userID, $fName, $lName, $email, $phone, $address1, $address2,$city, $stateID,
        $zip, $countryID
    );
	// Redirect to fleet page
	header('location: fr8rhome.php');
    } else {
        echo "<br><br><br><br>";
       
        foreach ($errors as $error) {
            echo " - $error<br>\n";
        }
        echo "</p><p> Please Try again. </p><p><br></p>";
    }
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
    
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="90" style >

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

    <!-- Profile Form-->
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Welcome <?php echo $user->get_fName()?> </h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4">Update your profile </p>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" method = "POST">

                    <div class="row" style="text-align:center">
  
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">First Name:</label>
                                <input class="form-control" type="text" value= "<?php echo $user->get_fName()?>" required id="fName" name="fName">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Last Name:</label>
                                <input class="form-control" type="text" value= "<?php echo $user->get_lName()?>" required id="lName" name="lName">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Email:</label>
                            <input class="form-control" type="email" value= "<?php echo $user->get_email()?>" required id="email" name="email">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Phone:</label>
                                <input class="form-control" type="tel" value= "<?php echo $user->get_phone()?>" required id="phone" name="phone">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Address 1:</label>
                                <input class="form-control" type="text" value= "<?php echo $user->get_address1()?>" required id="address1" name="address1">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Adddress 2:</label>
                                <?php if(empty($user->get_address2())): ?>
                                    <input class="form-control" type="text" placeholder="Address2 : " id="address2" name="address2">
                                <?php else: ?>
                                    <input class="form-control" type="text" value="<?php echo $user->get_address2()?>" id="address2" name="address2l">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">City:</label>
                                <input class="form-control" type="text" value= "<?php echo $user->get_city()?>" required id="city" name="city">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">State:</label>
                                <select class="form-control" required id= "stateID" name = "stateID">
                                            <?php foreach ($states as $state) : ?>                 
                                            <?php if($state['stateID'] == $user->get_stateID()): ?>
                                                <option class="form-control" value="<?php echo $state['stateID']?>" selected ><?php echo $state['stateCase'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $state['stateID']?>"><?php echo $state['stateCase'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Zip:</label>
                            <input class="form-control" type="text" value= "<?php echo $user->get_zip()?>" required id="zip" name="zip">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Country:</label>
                                <select class="form-control" required id= "countryID" name = "countryID">
                                            <?php foreach ($countries as $country) : ?>                 
                                            <?php if($country['countryID'] == $user->get_countryID()): ?>
                                             <option class="form-control" value="<?php echo $country['countryID']?>" selected ><?php echo $country['countryName'] ?></option>
                                            <?php else :?>   
                                             <option class="form-control" value="<?php echo $country['countryID']?>"><?php echo $country['countryName'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12"><br><br>
                            <button type="submit" class="btn btn-pink btn-large" id="submit_btn">submit</button><br><br>
                        </div><br>
                        <div class="col-sm-12">
                        <a href="fr8rhome.php" class="btn btn-pink btn-large">Home</a><br><br>
                        </div><br>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--User Detail Ends-->
    <br><br><br><br>

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