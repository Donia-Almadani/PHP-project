<?php

session_start();

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the form fields
    $oldpassword = $_POST['oldpassword'];
    $password = $_POST['password'];

    // Create a database connection
    $conn = new mysqli('localhost','root','','tastyscoop');
 

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }else{

         
     if($oldpassword&&$password )
        $sql = "UPDATE users SET password='$password' WHERE username='" . $_SESSION['username'] . "' AND password='$oldpassword'";
        $t=mysqli_query($conn, $sql);
        if($t)
        header("Location: logout.php");
       else 
        echo"Error updating password";

 
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
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
        <h2>Update</h2>
    </div>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


        <div class="pr3">
            <label for="oldpassword">Old Password:</label>
            <input type="oldpassword" id="oldpassword" name="oldpassword" required><br><br>
        </div>

        <div class="pr4">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required><br><br>
        </div>
        
        
        <input type="submit" class="btn" value="Update">
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