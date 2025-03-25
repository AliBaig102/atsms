<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

// Deletion Code
if (isset($_GET['del'])) {
    $atid = intval($_GET['del']);
    $query = mysqli_query($con, "DELETE FROM tblstandentry WHERE ID='$atid'");

    if ($query) {
        echo "<script>alert('Vehicle entry deleted successfully.');</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
    echo "<script>window.location.href='manage-autoortaxi-entry.php'</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖 Ride Hub | Manage Entries</title>

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
                <h4 class="mb-4">Manage Auto/Taxi Entries</h4>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Parking Number</th>
                                        <th>Type</th>
                                        <th>Driver Name</th>
                                        <th>Entry Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = mysqli_query($con, "SELECT * FROM tblstandentry where VehicleType='Taxi' ORDER BY EntryDate DESC");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                        <tr>
                                            <td><?= $cnt++; ?></td>
                                            <td><?= htmlspecialchars($row['ParkingNumber']); ?></td>
                                            <td><?= htmlspecialchars($row['VehicleType']); ?></td>
                                            <td><?= htmlspecialchars($row['DriverName']); ?></td>
                                            <td><?= htmlspecialchars(date('m/d/Y', strtotime($row['EntryDate']))); ?></td>
                                            <td>
                                                <?= $row['Status'] ? htmlentities($row['Status']) : '<span class="text-danger">Not Updated Yet</span>'; ?>
                                            </td>
                                            <td>
                                                <a href="auto-taxi-entry-detail.php?editid=<?= $row['ID']; ?>" class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <a href="print.php?vid=<?= $row['ID']; ?>" target="_blank" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-printer"></i> Print
                                                </a>
                                                <a href="manage-autoortaxi-entry.php?del=<?= $row['ID']; ?>" onclick="return confirm('Do you really want to delete this entry?');" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
