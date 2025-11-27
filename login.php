<?php
session_start();
include("database.php");

// Read message from session (after redirect)
$message = "";
$message_type = "";

if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    $message_type = $_SESSION["message_type"];
    unset($_SESSION["message"], $_SESSION["message_type"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($email) || empty($password)) {
        $_SESSION["message"] = "Please fill in the required details!";
        $_SESSION["message_type"] = "danger";
        header("Location: login.php");
        exit;
    }


    if ($_POST["submit"] === "register") {

        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION["message"] = "This account already exists, try logging in.";
            $_SESSION["message_type"] = "warning";
            header("Location: login.php");
            exit;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hash);
        $stmt->execute();

        $_SESSION["message"] = "You are registered!";
        $_SESSION["message_type"] = "success";
        header("Location: login.php");
        exit;
    }


    if ($_POST["submit"] === "login") {

        $stmt = $conn->prepare("SELECT id, password_hash, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $_SESSION["message"] = "No account found with this email!";
            $_SESSION["message_type"] = "danger";
            header("Location: login.php");
            exit;
        }

        $stmt->bind_result($id, $hash, $role);
        $stmt->fetch();

        if (password_verify($password, $hash)) {

            $_SESSION["user_id"] = $id;
            $_SESSION["role"] = $role;

            $_SESSION["message"] = "Login successful!";
            $_SESSION["message_type"] = "success";

            if ($role === "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;

        } else {
            $_SESSION["message"] = "Incorrect password!";
            $_SESSION["message_type"] = "danger";
            header("Location: login.php");
            exit;
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Edge and Elegance</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
</head>

<body>

    <form class="glass-card"
          method="POST"
          action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <h3 class="text-center fw-bold">Welcome</h3>
        <p class="text-center mb-4">Sign in to your account</p>

        <?php if (!empty($message)): ?>
            <div id="php-message"
                 data-type="<?= $message_type ?>"
                 data-text="<?= $message ?>">
            </div>
        <?php endif; ?>

        <input type="email" class="form-control mb-3" placeholder="Email Address" name="email">
        <input type="password" class="form-control mb-3" placeholder="Password" name="password">

        <div class="d-flex justify-content-between mb-3">
            <a href="#" class="text-dark text-decoration-none">Forgot password?</a>
        </div>

        <div class="d-flex">
            <button type="submit" name="submit" value="register" class="btn gradient-btn w-50 me-2 mt-3">Create Account</button>
            <button type="submit" name="submit" value="login" class="btn gradient-btn w-50 mt-3">Sign In</button>
        </div>

    </form>

</body>
</html>



<style>
    body {
        background: linear-gradient(135deg, #6a5af9, #8c6ff7);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .glass-card {
        width: 380px;
        padding: 35px 30px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(25px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.25);
        border: none;
        color: white;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .gradient-btn {
        background: linear-gradient(90deg, #4b00b5, #afafaf);
        border: none;
        color: black;
        font-weight: bold;
    }

    .alert {
        transition: opacity 0.3s ease;
    }
</style>



<script>
document.addEventListener("DOMContentLoaded", () => {
    const msg = document.getElementById("php-message");

    if (msg) {
        const alertBox = document.createElement("div");
        alertBox.className = "alert alert-" + msg.dataset.type + " text-center py-2";
        alertBox.textContent = msg.dataset.text;

        document.querySelector("form").prepend(alertBox);

        setTimeout(() => {
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 300);
        }, 3000);
    }
});
</script>
