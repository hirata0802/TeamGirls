<?php session_start(); ?>
<?php require 'db-connect.php'; ?>

<?php
    $pdo = new PDO($connect,USER,PASS);
    $exists = $pdo -> prepare('select exists (select  member_code, cosme_id from Favorites where member_code=? and cosme_id=?)');
    $exists -> execute([$_SESSION['customer']['code'], $_GET['id']]);

if($exists == 0){
    $sql = $pdo -> prepare('insert into Favorites values(?, ?, current_date)');
    $sql -> execute([$_SESSION['customer']['code'],$_GET['id']]); 
}else{
    $sql = $pdo -> prepare('delete from Favorites where member_code = ? and cosme_id = ?');
    $sql -> execute([$_SESSION['customer']['code'], $_GET['id']]);
    $flag = 1;
}
?>




