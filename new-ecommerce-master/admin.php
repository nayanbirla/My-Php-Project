<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if (session_id() == "" || !isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION["username"])) {
  header("location:index.php");
}

if ($_SESSION["type"] != "admin") {
  header("location:index.php");
}

include "config.php";
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin || proChamp</title>
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


    <div class="row" style="margin-top:10px;">
      <div class="large-12">
        <h3>Hey Admin!</h3>
        <div class="tiny reveal-modal" id="product-form-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
          <h3 id="modalTitle">Add New Product</h3>
          <form action="add-product.php" method="post" name="add-product" >
          <p><label for="product-name">Product Name</label> <input name="name" id="product-name" type="text"></p>
            <p><label for="image-url">Image Url</label> <input name="imageUrl" type="text" id="image-url" ></p>
            <p><label for="description">Description</label> <textarea name="description" id="description" rows="3" ></textarea></p>
            <p><label for="unit-price">Price Per Unit</label><input id="unit-price" name="price" type="number"></p>
            <p><label for="units-available">Units Available</label><input id="units-available" name="qty" type="number"></p>
            <center><button class="button small">Submit</button></center>
          </form>
          <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>
        <center><button class="button success" data-reveal-id="product-form-modal">Add Product</button></center>
        <form method="post" name="update-quantity" action="admin-update.php">
        <div class="row" style="margin-top:10px;" >
        <ul class="small-12 small-block-grid-2 medium-block-grid-3 large-block-grid-3" data-equalizer >
        <?php
        $result = $mysqli->query("SELECT * from products order by id asc");
        if ($result) {
          while ($obj = $result->fetch_object()) {
            echo "<li >";
            echo "<div class='panel radius' data-equalizer-watch >";
            echo '<p><h3><input type="text" name="name[]" value="' .
              $obj->product_name .
              '"/></h3></p>';
            echo '<img class="th" src="' . $obj->product_img_name . '"/>';
            echo "<p><strong>New Url:</strong></p>";
            echo '<input type="text" name="imgurl[]" value="' .
              $obj->product_img_name .
              '" />';
            echo '<p><strong>Description</strong>:<textarea name="description[]" rows="6"> ' .
              $obj->product_desc .
              "</textarea></p>";
            echo "<p><strong>Price Per Unit</strong>: <input type='number' value='" .
              $obj->price .
              "' name='price[]' /></p>";
            echo "<p><strong>New Qty</strong>:</p>";
            echo '<input type="number" name="quantity[]"/>';
            echo "<p><strong>Units Available</strong>: " . $obj->qty . "</p>";
            echo '<form method="post" name="delete-product" action="product-delete.php" >';
            echo '<input style="display:none;" type="number" name="delete" value="' .
              $obj->id .
              '" />';
            echo '<button class="button alert" >Delete</button>';
            echo "</form>";
            echo "</div>";
            echo "</li>";
          }
        }
        ?>
        <center>
          <p><input style="clear:both; display:block; margin-top:20px; " type="submit" class="button" value="Update"></p>
        </center>
        </ul>
        </div>
        </form>
      </div>
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        
        <footer style="margin-top:10px;">
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
