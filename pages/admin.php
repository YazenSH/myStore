<?php
include '../includes/header.php'; // Ensure header.php starts properly with <html> and <body>.
include '../db/connection.php';

// Must be admin to access this page
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0) {
    header("Location: ../index.php");
    exit();
}

// Fetch all admins
$admin_query = "SELECT user_ID, name, email FROM users WHERE isAdmin = 1";
$admin_result = $conn->query($admin_query);

// Fetch all products
$product_query = "SELECT * FROM products";
$product_result = $conn->query($product_query);
?>

<div class="container">
    <!-- Admin Management Section -->
    <section class="admin-section">
        <h2>Admin Management</h2>
        <!-- Form to Add New Admin -->
        <form action="../php_actions/add_admin.php" method="POST" class="admin-form" onsubmit="return validateAdminForm()">
            <div class="form-group">
                <input type="text" name="admin_name" placeholder="Name" />
                <input type="email" name="admin_email" placeholder="Email" />
                <input type="password" name="admin_password" placeholder="Password" />
                <button type="submit">Add Admin</button>
            </div>
        </form>

        <!-- Table to Display All Admins -->
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
                        <td><?php echo htmlspecialchars($admin['name']); ?></td>
                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                        <td>
                            <form action="../php_actions/remove_admin.php" method="post">
                                <input type="hidden" name="admin_id" value="<?php echo $admin['user_ID']; ?>">
                                <button type="submit" onclick="return confirm('Remove this admin?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <!-- Product Management Section -->
    <section class="admin-section">
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
                <?php while ($product = $product_result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="../<?php echo htmlspecialchars($product['image_path']); ?>" alt="Product" width="50" /></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>
                            <form action="../php_actions/update_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product['product_ID']; ?>" />
                                <input type="number" name="price" value="<?php echo $product['price']; ?>" required />
                        </td>
                        <td>
                                <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" required />
                        </td>
                        <td>
                                <button type="submit" class="edit-btn">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</div>

<script src="../js/validation.js" type="text/javascript"></script>

<?php include '../includes/footer.php'; ?>
