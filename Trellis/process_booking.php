<?php
session_start();
include 'includes/db_config.php';

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Collect POST data
$user_id = $_SESSION["user_id"];
$departure_station = $_POST["departure_station"];
$destination_station = $_POST["destination_station"];
$travel_date = $_POST["travel_date"];
$travel_time = $_POST["travel_time"];
$status = "Confirmed"; //"Pending"; // Default status

// Validate user input
$departure_station = trim($departure_station);
$destination_station = trim($destination_station);
$travel_date = trim($travel_date);
$travel_time = trim($travel_time);

// Prepare SQL statement with the correct number of parameters
$stmt = $conn->prepare("INSERT INTO bookings (user_id, departure_station, destination_station, travel_date, travel_time, status) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $user_id, $departure_station, $destination_station, $travel_date, $travel_time, $status);

if ($stmt->execute()) {
    echo "<script>alert('Booking Successful!'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('Error: Booking Failed.'); window.location.href='dashboard.php';</script>";
}

// Close statement & connection
$stmt->close();
$conn->close();
?>
