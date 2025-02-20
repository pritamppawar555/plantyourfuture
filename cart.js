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
      var win=window.open("cartform.php")
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


function process() {
    // Get cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart'));

    // Send selected items to the PHP script using AJAX
    if (cart && cart.length > 0) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle response from the server if needed
                console.log(xhr.responseText);
                // Redirect to payment page or any other action after adding items to the database
                window.location.href = "cartform.php";
            }
        };
        xhr.send("selected_items=" + JSON.stringify(cart));
    }
}



// Assume you have JavaScript code that dynamically generates cart items and calculates the total
var cartItems = "Your dynamically generated cart items";
var total = "Your dynamically calculated total";

// Make an AJAX request to send the data to PHP
var xhr = new XMLHttpRequest();
xhr.open("POST", "cart.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText); // You can handle the response here if needed
    }
};
var formData = "cart_items=" + encodeURIComponent(cartItems) + "&total=" + encodeURIComponent(total);
xhr.send(formData);

