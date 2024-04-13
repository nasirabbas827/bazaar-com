<?php
session_start();
include('config.php');

// Check if user is logged in as a seller
if (!isset($_SESSION["id"]) || $_SESSION["usertype"] != "seller") {
    header("location: login.php");
    exit;
}

$seller_id = $_SESSION['id'];

// Fetch orders for the seller's products
$sql_orders = "SELECT orders.*, products.ProductName, order_items.Quantity 
              FROM orders 
              INNER JOIN order_items ON orders.OrderID = order_items.OrderID 
              INNER JOIN products ON order_items.ProductID = products.ProductID 
              WHERE products.SellerID = $seller_id 
              ORDER BY orders.OrderID DESC";
$result_orders = mysqli_query($conn, $sql_orders);

// Array of available order statuses
$order_statuses = ['Pending', 'Cancel', 'In Process', 'Delivered'];

// Check if form is submitted to update order status
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    $sql_update_status = "UPDATE orders SET OrderStatus = '$new_status' WHERE OrderID = $order_id";
    mysqli_query($conn, $sql_update_status);
    // Redirect to avoid resubmission of form
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Product Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include('seller_navbar.php'); ?>

    <div class="container mt-5">
        <h2 class="mb-4">My Product Orders</h2>
        <div class="row">
            <div class="col-md-12">
                <a class="m-3 btn btn-outline-dark float-right" href="visitor_orders.php">Visitor Orders</a>
                <?php if (mysqli_num_rows($result_orders) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Delivery Address</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result_orders)): ?>
                                <tr>
                                    <td><?php echo $row['OrderID']; ?></td>
                                    <td><?php echo $row['ProductName']; ?></td>
                                    <td><?php echo $row['Quantity']; ?></td>
                                    <td>$<?php echo number_format($row['TotalPrice'], 2); ?></td>
                                    <td><?php echo $row['DeliveryAddress']; ?></td>
                                    <td><?php echo $row['OrderStatus']; ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $row['OrderID']; ?>">
                                            <select name="status" class="form-control">
                                                <?php foreach ($order_statuses as $status): ?>
                                                    <option value="<?php echo $status; ?>" <?php if ($row['OrderStatus'] == $status) echo 'selected'; ?>><?php echo $status; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" name="update_status" class="btn btn-primary mt-2">Update Status</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">You have no orders for your products yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
