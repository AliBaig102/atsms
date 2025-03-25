<?php 
session_start();
error_reporting(0);
include('admin/includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideHub | Search Auto & Taxi</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }

        .search-box {
            max-width: 500px;
            margin: auto;
        }

        .search-box input {
            height: 50px;
            border-radius: 25px;
            padding-left: 20px;
            font-size: 16px;
            border: 1px solid #ddd;
        }

        .search-box button {
            height: 50px;
            border-radius: 25px;
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 0 20px;
            transition: 0.3s ease;
        }

        .search-box button:hover {
            background-color: #e68900;
        }

        .table-container {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-pending {
            background-color: #ffc107;
            color: #fff;
        }

        .status-updated {
            background-color: #28a745;
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #ffecb3;
        }

        @media (max-width: 768px) {
            .search-box input {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center text-dark">🔍 RideHub - Search Auto & Taxi</h3>
        <hr>

        <!-- Search Box -->
        <div class="search-box text-center">
            <form name="search" method="post">
                <div class="input-group">
                    <input type="text" name="searchdata" id="searchdata" class="form-control" placeholder="Search by name or mobile number..." required>
                    <button type="submit" name="search" class="btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>

        <!-- Search Results -->
        <div class="table-container">
            <?php if(isset($_POST['search'])) { 
                $sdata = $_POST['searchdata'];
                ?>
                <h4 class="text-center text-primary mt-3">Results for: "<?php echo htmlentities($sdata); ?>"</h4>
                <hr>

                <div class="table-responsive">
                    <table class="table table-hover text-center">
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
                            $ret = mysqli_query($con, "SELECT * FROM tblstandentry WHERE DriverName LIKE '$sdata%' OR Drivermobilenumber LIKE '$sdata%'");
                            $num = mysqli_num_rows($ret);
                            if ($num > 0) {
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) { ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo htmlentities($row['ParkingNumber']); ?></td>
                                        <td><?php echo htmlentities($row['VehicleType']); ?></td>
                                        <td><?php echo htmlentities($row['DriverName']); ?></td>
                                        <td><?php echo htmlentities(date('d/m/Y', strtotime($row['EntryDate']))); ?></td>
                                        <td>
                                            <?php if ($row['Status'] == "") { ?>
                                                <span class="status-badge status-pending">Pending</span>
                                            <?php } else { ?>
                                                <span class="status-badge status-updated"><?php echo htmlentities($row['Status']); ?></span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="print.php?vid=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fas fa-print"></i> Print</a>
                                        </td>
                                    </tr>
                                <?php
                                    $cnt++;
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="7" class="text-danger">No records found</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Bootstrap 5 Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
