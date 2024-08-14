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
    <img src="${wishlistItem.image}" alt="${wishlistItem.title}" style="width: 100px; height: auto;">
    <h3 style="color:black;">${wishlistItem.title}</h3>
    <p style="color:skyblue;text-size:8px">${wishlistItem.price}</p>
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
    addCartItemToCart(wishlistItem);
  });
}

// Function to add a wishlist item to the cart
function addCartItemToCart(wishlistItem) {
  // Add the wishlist item to the cart logic here
  console.log(`Added ${wishlistItem.title} to cart`);
}