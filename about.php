<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BinaryWare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="about.css">
</head>
<body class="bg-gray-900 text-gray-100">

    <!-- Header -->
    <header class="bg-black bg-opacity-80 backdrop-blur-md sticky top-0 z-50 shadow-lg">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-3xl font-bold text-green-400">
                <a href="home.php">BinaryWare</a>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                
            </div>
            <div class="flex items-center space-x-6">
                <a href="about.php" class="text-green-400 transition-colors duration-300 hidden md:block">ABOUT</a>
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

    <!-- About Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto bg-gray-800 p-8 md:p-12 rounded-lg shadow-lg">
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-8 text-green-400">About BinaryWare</h1>
                <div class="text-lg text-gray-300 leading-relaxed space-y-6">
                    <p>Hello! I'm <span class="text-green-400 font-bold">Morshed Alam Sajin</span>, a BCSE student at <span class="text-green-400 font-bold">IUBAT</span> with a passion for technology, open-source software, and creative design. As a student, I launched <span class="text-green-400 font-bold">BinaryWare</span>, an online store that blends my love for Linux and free software with trendy, high-quality apparel and accessories.</p>
                    <h2 class="text-3xl font-bold text-green-400 pt-6">Why BinaryWare?</h2>
                    <p><span class="text-green-400 font-bold">BinaryWare</span> exists not just as a source of financial stability during my studies but also as a platform to promote the ideals of open-source software. Every product is a statement of support for free software and a celebration of the Linux community.</p>
                    <p>Thank you for supporting this initiative! Together, let's champion free software and spread the love for Linux, one hoodie or cap at a time.</p>
                </div>
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
    <script src="script.js"></script>
</body>
</html>