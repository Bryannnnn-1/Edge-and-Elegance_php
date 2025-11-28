<?php
require_once "auth.php";  // Makes sure user is logged in first

// Restrict access to admins only
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../user_dashboard.php"); // Normal users go here
    exit;
}
?>
