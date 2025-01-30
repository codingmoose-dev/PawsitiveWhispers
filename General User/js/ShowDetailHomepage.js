document.addEventListener('DOMContentLoaded', function () {
    const SubmitCaseButton = document.getElementById('show-submit-case');
    const SubmitCaseContent = document.getElementById('SubmitCaseContent');

    if (SubmitCaseButton && SubmitCaseContent) {
        SubmitCaseButton.addEventListener('click', function () {
            SubmitCaseContent.style.display = 'block'; // Show hidden content
            SubmitCaseButton.style.display = 'none';  // Hide the button
        });
    } else {
        console.error('Button or content not found!');
    }
});
