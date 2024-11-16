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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $page_titles[$current_page] ?? 'Photography Store'; ?></title>
    <link rel="stylesheet" href="../css/global.css">
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
                <li><a href="../index.php">Main Page</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="video.php">Video</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="resume.php">Resume</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <!-- This will be closed in the start of the footer so everything wraped between header and footer will be in the container -->
    <div class="container">