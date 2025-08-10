<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaryWare - Premium Tech Apparel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
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
                
                <a href="order.php" id="order-now-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Order Now</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Out</a>
                <?php else: ?>
                    <a href="signin.php" id="signin-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign In</a>
                    <a href="login.php" id="login-btn" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Login</a>
                <?php endif; ?>
                <button id="menu-btn" class="md:hidden text-2xl"><i class="fas fa-bars"></i></button>
                <input type="hidden" id="user-id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>">
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

    <!-- Hero Section -->
    <section class="hero-section text-center py-24 px-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto relative z-10">
            <h1 class="text-6xl font-extrabold tracking-tighter text-green-400">GEAR FOR THE DIGITAL AGE</h1>
            <p class="mt-6 max-w-3xl mx-auto text-lg text-gray-300">High-performance apparel for developers, hackers, and tech innovators.</p>
            <a href="#" class="mt-10 inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-10 rounded-full transition-transform duration-300 transform hover:scale-105">
                EXPLORE COLLECTION
            </a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12 text-green-400">Featured Gear</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                <!-- Product 1: I Use Arch Btw -->
                <div class="product-card rounded-lg overflow-hidden shadow-lg hover:shadow-green-500/50 transition-shadow duration-300 group">
                    <div class="overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Faded Black T-Shirt with text I Use Arch Btw" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2">"I Use Arch Btw" Tee</h3>
                        <p class="text-green-400 text-lg">450 BDT</p>
                        <div class="mt-4 flex items-center justify-between">
                            <select class="bg-gray-700 text-white rounded-md px-2 py-1 product-size">
                                <option selected disabled>Size</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                            </select>
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600 product-select" data-product-name="I Use Arch Btw Tee">
                        </div>
                    </div>
                </div>
                <!-- Product 2: Sudo Make Me a Sandwich -->
                <div class="product-card rounded-lg overflow-hidden shadow-lg hover:shadow-green-500/50 transition-shadow duration-300 group">
                    <div class="overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Faded Blue T-Shirt with text Sudo Make Me a Sandwich" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2">"Sudo Sandwich" Tee</h3>
                        <p class="text-green-400 text-lg">450 BDT</p>
                        <div class="mt-4 flex items-center justify-between">
                            <select class="bg-gray-700 text-white rounded-md px-2 py-1 product-size">
                                <option selected disabled>Size</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                            </select>
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600 product-select" data-product-name="Sudo Sandwich Tee">
                        </div>
                    </div>
                </div>
                <!-- Product 3: There's No Place Like ~ -->
                <div class="product-card rounded-lg overflow-hidden shadow-lg hover:shadow-green-500/50 transition-shadow duration-300 group">
                    <div class="overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=1915&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Faded Gray T-Shirt with text There's No Place Like ~" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2">"No Place Like ~" Tee</h3>
                        <p class="text-green-400 text-lg">450 BDT</p>
                        <div class="mt-4 flex items-center justify-between">
                            <select class="bg-gray-700 text-white rounded-md px-2 py-1 product-size">
                                <option selected disabled>Size</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                            </select>
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600 product-select" data-product-name="No Place Like ~ Tee">
                        </div>
                    </div>
                </div>
                <!-- Product 4: It Works On My Machine -->
                <div class="product-card rounded-lg overflow-hidden shadow-lg hover:shadow-green-500/50 transition-shadow duration-300 group">
                    <div class="overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=1915&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Faded White T-Shirt with text It Works On My Machine" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2">"It Works On My Machine" Tee</h3>
                        <p class="text-green-400 text-lg">450 BDT</p>
                        <div class="mt-4 flex items-center justify-between">
                            <select class="bg-gray-700 text-white rounded-md px-2 py-1 product-size">
                                <option selected disabled>Size</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                            </select>
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600 product-select" data-product-name="It Works On My Machine Tee">
                        </div>
                    </div>
                </div>
                <!-- Product 5: rm -rf / -->
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