<?php
require_once '../includes/auth.php';
?>

<!-- <?php include "includes/header.php"; ?> -->

<div class="container mt-5">
    <div class="card mx-auto shadow" style="max-width: 500px;">
        <div class="card-body text-center">
            
            <h4><?= htmlspecialchars($_SESSION['username']) ?></h4>
            <p class="text-muted"><?= htmlspecialchars($_SESSION['email']) ?></p>

            <a href="edit_profile.php" class="btn btn-primary mt-3">Edit Profile</a>
        </div>
    </div>
</div>
<!-- <?php include "includes/footer.php"; ?> -->