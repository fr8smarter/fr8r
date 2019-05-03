<?php
// Include config.php file
//inlcude('includes/config.php');

//Include Functions file
//include('includes/functions.inc.php');


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
<header>
    <nav class="navbar navbar-top-default center-logo navbar-expand-lg nav-line">
        <div class="container">
            <a href="#" title="Logo" class="logo scroll"><img src="images/fr8r_logo_black.png" class="logo-dark" alt="logo">
                <img src="images/fr8r_logo_white.png" alt="logo" class="logo-light default">
            </a>
            <div class="collapse navbar-collapse" id="Heroxnav">
                <ul class="navbar-nav" id="container">
                    <li class="nav-item">
                        <a class="nav-link scroll active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#feature">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#work">Portfolio</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#price">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log-in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#contact">contact </a>
                    </li>
                </ul>
            </div>
            <!--side menu open button-->
            <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
                <span></span> <span></span> <span></span>
            </a>
        </div>
    </nav>
    <!-- side menu -->
    <div class="side-menu">
        <div class="inner-wrapper">
            <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
            <nav class="side-nav w-100">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#feature">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#work">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#price">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log-in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </nav>

            <div class="side-footer text-white w-100">
                <ul class="social-icons-simple">
                <li><a class="facebook-bg-hvr" href="https://www.facebook.com/FPVdata/"><i class="ti ti-facebook"></i> </a> </li>
                    <li><a class="linkedin-bg-hvr" href="https://www.linkedin.com/in/bruce-henry-49650a19/"><i class="ti ti-linkedin"></i> </a> </li>
                    <li><a class="twitter-bg-hvr" href="https://twitter.com/FPVdata"><i class="ti ti-twitter"></i> </a> </li>
                </ul>
                <p class="whitecolor">&copy; <?php echo date("Y"); ?> Fr8R&trade; Powered by False Peak Ventures, LLC </p>
            </div>
        </div>
    </div>
    <a id="close_side_menu" href="javascript:void(0);"></a>
    <!-- End side menu -->
</header>
<!--header end-->

<!--slider start-->
<?php include('includes/slider.php'); ?>
<!--slider end-->

<!--feature start-->
<section id="feature" class="feature circle-top pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-xs-5">
                <div class="feature-box text-center">
                    <i class="ti ti-truck feature-icon" aria-hidden="true"></i>
                    <p class="mt-3 mb-3"> Manage Your Fleet</p>
                    <h4 class="text-capitalize">Keep track of your fleet maintenance and vendors</h4>
                    <span class="hr-line mt-4 mb-4"></span>
                    <a href="signup.php" class="mb-3 mb-lg-0">Get started for free</a>
                </div>
            </div>
            <div class="col-md-4 mb-xs-5">
                <div class="feature-box text-center">
                    <i class="ti ti-target feature-icon" aria-hidden="true"></i>
                    <p class="mt-3 mb-3">Route History</p>
                    <h4 class="text-capitalize">Detailed history of your loads</h4>
                    <span class="hr-line mt-4 mb-4"></span>
                    <a href="signup.php" class="mb-3 mb-lg-0">Get started for free</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <i class="ti ti-world feature-icon" aria-hidden="true"></i>
                    <p class="mt-3 mb-3">Route Analyzer</p>
                    <h4 class="text-capitalize">Know your profit before you book your next load</h4>
                    <span class="hr-line mt-4 mb-4"></span>
                    <a href="signup.php" class="mb-3 mb-lg-0">Get started for free</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--feature end-->

