<?php
session_start();
include 'includes/db_config.php';

// Redirect to login if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_first_name = $_SESSION["first_name"];
$user_last_name = $_SESSION["last_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings | Trellis</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .booking-banner {
            width: 100%;
            height: 25vh;
            background: url('assets/images/booking-banner.jpg') no-repeat center center/cover;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-logo">Trellis</div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="#">Booking</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <!-- Booking Banner -->
    <div class="booking-banner"></div>

    <!-- Booking Table -->
    <section class="user-bookings">
        <h2>Your Bookings</h2>
        <table>
            <tr>
                <th>Departure Station</th>
                <th>Destination Station</th>
                <th>Travel Date</th>
                <th>Travel Time</th>
                <th>Arrival Time</th>
                <th>Status</th>
            </tr>
            <?php
            $user_id = $_SESSION["user_id"];
            $result = $conn->query("SELECT departure_station, destination_station, travel_date, travel_time, arrival_time, status FROM bookings WHERE user_id = $user_id");

            while ($row = $result->fetch_assoc()) {
                $arrivalTimeMinutes = $row['arrival_time'] / (1000 * 60);
                echo "<tr>
                        <td>{$row['departure_station']}</td>
                        <td>{$row['destination_station']}</td>
                        <td>{$row['travel_date']}</td>
                        <td>{$row['travel_time']}</td>
                        <td>{$arrivalTimeMinutes} min</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }
            ?>
        </table>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Trellis. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
