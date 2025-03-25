<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (!isset($_SESSION['atsmsaid']) || strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

// Ensure the form was submitted with valid dates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fromdate']) && isset($_POST['todate'])) {
    $fdate = htmlspecialchars($_POST['fromdate']);
    $tdate = htmlspecialchars($_POST['todate']);

    // Validate if both dates are selected
    if (empty($fdate) || empty($tdate)) {
        echo "<script>alert('Please select both From and To dates.'); window.history.back();</script>";
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM tblstandentry WHERE date(EntryDate) BETWEEN ? AND ?");
    $stmt->bind_param("ss", $fdate, $tdate);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<script>alert('Invalid Access!'); window.location.href='reports.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Dates Report - Auto/Taxi Stand</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <?php include_once 'includes/header.php'; ?>
        <!-- Main Content -->
        <div class="d-flex flex-grow-1 overflow-hidden">
            <?php include_once 'includes/sidebar.php'; ?>
            <div class="flex-grow-1 overflow-auto p-4 main-content">
                <h4 class="mb-4">Report</h4>

                <h4 class="text-center">Report from <span class="text-primary"><?php echo date("d-M-Y", strtotime($fdate)); ?></span> to <span class="text-primary"><?php echo date("d-M-Y", strtotime($tdate)); ?></span></h4>
                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>S.NO</th>
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
                            $cnt = 1;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo htmlspecialchars($row['ParkingNumber']); ?></td>
                                        <td><?php echo htmlspecialchars($row['VehicleType']); ?></td>
                                        <td><?php echo htmlspecialchars($row['DriverName']); ?></td>
                                        <td><?php echo date("d-M-Y H:i A", strtotime($row['EntryDate'])); ?></td>
                                        <td>
                                            <?php echo !empty($row['Status']) ? htmlentities($row['Status']) : "<span class='text-warning'>Not Updated Yet</span>"; ?>
                                        </td>
                                        <td>
                                            <a href="auto-taxi-entry-detail.php?editid=<?php echo $row['ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="print.php?vid=<?php echo $row['ID']; ?>" target="_blank" class="btn btn-warning btn-sm">Print</a>
                                            <a href="manage-autoortaxi-entry.php?del=<?php echo $row['ID']; ?>" onclick="return confirm('Do you really want to delete the vehicle entry?');" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                            <?php
                                    $cnt++;
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center text-danger'>No records found for the selected date range.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
