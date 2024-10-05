
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
function isAuthenticatedUser() {
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
// Get all the wishlist buttons
const wishlistButtons = document.querySelectorAll('.wish.button');
const wishlistContainer = document.getElementById('wishlist-container');

// Add an event listener to each wishlist button
wishlistButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent the default link behavior

    // Get the product details from the product card
    const productCard = button.closest('.product-card');
    const productId = productCard.id; // Get the product ID from the HTML
    const productTitle = productCard.querySelector('.title').textContent;
    const productPrice = productCard.querySelector('.price').textContent;
    const productImage = productCard.querySelector('img').src; // Get the product image URL

    // Check if the item already exists in the wishlist
    const existingWishlistItem = wishlistContainer.querySelector(`[data-id="${productId}"]`);
    if (!existingWishlistItem) {
      // Create a new wishlist item object
      const wishlistItem = {
        id: productId, // Use the product ID as the unique ID
        title: productTitle,
        price: productPrice,
        image: productImage // Include the image URL
      };

      // Add the wishlist item to the wishlist
      addWishlistItemToWishlist(wishlistItem);
    } else {
      alert("Item already exists in the wishlist!");
    }
  });
});

// Function to add a wishlist item to the wishlist
function addWishlistItemToWishlist(wishlistItem) {
  // Create a new wishlist item element
  const wishlistItemElement = document.createElement('div');
  wishlistItemElement.classList.add('wishlist-item');
  wishlistItemElement.dataset.id = wishlistItem.id; // Store the unique ID
  wishlistItemElement.innerHTML = `
    <div class="wishlist-item-image">
      <img src="${wishlistItem.image}" alt="${wishlistItem.title}" style="width: 100px; height: auto;">
    </div>
    <div class="wishlist-item-details">
      <h3 style="color:black;">${wishlistItem.title}</h3>
      <p style="color:skyblue;text-size:8px">${wishlistItem.price}</p>
    </div>
    <div class="wishlist-item-actions">
      <button class="btn btn-danger btn-sm remove-from-wishlist">Remove from wishlist</button>
      <button class="btn btn-primary btn-sm add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</button>
    </div>
  `;

  // Add the wishlist item element to the wishlist container
  wishlistContainer.appendChild(wishlistItemElement);

  // Update the width of the wishlist container
  updateWishlistContainerWidth();

  // Add an event listener to the remove from wishlist button
  const removeFromWishlistButton = wishlistItemElement.querySelector('.remove-from-wishlist');
  removeFromWishlistButton.addEventListener('click', () => {
    // Remove the wishlist item from the wishlist
    wishlistItemElement.remove();

    // Update the width of the wishlist container
    updateWishlistContainerWidth();
  });

  // Add an event listener to the add to cart button
  const addToCartButton = wishlistItemElement.querySelector('.add-to-cart');
  addToCartButton.addEventListener('click', () => {
    // Add the wishlist item to the cart
    addCartItemToCart(wishlistItem);
  });
}

// Function to update the width of the wishlist container
function updateWishlistContainerWidth() {
  const wishlistItems = wishlistContainer.children;
  const itemWidth = wishlistItems[0].offsetWidth; // Get the width of a single item
  const containerWidth = wishlistItems.length * itemWidth;
  wishlistContainer.style.width = `${containerWidth}px`;
}

// Function to add a wishlist item to the cart
function addCartItemToCart(wishlistItem) {
  // Add the wishlist item to the cart logic here
  console.log(`Added ${wishlistItem.title} to cart`);
}