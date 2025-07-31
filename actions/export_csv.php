<?php
require_once '../config/config.php';
require_once '../includes/auth.php';

//only admin can export users
if($_SESSION['role'] !== 'admin'){
  die("Access Denied. Admin only.");
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Full Name', 'Username', 'Email', 'Created At']);

$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");

while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
  fputcsv($output, [
    $row['id'],
    $row['full_name'],
    $row['username'],
    $row['email'],
    $row['created_at']
  ]);
}

fclose($output);
exit;
?>