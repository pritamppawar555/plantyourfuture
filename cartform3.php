<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "plant_your_future";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO card (name, cardname, cardnumber, expmonth, expyear, cvv) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $cardname, $cardnumber, $expmonth, $expyear, $cvv);

    $name = $_POST['name'];
    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expmonth = $_POST['expmonth'];
    $expyear = $_POST['expyear'];
    $cvv = $_POST['cvv'];

    if ($stmt->execute()) {
        echo "<script>alert('Payment details added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding payment details: " . $stmt->error . "');</script>";
    }

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
  
      <center><h2>Accepted Cards</h2></center>
      <label  for="fname">Accepted Cards</label>
      <div class="icon-container">
        <i class="fa fa-cc-visa" style="color:navy;"></i>
        <i class="fa fa-cc-amex" style="color:blue;"></i>
        <i class="fa fa-cc-mastercard" style="color:red;"></i>
        <i class="fa fa-cc-discover" style="color:orange;"></i>
      </div>
    <form method="post">
      <label for="cname">Name</label>
      <input type="text" id="cname" name="name" placeholder="">
      <label for="cname">Name on Card</label>
      <input type="text" id="cname" name="cardname" placeholder="John More Doe">
      <label for="ccnum">Credit card number</label>
      <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
      <label for="expmonth">Exp Month</label>
      <input type="text" id="expmonth" name="expmonth" placeholder="September">

      <div class="row">
        <div class="col-50">
          <label for="expyear">Exp Year</label>
          <input type="text" id="expyear" name="expyear" placeholder="2018">
        </div>
        <div class="col-50">
          <label for="cvv">CVV</label>
          <input type="text" id="cvv" name="cvv" placeholder="352">
        </div>
      </div>
    </div>

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
 

}

 function displayCart(){
      var win=window.open("cart.php")
}
 

</script>
<button class="btn1"onclick="handleButtonClick()">Go back...</button>
        <script>
            function handleButtonClick() {
                window.location.href='cartform.php'
            
            }
          </script>
      
</body>
</html>