<!--team start-->
<section id="team" class="team circle-left">
    <h2 class="d-none" aria-hidden="true">hidden</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="team-box">
                    <form>
                        <ul>
                            <!--accordian first slide-->
                            <li>
                                <input id="rad1" type="radio" checked name="rad">
                                <!--verticle text-->
                                <label for="rad1"><span class="team-name text-white">Maintenance tracker</span></label>
                                <div class="accslide d-flex">
                                    <div class="team-inner">
                                        <div class="team-about">
                                            <p>
                                                Keep track of the maintenance maintenance history on all of your assets. 
                                                Ready for your next oil change? We got you cevered. We work as hard as 
                                                you do to keep all of your data safe and organized. Stop guessing what 
                                                it is costing you to keep you to keep your fleet in top shape.
                                                <br><br>
                                                Monthly and weekly reports.
                                            </p>
                                            <span class="hr-line ml-0 mt-4 mb-4"></span>
                                            <a href="signup.php.">Sign up</a>
                                        </div>
                                        <div class="team-img">
                                            <img src="images/W900347485.jpg" alt="truck-img">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!--accordian second slide-->
                            <li>
                                <input id="rad2" type="radio" name="rad">
                                <!--verticle text-->
                                <label for="rad2"><span class="team-name text-white">Cost Calculator</span></label>
                                <div class="accslide">
                                    <div class="team-inner">
                                        <div class="team-about">
                                            <p>
                                                Success in any business is built on a string foundation. 
                                                One of those pillars is knowing your costs. Your cost structure is not 
                                                the same as your neighbor's
                                                <br><br>
                                                Stop guessing and use technology to your advantage
                                            </p>
                                            <span class="hr-line ml-0 mt-4 mb-4"></span>
                                            <a href="signup.php.">Sign up</a>
                                        </div>
                                        <div class="team-img">
                                            <img src="images/moto347485.jpg" alt="team-img">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!--accordian third slide-->
                            <li>
                                <input id="rad3" type="radio" name="rad">
                                <!--verticle text-->
                                <label for="rad3"><span class="team-name text-white">Detailed Route History</span></label>
                                <div class="accslide">
                                    <div class="team-inner">
                                        <div class="team-about">
                                            <p>
                                                Enter once and forget it. You work hard to find the best fr8, leave the analytics to us.
                                                We track your activity, providing andvanced analyics on your load history. Which brokers 
                                                make you the most money.
                                                <br><br>
                                                Weekly and monthly metrics you can use to make better decisions, faster.
                                            </p>
                                            <span class="hr-line ml-0 mt-4 mb-4"></span>
                                            <a href="signup.php.">Sign up</a>
                                        </div>
                                        <div class="team-img">
                                            <img src="images/boat347485.jpg" alt="team-img">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--team end-->

<!--gallery
<section id="portfolio_top" class="bg-light p-0">
    <div class="container">
        <div id="portfolio-measonry" class="cbp border-portfolio simple_overlay">
            <div class="cbp-item itemshadow">
                <img src="images/portfolio-1.jpg" alt="">
                <div class="overlay center-block text-white">
                    <a class="plus" data-fancybox="gallery" href="images/portfolio-1.jpg"></a>
                    <h4 class="pt-3">Latest Work</h4>
                    <p>See Our Amazing Work</p>
                </div>
            </div>
            <div class="cbp-item pt-5">
                <div class="text_wrap wow fadeIn" data-wow-delay="350ms">
                    <div class="heading-title text-center pt-5">
                        <h2 class="font-weight-600 m-0">Creative Work</h2>
                        <span class="hr-line mt-4 mb-4"></span>
                        <p class="mb-4">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend.</p>
                    </div>
                </div>
            </div>
            <div class="cbp-item itemshadow">
                <img src="images/portfolio-2.jpg" alt="">
                <div class="overlay center-block text-white">
                    <a class="plus" data-fancybox="gallery" href="images/portfolio-2.jpg"></a>
                    <h4 class="pt-3">Latest Work</h4>
                    <p>See Our Amazing Work</p>
                </div>
            </div>
            <div class="cbp-item itemshadow">
                <img src="images/portfolio-3.jpg" alt="">
                <div class="overlay center-block text-white">
                    <a class="plus" data-fancybox="gallery" href="images/portfolio-3.jpg"></a>
                    <h4 class="pt-3">Latest Work</h4>
                    <p>See Our Amazing Work</p>
                </div>
            </div>
            <div class="cbp-item itemshadow">
                <img src="images/portfolio-4.jpg" alt="">
                <div class="overlay center-block text-white">
                    <a class="plus" data-fancybox="gallery" href="images/portfolio-4.jpg"></a>
                    <h4 class="pt-3">Latest Work</h4>
                    <p>See Our Amazing Work</p>
                </div>
            </div>
            <div class="cbp-item">
                <div class="bottom-text">
                    <div class="cells  wow fadeIn" data-wow-delay="350ms">
                        <p class="pb-3">We’ve Completed More Than </p>
                        <h2 class="port_head">682</h2>
                        <p>projects for our amazing clients,</p>
                    </div>
                    <div class="cells wow fadeIn" data-wow-delay="350ms">
                        <a href="javascript:void(0)" class="btn btn-large btn-gray">View All Work</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--gallery ends -->

