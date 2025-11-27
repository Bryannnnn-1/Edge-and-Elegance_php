<?php
session_start();
require "database.php";

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Fetch user info
$user_sql = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $user_sql->fetch_assoc();

// Fetch user bookings
$bookings_sql = $conn->query("
    SELECT a.*, s.name AS service_name, st.name AS staff_name 
    FROM appointments a
    LEFT JOIN services s ON a.service_id = s.id
    LEFT JOIN staff st ON a.staff_id = st.id
    WHERE a.user_id = $user_id
    ORDER BY a.date DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
</head>

<body class="bg-light">

<?php if (!empty($_SESSION["success_msg"])): ?>
    <div class="alert alert-success text-center"><?= $_SESSION["success_msg"]; ?></div>
    <?php unset($_SESSION["success_msg"]); ?>
<?php endif; ?>

<?php if (!empty($_SESSION["error_msg"])): ?>
    <div class="alert alert-danger text-center"><?= $_SESSION["error_msg"]; ?></div>
    <?php unset($_SESSION["error_msg"]); ?>
<?php endif; ?>

<div class="container py-4">
    <div class="row">

        <!-- LEFT SIDE — PROFILE -->
        <div class="col-md-8">
            <div class="card p-3 mb-3">
                <h4>Personal Information</h4>

                <form action="update_profile.php" method="POST">
                    <input type="hidden" name="update_type" value="details">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" value="<?= $user['fname'] ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" value="<?= $user['lname'] ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>">
                    </div>

                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>">
                    </div>

                    <button class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <!-- BOOKINGS LIST -->
            <div class="card p-3">
                <h4>Your Appointments</h4>

                <?php if ($bookings_sql->num_rows === 0): ?>
                    <p class="text-muted">No appointments booked.</p>
                <?php endif; ?>

                <?php while ($b = $bookings_sql->fetch_assoc()): ?>
                    <div class="border rounded p-2 mb-2 bg-white">
                        <strong><?= $b['service_name'] ?></strong><br>
                        <?= $b['date'] ?> | <?= $b['start_time'] ?> - <?= $b['end_time'] ?><br>
                        Staff: <?= $b['staff_name'] ?><br>
                        Status: <span class="badge bg-info"><?= $b['status'] ?></span>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>

        <!-- RIGHT SIDE — AVATAR -->
        <div class="col-md-4">
            <div class="card text-center p-3">

                <?php 
                    $avatar = (!empty($user["avatar"]) && file_exists($user["avatar"])) 
                        ? $user["avatar"] 
                        : "default.png";
                ?>

                <img src="<?= $avatar ?>" class="rounded-circle mb-2" width="120">

                <h5><?= $user["fname"] . " " . $user["lname"] ?></h5>
                <p class="text-muted">
                    Member since <?= date("M Y", strtotime($user["created_at"])) ?>
                </p>

                <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="update_type" value="avatar">
                    <input type="file" name="avatar" class="form-control mb-2">
                    <button class="btn btn-secondary w-100">Upload Photo</button>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
setTimeout(() => {
    const alertBox = document.querySelector('.alert-success, .alert-danger');
    if (alertBox) alertBox.style.display = 'none';
}, 3000);
</script>

</body>
</html>
