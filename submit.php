<?php
// Check if form data is present
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to the database
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "contact"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data and sanitize
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into database using prepared statement
    $sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Send success response to the client
        http_response_code(200); // OK status code
        echo "Form submitted successfully";
    } else {
        // Send error response to the client
        http_response_code(500); // Internal Server Error status code
        echo "Error: Form submission failed";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If form data is not present, send a 405 Method Not Allowed response
    http_response_code(405); // Method Not Allowed status code
    echo "Method Not Allowed";
}
?>

