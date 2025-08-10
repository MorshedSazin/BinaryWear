function validateForm() {
    let isValid = true;

    // Clear previous errors
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.textContent = '');

    // Name validation
    const name = document.getElementById('name').value;
    if (name.trim() === '') {
        document.getElementById('name-error').textContent = 'Name is required.';
        isValid = false;
    }

    // Email validation
    const email = document.getElementById('email').value;
    if (!/(\.com|\iubat.edu)$/.test(email)) {
        document.getElementById('email-error').textContent = 'Invalid email format. Email must end with .com or iubat.edu';
        isValid = false;
    }

    // Phone validation
    const phone = document.getElementById('phone').value;
    if (phone.trim() === '') {
        document.getElementById('phone-error').textContent = 'Phone number is required.';
        isValid = false;
    }

    // Address validation
    const address = document.getElementById('address').value;
    if (address.trim() === '') {
        document.getElementById('address-error').textContent = 'Address is required.';
        isValid = false;
    }

    // Education validation
    const education = document.getElementById('education').value;
    if (education.trim() === '') {
        document.getElementById('education-error').textContent = 'Education is required.';
        isValid = false;
    }

    // Linux Distro validation
    const linuxDistro = document.getElementById('linux-distro').value;
    if (linuxDistro.trim() === '') {
        document.getElementById('linux-distro-error').textContent = 'Favorite Linux Distro is required.';
        isValid = false;
    }

    // Password validation
    const password = document.getElementById('password').value;
    if (password.length < 10 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password) || !/[^A-Za-z0-9]/.test(password)) {
        document.getElementById('password-error').textContent = 'Password must be at least 10 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';
        isValid = false;
    }

    return isValid;
}