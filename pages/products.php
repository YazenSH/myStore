<?php include '../includes/header.php'; ?>
<?php include '../db/connection.php'; ?>

<h2>Our Products</h2>
<div class="product-grid">
    <?php
    // Fetch products from the database
    $product_query = "SELECT * FROM products";
    $product_result = $conn->query($product_query);

    if ($product_result && $product_result->num_rows > 0):
        while ($product = $product_result->fetch_assoc()): 
            $image_path = htmlspecialchars($product['image_path']);
            $product_name = htmlspecialchars($product['name']);
            $product_price = number_format($product['price'], 2);
            //for adding the product to the cart
            $product_id = $product['product_ID'];
            ?>
            <div class="product-item">
                <img src="../<?php echo $image_path; ?>" alt="<?php echo $product_name; ?>" class="product-image"/>
                <p><?php echo $product_name; ?></p>
                <p class="price"><?php echo $product_price; ?> SR</p>

                <?php if(!isset($_SESSION['user_id'])): ?>
                    <a href="login.php" class="add-to-cart-btn">Login to Buy</a>
                <?php elseif(isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1): ?>
                    <button class="add-to-cart-btn" onclick="alert('Admins cannot add items to cart')">Add to Cart</button>
                <?php else: ?>
                    <form action="../php_actions/add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile;
    else :?>
        <p>No products available.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
