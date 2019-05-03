<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

// Get search term from URL using the get function
$assetID = get('assetID');

// Get a list of assets from the database with the assetID passed in the URL
$assets = searchAsset($assetID,$database); 

// Set $asset equal to the 1st element in $assets array
$asset = $assets[0];

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

<!-- Asset Detail Form-->
<br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Asset Detail for <?php echo $asset['asset']?></h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4"></p>
                    <div class="title text-center pb-5">
                        <?php if (!empty($asset['imageURL'])) : ?>
                            <img src="<?php echo $asset['imageURL']."?".time()?>" alt="" height="300" >
                        <?php endif;?>  
                    </div>    
                    <div class="col-sm-12">
                        <a href="maintForm.php?action=add&assetID=<?php echo $asset['assetID'] ?>" class="btn btn-pink btn-large">Add Maintenance Record</a>
                    </div>
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
                               
                                    <input class="form-control" type="text" value= "Asset: <?php echo $asset['asset']?>" required id="asset" name="asset">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value= "Year: <?php echo $asset['modelYear']?>" required id="modelYear" name="modelYear">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value= "License Plate: <?php echo $asset['licPlate']?>" required id="licPlate" name="licPlate">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value= "Date Acquired: <?php echo date("m/d/Y", strtotime($asset['acquireDate']))?>" id="acquireDate" name="acquireDate">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value= "Value: $<?php echo number_format($asset['currentValue'])?>" required id="currentValue" name="currentValue">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Oil Change Interval : <?php echo number_format($asset['oilInterval'])?>" required id="oilInterval" name="oilInterval">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Engine Oil : <?php echo $asset['engineOil']?>"  id="engineOil" name="engineOil">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Current Miles : <?php echo number_format($asset['currentMiles'])?>" required id="currentMiles" name="currentMiles">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Oil Filter : <?php echo $asset['oilFilter']?>" required id="oilFilter" name="oilFilter">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Oil Qty (Qts) : <?php echo $asset['oilQty']?>" required id="oilQty" name="oilQty">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Spark Plugs : <?php echo $asset['sparkPlug']?>" required id="sparkPlug" name="sparkPlug">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value = "VIN :<?php echo $asset['VIN']?>" required id="VIN" name="VIN">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value ="Tire Size : <?php echo $asset['tireSize']?>" id="tireSize" name="tireSize">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value ="Air FIlter : <?php echo $asset['airFilter']?>" id="airFilter" name="airFilter">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value ="Transmission Fluid : <?php echo $asset['transmissionFluid']?>" id="transmissionFluid" name="tireSize">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value ="Key Battery : <?php echo $asset['keyBattery']?>" id="keyBattery" name="keyBattery">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <textarea class="form-control" placeholder="Notes : " id="notes" name="notes"><?php echo $asset['notes']?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <a href="fleet.php" class="btn btn-pink btn-large">Fleet</a><br><br>
                                </div><br>
                            <div class="col-sm-12">
                                <a href="assetForm.php?action=edit&assetID=<?php echo $asset['assetID'] ?>" class="btn btn-pink btn-large">Edit Asset</a><br><br>
                                </div>    
                            <div class="col-sm-12">
                                <a href="deleteForm.php?type=vehicle&recordID=<?php echo $asset['assetID'] ?>" class="btn btn-pink btn-large">Delete Asset</a><br><br>
                                </div>    
                            </div>
                        </div>
                    </div>
                </form>
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