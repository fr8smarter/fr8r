<?php
// Connecting to the MySQL database
$user = 'brucehenry';
$password = 'M@rriage1993';
$database = new PDO('mysql:host=mysql.fr8r.io;dbname=fr8r',$user, $password
);
$database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

?>