<?php
session_start();
include('config.php');

// Check if user is logged in as seller
if (!isset($_SESSION["id"]) || $_SESSION["usertype"] != "seller") {
    header("location: login.php");
    exit;
}

// Get the seller's ID from the session
$seller_id = $_SESSION["id"];

// Fetch orders for the seller's products
$sql_orders = "SELECT o.*, p.ProductName, p.Price, oi.Quantity, oi.OrderItemID 
               FROM visitor_orders o 
               INNER JOIN visitor_order_items oi ON o.OrderID = oi.OrderID 
               INNER JOIN products p ON oi.ProductID = p.ProductID 
               WHERE p.SellerID = $seller_id";
$result_orders = mysqli_query($conn, $sql_orders);

// Handle form submission to update order status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order_id']) && isset($_POST['status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Update order status in the database
        $sql_update_status = "UPDATE visitor_orders SET OrderStatus = '$status' WHERE OrderID = $order_id";
        if (mysqli_query($conn, $sql_update_status)) {
            // Redirect to avoid form resubmission
            header("location: visitor_orders.php");
            exit;
        } else {
            echo "Error updating order status: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include('seller_navbar.php'); ?>

    <div class="container mt-5">
        <h2 class="mb-4">Visitor Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Delivery Address</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_orders)) : ?>
                    <tr>
                        <td><?php echo $row['OrderID']; ?></td>
                        <td><?php echo $row['ProductName']; ?></td>
                        <td>$<?php echo $row['Price']; ?></td>
                        <td><?php echo $row['Quantity']; ?></td>
                        <td>$<?php echo $row['Price'] * $row['Quantity']; ?></td>
                        <td><?php echo $row['DeliveryAddress']; ?></td>
                        <td><?php echo $row['OrderStatus']; ?></td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $row['OrderID']; ?>">
                                <select name="status" class="form-control">
                                    <option value="Pending">Pending</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="In Process">In Process</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
