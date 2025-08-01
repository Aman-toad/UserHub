<?php
require_once '../config/config.php';
require_once '../includes/auth.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo "Unauthorized Access!";
  exit;
}

//adding pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';
$params = [];
$where = '';

if($search){
  $where = "WHERE full_name LIKE ? OR username Like ? OR email LIKE ?";
  $params = ["%$search%", "%$search%", "%$search%"];
}

$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM users $where");
$totalStmt->execute($params);
$totalUsers = $totalStmt->fetchColumn();
$totalPages = ceil($totalUsers / $limit);

$query = "SELECT * FROM users $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($query);
$stmt->execute($params);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($_SESSION['role'] !== 'admin'){
  die("Access denied. Admin only.");
} else{
  //getting all users
$stmt = $pdo -> query("SELECT id, full_name, username, email, role FROM users");
$users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

$search = $_GET['search'] ?? '';

if($search){
  $stmt = $pdo -> prepare("SELECT * FROM users WHERE full_name LIKE ? OR username LIKE ? or email LIKE ? ORDER BY created_at DESC");
  $stmt -> execute([
    "%$search%", "%$search%", "%$search%"
  ]);
}else{
  $stmt = $pdo -> query("SELECT * FROM users ORDER BY created_at DESC");
}

$users = $stmt -> fetchAll (PDO::FETCH_ASSOC);

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

      <a href="../actions/export_csv.php" class="btn btn-success mb-3 float-end">
        Export CSV
      </a>

      <!-- search filter -->
      <form class="row mb-4" method="get">
        <div class="col-md-4">
          <input type="text" name="search" class="form-control" placeholder="Seach by name, username, or email"
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="users.php" class="btn btn-secondary">Reset</a>
        </div>
      </form>

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

      <nav>
        <ul class="pagination">
          <?php for($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <? = $i == $page ? 'active' : '' ?>">
            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>">
              <?= $i ?>
            </a>
          </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </body>
</html>