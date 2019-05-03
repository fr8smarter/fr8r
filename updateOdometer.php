<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');


// Get search term from URL using the get function
$assetID = get('assetID');




// Initially set $book to null;
$assets = null;


// Get a list of assets from the database with the assetID passed in the URL
$assets = searchAsset($assetID,$database); 
// Set $asset equal to the first asset in $assets
$asset = $assets[0];


//Get array of assetCategories
//$categories = getAssetCategories($database);

//Get array of assetStaus
//$statuses = getAssetStatuses($database);

//$records = getOilRecord($assetID,$database); 
// Set $vehicle equal to the first vehicle in $vehicles
//////$record = $records[0];


//$interval = $asset['oilInterval'];
//$lastOil = $records[0];
//$nextOil = $lastOil['miles'] + $asset['oilInterval'] - $asset['currentMiles'] ;


// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $miles = $_POST['miles'];
    //update odometer
    updateOdometer($database,$assetID, $miles);

	// Redirect to oilChangeStatus page
	header("location: oilChangeStatus.php?assetID=".$assetID);
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


<body>
<!-- Asset Detail Form-->
<br><br><br><br>

<pre>

<?php 
//print_r($asset)
?> 
</pre>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Update odometer reading for <?php echo $asset['asset']?></h2><br>
                </div>

            </div>
        </div>


        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" method = "POST">
                    <div class="row" style="text-align:center">  
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Odometer:</label>
                                    <input class="form-control" type="text" value="<?php echo number_format($asset['currentMiles'])?>" id="miles" name="miles">
                            </div>
                        </div>

                        <div class="col-sm-12"><br><br>
                            <button type="submit" class="btn btn-pink btn-large" id="submit_btn">submit</button><br><br>
                        </div><br>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" style="text-align:center">  
            <div class="col-sm-12">        
                    <a href="fleet.php" class="btn btn-pink btn-large">Fleet</a>
            </div>
        </div>

    </div>
<!--Asset Detail Ends-->
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