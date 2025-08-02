<?php 
session_start();
require_once '../config/config.php';

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $email_or_username = trim($_POST['email_or_username']);
  $password = $_POST['password'];

  //check
  if(empty($email_or_username) || empty($password)){
    $errors[] = "Both fields are required";
  }else{
    //checking if user exist 

    $stmt = $pdo -> prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt -> execute([$email_or_username, $email_or_username]);
    $user = $stmt -> fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
      //store user data in session

      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['full_name'] = $user['full_name'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['email'] = $user['email'];

      //redirect to admin or user based on roles;
      if ($_SESSION['role'] === 'admin') {
        header("Location: ../dashboard/admin.php");
        exit;
      } else {
        header("Location: ../dashboard/user.php");
        exit;
      }     

      exit;
    }else{
      $errors[] = "Invalid Credentials.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UserHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>

  <body>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="hero-card fade-in mt-3">
            <div class="container mt-2">
              <h1 class="text-center display-4 fw-bold mb-3">Login</h1>

              <?php if (!empty($errors)): ?>
              <div class="alert alert-danger">
                <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
              </div>
              <?php endif; ?>

              <form method="POST">
                <div class="mb-3">
                  <label class="form-label">Email or Username</label>
                  <input type="text" name="email_or_username" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <button class="mt-3 btn btn-primary-custom btn-md">
                  Login
                </button>
              </form>

              <p class="mt-3">Don't have an account? <a href="register.php" class="text-dark">Register here</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>