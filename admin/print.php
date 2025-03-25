<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['atsmsaid']) || strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

$cid = $_GET['vid'];

// Use prepared statements to prevent SQL Injection
$stmt = $con->prepare("SELECT * FROM tblstandentry WHERE ID=?");
$stmt->bind_param("i", $cid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    echo "<p class='text-danger'>No record found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>🚖Ride Hub | Parking Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #printSection {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .print-btn {
            margin: 20px 0;
            text-align: center;
        }
        /* Hide Print Button & Non-Printable Elements in Print */
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="printSection">
        <h3 class="text-center">🚖 Auto/Taxi Parking Receipt</h3>
        <hr>

        <table class="table table-bordered">
            <tr>
                <th>Parking Number</th>
                <td><?= htmlspecialchars($row['ParkingNumber']); ?></td>
                <th>Vehicle Type</th>
                <td><?= htmlspecialchars($row['VehicleType']); ?></td>
            </tr>
            <tr>
                <th>Driver Name</th>
                <td><?= htmlspecialchars($row['DriverName']); ?></td>
                <th>Driver Mobile</th>
                <td><?= htmlspecialchars($row['Drivermobilenumber']); ?></td>
            </tr>
            <tr>
                <th>License Number</th>
                <td><?= htmlspecialchars($row['Driverlicensenumber']); ?></td>
                <th>Vehicle Registration</th>
                <td><?= htmlspecialchars($row['Vehicleregistrationnumber']); ?></td>
            </tr>
            <tr>
                <th>In Time</th>
                <td><?= htmlspecialchars($row['EntryDate']); ?></td>
                <th>Status</th>
                <td>
                    <?= ($row['Status'] == "Out") ? "Outgoing Auto/Taxi" : "Incoming Auto/Taxi"; ?>
                </td>
            </tr>

            <?php if (!empty($row['Remark'])) { ?>
                <tr>
                    <th>Out Time</th>
                    <td><?= htmlspecialchars($row['OutDate']); ?></td>
                    <th>Parking Charge</th>
                    <td>₹<?= htmlspecialchars($row['Price']); ?></td>
                </tr>
                <tr>
                    <th>Remark</th>
                    <td colspan="3"><?= htmlspecialchars($row['Remark']); ?></td>
                </tr>
            <?php } ?>
        </table>

        <div class="print-btn">
            <button class="btn btn-primary" onclick="window.print();">
                <i class="fa fa-print"></i> Print Receipt
            </button>
        </div>
    </div>

</body>
</html>
