<?php 
//Include Config file
include('includes/config.php');

//Include Functions file
include('includes/functions.inc.php');


//Na variables Start home
$lat1 = 39.2811451;
$lon1= -84.3273387;

//Nav variable end NKU
$lat2 = 39.0312076;
$lon2= -84.4647232;

//Nav variable end random
$lat3 = 39.8560963;
$lon3= -104.67593160;



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
    <!-- HERE STYLE SHEETS -->
    <link rel="stylesheet" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css" />
	<link rel="stylesheet" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1542186754" />
	<link rel="stylesheet" href="css/HERE.css">


<!--HERE API JS-->		

<script src="https://js.api.here.com/v3/3.0/mapsjs-core.js"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-service.js"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>

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
<?php include('includes/appHeader.php'); ?>
<!--header end-->
<br><br><br><br>
    <div class="container">
         <div class="row">
            <div class="col-sm-12">
                <div class="title text-center pb-5">
                    <h2 class="font-weight-600 m-0">Welcome <?php echo $user->get_fName()?> </h2>
                    <p class="mb-4">Fr8R &trade; is at your service </p>
                </div>
            </div>
        </div>
	</div>
<!-- GEO test start-->
	<button id = "find-me">Show my location</button><br/>
<p id = "status"></p>
<a id = "map-link" target="_blank"></a>
<!--test end-->

<div id="flexContainer">
<div id="panel"></div>
<div id="map" ></div>
</div>
    <script  type="text/javascript" charset="UTF-8" > 
/**
 * Calculates and displays a car route from the php variable above.
 *
 * A full list of available request parameters can be found in the Routing API documentation.
 * see:  http://developer.here.com/rest-apis/documentation/routing/topics/resource-calculate-route.html
 *
 * @param   {H.service.Platform} platform    A stub class to access HERE services
 */

function geoFindMe() {

const status = document.querySelector('#status');
const mapLink = document.querySelector('#map-link');

mapLink.href = '';
mapLink.textContent = '';

function success(position) {
  const latitude  = position.coords.latitude;
  const longitude = position.coords.longitude;

  status.textContent = '';
  mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
  mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
}

function error() {
  status.textContent = 'Unable to retrieve your location';
}

if (!navigator.geolocation) {
  status.textContent = 'Geolocation is not supported by your browser';
} else {
  status.textContent = 'Locating…';
  navigator.geolocation.getCurrentPosition(success, error);
}

}

document.querySelector('#find-me').addEventListener('click', geoFindMe);




function calculateRouteFromAtoB (platform) {
	var router = platform.getRoutingService(),
	routeRequestParams = {
		mode: 'fastest;car',
		representation: 'display',
		routeattributes : 'waypoints,summary,shape,legs',
		maneuverattributes: 'direction,action',
		waypoint0: '<?php echo $lat1 ?>,<?php echo $lon1 ?>', // from php variables
		waypoint1: '<?php echo $lat2 ?>,<?php echo $lon2 ?>',  // from php variables
		waypoint2: '<?php echo $lat3 ?>,<?php echo $lon3 ?>'  // from php variables
	};

	router.calculateRoute(
	routeRequestParams,
	onSuccess,
	onError
	);
}
/**
 * This function will be called once the Routing REST API provides a response
 * @param  {Object} result          A JSONP object representing the calculated route
 *
 * see: http://developer.here.com/rest-apis/documentation/routing/topics/resource-type-calculate-route.html
 */
function onSuccess(result) {
	var route = result.response.route[0];
	/*
	* The styling of the route response on the map is entirely under the developer's control.
	* A representitive styling can be found the full JS + HTML code of this example
	* in the functions below:
	*/
	addRouteShapeToMap(route);
	addManueversToMap(route);
	addWaypointsToPanel(route.waypoint);
	addManueversToPanel(route);
	addSummaryToPanel(route.summary);
	// ... etc.
}

/**
 * This function will be called if a communication error occurs during the JSON-P request
 * @param  {Object} error  The error message received.
 */
function onError(error) {
	alert('Ooops!');
}

/**
 * Boilerplate map initialization code starts below:
 */

// set up containers for the map  + panel
var mapContainer = document.getElementById('map'),
	routeInstructionsContainer = document.getElementById('panel');

//Step 1: initialize communication with the platform
var platform = new H.service.Platform({
	app_id: 'Vj6VToHC2QHyWN69FoVj',
	app_code: 'G-kPhG2op_b4iQmPoBP3iw',
	useHTTPS: true
});
var pixelRatio = window.devicePixelRatio || 1;
var defaultLayers = platform.createDefaultLayers({
	tileSize: pixelRatio === 1 ? 256 : 512,
	ppi: pixelRatio === 1 ? undefined : 320
});

//Step 2: initialize a map - this map is centered over Berlin
var map = new H.Map(mapContainer,
	defaultLayers.normal.map,{
	center: {lat:52.5160, lng:13.3779},
	zoom: 13,
	pixelRatio: pixelRatio
});

//Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Create the default UI components

