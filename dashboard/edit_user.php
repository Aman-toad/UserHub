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
$succcss = "";

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
        $stmt = $pdo -> prepare("UPDATE users SET full_name = ?, email = ?, role=? WHERE id = ?");
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Edit User</h2>

    <?php if(!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach($errors as $e) echo "<div>$e</div>"; ?>
      </div>
    <?php elseif($succcss): ?>
      <div class="alert alert-success"><?= $succcss ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>" required>
              </div>
              <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
              </div>
              <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
              </div>
              <div class="mb-3">
                  <label class="form-label">Role</label>
                  <select name="role" class="form-select">
                      <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                      <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                  </select>
              </div>
              <button type="submit" class="btn btn-success">Update</button>
              <a href="users.php" class="btn btn-secondary">Back</a>
    </form>
  </div>
</body>
</html>