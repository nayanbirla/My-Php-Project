<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if (session_id() == "" || !isset($_SESSION)) {
  session_start();
}

include "config.php";

$action = $_GET["action"];
if ($_GET["id"] && $action !== "empty") {
  $product_id = $_GET["id"];
  $result = $mysqli->query(
    "SELECT qty FROM products WHERE id = " . $product_id
  );

  if ($result) {
    if ($obj = $result->fetch_object()) {
      switch ($action) {
        case "add":
          if ($_SESSION["cart"][$product_id] + 1 <= $obj->qty) {
            $_SESSION["cart"][$product_id]++;
          }
          break;

        case "remove":
          $_SESSION["cart"][$product_id]--;
          if ($_SESSION["cart"][$product_id] == 0) {
            unset($_SESSION["cart"][$product_id]);
          }
          break;
      }
    }
  }
}
if ($action === "empty") {
  unset($_SESSION["cart"]);
}

header("location:cart.php");

?>
