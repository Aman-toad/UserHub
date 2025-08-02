<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
</head>
<body>
  <h2>Change Password</h2>

  <?php if (isset($_SESSION['msg'])): ?>
    <p style="color: green;"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></p>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
  <?php endif; ?>

  <form action="../actions/change_password_handler.php" method="POST">
    <label>Old Password:</label><br>
    <input type="password" name="old_password" required><br><br>

    <label>New Password:</label><br>
    <input type="password" name="new_password" required><br><br>

    <label>Confirm New Password:</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">Update Password</button>
  </form>
</body>
</html>
