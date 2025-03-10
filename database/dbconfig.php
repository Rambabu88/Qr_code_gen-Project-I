<?php 
$server = "localhost";
$user = "root";
$pass = "";
$db = "qr_ats";

$conn = new mysqli($server, $user, $pass, $db);
if($conn->connect_error) {
    die("Connection error". $conn->connect_error);
}
?>