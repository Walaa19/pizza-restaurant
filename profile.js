// Profile form handling
const profileForm = document.getElementById('profileForm');
const deleteAccountForm = document.getElementById('deleteAccountForm');
const messageBox = document.getElementById('messageBox');

function showMessage(message, type) {
    messageBox.textContent = message;
    messageBox.className = `message-box ${type}`;
    
    if (type === 'success') {
        setTimeout(() => {
            messageBox.style.display = 'none';
        }, 3000);
    }
}

profileForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(profileForm);
    const newPassword = formData.get('new_password');
    const confirmPassword = formData.get('confirm_password');
    
    // Password validation
    if (newPassword || confirmPassword) {
        if (!formData.get('current_password')) {
            showMessage('Current password is required to change password', 'error');
            return;
        }
        if (newPassword !== confirmPassword) {
            showMessage('New passwords do not match', 'error');
            return;
        }
    }
    
    try {
        const response = await fetch('update_profile.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            showMessage(data.message, 'success');
            // Clear password fields
            document.getElementById('current_password').value = '';
            document.getElementById('new_password').value = '';
            document.getElementById('confirm_password').value = '';
        } else {
            showMessage(data.message, 'error');
        }
    } catch (error) {
        showMessage('An error occurred while updating profile', 'error');
        console.error('Error:', error);
    }
});

deleteAccountForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    if (!confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        return;
    }
    
    const password = prompt('Please enter your password to confirm account deletion:');
    if (!password) {
        return;
    }
    
    try {
        const response = await fetch('delete_account.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ password })
        });
        
        const data = await response.json();
        
        if (data.success) {
            showMessage('Account deleted successfully. Redirecting...', 'success');
            setTimeout(() => {
                window.location.href = 'register.html';
            }, 2000);
        } else {
            showMessage(data.message, 'error');
        }
    } catch (error) {
        showMessage('An error occurred while deleting account', 'error');
        console.error('Error:', error);
    }
});