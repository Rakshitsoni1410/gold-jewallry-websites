document.addEventListener('DOMContentLoaded', function () {
  // Get all the wishlist and cart buttons
  const wishlistButtons = document.querySelectorAll('.wish-button');
  const cartButtons = document.querySelectorAll('.cart-button');
  const wishlistContainer = document.getElementById('wishlist-container');
  const cartContainer = document.getElementById('cart-container');
  const paymentButton = document.getElementById('payment-button'); // Payment Button

  // Function to check if user is logged in
  function isLoggedIn() {
    // For demonstration purposes, assume user is not logged in
    return false;
  }

  // Function to display login and signup message
  function displayLoginSignupMessage() {
    const message = 'You must login or signup to perform this action';
    alert(message);
    const loginButton = document.getElementById('login-button');
    const signupButton = document.getElementById('signup-button');
    loginButton.style.display = 'block';
    signupButton.style.display = 'block';
  }

  // Add event listener to wishlist buttons
  wishlistButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default behavior

      if (!isLoggedIn()) {
        displayLoginSignupMessage();
        return;
      }

      // Get the product details from the product card
      const productCard = button.closest('.product-card');
      const productId = productCard.id;
      const productTitle = productCard.querySelector('.title').textContent;
      const productPrice = productCard.querySelector('.price').textContent;
      const productImage = productCard.querySelector('img').src;

      // Check if the item already exists in the wishlist
      const existingWishlistItem = wishlistContainer.querySelector(`[data-id="${productId}"]`);
      if (!existingWishlistItem) {
        const wishlistItem = {
          id: productId,
          title: productTitle,
          price: productPrice,
          image: productImage
        };
        addWishlistItemToWishlist(wishlistItem);
      } else {
        alert('Item already exists in the wishlist!');
      }
    });
  });

  // Add event listener to cart buttons
  cartButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default behavior

      if (!isLoggedIn()) {
        displayLoginSignupMessage();
        return;
      }

      // Get the product details from the product card
      const productCard = button.closest('.product-card');
      const productId = productCard.id;
      const productTitle = productCard.querySelector('.title').textContent;
      const productPrice = productCard.querySelector('.price').textContent;
      const productImage = productCard.querySelector('img').src;

      // Check if the item already exists in the cart
      const existingCartItem = cartContainer.querySelector(`[data-id="${productId}"]`);
      if (!existingCartItem) {
        const cartItem = {
          id: productId,
          title: productTitle,
          price: productPrice,
          image: productImage
        };
        addCartItemToCart(cartItem);
      } else {
        alert('Item already exists in the cart!');
      }
    });
  });

  // Function to add a wishlist item to the wishlist
  function addWishlistItemToWishlist(wishlistItem) {
    const wishlistItemElement = document.createElement('div');
    wishlistItemElement.classList.add('wishlist-item');
    wishlistItemElement.dataset.id = wishlistItem.id;
    wishlistItemElement.innerHTML = `
      <div class="wishlist-item-image">
        <img src="${wishlistItem.image}" alt="${wishlistItem.title}" style="width: 100px; height: auto;">
      </div>
      <div class="wishlist-item-details">
        <h3 style="color:black;">${wishlistItem.title}</h3>
        <p style="color:skyblue; font-size: 8px;">${wishlistItem.price}</p>
      </div>
      <div class="wishlist-item-actions">
        <button class="btn btn-danger btn-sm remove-from-wishlist">Remove from wishlist</button>
        <button class="btn btn-primary btn-sm add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</button>
      </div>
    `;
    wishlistContainer.appendChild(wishlistItemElement);

    updateWishlistContainerWidth();

    // Add remove and add-to-cart event listeners
    wishlistItemElement.querySelector('.remove-from-wishlist').addEventListener('click', () => {
      wishlistItemElement.remove();
      updateWishlistContainerWidth();
    });

    wishlistItemElement.querySelector('.add-to-cart').addEventListener('click', () => {
      addCartItemToCart(wishlistItem);
      wishlistItemElement.remove(); // Optionally remove the item from wishlist after adding to cart
      updateWishlistContainerWidth();
    });
  }

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
      </div>
    `;
    cartContainer.appendChild(cartItemElement);

    updateCartContainerWidth();

    // Show the payment button when there are items in the cart
    paymentButton.style.display = 'block';

    cartItemElement.querySelector('.remove-from-cart').addEventListener('click', () => {
      cartItemElement.remove();
      updateCartContainerWidth();

      // Hide the payment button if the cart is empty
      if (cartContainer.children.length === 0) {
        paymentButton.style.display = 'none';
      }
    });
  }

  // Function to handle payment button click
  paymentButton.addEventListener('click', () => {
    if (cartContainer.children.length === 0) {
      alert('Your cart is empty!');
    } else {
      alert('Proceeding to payment... (Simulated)');
      // Implement actual payment logic here
    }
  });

  // Function to update the width of the wishlist container
  function updateWishlistContainerWidth() {
    const wishlistItems = wishlistContainer.children;
    const itemWidth = wishlistItems[0]?.offsetWidth || 0;
    const containerWidth = wishlistItems.length * itemWidth;
    wishlistContainer.style.width = `${containerWidth}px`;
  }

  // Function to update the width of the cart container
  function updateCartContainerWidth() {
    const cartItems = cartContainer.children;
    const itemWidth = cartItems[0]?.offsetWidth || 0;
    const containerWidth = cartItems.length * itemWidth;
    cartContainer.style.width = `${containerWidth}px`;
  }
});
