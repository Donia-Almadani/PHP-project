<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
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

    <!-- Gallery Section Start -->
    <section id="gallery">
        <div class="container">
            <h2>Our Customers Pics</h2>
            <div class="img-gallery">
                <img src="./OurCustomers/gallery1.jpg" alt="gallery1">
                <img src="./OurCustomers/gallery2.jpg" alt="gallery2">
                <img src="./OurCustomers/gallery3.jpg" alt="gallery3">
                <img src="./OurCustomers/gallery4.jpg" alt="gallery4">
                <img src="./OurCustomers/gallery5.jpg" alt="gallery5">
                <img src="./OurCustomers/gallery6.jpg" alt="gallery6">
                <img src="./OurCustomers/gallery7.jpg" alt="gallery7">
                <img src="./OurCustomers/gallery8.jpg" alt="gallery8">
                <img src="./OurCustomers/gallery9.jpg" alt="gallery9">
                <img src="./OurCustomers/gallery10.jpg" alt="gallery10">
                <img src="./OurCustomers/gallery11.jpg" alt="gallery11">
                <img src="./OurCustomers/gallery12.jpg" alt="gallery12">
            </div>
        </div>
    </section>
    <!-- Gallary Section End -->

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