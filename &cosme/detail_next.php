<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect, USER, PASS);
    $nextId = $pdo -> prepare('select min(cosme_id), max(cosme_id) from Cosmetics where group_id=?');
    $nextId -> execute([$_GET['group']]);
    foreach($nextId as $row){
        if($_GET['next']==0){   //前のcosme_idforeach($minId as $m){
            if($row['min(cosme_id)'] == $_GET['cosmeId']){
                header('Location: ./detail.php?cosme_id='.$row['max(cosme_id)']);
                exit();
            }
            else{
                header('Location: ./detail.php?cosme_id='.$_GET['cosmeId']-1);
                exit();
            }
        }
        else if($_GET['next']==1){   //前のcosme_idforeach($minId as $m){
            if($row['max(cosme_id)'] == $_GET['cosmeId']){
                header('Location: ./detail.php?cosme_id='.$row['min(cosme_id)']);
                exit();
            }
            else{
                header('Location: ./detail.php?cosme_id='.$_GET['cosmeId']+1);
                exit();
            }
        }

    }
    
?>