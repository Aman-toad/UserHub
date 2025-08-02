<?php
require_once '../includes/auth.php';
require_once '../config/config.php';

// Get complete user information from database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile - UserHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="../assets/css/common.css">
  <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>

  <a href="javascript:history.back()" class="back-btn">
    <i class="fas fa-arrow-left me-2"></i>Back
  </a>

  <div class="container">
    <div class="profile-container">
      <!-- Profile Header -->
      <div class="profile-header">
        <div class="profile-avatar">
          <?php echo strtoupper(substr($_SESSION['username'], 0, 2)); ?>
        </div>
        <h1 class="profile-name"><?= htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username']) ?></h1>
        <p class="profile-email"><?= htmlspecialchars($_SESSION['email']) ?></p>
        <div class="profile-role">
          <i class="fas fa-<?= $_SESSION['role'] === 'admin' ? 'user-shield' : 'user' ?> me-2"></i>
          <?= ucfirst($_SESSION['role']) ?>
        </div>
        <div class="d-flex gap-3 justify-content-center">
          <a href="edit_profile.php" class="btn-primary-custom">
            <i class="fas fa-edit me-2"></i>Edit Profile
          </a>
          <a href="change_password.php" class="btn-outline-custom">
            <i class="fas fa-key me-2"></i>Change Password
          </a>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-number">
            <?= date('j', strtotime($userInfo['created_at'])) ?>
          </div>
          <p class="text-muted mb-0">Days Active</p>
        </div>
        <div class="stat-card">
          <div class="stat-number">100%</div>
          <p class="text-muted mb-0">Profile Complete</p>
        </div>
        <div class="stat-card">
          <div class="stat-number">
            <?= $_SESSION['role'] === 'admin' ? 'Admin' : 'User' ?>
          </div>
          <p class="text-muted mb-0">Access Level</p>
        </div>
      </div>

      <!-- Profile Information -->
      <div class="profile-info">
        <h4 class="mb-4">
          <i class="fas fa-info-circle me-2"></i>Profile Information
        </h4>
        
        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-user"></i>
          </div>
          <div class="info-content">
            <div class="info-label">Full Name</div>
            <div class="info-value"><?= htmlspecialchars($userInfo['full_name'] ?? 'Not provided') ?></div>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-at"></i>
          </div>
          <div class="info-content">
            <div class="info-label">Username</div>
            <div class="info-value">@<?= htmlspecialchars($_SESSION['username']) ?></div>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="info-content">
            <div class="info-label">Email Address</div>
            <div class="info-value"><?= htmlspecialchars($_SESSION['email']) ?></div>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-user-tag"></i>
          </div>
          <div class="info-content">
            <div class="info-label">Account Type</div>
            <div class="info-value"><?= ucfirst($_SESSION['role']) ?> Account</div>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <div class="info-content">
            <div class="info-label">Member Since</div>
            <div class="info-value"><?= date('F j, Y', strtotime($userInfo['created_at'])) ?></div>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-clock"></i>
          </div>
          <div class="info-content">
            <div class="info-label">Last Updated</div>
            <div class="info-value"><?= date('M j, Y g:i A', strtotime($userInfo['updated_at'] ?? $userInfo['created_at'])) ?></div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="profile-info">
        <h4 class="mb-4">
          <i class="fas fa-bolt me-2"></i>Quick Actions
        </h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <a href="edit_profile.php" class="btn-outline-custom w-100">
              <i class="fas fa-user-edit me-2"></i>Update Profile
            </a>
          </div>
          <div class="col-md-6 mb-3">
            <a href="change_password.php" class="btn-outline-custom w-100">
              <i class="fas fa-key me-2"></i>Security Settings
            </a>
          </div>
          <?php if($_SESSION['role'] === 'admin'): ?>
          <div class="col-md-6 mb-3">
            <a href="admin.php" class="btn-outline-custom w-100">
              <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
            </a>
          </div>
          <div class="col-md-6 mb-3">
            <a href="users_list.php" class="btn-outline-custom w-100">
              <i class="fas fa-users me-2"></i>Manage Users
            </a>
          </div>
          <?php else: ?>
          <div class="col-md-6 mb-3">
            <a href="user.php" class="btn-outline-custom w-100">
              <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
          </div>
          <div class="col-md-6 mb-3">
            <a href="../auth/logout.php" class="btn-outline-custom w-100 text-danger">
              <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>