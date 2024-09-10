<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    // User is not logged in, redirect to the login page
    header("Location: home.php");
    exit;
}

// Get the user's account details from the session
$username = $_SESSION["username"];

// Create a database connection
$conn = new mysqli('localhost','root','','tastyscoop');

// Check if the connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle the delete account action
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        // Delete the user's account from the database
        $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Check if the account was deleted successfully
        if ($stmt->affected_rows === 1) {
            // Account deleted, redirect to the login page and end the session
            header("Location: login.php");
            session_destroy();
            exit;
        } else {
            // Failed to delete the account
            echo "Failed to delete the account. Please try again.";
        }

        // Close the database connection
        $stmt->close();
    }
}

// Prepare a SQL statement to retrieve the user's account details
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists in the database
if ($result->num_rows === 1) {
    // User found, retrieve the account details
    $row = $result->fetch_assoc();
    $userId = $row["id"];
    $email = $row["email"];
    // Add more account details as needed
} else {
    // User not found in the database
    echo "Error retrieving user account details.";
}

// Close the database connection //<div class="about-content"></div>
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
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

    <div class="frame">

        <div class="pr1">
            <h2>User Profile</h2>  
        </div>

        <div class="pr2">
            <p><strong>Username:</strong> <?php echo $username; ?></p>
        </div>

        <div class="pr3">
            <p><strong>Email:</strong> <?php echo $email; ?></p>
        </div>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="submit" class="btn" name="delete" value="Delete Account">
            <a href="update.php" class="btn"> <b>Update Password</b></a>
        </form>

    </div>

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