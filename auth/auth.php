<?php
session_start();

// If user is NOT logged in at all
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}
?>
