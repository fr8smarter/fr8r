<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

// Get search term from URL using the get function
$term = get('search-term');
//$userID = $user->get_userID();


$vendors = searchVendors($term, $database);

$user = $_SESSION['username'];
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



    <br><br><br><br>
	<div class="container">
    <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Welcome <?php echo $user?> </h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4">This is where you manage your vendors</p>
                    <div class="col-sm-12">
                        <a href="vendorForm.php?action=add" class="btn btn-pink btn-large">Add a Vendor</a>
                    </div>
                </div>      
            </div>
        </div>

        <div class="row" >
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <form class="getin_form" method = "GET">
                        <div class="form-group">
                            <h2 class="font-weight-600 m-0">Vendor filter:</h2><br>
                            <input type="text" name="search-term" placeholder="Search..." /><br><br>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-pink btn-large" id="submit_btn">submit</button><br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>                
        </div>

        
    <br><br>

    <div class = "row">  
        <span class="hr-line mt-4 mb-4"></span>
    </div>

    <div class = "row">  
        <div class="col-sm-12">
            <div class="row" style="text-align:center">      
                <?php foreach($vendors as $vendor) : ?>
                    <div class="col-md-6 col-sm-6">
                        <h4 class="text-capitalize"><?php echo $vendor['vendorName']; ?></h4>
                        <h5 class="text-capitalize"><?php echo $vendor['address1']; ?></h5>
                        <h5 class="text-capitalize"><?php echo $vendor['vendorCity']. "   ".$vendor['stateAbbrev']; ?></h5>
                        <a href="tel:5133166259"> <h5 style= "color:#7e2662" class="text-capitalize"><?php echo $vendor['phone']; ?></h5>  </a>  
                        <a href="vendorForm.php?action=edit&vendorID=<?php echo $vendor['vendorID'] ?>">Edit Record</a><br>
                        <a href="vendorDetail.php?vendorID=<?php echo $vendor['vendorID'] ?>">View Record</a><br>
                        <a href="deleteForm.php?type=vendor&recordID=<?php echo $vendor['vendorID'] ?>">Delete Record</a>
                        <span class="hr-line mt-4 mb-4"></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

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