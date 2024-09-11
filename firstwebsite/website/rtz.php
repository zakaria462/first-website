<?php
$hostname = 'localhost:3308'; // Spécifiez le port 3308
$username = 'root';
$password = '';
$database = 'register';

$con = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($con));

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
