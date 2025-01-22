function validateForm() {
    // Check if organization type is selected
    if (!document.querySelector('input[name="otype"]:checked')) {
        alert('Please select an Organization Type.');
        return false;
    }

    // Check if payment method is selected
    if (!document.querySelector('input[name="payment-method"]:checked')) {
        alert('Please select a Payment Method.');
        return false;
    }

    // Check if captcha is filled
    const captcha = document.getElementById('captcha').value.trim();
    if (!captcha) {
        alert('Captcha field cannot be empty.');
        return false;
    }

    // If all validations pass
    return true;
}
