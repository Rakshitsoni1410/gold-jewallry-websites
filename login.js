let isAuthenticated = false;
let username = '';
let password = '';

// Function to handle login
function login(usernameInput, passwordInput) {
    // Simulated login logic (replace with actual API call)
    if (usernameInput === 'admin' && passwordInput === 'password') {
        isAuthenticated = true;
        username = usernameInput;
        return true;
    } else {
        return false;
    }
}

// Function to handle signup
function signup(usernameInput, passwordInput) {
    // Simulated signup logic (replace with actual API call)
    if (usernameInput !== '' && passwordInput !== '') {
        isAuthenticated = true;
        username = usernameInput;
        return true;
    } else {
        return false;
    }
}

// Function to check if user is authenticated
function isAuthenticatedUser () {
    return isAuthenticated;
}

// Function to check if the user is logged in via AJAX call
async function isLoggedIn() {
    try {
        const response = await fetch('login.php'); // Adjust this as needed
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

// DOM Elements
const loginBtn = document.getElementById('login-btn');
const registerBtn = document.getElementById('register-btn');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const registerLink = document.getElementById('register-link');
const forgotPasswordLink = document.getElementById('forgot-password');

// Show login form
loginBtn.addEventListener('click', () => {
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
    loginBtn.classList.add('active');
    registerBtn.classList.remove('active');
});

// Show registration form
registerBtn.addEventListener('click', () => {
    registerForm.style.display = 'block';
    loginForm.style.display = 'none';
    registerBtn.classList.add('active');
    loginBtn.classList.remove('active');
});

// Show registration form when clicking register link
registerLink.addEventListener('click', () => {
    registerForm.style.display = 'block';
    loginForm.style.display = 'none';
    registerBtn.classList.add('active');
    loginBtn.classList.remove('active');
});

// Forgot password functionality (placeholder)
forgotPasswordLink.addEventListener('click', () => {
    alert('Forgot password functionality not implemented yet!');
});

// Handle login form submission
document.getElementById('login-form').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent form submission
    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;
    if (await isLoggedIn()) {
        // If already logged in
        window.location.href = 'index.html'; // Redirect to home page
    } else {
        if (login(usernameInput, passwordInput)) {
            window.location.href = 'index.html'; // Redirect on successful login
        } else {
            alert('Invalid username or password');
        }
    }
});

// Handle signup form submission
document.getElementById('register-form').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent form submission
    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;
    if (await isLoggedIn()) {
        // If already logged in
        window.location.href = 'index.html'; // Redirect to home page
    } else {
        if (signup(usernameInput, passwordInput)) {
            window.location.href = 'index.html'; // Redirect on successful signup
        } else {
            alert('Invalid username or password');
        }
    }
});