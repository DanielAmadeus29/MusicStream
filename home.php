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
                contentDiv.innerHTML = '<h1>Home Page</p>';
            } else if (section === 'Search') {
                contentDiv.innerHTML = '<h1>Search</p>';
            } else if (section === 'Playlist') {
                contentDiv.innerHTML = '<h1>Playlist</p>';
            }
            else if (section === 'AddSong') {
                contentDiv.innerHTML = '<h1>Add Song</p>';
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
