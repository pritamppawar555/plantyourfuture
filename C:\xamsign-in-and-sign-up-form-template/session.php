<?php
include("config.php");
session_start();
if(!isset($_SESSION["email"])){
header("Location: login.php");
exit();
}

$sess_email = $_SESSION["email"];
$sql = "SELECT user_id, firstname, lastname, email FROM users WHERE email = '$sess_email'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
  
    $firstname = $_POST['signup_firstname'];
    $lastname = $_POST['signup_lastname'];
    $email = $_POST['signup_email'];
    $phone = $_POST['signup_phone'];
    $password = $_POST['signup_password'];
  

  }
} else {
    $userid="798";
    $username ="SJEC";
    $useremail="mailid@domain.com"; 
}
?>