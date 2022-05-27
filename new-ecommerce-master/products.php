<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if (session_id() == "" || !isset($_SESSION)) {
  session_start();
}
include "config.php";
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products || proChamp</title>
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
          <li class='active'><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
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
    <div class="row" style="margin-top:10px;" >
    <ul class="small-12 small-block-grid-2 medium-block-grid-3 large-block-grid-3" data-equalizer >
        <?php
        $i = 0;
        $product_id = [];
        $product_quantity = [];

        $result = $mysqli->query("SELECT * FROM products");
        if ($result === false) {
          die(mysql_error());
        }

        if ($result) {
          while ($obj = $result->fetch_object()) {
            echo "<li >";
            echo "<div class='panel radius' data-equalizer-watch >";
            echo "<p><h3>" . $obj->product_name . "</h3></p>";
            echo '<img src="' . $obj->product_img_name . '"/>';
            echo "<p><strong>Description</strong>: " .
              $obj->product_desc .
              "</p>";
            echo "<p><strong>Units Available</strong>: " . $obj->qty . "</p>";
            echo "<p><strong>Price (Per Unit)</strong>: " .
              $currency .
              $obj->price .
              "</p>";
            if ($obj->qty > 0) {
              echo '<p><a href="update-cart.php?action=add&id=' .
                $obj->id .
                '"><input class="button primary" type="submit" value="Add To Cart" /></a></p>';
            } else {
              echo "Out Of Stock!";
            }
            echo "</div>";
            echo "</li>";
            $i++;
          }
        }
        $_SESSION["product_id"] = $product_id;
        ?>
      </ul>
    </div>

    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;clear:both;">&copy; proChamp. All Rights Reserved.</p>
        </footer>
      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation({
        equalizer : {
          equalize_on_stack: true
        }});
    </script>
  </body>
</html>
