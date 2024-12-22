// Function to add item to cart
function addToCart(itemName, itemPrice) {
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            item_name: itemName,
            item_price: itemPrice
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Item added to cart!');
            displayCartItems(); // Refresh cart display
        } else {
            if (data.message === 'Please login first') {
                window.location.href = 'login.php';
            } else {
                alert(data.message);
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to display cart items
function displayCartItems() {
    fetch('view_cart.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartContainer = document.getElementById('cartContainer');
                const totalPriceElement = document.getElementById('totalPrice');
                let total = 0;
                
                cartContainer.innerHTML = '';
                
                data.items.forEach(item => {
                    const itemTotal = item.item_price * item.quantity;
                    total += itemTotal;
                    
                    const itemElement = document.createElement('div');
                    itemElement.className = 'cart-item';
                    itemElement.innerHTML = `
                        <h3>${item.item_name}</h3>
                        <p>Price: ${item.item_price} LE</p>
                        <div class="quantity-controls">
                            <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                        <p>Total: ${itemTotal} LE</p>
                        <button class="remove-btn" onclick="removeItem(${item.id})">Remove</button>
                    `;
                    cartContainer.appendChild(itemElement);
                });
                
                totalPriceElement.textContent = total + ' LE';
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}

// Function to update item quantity
function updateQuantity(itemId, newQuantity) {
    if (newQuantity < 1) {
        removeItem(itemId);
        return;
    }

    fetch('update_quantity.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            item_id: itemId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayCartItems(); // Refresh cart display
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to remove single item
function removeItem(itemId) {
    if (!confirm('Are you sure you want to remove this item?')) {
        return;
    }

    fetch('remove_item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            item_id: itemId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayCartItems(); // Refresh cart display
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to clear entire cart
function clearCart() {
    if (!confirm('Are you sure you want to clear your entire cart?')) {
        return;
    }

    fetch('clear_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayCartItems(); // Refresh cart display
            alert('Cart cleared successfully');
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function checkoutCart() {
    fetch('checkout.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message); // Show order confirmation
                displayCartItems(); // Refresh cart display
            } else {
                alert(data.message); // Show any error message
            }
        })
        .catch(error => console.error('Error:', error));
}