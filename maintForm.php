<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

// Get type of form either add or edit from the URL  
$action = get('action');

// Get search term from URL using the get function
$trxID = get('trxID');

//Get asset ID
$assetID = get('assetID');

//Set UserID
$userID = $user->get_userID();

// Initially set $record to null;
$record = null;

if($action == 'edit') {
// Get a list of vehicles from the database with the vehicleID passed in the URL
$records = getMaintRecord($trxID,$database); 
// Set $vehicle equal to the first vehicle in $vehicles
$record = $records[0];
}


//Get array of systems
$systems = getSystems($database);
//Get array of assetCategories
$categories = getMaintCategories($database);

//Get array of assetStaus
$vendors = getVendors($database);

//Create array of allowable photo file types
$allowed =['image/pjpeg','image/*;capture=camera','image/jpeg', 'image/JPG', 'image/X-PNG', 'image/png', 'image/x-png'];
//create errors array
$errors = [];   
//create new file name varaible
$newFileName = null;

// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$serviceDate = $_POST['serviceDate'];
    $serviceDesc = $_POST['serviceDesc'];
    $vehicleSystem = $_POST['vehicleSystem'];
    $miles = $_POST['miles'];   
    $cost = $_POST['cost'];  
    $vendor = $_POST['vendor'];  
	$maintCategory = $_POST['maintCategory'];
    $maintNotes = $_POST['maintNotes'];	

	if($action == 'add') {
        //validate if there is a photo
        if (!empty($_FILES['upload']['name'])) {
            if (in_array($_FILES['upload']['type'], $allowed)) {
                //get file type for file name
                switch ($_FILES['upload']['type']){
                    case 'image/pjpg':
                        $fileType = ".pjpg";
                        break;
                    case 'image/jpeg':
                        $fileType = ".jpg";
                        break;
                    case 'image/JPG':
                        $fileType = ".jpg";
                        break;
                    case 'image/X-PNG':
                        $fileType = ".X-PNG";
                        break;
                    case 'image/png':
                        $fileType = ".png";
                        break;
                    case 'image/x-png':
                        $fileType = ".x-png";
                        break;
                    default:
                        $fileType = "";
                } //end of switch
            }
            else {
             $errors[] =  "only PNG and JPG file types allowed";
            }
       
            if ($_FILES['upload']['error'] > 0) {
                $errors[] = "The file could not be loaded because:";
                switch ($_FILES['upload']['error']){
                    case 1:
                        $errors[] = "The file exceeds max upload size allowed";
                        break;
                    case 2:
                        $errors[] = "The file exceeds max size allowed by Fr8R&trade";
                        break;
                    case 3:
                        $errors[] =  "The file was partially uploaded";
                        break;
                    case 4:
                        $errors[] = "no file uploaded";
                        break;            
                    case 6:
                        $errors[] = "no temp folder was available";
                        break;
                    case 7:
                        $errors[] = "Unable to write to disk";
                        break;            
                    case 8:
                        $errors[] =  "The upload was stopped, please try again";
                        break; 
                    default:
                        $errors[] =  "A system error occurred, please try again" ;      
                } //end of switch
            }
        } //end o photo validation

        if(empty($errors)){
            // Insert maintenance record without photo
            insertMaintRecord($database, $assetID,
            $userID, $serviceDate, $serviceDesc, $vehicleSystem, $miles, $cost, $vendor,
            $maintCategory, $maintNotes
            );

            //if image included on form...
            if (!empty($_FILES['upload']['name'])) { 
                //get last asset ID
                $lastMaintRecord=getLastMaintRecord($database);
                $lastCreatedMaintRecord = $lastMaintRecord[0];
                $trxID = $lastCreatedMaintRecord['LAST_INSERT_ID()'];

                $newFileName =  $trxID.'maintRecordPhoto'.$fileType;
                
                //upload Photo
                move_uploaded_file($_FILES['upload']['tmp_name'],"images/maintRecordIMG/".$newFileName);
                
                //Correct photo orientation if needede
                $filename = "images/maintRecordIMG/".$newFileName;
                $exif = exif_read_data($filename);
                //echo $exif['Orientation'];

                if (isset($exif['Orientation'])){
                $image = imagecreatefromjpeg($filename);
                    switch ($exif['Orientation']){
                    
                        case 3:
                            $image = imagerotate($image, 180, 0);
                        break;
                
                        case 6:
                            $image = imagerotate($image, -90, 0);
                        break;
                
                        case 8:
                            $image = imagerotate($image, 90, 0);
                        break;
                    }
                    imagejpeg($image, $filename);
                }


            $source = "images/maintRecordIMG/".$newFileName;

            //compress file 
            $url = "images/maintRecordIMG/".$trxID.'maintRecordPhoto'.'.jpg';
            $filename = compress_image($source, $url, 40);
            
            //update Maint record with iamge URL
            $imageURL = $url;
            updateMaintRecordImageURL($database,$trxID,$imageURL);

            //unlink tmp file
            if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
                unlink($_FILES['upload']['tmp_name']);
            }

            }          	
            // Redirect to fleet page
	        header('location: maintRecords.php');
        }

        //report errors if any
        else ; ?> 
        <br><br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="title text-center pb-5">
                        <h4 class="mb-4">oops...</h4>
                        <?php foreach ($errors as $error) : ?>
                            <h2 class="mb-4"><?php echo $error ?></h2><br>
                        <?php endforeach; ?>
                        <h4 class="mb-4">please try again</h4>
                    </div>
                </div>
            </div>
        </div> 
        <?php   
    }
    
	elseif ($action == 'edit') {
  
        //validate if there is a photo
        if (!empty($_FILES['upload']['name'])) {
            if (in_array($_FILES['upload']['type'], $allowed)) {
                //get file type and error check file type
                switch ($_FILES['upload']['type']){
                    case 'image/pjpg':
                        $fileType = ".pjpg";
                        break;
                    case 'image/jpeg':
                        $fileType = ".jpg";
                        break;
                    case 'image/JPG':
                        $fileType = ".jpg";
                        break;
                    case 'image/X-PNG':
                        $fileType = ".X-PNG";
                        break;
                    case 'image/png':
                        $fileType = ".png";
                        break;
                    case 'image/x-png':
                        $fileType = ".x-png";
                        break;
                    default:
                        $fileType = "";
                } //end of switch
            }

            else {
             $errors[] =  "only PNG and JPG file types allowed";
            }
        
            //check upload errors
            if ($_FILES['upload']['error'] > 0) {
                $errors[] = "The file could not be loaded because:";
                switch ($_FILES['upload']['error']){
                    case 1:
                        $errors[] = "The file exceeds max upload size allowed";
                        break;
                    case 2:
                        $errors[] = "The file exceeds max size allowed by Fr8R&trade";
                        break;
                    case 3:
                        $errors[] =  "The file was partially uploaded";
                        break;
                    case 4:
                        $errors[] = "no file uploaded";
                        break;            
                    case 6:
                        $errors[] = "no temp folder was available";
                        break;
                    case 7:
                        $errors[] = "Unable to write to disk";
                        break;            
                    case 8:
                        $errors[] =  "The upload was stopped, please try again";
                        break; 
                    default:
                        $errors[] =  "A system error occurred, please try again" ;      
                } //end of switch
            }
        } //end of photo error checking

        if(empty($errors)){
          
            // Update maint record without image URL
            updateMaintRecord($database,
            $trxID, $serviceDate, $serviceDesc, $vehicleSystem, $miles, $cost, $vendor,
            $maintCategory, $maintNotes
            );

            if (!empty($_FILES['upload']['name'])) {
            
                $newFileName = $trxID.'maintRecordPhoto'.$fileType;
                move_uploaded_file($_FILES['upload']['tmp_name'],"images/maintRecordIMG/".$newFileName);
                
    
                $filename = "images/maintRecordIMG/".$newFileName;
                $exif = exif_read_data($filename);
                //echo $exif['Orientation'];
    
                if (isset($exif['Orientation'])){
                $image = imagecreatefromjpeg($filename);
                switch ($exif['Orientation']){
                
                    case 3:
                        $image = imagerotate($image, 180, 0);
                    break;
            
                    case 6:
                        $image = imagerotate($image, -90, 0);
                    break;
            
                    case 8:
                        $image = imagerotate($image, 90, 0);
                    break;
                    }
                imagejpeg($image, $filename);
                }
    
                $source = "images/maintRecordIMG/".$newFileName;

                //compress file 
                $url = "images/maintRecordIMG/".$trxID."maintRecordPhoto".".jpg";
                $filename = compress_image($source, $url, 40);
            
                //unlink tmp photo
                if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
                unlink($_FILES['upload']['tmp_name']);
                }
                //update asset
                $imageURL = $url;

                updateMaintRecordImageURL($database,$trxID,$imageURL);
            }
            // Redirect to fleet page
           header('location: maintRecords.php');
        }
            
        //report errors if any
        else ; ?> 
        <br><br><br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="title text-center pb-5">
                            <h4 class="mb-4">oops...</h4>
                            <?php foreach ($errors as $error) : ?>
                                <h2 class="mb-4"><?php echo $error ?></h2><br>
                            <?php endforeach; ?>
                            <h4 class="mb-4">please try again</h4>
                        </div>
                    </div>
                </div>
            </div> 
            <?php   
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
<!-- Vehicle Detail Form-->
<br><br><br><br>

