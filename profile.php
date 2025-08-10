<?php require 'bak.profile.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - BinaryWare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
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
                    <a href="logout.php" id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Out</a>
                    <a href="profile.php" class="text-green-400 transition-colors duration-300"><i class="fas fa-user-circle fa-lg"></i></a>
                <button id="menu-btn" class="md:hidden text-2xl"><i class="fas fa-bars"></i></button>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-black bg-opacity-90">
            
            <a href="about.html" class="block px-6 py-3 text-sm hover:bg-gray-800 transition-colors duration-300">ABOUT</a>
            <a href="logout.php" class="block mx-6 my-2 text-center text-sm bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Sign Out</a>
        </div>
    </header>

    <!-- Profile Section -->
    <main class="container mx-auto px-6 py-16">
        <div class="max-w-4xl mx-auto bg-gray-800 rounded-lg shadow-lg overflow-hidden md:flex">
            <!-- Left Sidebar -->
            <div class="md:w-1/3 bg-gray-800 p-8 flex flex-col items-center">
                <img src="https://via.placeholder.com/150" alt="Profile Picture" class="rounded-full border-4 border-green-400 w-32 h-32">
                <h2 class="text-2xl font-bold mt-4"><?php echo htmlspecialchars($user_data['NAME']); ?></h2>
                <p class="text-sm text-gray-400">ID: <?php echo htmlspecialchars($user_data['SL']); ?></p>
                
            </div>

            <!-- Right Content -->
            <div class="md:w-2/3 p-8">
                <!-- Contact Information -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-green-400">Contact Information</h3>
                        <button id="edit-button" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm transition-colors duration-300">
                            <i class="fas fa-pencil-alt mr-2"></i>Edit
                        </button>
                        <button id="save-button" type="submit" form="profile-form" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm transition-colors duration-300 hidden">
                            <i class="fas fa-save mr-2"></i>Save
                        </button>
                        <button id="cancel-button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded text-sm transition-colors duration-300 hidden ml-2">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                    <form id="profile-form" action="update_profile.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <div id="address-display">
                                <label class="text-gray-400">Present Address</label>
                                <p id="display-address"><?php echo htmlspecialchars($user_data['PRESENT_ADDRESS']); ?></p>
                            </div>
                            <div id="address-edit" class="hidden">
                                <label for="edit-address" class="text-gray-400">Present Address</label>
                                <input type="text" id="edit-address" name="PRESENT_ADDRESS" value="<?php echo htmlspecialchars($user_data['PRESENT_ADDRESS']); ?>" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                        <div>
                            <div id="linux-distro-display">
                                <label class="text-gray-400">Favorite Linux Distro</label>
                                <p id="display-linux-distro"><?php echo htmlspecialchars($user_data['FAVORITE_LINUX_DISTRO']); ?></p>
                            </div>
                            <div id="linux-distro-edit" class="hidden">
                                <label for="edit-linux-distro" class="text-gray-400">Favorite Linux Distro</label>
                                <input type="text" id="edit-linux-distro" name="FAVORITE_LINUX_DISTRO" value="<?php echo htmlspecialchars($user_data['FAVORITE_LINUX_DISTRO']); ?>" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                        <div>
                            <div id="email-display">
                                <label class="text-gray-400">Email</label>
                                <p id="display-email"><?php echo htmlspecialchars($user_data['EMAIL']); ?></p>
                            </div>
                            <div id="email-edit" class="hidden">
                                <label for="edit-email" class="text-gray-400">Email</label>
                                <input type="email" id="edit-email" name="EMAIL" value="<?php echo htmlspecialchars($user_data['EMAIL']); ?>" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                        <div>
                            <div id="phone-display">
                                <label class="text-gray-400">Mobile Number</label>
                                <p id="display-phone"><?php echo htmlspecialchars($user_data['PHONE']); ?></p>
                            </div>
                            <div id="phone-edit" class="hidden">
                                <label for="edit-phone" class="text-gray-400">Mobile Number</label>
                                <input type="tel" id="edit-phone" name="PHONE" value="<?php echo htmlspecialchars($user_data['PHONE']); ?>" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Order History -->
                <div class="mt-10">
                    <h3 class="text-xl font-bold text-green-400 mb-4">Order History</h3>
                    <div class="space-y-4">
                        <!-- Order Item 1 -->
                        <div class="bg-gray-700 p-4 rounded-lg flex justify-between items-center">
                            <div>
                                <p class="font-bold">Order #12345</p>
                                <p class="text-xs text-gray-400">Date: 2025-08-01</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-400">$50.00</p>
                                <p class="text-xs text-blue-400">Completed</p>
                            </div>
                        </div>
                        <!-- Order Item 2 -->
                        <div class="bg-gray-700 p-4 rounded-lg flex justify-between items-center">
                            <div>
                                <p class="font-bold">Order #12346</p>
                                <p class="text-xs text-gray-400">Date: 2025-08-05</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-400">$75.00</p>
                                <p class="text-xs text-yellow-400">Shipped</p>
                            </div>
                        </div>
                        <!-- Order Item 3 -->
                        <div class="bg-gray-700 p-4 rounded-lg flex justify-between items-center">
                            <div>
                                <p class="font-bold">Order #12347</p>
                                <p class="text-xs text-gray-400">Date: 2025-08-07</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-400">$120.00</p>
                                <p class="text-xs text-red-400">Processing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black pt-12 pb-8 mt-16">
        <div class="container mx-auto px-6 text-center text-gray-400">
            <p>&copy; 2025 BinaryWare. All Rights Reserved.</p>
            <p class="text-sm mt-2 opacity-50">POWERED BY THE GRID</p>
        </div>
    </footer>

<script src="script.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButton = document.getElementById('edit-button');
        const saveButton = document.getElementById('save-button');
        const cancelButton = document.getElementById('cancel-button');
        const profileForm = document.getElementById('profile-form');

        const fields = ['address', 'linux-distro', 'email', 'phone']; // IDs of the fields

        function toggleEditMode(isEditMode) {
            fields.forEach(field => {
                const displayElement = document.getElementById(field + '-display');
                const editElement = document.getElementById(field + '-edit');

                if (displayElement && editElement) {
                    if (isEditMode) {
                        displayElement.classList.add('hidden');
                        editElement.classList.remove('hidden');
                    } else {
                        displayElement.classList.remove('hidden');
                        editElement.classList.add('hidden');
                    }
                }
            });

            if (isEditMode) {
                editButton.classList.add('hidden');
                saveButton.classList.remove('hidden');
                cancelButton.classList.remove('hidden');
            } else {
                editButton.classList.remove('hidden');
                saveButton.classList.add('hidden');
                cancelButton.classList.add('hidden');
            }
        }

        editButton.addEventListener('click', function() {
            toggleEditMode(true);
        });

        cancelButton.addEventListener('click', function() {
            toggleEditMode(false);
            // Optionally reset form fields to original values here if needed
            // For now, just revert visibility
        });

        // Save button will submit the form, handled by form's action
    });
</script>

</body>
</html>