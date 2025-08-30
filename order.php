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
    <?php if (isset($_SESSION['error'])):
 ?>
        <div class="bg-red-500 text-white p-4 mb-4">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])):
 ?>
        <div class="bg-green-500 text-white p-4 mb-4">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <header class="bg-black bg-opacity-80 backdrop-blur-md sticky top-0 z-50 shadow-lg">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-3xl font-bold text-green-400">
                <a href="home.php">BinaryWare</a>
            </div>
            <div class="flex items-center space-x-6 flex-grow justify-end">
                <a href="about.php" class="hover:text-green-400 transition-colors duration-300 hidden md:block">ABOUT</a>
                <a href="profile.php" class="hover:text-green-400 transition-colors duration-300"><i class="fas fa-user-circle fa-lg"></i></a>
                <?php if (isset($_SESSION['user_id'])):
 ?>
                    <a href="logout.php" id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Out</a>
                <?php else: ?>
                    <a href="signup.php" id="signin-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Up</a>
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
            <?php if (isset($_SESSION['user_id'])):
 ?>
                <a href="logout.php" class="block mx-6 my-2 text-center text-sm bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Sign Out</a>
            <?php else: ?>
                <a href="signup.php" class="block mx-6 my-2 text-center text-sm bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Sign Up</a>
                <a href="login.php" class="block mx-6 my-2 text-center text-sm bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Order Form Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-12 text-green-400">Order Details</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-green-400 mb-4">Your Selected Items</h3>

                    <div id="selected-items-summary" class="mb-6"></div>
                    <div class="text-right text-xl font-bold text-green-400">
                        Total: <span id="total-price">0 BDT</span>
                    </div>
                    <div class="text-right text-xl font-bold text-green-400 mt-4">
                        Delivery Charge: <span id="delivery-charge">70 BDT</span>
                    </div>
                    <div class="text-right text-2xl font-bold text-green-400 mt-2">
                        Final Total: <span id="final-total-price">0 BDT</span>
                    </div>
                </div>

                <form class="bg-gray-800 p-8 rounded-lg shadow-lg" action="bak.order.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="name" class="block text-green-400 font-bold mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-green-400 font-bold mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-green-400 font-bold mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" value="+88" required>
                        </div>
                        <div class="mb-4">
                            <label for="region" class="block text-green-400 font-bold mb-2">Region</label>
                            <input type="text" id="region" name="region" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block text-green-400 font-bold mb-2">City</label>
                            <input type="text" id="city" name="city" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="zip" class="block text-green-400 font-bold mb-2">ZIP Code</label>
                            <input type="text" id="zip" name="zip" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="zone" class="block text-green-400 font-bold mb-2">Zone</label>
                            <input type="text" id="zone" name="zone" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-green-400 font-bold mb-2">Address</label>
                        <textarea id="address" name="address" rows="3" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required></textarea>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl font-bold text-green-400 mb-4">Delivery Location</h3>
                        <div class="space-y-2">
                            <label for="delivery_inside_dhaka" class="flex items-center p-3 rounded-md bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                <input type="radio" id="delivery_inside_dhaka" name="delivery_location" value="inside" class="mr-3" checked>
                                Inside Dhaka (70 BDT)
                            </label>
                            <label for="delivery_outside_dhaka" class="flex items-center p-3 rounded-md bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                <input type="radio" id="delivery_outside_dhaka" name="delivery_location" value="outside" class="mr-3">
                                Outside Dhaka (120 BDT)
                            </label>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl font-bold text-green-400 mb-4">Payment Method</h3>
                        <div class="space-y-2">
                            <label for="payment_method_cod" class="flex items-center p-3 rounded-md bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                <input type="radio" id="payment_method_cod" name="payment_method" value="cod" class="mr-3">
                                Cash on Delivery
                            </label>
                            <label for="payment_method_card" class="flex items-center p-3 rounded-md bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                <input type="radio" id="payment_method_card" name="payment_method" value="card" class="mr-3">
                                Nagad
                            </label>
                            <label for="payment_method_bkash" class="flex items-center p-3 rounded-md bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                <input type="radio" id="payment_method_bkash" name="payment_method" value="bkash" class="mr-3">
                                bKash
                            </label>
                        </div>
                    </div>
                    <div class="mb-4 mt-4">
                        <label for="transection_id" class="block text-green-400 font-bold mb-2">Transaction ID</label>
                        <input type="text" id="transection_id" name="transection_id" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <input type="hidden" id="total_payment" name="total_payment">
                    <input type="hidden" id="items_name" name="items_name">
                    <div class="mt-8">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-md">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black pt-12 pb-8">
        <div class="container mx-auto px-6 text-center text-gray-400">
            <div class="flex justify-center space-x-8 mb-8">
                <a href="https://github.com/morshedsazin/" class="text-2xl hover:text-green-400 transition-colors duration-300" target="_blank"><i class="fab fa-github"></i></a>
                <a href="https://www.linkedin.com/in/morshed-sazin/" class="text-2xl hover:text-green-400 transition-colors duration-300" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.facebook.com/MorshedSazin/" class="text-2xl hover:text-green-400 transition-colors duration-300" target="_blank"><i class="fab fa-facebook"></i></a>
            </div>
        <p>&copy; 2025 BinaryWare. All Rights Reserved.</p>
        <p class="text-sm mt-2 opacity-50">POWERED BY THE WISDOM OF OPEN SOURCE</p>
    </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectedItemsSummary = document.getElementById('selected-items-summary');
            const totalPriceSpan = document.getElementById('total-price');
            const deliveryChargeSpan = document.getElementById('delivery-charge');
            const finalTotalPriceSpan = document.getElementById('final-total-price');
            const selectedItems = JSON.parse(localStorage.getItem('selectedItems'));
            console.log(selectedItems);
            let totalPrice = 0;
            let deliveryCharge = 70; // Default delivery charge

            if (selectedItems && selectedItems.length > 0) {
                selectedItems.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('mb-4', 'border-b', 'border-gray-700', 'pb-4');

                    const img = document.createElement('img');
                    img.src = item.image;
                    img.classList.add('w-full', 'h-48', 'object-cover', 'rounded-md', 'mb-4');
                    itemDiv.appendChild(img);

                    const itemDetails = document.createElement('div');
                    itemDetails.innerHTML = `
                        <p class="font-bold text-lg">${item.name}</p>
                        <p class="text-base text-gray-400">Size: ${item.size}</p>
                        <p class="text-base text-gray-400">Quantity: ${item.quantity}</p>
                        <p class="font-bold text-green-400 mt-2">${(item.quantity * item.price).toFixed(2)} BDT</p>
                    `;
                    itemDiv.appendChild(itemDetails);

                    selectedItemsSummary.appendChild(itemDiv);
                    totalPrice += item.quantity * item.price;
                });
                updateTotals();
                document.getElementById('items_name').value = selectedItems.map(item => `${item.name} (Size: ${item.size}) x ${item.quantity}`).join(', ');
            } else {
                selectedItemsSummary.innerHTML = '<p class="text-gray-400">No items selected.</p>';
            }

            const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
            const transactionIdField = document.getElementById('transection_id').parentElement;

            // Hide transaction ID field by default
            transactionIdField.classList.add('hidden');

            paymentMethodRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'cod') {
                        transactionIdField.classList.add('hidden');
                    } else {
                        transactionIdField.classList.remove('hidden');
                    }
                });
            });

            const deliveryLocationRadios = document.querySelectorAll('input[name="delivery_location"]');
            deliveryLocationRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'inside') {
                        deliveryCharge = 70;
                    } else {
                        deliveryCharge = 120;
                    }
                    updateTotals();
                });
            });

            function updateTotals() {
                totalPriceSpan.textContent = `${totalPrice.toFixed(2)} BDT`;
                deliveryChargeSpan.textContent = `${deliveryCharge.toFixed(2)} BDT`;
                const finalTotal = totalPrice + deliveryCharge;
                finalTotalPriceSpan.textContent = `${finalTotal.toFixed(2)} BDT`;
                document.getElementById('total_payment').value = finalTotal.toFixed(2);
            }
        });
    </script>
</body>
</html>