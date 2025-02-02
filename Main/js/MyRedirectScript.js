function redirectTo(category) {
    // Create a form to submit the selected category
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/PawsitiveWellbeing/Main/control/RegistrationRedirectControl.php';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'category';
    input.value = category;

    form.appendChild(input);
    document.body.appendChild(form);

    form.submit();
}