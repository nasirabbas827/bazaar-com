<?php
session_start();
include 'config.php';

// Check if user is logged in as admin
if (!isset($_SESSION["id"]) || $_SESSION["usertype"] != "admin") {
    header("location: admin_login.php");
    exit;
}

// Fetch all products with category and seller information
$sql_select = "SELECT p.*, c.name AS category_name, u.username AS seller_name 
               FROM products p 
               INNER JOIN categories c ON p.CategoryID = c.id
               INNER JOIN users u ON p.SellerID = u.id
               WHERE u.usertype = 'seller'";
$result = mysqli_query($conn, $sql_select);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - View Products</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
              .low-stock {
            background-color: #f8d7da !important;
        }
    </style>
</head>
<body>
    <?php include 'admin_navbar.php'; ?>
    <div class="container mt-4">
        <h2>View Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Category</th>
                    <th>Seller</th>
                    <th>Image</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                  <tr <?php echo ($row['StockQuantity'] < 10) ? 'class="low-stock"' : ''; ?>>
                        <td><?php echo $row['ProductID']; ?></td>
                        <td><?php echo $row['ProductName']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                        <td><?php echo $row['Price']; ?></td>
                        <td><?php echo $row['StockQuantity']; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td><?php echo $row['seller_name']; ?></td>
                        <td><img src="../seller/products_images/<?php echo $row['ImageURL']; ?>" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                        <!-- Add more cells for additional product details -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
