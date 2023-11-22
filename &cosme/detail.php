<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
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
<?php require 'menu.php'; ?>
<br><br>
<button onclick="history.back()">＜戻る</button>

<?php
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

    /*$cosme2 = $pdo -> prepare('select * from Favorites as F inner join Cosmetics as C on F.cosme_id = C.cosme_id  where cosme_id = ? and member_code = ?');
    $cosme2 -> execute([$cosmeId,$_SESSION['customer']['code']]);
    foreach($cosme2 as $row){
            if($row['delete_flag'] == 1){
                echo '<a href="favorite.php?cosmeId=',$cosmeId,'$page=0">☆</a>';
            }else{
               echo '<a href="favorite.php?cosmeId=',$cosmeId,'$page=0">★</a>';
            }
    }*/
    echo '<p align="center">商品詳細</p>';
    echo '<p>',$cosmeEx,'</p>';
    echo '<p><strong>レビュー</strong></p>';

    echo    '<form action="#" method="post">';
    echo    '<input type="radio" name="detail" value=1>☆';
    echo    '<input type="radio" name="detail" value=2>☆';
    echo    '<input type="radio" name="detail" value=3>☆';
    echo    '<input type="radio" name="detail" value=4>☆';
    echo    '<input type="radio" name="detail" value=5>☆';
    echo    '<input type="submit" value="決定">';
    echo    '</form>';
    //レビュー
    echo '<td><button onclick="location.href=`review_show.php`" value="',$cosmeId,'" name="R_show" class="ao">レビューを見る</button></td>'; 
    echo '<td><button onclick="location.href=`review_new.php`" value="',$cosmeId,'" name="R_new" class="ao">レビューを書く</button></td>'; 
?>
<?php require 'footer.php'; ?>