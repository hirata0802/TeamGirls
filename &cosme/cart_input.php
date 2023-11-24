<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect,USER,PASS);
    //お気に入り追加
    if($page==0){
        $sql=$pdo->prepare('insert into Cart values (null, ?, ?, 1, 0)');
        $sql->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        header('Location: ./detail.php');
        exit();
    }
    //個数の変更をDBに反映させる
    else{
        $raw=file_get_contents('php://input');
        $data=json_decode($raw);
        $res=$data;
    }
?>