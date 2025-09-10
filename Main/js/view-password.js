const togglePassword = document.getElementById('toggle-password');
const passwordInput = document.getElementById('password-input');
const eyeOpen = document.getElementById('eye-open');
const eyeClosed = document.getElementById('eye-closed');

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    if (type === 'password') {
        eyeOpen.style.display = 'block';
        eyeClosed.style.display = 'none';
    } else {
        eyeOpen.style.display = 'none';
        eyeClosed.style.display = 'block';
    }
});