<?php
require_once 'config.php';

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND token = ?");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Set verified and clear token
        $update = $conn->prepare("UPDATE users SET verified = 1, token = NULL WHERE email = ?");
        $update->bind_param("s", $email);
        $update->execute();

        echo "✅ Your email has been verified successfully. You can now <a href='Signin.php'>login</a>.";
        echo "<script>setTimeout(() => { window.location.href = 'Signin.php'; }, 3000);</script>";
    } else {
        echo "❌ Invalid or expired verification link.";
    }
} else {
    echo "❌ Missing email or token.";
}
