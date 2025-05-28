<?php

session_start();

$errors = ['login' => $_SESSION['login_error'] ?? ''];
$activeForm = $_SESSION['active_form'] ??'register';

session_unset();

function showError($error){
  return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm){
  return $formName === $activeForm ? 'active' : '';
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In</title>
  <link rel="stylesheet" href="Signin.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">

    <div class="signin-section <?= isActiveForm('login', $activeForm); ?>" id="login-form">
      <h2>Signin</h2>
      <form action="login_registration.php" method="post">
        <?= showError($errors['login']); ?>
        <input type="text" name="email" placeholder="Email" class="input-box" required />
        <input type="password" name="password" placeholder="Password" class="input-box" required />
        <button type="submit" name="login" class="btn-signin">Signin</button>
      </form>
      <p style="margin-top: 10px; text-align: center;">
        <a href="forgot_password.php" style="text-decoration: none; color: #007bff;">Forgot your password?</a>
      </p>

      <p class="or">or signin with</p>
      <div class="social-icons">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" />
        <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google+" />
        <img src="https://cdn-icons-png.flaticon.com/512/145/145807.png" alt="LinkedIn" />
      </div>
    </div>

    <div class="welcome-section">
      <h2>Welcome back!</h2>
      <p>
        Welcome back! We are so happy to have you here. It's great to see you again.
        We hope you had a safe and enjoyable time away.
      </p>
      <a href="SignUp.php" class="btn-signup">No account yet? Signup.</a>
    </div>

  </div>
</body>
</html>

