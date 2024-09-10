<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Tasty Scoop</title>
    <link rel="stylesheet" href="styles.css" >

</head>
<body>
    <nav>
        <img class="navImage" src="./img/logo.png" alt="Tasty Scoop Logo">
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

    <h1>Welcome To Tasty Scoop</h1>
    <div class=pr4>
        <h2>Here you can find all kinds of delicious and special flavors</h2>
    </div>
    <a href="about.php" class="btn"> <b>LEARN MORE</b></a>


    <form class="myform" method="post" action="home.php">
    
        <input type="radio" name="color" id="sun" value="sun" />
        <label class="ckb" for="sun"><img height="25" src="img/sun.png" alt="Sun" /></label>
    
    
        <input type="radio" name="color" id="moon" value="moon" />
        <label class="ckb" for="moon"><img height="25" src="img/moon.png" alt="Moon" /></label>
    <br>
    <input type="submit" class="btn" value="save">
   </form>

    
<?php
     if($_COOKIE['color'] ){
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
     }
        if (isset($_POST["color"])) {
             setcookie("color",$_POST["color"],time()+(86400*30),"/");
           
        } 
        
    
    ?>

</body>
</html>