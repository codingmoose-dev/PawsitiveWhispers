// ShowDetailHomepage.js
document.addEventListener('DOMContentLoaded', function () {
    const donateButton = document.getElementById('show-more-donate');
    const donateContent = document.getElementById('donate-more-content');

    if (donateButton && donateContent) {
        donateButton.addEventListener('click', function () {
            donateContent.style.display = 'block'; // Show hidden content
            donateButton.style.display = 'none';  // Hide the button
        });
    } else {
        console.error('Button or content not found!');
    }
});
