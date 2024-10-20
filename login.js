// Function to handle login
async function login(usernameInput, passwordInput) {
  const response = await fetch('login.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({
      login: true,
      username: usernameInput,
      password: passwordInput
    })
  });

  const data = await response.json();

  if (data.loggedIn) {
    window.location.href = data.redirect; // Redirect to index.html
  } else {
    alert(data.error || 'Login failed. Please try again.');
  }
}

// Function to handle signup
async function signup(usernameInput, emailInput, passwordInput) {
  const response = await fetch('login.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({
      signup: true,
      username: usernameInput,
      email: emailInput,
      password: passwordInput
    })
  });

  const data = await response.json();

  if (data.success) {
    window.location.href = data.redirect; // Redirect to index.html on successful signup
  } else {
    alert(data.error || 'Signup failed. Please try again.');
  }
}

// Handle login form submission
// document.getElementById('loginForm').addEventListener('submit', async function(event) {
//   event.preventDefault(); // Prevent default form submission
//   const usernameInput = document.getElementById('login-username').value;
//   const passwordInput = document.getElementById('login-password').value;

//   // Attempt to log in
//   await login(usernameInput, passwordInput);
// });

// Handle signup form submission
// document.getElementById('registerForm').addEventListener('submit', async function(event) {
//   event.preventDefault(); // Prevent default form submission
//   const usernameInput = document.getElementById('register-username').value;
//   const emailInput = document.getElementById('register-email').value;
//   const passwordInput = document.getElementById('register-password').value;

//   // Attempt to sign up
//   await signup(usernameInput, emailInput, passwordInput);
// });
$(document).ready(function () {
  $('#registerForm').on('submit', function (e) {
    $.ajax({
      url: 'signup.php',
      type: 'POST',
      async: false,
      data: $(this).serialize(),
      success: function (response) {
        if (response.success == false) {
          $('#result').html(response.error); // Update the result div with the server's response  
          alert(response.error);
        }
        else {
          console.log("AJAX Success"); // Confirm success handler is called
          console.log(response); // Log the response for debugging
          $('#result').html(response); // Update the result div with the server's response
        }

      },
      error: function (xhr, status, error) {
        console.log("AJAX Error:", error); // Log the error for debugging
        $('#result').html('<p>An error occurred: ' + error + '</p>');
      }
    });

  });
  $('#loginForm').on('submit', function (e) {
    $.ajax({
      url: 'login.php',
      type: 'POST',
      async: false,
      data: $(this).serialize(),
      success: function (response) {
        localStorage.setItem('isLogged',true);
        window.location.href = response.redirect;

      },
      error: function (xhr, status, error) {
        console.log("AJAX Error:", error); // Log the error for debugging
        $('#result').html('<p>An error occurred: ' + error + '</p>');
      }
    });

  });
});