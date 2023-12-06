<?php
if(empty($_SESSION['customer'])){
  header('Location: ./error.php');
  exit();
}
?>