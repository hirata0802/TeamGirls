<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect,USER,PASS);
    $delete_flag = $pdo -> prepare('select * from Favorites where member_code = ? and cosme_id = ?');
    $delete_flag -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
    $count=$delete_flag->rowCount();

if($count>0){
foreach($delete_flag as $row){
    if($_GET['page'] == 1){//お気に入り画面からの遷
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
        }else if($row['delete_flag'] == 1){//お気に入り追加 過去に追加したことあるコスメ
            $sql = $pdo -> prepare('update Favorites set delete_flag=0,register_date=current_date where cosme_id = ? and member_code = ?');
            $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
            header('Location: ./favorite_show.php');
            exit();
        }
        header('Location: ./favorite_show.php');
        exit();
    }
}
}else{ //一度もお気に入りに追加したことないコスメ
    if($_GET['page'] == 2){
        $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date, 0)');
        $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
    }
        header('Location: ./favorite_show.php');
         exit();
}
?>
