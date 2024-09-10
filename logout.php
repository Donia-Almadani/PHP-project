<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page
header("Location: home.php");
exit;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout Page</title>
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

    <h2>Logout</h2>
    <form action="logout.php" method="post">
        <p>Are you sure you want to log out?</p>
        <input type="submit" value="Logout">
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