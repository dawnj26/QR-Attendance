<?php
$hostname = "localhost";
$user = "root";
$passwordSQL = "";
$dBName = "school";

$connection = mysqli_connect($hostname, $user, $passwordSQL, $dBName);


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>