<?php
require_once '../includes/auth.php';
require_once '../config/config.php';

if($_SESSION['role'] !== 'admin'){
  die("Access Denied !!");
}

if(!isset($_GET['id']) || empty($_GET['id'])){
  die("Invalid request !!");
}

$userId = $_GET['id'];
$errors = [];
$success = "";

//fetch current user data
$stmt = $pdo -> prepare ("SELECT * FROM users WHERE id = ?");
$stmt -> execute([$userId]);
$user = $stmt -> fetch (PDO::FETCH_ASSOC);

if(!$user){
  die("User not found");
}

// form submission handling
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $full_name = trim($_POST['full_name']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $role = $_POST['role'];

  if (empty($full_name) || empty($username) || empty($email)) {
          $errors[] = "All fields are required.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
      } else {
        //update
        $stmt = $pdo -> prepare("UPDATE users SET full_name = ?, username = ?, email = ?, role=? WHERE id = ?");
        try{
          $stmt -> execute([$full_name, $username, $email, $role, $userId]);
          $success = "User Updated Successfully.";
          //refresh
          $user['full_name'] = $full_name;
          $user['username'] = $username;
          $user['email'] = $email;
          $user['role'] = $role;
        }catch(PDOException $e){
          $errors[] = "Username or email may already be taken";
        }
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User - UserHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/edit_user.css">
  <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>

  <div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-lg-6">
      <div class="edit-card p-4 shadow rounded">
        <div class="user-avatar">
            <?php echo strtoupper(substr($user['full_name'], 0, 2)); ?>
          </div>
          
          <h2 class="page-title">Edit User Profile</h2>

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

          <form method="post">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">
                  <i class="fas fa-user me-2"></i>Full Name
                </label>
                <input type="text" name="full_name" class="form-control" 
                       value="<?= htmlspecialchars($user['full_name']) ?>" 
                       placeholder="Enter full name" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">
                  <i class="fas fa-at me-2"></i>Username
                </label>
                <input type="text" name="username" class="form-control" 
                       value="<?= htmlspecialchars($user['username']) ?>" 
                       placeholder="Enter username" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
              </label>
              <input type="email" name="email" class="form-control" 
                     value="<?= htmlspecialchars($user['email']) ?>" 
                     placeholder="Enter email address" required>
            </div>

            <div class="mb-4">
              <label class="form-label">
                <i class="fas fa-user-tag me-2"></i>User Role
              </label>
              <select name="role" class="form-select">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>
                  <i class="fas fa-user"></i> Regular User
                </option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>
                  <i class="fas fa-user-shield"></i> Administrator
                </option>
              </select>
            </div>

            <div class="d-flex gap-3 justify-content-center">
              <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-2"></i>Update User
              </button>
              <a href="users_list.php" class="btn btn-outline-custom">
                <i class="fas fa-arrow-left me-2"></i>Back to Users
              </a>
            </div>
          </form>

          <div class="text-center mt-4">
            <small class="text-muted">
              <i class="fas fa-info-circle me-1"></i>
              Last updated: <?php echo date('M j, Y g:i A', strtotime($user['updated_at'] ?? $user['created_at'])); ?>
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
</html>