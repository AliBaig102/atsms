<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_POST['submit'])) {
    $parkingnumber = mt_rand(100000000, 999999999);
    $vehtype = $_POST['vehtype'];
    $drivername = $_POST['drivername'];
    $mobnumber = $_POST['mobilenumber'];
    $licensenumber = $_POST['licensenumber'];
    $registrationnumber = $_POST['registrationnumber'];

    $query = mysqli_query($con, "INSERT INTO tblstandentry (ParkingNumber, VehicleType, DriverName, Drivermobilenumber, Driverlicensenumber, Vehicleregistrationnumber) 
            VALUES ('$parkingnumber','$vehtype','$drivername','$mobnumber','$licensenumber','$registrationnumber')");

    if ($query) {
        echo '<script>alert("Auto/Taxi Entry Added Successfully!"); window.location.href="new-autoortaxi-entry-form.php";</script>';
    } else {
        echo '<script>alert("Something Went Wrong! Please Try Again.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖 Ride Hub | New Entry</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <!-- Header -->
        <?php include_once('includes/header.php'); ?>

        <div class="d-flex flex-grow-1 overflow-hidden">
            <!-- Sidebar -->
            <?php include_once('includes/sidebar.php'); ?>

            <div class="flex-grow-1 overflow-auto p-4">
                <h4 class="mb-4">New Auto/Taxi Entry</h4>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehtype" class="form-label">Vehicle Type</label>
                                    <select class="form-select" id="vehtype" name="vehtype" required>
                                        <option value="">Choose Type</option>
                                        <option value="Auto">Auto</option>
                                        <option value="Taxi">Taxi</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="drivername" class="form-label">Driver Name</label>
                                    <input type="text" class="form-control" id="drivername" name="drivername" placeholder="Enter Driver Name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="mobilenumber" class="form-label">Driver Phone Number</label>
                                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" pattern="[0-9]{10}" maxlength="10" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="licensenumber" class="form-label">License Number</label>
                                    <input type="text" class="form-control" id="licensenumber" name="licensenumber" placeholder="License Number" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="registrationnumber" class="form-label">Registration Number</label>
                                    <input type="text" class="form-control" id="registrationnumber" name="registrationnumber" placeholder="Registration Number" required>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Add Entry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
