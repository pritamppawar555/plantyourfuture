<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

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

// Retrieve user data from the database
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT * FROM login WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user data exists
if ($result->num_rows > 0) {
    // Fetch user data
    $user_data = $result->fetch_assoc();
} else {
    // Handle case where user data is not found
    echo "User data not found";
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:powderblue;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
        }

        h1 {
            text-align: center;
        }

        img{
            width: 600px;
            border-collapse: collapse;

        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
       
    </style>
</head>

<center><img src="imgg/logo.jpg" > </center>
       
<body>
<div class="container">
    <h1>User Profile</h1>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>First Name</td>
            <td><?php echo $user_data['firstname']; ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?php echo $user_data['lastname']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $user_data['email']; ?></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><?php echo $user_data['phone']; ?></td>
        </tr>
        <tr>
            <td>password</td>
            <td><?php echo $user_data['password']; ?></td>
        </tr>
    </table>
    <p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>
