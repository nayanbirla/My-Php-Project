<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if (session_id() == "" || !isset($_SESSION)) {
  session_start();
}

if ($_SESSION["type"] != "admin") {
  header("location:index.php");
}

include "config.php";
$product_name = $_POST["name"];
$product_imageurl = $_POST["imageUrl"];
$product_description = $_POST["description"];
$product_price = $_POST["price"];
$product_qty = $_POST["qty"];
if (
  empty($product_name) ||
  empty($product_imageurl) ||
  empty($product_description) ||
  empty($product_price) ||
  empty($product_qty)
) {
  header("location:admin.php");
} else {
  $mysqli->query(
    "INSERT INTO products VALUES ('','" .
      $product_name .
      "','" .
      $product_description .
      "','" .
      $product_imageurl .
      "','" .
      $product_qty .
      "','" .
      $product_price .
      "')"
  );
  header("location:success.php");
}

?>
