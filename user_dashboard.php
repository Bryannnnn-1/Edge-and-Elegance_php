<?php require_once "auth/user.php"; ?>
<?php require_once "auth/auth.php"; ?>
<?php include("database.php") ?>


<?php
session_start();


$user_id = $_SESSION["user_id"];

// -------------------- GET USER DATA ---------------------
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id LIMIT 1");
$user = mysqli_fetch_assoc($query);

// -------------------- UPDATE PROFILE --------------------
if (isset($_POST["update_profile"])) {

    $first = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);

    $update_sql = "UPDATE users SET 
        first_name='$first',
        last_name='$last',
        email='$email',
        WHERE id=$user_id";

    if (mysqli_query($conn, $update_sql)) {
            mysqli_query($conn, "INSERT INTO logs(user_id, activity) VALUES ($user_id, 'Updated profile information')");
            header("Location: dashboard.php?updated=1");
        exit;
    }
}

// -------------------- UPLOAD AVATAR --------------------
if (isset($_POST["upload_avatar"])) {

    if (!empty($_FILES["avatar"]["name"])) {

        $filename = time() . "_" . basename($_FILES["avatar"]["name"]);
        $target = "uploads/" . $filename;

        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target)) {

            mysqli_query($conn, "UPDATE users SET avatar='$filename' WHERE id=$user_id");
            mysqli_query($conn, "INSERT INTO logs(user_id, activity) VALUES ($user_id, 'Changed profile photo')");

            header("Location: dashboard.php?avatar=1");
            exit;

        }
    }
}

// -------------------- FETCH ACTIVITY LOGS --------------------
$logs = mysqli_query($conn, "SELECT * FROM logs WHERE user_id=$user_id ORDER BY created_at DESC LIMIT 20");

?>
<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    body { background: #f5f6fa; }
    .dash-box { background:#fff; border-radius:8px; padding:20px; margin-bottom:20px; }
    .avatar-img { width:120px; height:120px; border-radius:50%; object-fit:cover; }
</style>
</head>
<body>

<div class="container my-4">

<h3>Welcome, <?= $user["first_name"] ?>!</h3>
<hr>

<div class="row">

    <!-- LEFT SIDE: PROFILE FORM -->
    <div class="col-md-8">
        <div class="dash-box">

            <h5>Personal Information</h5>
            <form method="POST">

                <div class="row">
                    <div class="col-md-6">
                        <label>First Name</label>
                        <input name="first_name" class="form-control"
                        value="<?= $user['first_name'] ?>">
                    </div>

                    <div class="col-md-6">
                        <label>Last Name</label>
                        <input name="last_name" class="form-control"
                        value="<?= $user['last_name'] ?>">
                    </div>
                </div>

                <label class="mt-2">Email</label>
                <input name="email" class="form-control"
                value="<?= $user['email'] ?>">

                <label class="mt-2">Phone</label>
                <input name="phone" class="form-control"
                value="<?= $user['phone'] ?>">

                <label class="mt-2">Address</label>
                <input name="address" class="form-control"
                value="<?= $user['address'] ?>">

                <button name="update_profile" class="btn btn-dark mt-3">Save Changes</button>
            </form>

        </div>
    </div>

    <!-- RIGHT SIDE: AVATAR + LOGS -->
    <div class="col-md-4">

        <div class="dash-box text-center">
            <img src="uploads/<?= $user["avatar"] ?? 'default.png' ?>"
            class="avatar-img mb-3">

            <h5><?= $user["first_name"] . " " . $user["last_name"] ?></h5>
            <p>Member since <?= date("M Y", strtotime($user["created_at"])) ?></p>

            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="avatar" class="form-control mb-2">
                <button name="upload_avatar" class="btn btn-outline-dark">Upload Photo</button>
            </form>
        </div>

        <div class="dash-box">
            <h6>Recent Activity</h6>
            <ul>
            <?php while ($log = mysqli_fetch_assoc($logs)): ?>
                <li><?= $log["activity"] ?> 
                <small class="text-muted"> (<?= $log["created_at"] ?>)</small></li>
            <?php endwhile; ?>
            </ul>
        </div>

    </div>

</div>
</div>

</body>
</html>
