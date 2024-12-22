function toggleDropdown() {
    const dropdownList = document.querySelector('.dropdown-list');
    dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
}

function selectOption(category) {
    const menuItems = document.querySelectorAll('.menu-item');
    if (category === 'all') {
        menuItems.forEach(item => item.style.display = 'block');
    } else {
        menuItems.forEach(item => {
            if (item.classList.contains(category)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
}