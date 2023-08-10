<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rugby";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO feedbacks (name, email, message) VALUES (?,?,?)");
    $stmt->bind_param("sss",$name, $email, $message);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>