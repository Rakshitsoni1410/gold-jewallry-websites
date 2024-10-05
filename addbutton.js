const cartButtons = document.querySelectorAll('.cart-button'); // Fix button selector
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
  
  const loginButton = document.getElementById('login-button');
  const signupButton = document.getElementById('signup-button');
  
  if (loginButton && signupButton) {
    loginButton.style.display = 'block';
    signupButton.style.display = 'block';
  } else {
    console.warn('Login or signup button not found!');
  }
}

// Add event listener to add to cart button
document.getElementById('add-to-cart')?.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent the default link behavior

  if (!isLoggedIn()) {
    displayLoginSignupMessage();
    return;
  }

  // Add item to cart functionality
  // ...
});

// Add event listeners to each cart button
cartButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default behavior

    const productCard = button.closest('.product-card');
    if (productCard) {
      const productId = productCard.id; 
      const productTitle = productCard.querySelector('.title')?.textContent;
      const productPrice = productCard.querySelector('.price')?.textContent;
      const productImage = productCard.querySelector('img')?.src;

      if (!productId || !productTitle || !productPrice || !productImage) {
        console.error('Product details missing!');
        return;
      }

      const existingCartItem = cartContainer.querySelector(`[data-id="${productId}"]`);
      if (!existingCartItem) {
        const cartItem = { id: productId, title: productTitle, price: productPrice, image: productImage };
        addCartItemToCart(cartItem);
      } else {
        alert("Item already exists in the cart!");
      }
    }
  });
});

// Function to add a cart item to the cart
function addCartItemToCart(cartItem) {
  const cartItemElement = document.createElement('div');
  cartItemElement.classList.add('cart-item');
  cartItemElement.dataset.id = cartItem.id;

  cartItemElement.innerHTML = `
    <div class="cart-item-image">
      <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    </div>
    <div class="cart-item-details">
      <h3 style="color:black;">${cartItem.title}</h3>
      <p style="color:skyblue; font-size: 8px;">${cartItem.price}</p>
    </div>
    <div class="cart-item-actions">
      <button class="btn btn-danger btn-sm remove-from-cart">Remove from cart</button>
      <button class="btn btn-primary btn-sm add-to-wishlist"><i class="fas fa-heart"></i> Add to wishlist</button>
      <button class="btn btn-success btn-sm make-payment">Make Payment</button>
    </div>
  `;

  cartContainer.appendChild(cartItemElement);
  updateCartContainerWidth();

  // Remove from cart event
  cartItemElement.querySelector('.remove-from-cart').addEventListener('click', () => {
    cartItemElement.remove();
    updateCartContainerWidth();
  });

  // Add to wishlist event
  cartItemElement.querySelector('.add-to-wishlist').addEventListener('click', () => {
    addCartItemToWishlist(cartItem);
  });

  // Make payment event
  cartItemElement.querySelector('.make-payment').addEventListener('click', () => {
    makePayment(cartItem);
  });
}

// Function to update cart container width
function updateCartContainerWidth() {
  const cartItems = cartContainer.children;
  const itemWidth = cartItems[0]?.offsetWidth || 0; // Check if there's at least one item
  cartContainer.style.width = `${cartItems.length * itemWidth}px`;
}

// Function to add item to wishlist
function addCartItemToWishlist(cartItem) {
  const wishlistContainer = document.getElementById('wishlist-container');

  const wishlistItemElement = document.createElement('div');
  wishlistItemElement.classList.add('wishlist-item');
  wishlistItemElement.dataset.id = cartItem.id;

  wishlistItemElement.innerHTML = `
    <div class="wishlist-item-image">
      <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    </div>
    <div class="wishlist-item-details">
      <h3 style="color:black;">${cartItem.title}</h3>
      <p style="color:skyblue; font-size: 8px;">${cartItem.price}</p>
    </div>
    <div class="wishlist-item-actions">
      <button class="btn btn-danger btn-sm remove-from-wishlist">Remove from wishlist</button>
      <button class="btn btn-primary btn-sm add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</button>
    </div>
  `;

  wishlistContainer.appendChild(wishlistItemElement);

  wishlistItemElement.querySelector('.remove-from-wishlist').addEventListener('click', () => {
    wishlistItemElement.remove();
  });

  wishlistItemElement.querySelector('.add-to-cart').addEventListener('click', () => {
    addCartItemToCart(cartItem);
  });
}

// Function to make payment
function makePayment(cartItem) {
  console.log('Making payment for', cartItem.title);
  
  const cartItemElement = document.querySelector(`.cart-item img[src="${cartItem.image}"]`)?.closest('.cart-item');
  if (cartItemElement) {
    cartItemElement.remove();
  }

  // Redirect to payment page
  window.location.href = 'payment.html';
}
