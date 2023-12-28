<?php
// Assuming your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from the form
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Verify login credentials
$sql = "SELECT * FROM registration WHERE email='$username' AND role='$role'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPasswordFromDB = $row['password'];

    // Verify the entered password against the stored hash
    if (password_verify($password, $hashedPasswordFromDB)) {
        if ($row['role'] == 'admin') {
            header("Location: admin.php");
        } elseif ($row['role'] == 'teacher') {
            header("Location: faculty.html");
        } elseif ($row['role'] == 'student') {
            header("Location: student.html");
        }
        // Add any additional logic you need after successful login
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found or role mismatch";
}

// Close the database connection
$conn->close();
?>
