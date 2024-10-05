const cartButtons = document.querySelectorAll('.cart.button');
const cartContainer = document.getElementById('cart-container');

// Function to check if user is logged in
function isLoggedIn() {
  // For demonstration purposes, assume user is not logged in
  return false;
}

// Function to display login and signup message
function displayLoginSignupMessage() {
  const message = 'You must login or signup to add to cart';
  alert(message);
  // Display login and signup buttons
  const loginButton = document.getElementById('login-button');
  const signupButton = document.getElementById('signup-button');
  loginButton.style.display = 'block';
  signupButton.style.display = 'block';
}

// Add event listener to add to cart button
document.getElementById('add-to-cart').addEventListener('click', (event) => {
  event.preventDefault(); // Prevent the default link behavior

  if (!isLoggedIn()) {
    displayLoginSignupMessage();
    return;
  }

  // Add item to cart functionality
  // ...
});
// Add an event listener to each cart button
cartButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent the default link behavior

    // Get the product details from the product card
    const productCard = button.closest('.product-card');
    const productId = productCard.id; // Get the product ID from the HTML
    const productTitle = productCard.querySelector('.title').textContent;
    const productPrice = productCard.querySelector('.price').textContent;
    const productImage = productCard.querySelector('img').src; // Get the product image URL

    // Check if the item already exists in the cart
    const existingCartItem = cartContainer.querySelector(`[data-id="${productId}"]`);
    if (!existingCartItem) {
      // Create a new cart item object
      const cartItem = {
        id: productId, // Use the product ID as the unique ID
        title: productTitle,
        price: productPrice,
        image: productImage // Include the image URL
      };

      // Add the cart item to the cart
      addCartItemToCart(cartItem);
    } else {
      alert("Item already exists in the cart!");
    }
  });
});

// Function to add a cart item to the cart
function addCartItemToCart(cartItem) {
  // Create a new cart item element
  const cartItemElement = document.createElement('div');
  cartItemElement.classList.add('cart-item');
  cartItemElement.dataset.id = cartItem.id; // Store the unique ID
  cartItemElement.innerHTML = `
    <div class="cart-item-image">
      <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    </div>
    <div class="cart-item-details">
      <h3 style="color:black;">${cartItem.title}</h3>
      <p style="color:skyblue;text-size:8px">${cartItem.price}</p>
    </div>
    <div class="cart-item-actions">
      <button class="btn btn-danger btn-sm remove-from-cart">Remove from cart</button>
      <button class="btn btn-primary btn-sm add-to-wishlist"><i class="fas fa-heart"></i> Add to wishlist</button>
      <button class="btn btn-success btn-sm make-payment">Make Payment</button>
    </div>
  `;

  // Add the cart item element to the cart container
  cartContainer.appendChild(cartItemElement);

  // Update the width of the cart container
  updateCartContainerWidth();

  // Add an event listener to the remove from cart button
  const removeFromCartButton = cartItemElement.querySelector('.remove-from-cart');
  removeFromCartButton.addEventListener('click', () => {
    // Remove the cart item from the cart
    cartItemElement.remove();

    // Update the width of the cart container
    updateCartContainerWidth();
  });

  // Add an event listener to the add to wishlist button
  const addToWishlistButton = cartItemElement.querySelector('.add-to-wishlist');
  addToWishlistButton.addEventListener('click', () => {
    // Add the cart item to the wishlist
    addCartItemToWishlist(cartItem);
  });

  // Add an event listener to the make payment button
  const makePaymentButton = cartItemElement.querySelector('.make-payment');
  makePaymentButton.addEventListener('click', () => {
    // Make payment for the cart item
    makePayment(cartItem);
  });
}

// Function to update the width of the cart container
function updateCartContainerWidth() {
  const cartItems = cartContainer.children;
  const itemWidth = cartItems[0].offsetWidth; // Get the width of a single item
  const containerWidth = cartItems.length * itemWidth;
  cartContainer.style.width = `${containerWidth}px`;
}

// Function to add a cart item to the wishlist
function addCartItemToWishlist(cartItem) {
  // Add the cart item to the wishlist logic here
  console.log(`Added ${cartItem.title} to wishlist`);
}
function addCartItemToWishlist(cartItem) {
  // Get the wishlist container
  const wishlistContainer = document.getElementById('wishlist-container');

  // Create a new wishlist item element
  const wishlistItemElement = document.createElement('div');
  wishlistItemElement.classList.add('wishlist-item');
  wishlistItemElement.dataset.id = cartItem.id; // Store the unique ID
  wishlistItemElement.innerHTML = `
    <div class="wishlist-item-image">
      <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    </div>
    <div class="wishlist-item-details">
      <h3 style="color:black;">${cartItem.title}</h3>
      <p style="color:skyblue;text-size:8px">${cartItem.price}</p>
    </div>
    <div class="wishlist-item-actions">
      <button class="btn btn-danger btn-sm remove-from-wishlist">Remove from wishlist</button>
      <button class="btn btn-primary btn-sm add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</button>
    </div>
  `;

  // Add the wishlist item element to the wishlist container
  wishlistContainer.appendChild(wishlistItemElement);

  // Add an event listener to the remove from wishlist button
  const removeFromWishlistButton = wishlistItemElement.querySelector('.remove-from-wishlist');
  removeFromWishlistButton.addEventListener('click', () => {
    // Remove the wishlist item from the wishlist
    wishlistItemElement.remove();
  });

  // Add an event listener to the add to cart button
  const addToCartButton = wishlistItemElement.querySelector('.add-to-cart');
  addToCartButton.addEventListener('click', () => {
    // Add the wishlist item to the cart
    addCartItemToCart(cartItem);
  });
}
// Function to make payment for a cart item
function makePayment(cartItem) {
  console.log('Make payment function called');
  console.log(`Making payment for ${cartItem.title}`);
  
  // Remove the cart item from the cart

  
  // Remove the cart item from the cart
  const cartItemElement = document.querySelector(`.cart-item img[src="${cartItem.image}"]`).closest('.cart-item');
  console.log(cartItemElement); // Check if the element is being selected correctly
  cartItemElement.remove(); // Remove the element from the DOM
  
  // Redirect to payment options page
  window.location.href ='payment.html';
}
``