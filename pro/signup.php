<?php
$host = "localhost";
$dbname = "udyog";
$username = "root";
$password = "";

// Connect to DB
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$first = htmlspecialchars($_POST['first-name']);
$last = htmlspecialchars($_POST['last-name']);
$email = htmlspecialchars($_POST['email']);
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm-password'];

// Check password match
if ($pass !== $confirm_pass) {
    die("Passwords do not match.");
}

// Hash password
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (first_name, last_name, email, password)
        VALUES ('$first', '$last', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Account created successfully!'); window.location.href='index.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
