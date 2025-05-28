<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Signin.php");
    exit();
}

$name = $_SESSION['name'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Online Course Page</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
</head>
<body>

<!-- Navigation Bar -->
<header>
  <nav>
  <ul class='nav-bar'>
    <div class="logo">LeUn</div>
    <input type='checkbox' id='check' />
    <span class="menu">
      <li><a href="#home">Home</a></li>
      <li><a href="#courses">Courses</a></li>
      <li><a href="delete_account_page.php">Settings</a></li>
      <li><a href="logout.php" class="nav-button">Logout</a></li>
      <label for="check" class="close-menu">&#10005;</label>
    </span>
    <label for="check" class="open-menu">&#9776;</label>
  </ul>
</nav>
</header>



<!-- Hero Section (Yellow) -->
<section class="hero-section" id="home">
  <div class="hero-content">
    <div class="hero-text">
      <h3>YOUR PERSONAL COACH</h3>
      <h1>ONLINE<br>TRAINING<br>PROGRAMS</h1>
      <p class="source">Transform your dream into <strong>Career</strong>.</p>
      <p class="source">Learn, build your job profile with exclusive assistance.</p>
      <p class="source" style="font-weight: bold;">Welcome, <?= htmlspecialchars($name) ?>!</p>
    </div>
    <div class="hero-img">
      <img src="image1.png" alt="Coach" />
    </div>
  </div>
</section>

<!-- Featured Courses Section (Purple) -->
<section class="courses-section" id="courses">
  <h2 class="section-title">Featured Courses</h2>
  <div class="courses-container">
    <div class="course-card">
      <img src="image2.png" alt="Course Image" class="course-image">
      <span class="course-tag">FRONTEND</span>
      <h3 class="course-title">Beginner’s Guide To Becoming A Professional Frontend Developer</h3>
      <div class="progress-bar"><div class="progress-fill"></div></div>
      <div class="instructor">
        <img src="image2.png" alt="Instructor">
        <div>
          <p class="name">Prashant Kumar</p>
          <p class="role">Programming Instructor</p>
        </div>
      </div>
    </div>

    <div class="course-card">
      <img src="image3.png" alt="Course Image" class="course-image">
      <span class="course-tag">Creative</span>
      <h3 class="course-title">Beginner’s Guide To Becoming A Professional Frontend Developer</h3>
      <div class="progress-bar"><div class="progress-fill"></div></div>
      <div class="instructor">
        <img src="image3.png" alt="Instructor">
        <div>
          <p class="name">Lindsay Lohan</p>
          <p class="role">Advisor</p>
        </div>
      </div>
    </div>

    <div class="course-card">
      <img src="image4.png" alt="Course Image" class="course-image">
      <span class="course-tag">Software</span>
      <h3 class="course-title">Beginner’s Guide To Becoming A Professional Software Developer</h3>
      <div class="progress-bar"><div class="progress-fill"></div></div>
      <div class="instructor">
        <img src="image4.png" alt="Instructor">
        <div>
          <p class="name">Lima Neeson</p>
          <p class="role">Software Developer</p>
        </div>
      </div>
    </div>

  </div>
</section>

</body>
</html>
