<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update Mypage set member_nickname=?, member_age=?, member_gender=?, member_skin=?, member_color=? where member_code=?');
    $sql->execute([
        $_POST['nickname'],
        $_POST['age'],
        $_POST['sei'],
        $_POST['skin'],
        $_POST['p_color'],
        $_SESSION['customer']['code']
    ]);

?>