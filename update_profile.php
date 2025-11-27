<?php
session_start();
require "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$errors = [];
$avatar_path = null;

/* -------------------------
   HANDLE AVATAR UPLOAD (SEPARATE)
-------------------------- */
if (!empty($_FILES["avatar"]["name"])) {

    $allowed = ["jpg", "jpeg", "png"];
    $file_ext = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($file_ext, $allowed)) {
        $errors[] = "Only JPG, JPEG, or PNG files are allowed.";
    }

    // Validate file size (max 2MB)
    if ($_FILES["avatar"]["size"] > 2 * 1024 * 1024) {
        $errors[] = "Image must be smaller than 2MB.";
    }

    // If no errors → upload
    if (empty($errors)) {
        $avatar_path = "uploads/" . time() . "_" . basename($_FILES["avatar"]["name"]);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar_path);

        // Update avatar only
        $stmt = $conn->prepare("UPDATE users SET avatar=? WHERE id=?");
        $stmt->bind_param("si", $avatar_path, $user_id);
        $stmt->execute();

        $_SESSION["success_msg"] = "Profile picture updated successfully!";
        header("Location: user_dashboard.php");
        exit;
    }
}

/* -------------------------
   IF USER IS NOT UPDATING PROFILE FIELDS → END HERE
-------------------------- */
if (!isset($_POST["fname"])) {
    header("Location: user_dashboard.php");
    exit;
}

/* -------------------------
   SANITIZE USER INPUTS
-------------------------- */
$fname = trim(filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS));
$lname = trim(filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
$phone = trim($_POST["phone"]); // manual validation

/* -------------------------
   VALIDATION RULES
-------------------------- */

// First Name
if (empty($fname) || !preg_match("/^[a-zA-Z]+$/", $fname)) {
    $errors[] = "First name should contain letters only.";
}

// Last Name
if (empty($lname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
    $errors[] = "Last name should contain letters only.";
}

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Phone number: MUST start with 07 and be exactly 11 digits
if (!preg_match("/^07\d{9}$/", $phone)) {
    $errors[] = "Phone number must be 11 digits and start with '07'.";
}

/* -------------------------
   IF ERRORS → STOP
-------------------------- */
if (!empty($errors)) {
    $_SESSION["error_msg"] = implode("<br>", $errors);
    header("Location: user_dashboard.php");
    exit;
}

/* -------------------------
   UPDATE USER DETAILS
-------------------------- */
$stmt = $conn->prepare("
    UPDATE users 
    SET fname = ?, lname = ?, email = ?, phone = ?
    WHERE id = ?
");
$stmt->bind_param("ssssi", $fname, $lname, $email, $phone, $user_id);
$stmt->execute();

$_SESSION["success_msg"] = "Profile updated successfully!";
header("Location: user_dashboard.php");
exit;

?>
