<?php
session_start();

// Get current page name for title
//$_server is a super global variable which holds information about headers, paths, and script locations.
//$_server['PHP_SELF'] returns the current script name being executed.
//basename() function returns the filename component of a path.
$current_page = basename($_SERVER['PHP_SELF']);
$page_titles = [
    'index.php' => 'Photography Store',
    'products.php' => 'Products - Photography Store',
    'services.php' => 'Services - Photography Store',
    'gallery.php' => 'Gallery - Photography Store',
    'video.php' => 'Videos - Photography Store',
    'schedule.php' => 'Schedule - Photography Store',
    'resume.php' => 'Resume - Photography Store',
    'feedback.php' => 'Feedback - Photography Store',
    'aboutUs.php' => 'About Us - Photography Store',
    'contact.php' => 'Contact Us - Photography Store',
    'signup.php' => 'Sign Up - Photography Store',
    'login.php' => 'Login - Photography Store',
    'admin.php' => 'Admin Panel - Photography Store',
    'cart.php' => 'Cart - Photography Store',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_titles[$current_page] ?? 'Photography Store'; ?></title>
    <link rel="stylesheet" href="../global.css">
    <link rel="icon" href="../Images/Logo.png" type="image/png">
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <img src="../Images/Logo.png" alt="Photography Store Logo" class="logo">
            <h1 class="header_name">Welcome to Photography Store</h1>
            <div class="user-nav">
                <!-- Check if user is logged in or admin or guest, and shows the correct nav bar element -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1): ?>
                        <a href="admin.php" class="nav-btn">Control Panel</a>
                    <?php else: ?>
                        <a href="cart.php" class="nav-btn">Cart</a>
                    <?php endif; ?>
                    <a href="../php_actions/process_logout.php" class="nav-btn">Log Out</a>
                <?php else: ?>
                    <a href="login.php" class="nav-btn">Login</a>
                <?php endif; ?>
            </div>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="index.php">Main Page</a></li>
                <li><a href="./pages/services.php">Services</a></li>
                <li><a href="./pages/products.php">Products</a></li>
                <li><a href="./pages/gallery.php">Gallery</a></li>
                <li><a href="./pages/video.php">Video</a></li>
                <li><a href="./pages/schedule.php">Schedule</a></li>
                <li><a href="./pages/resume.php">Resume</a></li>
                <li><a href="./pages/feedback.php">Feedback</a></li>
                <li><a href="./pages/aboutUs.php">About Us</a></li>
                <li><a href="./pages/contact.php">Contact Us</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <!-- This will be closed in the start of the footer so everything wraped between header and footer will be in the container -->
    <div class="container">



<?php 
include '../db/connection.php';

// Fetch only first 3 products
$product_query = "SELECT * FROM products ORDER BY product_ID DESC LIMIT 3";
$product_result = $conn->query($product_query);
?>

<!-- Introduction section -->
<section class="intro box">
    <p>
        At <strong>Photography Store</strong>, we provide the latest and best photography equipment
        to help you capture every moment with precision. Explore our wide range of
        cameras, lenses, tripods, and accessories.
    </p>
    <blockquote>
        "Photography is the story I fail to put into words."<cite> – Destin Sparks</cite>
    </blockquote>
</section>

<!-- Problem Definition Section -->
<section class="problem-definition box">
    <h2>Problem Definition</h2>
    <p>
        Finding the right photography equipment can be overwhelming due to the wide range of options and lack of
        clear information. Customers often struggle to make informed decisions. Photography Store aims to solve
        this by providing a user-friendly platform with detailed product descriptions. Our goal is to simplify
        the process of purchasing photography gear and offer guidance to both beginners and professionals.
    </p>
    <h2>Recommended solution</h2>
    <p>
        I found out that the most effective solution is to create an online platform for selling high-quality
        photography equipment and accessories.
    </p>
    <h2>Benefits of the solution</h2>
    <ul>
        <li>The platform will provide an easy-to-navigate site for photographers of all levels to browse
            and purchase the latest gear.</li>
        <li>Ensuring that customers can find everything they need, from cameras to tripods, in one place.</li>
        <li>It will also help customers make informed purchasing decisions based on their photography needs.</li>
    </ul>
</section>

<!-- Featured Products -->
<section class="featured">
    <h2>Featured Products</h2>
    <div class="product-row">
        <?php while($product = $product_result->fetch_assoc()): ?>
            <div class="product-item">
                <img src="../<?php echo $product['image_path']; ?>" 
                     alt="<?php echo htmlspecialchars($product['name']); ?>" 
                     class="product-image">
                <p><?php echo htmlspecialchars($product['name']); ?></p>
                <p class="price"><?php echo number_format($product['price'], 2); ?> SR</p>
                
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <a href="login.php" class="add-to-cart-btn">Login to Buy</a>
                <?php elseif(isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1): ?>
                    <button class="add-to-cart-btn" onclick="alert('Admins cannot add items to cart')">Add to Cart</button>
                <?php else: ?>
                    <form action="../php_actions/add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_ID']; ?>">
                        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include './includes/footer.php'; ?>