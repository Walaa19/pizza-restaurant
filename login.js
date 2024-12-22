// Login form handling
document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    const formData = new FormData(this); // Collect form data
    const errorMessage = document.getElementById('errorMessage');

    fetch('login.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Store user ID in localStorage
                localStorage.setItem('userId', data.user_id);
                window.location.href = 'menu.html'; // Redirect on success
            } else {
                errorMessage.textContent = data.message;
                errorMessage.style.display = 'block'; // Display error message
            }
        })
        .catch(error => console.error('Error:', error));
});

// Input validation
const form = document.querySelector("form");
const usernameInput = document.getElementById("user");
const passwordInput = document.getElementById("pass");

form.addEventListener("submit", (e) => {
    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    if (!username) {
        alert("Username is required.");
        e.preventDefault(); // Prevent form submission
        return;
    }

    if (!password) {
        alert("Password is required.");
        e.preventDefault();
        return;
    }

    if (password.length < 8 || password.length > 16) {
        alert("Password must be between 8 and 16 characters.");
        e.preventDefault();
        return;
    }
});
