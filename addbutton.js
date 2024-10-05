let isAuthenticated = false;
let username = '';
let password = '';

// Function to handle login
function login(usernameInput, passwordInput) {
  // TO DO: Implement login logic here
  // For demonstration purposes, assume login is successful
  if (usernameInput === 'admin' && passwordInput === 'password') {
    isAuthenticated = true;
    username = usernameInput;
    password = passwordInput;
    return true;
  } else {
    return false;
  }
}

// Function to handle signup
function signup(usernameInput, passwordInput) {
  // TO DO: Implement signup logic here
  // For demonstration purposes, assume signup is successful
  if (usernameInput !== '' && passwordInput !== '') {
    isAuthenticated = true;
    username = usernameInput;
    password = passwordInput;
    return true;
  } else {
    return false;
  }
}

// Function to check if user is authenticated
function isAuthenticatedUser       () {
  return isAuthenticated;
}

const loginBtn = document.getElementById('login-btn');
const registerBtn = document.getElementById('register-btn');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const registerLink = document.getElementById('register-link');
const forgotPasswordLink = document.getElementById('forgot-password');

loginBtn.addEventListener('click', () => {
    loginForm.classList.add('show-login');
    registerForm.classList.remove('show-register');
    loginBtn.classList.add('active');
    registerBtn.classList.remove('active');
});

registerBtn.addEventListener('click', () => {
    registerForm.classList.add('show-register');
    loginForm.classList.remove('show-login');
    registerBtn.classList.add('active');
    loginBtn.classList.remove('active');
});

registerLink.addEventListener('click', () => {
    registerForm.classList.add('show-register');
    loginForm.classList.remove('show-login');
    registerBtn.classList.add('active');
    loginBtn.classList.remove('active');
});

forgotPasswordLink.addEventListener('click', () => {
    // Add functionality for forgot password link
    alert('Forgot password functionality not implemented yet!');
});

function login() {
  const usernameInput = document.getElementById('username').value;
  const passwordInput = document.getElementById('password').value;
  if (login(usernameInput, passwordInput)) {
    window.location.href = 'index.html';
  } else {
    alert('Invalid username or password');
  }
}

function signup() {
  const usernameInput = document.getElementById('username').value;
  const passwordInput = document.getElementById('password').value;
  if (signup(usernameInput, passwordInput)) {
    window.location.href = 'index.html';
  } else {
    alert('Invalid username or password');
  }
}
const cartButtons = document.querySelectorAll('.cart.button');
const cartContainer = document.getElementById('cart-container');

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