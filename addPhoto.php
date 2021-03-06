<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

if ($_SERVER['REQUEST_METHOD']== 'POST') {
    if (isset($_FILES['upload'])) {
        //validate file type
        $allowed =['image/pjpeg','image/*;capture=camera','image/jpeg', 'image/JPG', 'image/X-PNG', 'image/png', 'image/x-png'];
        if (in_array($_FILES['upload']['type'], $allowed)) {
            //move file to temp DIR
            if (move_uploaded_file ($_FILES['upload']['tmp_name'],
             "../fr8rImages/assetIMG/{$_FILES['upload']['name']}")){
                 echo 'It Worked!';
             }
             else {
                 echo "wrong file type";
             }
        }

    } //end of isset
    if ($_FILES['upload']['error'] > 0) {
        echo '<p>the file could not be loaded because:<strong>';

        switch ($_FILES['upload']['error']){
            case 1:
                print "exceeds max upload in php.ini";
                break;
            case 2:
                print "exceeds max size in HTML form";
                break;
            case 3:
                print "partially uploaded";
                break;
            case 4:
                print "no file uploaded";
                break;            
            case 6:
                print "no temp folder was available";
                break;
            case 7:
                print "ubnable to write to disk";
                break;            
            case 8:
                print "upload stopped";
                break; 
            default:
                print "a system error occurred" ;      
        } //end of switch
        print '</strong></p>';
    }
    if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
        unlink($_FILES['upload']['tmp_name']);
    }
} //end of submit conditional


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
<script
src="https://code.jquery.com/jquery-3.4.0.min.js"
integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
crossorigin="anonymous"></script>



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
  <?php //include('includes/appHeader.php'); ?>
  <!--header end-->
  <br><br><br><br>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <a class="weatherwidget-io" href="https://forecast7.com/en/39d10n84d51/<?php echo strtolower($user->get_city())?>/?unit=us" data-label_1="<?php echo strtoupper($user->get_city())?>" data-label_2="WEATHER" data-theme="pure" >CINCINNATI WEATHER</a>
        <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
        </script>
      </div>
    </div>
  </div>
  <br><br>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="title text-center pb-5">
          <h2 class="font-weight-600 m-0">Welcome <?php echo $user->get_fName()?> </h2>
          <p class="mb-4">Fr8R &trade; is at your service </p>
          <span class="hr-line mt-4 mb-4"></span>
          <h3 class="font-weight-600 m-0">Add Text</h3><br><br>
        </div>
      </div>
    </div>
   
    <div class="row" >
      <div class="col-sm-12">
        <div class="title text-center pb-5">
          <form class="getin_form" enctype="multipart/form-data" action = "" method = "POST">
              <div class="form-group">
                <h2 class="font-weight-600 m-0">Upload a file</h2><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="999999999">
                <input type="file" name="upload" accept = "image/*"><br><br>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-pink btn-large" id="submit_btn">submit</button><br><br>
                </div>
  
              </div>
          </form>
        </div>
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

  <script src="js/map.js"></script>
  <!-- custom script -->
  <script src="js/script.js"></script>
</body>
</html>


<script>
    apiParams = {
        apiKey: 123,
        action: 'getAssets'
    }
    
    //$.post( "api.php", apiParams, function( data ) {
    //    console.log( data ); // John
    //}, "json");^/
    
$.ajax({
    method: "POST",
    url: "api.php",
    data: apiParams,
    dataType: 'json'
})
  .done(function( data ) {
    console.log(data);

  });

//jquery 

//.submit 

</script>

