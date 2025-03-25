<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (!isset($_SESSION['atsmsaid']) || strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Auto/Taxi Stand Reports</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
                <h4 class="mb-4">Generate Reports - Auto/Taxi Stand</h4>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <strong>Select Date Range</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="bwdates-reports-details.php" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="fromdate" class="form-label">From Date:</label>
                                <input type="date" id="fromdate" name="fromdate" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="todate" class="form-label">To Date:</label>
                                <input type="date" id="todate" name="todate" class="form-control" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="bi bi-file-earmark-bar-graph"></i> Generate Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Form Validation Script -->
    <script>
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

</body>
</html>
