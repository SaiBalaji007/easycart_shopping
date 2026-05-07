document.getElementById('signup-btn').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default form submission
    const emailInput = document.getElementById('email');
    const errorMessage = document.getElementById('error-message');
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email validation regex
    if (!emailInput.value) {
        errorMessage.textContent = 'Please enter your email address.';
        errorMessage.style.display = 'block';
    } else if (!emailRegex.test(emailInput.value)) {
        errorMessage.textContent = 'Please enter a valid email address.';
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none';
        alert('Thank you for signing up!');
        emailInput.value = ''; // Clear the input after successful validation
    }
});
