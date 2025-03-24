<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: login.php");
    exit();
}

$admin_name = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
include 'includes/db_config.php';
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
            <li><a href="#">Manage Users</a></li>
            <li><a href="view_bookings.php">View Bookings</a></li>  <!-- NEW TAB ADDED -->
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <!-- Admin Dashboard Content -->
    <div class="admin-container">
        <h2>Welcome, Admin <?php echo htmlspecialchars($admin_name); ?>!</h2>
        <p>This is your admin panel where you can manage users.</p>

        <h3>Recent User Registrations</h3>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT id, first_name, last_name, email, is_admin FROM users");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']} {$row['last_name']}</td>
                            <td>{$row['email']}</td>
                            <td>" . ($row['is_admin'] ? 'Admin' : 'User') . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
