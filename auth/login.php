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
      $_SESSION['role'] = $user['role'];

      //redirect
      header("Location: ../dashboard/index.php");
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
  </head>

  <body class='bg-light'>
    <div class="container mt-5">
      <h2>Login</h2>

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
        <button type="submit" class="btn btn-primary">Login</button>
      </form>

      <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </body>

</html>