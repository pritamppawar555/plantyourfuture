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
    die("Connection failed:" . $conn->connect_error);
}

// Insert cart item into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Assuming this is the username of the user
    $productName = $_POST['item_name'];
    $price = $_POST['price'];
    // Insert into cart_items table
    $sql = "INSERT INTO cart_items (username, item_name, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $username, $productName, $price);
    if ($stmt->execute()) {
        echo "Item added to cart successfully";
        // Redirect after successful insertion
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
}
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart | E-COMMERCE WEBSITE BY EDYODA</title>
    <link rel="stylesheet" href="css/cart.css">
    <!-- favicon -->
    <link rel="icon" href="https://yt3.ggpht.com/a/AGF-l78km1YyNXmF0r3-0CycCA0HLA_i6zYn_8NZEg=s900-c-k-c0xffffffff-no-rj-mo" type="image/gif" sizes="16x16">
    <!-- header links -->
    <script src="https://kit.fontawesome.com/4a3b1f73a2.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
    <!-- HEADER -->
    <div id="headerContainer"></div>
    <script>
        load("header.html", "headerContainer");
        function load(url, elementId) {
            var req = new XMLHttpRequest();
            req.open("GET", url, true);
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById(elementId).innerHTML = req.responseText;
                }
            };
            req.send();
        }
    </script>

    <!-- CART CONTAINER -->
    <div id="cartMainContainer">
        <h1>Checkout</h1>

        <div class="cart-container">
            <h1>Shopping Cart</h1>
            <div class="selected-items" id="cartItems">
                <!-- Selected items will be displayed here -->

                <style>
                    #selected-item{
                        font-size: 60px;
                        color: rgb(206, 131, 34);
                    }
                    #cartItems{
                        font-size: 40px;
                        color: antiquewhite;
                    }
                   
              
                </style>
   
<body>

<button class="btn"onclick="handleButtonClick()">Go back to home page...</button>
<script>
    function handleButtonClick() {
        window.location.href='index.html'
    
    }
  </script>
  <center>
    <form method="post">

    <div id="cart" name="item_name"value="cart"></div>
    <div id="total"name="price"value="total"></div>
    

    </form>
   
</center>



</body>


            </div>
        </div>
    </div>



    <!-- FOOTER -->
    <div id="footerContainer"></div>
    <script>
        load("footer.html", "footerContainer");
    </script>

    <!-- JavaScript for cart functionality -->
    
    
    
    
    
    
    
    
    <script>

        // cart.js

// Function to calculate total amount
function calculateTotal() {
    // Get cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart'));

    // Initialize total amount
    let total = 0;

    if (cart && cart.length > 0) {
        cart.forEach(item => {
            total += parseFloat(item.price); // Convert price to number and add to total
        });
    }

    return total;
}

// Function to display cart items and total amount
function displayCart() {
    // Get cart container element
    let cartContainer = document.getElementById('cart');

    // Clear existing content
    cartContainer.innerHTML = '';

    // Get total amount
    let total = calculateTotal();

   
    if (total > 0) {
        // Display items
        let cartItems = document.createElement('div');
        cartItems.textContent = 'Cart Items:';
        cartContainer.appendChild(cartItems);

        // Get cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart'));
        cart.forEach(item => {
            let itemElement = document.createElement('div');
            itemElement.textContent = item.name + ' - ' + item.price;
            cartContainer.appendChild(itemElement);
        });

        // Display total amount
        let totalElement = document.createElement('div');
        totalElement.textContent = 'Total Amount: RS ' + total.toFixed(2); // Format total amount
        cartContainer.appendChild(totalElement);

        // Display payment button
        let paymentButton = document.createElement('button');
        paymentButton.textContent = 'Proceed to Payment';
        paymentButton.addEventListener('click', process);
        cartContainer.appendChild(paymentButton);
    } else {
        // If cart is empty, display a message
        cartContainer.textContent = 'Cart is empty';
    }
}
function process(){
      var win=window.open("cardlogin.php")
}


function processPayment() {
   localStorage.removeItem('cart');
   alert('Payment successful! Cart cleared.');
    // Refresh cart display
    displayCart();
}

// Call displayCart function when the page loads
document.addEventListener('DOMContentLoaded', function () {
    displayCart();
});




// Function to handle form submission and add item to cart
function handleFormSubmission(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get form data
    let username = document.getElementById('text').value;
    let productName = document.getElementById('productName').value; // Assuming you have an input field with id 'productName'
    let price = parseFloat(document.getElementById('price').value); // Assuming you have an input field with id 'price'

    // Perform form validation if needed

    // Create an object representing the item
    let item = {
        name: productName,
        price: price
    };

    // Add item to the cart in localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(item);
    localStorage.setItem('cart', JSON.stringify(cart));

    // Display alert
    window.alert('Item added to cart successfully!');

    // Optionally, redirect the user to a different page or update the cart display
    // For example:
    // window.location.href = 'cart.html';
    // displayCart(); // Assuming you have a function to update the cart display
}

// Add event listener to the form for form submission
document.getElementById('cartForm').addEventListener('submit', handleFormSubmission);


    </script>
</body>
</html>
