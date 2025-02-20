<?php
include("session.php");
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    


    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming no password is set for the root user
    $database = "plant_your_future"; // Name of the database

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO login (firstName, lastName, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $password);
    $execval = $stmt->execute();

    // Check if query execution was successful
    if ($execval === false) {
        echo "Error: " . $conn->error;
    } else {
        echo "Registration successful";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>