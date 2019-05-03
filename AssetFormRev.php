<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

// Get type of form either add or edit from the URL  
$action = $_GET['action'];

// Get search term from URL using the get function
$assetID = get('assetID');

//Set UserID
$userID = $_SESSION['userID'];
$user = $_SESSION['username'];
// Initially set $book to null;
$assets = null;

if($action == 'edit') {
// Get a list of assets from the database with the assetID passed in the URL
$assets = searchAsset($assetID,$database); 
// Set $asset equal to the first asset in $assets
$asset = $assets[0];
}

//Create array of allowable photo file types
$allowed =['image/pjpeg','image/*;capture=camera','image/jpeg', 'image/JPG', 'image/X-PNG', 'image/png', 'image/x-png'];
//create errors array
$errors = [];   
//create new file name varaible
$newFileName = null;
//Get array of assetCategories
$categories = getAssetCategories($database);

//Get array of assetStaus
$statuses = getAssetStatuses($database);

//test
//$name = ''; 
//$type = ''; 
//$size = ''; 



// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$assetName = $_POST['asset'];
    $modelYear = $_POST['modelYear'];
    $miles = $_POST['miles'];
    $acquireDate = $_POST['acquireDate'];   
    $assetCategory = $_POST['assetCategory'];  
    $assetStatus = $_POST['assetStatus'];  
	$oilInterval = $_POST['oilInterval'];
    $engineOil = $_POST['engineOil'];
    $oilQty = $_POST['oilQty'];
    $currentValue = $_POST['currentValue'];
    $transmissionFluid = $_POST['transmissionFluid'];
    $sparkPlug = $_POST['sparkPlug'];
    $oilFilter = $_POST['oilFilter'];
    $airFilter = $_POST['airFilter'];
    $VIN = $_POST['VIN'];
    $keyBattery = $_POST['keyBattery'];
    $tireSize = $_POST['tireSize'];
    $notes = $_POST['notes'];	



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
    
        if(empty($errors)){
          
            // Insert new asset without image URL
            insertAsset($database,
            $userID, $assetName, $modelYear, $miles, $acquireDate,  $assetCategory, $assetStatus,
            $oilInterval, $engineOil, $oilQty, $currentValue, $transmissionFluid, $sparkPlug, $oilFilter,
            $airFilter, $VIN, $keyBattery, $tireSize, $notes
            );

            //if image included on form...
            if (!empty($_FILES['upload']['name'])) { 
            //get last asset ID
            $lastAsset=getLastAsset($database);
            $lastCreatedAsset = $lastAsset[0];
            $lastAssetID = $lastCreatedAsset['LAST_INSERT_ID()'];

            //create image filename
            $newFileName = $lastAssetID.'Assetphoto'.'jpg';
            
            $url = "images/assetIMG/".$newFileName;
            $filename = compress_image($_FILES["upload"]["tmp_name"], $url, 40);

            //update assetID record with iamge URL
            $imageURL = "images/assetIMG/".$newFileName;
            updateAssetImageURL($database,$lastAssetID,$imageURL);

            //unlink tmp file
            if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
                unlink($_FILES['upload']['tmp_name']);
                }

            }
            // Redirect to fleet page
            header('location: fleet.php');
        }
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

    elseif ($action == 'edit') 
    
                    
    
    
    {
        //if there is a photo
        if (!empty($_FILES['upload']['name'])) {
            //verify if correct file type selected
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
            //if not correct file type add error to $errors array
             else {
            $errors[] =  "only PNG and JPG file types allowed";
            }
            //check for upload errors and log in $errors array
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
        } //end of photo validation

        if(empty($errors)){
   
            updateAsset($database,
            $assetID, $assetName, $modelYear, $miles, $acquireDate,  $assetCategory, $assetStatus,
            $oilInterval, $engineOil, $oilQty, $currentValue, $transmissionFluid, $sparkPlug, $oilFilter,
            $airFilter, $VIN, $keyBattery, $tireSize, $notes
            );

            if (!empty($_FILES['upload']['name'])) {
            
            $newFileName = $assetID.'Assetphoto'.$fileType;
            move_uploaded_file($_FILES['upload']['tmp_name'],"images/assetIMG/".$newFileName);
            

            $filename = "images/assetIMG/".$newFileName;
            $exif = exif_read_data($filename);
            echo $exif['Orientation'];

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


            $source = "images/assetIMG/".$newFileName;

            //compress file on upload
            $url = "images/assetIMG/".$assetID.'Assetphoto'.'jpg';
            $filename = compress_image($source, $url, 40);
        
            //end of new code

            //unlink tmp photo
            if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
            unlink($_FILES['upload']['tmp_name']);
            }
            //update asset
            $imageURL = "images/assetIMG/".$newFileName;
            updateAssetImageURL($database,$assetID,$imageURL);
            }
    	    // Redirect to fleet page
	        header('location: fleet.php');
            }
           
        else ; //report errors if any?>  
        
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
<?php //include('includes/appHeader.php'); ?>
<!--header end-->


