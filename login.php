<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BinaryWare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body class="bg-gray-900 text-gray-100">

    <div id="alert-container" style="position: fixed; top: 20px; left: 20px; z-index: 1000;"></div>

    <!-- Header -->
    <header class="bg-black bg-opacity-80 backdrop-blur-md sticky top-0 z-50 shadow-lg">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Left: Logo -->
            <div class="text-3xl font-bold text-green-400 flex-grow">
                <a href="home.php">BinaryWare</a>
            </div>

            <!-- Right: Search, Cart, Profile/Login -->
            <div class="flex items-center space-x-6 flex-grow justify-end">
                <a href="about.php" class="hover:text-green-400 transition-colors duration-300 hidden md:block">ABOUT</a>
                <div class="relative hidden md:block">
                    <input type="text" id="search-bar" placeholder="Search..." class="bg-gray-700 text-white rounded-md pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 w-48">
                    <i class="fas fa-search fa-lg absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Out</a>
                <?php else: ?>
                    <a href="signin.php" id="signin-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign In</a>
                    <a href="login.php" id="login-btn" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Login</a>
                <?php endif; ?>
                <button id="menu-btn" class="md:hidden text-2xl"><i class="fas fa-bars"></i></button>
                <a href="profile.php" class="hover:text-green-400 transition-colors duration-300"><i class="fas fa-user-circle fa-lg"></i></a>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-black bg-opacity-90">
            <a href="about.php" class="block px-6 py-3 text-sm hover:bg-gray-800 transition-colors duration-300">ABOUT</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="block mx-6 my-2 text-center text-sm bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Sign Out</a>
            <?php else: ?>
                <a href="signin.php" class="block mx-6 my-2 text-center text-sm bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Sign In</a>
                <a href="login.php" class="block mx-6 my-2 text-center text-sm bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Login Form Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-12 text-green-400">Login to Your Account</h2>
            <div class="max-w-md mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
                <form action="bak.login.php" method="POST">
                    <div class="mb-4">
                        <label for="email_or_phone" class="block text-green-400 font-bold mb-2">Email or Phone Number</label>
                        <input type="text" id="email" name="email" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-green-400 font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-md">Login</button>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-400">Don't have an account? <a href="signin.php" class="text-green-400 hover:underline">Sign up</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black pt-12 pb-8">
        <div class="container mx-auto px-6 text-center text-gray-400">
            <p>&copy; 2025 BinaryWare. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        <?php if (isset($_SESSION['success'])): ?>
            const alertContainer = document.getElementById('alert-container');
            alertContainer.innerHTML = `
                <div style="background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                    <?php echo $_SESSION['success']; ?>
                </div>
            `;
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000); // Hide after 5 seconds
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </script>

</body>
</html>