<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_first_name = $_SESSION["first_name"];
$user_last_name = $_SESSION["last_name"];
include 'includes/db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Trellis</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Navigation Bar Fix */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 15px;
        }
        .nav-logo {
            color: white;
            font-size: 20px;
            font-weight: bold;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 15px;
        }
        .nav-links li {
            display: inline;
        }
        .nav-links a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            background-color: #007bff;
            border-radius: 5px;
        }
        .logout-btn {
            background-color: red;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        
        /* Responsive Navigation Bar */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-links {
                flex-direction: column;
                width: 100%;
                padding: 10px 0;
            }
            .nav-links a, .logout-btn {
                width: 100%;
                text-align: center;
                display: block;
            }
        }
        
         /* Booking Section Centering */
         .booking, .user-bookings {
            max-width: 800px;
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
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }
        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-logo">Trellis</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="booking.php">Booking</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-overlay">
            <h1>Ride with Us</h1>
            <p>Welcome, <?php echo htmlspecialchars($user_first_name); ?>!</p>
        </div>
    </header>

    <!-- Booking Section -->
<section class="booking">
    <h2>Book a Train Ticket</h2>
    <form action="process_booking.php" method="post">
        <label>Departure Station Number:</label>
        <select name="departure_station" required>
            <option value="" disabled selected>Select Station</option>
            <?php for ($i = 1; $i <= 10; $i++) {
                echo "<option value='Station$i'>Station$i</option>";
            } ?>
        </select>

        <label>Destination Station Number:</label>
        <select name="destination_station" required>
            <option value="" disabled selected>Select Station</option>
            <?php for ($i = 1; $i <= 10; $i++) {
                echo "<option value='Station$i'>Station$i</option>";
            } ?>
        </select>

        <label>Travel Date:</label>
        <input type="date" name="travel_date" required>

        <label>Travel Time:</label>
        <input type="time" name="travel_time" required>

        <button type="submit">Book Now</button>
    </form>
</section>


        <!-- User Bookings -->





    <!-- Why Choose Us Section -->
    <section class="why-choose">
        <h2>Why Choose Us?</h2>
        <div class="features">
            <div class="feature">
                <span class="feature-number">01</span>
                <h3>Environmental Friendly</h3>
                <p>Our trains are powered by clean energy, reducing carbon emissions.</p>
            </div>
            <div class="feature">
                <span class="feature-number">02</span>
                <h3>Save Money</h3>
                <p>Affordable and competitive pricing for all travelers.</p>
            </div>
            <div class="feature">
                <span class="feature-number">03</span>
                <h3>Work with the Best Team</h3>
                <p>Reliable and professional service for your convenience.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Trellis. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
