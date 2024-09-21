<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add a song.";
    exit();
}

$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "musicstream";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO song (title, artist, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $artist, $user_id);

    if ($stmt->execute()) {
        header("Location: home.php?section=InsertSong");
        exit();
    } else {
        exit();
    }
    

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
