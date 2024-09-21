<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <div class="login-container">
        <h2>Register</h2>
        <?php

            $servername = "localhost";
            $usernameDB = "root";
            $passwordDB = "";
            $dbname = "musicuser";

            $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $checkUser = $conn->prepare("SELECT * FROM login WHERE username = ?");
                $checkUser->bind_param("s", $username);
                $checkUser->execute();
                $checkResult = $checkUser->get_result();

                if ($checkResult->num_rows > 0) {
                    echo "<p style='color: red;'>Username already exists! Please choose another one.</p>";
                } else {

                    $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
                    $stmt->bind_param("ss", $username, $password);

                    if ($stmt->execute()) {
                        echo "<p style='color: green;'>Registration successful! You can now <a href='login.php'>login</a>.</p>";
                    } else {
                        echo "<p style='color: red;'>Error during registration. Please try again.</p>";
                    }

                    $stmt->close();
                }

                $checkUser->close();
            }

            $conn->close();
        ?>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
            <p>Back to <a href="login.php">Log in</a> Page</p>

        </form>
    </div>

</body>
</html>
