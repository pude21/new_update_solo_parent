<?php

// Database configuration
$servername = "localhost"; // Change if your database host is different
$username = "root";        // Update with your database username
$password = "";            // Update with your database password
$dbname = "solo_parent";   // Replace with your database name

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    // Log the error for debugging purposes
    error_log("Connection failed: " . mysqli_connect_error());
    die("Database connection failed. Please try again later."); // More user-friendly error message
}

// Uncomment the line below for testing during development
// echo "Connected Successfully";

?>
