<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['atsmsaid']) || strlen($_SESSION['atsmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

// Secure Deletion
if (isset($_GET['del'])) {
    $atid = intval($_GET['del']);
    $stmt = $con->prepare("DELETE FROM tblstandentry WHERE ID=?");
    $stmt->bind_param("i", $atid);
    
    if ($stmt->execute()) {
        echo "<script>alert('Vehicle entry deleted successfully.');</script>";
    } else {
        echo "<script>alert('Something went wrong. Try again!');</script>";
    }
    $stmt->close();
    
    echo "<script>window.location.href='yesterday-autoortaxi-entry.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Yesterday's Entries</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <?php include_once 'includes/header.php'; ?>
        
        <div class="d-flex flex-grow-1 overflow-hidden">
            <?php include_once 'includes/sidebar.php'; ?>
            
            <div class="flex-grow-1 overflow-auto p-4 main-content">
                <h4 class="mb-4">Yesterday's Auto/Taxi Entries</h4>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Parking Number</th>
                                <th>Vehicle Type</th>
                                <th>Driver Name</th>
                                <th>Entry Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ret = mysqli_query($con, "SELECT * FROM tblstandentry WHERE DATE(EntryDate) = CURDATE() - INTERVAL 1 DAY");
                            $cnt = 1;
                            
                            while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                <tr>
                                    <td><?= $cnt; ?></td>
                                    <td><?= htmlspecialchars($row['ParkingNumber']); ?></td>
                                    <td><?= htmlspecialchars($row['VehicleType']); ?></td>
                                    <td><?= htmlspecialchars($row['DriverName']); ?></td>
                                    <td><?= htmlspecialchars($row['EntryDate']); ?></td>
                                    <td>
                                        <?= empty($row['Status']) ? '<span class="badge bg-warning">Not Updated</span>' : '<span class="badge bg-success">' . htmlspecialchars($row['Status']) . '</span>'; ?>
                                    </td>
                                    <td>
                                        <a href="auto-taxi-entry-detail.php?editid=<?= $row['ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="print.php?vid=<?= $row['ID']; ?>" target="_blank" class="btn btn-warning btn-sm">Print</a>
                                        <button onclick="confirmDelete(<?= $row['ID']; ?>)" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <?php
                                $cnt++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this vehicle entry?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 & jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmDelete(id) {
            document.getElementById('confirmDeleteBtn').href = "yesterday-autoortaxi-entry.php?del=" + id;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>

</body>

</html>
