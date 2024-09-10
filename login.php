<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: home.php"); // Redirect to the home page if the user is already logged in
    exit;
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the login credentials
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a database connection
     $conn = new mysqli('localhost','root','','tastyscoop');

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to fetch user information based on the entered username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get the result from the query
    $result = $stmt->get_result();

    // Check if a user with the entered username exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the entered password against the password stored in the database
        if ($password === $row['password']) {
            // Password is correct, set session variables and redirect to the home page
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit;
        } else {
            // Invalid password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User does not exist
        echo "User does not exist. Please try again.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <nav>
        <img src="./img/logo.png" alt="Tasty Scoop Logo">
        <ul>

            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="gallery.php">Gallery</a></li>

            <?php
            // Check if the user is logged in
            if (isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                echo '<li><a href="profile.php">' . $username . '</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="signup.php">Sign Up</a></li>';
            }
            ?>

        </ul>
    </nav>

    <div class="pr1">
        <h2>Login</h2>
    </div>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="pr2">
        <label for="username">username:</label>
        <input type="text" id="username" name="username" required><br><br>
        </div>

        <div class="pr3">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        </div>
        
        <input type="submit" class="btn" value="Login">
    </form>


    <?php
     
        
            if ($_COOKIE['color'] == "sun") {
                  echo '
          <style>
        body {
              background-color: #FDF3E7;
              color: #333;
        }
       
    </style>';
               
            }
            if ($_COOKIE['color']== "moon") {
               echo '
          <style>
        body {
            background-color: #1E2B43;
            color: white;
        }
    </style>';
            }
      
    
    ?>
</body>
</html>
