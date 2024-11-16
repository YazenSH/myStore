<?php 
include '../includes/header.php';
include '../db/connection.php';

// Check if user is logged in and not admin
if (!isset($_SESSION['user_id']) || (isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1)) {
    header("Location: ../index.php");
    exit();
}

// Fetch cart items
$user_id = $_SESSION['user_id'];
//this query will be explained in the documentation
$cart_query = "SELECT c.*, p.name, p.price, p.image_path 
               FROM cart c 
               JOIN products p ON c.product_ID = p.product_ID 
               WHERE c.user_ID = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_result = $stmt->get_result();
//for each row the result is an associative array that contains the product details
$cartItems = $cart_result->fetch_all(MYSQLI_ASSOC);
$total = 0;
?>

<div class="container">
    <h2>Shopping Cart</h2>
    <div class="cart-container">
        <?php if(empty($cartItems)): ?>
            <div class="empty-cart">
                <p>Your cart is empty</p>
                <a href="products.php" class="btn">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach($cartItems as $item): 
                // to show the total
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <!-- here we will show each item with image, name, quantity, price -->
                    <div class="cart-item">
                        <img src="../<?php echo $item['image_path']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image">
                        <div class="cart-item-details">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p class="price"><?php echo number_format($item['price'], 2); ?> SR</p>
                        </div>
                <!-- This form to update the quantity of the item -->
                        <form action="../php_actions/update_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_ID']; ?>">
                            <select name="quantity" onchange="this.form.submit()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </form>
                <!-- This form to remove the item from the cart -->
                        <form action="../php_actions/remove_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_ID']; ?>">
                            <button type="submit" class="remove-btn" onclick="return confirm('Remove this item?')">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>
                <!-- here we will show the total -->
                <div class="cart-summary">
                    <div class="subtotal">
                        <span>Total:</span>
                        <span><?php echo number_format($total, 2); ?> SR</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>