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