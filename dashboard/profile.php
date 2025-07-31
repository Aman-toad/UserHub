<?php 
session_start();
$user = $_SESSION['user'];
?>

<!-- <?php include "includes/header.php"; ?> -->

<div class="container mt-5">
    <div class="card mx-auto shadow" style="max-width: 500px;">
        <div class="card-body text-center">
            
            <h4><?= htmlspecialchars($user['full_name']) ?></h4>
            <p class="text-muted"><?= htmlspecialchars($user['email']) ?></p>

            <a href="edit_profile.php" class="btn btn-primary mt-3">Edit Profile</a>
        </div>
    </div>
</div>
<!-- <?php include "includes/footer.php"; ?> -->