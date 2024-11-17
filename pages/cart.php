<?php
session_start();
require_once '../db/connection.php';

// Check if user is logged in and not admin
if (!isset($_SESSION['user_id']) || (isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1)) {
    include '../includes/header.php';
    ?>
    <div class="error-message">
        <h2>Access Denied</h2>
        <p><?php 
            if(!isset($_SESSION['user_id'])) {
                echo "Please login to view your cart.";
            } else {
                echo "Admins don't have access to cart functionality.";
            }
        ?></p>
        <a href="<?php echo !isset($_SESSION['user_id']) ? 'login.php' : '../index.php'; ?>" class="btn">
            <?php echo !isset($_SESSION['user_id']) ? 'Login' : 'Return to Home'; ?>
        </a>
    </div>
    <?php
    include '../includes/footer.php';
    exit();
}

include '../includes/header.php';

// Rest of your cart code
$user_id = $_SESSION['user_id'];
$cart_query = "SELECT c.*, p.name, p.price, p.image_path 
               FROM cart c 
               JOIN products p ON c.product_ID = p.product_ID 
               WHERE c.user_ID = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_result = $stmt->get_result();
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
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo ($i == $item['quantity']) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
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