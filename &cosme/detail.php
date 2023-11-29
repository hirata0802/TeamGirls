<?php session_start(); 
    //ページのURLをセッションに保存
    if(!isset($_SESSION['history'])){
        $_SESSION['history'] = array();
    }
    array_push($_SESSION['history'], $_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <!--<link rel="stylesheet" href="css/detail.css">-->
        <title>&cosme</title>
    </head>
    <body>
<?php require 'db_connect.php'; ?>
<?php require 'menu.php'; ?>
<br><br>
<?php
echo '<button onclick="location.href=`',$_SERVER['HTTP_REFERER'],'`">＜戻る</button>';

    $pdo = new PDO($connect, USER, PASS);
    $cosme1 = $pdo -> prepare('select * from Cosmetics where cosme_id=?');
    $cosme1 -> execute([$_GET['cosme_id']]);
    
    foreach($cosme1 as $row){ 
        $detail = $row['cosme_detail'];
        $cosmeId = $row['cosme_id'];
        echo '<h3 align="center">',$row['cosme_name'],'</h3>';
        echo '<div class="out">';
        echo '<div class="in">';
        //echo '<label><input type=radio name="slide" checked><span></span><a href="#">
        //</a></label>';
        echo '<button type="button" onclick="location.href=`detail_next.php?group=', $row['group_id'], '&cosmeId=', $row['cosme_id'], '&next=0`>＜</button>';
        echo '<img src="',$row['image_path'],'" width="200" alt="',$row['color_name'],'">';
        echo '<button type="button" onclick="location.href=`detail_next.php?group=', $row['group_id'], '&cosmeId=', $row['cosme_id'], '&next=1`>＞</button>';
        //for($a=1; $a<=$count; $a++){
            //}
            echo '</div>';
            echo '</div>';
            echo '<p>販売価格：￥',$row['price'],'</p>';
            echo '<p>カラー：',$row['color_name'],'</p>';
        }

        //echo '<table><tr>';
        echo '<p><a href="cart_input.php?cosmeId=',$cosmeId,'&page=0"><button>カートに入れる</button></a></p>';
        
        //お気に入り
        $cosme2 = $pdo -> prepare('select * from Favorites where member_code = ? and cosme_id=?');
        $cosme2 -> execute([$_SESSION['customer']['code'],$cosmeId]);//cosmeId=選んだコスメ
        $count = $cosme2 -> rowCount();
        
        if($count > 0){
            foreach($cosme2 as $row){
                if($row['delete_flag']==0){//1  //9
                    echo '<a href="favorite.php?cosmeId=',$cosmeId,'& page=0">★</a>';
                }else{
                    echo '<a href="favorite.php?cosmeId=',$cosmeId,'& page=0">☆</a>';
                }
            }
        }else{
        //echo '<form action="favorite.php" method="get">';
        echo '<button onclick="location.href=`favorite.phpcosmeId=',$cosmeId,'&page=2"`>☆</button>';
        //echo '<a href="favorite.php?cosmeId=',$cosmeId,'&page=2">☆</a>';
    }

    echo '<p>商品詳細</p>';
    echo $detail;
?>
<?php require 'review.php'; ?>
<?php require 'footer.php'; ?>