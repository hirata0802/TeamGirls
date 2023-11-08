<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>


<?php
//seach_output.phpでお気に入り登録するとき、Ajax を使う？
    if(isset($_SESSION['customer'])){
        $pdo = new PDO($connect,USER,PASS);
        $sql = $pdo -> prepare('insert into Favoritea values(?, ?)');
        $sql -> execute([$_SESSION['customer']['id'], $_GET['id']]);
        require 'seach_input.php';
    }else{
        echo 'お気に入りに商品を追加するには、ログインしてください。';
    }
?>
<?php require 'footer.php'; ?>




