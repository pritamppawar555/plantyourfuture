
if (window.innerWidth <= 768) {
  document.querySelector('meta[name="viewport"]').setAttribute('content', 'width=1024, initial-scale=1.0, user-scalable=no');
}


// content.js

// Function to add item to cart
function addToCart(name, price) {
  // Get cart from localStorage or initialize an empty array if it doesn't exist
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  // Push item to cart array
  cart.push({ name, price });

  // Save cart back to localStorage
  localStorage.setItem('cart', JSON.stringify(cart));

  // Display alert or update UI to indicate item added to cart
  alert("Item added to cart!");

  // Update total amount
  updateTotal();
}

// Function to update total amount
function updateTotal() {
  // Get cart from localStorage
  let cart = JSON.parse(localStorage.getItem('cart'));

  // Initialize total variable
  let total = 0;

  // Calculate total amount
  if (cart) {
      cart.forEach(item => {
          total += item.price;
      });
  }

  // Display total amount
  document.getElementById('total').textContent = 'Total Amount: Rs. ' + total;
}

