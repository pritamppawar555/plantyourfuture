<?php
session_start();


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    // Database connection
    $servername = "localhost";
    $username = "root"; // Changed variable name to avoid conflict
    $password = ""; // Assuming no password is set for the root user
    $database = "plant_your_future"; // Name of the database

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
      // Attempt to create a connection to MySQL database
      $conn = new mysqli($servername, $username, $password, $database);
      
      // Check connection
      if ($conn->connect_error) {
          throw new Exception("Connection failed: " . $conn->connect_error);
      }
      
      // Connection successful, continue with your code...
  } catch (Exception $e) {
      // Display detailed error message
      echo "Connection error: " . $e->getMessage();
  }
  

    // Sign up form submission
    if (isset($_POST['signup'])) {
        // Retrieve form data
        $firstname = $_POST['signup_firstname'];
        $lastname = $_POST['signup_lastname'];
        $email = $_POST['signup_email'];
        $phone = $_POST['signup_phone'];
        $password = $_POST['signup_password'];
      

        // Prepare and execute SQL query
     

        $stmt = $conn->prepare("INSERT INTO login (firstName, lastName, email, phone, password,) VALUES (?, ?, ?, ?, ?, )");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $password,);
        $execval = $stmt->execute();

        // Check if query execution was successful
        if ($execval === true) {
          echo "Registration successful"; // Changed alert to echo
          // Sending email after successful registration
          sendmail($email, $v_code); // Corrected function name
      } else {
          echo "Error: " . $conn->error;
      }

        // Close statement for sign-up
        $stmt->close();
    }

    // Log in form submission
    if (isset($_POST['login'])) 
    {
        $email = $_POST['login_email']; // Changed to avoid conflict
        $password = $_POST['login_password']; // Changed to avoid conflict

        $stmt = $conn->prepare("SELECT * FROM login WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

       // After successful login
        if ($result->num_rows == 1) {
          // Correct credentials, start session and redirect user
          session_start();
          $_SESSION['email'] = $email; // Storing user email in session
        
          // Fetch user data from database
          $user_data = $result->fetch_assoc();
          $_SESSION['user_data'] = $user_data; // Storing user data in session
        
          // Redirect to profile page
          echo"congratulation..!";
          header("Location: profile.php");
          exit(); 
        } else {
          echo "Invalid email or password"; // Display error message
          header("Location: index.php");
          exit(); 
        }
    
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up Signin Form</title>
  <link rel="stylesheet" href="./style.css">

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

 
</head>
<body>

<div id="form">
  <form method="post">

  <div class="container">
    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
      <div id="userform">
        <ul class="nav nav-tabs nav-justified" role="tablist">
          <li class="active"><a href="#signup"  role="tab" data-toggle="tab">Sign up</a></li>
          <li><a href="#login"  role="tab" data-toggle="tab">Log in</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active in" id="signup">
            <h2 class="text-uppercase text-center"> Sign Up for Free</h2>
            <form id="signup-form" method="post" >
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <label>First Name<span class="req">*</span> </label>
                    <input type="text" class="form-control" id="signup_firstname" name="signup_firstname" required data-validation-required-message="Please enter your first name." autocomplete="off">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <label>Last Name<span class="req">*</span> </label>
                    <input type="text" class="form-control" id="signup_lastname" name="signup_lastname" required data-validation-required-message="Please enter your last name." autocomplete="off">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Your Email<span class="req">*</span> </label>
                <input type="email" class="form-control" id="signup_email" name="signup_email" required data-validation-required-message="Please enter your email address." autocomplete="off">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                <label>Your Phone<span class="req">*</span> </label>
                <input type="tel" class="form-control" id="signup_phone" name="signup_phone" required data-validation-required-message="Please enter your phone number." autocomplete="off">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                <label>Password<span class="req">*</span> </label>
                <input type="password" class="form-control" id="signup_password" name="signup_password" required data-validation-required-message="Please enter your password." autocomplete="off">
                <p class="help-block text-danger"></p>
              </div>
              <div class="mrgn-30-top">
                <button type="submit" class="btn btn-larger btn-block" name="signup">
                Sign up
                </button>
              </div>
            </form>
          </div>

          <div class="tab-pane fade in" id="login">
            <h2 class="text-uppercase text-center"> Log in</h2>
            <form id="login-form" method="post">
              <div class="form-group">
                <label>Your Email<span class="req">*</span> </label>
                <input type="email" class="form-control" id="login_email" name="login_email" required data-validation-required-message="Please enter your email address." autocomplete="off">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                <label>Password<span class="req">*</span> </label>
                <input type="password" class="form-control" id="login_password" name="login_password" required data-validation-required-message="Please enter your password." autocomplete="off">
                <p class="help-block text-danger"></p>
              </div>
              <div class="mrgn-30-top">
                <button type="submit" class="btn btn-larger btn-block" name="login">
                Log in
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container --> 
</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
