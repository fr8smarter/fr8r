<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

// Get type of form either add or edit from the URL  
$action = get('action');

//Get countries
$countries = getCountries($database);
//Get states
$states = getStatesUS($database);

//Set UserID
$userID = $_SESSION['userID'];
$user = $_SESSION['username'];

// Initially set $record to null;
$record = null;

if($action == 'edit') {

// Get vendorID term from URL using the get function
$vendorID = get('vendorID');

// Get a list of vendors from the database with the vendorID passed in the URL
$vendors = getVendorRecord($vendorID,$database); 
// Set $vendor equal to the first vendor in $vendorss
$vendor = $vendors[0];
}

$errors = [];
// If form submitted

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isValidZipCode($_POST['zip']) == 'no') {
        $errors[] = 'Please Enter a valid zip code';
    } else {
         $zip = $_POST['zip'];
    }
    $vendorName = $_POST['vendorName'];
    $vendorContact = $_POST['vendorContact'];
    $email = $_POST['email'];   
    $website = $_POST['website']; 
    $phone = $_POST['phone'];  
    $address1 = $_POST['address1'];  
	$address2 = $_POST['address2'];
    $vendorCity = $_POST['vendorCity'];	
    $vendorStateID = $_POST['vendorStateID'];	
    $countryID = $_POST['countryID'];	
    $vendorNotes = $_POST['vendorNotes'];	

    if(empty($errors)){

        if($action == 'add') {
            // Insert vendor
            insertVendor($database, $vendorName,
            $vendorContact, $email, $website, $phone, $address1, $address2, $vendorCity,
            $vendorStateID, $zip, $countryID, $vendorNotes
            );
        }
        elseif ($action == 'edit') {
            //update vendor
            updateVendor($database, $vendorID, $vendorName,
            $vendorContact, $email, $website, $phone, $address1, $address2, $vendorCity,
            $vendorStateID, $zip, $countryID, $vendorNotes
            );
        }

        // Redirect to fleet page
        header('location: vendors.php');
        }
        else {

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


<body>
<!-- Vendor Detail Form-->
<br><br><br><br>

<pre>
<?php 
//verify record array
//print_r($record);
//print_r($systems)?>
</pre>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Welcome <?php echo $user?> </h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4"><?php echo $action." Vendor Record"?></p>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" method = "POST">
                    <div class="row" style="text-align:center">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Vendor Name:</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder= "Vendor Name: " required id="vendorName" name="vendorName">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo $vendor['vendorName']?>" required id="vendorName" name="vendorName">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Contact:</label>
                            <?php if($action == 'add') : ?>
                            <input class="form-control" type="text" placeholder= "Vendor Contact: " id="vendorContact"  name="vendorContact">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo $vendor['vendorContact']?>" required id="vendorContact" name="vendorContact">
                                <?php endif; ?>
                            </div>
                        </div>
                
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">vendorEmail:</label>
                            <?php if($action == 'add') : ?>
                            <input class="form-control" type="email" placeholder= "E-mail: " id="email"  name="email">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="email" value= "<?php echo $vendor['email']?>" id="email" name="email">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Website:</label>
                            <?php if($action == 'add') : ?>
                            <input class="form-control" type="text" placeholder= "Website: " id="website"  name="website">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo $vendor['website']?>"  id="website" name="website">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Phone number:</label>
                                    <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="Phone :" required id="phone" name="phone">
                                    <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value="<?php echo $vendor['phone']?>" required id="phone" name="phone">
                                    <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Address 1:</label>
                                    <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="Address 1 :" required id="address1" name="address1">
                                    <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value="<?php echo $vendor['address1']?>" required id="address1" name="address1">
                                    <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Address 2:</label>
                                    <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="Address 2  :" id="address2" name="address2">
                                    <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value="<?php echo $vendor['address2']?>" id="address2" name="address2">
                                    <?php endif; ?>
                                    </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">City:</label>
                                    <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="City  :" required id="vendorCity" name="vendorCity">
                                    <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value="<?php echo $vendor['vendorCity']?>" required id="vendorCity" name="vendorCity">
                                    <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">State:</label>
                            <?php if($action == 'edit') : ?>
                                <select class="form-control" required id= "vendorStateID" name = "vendorStateID">
                                        <?php foreach ($states as $state) : ?>
                                            <?php if($state['stateID'] == $vendor['vendorStateID']): ?>
                                                <option class="form-control" value="<?php echo $state['stateID']?>" selected ><?php echo $state['stateCase'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $state['stateID']?>"><?php echo $state['stateCase'] ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?> 
                                </select>     
                             <?php elseif($action == 'add') : ?>
                                <select class="form-control" required id= "vendorStateID" name = "vendorStateID">
                                            <?php foreach ($states as $state) : ?>                 
                                            <option class="form-control" value="<?php echo $state['stateID']?>"><?php echo $state['stateCase'] ?></option>
                                        <?php endforeach; ?>  
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Zip:</label>
                                    <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="zip  :" required id="zip" name="zip">
                                    <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value="<?php echo $vendor['zip']?>" required id="zip" name="zip">
                                    <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Country:</label>
                            <?php if($action == 'edit') : ?>
                                <select class="form-control" required id= "countryID" name = "countryID">
                                        <?php foreach ($countries as $country) : ?>
                                            <?php if($country['countryID'] == $vendor['countryID']): ?>
                                                <option class="form-control" value="<?php echo $country['countryID']?>" selected ><?php echo $country['countryName'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $country['countryID']?>"><?php echo $country['countryName'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?> 
                                </select>     
                             <?php elseif($action == 'add') : ?>
                                <select class="form-control" required id= "countryID" name = "countryID">
                                            <?php foreach ($countries as $country) : ?>                 
                                            <?php if($country['countryID'] == 236): ?>
                                                <option class="form-control" value="<?php echo $country['countryID']?>" selected ><?php echo $country['countryName'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $country['countryID']?>"><?php echo $country['countryName'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>  
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="form-label">Notes:</label>
                                <?php if($action == 'add') : ?>
                                    <textarea class="form-control" placeholder="Notes : " id="vendorNotes" name="vendorNotes"></textarea>
                                <?php elseif($action == 'edit') : ?>
                                    <?php if(empty($record['maintNotes'])) : ?>
                                        <textarea class="form-control" placeholder="Notes : " id="vendorNotes" name="vendorNotes"></textarea>
                                    <?php else: ?>
                                        <textarea class="form-control" id="vendorNotes" name="vendorNotes"><?php echo $vendor['vendorNotes']?></textarea>
                                    <?php endif; ?>
                                <?php endif; ?> 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-pink btn-large" id="submit_btn">submit</button><br><br>
                        </div>
                        <div class="col-sm-12">
                                <a href="vendors.php" class="btn btn-pink btn-large">Vendors</a>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--Vendor Detail Ends-->

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