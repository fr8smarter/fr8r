<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

// Get search term from URL using the get function
$trxID = get('trxID');

// Get a list of vehicles from the database with the vehicleID passed in the URL
$records = getMaintRecord($trxID, $database); 

// Set $vehicle equal to the vehicle book in $vehicles
$record = $records[0];


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
<!-- Vehicle Detail Form-->
<br><br><br><br>

<pre>
<?php 
//verify record array
//print_r($record); ?>
</pre>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Maintenance Record</h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4">Detail</p>
                    <div class="title text-center pb-5">
                        <?php if (!empty($record['maintImageURL'])) : ?>
                            <img src="<?php echo $record['maintImageURL']."?".time()?>" alt="" height="300" >
                        <?php endif;?>  
                    </div>    
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" method = "POST">
                    <div class="row" style="text-align:center">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value= "Vehicle: <?php echo $record['asset']?>" required id="asset" name="asset">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value= "Year: <?php echo $record['modelYear']?>" required id="modelYear" name="modelYear">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value= "Cost: $<?php echo $record['cost']?>" required id="cost" name="cost">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                <input class="form-control" type="date" value= "<?php echo date("m-d-Y", strtotime($record['serviceDate']))?>" required id="serviceDate" name="serviceDate">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Description : <?php echo $record['serviceDesc']?>"  id="description" name="description">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Odometer : <?php echo number_format($record['miles'])?>" required id="currentMiles" name="currentMiles">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Maintenance Category : <?php echo $record['categoryDesc']?>" required id="category" name="Desc">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="Vendor : <?php echo $record['vendorName']?>" required id="vendor" name="vendor">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <textarea class="form-control" placeholder="Notes : " id="maintNotes" name="maintNotes"><?php echo $record['maintNotes']?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <a href="maintRecords.php" class="btn btn-pink btn-large">Maintenance Records</a><br><br>
                                </div><br>
                            <div class="col-sm-12">
                                <a href="maintForm.php?action=edit&trxID=<?php echo $record['trxID'] ?>" class="btn btn-pink btn-large">Edit Maintenance Record</a><br><br>
                                <a href="deleteForm.php?type=maintenance&recordID=<?php echo $record['trxID'] ?>" class="btn btn-pink btn-large">Delete Record</a>
                                </div>    
                            </div>
                        </div>
                </form>
            </div>
            
        </div>
    </div>
<!--Vehicle Detail Ends-->
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