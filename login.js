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