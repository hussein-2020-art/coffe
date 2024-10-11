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

// Get the ID from the form
$name = $_POST['name'];

// Prepare the SQL statement to delete the item
$stmt = $conn->prepare("DELETE FROM menu_items WHERE name = ?");
$stmt->bind_param("s", $name); // 'i' for integer

// Execute the statement
if ($stmt->execute()) {
    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        header("Location: index.php");
    } else {
        echo "No item found with that name.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();

// Redirect back to menu (optional)
// header("Location: index.php"); // Change to the appropriate redirect URL
// exit();
?>