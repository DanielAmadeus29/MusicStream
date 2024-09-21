<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add a song.";
    exit();
}

// Database connection
$servername = "localhost";
$usernameDB = "root";  // Replace with your database username if different
$passwordDB = "";
$dbname = "musicstream";  // Your database name

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $user_id = $_SESSION['user_id'];  // Get the logged-in user's ID from the session

    // Insert song into the database
    $stmt = $conn->prepare("INSERT INTO song (title, artist, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $artist, $user_id);

    if ($stmt->execute()) {
        echo "Song added successfully!";
    } else {
        echo "Error adding song: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
