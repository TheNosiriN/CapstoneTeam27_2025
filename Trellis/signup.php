<?php
include 'includes/db_config.php'; // Include database connection

$error = ""; // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone_number = trim($_POST['phone_number']);
    $birthday = $_POST['birthday'];

    // Validate input
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($phone_number) || empty($birthday)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $error = "Password must be at least 8 characters long, include one uppercase letter, one number, and one special character.";
    } elseif (!preg_match("/^\d{10,15}$/", $phone_number)) {
        $error = "Invalid phone number format.";
    }

    //// If no errors, insert into database
    if (empty($error)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, phone_number, birthday) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $hashed_password, $phone_number, $birthday);

        if ($stmt->execute()) {
            header("Location: login.php"); // Redirect to login page on success
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Trellis</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="center-container"> <!-- Centering Wrapper -->
        <div class="container">
            <h2>Signup for Trellis</h2>
            
            <?php if (isset($error) && $error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="signup.php" method="post">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone_number" placeholder="Phone Number" required>
                <input type="date" name="birthday" required>
                <button type="submit">Signup</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

</body>
</html>

