<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Trellis</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .about-banner {
            width: 100%;
            height: 25vh;
            background: url('assets/images/booking-banner.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .about-content {
            max-width: 900px;
            margin: 40px auto;
            text-align: center;
        }

        .about-content img {
            width: 100%;
            border-radius: 10px;
            margin-top: 20px;
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
            <li><a href="#">About Us</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <!-- Banner Section -->
    <div class="about-banner">About Trellis</div>

    <!-- About Content -->
    <section class="about-content">
        <h2>Welcome to Trellis</h2>
        <p>Trellis is a modern transportation solution dedicated to providing eco-friendly and efficient travel experiences. Our network connects major cities and rural areas seamlessly, ensuring a comfortable journey for all passengers.</p>

        <h3>Why Choose Trellis?</h3>
        <p>With a commitment to sustainability and affordability, Trellis ensures that passengers enjoy a smooth, reliable, and cost-effective ride. Our state-of-the-art trains and customer-first approach set us apart from traditional transit systems.</p>
        
        <img src="assets/images/pod.png" alt="Trellis Train Image">
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Trellis. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>