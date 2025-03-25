<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $adminuser = mysqli_real_escape_string($con, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE UserName='$adminuser' AND Password='$password'");
    $ret = mysqli_fetch_array($query);

    if ($ret) {
        $_SESSION['atsmsaid'] = $ret['ID'];
        echo "<script>window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid Login Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Admin Login</title>

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

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            height: 45px;
            border-radius: 5px;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .forgot-password {
            font-size: 14px;
        }

        .back-home {
            font-size: 14px;
            margin-top: 15px;
            display: block;
        }

        .back-home:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h3 class="login-title">🚖 RideHub Admin Login</h3>
        <hr>

        <form action="" method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" name="login" class="btn btn-login w-100">
                <i class="fa fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <div class="mt-3">
            <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
        </div>

        <a href="../index.php" class="back-home">🏠 Back to Home</a>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