function useImperialMeasurements(map, defaultLayers){
  // Create the default UI components
  var ui = H.ui.UI.createDefault(map, defaultLayers);

  // Set the UI unit system to imperial measurement
  ui.setUnitSystem(H.ui.UnitSystem.IMPERIAL);
}


// Hold a reference to any infobubble opened
var bubble;

/**
 * Opens/Closes a infobubble
 * @param  {H.geo.Point} position     The location on the map.
 * @param  {String} text              The contents of the infobubble.
 */
function openBubble(position, text){
	if(!bubble){
	bubble =  new H.ui.InfoBubble(
		position,
		// The FO property holds the province name.
		{content: text});
	ui.addBubble(bubble);
	} else {
	bubble.setPosition(position);
	bubble.setContent(text);
	bubble.open();
	}
}

/**
 * Creates a H.map.Polyline from the shape of the route and adds it to the map.
 * @param {Object} route A route as received from the H.service.RoutingService
 */
function addRouteShapeToMap(route){
	var lineString = new H.geo.LineString(),
	routeShape = route.shape,
	polyline;

	routeShape.forEach(function(point) {
	var parts = point.split(',');
	lineString.pushLatLngAlt(parts[0], parts[1]);
	});

	polyline = new H.map.Polyline(lineString, {
	style: {
		lineWidth: 4,
		strokeColor: 'rgba(0, 128, 255, 0.7)'
	}
	});
	// Add the polyline to the map
	map.addObject(polyline);
	// And zoom to its bounding rectangle
	map.setViewBounds(polyline.getBounds(), true);
}

/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addManueversToMap(route){
	var svgMarkup = '<svg width="18" height="18" ' +
	'xmlns="http://www.w3.org/2000/svg">' +
	'<circle cx="8" cy="8" r="8" ' +
		'fill="#1b468d" stroke="white" stroke-width="1"  />' +
	'</svg>',
	dotIcon = new H.map.Icon(svgMarkup, {anchor: {x:8, y:8}}),
	group = new  H.map.Group(),
	i,
	j;

	// Add a marker for each maneuver
	for (i = 0;  i < route.leg.length; i += 1) {
	for (j = 0;  j < route.leg[i].maneuver.length; j += 1) {
		// Get the next maneuver.
		maneuver = route.leg[i].maneuver[j];
		// Add a marker to the maneuvers group
		var marker =  new H.map.Marker({
		lat: maneuver.position.latitude,
		lng: maneuver.position.longitude} ,
		{icon: dotIcon});
		marker.instruction = maneuver.instruction;
		group.addObject(marker);
	}
	}

	group.addEventListener('tap', function (evt) {
	map.setCenter(evt.target.getPosition());
	openBubble(
		evt.target.getPosition(), evt.target.instruction);
	}, false);

	// Add the maneuvers group to the map
	map.addObject(group);
}

/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addWaypointsToPanel(waypoints){

	var nodeH3 = document.createElement('h3'),
	waypointLabels = [],
	i;

	for (i = 0;  i < waypoints.length; i += 1) {
	waypointLabels.push(waypoints[i].label)
	}

	nodeH3.textContent = waypointLabels.join(' - ');

	routeInstructionsContainer.innerHTML = '';
	routeInstructionsContainer.appendChild(nodeH3);
}

/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addSummaryToPanel(summary){
	var summaryDiv = document.createElement('div'),
	content = '';
	content += '<b>Total distance</b>: ' + summary.distance  + 'm. <br/>';
	content += '<b>Travel Time</b>: ' + summary.travelTime.toMMSS() + ' (in current traffic)';

	summaryDiv.style.fontSize = 'small';
	summaryDiv.style.marginLeft ='5%';
	summaryDiv.style.marginRight ='5%';
	summaryDiv.innerHTML = content;
	routeInstructionsContainer.appendChild(summaryDiv);
}

/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addManueversToPanel(route){
	var nodeOL = document.createElement('ol'),
	i,
	j;

	nodeOL.style.fontSize = 'small';
	nodeOL.style.marginLeft ='5%';
	nodeOL.style.marginRight ='5%';
	nodeOL.className = 'directions';

		// Add a marker for each maneuver
	for (i = 0;  i < route.leg.length; i += 1) {
	for (j = 0;  j < route.leg[i].maneuver.length; j += 1) {
		// Get the next maneuver.
		maneuver = route.leg[i].maneuver[j];

		var li = document.createElement('li'),
		spanArrow = document.createElement('span'),
		spanInstruction = document.createElement('span');

		spanArrow.className = 'arrow '  + maneuver.action;
		spanInstruction.innerHTML = maneuver.instruction;
		li.appendChild(spanArrow);
		li.appendChild(spanInstruction);

		nodeOL.appendChild(li);
	}
	}

	routeInstructionsContainer.appendChild(nodeOL);
}

Number.prototype.toMMSS = function () {
	return  Math.floor(this / 60)  +' minutes '+ (this % 60)  + ' seconds.';
}

// Now use the map as required...
calculateRouteFromAtoB (platform);
	</script>



<!--Footer Begins-->
<?php //include('includes/appFooter.php'); ?>
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

<!-- custom script -->
<script src="js/script.js"></script>
</body>
</html>