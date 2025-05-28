<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="Signin.css" />
</head>
<body>
  <div class="container">
    <div class="signin-section active">
      <form method="POST" action="send_reset_link.php">
        <input type="email" name="email" placeholder="Enter your registered email" class="input-box" required>
        <button type="submit" name="send_reset" class="btn-signin">Send Reset Link</button>
      </form>
      <p style="text-align: center; margin-top: 20px;">
        <a href="Signin.php" style="text-decoration: none; color: #333;">Back to Sign In</a>
      </p>
    </div>
  </div>
</body>
</html>
