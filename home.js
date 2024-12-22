// JavaScript Code

// Increment Stats Values
document.addEventListener('DOMContentLoaded', () => {
    const stats = document.querySelectorAll('footer .stats div span');
    stats.forEach(stat => {
        const target = parseInt(stat.textContent.replace(/\D/g, ''));
        let current = 0;
        const increment = Math.ceil(target / 100);

        const updateStat = () => {
            if (current < target) {
                current += increment;
                stat.textContent = current + (isNaN(parseInt(stat.textContent[0])) ? '+' : '');
                setTimeout(updateStat, 10);
            } else {
                stat.textContent = target + (isNaN(parseInt(stat.textContent[0])) ? '+' : '');
            }
        };
        updateStat();
    });
});

// Toggle Dropdown Menus
const menuButton = document.querySelector('.menu-button');
const dropdown = document.querySelector('.dropdown');

menuButton.addEventListener('click', (e) => {
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    e.stopPropagation(); // Prevent click propagation
});

// Hide Dropdown when clicking outside
document.addEventListener('click', () => {
    dropdown.style.display = 'none';
});

// Smooth Scroll to Sections
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        document.getElementById(targetId)?.scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Button Hover Effect for Footer Buttons
const footerButtons = document.querySelectorAll('.footer-buttons a');

footerButtons.forEach(button => {
    button.addEventListener('mouseover', () => {
        button.style.transform = 'scale(1.1)';
    });
    button.addEventListener('mouseout', () => {
        button.style.transform = 'scale(1)';
    });
});

