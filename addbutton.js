// Function to check if the user is logged in
function isLoggedIn() {
  // Perform an AJAX request to check session status
  return fetch('login.php')
    .then(response => response.json())
    .then(data => {
      return data.loggedIn; // This will return true or false
    });
}


// Function to display login/signup prompt
function displayLoginSignupMessage() {
  alert('You must log in or sign up to add items to the cart or wishlist.');
  // Optionally, redirect the user to login/signup page
  window.location.href = 'login.html'; // Modify this with your actual login/signup page
}

// Add event listeners to all "Add to Cart" buttons
const cartButtons = document.querySelectorAll('.cart.button');

cartButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    event.preventDefault();

    // Check if the user is logged in
    if (!isLoggedIn()) {
      displayLoginSignupMessage();
      return;
    }

    // Get product details from the product card
    const productCard = button.closest('.product-card');
    const productId = productCard.id; // Unique product ID
    const productTitle = productCard.querySelector('.title').textContent;
    const productPrice = productCard.querySelector('.price').textContent;
    const productImage = productCard.querySelector('img').src;

    // Check if the item is already in the cart
    const cartContainer = document.getElementById('cart-container');
    const existingCartItem = cartContainer.querySelector(`[data-id="${productId}"]`);

    if (existingCartItem) {
      alert('This item is already in your cart!');
      return;
    }

    // Create a new cart item object
    const cartItem = {
      id: productId, // Store the product ID to check uniqueness
      title: productTitle,
      price: productPrice,
      image: productImage
    };

    // Add the cart item to the cart
    addCartItemToCart(cartItem);
  });
});

// Function to add a cart item to the cart
function addCartItemToCart(cartItem) {
  const cartContainer = document.getElementById('cart-container');

  const cartItemElement = document.createElement('div');
  cartItemElement.classList.add('cart-item');
  cartItemElement.dataset.id = cartItem.id; // Add product ID for uniqueness check
  cartItemElement.innerHTML = `
    <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    <h3 style="color:black;">${cartItem.title}</h3>
    <p style="color:skyblue;text-size:8px">${cartItem.price}</p>
    <button class="btn btn-danger btn-sm remove-from-cart">Remove from cart</button>
    <button class="btn btn-primary btn-sm add-to-wishlist"><i class="fas fa-heart"></i> Add to wishlist</button>
    <button class="btn btn-success btn-sm make-payment">Make Payment</button>
  `;

  cartContainer.appendChild(cartItemElement);

  // Add event listener to remove from cart button
  cartItemElement.querySelector('.remove-from-cart').addEventListener('click', () => {
    cartItemElement.remove();
  });

  // Add event listener to add to wishlist button
  cartItemElement.querySelector('.add-to-wishlist').addEventListener('click', () => {
    addCartItemToWishlist(cartItem);
  });

  // Add event listener to make payment button
  cartItemElement.querySelector('.make-payment').addEventListener('click', () => {
    makePayment(cartItem);
  });
}

// Function to add a cart item to the wishlist
function addCartItemToWishlist(cartItem) {
  const wishlistContainer = document.getElementById('wishlist-container');

  const existingWishlistItem = wishlistContainer.querySelector(`[data-id="${cartItem.id}"]`);

  if (existingWishlistItem) {
    alert('This item is already in your wishlist!');
    return;
  }

  const wishlistItemElement = document.createElement('div');
  wishlistItemElement.classList.add('wishlist-item');
  wishlistItemElement.dataset.id = cartItem.id; // Add product ID for uniqueness check
  wishlistItemElement.innerHTML = `
    <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    <h3 style="color:black;">${cartItem.title}</h3>
    <p style="color:skyblue;text-size:8px">${cartItem.price}</p>
    <button class="btn btn-danger btn-sm remove-from-wishlist">Remove from wishlist</button>
    <button class="btn btn-primary btn-sm add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</button>
  `;

  wishlistContainer.appendChild(wishlistItemElement);

  // Add event listener to remove from wishlist button
  wishlistItemElement.querySelector('.remove-from-wishlist').addEventListener('click', () => {
    wishlistItemElement.remove();
  });

  // Add event listener to add to cart button
  wishlistItemElement.querySelector('.add-to-cart').addEventListener('click', () => {
    addCartItemToCart(cartItem);
  });
}

// Function to make payment
function makePayment(cartItem) {
  console.log(`Making payment for ${cartItem.title}`);
  
  // Remove the cart item after payment
  const cartItemElement = document.querySelector(`.cart-item[data-id="${cartItem.id}"]`);
  if (cartItemElement) {
    cartItemElement.remove();
  }

  // Redirect to payment page
  window.location.href = 'payment.html';
}
