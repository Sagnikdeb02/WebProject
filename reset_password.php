<?php
require_once 'config.php';

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Verify token
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND token = ?");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        if (isset($_POST['reset'])) {
            $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password = ?, token = NULL WHERE email = ?");
            $update->bind_param("ss", $newPassword, $email);
            $update->execute();
            echo "Password has been reset. <a href='Signin.php'>Login now</a>";
            exit();
        }
    } else {
        echo "Invalid or expired reset link.";
        exit();
    }
} else {
    echo "Invalid access.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
</head>
<body>
  <h2>Reset Your Password</h2>
  <form method="POST">
    <input type="password" name="new_password" placeholder="New Password" required>
    <button type="submit" name="reset">Update Password</button>
  </form>
</body>
</html>
