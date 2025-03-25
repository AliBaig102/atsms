<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Search Taxi or Auto</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <!-- Header -->
        <?php include_once 'includes/header.php'; ?>

        <!-- Main Content -->
        <div class="d-flex flex-grow-1 overflow-hidden">
            <?php include_once 'includes/sidebar.php'; ?>
            <div class="flex-grow-1 overflow-auto p-4 main-content">
                <h4 class="mb-4">Search Taxi or Auto</h4>

                <!-- Search Form -->
                <form method="post" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="searchdata" class="form-control" placeholder="Enter Driver Name or Mobile Number..." required>
                        <button type="submit" name="search" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['search'])) {
                    $sdata = $_POST['searchdata'];
                    echo '<h5 class="text-center text-secondary">Results for "<strong>' . htmlspecialchars($sdata) . '</strong>"</h5>';
                    echo '<hr>';

                    // Secure search query using prepared statements
                    $stmt = $con->prepare("SELECT * FROM tblstandentry WHERE DriverName LIKE ? OR Drivermobilenumber LIKE ?");
                    $searchTerm = "%$sdata%";
                    $stmt->bind_param("ss", $searchTerm, $searchTerm);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo '<thead class="table-dark">';
                        echo '<tr>
                                <th>S.No</th>
                                <th>Parking Number</th>
                                <th>Type</th>
                                <th>Driver Name</th>
                                <th>Entry Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                              </tr>';
                        echo '</thead><tbody>';

                        $cnt = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . $cnt . '</td>
                                    <td>' . htmlspecialchars($row['ParkingNumber']) . '</td>
                                    <td>' . htmlspecialchars($row['VehicleType']) . '</td>
                                    <td>' . htmlspecialchars($row['DriverName']) . '</td>
                                    <td>' . date("m/d/Y", strtotime($row['EntryDate'])) . '</td>
                                    <td>' . ($row['Status'] ? htmlspecialchars($row['Status']) : 'Not Updated Yet') . '</td>
                                    <td>
                                        <a href="auto-taxi-entry-detail.php?editid=' . $row['ID'] . '" class="btn btn-success btn-sm">Edit</a>
                                        <a href="print.php?vid=' . $row['ID'] . '" class="btn btn-warning btn-sm" target="_blank">Print</a>
                                        <a href="manage-autoortaxi-entry.php?del=' . $row['ID'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this entry?\');">Delete</a>
                                    </td>
                                  </tr>';
                            $cnt++;
                        }
                        echo '</tbody></table>';
                    } else {
                        echo '<p class="text-center text-danger">No record found for "<strong>' . htmlspecialchars($sdata) . '</strong>".</p>';
                    }
                    $stmt->close();
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
