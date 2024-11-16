<?php
include '../includes/header.php';
include '../db/connection.php';

//must be admin to access this page
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin']==0) {
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
    <section class="admin-section">
        <h2>Admin Management</h2>
        <!-- This for is used to add new admin -->    
        <form action="../php_actions/add_admin.php" method="POST" class="admin-form" onsubmit="return validateAdminForm()">
            <div class="form-group">
                <input type="text" name="admin_name" placeholder="Name" >
                <input type="email" name="admin_email" placeholder="Email" >
                <input type="password" name="admin_password" placeholder="Password" >
                <button type="submit">Add Admin</button>
            </div>
        </form>
        <!-- This table is used to display all admins and remove them -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
                
            <tbody>
                <?php while($admin = $admin_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($admin['name']); ?></td>
                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                        <td>
                            <form action="../php_actions/remove_admin.php" method="POST">
                                <input type="hidden" name="admin_id" value="<?php echo $admin['user_ID']; ?>">
                                <button type="submit" onclick="return confirm('Remove this admin?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <!-- Product Management -->
    <section class="admin-section">
        <h2>Product Management</h2>
        
    <!-- Add Product Form -->
        <form action="../php_actions/add_product.php" method="POST" enctype="multipart/form-data" class="admin-form" onsubmit="return validateProductForm()">
            <div class="form-group">
                <input type="text" name="name" placeholder="Product Name" >
                <input type="number" name="price" placeholder="Price" >
                <input type="text" name="description" placeholder="Description" >
                <input type="file" name="image" >
                <button type="submit">Add Product</button>
            </div>
        </form>

    <!-- This table is used to display all products and remove them -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($product = $product_result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="../<?php echo $product['image_path']; ?>" alt="Product" width="50"></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                        <td>
                            <form action="../php_actions/remove_product.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['product_ID']; ?>">
                                <button type="submit" onclick="return confirm('Remove this product?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</div>

<script src="../js/validation.js"></script>

<?php include '../includes/footer.php'; ?>