<!--price-->
<section id="price" class="price text-center">
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">PRICE</h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4">Get started for FREE!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="price-item">
                    <h2 class="font-weight-bold poppins-font mb-2">FREE</h2>
                    <h5 class="mb-3 poppins-font font-weight-bold">Standard</h5>
                    <ul class="p-0 price-list list-unstyled">
                        <li>Maintenance tracker</li>
                        <li>Cost per mile calculator</li>
                        <li>Up to 5 assets</li>
                        <li>One driver profile</li>
                    

                    </ul>
                    <a href="signup.html" class="btn btn-large btn-transparent-gray mt-4" target="blank">Try it</a>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="price-item center">
                    <div class="price-offer"><h6 class="">Coming Soon</h6></div>
                    <h2 class="font-weight-bold poppins-font mb-3">$9</h2>
                    <h5 class="mb-4 poppins-font font-weight-bold"> Power Fr8</h5>
                    <ul class="p-0 price-list list-unstyled">
                            <li>Basic features plus...</li>
                            <li>Smart GEO</li>
                            <li>TRUCK SPECIFIC Routing</li>
                            <li>Fr8 History</li>
                            <li>Fr8 Analyzer</li>
                            <li>Broker Reviews</li>
                            <li>Integrated Fr8 factoring</li>
                            
                    </ul>
                    <a href="signup.html" class="btn btn-large btn-transparent-white mt-5" target="blank">Try it</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="price-item">
                    <h2 class="font-weight-bold poppins-font mb-2">$49</h2>
                    <h5 class="mb-3 poppins-font font-weight-bold">Standard</h5>
                    <ul class="p-0 price-list list-unstyled">
                            <li>Includes Power Fr8 features plus...</li>
                            <li>up to 50 assets</li>
                            <li>TRUCK SPECIFIC Routing</li>
                            <li>Interactive Fr8R&trade analytics suite</li>
                            <li>Broker reviews</li>
                            <li>Integration with COMFREIGHT&copy; load finding/li>
                           

                    </ul>
                    <a href="signup.html" class="btn btn-large btn-transparent-gray mt-4" target="blank">Try it</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--price end-->

<!-- testimonials -->
<section id="testimonial" class="parallax testimonial-bg text-white text-center">
    <div class="bg-overlay bg-black opacity-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="font-weight-600 pb-1">What Our Users Say About Fr8R&trade;</h2>
                <span class="hr-line mt-4 mb-3"></span>
                <div id="testimonial-quote" class="owl-carousel">
                    <div class="item">
                        <div class="testimonial-quote text-center">
                            <p>"This is so much easier than a folder full of receipts!"</p>
                            <h6>James Mikel</h6>
                            <small>IT developer and Fr8R fan</small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-quote">
                            <p>"It just works. Simple technology with an easy to navigate interface"</p>
                            <h6>Jeff Shaffer</h6>
                            <small>CTO and VP, Unifund</small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-quote">
                            <p>BMWs are my passion and keeing them on the road is part of my life. Thanks Fr8r&trade;</p>
                            <h6>Andrew Enzo</h6>
                            <small>FedEx</small>
                        </div>
                    </div>
                </div>
                <div id="owl-thumbs" class="owl-dots">
                    <div class="owl-dot active"><img src="images/obxenzojames.jpg" alt=""></div>
                    <div class="owl-dot"><img src="images/testimonial-2.jpg" alt=""></div>
                    <div class="owl-dot"><img src="images/enzomg.jpg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Testimonials end-->

<!-- our story -->
<!-- <section class="our-story pb-0">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="title pb-5">
                    <h2 class="font-weight-600 m-0">Watch Our Video</h2>
                    <span class="hr-line mt-4 mb-4 ml-lg-0"></span>
                    <p class="mb-3 mb-lg-0">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut laboret dolore magna aliquyam erat, sed diam voluptua laboret dolore magna.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="story-image">
                    <img src="images/awesome-feature.png" alt="image">
                    <a data-fancybox="" href="https://youtu.be/7e90gBu4pas" class="button-play"><i class="ti ti-control-play"></i></a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- our story end-->

<!-- our client -->
<section id="client" class="our-client">
    <h2 class="d-none" aria-hidden="true">hidden</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 p-0">
                <div class="owl-carousel partners-slider">
                    <div class="item">
                        <div class="logo-item"> <img alt="" src="images/client-one.png"></div>
                    </div>
                    <div class="item">
                        <div class="logo-item"><img alt="" src="images/client-two.png"></div>
                    </div>
                    <div class="item">
                        <div class="logo-item"> <img alt="" src="images/client-one.png"></div>
                    </div>
                    <div class="item">
                        <div class="logo-item"><img alt="" src="images/client-two.png"></div>
                    </div>
                    <div class="item">
                        <div class="logo-item"> <img alt="" src="images/client-one.png"></div>
                    </div>
                    <div class="item">
                        <div class="logo-item"><img alt="" src="images/client-two.png"></div>
                    </div>
                    <div class="item">
                        <div class="logo-item"> <img alt="" src="images/client-one.png"></div>
                    </div>
                    <div class="item">
                        <div class="logo-item"><img alt="" src="images/client-two.png"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- our client end -->

