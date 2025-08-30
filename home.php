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
                <?php if (isset($_SESSION['user_id'])):
                 ?>
                    <a href="logout.php" id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Out</a>
                <?php else: ?>
                    <a href="signup.php" id="signin-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded hidden md:inline-block">Sign Up</a>
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
            <?php if (isset($_SESSION['user_id'])):
                 ?>
                <a href="logout.php" class="block mx-6 my-2 text-center text-sm bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Sign Out</a>
            <?php else: ?>
                <a href="signup.php" class="block mx-6 my-2 text-center text-sm bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Sign Up</a>
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
            <div class="mt-8 bg-green-500 text-white py-4 px-8 rounded-lg inline-block shadow-lg">
                <p class="text-xl font-bold">Pre-order is up till Oct-31, and get 20% discount in each product.</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <?php
            // Product data array
            $products = [
                [
                    'name' => 'free_for_freedom',
                    'image' => 'assets/FREE_FOR_FREEDOM.png',
                    'price' => 599,
                    'stock' => 10,
                    'colors' => [
                        ['color' => '#ffffff', 'stock' => 10],
                        ['color' => '#8c00bf', 'stock' => 10],
                        ['color' => '#00ff00', 'stock' => 0]
                    ]
                ],
                [
                    'name' => 'free_for_freedom_man',
                    'image' => 'assets/FREE_FOR_FREEDOM_MAN.jpg',
                    'price' => 599,
                    'stock' => 10,
                    'colors' => [
                        ['color' => '#1793d1', 'stock' => 10],
                        ['color' => '#ffffff', 'stock' => 10],
                        ['color' => '#808080', 'stock' => 0]
                    ]
                ],
                [
                    'name' => 'I_USE_ARCH_BTW',
                    'image' => 'assets/I_USE_ARCH_BTW.jpg',
                    'price' =>699,
                    'stock' => 10,
                    'colors' => [
                        ['color' => '#000000', 'stock' => 0],
                        ['color' => '#ffffff', 'stock' => 10],
                        ['color' => '#1793d1', 'stock' => 0]
                    ]
                ],
                [
                    'name' => 'vim_no_looking_back',
                    'image' => 'assets/VIM.png',
                    'price' => 450,
                    'stock' => 10, // This item is out of stock
                    'colors' => [
                        ['color' => '#000000', 'stock' => 10],
                        ['color' => '#ffffff', 'stock' => 0],
                        ['color' => '#019833', 'stock' => 0]
                    ]
                ]
            ];
            ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                <?php foreach ($products as $product): ?>
                    <div class="product-card rounded-lg overflow-hidden shadow-lg hover:shadow-<?php echo ($product['stock'] > 0) ? 'green' : 'red'; ?>-500/50 transition-shadow duration-300 group">
                        <div class="overflow-hidden">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500 previewable">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2"><?php echo $product['name']; ?></h3>
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-green-400 text-lg font-bold"><?php echo number_format($product['price'] * 0.8, 2); ?> BDT <span class="text-gray-500 line-through ml-2"><?php echo number_format($product['price'], 2); ?> BDT</span></p>
                                <?php if (isset($product['colors'])):
                                 ?>
                                    <div class="flex space-x-2">
                                        <?php foreach ($product['colors'] as $index => $color_data): ?>
                                            <?php if ($color_data['stock'] > 0): ?>
                                                <label class="relative">
                                                    <input type="radio" class="absolute opacity-0 h-0 w-0 product-color" name="color-<?php echo $product['name']; ?>" value="<?php echo $color_data['color']; ?>" <?php echo ($index === 0) ? 'checked' : ''; ?>>
                                                    <div class="w-6 h-6 rounded-full border-2 border-gray-600 cursor-pointer" style="background-color: <?php echo $color_data['color']; ?>;"></div>
                                                </label>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center justify-between">
                                <select class="bg-gray-700 text-white rounded-md px-2 py-1 product-size">
                                    <option selected disabled>Size</option>
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                    <option>XXL</option>
                                </select>
                                <input type="number" class="bg-gray-700 text-white rounded-md px-2 py-1 w-20 product-quantity" value="1" min="1" data-stock="<?php echo $product['stock']; ?>">
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <?php if ($product['stock'] > 0): ?>
                                    <span class="text-green-500 font-bold stock-status">Available</span>
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600 product-select" data-product-name="<?php echo htmlspecialchars($product['name']); ?>" data-price="<?php echo $product['price'] * 0.8; ?>">
                                <?php else: ?>
                                    <span class="text-red-500 font-bold stock-status">Out of Stock</span>
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600 product-select" data-product-name="<?php echo htmlspecialchars($product['name']); ?>" data-price="<?php echo $product['price'] * 0.8; ?>" disabled>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
    <!-- Image Preview Modal -->
    <div id="image-preview-modal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-80 hidden justify-center items-center z-50">
        <span class="absolute top-5 right-10 text-white text-4xl font-bold cursor-pointer bg-gray-800 rounded-full p-2" id="close-modal">&times;</span>
        <div class="bg-white rounded-lg shadow-lg img-zoom-container">
            <img class="max-w-full max-h-full mx-auto" id="modal-image" src="">
        </div>
        <div id="zoom-result" class="img-zoom-result"></div>
    </div>
</body>
</html>
