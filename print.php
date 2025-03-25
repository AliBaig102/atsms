<?php
session_start();
error_reporting(0);
include('admin/includes/dbconnection.php');

$cid = $_GET['vid'];
$ret = mysqli_query($con, "SELECT * FROM tblstandentry WHERE ID='$cid'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideHub | Parking Receipt</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .receipt-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .receipt-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-incoming {
            background-color: #ff9800;
            color: white;
        }

        .status-outgoing {
            background-color: #28a745;
            color: white;
        }

        .print-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .print-btn button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .print-btn button:hover {
            background-color: #0056b3;
        }

        /* Hide print button when printing */
        @media print {
            .print-btn {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="receipt-container" id="receipt">
        <h3 class="receipt-title">🚖 RideHub | Parking Receipt</h3>
        <hr>

        <table class="table">
            <?php while ($row = mysqli_fetch_array($ret)) { ?>
                <tr>
                    <th>Parking Number</th>
                    <td><?php echo $row['ParkingNumber']; ?></td>
                </tr>
                <tr>
                    <th>Vehicle Type</th>
                    <td><?php echo $row['VehicleType']; ?></td>
                </tr>
                <tr>
                    <th>Driver Name</th>
                    <td><?php echo $row['DriverName']; ?></td>
                </tr>
                <tr>
                    <th>Driver Mobile</th>
                    <td><?php echo $row['Drivermobilenumber']; ?></td>
                </tr>
                <tr>
                    <th>License Number</th>
                    <td><?php echo $row['Driverlicensenumber']; ?></td>
                </tr>
                <tr>
                    <th>Vehicle Registration</th>
                    <td><?php echo $row['Vehicleregistrationnumber']; ?></td>
                </tr>
                <tr>
                    <th>Entry Time</th>
                    <td><?php echo $row['EntryDate']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if ($row['Status'] == "") { ?>
                            <span class="status-badge status-incoming">Incoming Auto/Taxi</span>
                        <?php } else { ?>
                            <span class="status-badge status-outgoing">Outgoing Auto/Taxi</span>
                        <?php } ?>
                    </td>
                </tr>

                <?php if ($row['Remark'] != "") { ?>
                    <tr>
                        <th>Out Time</th>
                        <td><?php echo $row['OutDate']; ?></td>
                    </tr>
                    <tr>
                        <th>Parking Charge</th>
                        <td>₹<?php echo $row['Price']; ?></td>
                    </tr>
                    <tr>
                        <th>Remark</th>
                        <td colspan="2"><?php echo $row['Remark']; ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>

        <!-- Print Button (Hides when printing) -->
        <div class="print-btn">
            <button onclick="printReceipt()"><i class="fas fa-print"></i> Print Receipt</button>
        </div>
    </div>

    <!-- Bootstrap 5 Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function printReceipt() {
            window.print();
        }
    </script>

</body>
</html>
