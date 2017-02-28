<?php

//Login details
$servername = "mysql4.gear.host";
$username = "bloodbank";
$password = "Wk602y_N66F_";

// Create connection
$dbh = new PDO("mysql:host=$servername", $username, $password); 

// Check connection
if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
}

echo "Connected successfully";
?>
