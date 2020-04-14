<?php
// Database configuration
//$dbHost     = "127.0.0.1";
$dbHost     = "imageupload.ckxttcmfylbj.us-west-1.rds.amazonaws.com";
$dbUsername = "root";
$dbPassword = "Jan2020$";
$dbName     = "image";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed1: " . $db->connect_error);
}
?>
