<?php

$servername = "localhost";
$username = "root"; 
$password = "";   
$dbname = "musicstream"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT title, artist FROM song";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<h1>Playlist</h1><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row["title"]) . " by " . htmlspecialchars($row["artist"]) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h1>Playlist</h1><p>No songs found</p>";
}

// Close connection
$conn->close();
?>
