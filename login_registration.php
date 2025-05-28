<?php
session_start();
require_once 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
require 'includes/PHPMailer/src/Exception.php';


// Registration
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $plainPassword = $_POST['password'];
    $password = password_hash($plainPassword, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(32));

    $checkEmail = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkResult = $checkEmail->get_result();

    if ($checkResult->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
        header("Location: SignUp.php");
        exit();
    } else {
        $stmt = $conn->prepare("INSERT INTO users(name, email, password, token, verified) VALUES (?, ?, ?, ?, 0)");
        $stmt->bind_param("ssss", $name, $email, $password, $token);
        $stmt->execute();

        // Send verification email
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sagnikdeb85842@gmail.com';
            $mail->Password = 'vcofpnxmgdmzxrlm'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sagnikdeb85842@gmail.com', 'Your Website');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'Verify your email address';
            $mail->Body = "Hi <b>$name</b>,<br><br>
                Please click the link below to verify your email:<br>
                <a href='http://localhost/Final%20project/verify.php?email=$email&token=$token'>Verify Email</a><br><br>
                If you did not register, you can ignore this email.";

            if ($mail->send()) {
                echo "<h3 style='color:green'>✅ Verification email sent successfully!</h3>";
                echo "<p>Please check your inbox or spam folder.</p>";
                echo "<a href='Signin.php'>Click here to login after verification</a>";
            } else {
                echo "<h3 style='color:red'>❌ Failed to send email:</h3>";
                echo "<pre>" . $mail->ErrorInfo . "</pre>";
            }
            header("Location: Signin.php");
            exit();
        } catch (Exception $e) {
            echo "<h3 style='color:red'>❌ Exception caught:</h3>";
            echo "<pre>" . $mail->ErrorInfo . "</pre>";
            exit();
        }
    }
}


// LogIn
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT name, email, password, verified FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($user['verified'] == 0) {
            $_SESSION['login_error'] = 'Please verify your email before logging in.';
            $_SESSION['active_form'] = 'login';
            header("Location: Signin.php");
            exit();
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: home.php");
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: Signin.php");
    exit();
}
