<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    if(empty($_SESSION['customer'])){
        header('Location: ./error.php');
        exit();
    }
?>
<?php  
    $backURL='';
    if($_GET['page']==11){//検索結果
        $backURL='./seach_output.php';
    }else if($_GET['page']==30){//お気に入り
        $backURL='./favorite_show.php';
    }else if($_GET['page']==40){//商品詳細
        $backURL='./detail.php';
    }
    $pdo = new PDO($connect,USER,PASS);
    $delete_flag = $pdo -> prepare('select * from Favorites where member_code = ? and cosme_id = ?');
    $delete_flag -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
    $count=$delete_flag->rowCount();
    if($count>0){
        foreach($delete_flag as $row){
            if($row["delete_flag"] == 0){//お気に入り削除
                $sql = $pdo -> prepare('update Favorites set delete_flag=1,register_date=CURRENT_TIMESTAMP where member_code = ? and cosme_id = ?');
                $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
            }else if($row['delete_flag'] == 1){//お気に入り追加 過去に追加したことあるコスメ
                $sql = $pdo -> prepare('update Favorites set delete_flag=0,register_date=CURRENT_TIMESTAMP where cosme_id = ? and member_code = ?');
                $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
            }
            if($row["delete_flag"] == 0){
                header('Location: '.$backURL.'?page=31');
                exit();
            }else{
                header('Location: '.$backURL.'?page=32');
                exit();
            }
        }
    }else{ //一度もお気に入りに追加したことないコスメ
        $sql = $pdo -> prepare('insert into Favorites values(?, ?, CURRENT_TIMESTAMP, 0)');
        $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
        header('Location: '.$backURL.'?page=32');
        exit();
    }
?>