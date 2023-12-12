<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
    $pdo = new PDO($connect,USER,PASS);
    $check=$pdo->prepare('select * from Cart where member_code=? and cosme_id=? and delete_flag=0');
    $check->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
    if($check->rowCount() == 0){
        $sql=$pdo->prepare('insert into Cart values (null, ?, ?, 1, 0)');
        $sql->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
    }else{
        $sql=$pdo->prepare('update Cart set quantity=quantity+1 where member_code=? and cosme_id=? and delete_flag=0');
        $sql->execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
    }
    if($_GET['page']==11){//検索結果からの遷移
        header('Location: ./seach_output.php?page=20');
        exit();
    }else if($_GET['page']==30){//お気に入りからの遷移
        header('Location: ./favorite_show.php?page=20');
        exit();
    }else if($_GET['page']==40){//商品詳細からの遷移
        header('Location: ./detail.php?page=20');
        exit();
    }
?>