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

    $cosme2 = $pdo -> prepare('select * from Favorites as F inner join Cosmetics as C on F.cosme_id = C.cosme_id  where group_id = ? and member_code = ?');
    $cosme2 -> execute([$_GET['group_id'], $_SESSION['customer']['code']]);
    $i = 0;
    foreach($cosme2 as $row){
        if($i == 0){
            if($row['delete_flag']==1){
                echo '<a href="favorite.php?cosmeId=',$cosmeId,'$page=0">☆</a>';
            }else{
                echo '<a href="favorite.php?cosmeId=',$cosmeId,'$page=2">★</a>';
            }
        }
    }

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

//レビュー表示
    $review = $pdo -> prepare('select * from Reviews as R join Mypages as M on R.cosme_id = M.cosme_id where cosme_name = ?');
    $review -> execute([$_GET['cosme_name']]);
    $count = 1;
    if($count<=2){
        foreach($review as $row){
            echo $row['member_nickname'],$row['level'];
            echo $row['review_text'];
            echo '<hr>';
            $count++;
        }
    }
    echo '<td><a href="cart.php?cosmeId=',$cosmeId,'"><button>レビューをすべて見る</button></a></td>'; 
    echo '<td><a href="review.php"><button>レビューを書く</button></a></td>'; 
?>
<?php require 'footer.php'; ?>