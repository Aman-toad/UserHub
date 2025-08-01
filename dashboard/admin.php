<?php
require_once("../includes/auth.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo "Unauthorized Access!";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    .card {
      padding: 20px;
      background: #f0f0f0;
      border-radius: 8px;
      width: 300px;
    }
  </style>
</head>
<body>

<h2>Admin Dashboard</h2>

<div class="card">
  <h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
  <p><strong>Role:</strong> <?php echo htmlspecialchars($_SESSION['role']); ?></p>
</div>

<br>

<a href="users_list.php">Manage Users</a> |
<a href="profile.php">Edit Profile</a> |
<a href="../auth/logout.php">Logout</a>

</body>
</html>
