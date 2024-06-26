<?php
session_start();

// initializing variables
$name = "";
$id= "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $id= mysqli_real_escape_string($db, $_POST['id']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($id)) { array_push($errors, "Faculty id is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }

  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM guide WHERE name='$name' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['name'] === $name) {
      array_push($errors, "name already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO guide (name,id,email,password) 
  			  VALUES('$name', '$id','$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['name'] = $name;
  	$_SESSION['success'] = "You are now logged in";
  	header('location:guide success.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($name)) {
  	array_push($errors, "Name is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
    $query = "SELECT id FROM guide WHERE name='$name' AND password='$password'";
    $results = mysqli_query($db, $query);
    
    if (mysqli_num_rows($results) == 1) {
        $row = mysqli_fetch_assoc($results);
        $guideId = $row['id'];
    
        $_SESSION['name'] = $name;
        $_SESSION['guideId'] = $guideId;
        $_SESSION['success'] = "You are now logged in";
        header('location: guidedash.php');
    } else {
        array_push($errors, "Wrong username/password combination");
    }
  }
}

?>