<?php 
session_status();

if(!isset($_SESSION['user'])){
  header("Location: ../auth/login.php");
  exit;
}

$user = $_SESSION['user'];

if(!isset($user['role']) || $user['role'] !== 'admin'){
  echo "Access Denied. Admins Only !!";
  exit;
}

?>