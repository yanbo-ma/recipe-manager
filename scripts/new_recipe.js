document.querySelector('.recipe-form').addEventListener('submit', function (event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(function (el) {
        el.textContent = '';
    });

    // Get form values
    const title = document.getElementById('new-title').value;
    const description = document.getElementById('new-description').value;
    const totalTime = document.getElementById('total-time').value;
    const cuisine = document.getElementById('cuisine').value;
    const dietaryPreference = document.getElementById('dietary-preference').value;
    const ingredients = document.getElementById('ingredients').value;
    const steps = document.getElementById('steps').value;
    const recipeImage = document.getElementById('recipe-image').files.length > 0;

    let isValid = true;

    // Validate title
    if (title.trim() === '' || title.length < 3) {
        document.getElementById('title-error').textContent = 'Title is required and must be at least 3 characters long.';
        isValid = false;
    }

    // Validate description
    if (description.trim() === '' || description.length < 10) {
        document.getElementById('description-error').textContent = 'Description is required and must be at least 10 characters long.';
        isValid = false;
    }

    // Validate total time
    if (isNaN(totalTime) || totalTime <= 0) {
        document.getElementById('total-time-error').textContent = 'Total time must be a positive number.';
        isValid = false;
    }

    // Validate cuisine
    if (cuisine.trim() === '') {
        document.getElementById('cuisine-error').textContent = 'Cuisine is required.';
        isValid = false;
    }

    // Validate dietary preference
    if (dietaryPreference.trim() === '') {
        document.getElementById('dietary-preference-error').textContent = 'Dietary Preference is required.';
        isValid = false;
    }

    // Validate ingredients
    if (ingredients.trim() === '') {
        document.getElementById('ingredients-error').textContent = 'At least one ingredient is required';
        isValid = false;
    }

    // Validate steps
    if (steps.trim() === '') {
        document.getElementById('preparation-error').textContent = 'At least one step is required';
        isValid = false;
    }

    if (isValid) {
        // Form is valid, you can submit it or handle the data here
        this.submit();
    }
});

// Add event listener for reset button
document.querySelector('.recipe-form').addEventListener('reset', function () {
    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(function (el) {
        el.textContent = '';
    });
});