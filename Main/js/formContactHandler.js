document.addEventListener("DOMContentLoaded", function () {
    const query = new URLSearchParams(window.location.search);
    const alertDiv = document.getElementById("formAlert");

    if (alertDiv) {
        if (query.get("status") === "success") {
            alertDiv.innerHTML = '<p class="success-message">Message sent successfully!</p>';
        } else if (query.get("status") === "error") {
            alertDiv.innerHTML = '<p class="error-message">Failed to send message. Please try again later.</p>';
        }
    }

    setTimeout(() => {
        alertDiv.innerHTML = '';
    }, 4000);
});
