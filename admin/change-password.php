<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_POST['submit'])) {
    $adminid = $_SESSION['atsmsaid'];
    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];

    // Fetch current password securely
    $stmt = $con->prepare("SELECT Password FROM tbladmin WHERE ID = ?");
    $stmt->bind_param("i", $adminid);
    $stmt->execute();
    $stmt->bind_result($db_password);
    $stmt->fetch();
    $stmt->close();

    // Verify current password
    if (password_verify($currentpassword, $db_password)) {
        // Hash new password
        $hashed_newpassword = password_hash($newpassword, PASSWORD_BCRYPT);

        // Update password securely
        $stmt = $con->prepare("UPDATE tbladmin SET Password = ? WHERE ID = ?");
        $stmt->bind_param("si", $hashed_newpassword, $adminid);
        if ($stmt->execute()) {
            echo "<script>alert('Your password has been changed successfully.');</script>";
        } else {
            echo "<script>alert('Error updating password. Please try again.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Your current password is incorrect.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Change Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">

    <script>
        function validatePassword() {
            let newpassword = document.getElementById("newpassword").value;
            let confirmpassword = document.getElementById("confirmpassword").value;

            if (newpassword !== confirmpassword) {
                alert("New Password and Confirm Password do not match!");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <!-- Header -->
        <?php include_once 'includes/header.php'; ?>

        <!-- Main Content -->
        <div class="d-flex flex-grow-1 overflow-hidden">
            <?php include_once 'includes/sidebar.php'; ?>
            <div class="flex-grow-1 overflow-auto p-4 main-content">
                <h4 class="mb-4">Change Password</h4>
                <div class="card shadow">
                    <div class="card-body">
                        <form method="post" onsubmit="return validatePassword();">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="currentpassword" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" id="newpassword" name="newpassword" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
