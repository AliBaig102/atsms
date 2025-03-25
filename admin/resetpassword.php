<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $contactno = $_SESSION['contactno'];
    $email = $_SESSION['email'];
    $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

    // Prevent SQL Injection
    $contactno = mysqli_real_escape_string($con, $contactno);
    $email = mysqli_real_escape_string($con, $email);

    $query = mysqli_query($con, "UPDATE tbladmin SET Password='$newpassword' WHERE Email='$email' AND MobileNumber='$contactno'");

    if ($query) {
        echo "<script>alert('Password successfully changed');</script>";
        session_destroy();
        echo "<script>window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Reset Password</title>

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome (For Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .reset-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .reset-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            height: 45px;
            border-radius: 5px;
        }

        .btn-reset {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-reset:hover {
            background-color: #0056b3;
        }

        .back-link {
            font-size: 14px;
            margin-top: 10px;
            display: block;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .password-match {
            font-size: 14px;
            color: red;
            display: none;
        }
    </style>

    <script>
        function checkPasswordMatch() {
            let password = document.getElementById("newpassword").value;
            let confirmPassword = document.getElementById("confirmpassword").value;
            let message = document.getElementById("passwordMatchMessage");

            if (password !== confirmPassword) {
                message.style.display = "block";
                message.innerHTML = "❌ Passwords do not match!";
                return false;
            } else {
                message.style.display = "none";
                return true;
            }
        }
    </script>
</head>

<body>

    <div class="reset-container">
        <h3 class="reset-title">🔑 Reset Your Password</h3>
        <hr>

        <form action="" method="post" onsubmit="return checkPasswordMatch();">
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="Enter new password" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm new password" required onkeyup="checkPasswordMatch();">
                <span id="passwordMatchMessage" class="password-match">❌ Passwords do not match!</span>
            </div>

            <button type="submit" name="submit" class="btn btn-reset w-100">
                <i class="fa fa-lock"></i> Reset Password
            </button>
        </form>

        <a href="index.php" class="back-link">🔙 Back to Login</a>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
