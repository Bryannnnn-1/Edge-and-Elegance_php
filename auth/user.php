<?php
require_once "auth.php"; // User must be logged in

// Restrict access to normal users only
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
    header("Location: ../admin_dashboard.php");
    exit;
}
?>
