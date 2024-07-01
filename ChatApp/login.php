<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "php/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Login</header>
      <form action="#">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email">
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password">
        </div>
        <div class="field button">
          <input type="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="register.php">Signup now</a></div>
    </section>
  </div>

  <script src="javascript/login.js"></script>

</body>
</html>
