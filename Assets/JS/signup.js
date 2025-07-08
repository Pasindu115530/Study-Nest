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
        const response = await fetch('/check-username.php?username=' + encodeURIComponent(username));
        const data = await response.json();

        if (data.available) {
            feedback.textContent = "Username is available!";
            feedback.style.color = "green";
            return true;
        } else {
            feedback.textContent = "Username is already taken.";
            feedback.style.color = "red";
            return false;
        }
    } catch (error) {
        feedback.textContent = "Error checking username.";
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
});