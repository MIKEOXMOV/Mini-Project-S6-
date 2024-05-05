
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Student Register</h2>
  </div>
	
  <form method="post" action="student_register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div>
      <div class="input-group">
  	  <label>Register No</label>
  	  <input  type="text" pattern="[a-zA-Z0-9]+" required name="registerNo" value="<?php echo $registerNo; ?>">
  	</div>
      <div class="input-group">
  	  <label>Semester</label>
  	  <input type="number" name="sem" value="<?php echo $sem; ?>">
  	</div>
  	<div class="input-group">
  	  <label>College mail id</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>