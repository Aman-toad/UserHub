<?php
require_once("../includes/auth.php");
require_once '../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  echo "Unauthorized Access!";
  exit;
}

if(isset($_SESSION['success'])){
  echo "<p>{$_SESSION['success']}</p>";
  unset($_SESSION['success']);
}

// Get user stats
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - UserHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/common.css">
  <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        <i class="fas fa-users-cog me-2"></i>UserHub
      </a>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-item">
        <a href="user.php" class="nav-link active">
          <i class="fas fa-tachometer-alt"></i>Dashboard
        </a>
      </div>
      <div class="nav-item">
        <a href="profile.php" class="nav-link">
          <i class="fas fa-user-circle"></i>My Profile
        </a>
      </div>
      <div class="nav-item">
        <a href="edit_profile.php" class="nav-link">
          <i class="fas fa-edit"></i>Edit Profile
        </a>
      </div>
      <div class="nav-item">
        <a href="change_password.php" class="nav-link">
          <i class="fas fa-key"></i>Change Password
        </a>
      </div>
      <div class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-cog"></i>Settings
        </a>
      </div>
      <div class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-bell"></i>Notifications
        </a>
      </div>
      <div class="nav-item mt-4">
        <a href="../auth/logout.php" class="nav-link text-danger">
          <i class="fas fa-sign-out-alt"></i>Logout
        </a>
      </div>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Welcome Card -->
    <div class="welcome-card">
      <div class="user-avatar-large">
        <?php echo strtoupper(substr($_SESSION['username'], 0, 2)); ?>
      </div>
      <h2 class="mb-3">Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
      <p class="lead mb-4 opacity-90">
        You're logged in as a user. Manage your profile and account settings from here.
      </p>
      <div class="d-flex gap-3 justify-content-center">
        <a href="edit_profile.php" class="btn btn-primary-custom">
          <i class="fas fa-edit me-2"></i>Edit Profile
        </a>
        <a href="profile.php" class="btn btn-outline-light">
          <i class="fas fa-user me-2"></i>View Profile
        </a>
      </div>
    </div>

    <!-- Feature Cards -->
    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-user-circle"></i>
          </div>
          <h5 class="mb-3">Profile Management</h5>
          <p class="opacity-90 mb-4">Update your personal information, contact details, and preferences.</p>
          <a href="profile.php" class="btn btn-outline-light btn-sm">Manage Profile</a>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h5 class="mb-3">Security Settings</h5>
          <p class="opacity-90 mb-4">Change your password and manage security preferences.</p>
          <a href="change_password.php" class="btn btn-outline-light btn-sm">Security Settings</a>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-bell"></i>
          </div>
          <h5 class="mb-3">Notifications</h5>
          <p class="opacity-90 mb-4">Manage your notification preferences and alerts.</p>
          <a href="#" class="btn btn-outline-light btn-sm">Notifications</a>
        </div>
      </div>
    </div>

    <!-- Account Information -->
    <div class="row">
      <div class="col-md-8">
        <div class="activity-card">
          <h5 class="mb-4">Account Information</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="text-muted small">Full Name</label>
                <div class="fw-semibold"><?php echo htmlspecialchars($userInfo['full_name']); ?></div>
              </div>
              <div class="mb-3">
                <label class="text-muted small">Username</label>
                <div class="fw-semibold">@<?php echo htmlspecialchars($userInfo['username']); ?></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="text-muted small">Email Address</label>
                <div class="fw-semibold"><?php echo htmlspecialchars($userInfo['email']); ?></div>
              </div>
              <div class="mb-3">
                <label class="text-muted small">Account Type</label>
                <div class="fw-semibold">
                  <span class="badge bg-primary"><?php echo ucfirst($userInfo['role']); ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <label class="text-muted small">Member Since</label>
            <div class="fw-semibold"><?php echo date('F j, Y', strtotime($userInfo['created_at'])); ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="activity-card">
          <h5 class="mb-4">Recent Activity</h5>
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-sign-in-alt"></i>
            </div>
            <div>
              <div class="fw-semibold">Logged In</div>
              <small class="text-muted">Today at <?php echo date('g:i A'); ?></small>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-user-edit"></i>
            </div>
            <div>
              <div class="fw-semibold">Profile Updated</div>
              <small class="text-muted">2 days ago</small>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-key"></i>
            </div>
            <div>
              <div class="fw-semibold">Password Changed</div>
              <small class="text-muted">1 week ago</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>