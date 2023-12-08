<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
if(empty($_SESSION['customer'])){
    header('Location: ./error.php');
    exit();
}
    $pdo = new PDO($connect, USER, PASS);
    $groupCosme = $pdo -> prepare('select cosme_id from Cosmetics where group_id=?');
    $groupCosme -> execute([$_GET['group']]);
    $cosme = [];
    $id;
    foreach($groupCosme as $i => $row){
        $cosme[] = $row;
        if($cosme[$i][0] == $_GET['cosmeId']){
            $id = $i;
        }
    }
    $max=count($cosme)-1;
    if($_GET['next']==0){   //前のcosme_id取得
        if($cosme[0][0] == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$cosme[$max][0].'&page='.count($_GET));
            exit();
        }
        else{
            $id--;
            header('Location: ./detail.php?cosme_id='.$cosme[$id][0].'&page='.count($_GET));
            exit();
        }
    }
    else if($_GET['next']==1){   //次のcosme_id取得
        if($cosme[$max][0] == $_GET['cosmeId']){
            header('Location: ./detail.php?cosme_id='.$cosme[0][0].'&page='.count($_GET));
            exit();
        }
        else{
            $id++;
            header('Location: ./detail.php?cosme_id='.$cosme[$id][0].'&page='.count($_GET));
            exit();
        }
    }
?>