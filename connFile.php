<?php

$servername = "localhost";
$username = "der";
$password = "root";
$db = "covidCases";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

?>