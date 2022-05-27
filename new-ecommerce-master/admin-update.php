<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if (session_id() == "" || !isset($_SESSION)) {
  session_start();
}

if ($_SESSION["type"] != "admin") {
  header("location:index.php");
}

include "config.php";

$_SESSION["products_qty"] = [];
$_SESSION["products_qty"] = $_REQUEST["quantity"];
$_SESSION["products_description"] = [];
$_SESSION["products_description"] = $_REQUEST["description"];
$_SESSION["products_name"] = [];
$_SESSION["products_name"] = $_REQUEST["name"];
$_SESSION["products_price"] = [];
$_SESSION["products_price"] = $_REQUEST["price"];
$_SESSION["products_imgUrl"] = [];
// foreach ($_REQUEST["quantity"] as $qty) {
//   echo $qty;
// }

$_SESSION["products_imgUrl"] = $_REQUEST["imgurl"];

$result = $mysqli->query("SELECT * FROM products ORDER BY id asc");
$i = 0;
$j = 0;
$x = 1;
$y = 1;

if ($result) {
  while ($obj = $result->fetch_object()) {
    if (
      !(($obj->qty != ((int) $obj->qty + (int) $_SESSION["products_qty"][$i]))||
    ($obj->product_name != $_SESSION["products_name"][$i])||
    ($obj->product_desc != $_SESSION["products_description"][$i])||
    ($obj->product_img_name != $_SESSION["products_imgUrl"][$i])||
    ($obj->price != $_SESSION["products_price"][$i]))
    ) {
      $i++;
      $x++;
    } else {
      $newqty = (int) $obj->qty + (int) $_SESSION["products_qty"][$i];
      $newdescription = $_SESSION["products_description"][$i];
      $newname = $_SESSION["products_name"][$i];
      $newprice = $_SESSION["products_price"][$i];
      $newimgUrl = $_SESSION["products_imgUrl"][$i];
      echo $newqty;
      echo $newdescription;
      echo $newname;
      echo $newprice;
      echo $newimgUrl;
      if ($newqty < 0) {
        $newqty = 0;
        $newprice = 0;
      } //So, Qty will not be in negative.
      $update = $mysqli->query(
        "UPDATE products SET qty =" .
          $newqty .
          ",product_name ='" .
          addslashes(trim($newname)) .
          "',product_desc ='" .
          addslashes(trim($newdescription)) .
          "',price='" .
          $newprice .
          "',product_img_name='" .
          addslashes(trim($newimgUrl)) .
          "' WHERE id =" .
          $x
      );
      if ($update) {
        echo "Data Updated";
      }

      $i++;
      $x++;
    }
  }
}

header("location:success.php");

?>
