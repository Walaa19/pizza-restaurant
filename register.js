// Get form elements
const form = document.querySelector("form");
const usernameInput = document.getElementById("user");
const addressInput = document.getElementById("adress");
const phoneInput = document.getElementById("number");
const passwordInput = document.getElementById("password");

// Add event listener for form submission
form.addEventListener("submit", (e) => {
    const username = usernameInput.value.trim();
    const address = addressInput.value.trim();
    const phone = phoneInput.value.trim();
    const password = passwordInput.value.trim();

    // Validate input fields
    if (!username) {
        alert("Username is required.");
        e.preventDefault(); // Prevent form submission
        return;
    }

    if (!address) {
        alert("Address is required.");
        e.preventDefault();
        return;
    }

    if (!phone || !/^\d+$/.test(phone) || phone.length < 10) {
        alert("Enter a valid phone number (at least 10 digits).");
        e.preventDefault();
        return;
    }

    if (!password || password.length < 8) {
        alert("Password must be at least 8 characters long.");
        e.preventDefault();
        return;
    }

    // If validation passes, allow form submission
    //console.log("Form submitted:", { username, address, phone, password });
});
