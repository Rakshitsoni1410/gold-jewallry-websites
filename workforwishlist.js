// Get all the wishlist buttons
const wishlistButtons = document.querySelectorAll('.wish.button');
const wishlistContainer = document.getElementById('wishlist-container');

// Function to check if the user is logged in (returns a promise)
async function isLoggedIn() {
  try {
    const response = await fetch('login.php'); // Assuming 'login.php' returns JSON with login status
    const data = await response.json();
    return data.loggedIn; // This should return true or false based on login status
  } catch (error) {
    console.error('Error checking login status:', error);
    return false; // Default to false if there's an error
  }
}

// Function to display login and signup message
function displayLoginSignupMessage() {
  const message = 'You must login or signup to add to wishlist';
  alert(message);
  // Optionally show login and signup buttons or redirect to login/signup page
}

// Add event listeners to all wishlist buttons
wishlistButtons.forEach(button => {
  button.addEventListener('click', async (event) => {
    event.preventDefault(); // Prevent the default link behavior

    // Check if the user is logged in
    const loggedIn = await isLoggedIn();

    if (!loggedIn) {
      displayLoginSignupMessage();
      return; // Stop further execution if not logged in
    }

    // If the user is logged in, proceed with adding the item to the wishlist
    const productCard = button.closest('.product-card');
    const productId = productCard.id; // Get the product ID
    const productTitle = productCard.querySelector('.title').textContent;
    const productPrice = productCard.querySelector('.price').textContent;
    const productImage = productCard.querySelector('img').src;

    // Check if the item already exists in the wishlist
    const existingWishlistItem = wishlistContainer.querySelector(`[data-id="${productId}"]`);
    if (!existingWishlistItem) {
      // Create a new wishlist item object
      const wishlistItem = {
        id: productId,
        title: productTitle,
        price: productPrice,
        image: productImage
      };

      // Add the item to the wishlist
      addWishlistItemToWishlist(wishlistItem);
    } else {
      alert("Item already exists in the wishlist!");
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
      <p style="color:skyblue;">${wishlistItem.price}</p>
    </div>
    <div class="wishlist-item-actions">
      <button class="btn btn-danger btn-sm remove-from-wishlist">Remove from wishlist</button>
      <button class="btn btn-primary btn-sm add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</button>
    </div>
  `;

  wishlistContainer.appendChild(wishlistItemElement);
  updateWishlistContainerWidth();

  // Remove from wishlist functionality
  wishlistItemElement.querySelector('.remove-from-wishlist').addEventListener('click', () => {
    wishlistItemElement.remove();
    updateWishlistContainerWidth();
  });

  // Add to cart functionality
  wishlistItemElement.querySelector('.add-to-cart').addEventListener('click', () => {
    addCartItemToCart(wishlistItem);
  });
}

// Function to update wishlist container width
function updateWishlistContainerWidth() {
  const wishlistItems = wishlistContainer.children;
  if (wishlistItems.length > 0) {
    const itemWidth = wishlistItems[0].offsetWidth;
    wishlistContainer.style.width = `${wishlistItems.length * itemWidth}px`;
  }
}

// Function to add wishlist item to cart
function addCartItemToCart(wishlistItem) {
  console.log(`Added ${wishlistItem.title} to cart`);
}
