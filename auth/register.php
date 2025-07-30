<?php
require_once '../config/config.php';

$errors = [];
$success = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $full_name = trim($_POST['full_name']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // validations
  if(empty($full_name) || empty($username) || empty($password) || empty($confirm_password)){
    $errors[] = "All fields are required.";
  }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email Format.";
  }elseif ($password !== $confirm_password) {
    $errors[] = "Password do not match.";
  }else {
    //hashing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // INSERT USER
    $stmt = $pdo -> prepare("INSERT INTO users (full_name, username, email, password) VALUES(?, ?, ?, ?)");
    try{
$stmt -> execute([$full_name, $username, $email, $hashedPassword]);
    $success = "User Register Successfully !";
    } catch(PDOException $e){
      $errors[] = "Username or Email alread Exist.";
    }    
  }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resister - UserHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  </head>

  <body class="bg-light">
    <div class="container mt-5">
      <h2>Register</h2>
      <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $e) echo "<div> $e </div>"; ?>
      </div>
      <?php elseif ($success): ?>
      <div class="alert alert-success">
        <?=$success?>
      </div>
      <?php endif; ?>

      <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
  </body>

</html>