<body>
<!-- Asset Detail Form-->
<br><br>

<pre>

<?php 
//print_r($asset)
?> 
</pre>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Welcome <?php echo $user?> </h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <div class="title text-center pb-5">
                        <?php if (!empty($asset['imageURL'])) : ?>
                            <img src="<?php echo $asset['imageURL']."?".time()?>" alt="" height="300" >
                        <?php endif;?>  
                    </div>    
                    <!--<p class="mb-4"><?php echo $action." ".$asset['asset']?></p> -->
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-12">
                <form class="getin_form" enctype="multipart/form-data" method = "POST">
                    <div class="row" style="text-align:center">
                        <div class="col-sm-12" id="result"></div> 
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Assets:</label>
                                <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder= "Asset: " required id="asset" name="asset">
                                <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo $asset['asset']?>" required id="asset" name="asset">
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Model Year:</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder= "Year: " required id="modelYear" name="modelYear">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo $asset['modelYear']?>" required id="modelYear" name="modelYear">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Date Acquired:</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="date" placeholder= "Date Acquired: mm/dd/yyyy" required id="acquireDate" name="acquireDate">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="date" value= "<?php echo date("Y-m-d", strtotime($asset['acquireDate']))?>" required id="acquireDate" name="acquireDate">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Current Value:</label>
                            <?php if($action == 'add') : ?>
                            <input class="form-control" type="number" placeholder= "Value: $"required id="currentValue"  name="currentValue">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "$<?php echo number_format($asset['currentValue'])?>" required id="currentValue" name="currentValue">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Current Miles:</label>
                            <?php if($action == 'add') : ?>
                            <input class="form-control" type="number" placeholder= "Current Miles: " required id="currentMiles"  name="miles">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value= "<?php echo number_format($asset['currentMiles'])?>" required id="currentMiles" name="miles">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Oil Change Interval:</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="number" placeholder="Oil Change Interval :" required id="oilInterval" name="oilInterval">
                            <?php elseif($action == 'edit') : ?>
                                <input class="form-control" type="text" value="<?php echo number_format($asset['oilInterval'])?>" required id="oilInterval" name="oilInterval">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Engine Oil:</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="Engine Oil : " id="engineOil" name="engineOil">
                            <?php elseif($action == 'edit') : ?>
                                <?php if(empty($asset['engineOil'])): ?>
                                    <input class="form-control" type="text" placeholder="Engine Oil : " id="engineOil" name="engineOil">
                                <?php else: ?>
                                    <input class="form-control" type="text" value="<?php echo $asset['engineOil']?>" id="engineOil" name="engineOil">
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Oil Filter</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="Oil Filter : " id="oilFilter" name="oilFilter">
                            <?php elseif($action == 'edit') : ?>
                                <?php if(empty($asset['oilFilter'])): ?>
                                    <input class="form-control" type="text" placeholder="Oil Filter : " id="oilFilter" name="oilFilter">
                                <?php else: ?>
                                    <input class="form-control" type="text" value="<?php echo $asset['oilFilter']?>" id="oilFilter" name="oilFilter">
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Oil Qty (QTS):</label>
                            <?php if($action == 'add') : ?>
                                <input class="form-control" type="text" placeholder="Oil Qty (Qts) : " id="oilQty" name="oilQty">
                            <?php elseif($action == 'edit') : ?>
                                <?php if(empty($asset['oilQty'])) :?>
                                    <input class="form-control" type="text" placeholder="Oil Qty (Qts) :" id="oilQty" name="oilQty">
                                <?php else:?>
                                    <input class="form-control" type="text" value="<?php echo $asset['oilQty']?>" id="oilQty" name="oilQty">
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Spark Plugs:</label>
                                <?php if($action == 'add') : ?>
                                    <input class="form-control" type="text" placeholder = "Spark Plugs: "  id="sparkPlug" name="sparkPlug">
                                <?php elseif($action == 'edit'): ?>
                                    <?php if(empty($asset['sparkPlug'])) :?>
                                        <input class="form-control" type="text" placeholder = "Spark Plugs: "  id="sparkPlug" name="sparkPlug">
                                    <?php else: ?>
                                        <input class="form-control" type="text" value = "<?php echo $asset['sparkPlug']?>" id="sparkPlug" name="sparkPlug">
                                    <?php endif; ?> 
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">VIN:</label>
                                <?php if($action == 'add') : ?>
                                    <input class="form-control" type="text" placeholder = "VIN : "  id="VIN" name="VIN">
                                <?php elseif($action == 'edit') : ?>
                                    <?php if(empty($asset['VIN'])):?>
                                        <input class="form-control" type="text" placeholder = "VIN : "  id="VIN" name="VIN">
                                    <?php else: ?>
                                        <input class="form-control" type="text" value = "<?php echo $asset['VIN']?>" id="VIN" name="VIN">
                                    <?php endif; ?> 
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Tire Size:</label>
                                <?php if($action == 'add') : ?>
                                    <input class="form-control" type="text" placeholder ="Tire Size : " id="tireSize" name="tireSize">
                                <?php elseif($action == 'edit'): ?>
                                    <?php if(empty($asset['tireSize'])):?>
                                        <input class="form-control" type="text" placeholder ="Tire Size : " id="tireSize" name="tireSize">
                                    <?php else: ?>
                                        <input class="form-control" type="text" value ="<?php echo $asset['tireSize']?>" id="tireSize" name="tireSize">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Air Filter:</label>
                                <?php if($action == 'add') : ?>
                                    <input class="form-control" type="text" placeholder ="Air FIlter : " id="airFilter" name="airFilter">
                                <?php elseif($action == 'edit') : ?>
                                    <?php if(empty($asset['airFilter'])):?>
                                        <input class="form-control" type="text" placeholder ="Air FIlter : " id="airFilter" name="airFilter">
                                    <?php else: ?>
                                        <input class="form-control" type="text" value ="<?php echo $asset['airFilter']?>" id="airFilter" name="airFilter">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Transmission Fluid:</label>
                                <?php if($action == 'add') : ?>
                                    <input class="form-control" type="text" placeholder ="Transmission Fluid : " id="transmissionFluid" name="transmissionFluid">    
                                <?php elseif($action == 'edit') : ?>
                                    <?php if(empty($asset['transmissionFluid'])):?>
                                        <input class="form-control" type="text" placeholder ="Transmission Fluid : " id="transmissionFluid" name="transmissionFluid">    
                                    <?php else: ?>
                                        <input class="form-control" type="text" value ="<?php echo $asset['transmissionFluid']?>" id="transmissionFluid" name="transmissionFluid">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Key Battery:</label>
                                <?php if($action == 'add') : ?>
                                    <input class="form-control" type="text" placeholder ="Key Battery : " id="keyBattery" name="keyBattery">   
                                <?php elseif($action == 'edit') : ?>
                                    <?php if(empty($asset['keyBattery'])):?>   
                                        <input class="form-control" type="text" placeholder ="Key Battery : " id="keyBattery" name="keyBattery">   
                                    <?php else: ?>
                                        <input class="form-control" type="text" value ="<?php echo $asset['keyBattery']?>" id="keyBattery" name="keyBattery">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <label class="form-label">Asset Category:</label>
                            <?php if($action == 'edit') : ?>
                                <select class="form-control" required id= "assetCategory" name = "assetCategory">
                                        <?php foreach ($categories as $category) : ?>
                                            <?php if($category['assetCatID'] == $asset['assetCategory']): ?>
                                                <option class="form-control" value="<?php echo $category['assetCatID']?>" selected ><?php echo $category['assetCatDesc'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $category['assetCatID']?>"><?php echo $category['assetCatDesc'] ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?> 
                                </select>     
                             <?php elseif($action == 'add') : ?>
                                <select class="form-control" required id= "assetCategory" name = "assetCategory">
                                    <?php foreach ($categories as $category) : ?>
                                            <option class="form-control" value="<?php echo$category['assetCatID']?>"><?php echo $category['assetCatDesc'] ?></option>
                                        <?php endforeach; ?>  
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Asset Status:</label>  
                                <?php if($action == 'edit') : ?>
                                    <select class="form-control" id= "assetStatus" name = "assetStatus">
                                        <?php foreach ($statuses as $status) : ?>
                                            <?php if($status['assetStatusID'] == $asset['assetStatus']): ?>
                                                <option class="form-control" value="<?php echo $status['assetStatusID']?>" selected ><?php echo $status['assetStatusDesc'] ?></option>
                                            <?php else :?>   
                                                <option class="form-control" value="<?php echo $status['assetStatusID']?>" ><?php echo $status['assetStatusDesc'] ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?> 
                                    </select>     
                                    <?php elseif($action == 'add') : ?>
                                        <select class="form-control" id= "assetStatus" name = "assetStatus" >
                                            <?php foreach ($statuses as $status) : ?>
                                            <option class="form-control" value="<?php echo $status['assetStatusID']?>" ><?php echo $status['assetStatusDesc'] ?></option>
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
                                    <textarea class="form-control" placeholder="Notes : " id="notes" name="notes"></textarea>
                                <?php elseif($action == 'edit') : ?>
                                    <?php if(empty($asset['notes'])):?>   
                                        <textarea class="form-control" placeholder="Notes : " id="notes" name="notes"></textarea>
                                    <?php else :?>   
                                        <textarea class="form-control" id="notes" name="notes"><?php echo $asset['notes']?></textarea>
                                    <?php endif; ?>
                                <?php endif; ?> 
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-pink btn-large" id="submit_btn">submit</button><br><br>
                        </div>
                        <div class="col-sm-12">
                            <a href="fleet.php" class="btn btn-pink btn-large">Fleet</a>
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