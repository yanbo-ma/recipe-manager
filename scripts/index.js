document.getElementById('search-form').addEventListener('submit', function (event) {
    const searchInput = document.getElementById('search-input').value.trim();
    const searchType = document.querySelector('input[name="search-type"]:checked');
    const feedbackMessage = document.getElementById('feedback-message');

    feedbackMessage.textContent = '';

    if (searchInput === '') {
        feedbackMessage.textContent = 'Please enter a search term';
        event.preventDefault();
        return;
    }

    if (!searchType) {
        feedbackMessage.textContent = 'Please select a search type';
        event.preventDefault();
        return;
    }
});