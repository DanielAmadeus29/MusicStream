<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php
            session_start();  // Start the session at the top

            // Database connection
            $servername = "localhost";
            $usernameDB = "root";  // Update as per your database credentials
            $passwordDB = "";
            $dbname = "musicstream";

            // Create a new connection
            $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

            // Check if the connection works
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Prepare the SQL query
                $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("ss", $username, $password);  // Bind parameters
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // If the user exists, log them in
                    if ($result->num_rows > 0) {
                        $_SESSION['username'] = $username;  // Store username in session
                        header("Location: home.php");  // Redirect to the home page
                        exit();  // Stop further execution after redirect
                    } else {
                        echo "<p style='color: red;'>Invalid username or password. Please try again.</p>";
                    }

                    // Close the statement
                    $stmt->close();
                } else {
                    echo "<p style='color: red;'>Error preparing the statement.</p>";
                }
            }

            // Close the connection
            $conn->close();
        ?>

        <!-- Login form -->
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

</body>
</html>
