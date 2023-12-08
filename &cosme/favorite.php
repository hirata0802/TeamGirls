<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
?>
<?php  
    $pdo = new PDO($connect,USER,PASS);
    $delete_flag = $pdo -> prepare('select * from Favorites where member_code = ? and cosme_id = ?');
    $delete_flag -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
    $count=$delete_flag->rowCount();
    $backURL = end($_SESSION['history']);
    if($count>0){
        foreach($delete_flag as $row){
            if($row["delete_flag"] == 0){//お気に入り削除
                $sql = $pdo -> prepare('update Favorites set delete_flag=1,register_date=current_date where member_code = ? and cosme_id = ?');
                $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
            }else if($row['delete_flag'] == 1){//お気に入り追加 過去に追加したことあるコスメ
                $sql = $pdo -> prepare('update Favorites set delete_flag=0,register_date=current_date where cosme_id = ? and member_code = ?');
                $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
            }
            if($_GET['page'] == 0){//GETなし
                if($row["delete_flag"] == 0){
                    header('Location: '.$backURL.'?page=31');
                    exit();
                }else{
                    header('Location: '.$backURL.'?page=32');
                    exit();
                }
            }else{//商品詳細画面、検索結果からの遷移
                if($row["delete_flag"] == 0){
                    header('Location: '.$backURL.'&page=31');
                    exit();
                }else{
                    header('Location: '.$backURL.'&page=32');
                    exit();
                }
            }
        }
    }else{ //一度もお気に入りに追加したことないコスメ
        $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date, 0)');
        $sql -> execute([$_GET['cosmeId'], $_SESSION['customer']['code']]); 
        header('Location: '.$backURL.'&page=32');
        exit();
    }
?>