<!--blog-->
<!-- <section id="blog" class="blog-list bg-light text-center text-md-left">
    <h2 class="d-none" aria-hidden="true">slider</h2>
    <div class="container">
        <div class="row"> -->
            <!-- blog-item one -->
            <!-- <div class="col-lg-3 col-md-6 mb-3 mb-xs-5">
                <div class="image">
                    <img alt="image" src="images/blog-img-1.jpg">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-xs-5">
                <div class="blog-box">
                    <h4 class="text-capitalize mb-4">360° arial view</h4>
                    <p class="mb-3 mb-xs-4">Leverage agile frameworks to provide a robust synopsis for high level overviews.</p>
                    <a class="btn btn-large btn-pink mb-xs-4" href="blog-left.html"> Read More</a>
                </div>
            </div> -->
            <!-- blog-item two -->
            <!-- <div class="col-lg-3 col-md-6 mb-xs-5">
                <div class="image">
                    <img alt="image" src="images/blog-img-2.jpg">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="blog-box">
                    <h4 class="text-capitalize mb-4">360° arial view</h4>
                    <p class="mb-3 mb-xs-4">Leverage agile frameworks to provide a robust synopsis for high level overviews.</p>
                    <a class="btn btn-large btn-pink" href="blog-left.html"> Read More</a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--blog end-->

<!-- Contact US -->
<section id="contact" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">CONTACT</h2>
                    <span class="hr-line mt-4 mb-4"></span>
                    <p class="mb-4">Please, let us know how we can better serve you</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-xs-5">
                <form action = "sendMail.php"class="getin_form" method = 'POST'>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="First Name : " required id="first_name" name="first_name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Last Name : " required id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Email : " required id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="tel" placeholder="Phone : " id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group mb-4">
                                <textarea class="form-control" placeholder="Message" id="message" name="message"></textarea>
                            </div>
                        </div>
                        <div >
                            <input type="hidden" value="Inquiry from Index Page" required id="emailSource" name="emailSource">
                        </div>
                        <div >
                            <input type="hidden" value="bruce@FPVdata.com" required id="sendToEmail" name="sendToEmail">
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-large btn-pink w-100" id="submit_btn">submit request</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-12 pl-4">
                <p class="mb-lg-5 mb-4 mt-2">Fr8R&trade; is proud to serve you.</p>
                <div class="row">
                    <div class="col-md-6 col-sm-6 our-address mb-4">
                        <h6 class="mb-3 font-weight-600">Our Address</h6>
                        <p class="mb-2">CINCINNATI, OHIO , Made in USA. </p>
                        <!-- <a class="pickus" href="#." data-text="Get Directions">Get Directions</a> -->
                    </div>
                    <div class="col-md-6 col-sm-6 our-address mb-4">
                        <h6 class="mb-3 font-weight-600">Our Phone</h6>
                        <a class="pickus" href="tel:5133166259" data-text="Call Us">513-316-6259</a>
                    </div>
                    <div class="col-md-6 col-sm-6 our-address mb-4">
                        <h6 class="mb-3 font-weight-600">Our Email</h6>
                        <p class="mb-2">Main Email : bruce@FPVdata.com <span class="block">Inquiries : email@website.com</span> </p>
                        <a class="pickus" href="sms:5133166259" data-text="Send a Message">Send a text</a>
                    </div>
                    <!-- <div class="col-md-6 col-sm-6 our-address">
                        <h6 class="mb-3 font-weight-600">Our Support</h6>
                        <p class="mb-2">Main Support : info@FPVdata.com <span>Sales : support@website</span> </p>
                        <a class="pickus" href="#." data-text="Open a Ticket">Open a Ticket</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact US Ends-->

<!-- Map -->
<!-- <section class="p-0 bg-light text-center"> -->
    <!--Location Map here-->
    <!-- <div id="map" class="map-container"></div>
    <h2 class="d-none" aria-hidden="true">hidden</h2> -->
    <!--Bottom Logo-->
    <!-- <div class="logo-icon">
        <img src="images/fr8r_logo.png" alt="image">
    </div>
</section> -->
<!-- Map End -->

<!-- Footer -->

<?php include('includes/appFooter.php')?>


<!-- Footer End -->

<!-- start scroll to top -->
<a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti ti-angle-up"></i></a>
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
<script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDt0vRhm_vtSByrTR3EMWlEFXR_6V36Vm0&callback=initMap">
    </script>
<script src="js/map.js"></script>
<!-- custom script -->
<script src="js/script.js"></script>
</body>
</html>