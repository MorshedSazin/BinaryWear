<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaryWare - Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="order.css">
</head>
<body class="bg-gray-900 text-gray-100">

    <!-- Header -->
    <header class="bg-black bg-opacity-80 backdrop-blur-md sticky top-0 z-50 shadow-lg">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-3xl font-bold text-green-400">
                <a href="home.php">BinaryWare</a>
            </div>
            <div class="flex items-center space-x-6 flex-grow justify-end">
                <a href="about.php" class="hover:text-green-400 transition-colors duration-300 hidden md:block">ABOUT</a>
                <div class="relative hidden md:block">
                    <input type="text" id="search-bar" placeholder="Search..." class="bg-gray-700 text-white rounded-md pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 w-48">
                    <i class="fas fa-search fa-lg absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <a href="profile.php" class="hover:text-green-400 transition-colors duration-300"><i class="fas fa-user-circle fa-lg"></i></a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Out</a>
                <?php else: ?>
                    <a href="signin.php" id="signin-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign In</a>
                    <a href="login.php" id="login-btn" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Login</a>
                <?php endif; ?>
                <button id="menu-btn" class="md:hidden text-2xl"><i class="fas fa-bars"></i></button>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-black bg-opacity-90">
            <a href="home.php#products" class="block px-6 py-3 text-sm hover:bg-gray-800 transition-colors duration-300">SHOP</a>
            <a href="#" class="block px-6 py-3 text-sm hover:bg-gray-800 transition-colors duration-300">COLLECTIONS</a>
            <a href="about.php" class="block px-6 py-3 text-sm hover:bg-gray-800 transition-colors duration-300">ABOUT</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="block mx-6 my-2 text-center text-sm bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Sign Out</a>
            <?php else: ?>
                <a href="signin.php" class="block mx-6 my-2 text-center text-sm bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Sign In</a>
                <a href="login.php" class="block mx-6 my-2 text-center text-sm bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Order Form Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-12 text-green-400">Order Details</h2>
            
            <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg mb-8">
                <h3 class="text-2xl font-bold text-green-400 mb-4">Your Selected Items</h3>
                <div id="selected-items-summary" class="mb-6"></div>
                <div class="text-right text-xl font-bold text-green-400">
                    Total: <span id="total-price">0 BDT</span>
                </div>
            </div>

            <form class="max-w-lg mx-auto b-gray-800 p-8 rounded-lg shadow-lg" action="backend.php" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-green-400 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-green-400 font-bold mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-green-400 font-bold mb-2">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="mb-4">
                    <label for="city" class="block text-green-400 font-bold mb-2">City</label>
                    <input type="text" id="city" name="city" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="mb-4">
                    <label for="road" class="block text-green-400 font-bold mb-2">Road</label>
                    <input type="text" id="road" name="road" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="mb-4">
                    <label for="house" class="block text-green-400 font-bold mb-2">House Number</label>
                    <input type="text" id="house" name="house" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div class="mt-8">
                    <h3 class="text-2xl font-bold text-green-400 mb-4">Payment Method</h3>
                    <div class="flex items-center mb-4">
                        <input type="radio" id="cod" name="payment" value="cod" class="mr-2">
                        <label for="cod">Cash on Delivery</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="radio" id="card" name="payment" value="card" class="mr-2">
                        <label for="card">Card</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="bkash" name="payment" value="bkash" class="mr-2">
                        <label for="bkash">bKash</label>
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-md">Place Order</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black pt-12 pb-8">
        <div class="container mx-auto px-6 text-center text-gray-400">
            <div class="flex justify-center space-x-8 mb-6">
                <a href="#" class="hover:text-green-400 transition-colors duration-300">FAQ</a>
                <a href="#" class="hover:text-green-400 transition-colors duration-300">Terms</a>
                <a href="#" class="hover:text-green-400 transition-colors duration-300">Privacy</a>
            </div>
            <div class="flex justify-center space-x-8 mb-8">
                <a href="#" class="text-2xl hover:text-green-400 transition-colors duration-300"><i class="fab fa-youtube"></i></a>
                <a href="#" class="text-2xl hover:text-green-400 transition-colors duration-300"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-2xl hover:text-green-400 transition-colors duration-300"><i class="fab fa-github"></i></a>
            </div>
            <p>&copy; 2025 BinaryWare. All Rights Reserved.</p>
            <p class="text-sm mt-2 opacity-50">POWERED BY THE GRID</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectedItemsSummary = document.getElementById('selected-items-summary');
            const totalPriceSpan = document.getElementById('total-price');
            const selectedItems = JSON.parse(localStorage.getItem('selectedItems'));
            let totalPrice = 0;

            if (selectedItems && selectedItems.length > 0) {
                selectedItems.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('flex', 'justify-between', 'items-center', 'mb-2');
                    itemDiv.innerHTML = `
                        <span>${item.name} (Size: ${item.size}) x ${item.quantity}</span>
                        <span>${item.quantity * 450} BDT</span>
                    `;
                    selectedItemsSummary.appendChild(itemDiv);
                    totalPrice += item.quantity * 450;
                });
                totalPriceSpan.textContent = `${totalPrice} BDT`;
            } else {
                selectedItemsSummary.innerHTML = '<p class="text-gray-400">No items selected.</p>';
            }
        });
    </script>
</body>
</html>
