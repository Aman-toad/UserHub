<?php 
require_once '../config/config.php';
require_once '../includes/auth.php';

$errors = [];
$success = "";

// Get current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);

    if (empty($full_name) || empty($email) || empty($username)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE users SET full_name = ?, email = ?, username = ? WHERE id = ?");
            $stmt->execute([$full_name, $email, $username, $_SESSION['user_id']]);
            
            // Update session variables
            $_SESSION['full_name'] = $full_name;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            
            $success = "Profile updated successfully!";
            
            // Refresh user data
            $user['full_name'] = $full_name;
            $user['email'] = $email;
            $user['username'] = $username;
            
        } catch(PDOException $e) {
            $errors[] = "Username or email may already be taken.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile - UserHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/common.css">
  <link rel="stylesheet" href="../assets/css/edit_profile.css">
</head>
<body>

  <a href="profile.php" class="back-btn">
    <i class="fas fa-arrow-left me-2"></i>Back to Profile
  </a>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
  <div class="col-lg-8 col-md-6">
    <div class="edit-container">
          <div class="profile-avatar">
            <?php echo strtoupper(substr($user['username'], 0, 2)); ?>
          </div>
          
          <h2 class="page-title">Edit Your Profile</h2>

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

          <form method="POST">
            <div class="form-section">
              <div class="section-title">
                <i class="fas fa-user-edit"></i>Personal Information
              </div>

              <div class="form-floating">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="full_name" class="form-control p-5" id="full_name" 
                       value="<?= htmlspecialchars($user['full_name']) ?>" 
                       placeholder="Enter your full name" required>
                <label for="full_name">Full Name</label>
              </div>

              <div class="form-floating">
                <i class="fas fa-at input-icon"></i>
                <input type="text" name="username" class="form-control p-5" id="username" 
                       value="<?= htmlspecialchars($user['username']) ?>" 
                       placeholder="Enter your username" required>
                <label for="username">Username</label>
              </div>

              <div class="form-floating">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" class="form-control p-5" id="email" 
                       value="<?= htmlspecialchars($user['email']) ?>" 
                       placeholder="Enter your email address" required>
                <label for="email">Email Address</label>
              </div>
            </div>

            <div class="form-section">
              <div class="section-title">
                <i class="fas fa-info-circle"></i>Account Information
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="text-muted small">Account Type</label>
                    <div class="fw-semibold">
                      <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'primary' ?> px-3 py-2">
                        <i class="fas fa-<?= $user['role'] === 'admin' ? 'user-shield' : 'user' ?> me-2"></i>
                        <?= ucfirst($user['role']) ?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="text-muted small">Member Since</label>
                    <div class="fw-semibold"><?= date('F j, Y', strtotime($user['created_at'])) ?></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex gap-3 justify-content-center">
              <button type="submit" class="btn-primary-custom">
                <i class="fas fa-save me-2"></i>Update Profile
              </button>
              <a href="profile.php" class="btn-outline-custom">
                <i class="fas fa-times me-2"></i>Cancel
              </a>
            </div>
          </form>

          <div class="text-center mt-4">
            <small class="text-muted">
              <i class="fas fa-shield-alt me-1"></i>
              Your information is secure and encrypted
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>