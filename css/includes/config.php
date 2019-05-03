<?php
// Start the session
function my_autoloader($class) {
    include 'classes/class.' . $class . '.php';
}

spl_autoload_register('my_autoloader');
session_start();

//error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//set default currency
setlocale(LC_MONETARY,"en_US");

//Memory usage override
ini_set('memory_limit', '-1');

// Connecting to the MySQL database
$user = 'brucehenry';
$password = 'M@rriage1993';
$database = new PDO('mysql:host=mysql.fr8r.io;dbname=fr8r',$user, $password
);
$database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

$allowed_urls = array(
    'login.php',
    'signupsuccess.php',
    'signup.php',
    'forgotPassword.php',
    'updatePassword.php',
    'resetMyPassword.php.*',
    'index.php'
);

$current_url = basename($_SERVER['REQUEST_URI']);

// if userID is not set in the session and current URL not login.php redirect to login page

if (!isset($_SESSION['userID']) && !in_array($current_url,$allowed_urls)) {
    header('location: login.php');
    die();
}

// Else if session key userID is set create new $user object from User Class from the database
elseif(isset($_SESSION['userID'])) {

    $userID = $_SESSION['userID'];
    $user = new User ($database, $userID);
}
