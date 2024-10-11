<?php
// Database connection details
$host = 'localhost';
$db = 'coffeeshop';
$user = 'root'; // Your database username
$pass = ''; // Your database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request to update prices
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Loop through each price in the POST data
    foreach ($_POST['prices'] as $name => $value) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE menu_items SET price = ? WHERE name = ?");
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ds", $value, $name);
            $stmt->execute();
            $stmt->close(); // Close the statement
        } else {
            echo "Error preparing statement: " . $conn->error; // Error handling
        }
    }
    // Redirect after processing
    header("Location: index.php");
    exit();
}

$conn->close();
?>