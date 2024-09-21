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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST['title'];
    $artist = $_POST['artist'];

    $sql = "INSERT INTO song (title, artist) VALUES ('$title', '$artist')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New song inserted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

function fetchSongs($conn) {
    $sql = "SELECT title, artist FROM song";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $output = "<h1>Playlist</h1><ul>";
        while ($row = $result->fetch_assoc()) {
            $output .= "<li>" . htmlspecialchars($row["title"]) . " by " . htmlspecialchars($row["artist"]) . "</li>";
        }
        $output .= "</ul>";
    } else {
        $output = "<h1>Playlist</h1><p>No songs found</p>";
    }
    return $output;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Left Navigation Layout</title>
    <link rel="stylesheet" href="homestyle.css">
    <script>
        function displayContent(section) {
            const contentDiv = document.getElementById('content-display');
            const username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>";

            if (section === 'Home') {
                contentDiv.innerHTML = `<h1>Welcome ${username}!</h1>`;
            } else if (section === 'Search') {
                contentDiv.innerHTML = '<h1>Search</h1>';
            } else if (section === 'Playlist') {
                fetch('playlist.php')
                    .then(response => response.text())
                    .then(data => {
                        contentDiv.innerHTML = data;
                    });
            } else if (section === 'InsertSong') {
                contentDiv.innerHTML =
                    `<h1>Insert Song</h1>
                    <form method="post" action="insertsong.php">
                        <label for="title">Title: <span style="color: red;">Required</span></label>
                        <input type="text" id="title" name="title" required><br><br>

                        <label for="artist">Artist: <span style="color: red;">Required</span></label>
                        <input type="text" id="artist" name="artist" required><br><br>

                        <input type="submit" value="Insert Song">
                    </form>
                    <p id="status-message"></p>`;
            }
        }
        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const section = urlParams.get('section');
            displayContent('Home');
        }
    </script>
    
</head>
<body>
    <div class="navbar">
        <p><h2>Music Streaming</h2></p>
        <a href="#" onclick="displayContent('Home')">Home</a>
        <a href="#" onclick="displayContent('Search')">Search</a>
        <a href="#" onclick="displayContent('Playlist')">Playlist</a>
        <a href="#" onclick="displayContent('InsertSong')">Insert Song</a>
    </div>

    <div class="content" id="content-display">
        <h1>Welcome</h1>
        <p>Please select a section from the menu.</p>
    </div>
</body>
</html>
