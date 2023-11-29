<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect, USER, PASS);
    $minId = $pdo -> prepare('select min(cosme_id) from Cosmetics where group_id=?');
    $minId -> execute([$_GET['group']]);
    $maxId = $pdo -> prepare('select max(cosme_id) from Cosmetics where group_id=?');
    $maxId -> execute([$_GET['group']]);
    if($_GET['next']==0){   //前のcosme_idforeach($minId as $m){
        if($minId == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$maxId);
            exit();
        }
        else if($maxId == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$minId);
            exit();
        }
        else{
            header('Location: ./detail.php?cosme_id='.$_GET['cosmeId']-1);
            exit();
        }
    }
    else if($_GET['next']==1){   //前のcosme_idforeach($minId as $m){
        if($minId == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$maxId);
            exit();
        }
        else if($maxId == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$minId);
            exit();
        }
        else{
            header('Location: ./detail.php?cosme_id='.$_GET['cosmeId']+1);
            exit();
        }
    }
    
?>