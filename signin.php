<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - BinaryWare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="signIn.css">
    <style>
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .success-message {
            color: green;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">

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

    <!-- Sign In Form Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-12 text-green-400">Create Your Account</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="max-w-lg mx-auto bg-red-500 p-4 rounded-lg shadow-lg text-white text-center">
                    <?php 
                        echo $_SESSION['error']; 
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="max-w-lg mx-auto bg-green-500 p-4 rounded-lg shadow-lg text-white text-center">
                    <?php 
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>
            <?php unset($_SESSION['form_data']); ?>
            <form class="max-w-md mx-auto bg-gray-800 p-8 rounded-lg shadow-lg" action="bak.signin.php" method="POST" onsubmit="return validateForm()">
                <div class="mb-4">
                    <label for="name" class="block text-green-400 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required value="<?php echo isset($_SESSION['form_data']['name']) ? htmlspecialchars($_SESSION['form_data']['name']) : ''; ?>">
                    <span id="name-error" class="error-message"></span>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-green-400 font-bold mb-2">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
                    <span id="email-error" class="error-message"></span>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-green-400 font-bold mb-2">Phone Number</label>
                    <div class="flex">
                        <input type="tel" id="phone" name="phone" value="+880<?php echo isset($_SESSION['form_data']['phone']) ? htmlspecialchars($_SESSION['form_data']['phone']) : ''; ?>" class="w-full bg-gray-700 text-white rounded-r-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <span id="phone-error" class="error-message"></span>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-green-400 font-bold mb-2">Present Address</label>
                    <input type="text" id="address" name="address" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required value="<?php echo isset($_SESSION['form_data']['address']) ? htmlspecialchars($_SESSION['form_data']['address']) : ''; ?>">
                    <span id="address-error" class="error-message"></span>
                </div>
                <div class="mb-4">
                    <label for="education" class="block text-green-400 font-bold mb-2">Current Education</label>
                    <input type="text" id="education" name="education" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required value="<?php echo isset($_SESSION['form_data']['education']) ? htmlspecialchars($_SESSION['form_data']['education']) : ''; ?>">
                    <span id="education-error" class="error-message"></span>
                    <?php if (isset($_SESSION['education_error'])): ?>
                        <span class="error-message"><?php echo $_SESSION['education_error']; unset($_SESSION['education_error']); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                    <label for="linux-distro" class="block text-green-400 font-bold mb-2">Favorite Linux Distro</label>
                    <input type="text" id="linux-distro" name="linux-distro" value="ARCH" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required value="<?php echo isset($_SESSION['form_data']['linux-distro']) ? htmlspecialchars($_SESSION['form_data']['linux-distro']) : ''; ?>">
                    <span id="linux-distro-error" class="error-message"></span>
                    <?php if (isset($_SESSION['linux_distro_error'])): ?>
                        <span class="error-message"><?php echo $_SESSION['linux_distro_error']; unset($_SESSION['linux_distro_error']); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-green-400 font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full bg-gray-700 text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <span id="password-error" class="error-message"></span>
                </div>
                <div class="mt-8">
                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-md">Sign In</button>
                </div>
                <div class="text-center mt-4">
                    <p class="text-gray-400">Already have an account? <a href="login.php" class="text-green-400 hover:underline">Login</a></p>
                </div>
            </form>

         
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black pt-12 pb-8">
        <div class="container mx-auto px-6 text-center text-gray-400">
            <p>&copy; 2025 BinaryWare. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
    <script src="signin.js"></script>

</body>
</html>