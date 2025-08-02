<?php
require_once("../config/config.php");
require_once("../includes/auth.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo "Unauthorized Access!";
  exit;
}

//dashbord data
$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
$totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

$stmt = $pdo->query("SELECT COUNT(*) as admin_count FROM users WHERE role = 'admin'");
$adminCount = $stmt->fetch(PDO::FETCH_ASSOC)['admin_count'];

$stmt = $pdo->query("SELECT COUNT(*) as user_count FROM users WHERE role = 'user'");
$userCount = $stmt->fetch(PDO::FETCH_ASSOC)['user_count'];

// Recent users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC LIMIT 5");
$recentUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UserHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        <a href="admin.php" class="nav-link active">
          <i class="fas fa-tachometer-alt"></i>Dashboard
        </a>
      </div>
      <div class="nav-item">
        <a href="users_list.php" class="nav-link">
          <i class="fas fa-users"></i>Manage Users
        </a>
      </div>
      <div class="nav-item">
        <a href="profile.php" class="nav-link">
          <i class="fas fa-user-circle"></i>Profile
        </a>
      </div>
      <div class="nav-item">
        <a href="change_password.php" class="nav-link">
          <i class="fas fa-key"></i>Change Password
        </a>
      </div>
      <div class="nav-item">
        <a href="../actions/export_csv.php" class="nav-link">
          <i class="fas fa-download"></i>Export Data
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
    <!-- Top Bar -->
    <div class="top-bar">
      <div>
        <h4 class="mb-0">Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h4>
        <p class="text-muted mb-0">Here's what's happening with your platform today.</p>
      </div>
      <div class="user-avatar">
        <?php echo strtoupper(substr($_SESSION['username'], 0, 2)); ?>
      </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
      <div class="col-md-3 mb-3">
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-number"><?php echo $totalUsers; ?></div>
          <p class="text-muted mb-0">Total Users</p>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-user-shield"></i>
          </div>
          <div class="stat-number"><?php echo $adminCount; ?></div>
          <p class="text-muted mb-0">Administrators</p>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-user"></i>
          </div>
          <div class="stat-number"><?php echo $userCount; ?></div>
          <p class="text-muted mb-0">Regular Users</p>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <div class="stat-number">98.5%</div>
          <p class="text-muted mb-0">System Health</p>
        </div>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
      <div class="col-md-8">
        <div class="chart-card">
          <h5 class="mb-4">User Growth</h5>
          <canvas id="userGrowthChart" height="100"></canvas>
        </div>
      </div>
      <div class="col-md-4">
        <div class="chart-card">
          <h5 class="mb-4">User Distribution</h5>
          <canvas id="userDistributionChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Recent Users Table -->
    <div class="table-card">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Recent Users</h5>
        <a href="users_list.php" class="btn btn-primary-custom">View All Users</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>User</th>
              <th>Email</th>
              <th>Role</th>
              <th>Joined</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentUsers as $user): ?>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="user-avatar me-3" style="width: 35px; height: 35px; font-size: 0.8rem;">
                    <?php echo strtoupper(substr($user['full_name'], 0, 2)); ?>
                  </div>
                  <div>
                    <div class="fw-semibold"><?php echo htmlspecialchars($user['full_name']); ?></div>
                    <small class="text-muted">@<?php echo htmlspecialchars($user['username']); ?></small>
                  </div>
                </div>
              </td>
              <td><?php echo htmlspecialchars($user['email']); ?></td>
              <td>
                <span class="badge badge-custom <?php echo $user['role'] === 'admin' ? 'bg-danger' : 'bg-primary'; ?>">
                  <?php echo ucfirst($user['role']); ?>
                </span>
              </td>
              <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
              <td>
                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-light">
                  <i class="fas fa-edit"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // User Growth Chart
    const ctx1 = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'New Users',
          data: [12, 19, 8, 15, 25, 22],
          borderColor: '#00d4ff',
          backgroundColor: 'rgba(0, 212, 255, 0.1)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: { color: 'white' }
          }
        },
        scales: {
          y: {
            ticks: { color: 'white' },
            grid: { color: 'rgba(255, 255, 255, 0.1)' }
          },
          x: {
            ticks: { color: 'white' },
            grid: { color: 'rgba(255, 255, 255, 0.1)' }
          }
        }
      }
    });

    // User Distribution Chart
    const ctx2 = document.getElementById('userDistributionChart').getContext('2d');
    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ['Regular Users', 'Administrators'],
        datasets: [{
          data: [<?php echo $userCount; ?>, <?php echo $adminCount; ?>],
          backgroundColor: ['#00d4ff', '#ff6b9d'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: { color: 'white' }
          }
        }
      }
    });
  </script>

</body>

</html>