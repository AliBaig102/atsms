<?php
session_start();
error_reporting(0);
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
    <title>🚖Ride Hub | Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <?php
        include_once 'includes/header.php'
            ?>
        <!-- Main Content -->
        <div class="d-flex flex-grow-1 overflow-hidden">
            <?php include_once 'includes/sidebar.php'; ?>
            <div class="flex-grow-1 overflow-auto p-4 main-content">
                <h4 class="mb-4">Dashboard</h4>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    // Fetch all required counts in a single optimized query
                    $query = mysqli_query($con, "
                            SELECT 
                                (SELECT COUNT(ID) FROM tblstandentry WHERE DATE(EntryDate) = CURDATE()) AS today_count,
                                (SELECT COUNT(ID) FROM tblstandentry WHERE DATE(EntryDate) = CURDATE() - INTERVAL 1 DAY) AS yesterday_count,
                                (SELECT COUNT(ID) FROM tblstandentry WHERE DATE(EntryDate) >= (NOW() - INTERVAL 7 DAY)) AS last7_count,
                                (SELECT COUNT(ID) FROM tblstandentry) AS total_count,
                                (SELECT COUNT(ID) FROM tblstandentry WHERE VehicleType = 'Auto') AS auto_count,
                                (SELECT COUNT(ID) FROM tblstandentry WHERE VehicleType = 'Taxi') AS taxi_count
                        ");

                    $result = mysqli_fetch_assoc($query);

                    // Card Data
                    $cards = [
                        ["title" => "Today's Entries", "count" => $result['today_count'], "link" => "today-autoortaxi-entry.php", "icon" => "bi bi-taxi-front", "color" => "bg-primary"],
                        ["title" => "Yesterday's Entries", "count" => $result['yesterday_count'], "link" => "yesterday-autoortaxi-entry.php", "icon" => "bi bi-clock-history", "color" => "bg-secondary"],
                        ["title" => "Last 7 Days", "count" => $result['last7_count'], "link" => "last7days-autoortaxi-entry.php", "icon" => "bi bi-calendar-week", "color" => "bg-success"],
                        ["title" => "Total Entries", "count" => $result['total_count'], "link" => "manage-autoortaxi-entry.php", "icon" => "bi bi-bar-chart", "color" => "bg-danger"],
                        ["title" => "Total Autos", "count" => $result['auto_count'], "link" => "manage-autos-entry.php", "icon" => "bi bi-car-front", "color" => "bg-warning"],
                        ["title" => "Total Taxis", "count" => $result['taxi_count'], "link" => "manage-taxies-entry.php", "icon" => "bi bi-taxi-front", "color" => "bg-info"]
                    ];

                    foreach ($cards as $card) {
                        echo '<div class="col-lg-4 col-md-6 mb-4">';
                        echo '<a href="' . htmlspecialchars($card["link"]) . '" class="text-decoration-none text-dark">';
                        echo '<div class="card h-100 shadow-sm border-0">';
                        echo '<div class="card-body text-center">';
                        echo '<div class="card-icon ' . htmlspecialchars($card["color"]) . ' text-white rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">';
                        echo '<i class="' . htmlspecialchars($card["icon"]) . '"></i>';
                        echo '</div>';
                        echo '<h5 class="card-title mb-2">' . htmlspecialchars($card["title"]) . '</h5>';
                        echo '<p class="card-text fs-4 fw-bold">' . number_format($card["count"]) . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>