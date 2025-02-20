<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming no password is set for the root user
    $database = "plant_your_future";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sign up form submission
    if (isset($_POST['signup'])) {
        // Retrieve form data
        $name = $_POST['signup_name']; // Assuming username is entered manually by the user
        $email = $_POST['signup_email']; 
        $address = $_POST['signup_address'];
        $contact = $_POST['signup_contact'];
        $note = $_POST['signup_note'];
        $utrno = $_POST['signup_utrno'];
    
        // Prepare and execute SQL query to update the user's information
        $stmt = $conn->prepare("UPDATE login SET name=?, address=?, contact=?, note=?, utrno=? WHERE email=?");
        // Assuming there's a column called email in your login table to uniquely identify each user
    
        // Bind parameters
        $stmt->bind_param("ssssss", $name, $address, $contact, $note, $utrno, $email);
        // Replace $email with the actual email entered by the user
    
        // Execute the update query
        $execval = $stmt->execute();
    
        // Check if the query execution was successful
        if ($execval === false) {
            echo "Error: " . $stmt->error; // Output detailed error message
        } else {
            echo "Update successful";
        }
    
        // Close the prepared statement
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Page</title>
</head>
<body>
    <div class="container">
        <h1>Delivery Information</h1>
        <form method="POST" id="signup">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="signup_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="signup_email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="signup_address" required></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="signup_contact" required>
            </div>
            <div class="form-group">
                <label for="notes">Additional Notes:</label>
                <textarea id="notes" name="signup_note"></textarea>
            </div>
            <center><img src="imgg/pay.jpg" height="500px" alt=""></center>
            <div class="form-group">
                <center><h3>Pay delivery🚚 charges 100 rs per plant🪴</h3></center>
                <label for="utrno">Enter UTR no of payment:</label>
                <input type="text" id="utrno" name="signup_utrno" required>
            </div>
            <button type="submit" name="signup">Submit</button>
        </form>
    </div>

    <script>
        // document.getElementById('signup').addEventListener('submit', function(event) {
        //     event.preventDefault();
        //     // Here you can add code to handle the form submission, such as sending data to a server
        //     alert('Delivery information submitted successfully!');
        //     // For demonstration purposes, let's reset the form
        //     document.getElementById('signup').reset();
        //     var win = window.open("index.html");
        // });
    </script>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url(imgg/ww6);
        background-size: auto;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #c09d9d;
        border-radius: 5px;
        background-color: hsla(185, 12%, 81%, 0.5);
    }

    h1 {
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }

    button:focus {
        outline: none;
    }
</style>
