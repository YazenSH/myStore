<?php
session_start(); //if not already started
require_once '../db/connection.php';

// check if user is admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    include '../includes/header.php';
    ?>
    <div class="error-message">
        <h2>Access Denied</h2>
        <p>You don't have permission to access this page.</p>
        <a href="../index.php" class="btn">Return to Home</a>
    </div>
    <?php
    include '../includes/footer.php';
    exit();
}

include '../includes/header.php';

// Fetch all admins
$admin_query = "SELECT user_ID, name, email FROM users WHERE isAdmin = 1";
$admin_result = $conn->query($admin_query);

// Fetch all products
$product_query = "SELECT * FROM products";
$product_result = $conn->query($product_query);
?>

<!-- Admin Management Section -->
<div class="admin-section">
    <h2>Admin Management</h2>
    <form action="../php_actions/add_admin.php" method="post" class="admin-form" onsubmit="return validateAdminForm()">
        <div class="form-group">
            <input type="text" name="admin_name" placeholder="Name" />
            <input type="email" name="admin_email" placeholder="Email" />
            <input type="password" name="admin_password" placeholder="Password" />
            <button type="submit">Add Admin</button>
        </div>
    </form>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($admin = $admin_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($admin['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <form action="../php_actions/remove_admin.php" method="post">
                            <input type="hidden" name="admin_id" value="<?php echo (int)$admin['user_ID']; ?>" />
                            <button type="submit" class="rm-btn" onclick="return confirm('Remove this admin?')">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Product Management Section -->
<div class="admin-section">
    <h2>Product Management</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $product_result->fetch_assoc()): 
                $product_id = (int)$product['product_ID']; // Cast to integer
                ?>
                <tr>
                    <td><img src="../<?php echo htmlspecialchars($product['image_path'], ENT_QUOTES, 'UTF-8'); ?>" alt="Product" width="50" /></td>
                    <td><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <form action="../php_actions/update_product.php" method="post" class="update-form" onsubmit="return validateProductUpdate('<?php echo $product_id; ?>')">
                        <td>
                            <input type="text" 
                                name="price" 
                                id="price_<?php echo $product_id; ?>" 
                                value="<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>" 
                                class="price-input" />
                        </td>
                        <td>
                            <input type="text" 
                                name="description" 
                                id="description_<?php echo $product_id; ?>" 
                                value="<?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?>" 
                                class="description-input" />
                        </td>
                        <td>
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                            <button type="submit" class="edit-btn">Update</button>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="../js/validation.js" type="text/javascript"></script>

<?php include '../includes/footer.php'; ?>