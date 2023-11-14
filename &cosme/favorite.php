<?php session_start(); ?>
<?php require 'db_connect.php'; ?>

<?php
    $pdo = new PDO($connect,USER,PASS);
    $delete_flag = $pdo -> prepare('select delete_flag from Favorites where member_code = ? and cosme_id = ?');
    $delete_flag -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);

if($delete_flag == 1){//お気に入り追加
    $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date, 0)');
    $sql -> execute([$_SESSION['customer']['code'],$_GET['cosmeId']]); 
}else{//お気に入り削除
    $sql = $pdo -> prepare('update Favorites set delete_flag = 1 where member_code = ? and cosme_id = ?');
    $sql -> execute([$_SESSION['customer']['code'], $_GET['cosmeId']]);
}
?>



