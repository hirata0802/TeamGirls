<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<?php
    if(isset($_SESSION['member'])){
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> prepare('delete from Favorites where member_code = ? and cosme_id = ?');
        $sql -> execute([$_SESSION['member']['id'], $_GET['id']]);
    }
    ?>
