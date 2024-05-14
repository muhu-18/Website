<?php
// Establish connection to the database
$servername = "localhost"; // Change this to your database server name
$username = "username"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "Contact"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['Name'];
$email = $_POST['email'];
$message = $_POST['Message'];

// Insert data into database
$sql = "INSERT INTO Feedback (Name, email, Message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
