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
    $stmt = $conn->prepare("INSERT INTO upi (name, utr) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $utr);

    // Set parameters and execute
    $name = $_POST['name'];
    $utr = $_POST['utr'];
    $stmt->execute();

    // Check if the query execution was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Payment details added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding payment details. Please try again later.');</script>";
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
      <style>
            #zip{
                  font="50px";


            }
      </style>
</head>
<body>

      <div class="col-50">
            <h3>Payment</h3>
         <center>
            <h2>Accepted UPI</h2>
            <center><img src="imgg/pay.jpg"height="500px" alt=""></center>
            <form method="post">
            <div class="col-50">
                  <label for="zip"><h3>Enter payment UTR no after payment:</h3></label>
                  <input type= "text" id=zip name="name" placeholder="name is...." hight="60px">
                  <input type= "text" id=zip name="adderss" placeholder="address is...." hight="60px">    
                  <input type="text" id="zip" name="utr" placeholder="UTR no is...."height="60px">

                </div>
         </center>
         <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label>
          <input type="submit" value="Continue to checkout" class="btn" onclick="processPayment() ">
        </form>
      </div>
    </div>
<script>
function processPayment() {
      localStorage.removeItem('cart');
      alert('Payment successful! Cart cleared.');
       // Refresh cart display
       displayCart();



       function displayCart(){
            var win=window.open("cart.php")
      }
   }
   
   
</script>
<button class="btn1"onclick="handleButtonClick()">Go back...</button>
        <script>
            function handleButtonClick() {
                window.location.href='cartform.html'
            
            }
          </script>
</body>
</html>