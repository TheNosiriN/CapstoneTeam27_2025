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
    <title>Contact Us | Trellis</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .user-bookings {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-logo">Trellis</div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="booking.php">Booking</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <!-- Jumbotron -->
    <header class="hero">
        <div class="hero-overlay">
            <h1>Contact Trellis</h1>
            <p>Reach out to us for inquiries, support, or feedback.</p>
            <p><strong>Email:</strong> support@trellis.com</p>
            <p><strong>Phone:</strong> +1 (800) 555-0199</p>
            <p><strong>Address:</strong> 123 Trellis Avenue, Transit City</p>
        </div>
    </header>

    <!-- User Bookings -->
    <section class="user-bookings">
        <h2>Your Bookings</h2>
        <table>
            <tr>
                <th>Departure Station</th><th>Destination Station</th><th>Travel Date</th><th>Travel Time</th><th>Status</th>
            </tr>
            <?php
            $user_id = $_SESSION["user_id"];
            $result = $conn->query("SELECT departure_station, destination_station, travel_date, travel_time, status FROM bookings WHERE user_id = $user_id AND status != 'Cancelled'");
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['departure_station']}</td>
                        <td>{$row['destination_station']}</td>
                        <td>{$row['travel_date']}</td>
                        <td>{$row['travel_time']}</td>
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