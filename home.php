<?php
// Database connection details
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";      // Your MySQL password
$dbname = "musicstream";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// This block will only run when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $title = $_POST['title'];
    $artist = $_POST['artist'];

    // SQL query to insert data into the "song" table
    $sql = "INSERT INTO song (title, artist) VALUES ('$title', '$artist')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New song inserted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    // Close the connection
    $conn->close();
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

            if (section === 'Home') {
                contentDiv.innerHTML = '<h1>Home Page</h1>';
            } else if (section === 'Search') {
                contentDiv.innerHTML = '<h1>Search</h1>';
            } else if (section === 'Playlist') {
                contentDiv.innerHTML = '<h1>Playlist</h1>';
            }
            else if (section === 'AddSong') {
                contentDiv.innerHTML = `
                    <h1>Add Song</h1>
                    <form method="post" action="">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required><br><br>
        
                        <label for="artist">Artist:</label>
                        <input type="text" id="artist" name="artist" required><br><br>
        
                        <input type="submit" value="Insert Song">
                    </form>
                `;
            }
        }
    </script>
</head>
<body>

    <div class="navbar">
        <p><h2>Music Streaming</h2></p>
        <a href="#" onclick="displayContent('Home')">Home</a>
        <a href="#" onclick="displayContent('Search')">Search</a>
        <a href="#" onclick="displayContent('Playlist')">Playlist</a>
        <a href="#" onclick="displayContent('AddSong')">Add Song</a>
    </div>

    <div class="content" id="content-display">
        <h1>Welcome</h1>
        <p>Please select a section from the menu.</p>
    </div>

</body>
</html>
