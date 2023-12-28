<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $email = $_POST['username']; // Update this line
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM registration WHERE email='$email' AND password='$password' AND role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row;

        if ($row['role'] == 'admin') {
            header("Location: admin.php");
        } elseif ($row['role'] == 'teacher') {
            header("Location: faculty.html");
        } elseif ($row['role'] == 'student') {
            header("Location: student.html");
        }
    } else {
        echo "Invalid username, password, or role";
    }
}

$conn->close();
?>
