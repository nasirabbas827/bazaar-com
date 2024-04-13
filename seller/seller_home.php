<?php
// start session and check if user is logged in as seller
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["usertype"] != "seller") {
    header("location: ../login.php");
    exit;
}
?>
<?php
include 'config.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title>seller Home Page</title>
<!-- Add Bootstrap CSS -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php 
include('seller_navbar.php');
?>
<!-- Main Content -->
<div class="container my-4">
  <div class="row">
    <div class="col-md-3">
      <!-- Sidebar -->
      <div class="list-group">
        <a href="seller_home.php" class="list-group-item list-group-item-action active">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="seller_product.php" class="list-group-item list-group-item-action">
          <i class="fas fa-shopping-bag"></i> My Products
        </a>
        <a href="orders.php" class="list-group-item list-group-item-action">
          <i class="fas fa-receipt"></i> Orders
        </a>
        <a href="logout.php" class="list-group-item list-group-item-action">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>
    <div class="col-md-9">
      <!-- Main Content -->
      <h2>Welcome to your Seller Dashboard</h2>
      <p>You can manage your products, orders, and settings from here.</p>

      <div class="card-deck">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Products</h5>
            <p class="card-text">Add, edit, or remove your products.</p>
            <a href="seller_product.php" class="btn btn-primary">Go to Products</a>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Orders</h5>
            <p class="card-text">View and manage your orders.</p>
            <a href="orders.php" class="btn btn-primary">Go to Orders</a>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Account Settings</h5>
            <p class="card-text">Manage your account settings.</p>
            <a href="update_profile.php" class="btn btn-primary">Go to Settings</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNS" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php mysqli_close($conn);?>
