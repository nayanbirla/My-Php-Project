<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if (session_id() == "" || !isset($_SESSION)) {
  session_start();
} ?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact || proChamp</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php"><span style="font-family: 'comfortaaregular', cursive;" >proChamp</span></a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li class="active"><a href="contact.php">Contact</a></li>
          <?php if (isset($_SESSION["username"])) {
            echo '<li><a href="account.php">My Account</a></li>';
            echo '<li><a href="logout.php">Log Out</a></li>';
          } else {
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li><a href="register.php">Register</a></li>';
          } ?>
        </ul>
      </section>
    </nav>

    <div class="row" style="margin-top:30px;">
      <div class="columns small-centered">

        <h3>Wanna get in touch. </h3>
        <ul class="small-block-grid-3" data-equalizer >
          <li  ><a class="th" data-equalizer-watch target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=nayanbirla9893@gmail.com"><img src="images/email.png" alt="email"> </a></li>
          <li ><a class="th" data-equalizer-watch target="_blank" href="https://www.instagram.com/nayanbirla2002/?hl=en"><img src="images/insta.png" alt="instagram"></a></li>
          <li ><a class="th" data-equalizer-watch target="_blank" href="https://wa.me/916264625233?text=Hi%21%20Nayan%2C%0AI%20came%20here%20through%20proChamp%20site%0A"><img src="images/whatsapp.png" alt="whatsapp"> </a></li>
        </ul>
      </div>
    </div>
    <div class="row" style="margin-top:30px;">
      <div class="small-12">
        
        <footer>
           <p style="text-align:center; font-size:0.8em;">&copy; proChamp. All Rights Reserved.</p>
        </footer>

      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
