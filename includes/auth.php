<!-- protect pages -->
<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header('Location: ../auth/login.php');
}

function isAdmin(){
  return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
?>
