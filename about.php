<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>About</title>
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

    <section id="about">
        <div class="container">

            <div class="title">
                <h2>Tasty Scoop History</h2>
                <p>More than 10+ years of experience</p>
            </div>

            <div class="about-content">

                <div>
                    <p>In 2010, we started the journey of Tasty Scoop and entered the market in a simple way that carries with it great aspirations until we started building a team that was ready to launch at a high level that made it difficult for competitors to keep up, in order to achieve high successes and gains the most important of which is the confidence of our customers in what we offer.</p>
                    <p>Tasty Scoop has become a distinctive brand throughout the Kingdom, and with the increase in demand, Tasty Scoop management decided that the expansion should be through partners and through a system that guarantees Tasty Scoop's access to these areas in the correct manner, which is the franchise system.</p>
                </div>

                <img src="./img/about.jpg" alt="About Img">
            </div>
        </div>
    </section>
    
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