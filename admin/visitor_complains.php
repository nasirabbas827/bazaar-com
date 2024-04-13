<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Complaints</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php 
    session_start();
    include('config.php');

    // Check if the user is logged in as admin
    if (!isset($_SESSION["id"]) || $_SESSION["usertype"] !== "admin") {
        header("location: login.php");
        exit;
    }

    // Fetch visitor complaints from the database
    $sql_complaints = "SELECT * FROM visitor_complaints";
    $result_complaints = mysqli_query($conn, $sql_complaints);
    ?>
    <?php 
    include('admin_navbar.php');    ?>

    <div class="container mt-5">
        <h2>Visitor Complaints</h2>
        <?php if (mysqli_num_rows($result_complaints) > 0) : ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Username</th>
                        <th>Complaint Reason</th>
                        <th>Text</th>
                        <th>Submission Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_complaints)) : ?>
                        <tr>
                            <td><?php echo $row["ComplaintID"]; ?></td>
                            <td><?php echo $row["Username"]; ?></td>
                            <td><?php echo $row["ComplaintReason"]; ?></td>
                            <td><?php echo $row["Text"]; ?></td>
                            <td><?php echo $row["SubmissionDate"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No complaints found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
