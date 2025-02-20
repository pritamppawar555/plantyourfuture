<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "plant_your_future"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to insert data into the care table
    $stmt = $conn->prepare("INSERT INTO care (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
    $stmt->execute();

    // Check if data insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Message sent successfully!";
    } else {
        echo "Error: Message could not be sent.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>