<?php
require_once('../includes/auth.php'); //for protection
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashbord - UserHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h2>
    <p>Your role: <strong><?= $_SESSION['role'] ?></strong></p>
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
  </div>
</body>
</html>