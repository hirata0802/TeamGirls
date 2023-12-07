<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
    $pdo = new PDO($connect, USER, PASS);
    $nextId -> execute([$_GET['group']]);
    $nextId = $pdo -> prepare('select cosme_id from Cosmetics where group_id=?');
    foreach($nextId as $row){
        $cosme[] = $row;
    }
    $max=count($cosme)-1;
    if($_GET['next']==0){   //前のcosme_id取得
        if($cosme[0] == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$cosme[$max]);
            exit();
        }
        else{
            header('Location: ./detail.php?cosme_id='.$_GET['cosmeId']-1);
            exit();
        }
    }
    else if($_GET['next']==1){   //次のcosme_id取得
        if($cosme[$max] == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$cosme[0]);
            exit();
        }
        else{
            header('Location: ./detail.php?cosme_id='.$_GET['cosmeId']+1);
            exit();
        }
    }
?>