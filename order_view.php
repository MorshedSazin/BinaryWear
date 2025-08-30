<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaryWare - View Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="order_view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <a href="profile.php" class="hover:text-green-400 transition-colors duration-300"><i class="fas fa-user-circle fa-lg"></i></a>
            </div>
        </nav>
    </header>

    <!-- Order View Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-12 text-green-400">All Orders</h2>
            <div class="bg-gray-800 p-4 sm:p-8 rounded-lg shadow-lg">
                <div class="flex flex-col sm:flex-row justify-end mb-4">
                    <input type="date" id="search-date" class="bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 mb-2 sm:mb-0 sm:mr-2">
                    <button id="search-button" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-2 sm:mb-0 sm:mr-2">Search</button>
                    <button id="clear-button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Clear</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left responsive-table">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="p-4">Order ID</th>
                                <th class="p-4">Name</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Phone</th>
                                <th class="p-4">Total Payment</th>
                                <th class="p-4">Payment Date</th>
                                <th class="p-4">Transaction ID</th>
                                <th class="p-4">Items</th>
                            </tr>
                        </thead>
                        <tbody id="orders-table-body">
                            <tr>
                                <td colspan="8" class="text-center p-8">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ordersTableBody = document.getElementById('orders-table-body');
            const searchButton = document.getElementById('search-button');
            const clearButton = document.getElementById('clear-button');
            const searchDateInput = document.getElementById('search-date');

            function fetchOrders(date = '') {
                let url = 'bak.order_view.php';
                if (date) {
                    url += `?date=${date}`;
                }

                ordersTableBody.innerHTML = `<tr><td colspan="8" class="text-center p-8">Loading...</td></tr>`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        ordersTableBody.innerHTML = ''; // Clear loading message

                        if (data.error) {
                            ordersTableBody.innerHTML = `<tr><td colspan="8" class="text-center p-8 text-red-500">${data.error}</td></tr>`;
                            return;
                        }

                        if (data.length === 0) {
                            ordersTableBody.innerHTML = `<tr><td colspan="8" class="text-center p-8">No orders found.</td></tr>`;
                            return;
                        }

                        data.forEach(order => {
                            const row = document.createElement('tr');
                            row.classList.add('border-b', 'border-gray-700');

                            row.innerHTML = `
                                <td class="p-4" data-label="Order ID">${order.ORDER_ID}</td>
                                <td class="p-4" data-label="Name">${order.NAME}</td>
                                <td class="p-4" data-label="Email">${order.EMAIL}</td>
                                <td class="p-4" data-label="Phone">${order.PHONE}</td>
                                <td class="p-4" data-label="Total Payment">${order.TOTAL_PAYMENT} BDT</td>
                                <td class="p-4" data-label="Payment Date">${order.PAYMENT_DATE}</td>
                                <td class="p-4" data-label="Transaction ID">${order.TRANSACTION_ID}</td>
                                <td class="p-4" data-label="Items">${order.ITEMS_NAME}</td>
                            `;

                            ordersTableBody.appendChild(row);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching orders:', error);
                        ordersTableBody.innerHTML = `<tr><td colspan="8" class="text-center p-8 text-red-500">An error occurred while fetching the orders.</td></tr>`;
                    });
            }

            // Initial fetch
            fetchOrders();

            searchButton.addEventListener('click', function() {
                const searchDate = searchDateInput.value;
                fetchOrders(searchDate);
            });

            clearButton.addEventListener('click', function() {
                searchDateInput.value = '';
                fetchOrders();
            });
        });
    </script>
</body>
</html>
