<?php 
require_once '../includes/auth.php';
require_once '../config/config.php';

if($_SESSION['role'] !== 'admin'){
  die('Unauthorised access. Admins only.')
}

else{
  if(isset($_GET['id'])) {
  $userID = $_GET['id'];

  //prevention to self delete
  if($userID == $_SESSION['user_id']){
    die("You cannot delete your own account !");
  }

  //deleting user from db;
  $stmt = $pdo -> prepare("DELETE FROM users WHERE id = ?");
  $stmt -> execute([$userID]);

  header("Location: ../dashboard/users.php");
  exit;
}else {
  echo"Invalid Request.";
}
}


?>