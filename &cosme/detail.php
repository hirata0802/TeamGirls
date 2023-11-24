<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/detail.css">
        <title>&cosme</title>
    </head>
    <body>
<?php require 'db_connect.php'; ?>
<?php require 'menu.php'; ?>
<br><br>
<?php
echo '<button onclick="location.href=`',$_SERVER['HTTP_REFERER'],'`">＜戻る</button>';

    $pdo = new PDO($connect, USER, PASS);
    $cosme1 = $pdo -> prepare('select * from Cosmetics where cosme_id=? and group_id=? and brand_id=? and category_id=?');
    $cosme1 -> execute([$_GET['cosme_id'], $_GET['group_id'], $_GET['brand_id'], $_GET['category_id']]);
    $count = 1;

    foreach($cosme1 as $row){ 
        $cosmeId = $row['cosme_id'];
        if($count==1){
            echo '<h3 align="center">',$row['cosme_name'],'</h3>';
            //echo '<p>販売価格:',$row['price'],'</p>';
            $cosmeEx = $row['cosme_detail'];
            $count++;
        }   
        echo '<div class="out">';
        echo '<div class="in">';
        for($a=1; $a<=$count; $a++){
            echo '<label><input type=radio name="slide" checked><span></span><a href="#"><img src="',$row['image_path'],'" width="200" alt="',$row['color_name'],'"></a></label>';
        }
        echo '</div>';
        echo '</div>';
        $price = $row['price'];
        $colorName = $row['color_name'];
    }
    echo '<p>販売価格：￥',$price,'</p>';
    echo '<p>カラー：',$colorName,'</p>';

    //echo '<table><tr>';
    echo '<p><a href="cart.php?cosmeId=',$cosmeId,'"><button>カートに入れる</button></a></p>';

    //お気に入り
    $cosme2 = $pdo -> prepare('select * from Favorites where member_code = ? and cosme_id=?');
    $cosme2 -> execute([$_SESSION['customer']['code'],$cosmeId]);//cosmeId=選んだコスメ
    $count = $cosme2 -> rowCount();
    echo 'コスメID',$cosmeId,'<br>';
    echo '回数',$count,'<br>';

    if($count > 0){
        foreach($cosme2 as $row){
            $delete = $row['delete_flag'];
            echo '削除フラグ',$delete;
            if($row['delete_flag']==0){//1  //9
                echo '<a href="favorite.php?cosmeId=',$cosmeId,'& page=0">★</a>';
            }else{
                echo '<a href="favorite.php?cosmeId=',$cosmeId,'& page=0">☆</a>';
            }
        }
    }else{
        echo '<a href="favorite.php?cosmeId=',$cosmeId,'&page=2">☆</a>';
    }
?>
<?php require 'footer.php'; ?>