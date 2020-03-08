<?php
session_start();

// initializing variables

$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['userId']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
    array_push($errors, "User Id is required");
    }
    if (empty($email)) {
    array_push($errors, "Email is required");
    }
    if (empty($phonenumber)) {
    array_push($errors, "Phonenumber is required");
    }
   if (empty($password_1)) {
    array_push($errors, "Password is required");
     }
   if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
    }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
     $user_check_query = "SELECT * FROM registration WHERE username='$username' OR phonenumber=$phonenumber OR email='$email' LIMIT 1";
     $result = mysqli_query($db, $user_check_query)  or die("connection failed at retrive");
    $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
              if ($user['username'] === $username) {
                array_push($errors, "User Id already exists");
             }

                if ($user['phonenumber'] === $phonenumber) {
              array_push($errors, "Phone number already exists");
              }
              if ($user['email'] === $email) {
                 array_push($errors, "Phone number already exists");
              }
           }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1); //encrypt the password before saving in the database

    $query = "INSERT INTO registration (username,phonenumber, password,email) VALUES ('$username', '$phonenumber', '$password','$email')";
    if (! mysqli_query($db, $query)) {
      echo("Error description: " . mysqli_error($db));
      return;
    }
  
   

    $_SESSION['username'] =$username;

    $_SESSION['email'] =$email;
    $_SESSION['phonenumber'] =$phonenumber;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  $queryforadmin = "SELECT * FROM admin";
  $resultforadmin=mysqli_query($db, $queryforadmin);
  $check=mysqli_fetch_assoc($resultforadmin);
  if($check['username']==="$email" and $check['password']==="$password"){
    header('location: admin.php');
    $_SESSION['username'] =$email;
    $_SESSION['password']=$password;
    return;
  }

  if (count($errors) == 0) {
    
    $password = md5($password);
    
    $query = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $user = mysqli_fetch_assoc($results);
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['phonenumber'] = $user['phonenumber'];
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    } else {
      array_push($errors, "Wrong Email / password combination");
    }
  }
}

?>
