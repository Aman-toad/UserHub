<?php
require_once '../includes/auth.php';
require_once '../config/config.php';

if($_SESSION['role'] !== 'admin'){
  die("Access Denied. Admin only.");
} else{
  //getting all users
$stmt = $pdo -> query("SELECT id, full_name, username, email, role FROM users");
$users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <title>User List - Userhub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <div class="container mt-5">
      <h2 class="mb-4">User List</h2>
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Profile</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
          <tr>
            <td>
              <?= $u['id'] ?>
            </td>
            <td>
              <?= htmlspecialchars($u['full_name']) ?>
            </td>
            <td>
              <?= htmlspecialchars($u['username']) ?>
            </td>
            <td>
              <?= htmlspecialchars($u['email']) ?>
            </td>
            <td><span class="badge bg-<?= $u['role'] === 'admin' ? 'danger' : 'primary' ?>">
                <?= $u['role'] ?>
              </span></td>
            <td>
              <?php if ($_SESSION['role'] === 'admin'): ?>
              <a href="edit_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="../actions/delete_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Are you sure?');">Delete</a>
              <?php else: ?>
              <span class="text-muted">No Access</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </body>

</html>