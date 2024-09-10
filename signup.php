<?php
// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the form fields
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a database connection
    $conn = new mysqli('localhost','root','','tastyscoop');
 

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Check if the username is already taken
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username already taken
        echo "Username already taken. Please choose a different username.";
    } else {
        // Prepare a SQL statement to insert the user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        // Check if the user was inserted successfully
        if ($stmt->affected_rows === 1) {
            // User registered successfully, redirect to the login page
            header("Location: login.php");
            exit;
        } else {
            // Failed to register the user
            echo "Registration failed. Please try again.";
        }
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
        <h2>Sign Up</h2>
    </div>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="pr2">
            <label for="username">username:</label>
            <input type="text" id="username" name="username" required><br><br>
        </div>

        <div class="pr3">
            <label for="emailconfirm_password">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
        </div>

        <div class="pr4">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
        </div>
        
        
        <input type="submit" class="btn" value="Sign Up">
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