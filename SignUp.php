<?php

session_start();

$errors = ['register' => $_SESSION['register_error'] ?? ''];
$activeForm = $_SESSION['active_form'] ??'login';

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
  <title>Signup</title>
  <link rel="stylesheet" href="signup.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="signup-section <?= isActiveForm('register', $activeForm); ?>" id="register-form">
      <h2>Signup</h2>
      <form action="login_registration.php" method="post">
        <?= showError($errors['register']); ?>
        <input type="text" name="name" placeholder="Full Name" class="input-box" required />
        <input type="email" name="email" placeholder="Email Address" class="input-box" required />
        <input type="password" name="password" placeholder="Create Password" class="input-box" required />
        <button type="submit" name="register" class="btn-signup">Create Account</button>
      </form>
      <p class="or">or signup with</p>
      <div class="social-icons">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" />
        <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google+" />
        <img src="https://cdn-icons-png.flaticon.com/512/145/145807.png" alt="LinkedIn" />
      </div>
    </div>
    <div class="welcome-section">
      <h2>Hello there!</h2>
      <p>
        Join us today and get access to our awesome platform. 
        Let's get you set up with a brand new account!
      </p>
      <a href="Signin.php" class="btn-signin">Already have an account? Signin.</a>
    </div>
  </div>

  <script src="script.js"></script>

</body>
</html>
