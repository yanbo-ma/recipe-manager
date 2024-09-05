
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.registration-form');

    form.addEventListener('submit', function (event) {
        // Prevent the form from submitting
        event.preventDefault();

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(function (el) {
            el.textContent = '';
        });

        // Get form values
        const name = document.getElementById('name').value;
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;
        const password2 = document.getElementById('password2').value;
        const agree = document.getElementById('agree').checked;

        let isValid = true;

        // Validate name
        if (name.trim() === '' || name.length < 3) {
            document.getElementById('name-error').textContent = 'Name is required and must be at least 3 characters long.';
            isValid = false;
        }

        // Validate username
        if (username.trim() === '' || username.length < 3) {
            document.getElementById('username-error').textContent = 'Username is required and must be at least 3 characters long.';
            isValid = false;
        }

        // Validate email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            document.getElementById('email-error').textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        // Validate phone number (basic validation, adjust as needed)
        const phonePattern = /^\d{10,15}$/; // Example: 10 to 15 digits
        if (!phonePattern.test(phone)) {
            document.getElementById('phone-error').textContent = 'Phone number is required and must be between 10 and 15 digits.';
            isValid = false;
        }

        // Validate password
        if (password.trim() === '' || password.length < 6) {
            document.getElementById('password-error').textContent = 'Password is required and must be at least 6 characters long.';
            isValid = false;
        }

        // Validate confirm password
        if (password !== password2) {
            document.getElementById('password2-error').textContent = 'Passwords do not match.';
            isValid = false;
        }

        // Validate agreement checkbox
        if (!agree) {
            document.getElementById('agree-error').textContent = 'You must agree to the terms.';
            isValid = false;
        }

        if (isValid) {
            // Form is valid, you can submit it or handle the data here
            form.submit();
        }
    });

    // Add event listener for reset button
    form.addEventListener('reset', function () {
        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(function (el) {
            el.textContent = '';
        });
    });
});
