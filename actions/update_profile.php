<?php 
session_start();
require_once '../config/config.php';
require_once '../includes/auth.php';

$user_id = $_SESSION['user']['id'];
$full_name = trim($_POST['full_name']);
$email = trim($_POST['email']);

//update
$sql = "UPDATE users SET full_name = ?, email = ? . WHERE id = ?" ;
$stmt = $conn -> prepare($sql);

$stmt -> bind_param("ssi", $full_name, $email, $user_id);

if($stmt -> execute()){
  $_SESSION['user']['full_name'] = $full_name;
  $_SESSION['user']['email'] = $email;

  header("Location: ../dashboard/profile.php?status=success");
  exit;
}else{
  header("Location: ../dashboard/profile.php?status=error");
  exit
}
?>