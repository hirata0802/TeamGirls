<?php session_start(); ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
?>
<?php require 'header.php'; ?>
<?php require 'menu_cart.php'; ?>
<div id="mannaka">カートに商品がありません。</div>
<?php require 'footer.php'; ?>
