<?php 
session_start();
require '../config/config.php';

if(!isset($_SESSION['user_id'])){
  header("Location: ../auth/login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

try{
  $stmt = $pdo -> prepare("SELECT password FROM user WHERE id = ?");
  $stmt -> execute([$user_id]);
  $user = $stmt -> fetch(PDO::FETCH_ASSOC);

  if(!$user || !password_verify($old_password, $user['password'])){
    $_SESSION['error'] = "Incorrect Old Password";
    header("Location: ../dashboard/change_password.php");
    exit;
  }

  if($new_password !== $confirm_password){
    $_SESSION['error'] = "New passwords do not match.";
    header("Location: ../dashboard/change_password.php");
    exit;
  }

  $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
  $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
  $update->execute([$hashed_password, $user_id]);

  $_SESSION['msg'] = "Password updated successfully!";
  header("Location: ../dashboard/change_password.php");
  exit;
} catch(PDOException $e) {
  $_SESSION['error'] = "Something went wrong". $e;
  header("Location: ../dashboard/change_password.php");
}

?>