<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');

$term = "";

$fleetValue = fleetValue($userID, $term, $database);
$fleet = $fleetValue[0];

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
    <script src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
    <script>
        function initViz() {
            var containerDiv = document.getElementById("vizContainer"),
                url = "https://public.tableau.com/views/Fr8rDemoViz/FleetTracker?:embed=y&:display_count=yes&publish=yes",
		
                options = {
                    hideTabs: true,
                    hideToolbar: true,
                    onFirstInteractive: function () {
                        console.log("Run this code when the viz has finished loading.");
                    }
                };
            
            var viz = new tableau.Viz(containerDiv, url, options);   
        }
    </script>
   
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="90" onload="initViz()">

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
                    <h3 class="font-weight-600 m-0">The value of your Current fleet is $<?php echo number_format($fleet['sum(currentValue)'])?></h3><br><br>

                </div>
            </div>
        </div>
    </div>

    <div class="container"> 
        <div id="vizContainer"></div> 
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