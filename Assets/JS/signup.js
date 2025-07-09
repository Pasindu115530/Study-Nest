// signup.js

// Function to check username availability via AJAX
async function validateUsername() {
    const usernameInput = document.getElementById('username');
    const feedback = document.getElementById('username-feedback');
    const username = usernameInput.value.trim();

    if (username.length < 3) {
        feedback.textContent = "Username must be at least 3 characters.";
        feedback.style.color = "red";
        return false;
    }

    try {
        const response = await fetch('/StudyNest/Assets/php/check-username.php?username=' + encodeURIComponent(username));
        const data = await response.json();
        if (data.username_available) {
            feedback.textContent = "Username is available!";
            feedback.style.color = "green";
            return true;
        } else {
            feedback.textContent = "Username is already taken.";
            feedback.style.color = "red";
            return false;
        }
    } catch (error) {
        feedback.textContent = "Error checking username...";
        feedback.style.color = "red";
        return false;
    }
}

// Email validation with DB check
async function validateEmail() {
    const emailInput = document.getElementById('mailaddress');
    const feedback = document.getElementById('email-feedback');
    const email = emailInput.value.trim();
    // Simple email regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        feedback.textContent = "Invalid email format.";
        feedback.style.color = "red";
        return false;
    }
    try {
        const response = await fetch('/StudyNest/Assets/php/check-username.php?email=' + encodeURIComponent(email));
        const data = await response.json();
        if (data.email_available) {
            feedback.textContent = "";
            return true;
        } else {
            feedback.textContent = "Email is already registered.";
            feedback.style.color = "red";
            return false;
        }
    } catch (error) {
        feedback.textContent = "Error checking email...";
        feedback.style.color = "red";
        return false;
    }
}

// Phone number validation with DB check
async function validatePhone() {
    const phoneInput = document.getElementById('pnumber');
    const feedback = document.getElementById('phone-feedback');
    const phone = phoneInput.value.trim();
    // Accepts 10 digit numbers only
    const phoneRegex = /^\d{10}$/;
    if (!phoneRegex.test(phone)) {
        feedback.textContent = "Phone number must be 10 digits.";
        feedback.style.color = "red";
        return false;
    }
    try {
        const response = await fetch('/StudyNest/Assets/php/check-username.php?phone=' + encodeURIComponent(phone));
        const data = await response.json();
        if (data.phone_available) {
            feedback.textContent = "";
            return true;
        } else {
            feedback.textContent = "Phone number is already registered.";
            feedback.style.color = "red";
            return false;
        }
    } catch (error) {
        feedback.textContent = "Error checking phone...";
        feedback.style.color = "red";
        return false;
    }
}

// Attach event listener to username input
document.addEventListener('DOMContentLoaded', function() {
    const usernameInput = document.getElementById('username');
    if (usernameInput) {
        usernameInput.addEventListener('input', validateUsername);
    }
    const emailInput = document.getElementById('mailaddress');
    if (emailInput) {
        emailInput.addEventListener('input', validateEmail);
    }
    const phoneInput = document.getElementById('pnumber');
    if (phoneInput) {
        phoneInput.addEventListener('input', validatePhone);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (!form) return;
    const inputs = form.querySelectorAll('input, select');
    const signupBtn = form.querySelector('button[type="submit"]');

    function checkFields() {
        let allFilled = true;
        inputs.forEach(input => {
            if ((input.type !== "button" && input.type !== "submit") && !input.value) {
                allFilled = false;
            }
        });
        signupBtn.disabled = !allFilled;
        signupBtn.style.opacity = allFilled ? "1" : "0.6";
        signupBtn.style.cursor = allFilled ? "pointer" : "not-allowed";
    }

    inputs.forEach(input => {
        input.addEventListener('input', checkFields);
        input.addEventListener('change', checkFields);
    });

    checkFields();
});


// Prevent form submission if passwords do not match
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const pwconfirm = document.getElementById('pwconfirm').value;
        if (password !== pwconfirm) {
            e.preventDefault();
            let feedback = document.getElementById('pwconfirm-feedback');
            if (!feedback) {
                const input = document.getElementById('pwconfirm');
                feedback = document.createElement('span');
                feedback.id = 'pwconfirm-feedback';
                feedback.style.color = 'red';
                feedback.style.fontSize = '0.9em';
                feedback.style.marginTop = '2px';
                input.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Passwords do not match!';
        } else {
            const feedback = document.getElementById('pwconfirm-feedback');
            if (feedback) feedback.textContent = '';
        }
    });
});