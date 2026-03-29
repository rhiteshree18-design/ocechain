<?php
// Database connection settings
$servername = "localhost";   // usually "localhost"
$username   = "root";        // default XAMPP username
$password   = "Hetu1812";            // default XAMPP password is empty
$dbname     = "ngo_registry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data safely
$orgName   = $conn->real_escape_string($_POST['orgName']);
$regNumber = $conn->real_escape_string($_POST['regNumber']);
$email     = $conn->real_escape_string($_POST['email']);
$password  = password_hash($_POST['password'], PASSWORD_BCRYPT); // hash password

// Insert into database
$sql = "INSERT INTO ngos (org_name, reg_number, email, password)
        VALUES ('$orgName', '$regNumber', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ NGO Registered Successfully!</h2>";
    echo "<a href='index.html'>Back to Registration</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
