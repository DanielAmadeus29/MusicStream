<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musicstream";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT title, artist FROM song WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h1>Playlist</h1><ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row["title"]) . " by " . htmlspecialchars($row["artist"]) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h1>Playlist</h1><p>No songs found for your account.</p>";
    }

    $stmt->close();
} else {

    echo "<h1>Playlist</h1><p>Please <a href='login.php'>log in</a> to view the playlist.</p>";
}

$conn->close();
?>
