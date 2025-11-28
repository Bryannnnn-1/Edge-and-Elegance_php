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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- ensure proper mobile scaling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <header>
        <?php include("html/header_user.html"); ?>
    </header>


    <div class="container-fluid py-4">
        <div class="row g-0">

            <div class="col-12 col-md-4 ">
                <div class="p-2 p-md-3">
                    <div class="card text-center p-3 w-100 h-100">
                        <?php 
                            $avatar = (!empty($user["avatar"]) && file_exists($user["avatar"])) 
                                ? $user["avatar"] 
                                : "default.png";
                        ?>
                        <img src="<?= $avatar ?>" class="rounded-circle mb-3 mx-auto d-block" width="120" alt="User Avatar">
                        <h3 class="mb-1"><?= htmlspecialchars($user["fname"] . " " . $user["lname"]) ?></h3>
                        <h5 class="mb-1"><?= htmlspecialchars($user["email"]) ?></h>
                        <br>
                        <br>

                        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                            <label for="avatar" class="fs-6">Change Profile Picture below</label>
                            <input type="hidden" name="update_type" value="avatar">
                            <input type="file" name="avatar" class="form-control mb-2 avatar">
                            <button class="btn btn-primary w-100">Upload Photo</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-8 ">
                <div class="p-2 p-md-3">
                    <div class="card p-3 mb-3 w-100">
                        <h4 class="mb-3">Personal Information</h4>
                        <form action="update_profile.php" method="POST">
                            <input type="hidden" name="update_type" value="details">

                            <div class="row fs-5">
                                <div class="col-md-6">
                                    <label class="form-label" for="fname">First Name</label>
                                    <input type="text" name="fname" class="form-control" value="<?= htmlspecialchars($user['fname']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="lname" class="form-control" value="<?= htmlspecialchars($user['lname']) ?>">
                                </div>
                            </div>

                            <div class=" fs-5">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>">
                            </div>

                            <div class="fs-5">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
                            </div>

                            <button class="btn btn-primary">Save Changes</button>
                        </form>
                        <br>

                            <?php if (!empty($_SESSION["success_msg"])): ?>
                                <div class="alert alert-success text-center mb-0"><?= $_SESSION["success_msg"]; ?></div>
                                <?php unset($_SESSION["success_msg"]); ?>
                            <?php endif; ?>

                            <?php if (!empty($_SESSION["error_msg"])): ?>
                                <div class="alert alert-danger text-center mb-0"><?= $_SESSION["error_msg"]; ?></div>
                                <?php unset($_SESSION["error_msg"]); ?>
                            <?php endif; ?>
                    </div>


                    <div class="card p-3 w-100">
                        <h4 class="mb-3">Your Appointments</h4>

                        <?php if ($bookings_sql->num_rows === 0): ?>
                            <p class="text-muted mb-0">No appointments booked.</p>
                        <?php else: ?>
                            <?php while ($b = $bookings_sql->fetch_assoc()): ?>
                                <div class="border rounded p-2 mb-2 bg-white">
                                    <strong><?= htmlspecialchars($b['service_name']) ?></strong><br>
                                    <?= htmlspecialchars($b['date']) ?> | <?= htmlspecialchars($b['start_time']) ?> - <?= htmlspecialchars($b['end_time']) ?><br>
                                    Staff: <?= htmlspecialchars($b['staff_name']) ?><br>
                                    Status: <span class="badge bg-info"><?= htmlspecialchars($b['status']) ?></span>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <p class="text-muted mb-3 text-center">Member since <?= date("M Y", strtotime($user["created_at"])) ?></p>

    <script>
        setTimeout(() => {
            const alertBox = document.querySelector('.alert-success, .alert-danger');
            if (alertBox) alertBox.style.display = 'none';
        }, 3000);
    </script>

    <style>
        .card{
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.54);
            backdrop-filter: blur(10px);
            border: none;
        }
        .avatar{
            background-color: black;
            border: var(--primary-color);
            color: white;
        }
        .choose{
            background-color: black;
            color: white;
        }
        .card { 
            max-width: 100%; 
        }
    </style>

</body>
</html>