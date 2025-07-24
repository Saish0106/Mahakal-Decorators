<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "decoration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hash the password
$hashed_password = password_hash('admin', PASSWORD_DEFAULT);

// SQL to insert the admin user
$sql = "INSERT INTO admin_users (username, password) VALUES ('saish', '$hashed_password')";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "New admin user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
