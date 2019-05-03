<?php
// Create and include a configuration file with the database connection
include('includes/config.php');

// Destroy the current session
session_destroy();

// Redirect to the login page
header ('location: login.php');
