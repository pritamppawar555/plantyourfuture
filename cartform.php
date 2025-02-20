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

    // Check if the form data is received
    if (isset($_POST['email']) && isset($_POST['page'])) {
        $email = $_POST['email']; // Get the user's email
        $payment_option = $_POST['page']; // Get the selected payment option
        
        // Prepare and execute SQL query to update the user's payment option
        $stmt = $conn->prepare("UPDATE login SET payment_option=? WHERE email=?");
        // Assuming there's a column called payment_option in your login table to store the selected payment option
        
        // Bind parameters
        $stmt->bind_param("ss", $payment_option, $email);
        
        // Execute the update query
        $execval = $stmt->execute();
        
        // Check if the query execution was successful
        if ($execval === false) {
            echo "<script>alert('Error: " . $stmt->error . "');</script>"; // Output detailed error message in JavaScript alert
        } else {
            // Check the selected payment option and show appropriate alert
            if ($payment_option === "Cash on delivery🚚") {
                echo "<script>alert('Cash on delivery selected');</script>";
                        header("Location:cartform1.php");

            } else if ($payment_option === "By UPI QR") {
                echo "<script>alert('By UPI QR selected'); </script>";
                        header("Location:cartform2.php");

            } else if ($payment_option === "By Card"){
                echo "<script>alert('By Card selected');  </script>";
                        header("Location:cartform3.php");
            }  
            }
        
      
        
        // Close the prepared statement
        $stmt->close();
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio Button Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            margin-top: 100px;
        }
        
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        
        h2 {
            color: #333;
            text-align: center;
        }
        
        .radio-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        input[type="radio"] {
            display: none;
        }
        
        input[type="radio"] + label {
            cursor: pointer;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        
        input[type="radio"]:checked + label {
            background-color: #2980b9;
        }

        #email{
            border-color: #2980b9;
            height: 30px;

        }
        
        .btn1 {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 42px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 15px 2px;
            cursor: pointer;
            border-radius: 10px;
      
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="cartform.php" method="POST" id="signup">
            <h2>Choose a payment option:</h2>
            <div class="radio-buttons">
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <input type="radio" id="page1" name="page" value="Cash on delivery🚚">
                <label for="page1">Cash on delivery🚚</label>
                
                <input type="radio" id="page2" name="page" value="By UPI QR">
                <label for="page2">By UPI QR</label>
                
                <input type="radio" id="page3" name="page" value="By Card">
                <label for="page3">By Card</label>
            </div>
            <button type="submit" class="btn1">Submit</button>
        </form>
    </div>
</body>
</html>
