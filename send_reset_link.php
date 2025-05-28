<?php
session_start();
require_once 'config.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
require 'includes/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send_reset'])) {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32));

    // Check if user exists
    $stmt = $conn->prepare("SELECT name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();

        // Update token
        $update = $conn->prepare("UPDATE users SET token = ? WHERE email = ?");
        $update->bind_param("ss", $token, $email);
        $update->execute();

        // Send reset email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sagnikdeb85842@gmail.com';
            $mail->Password = 'vcofpnxmgdmzxrlm';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sagnikdeb85842@gmail.com', 'LeUn');
            $mail->addAddress($email, $user['name']);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password - LeUn';
            $mail->Body = "Hi <b>{$user['name']}</b>,<br><br>
                Click below to reset your password:<br>
                <a href='http://localhost/Final%20project/reset_password.php?email=$email&token=$token'>Reset Password</a><br><br>
                If you did not request this, please ignore.";

            $mail->send();
            echo "Reset link sent to your email!";
        } catch (Exception $e) {
            echo "Email sending failed: " . $mail->ErrorInfo;
        }
    } else {
        echo "No account found with that email.";
    }
}
?>
