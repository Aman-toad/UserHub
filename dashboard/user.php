<?php
require_once("../includes/auth.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  echo "Unauthorized Access!";
  exit;
}

if(isset($_SESSION['success'])){
  echo "<p>{$_SESSION['success']}</p>";
  unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html>
<head><title>User Dashboard</title></head>
<body>
<h2>Welcome <?php echo $_SESSION['username']; ?></h2>
<a href="profile.php">View Profile</a> |
<a href="../auth/logout.php">Logout</a>
<!-- User tools here -->
</body>
</html>
