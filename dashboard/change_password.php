<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/config.php';
    
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    } elseif (strlen($new_password) < 6) {
        $errors[] = "New password must be at least 6 characters long.";
    } elseif ($new_password !== $confirm_password) {
        $errors[] = "New passwords do not match.";
    } else {
        // Verify old password
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!password_verify($old_password, $user['password'])) {
            $errors[] = "Current password is incorrect.";
        } else {
            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed_password, $_SESSION['user_id']]);
            
            $success = "Password updated successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password - UserHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/common.css">
  <link rel="stylesheet" href="../assets/css/change_password.css">
</head>
<body>

  <a href="profile.php" class="back-btn">
    <i class="fas fa-arrow-left me-2"></i>Back to Profile
  </a>

  <div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-lg-8 co-md-6">
      <div class="password-container">
          <div class="security-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          
          <h2 class="page-title">Change Password</h2>
          <p class="page-subtitle">Keep your account secure with a strong password</p>

          <?php if(!empty($errors)): ?>
            <div class="alert alert-custom alert-danger mb-4">
              <i class="fas fa-exclamation-triangle me-2"></i>
              <?php foreach($errors as $error): ?>
                <div><?php echo htmlspecialchars($error); ?></div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if($success): ?>
            <div class="alert alert-custom alert-success mb-4">
              <i class="fas fa-check-circle me-2"></i>
              <?php echo htmlspecialchars($success); ?>
            </div>
          <?php endif; ?>

          <form method="POST" id="passwordForm">
            <div class="form-floating">
              <i class="fas fa-lock input-icon"></i>
              <input type="password" name="old_password" class="form-control" id="old_password" 
                     placeholder="Enter current password" required>
              <label for="old_password">Current Password</label>
              <button type="button" class="password-toggle" onclick="togglePassword('old_password')">
                <i class="fas fa-eye"></i>
              </button>
            </div>

            <div class="form-floating">
              <i class="fas fa-key input-icon"></i>
              <input type="password" name="new_password" class="form-control" id="new_password" 
                     placeholder="Enter new password" required>
              <label for="new_password">New Password</label>
              <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
                <i class="fas fa-eye"></i>
              </button>
            </div>

            <div class="form-floating">
              <i class="fas fa-check-double input-icon"></i>
              <input type="password" name="confirm_password" class="form-control" id="confirm_password" 
                     placeholder="Confirm new password" required>
              <label for="confirm_password">Confirm New Password</label>
              <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                <i class="fas fa-eye"></i>
              </button>
            </div>

            <div class="password-requirements">
              <h6 class="mb-3">
                <i class="fas fa-info-circle me-2"></i>Password Requirements
              </h6>
              <div class="requirement" id="length-req">
                <i class="fas fa-times"></i>
                At least 6 characters long
              </div>
              <div class="requirement" id="match-req">
                <i class="fas fa-times"></i>
                Passwords match
              </div>
              <div class="requirement" id="different-req">
                <i class="fas fa-times"></i>
                Different from current password
              </div>
            </div>

            <div class="d-grid gap-3">
              <button type="submit" class="btn-primary-custom" id="submitBtn" disabled>
                <i class="fas fa-shield-alt me-2"></i>Update Password
              </button>
              <a href="profile.php" class="btn-outline-custom">
                <i class="fas fa-times me-2"></i>Cancel
              </a>
            </div>
          </form>

          <div class="text-center mt-4">
            <small class="text-muted">
              <i class="fas fa-lock me-1"></i>
              Your password is encrypted and secure
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/js/change_password.js"></script>

</body>
</html>