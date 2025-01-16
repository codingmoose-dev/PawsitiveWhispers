<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PawsitiveWellbeing";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all users from the veterinarians table
$sql = "SELECT * FROM veterinarians";

// Execute the query
$result = $conn->query($sql);

// Check if the query returned any results
if ($result->num_rows > 0) {
    // Output the data for each row in the result set
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    }
} else {
    // If no users are found, display this message
    echo "No users found.";
}

// Close the database connection
$conn->close();
?>
