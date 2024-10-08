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
    session_start(); 

    $servername = "localhost";
    $usernameDB = "root"; 
    $passwordDB = "";
    $dbname = "musicstream";

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];


        $sql = "SELECT user_id, username FROM login WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {

            $stmt->bind_param("ss", $username, $password);  
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc(); 

                $_SESSION['user_id'] = $user['user_id']; 
                $_SESSION['username'] = $user['username']; 

                header("Location: home.php");
                exit();  
            } else {
                echo "<p style='color: red;'>Invalid username or password. Please try again.</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color: red;'>Error preparing the statement.</p>";
        }
    }
    $conn->close();
?>
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
