<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: login.php");
    exit();
}

include 'includes/db_config.php';
$admin_name = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Trellis</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Admin Navigation Bar -->
    <nav class="navbar">
        <div class="nav-logo">Trellis Admin</div>
        <ul class="nav-links">
            <li><a href="admin_dashboard.php">Manage Users</a></li>
            <li><a href="#">View Bookings</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <!-- Admin Dashboard Content -->
    <div class="admin-container">
        <h2>Welcome, Admin <?php echo htmlspecialchars($admin_name); ?>!</h2>
        <p>Manage all train bookings below.</p>

        <h3>All Bookings</h3>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Departure Station</th>
                    <th>Destination Station</th>
                    <th>Travel Date</th>
                    <th>Travel Time</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT b.booking_id, u.first_name, u.last_name, b.departure_station, 
                        b.destination_station, b.travel_date, b.travel_time, b.status 
                        FROM bookings b 
                        JOIN users u ON b.user_id = u.id");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['booking_id']}</td>
                            <td>{$row['first_name']} {$row['last_name']}</td>
                            <td>{$row['departure_station']}</td>
                            <td>{$row['destination_station']}</td>
                            <td>{$row['travel_date']}</td>
                            <td>{$row['travel_time']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <form action='update_booking.php' method='post'>
                                    <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                                    <select name='status' required>
                                        <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                        <option value='Confirmed' " . ($row['status'] == 'Confirmed' ? 'selected' : '') . ">Confirmed</option>
                                        <option value='Cancelled' " . ($row['status'] == 'Cancelled' ? 'selected' : '') . ">Cancelled</option>
                                    </select>
                                    <button type='submit'>Update</button>
                                </form>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
