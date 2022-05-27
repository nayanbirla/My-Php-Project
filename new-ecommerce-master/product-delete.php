<?php

if (session_id() == "" || !isset($_SESSION)) {
  session_start();
}

if ($_SESSION["type"] != "admin") {
  header("location:index.php");
}
include "config.php";

$productId = $_POST["delete"];

$mysqli->query("DELETE from products WHERE id=$productId");

header("location:success.php");

?>
