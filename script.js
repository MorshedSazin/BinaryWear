document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const searchBar = document.getElementById('search-bar');
    const orderNowBtn = document.getElementById('order-now-btn');
    const userId = document.getElementById('user-id').value;

    if (menuBtn) {
        menuBtn.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    }

    if (searchBar) {
        searchBar.addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                console.log('Search query:', searchBar.value);
                // Implement actual search functionality here later
                alert('Search functionality is not yet implemented. Query: ' + searchBar.value);
            }
        });
    }

    if (orderNowBtn) {
        orderNowBtn.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            if (!userId) {
                window.location.href = 'login.php';
                return;
            }

            const productCards = document.querySelectorAll('.product-card');
            const selectedItems = [];

            productCards.forEach(card => {
                const checkbox = card.querySelector('.product-select');
                if (checkbox.checked) {
                    const productName = card.querySelector('h3').textContent;
                    const selectedSize = card.querySelector('.product-size').value;

                    if (selectedSize === 'Size') {
                        alert(`Please select a size for "${productName}" before proceeding.`);
                        selectedItems.length = 0; // Clear selected items if there's an error
                        return; // Stop processing if a size is not selected
                    }

                    selectedItems.push({
                        name: productName,
                        size: selectedSize,
                        quantity: 1
                    });
                }
            });

            if (selectedItems.length > 0) {
                localStorage.setItem('selectedItems', JSON.stringify(selectedItems));
                window.location.href = 'order.php';
            } else {
                alert('Please select at least one item to order.');
            }
        });
    }
});