<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: login.php");
    exit;
}

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

// Fetch payments from the database
$sql = "SELECT id, name, email, mobile, address, message, payment_id, created_at FROM payments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Payments</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Payments</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Message</th>
                    <th>Payment ID</th>
                    <th>Date Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"]. "</td>
                                <td>" . $row["name"]. "</td>
                                <td>" . $row["email"]. "</td>
                                <td>" . $row["mobile"]. "</td>
                                <td>" . $row["address"]. "</td>
                                <td>" . $row["message"]. "</td>
                                <td>" . $row["payment_id"]. "</td>
                                <td>" . $row["created_at"]. "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No payments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
