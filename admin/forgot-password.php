<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $contactno = mysqli_real_escape_string($con, $_POST['contactno']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE Email='$email' AND MobileNumber='$contactno'");
    $ret = mysqli_fetch_array($query);

    if ($ret) {
        $_SESSION['contactno'] = $contactno;
        $_SESSION['email'] = $email;
        echo "<script>window.location.href='resetpassword.php';</script>";
    } else {
        echo "<script>alert('Invalid Details. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Password Recovery</title>

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

        .recovery-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .recovery-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            height: 45px;
            border-radius: 5px;
        }

        .btn-recover {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-recover:hover {
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
    </style>
</head>

<body>

    <div class="recovery-container">
        <h3 class="recovery-title">🔒 Password Recovery</h3>
        <hr>

        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="contactno" class="form-control" placeholder="Enter your mobile number" required>
            </div>

            <button type="submit" name="submit" class="btn btn-recover w-100">
                <i class="fa fa-unlock-alt"></i> Reset Password
            </button>
        </form>

        <a href="index.php" class="back-link">🔙 Back to Login</a>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
