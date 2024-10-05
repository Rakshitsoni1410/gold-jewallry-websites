document.addEventListener('DOMContentLoaded', function () {

  // Function to check if user is logged in
  function isLoggedIn() {
    // Check if user is logged in (you can customize this with your login logic)
    return localStorage.getItem('loggedIn') === 'true';
  }

  // Function to display login and signup message
  function displayLoginSignupMessage() {
    const message = 'You must login or signup to add to cart';
    alert(message);
    // Display login and signup buttons (assumes buttons exist in the DOM)
    const loginButton = document.getElementById('login-button');
    const signupButton = document.getElementById('signup-button');
    if (loginButton) loginButton.style.display = 'block';
    if (signupButton) signupButton.style.display = 'block';
  }

  // Add event listener to "Add to Cart" buttons
  const cartButtons = document.querySelectorAll('.cart-button');
  cartButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default behavior

      if (!isLoggedIn()) {
        displayLoginSignupMessage();
        return;
      }

      // Get the product details from the product card
      const productCard = button.closest('.product-card');
      const productId = productCard.id; // Assuming product ID is the element's ID
      const productTitle = productCard.querySelector('.title').textContent;
      const productPrice = productCard.querySelector('.price').textContent;
      const productImage = productCard.querySelector('img').src; // Get the product image URL

      // Check if the item already exists in the cart
      const cartContainer = document.getElementById('cart-container');
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
    const cartContainer = document.getElementById('cart-container');

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

    // Add event listener to the remove from cart button
    const removeFromCartButton = cartItemElement.querySelector('.remove-from-cart');
    removeFromCartButton.addEventListener('click', () => {
      cartItemElement.remove();
      updateCartContainerWidth();
    });

    // Add event listener to add to wishlist button
    const addToWishlistButton = cartItemElement.querySelector('.add-to-wishlist');
    addToWishlistButton.addEventListener('click', () => {
      addCartItemToWishlist(cartItem);
    });

    // Add event listener to make payment button
    const makePaymentButton = cartItemElement.querySelector('.make-payment');
    makePaymentButton.addEventListener('click', () => {
      makePayment(cartItem);
    });

    updateCartContainerWidth();
  }

  // Function to update the width of the cart container
  function updateCartContainerWidth() {
    const cartContainer = document.getElementById('cart-container');
    const cartItems = cartContainer.children;
    const itemWidth = cartItems[0]?.offsetWidth || 0; // Check if there's at least one item
    cartContainer.style.width = `${cartItems.length * itemWidth}px`;
  }

  // Function to add item to wishlist
  function addCartItemToWishlist(cartItem) {
    const wishlistContainer = document.getElementById('wishlist-container');
    if (!wishlistContainer) {
      console.error('Wishlist container not found');
      return;
    }

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
    window.location.href = 'payment.html'; // Redirect to payment page
  }

});
