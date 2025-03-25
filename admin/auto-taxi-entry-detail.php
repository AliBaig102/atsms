<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['atsmsaid']) || strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_POST['submit'])) {
    $eid = $_GET['editid'];  
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $price = $_POST['price'];

    // Validate numeric price
    if (!is_numeric($price) || $price < 0) {
        echo '<script>alert("Invalid price. Please enter a valid number.");</script>';
    } else {
        // Secure Query using Prepared Statements
        $stmt = $con->prepare("UPDATE tblstandentry SET Remark=?, Status=?, Price=? WHERE ID=?");
        $stmt->bind_param("ssdi", $remark, $status, $price, $eid);

        if ($stmt->execute()) {
            echo '<script>alert("Auto/Taxi Remark has been Updated.")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>🚖 Ride Hub | Auto/Taxi Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <?php include_once 'includes/header.php'; ?>
        <div class="d-flex flex-grow-1 overflow-hidden">
            <?php include_once 'includes/sidebar.php'; ?>

            <div class="flex-grow-1 overflow-auto p-4">
                <h4 class="mb-4">Auto/Taxi Entry Details</h4>

                <?php
                $eid = $_GET['editid'];
                $stmt = $con->prepare("SELECT * FROM tblstandentry WHERE ID=?");
                $stmt->bind_param("i", $eid);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row) {
                ?>
                    <table class="table table-bordered">
                        <tr><th>Parking Number</th><td><?= htmlspecialchars($row['ParkingNumber']); ?></td></tr>
                        <tr><th>Type of Vehicle</th><td><?= htmlspecialchars($row['VehicleType']); ?></td></tr>
                        <tr><th>Driver Name</th><td><?= htmlspecialchars($row['DriverName']); ?></td></tr>
                        <tr><th>Driver Mobile</th><td><?= htmlspecialchars($row['Drivermobilenumber']); ?></td></tr>
                        <tr><th>License Number</th><td><?= htmlspecialchars($row['Driverlicensenumber']); ?></td></tr>
                        <tr><th>Registration Number</th><td><?= htmlspecialchars($row['Vehicleregistrationnumber']); ?></td></tr>
                        <tr><th>Entry Date</th><td><?= htmlspecialchars($row['EntryDate']); ?></td></tr>
                        <tr><th>Status</th><td><?= $row['Status'] == "Out" ? "Taxi/Auto Out" : "Taxi/Auto In"; ?></td></tr>

                        <?php if ($row['Status'] == "") { ?>
                            <form method="post">
                                <tr>
                                    <th>Outing Remark</th>
                                    <td><textarea name="remark" class="form-control" required></textarea></td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td><input type="number" name="price" class="form-control" required></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <select name="status" class="form-control" required>
                                            <option value="Out">Outgoing Taxi/Auto</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </td>
                                </tr>
                            </form>
                        <?php } else { ?>
                            <tr><th>Outing Remark</th><td><?= htmlspecialchars($row['Remark']); ?></td></tr>
                            <tr><th>Price</th><td><?= htmlspecialchars($row['Price']); ?></td></tr>
                            <tr><th>Out Time</th><td><?= htmlspecialchars($row['OutDate']); ?></td></tr>
                        <?php } ?>
                    </table>
                <?php
                } else {
                    echo "<p class='text-danger'>No record found.</p>";
                }
                $stmt->close();
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
