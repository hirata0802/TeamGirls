<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect,USER,PASS);
    $delete_flag = $pdo -> prepare('select delete_flag from Favorites where member_code = ? and cosme_id = ?');
    $delete_flag -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);

foreach($delete_flag as $row){
    if($_GET['page'] == 1){//お気に入り画面からの遷移
        if($row["delete_flag"] == 0){//お気に入り削除
            $sql = $pdo -> prepare('update Favorites set delete_flag=1,register_date=current_date where member_code = ? and cosme_id = ?');
            $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
        }
        header('Location: ./favorite_show.php');
        exit();
    }else if($_GET['page'] == 0){//商品詳細画面からの遷移
        if($row["delete_flag"] == 0){//お気に入り削除
            $sql = $pdo -> prepare('update Favorites set delete_flag=1,register_date=current_date where member_code = ? and cosme_id = ?');
            $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
            header('Location: ./favorite_show.php');
            exit();
        }else{//お気に入り追加
            $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date, 0)');
            $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
            if($_GET['page'] == 0){
                header('Location: ./detail.php');
                exit();
            }
        }
        header('Location: ./detail.php');
        exit();
    }
}
?>
