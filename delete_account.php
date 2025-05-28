<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['email'])) {
    header("Location: Signin.php");
    exit();
}

$email = $_SESSION['email'];

$stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    session_destroy();
    echo "<script>alert('Your account has been deleted successfully.'); window.location.href = 'SignUp.php';</script>";
    exit();
} else {
    echo "<script>alert('Error deleting account. Please try again.'); window.location.href = 'home.php';</script>";
    exit();
}
?>
