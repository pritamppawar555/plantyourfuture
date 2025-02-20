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

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO cash_on_delivery (firstname, email, address, city, state, zip) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $email, $address, $city, $state, $zip);

    // Set parameters and execute
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $stmt->execute();

    // Check if the query execution was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Order placed successfully!');</script>";
    } else {
        echo "<script>alert('Error placing order. Please try again later.');</script>";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="css/cartform.css">
</head>
<body>

      <div class="col-75">
            <div class="container">
              <form method="post"> <!-- Updated action attribute -->
        
                <div class="row">
                  <div class="col-50">
                    <h3>Billing Address</h3>
                    <center><h2 >Accepted Cash on delivery🚚</h2></center>
                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com">
                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                    <label for="city"><i class="fa fa-institution"></i> City</label>
                    <input type="text" id="city" name="city" placeholder="New York">
        
                    <div class="row">
                      <div class="col-50">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="NY">
                      </div>
                      <div class="col-50">
                        <label for="zip">Zip</label>
                        <input type="text" id="zip" name="zip" placeholder="10001">
                      </div>
                    </div>
                  </div>
                  <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                      </label>
                      <input type="submit" value="Continue to checkout" class="btn" onclick="processPayment()">
                    </form>
                  </div>
                </div>
        <script>
          function displayCart(){
            var win=window.open("cart.php")
           }
            function processPayment() {
                  localStorage.removeItem('cart');
                  alert('Payment successful! Cart cleared.');
                   // Refresh cart display
                   displayCart("cart.php");
               }

        </script>
        <button class="btn1" onclick="handleButtonClick()">Go back...</button>
        <script>
            function handleButtonClick() {
                window.location.href='cartform.php';
            }
        </script>
</body>
</html>
