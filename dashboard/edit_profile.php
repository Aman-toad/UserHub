<?php 
require_once '../config/config.php';
require_once '../includes/auth.php';



// $user = $_SESSION['user'];
?>

<!-- <?php include "includes/header.php"; ?> -->

<div class="container mt-5">
    <h2>Edit Your Profile</h2>
    <form action="../actions/update_profile.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($_SESSION['full_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_SESSION['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_SESSION['role']) ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

<!-- <?php include "includes/footer.php"; ?> -->