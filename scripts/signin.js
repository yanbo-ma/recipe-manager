document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.registration-form');

    form.addEventListener('submit', function (event) {
        // Prevent the form from submitting
        event.preventDefault();

        // Clear previous error messages
        document.getElementById('username-error').textContent = '';
        document.getElementById('password-error').textContent = '';

        // Get form values
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        let isValid = true;

        // Validate username
        if (username.trim() === '' || username.length < 3) {
            document.getElementById('username-error').textContent = 'Username is required and must be at least 3 characters long.';
            isValid = false;
        }

        // Validate password
        if (password.trim() === '' || password.length < 6) {
            document.getElementById('password-error').textContent = 'Password is required and must be at least 6 characters long.';
            isValid = false;
        }

        if (isValid) {
            form.submit();
        }
    });

    form.addEventListener('reset', function () {
        // Clear previous error messages
        document.getElementById('username-error').textContent = '';
        document.getElementById('password-error').textContent = '';
    });
});