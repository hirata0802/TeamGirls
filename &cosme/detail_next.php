<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect, USER, PASS);
    $minId = $pdo -> prepare('select min(cosme_id) from Cosmetics where group_id=?');
    $minId -> execute([$_GET['group_id']]);
    $maxId = $pdo -> prepare('select max(cosme_id) from Cosmetics where group_id=?');
    $maxId -> execute([$_GET['group_id']]);
    if($_GET['next']==0){   //前のcosme_idforeach($minId as $m){
            if($minId == $_GET['cosme_id']){
                header('Location: ./detail.php?cosmeId='.$maxId);
                exit();
            }else{
                header('Location: ./detail.php?cosmeId='.$_GET['cosme_id']+1);
                exit();

            }
    }
    
?>