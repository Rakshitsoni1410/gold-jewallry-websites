const cartButtons = document.querySelectorAll('.cart.button');

// Add an event listener to each button
cartButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent the default link behavior

    // Get the product details from the product card
    const productCard = button.closest('.product-card');
    const productTitle = productCard.querySelector('.title').textContent;
    const productPrice = productCard.querySelector('.price').textContent;
    const productImage = productCard.querySelector('img').src; // Get the product image URL

    // Create a new cart item object
    const cartItem = {
      title: productTitle,
      price: productPrice,
      image: productImage // Include the image URL
    };

    // Add the cart item to the cart
    addCartItemToCart(cartItem, button.id);
  });
});

// Function to add a cart item to the cart
function addCartItemToCart(cartItem, buttonId) {
  // Get the cart container
  const cartContainer = document.getElementById('cart-container');

  // Create a new cart item element
  const cartItemElement = document.createElement('div');
  cartItemElement.id = `cart-item-${buttonId.replace('add-to-cart-', '')}`; // Add the ID to the cart item element
  cartItemElement.classList.add('cart-item');
  cartItemElement.innerHTML = `
    <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    <h3 style="color:black;">${cartItem.title}</h3>
    <p style="color:skyblue;text-size:8px">${cartItem.price}</p>
    <button class="btn btn-danger btn-sm remove-from-cart">Remove from cart</button>
    <button class="btn btn-primary btn-sm add-to-wishlist"><i class="fas fa-heart"></i> Add to wishlist</button>
    <button class="btn btn-success btn-sm make-payment">Make Payment</button>
  `;

  // Add the cart item element to the cart container
  cartContainer.appendChild(cartItemElement);

  // Add an event listener to the remove from cart button
  const removeFromCartButton = cartItemElement.querySelector('.remove-from-cart');
  removeFromCartButton.addEventListener('click', () => {
    // Remove the cart item from the cart
    cartItemElement.remove();
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
    makePayment(cartItem, buttonId);
  });
}

// Function to add a cart item to the wishlist
function addCartItemToWishlist(cartItem) {
  // Get the wishlist container
  const wishlistContainer = document.getElementById('wishlist-container');

  // Create a new wishlist item element
  const wishlistItemElement = document.createElement('div');
  wishlistItemElement.classList.add('wishlist-item');
  wishlistItemElement.innerHTML = `
    <img src="${cartItem.image}" alt="${cartItem.title}" style="width: 100px; height: auto;">
    <h3 style="color:black;">${cartItem.title}</h3>
    <p style="color:skyblue;text-size:8px">${cartItem.price}</p>
    <button class="btn btn-danger btn-sm remove-from-wishlist">Remove from wishlist</button>
    <button class="btn btn-primary btn-sm add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</button>
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
    addCartItemToCart(cartItem, addToCartButton.id);
  });
}

function makePayment(cartItem, buttonId) {
  console.log('Make payment function called');
  console.log(`Making payment for ${cartItem.title}`);
  
  // Remove the cart item from the cart

  
  // Remove the cart item from the cart
  const cartItemElement = document.querySelector(`.cart-item img[src="${cartItem.image}"]`).closest('.cart-item');
  console.log(cartItemElement); // Check if the element is being selected correctly
  cartItemElement.remove(); // Remove the element from the DOM
  
  // Redirect to payment options page
  window.location.href = 'payment .html';
}