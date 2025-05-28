<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Delete Account</title>
  <link rel="stylesheet" href="Signin.css" />
</head>
<body>
  <div class="container">
    <div class="signin-section active">
      <h2 style="color: red;">Delete Account</h2>
      <p style="margin-bottom: 20px; color: #444;">
        Are you sure you want to permanently delete your account? This action cannot be undone.
      </p>
      <form method="POST" action="delete_account.php" onsubmit="return confirm('This will permanently delete your account. Continue?');">
        <button type="submit" name="delete_account" class="btn-signin" style="background-color: darkred;">Yes, Delete My Account</button>
      </form>
      <p style="text-align: center; margin-top: 20px;">
        <a href="home.php" style="text-decoration: none; color: #333;">Cancel and Go Back</a>
      </p>
    </div>
  </div>
</body>
</html>
