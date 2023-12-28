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
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$studentID = $_POST['studentID'];
$section = $_POST['section'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Insert data into the registration table
$sql = "INSERT INTO registration (firstname, lastname, studentID, section, email, password, role) 
        VALUES ('$firstname', '$lastname', '$studentID', '$section', '$email', '$password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
