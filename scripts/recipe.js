function shareRecipe() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copied to clipboard');
    }).catch((err) => {
        console.error('Failed to copy: ', err);
    });
}
