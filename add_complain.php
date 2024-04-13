<?php
session_start();
include('config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = !empty($_POST['username']) ? $_POST['username'] : "Anonymous User";
    $complaint_reason = $_POST['complaint_reason'];
    $text = $_POST['text'];
    $submission_date = date("Y-m-d H:i:s");

    // Insert complaint into the database
    $sql_insert_complaint = "INSERT INTO visitor_complaints (Username, ComplaintReason, Text, SubmissionDate) VALUES (?, ?, ?, ?)";
    $stmt_insert_complaint = mysqli_prepare($conn, $sql_insert_complaint);
    mysqli_stmt_bind_param($stmt_insert_complaint, "ssss", $username, $complaint_reason, $text, $submission_date);
    if (mysqli_stmt_execute($stmt_insert_complaint)) {
        $success_message = "Complaint submitted successfully.";
    } else {
        $error_message = "Failed to submit complaint. Please try again.";
    }
    mysqli_stmt_close($stmt_insert_complaint);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Complaint</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h2>Add Complaint</h2>
        <?php if (isset($success_message)) : ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php elseif (isset($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label>Complaint Reason</label>
                <input type="text" class="form-control" name="complaint_reason" required>
            </div>
            <div class="form-group">
                <label>Text</label>
                <textarea class="form-control" name="text" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Complaint</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
