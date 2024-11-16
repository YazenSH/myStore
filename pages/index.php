<?php 
include '../includes/header.php';
// include '../db/connection.php';

// // Fetch only first 3 products
// $product_query = "SELECT * FROM products ORDER BY product_ID DESC LIMIT 3";
// $product_result = $conn->query($product_query);
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

<!-- Featured Products
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
</section> -->

<?php include '../includes/footer.php'; ?>