<pre>
<?php 
//verify record array
//print_r($categories);
//print_r($record);
//print_r($systems)?>
</pre>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Welcome <?php echo $user->get_fName()?> </h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4"><?php echo $action." maintenance record for ".$record['asset']?></p>
                </div>
                <div class="title text-center pb-5">
                        <?php if (!empty($record['maintImageURL'])) : ?>
                            <img src="<?php echo $record['maintImageURL']."?".time()?>" alt="" height="300" >
                        <?php endif;?>  
                    </div>   
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" enctype="multipart/form-data" method = "POST">
                    <div class="row" style="text-align:center">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Date of Service:</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="date" placeholder= "Date of service: " required id="serviceDate" name="serviceDate">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="date" value= "<?php echo date("Y-m-d", strtotime($record['serviceDate']))?>" required id="serviceDate" name="serviceDate">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Description:</label>
                            <?php if($action == 'add') : ?>
                            <input class="form-control" type="text" placeholder= "Description of Service: "required id="serviceDesc"  name="serviceDesc">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo $record['serviceDesc']?>" required id="serviceDesc" name="serviceDesc">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Vehicle System:</label>  
                                <?php if($action == 'edit') : ?>
                                    <select class="form-control" id= "vehicleSystem" name = "vehicleSystem">
                                        <?php foreach ($systems as $system) : ?>
                                            <?php if($system['systemID'] == $record['vehicleSystem']): ?>
                                                <option class="form-control" value="<?php echo $system['systemID']?>" selected ><?php echo $system['systemDesc'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $system['systemID']?>" ><?php echo $system['systemDesc'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?> 
                                    </select>     
                                <?php elseif($action == 'add') : ?>
                                    <select class="form-control" id= "vehicleSystem" name = "vehicleSystem">
                                        <?php foreach ($systems as $system) : ?>
                                            <option class="form-control" value="<?php echo $system['systemID']?>" ><?php echo $system['systemDesc'] ?></option>
                                        <?php endforeach; ?>  
                                         </select>
                                <?php endif; ?>
                                       
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Odometer:</label>
                            <?php if($action == 'add') : ?>
                            <input class="form-control" type="number" placeholder= "Odometer: " required id="miles"  name="miles">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo number_format($record['miles'])?>" required id="miles" name="miles">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Cost:</label>
                                    <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="Cost :" required id="cost" name="cost">
                                    <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value="$<?php echo number_format($record['cost'],2)?>" required id="cost" name="cost">
                                    <?php endif; ?>
                                    </div>
                            </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Vendor:</label>
                                <?php if($action == 'edit') : ?>
                                    <select class="form-control" required id= "vendor" name = "vendor">
                                        <?php foreach ($vendors as $vendor) : ?>
                                            <?php if($vendor['vendorID'] == $record['vendorID']): ?>
                                                <option class="form-control" value="<?php echo $vendor['vendorID']?>" selected ><?php echo $vendor['vendorName'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $vendor['vendorID']?>"><?php echo $vendor['vendorName'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?> 
                                    </select>     
                                <?php elseif($action == 'add') : ?>
                                    <select class="form-control" required id= "vendor" name = "vendor">
                                        <?php foreach ($vendors as $vendor) : ?>
                                            <option class="form-control" value="<?php echo $vendor['vendorID']?>"><?php echo $vendor['vendorName'] ?></option>
                                        <?php endforeach; ?>  
                                    </select>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Maintenance Category:</label>  
                                <?php if($action == 'edit') : ?>
                                    <select class="form-control" required id= "maintCategory" name = "maintCategory">
                                        <?php foreach ($categories as $category) : ?>
                                            <?php if($category['categoryID'] == $record['maintCategory']): ?>
                                                <option class="form-control" value="<?php echo $category['categoryID']?>" selected ><?php echo $category['categoryDesc'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $category['categoryID']?>" ><?php echo $category['categoryDesc'] ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?> 
                                    </select>     
                                    <?php elseif($action == 'add') : ?>
                                        <select class="form-control" required id= "maintCategory" name = "maintCategory" >
                                            <?php foreach ($categories as $category) : ?>
                                            <option class="form-control" value="<?php echo $category['categoryID']?>" ><?php echo $category['categoryDesc'] ?></option>
                                            <?php endforeach; ?>  
                                        <?php endif; ?>
                                    </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group mb-4">
                                <?php if($action == 'add') : ?>
                                    <label class="form-label">Upload Photo (JPG or PNG format):</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                    <input class="form-control" type="file" name="upload" ><br><br>
                                <?php elseif($action == 'edit') : ?>
                                    <label class="form-label">Add/Change Photo (JPG or PNG format):</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                    <input class="form-control"type="file" name="upload" ><br><br>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="form-label">Notes:</label>
                                <?php if($action == 'add') : ?>
                                    <textarea class="form-control" placeholder="Maintenance Notes : " id="maintNotes" name="maintNotes"></textarea>
                                <?php elseif($action == 'edit') : ?>
                                    <?php if(empty($record['maintNotes'])) : ?>
                                        <textarea class="form-control" placeholder="Maintenance Notes : " id="maintNotes" name="maintNotes"></textarea>
                                    <?php else: ?>
                                        <textarea class="form-control" id="maintNotes" name="maintNotes"><?php echo $record['maintNotes']?></textarea>
                                    <?php endif; ?>
                                <?php endif; ?> 
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-pink btn-large" id="submit_btn">submit</button><br><br>
                        </div>
                        <div class="col-sm-12">
                                <a href="maintRecords.php" class="btn btn-pink btn-large">Maintenance Records</a>
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